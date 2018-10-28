<?php
	namespace route\core;
	 /**
	 * 依赖注入组件基础类
	 */
	abstract class  BaseInjection implements \ArrayAccess
	{
		protected $_config;
		public  function __construct()
		{
			$params = require \Application::$baseDir."/config/params.php";
			$injections = $params["injection"];
			foreach ($injections as $inject) {
				if($inject["class"] == $this->get_called_class())
				{

					$this ->_config = $inject["field"]["config"];	
					$instance = DiContainer::getInstance($inject["field"],[]);
					if(isset($instance))
					{
						$name = $inject["field"]["name"];
						
						$this->$name = $instance;
						
						
					}
				} 
			}
		}

		public function get_called_class()
		{

		}

		public function offsetExists ($offset )
		{
			return isset($this->$offset);
		}
		public function offsetGet (  $offset )
		{
			return $this->$offset;
		}
		public function offsetSet (  $offset ,  $value )
		{
			$this->$offset = $value;
		}
		public function offsetUnset (  $offset )
		{
			unset($this->$offset);
		}
	}
 ?>