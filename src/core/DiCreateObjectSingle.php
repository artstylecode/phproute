<?php
	namespace route\core;
	/**
	 * 依赖注入单例创建实例
	 */
	class DiCreateObjectSingle
	{
		private $classname;
		private $method;
		private $config;
		public function __construct($config)
		{
			$this->method = $config["method"];
			$this->config = $config["config"];
			$this ->classname = $config["class"];
		}

		public function createInstance()
		{
			$instance = null;
			if(isset($this->classname))
			{
				if(isset($this->method))
				{
					$instance =  ReflectionUtils::InvokeStaticMethod($this->classname, $this->method, $this->config);
				}else
				{
					throw new Exception("依赖注入异常，请指定注入所需的实例创建方法！");
				}
			}else
			{
				throw new Exception("依赖注入异常，请指定所需注入的目标类名！");
				
			}

			return $instance;
		}
	}
 ?>