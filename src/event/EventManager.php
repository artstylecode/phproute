<?php
	namespace route\event;
	/**
	 * 事件管理
	 */
	class EventManager
	{
		const EVENT_APPINIT="APPINIT";//路由程序启动事件
		const EVENT_ACTIONSTART="ACTIONSTART";//action开始处理
		const EVENT_ACTIONEND = "ACTIONEND";//action处理结束
		const EVENT_APPEND="APPEND";//路由程序处理结束事件
		//单例化事件管理类
		private static $instance;
		public static function getInstance()
		{
			if(!isset(self::$instance))
			{
				self::$instance = new self();
			}
			return self::$instance;
		}
		private function __construct()
		{

		}
		private $eventList = array();
		/**
		 * 添加事件监听
		 * @param string $eventname 事件名称
		 * @param route\event\IEvent $handler   事件处理接口实例
		 */
		public function addListener($eventname,$handler)
		{
			if(!isset($this->eventList[$eventname]))
			{
				$this->eventList[$eventname] = array();
			}
			if($handler instanceof IEvent)
			{
				$this->eventList[$eventname][] = $handler;
			}else
			{
				throw new Exception("请添加实现了route\event\IEvent接口的对象实例", 1);
				
			}			
		}
		/**
		 * 派遣事件
		 * @param  string $eventname 事件类型
		 */
		public function dispatch($eventname)
		{
			$evlist = $this->eventList[$eventname];
			if(isset($evlist))
			{
				foreach($evlist as $event){
					$event ->dispatch($eventname);
				}
				
			}
		}
	}
 ?>