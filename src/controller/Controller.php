<?php
		namespace route\controller;
		use route\core\DiContainer;
		use route\core\BaseInjection;
		/**
		 * 
		 */
		class Controller extends BaseInjection
		{
			
			public $_Render;
			private function __construct()
			{
				parent::__construct();
				
				if(isset($this-> _Render))
				{
					$this-> _Render -> boot($this->_config);
				}
					
			}
			protected function render($viename, $params)
			{
				if($this-> _Render){
					$this-> _Render ->load($viename);
					return $this-> _Render ->render($params);
				}
			}
			protected function jsonRender($params)
			{
				return $this-> _Render ->jsonRender($params);
			}

			public function get_called_class()
			{
				return __CLASS__;
			}
		}
?>