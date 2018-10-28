<?php
	namespace route\core;
	/**
	 * 依賴注入容器
	 */
	class DiContainer 
	{
		//容器對像池
		private static $INSTANCES=array();

		const CREATENORMAL="construct";
		const CREATESINGLE="single";
		/**
		 * 清空容器对象池 
		 */
		public static function clearSingle()
		{
			self::$INSTANCES = array();
		}
		/**
		 * 根據配置獲取实例
		 * @param  [type] $config [description]
		 * @return [type]         [description]
		 */
		public static function getInstance($config)
		{
			if(isset($config["class"]))
			{
				
				$key = md5($config["class"].filectime(\Application::$baseDir."/config/params.php"));
				if($config["isSingle"]&&isset(self::$INSTANCES)&&isset(self::$INSTANCES[$key]))
				{

					return self::$INSTANCES[$key];
				}
				$createObj= DiCreateObjectFactory::createInstance($config);
				
				
				$instance = $createObj ->createInstance();
				if(!isset($instance))
				{
					throw new \Exception("所指定的类名有误");
				}else
				{
					if($config["isSingle"])
					{
						$key = md5($config["class"]);
						self::$INSTANCES[$key] = $instance;

					}
				}
				return $instance;
			}else
			{
				throw new \Exception("请指定所需注入的对象类名");
				
			}
		}
	}
 ?>