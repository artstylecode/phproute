<?php 

	namespace route\core;
	/**
	 * 
	 */
	class ReflectionUtils
	{
		/**
		 * 反射调用方法
		 * @param string $class 		类名
		 * @param string $methodname   方法名
		 * @param array $methodParams 调用方法所需参数
		 */
		public static function InvokeMethod($class, $methodname, $methodParams)
		{
			$methodInfo = self::getMethod($class, $methodname);
			$method = $methodInfo["method"];
			$instance = $methodInfo["instance"];
			if($method)
			{
				$arguments = $method ->getParameters();
				$methodParams = array();
				foreach ($arguments as $arg) {
					if($methodParams[$arg->name])
					{
						$methodParams[$arg -> name] = $methodParams[$arg->name];
					}
				}
				return $method ->invokeArgs($instance, $methodParams);
			}else
			{
				return false;
			}
		}
		/**
		 * 反射调用方法
		 * @param string $class 		类名
		 * @param string $methodname   方法名
		 * @param array $methodParams 调用方法所需参数
		 */
		public static function InvokeStaticMethod($class, $methodname, $methodParams)
		{
			$ref = self::getReflectionInfo($class);
			$method = $ref ->getMethod($methodname);
			if($method ->isStatic())
			{
				return $method ->invokeArgs(null, $methodParams);
			}else
			{
				return false;
			}
		}
		/**
		 * 使用反射获取对象实例
		 * @param  string $class 类名（含命名空间）
		 * @return array       对象实例以及对象信息array("instance" => Object, "ref" => ReflectionClass);
		 */
		public static function getInstance($class, $args)
		{
			$ref = new \ReflectionClass($class);
			if($ref)
				return ["instance" =>$ref ->newInstance($args), "ref" =>$ref];
			else
				return false;
		}

		public static function getReflectionInfo($class)
		{
			$ref = new \ReflectionClass($class);
			return $ref;
		}
		/**
		 * 反射获取方法
		 * @param string $class 		类名
		 * @param string $methodname   	方法名
		 * @return array             	对象实例以及指定方法信息
		 */
		public static function getMethod($class, $methodname)
		{
			if($refInfo = self::getInstance($class,[]))
			{
				$method = $refInfo["ref"] ->getMethod($methodname);
				$instance = $method->isStatic ()?null:refInfo["instance"];
				return ["method" => $method,"instance" => $instance];
			}			
			else 
				return false;
		}
		
	}
 ?>