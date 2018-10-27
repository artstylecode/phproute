<?php 
	namespace app;
	class Application
	{
		
		private static $Instance;
		const ROUTEPARAMNAME="r";
		const NAMESPACEPREFIX="route\controller\\";
		public static $App;

		private __construct($config)
		{

		}

		public function getInstance($config)
		{
			echo "getInstance";
			if(!isset(self::$Instance))
			{
				self::$Instance = new self($config);
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
			var_dump($_GET);die;
			self::$App = $this;
			$routeInfoStr = $_GET[self::ROUTEPARAMNAME];

			$html = "none";

			if(!isset($controller)||!isset($action))
			{
				$html = $this->redirectToNotFound();
			}else
			{
				$classInfo = $this->getClassInfo();
				$fullClass = self::NAMESPACEPREFIX.$classInfo["class"];
				echo "class:".$fullClass;
				$ref = new ReflectionClass($fullClass);
				$instance = $ref ->getInstance();
				$method = $instance ->getMethod();
				if(!isset($instance)||!isset($method))
				{
					$html = $this->redirectToNotFound();
				}else
				{
					$methodParam = array();
					$arguments = $method -> getParameters();
					foreach ($arguments as $argname=> $arg) {
						if(isset($this->param[$argname]))
						{
							$methodParam[$argname] = $arg;
						}
					}
					$html = $method -> invokeArgs($instance, $methodParam);
				}
			}
			echo $html;	
		}
		public function redirectToNotFound()
		{
			# code...
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