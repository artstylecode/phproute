<?php 
	use route\controller\ErrorController;
	use route\core\BaseInjection;
	use route\event\EventManager;
	use route\event\DefaultEventHandler;
	class Application extends BaseInjection
	{
		public $eventManager;

		public  function get_called_class()
		{
			return __CLASS__;
		}
		public function __construct()
		{
			//执行父类构造函数进行依赖注入
			parent::__construct();
			$this->init();
		}
		public function init()
		{
			//添加事件监听
			if($this-> eventManager)
			{
				$this->eventManager->addListener(EventManager::EVENT_APPINIT,
					new DefaultEventHandler());
				$this->eventManager->addListener(EventManager::EVENT_ACTIONSTART,
					new DefaultEventHandler());
				$this->eventManager->addListener(EventManager::EVENT_ACTIONEND,
					new DefaultEventHandler());
				$this->eventManager->addListener(EventManager::EVENT_APPEND,
					new DefaultEventHandler());
				//派遣程序初始化事件
				$this->eventManager->dispatch(EventManager::EVENT_APPEND);
			}
		}

		private static $Instance;
		const ROUTEPARAMNAME="t";
		const NAMESPACEPREFIX="route\controller\\";
		public static $App;
		public static $baseDir;		

		public function getInstance($config)
		{
			
			if(!isset(self::$Instance))
			{
				self::$baseDir = dirname(__FILE__);
				self::$Instance = new self();
			}
			return self::$Instance;
		}
		//param of post
		private $post;
		//params of get
		private $get;
		// common params of get and post
		private $param;
		/**
		 * route url
		 * @return [type] [description]
		 */
		public function run()
		{
			
			self::$App = $this;
			$routeInfoStr = $_GET[self::ROUTEPARAMNAME];
			$this->Param();
			$html = "none";

			if(!isset($routeInfoStr))
			{
				$html = $this->redirectToNotFound();
			}else
			{
				$classInfo = $this->getClassInfo($routeInfoStr);
				$fullClass = self::NAMESPACEPREFIX.$classInfo["class"]."Controller";
				$ref = new \ReflectionClass($fullClass);
				if($ref)
				{
					$instance = $ref ->newInstance();
					$method = $ref ->getMethod($classInfo["method"]);
					if(!isset($instance)||!isset($method))
					{
						$html = $this->redirectToNotFound();
					}else
					{
						$methodParam = array();
						$arguments = $method -> getParameters();
						foreach ($arguments as $arg) {
							$argname = $arg ->name;

							if(isset($this->param[$argname]))
							{
								$methodParam[$argname] = $this->param[$argname];
							}
						}
						//派遣action开始处理事件
						$this->eventManager->dispatch(EventManager::EVENT_ACTIONSTART);
						$html = $method -> invokeArgs($instance, $methodParam);
						//派遣action处理完毕事件
						$this->eventManager->dispatch(EventManager::EVENT_ACTIONEND);
					}
				}
				//派遣action处理完毕事件
				$this->eventManager->dispatch(EventManager::EVENT_APPEND);
				
			}
			echo $html;	
		}
		public function redirectToNotFound()
		{
			$con = new ErrorController();
			return $con ->NotFound("con","act");
		}
		public function Post($name=null,$defval=null)
		{
			$this ->post = $this->ResolveRequestParams($_POST);
			if(isset($name))
				return isset($this ->post[$name])?$this->post[$name]:$defval;
			else
				return $this->post;
		}
		public function Get($name=null, $defval=null)
		{
			$this ->get = $this->ResolveRequestParams($_GET);
			if(isset($name))
				return isset($this ->get[$name])?$this->get[$name]:$defval;
			else
				return $this->get;
		}

		private function ResolveRequestParams($arr)
		{
			$rs = array();
			foreach ($arr as $paramname => $paramval) {
				if($paramname!=self::ROUTEPARAMNAME)
				{
					$rs[$paramname] = $paramval;
				}
			}

			return $rs;
		}
		public function Param($name=null,$defval=null)
		{
			$this->Get();
			$this->Post();	
			$this->param = array_merge($this->get, $this->post);
		}
		private function getClassInfo($paramstr)
		{
			$routeInfo = explode("/", $paramstr);
			$controller = $routeInfo[0];
			$action = $routeInfo[1];

			return array("class" => $controller, "method" => $action);
		}
	}
 ?>