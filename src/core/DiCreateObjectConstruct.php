<?php
	namespace route\core;
	/**
	 * 依赖注入单例创建实例
	 */
	class DiCreateObjectConstruct
	{
		private $classname;
		private $config;
		public function __construct($config)
		{
			$this->config = $config["config"];
			$this ->classname = $config["class"];
		}

		public function createInstance()
		{
			$instance = null;
			if(isset($this ->classname))
			{
				$reflectionInfo = ReflectionUtils::getInstance($this ->classname, $this->config);
				$instance = $reflectionInfo? $reflectionInfo["instance"]:null;
			}else
			{
				throw new Exception("依赖注入异常，请指定所需注入的目标类名！");
				
			}

			return $instance;
		}
	}
 ?>