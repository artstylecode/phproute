<?php
	namespace route\core;
	/**
	 * 
	 */
	class DiCreateObjectFactory
	{
		
		public static function createInstance($config)
		{
			$type = $config["type"];
			$instance = null;
			switch ($type) {
				case DiContainer::CREATENORMAL:
					$obj =new DiCreateObjectConstruct($config);
					$instance = $obj ->createInstance();
					break;
				case DiContainer::CREATESINGLE:
					$obj =new DiCreateObjectSingle($config);
					$instance = $obj ->createInstance();
					break;
			}

			return $obj;
		}
	}

 ?>