<?php 
	namespace route\render;

	/**
	 * 默认模板渲染器
	 */
	class DefRender extends BaseRender
	{
		private $viename;
		private static $baseDir;
		private $rootPath;

		public function __construct($config)
		{
			$this->rootPath  = $config["root"];
			self::$baseDir = \Application::$baseDir;
		}

		/**
		 * 渲染器初始化方法
		 * @param  array $config 渲染器配置
		 * @return bool      
		 */
		public  function boot($config)
		{
			
			$this->rootPath  = $config["root"];
			self::$baseDir = dirname(dirname(__FILE__));


			return true;
				
		
		}

        /**
         * 加載模板文件
         * @param  string $url 模板文件路徑/名稱
         * @return bool      文件加載結果
         */
		public  function load($url)
		{
			$this->viename = $url;
			return true;
		}
        /**
         * 渲染模板
         * @return string 渲染輸出結果
         */
		public  function render($params)
		{

			foreach ($params as $varname => $varval) {
				$$varname = $varval;
			}

			$path = self::$baseDir."/".$this->rootPath.$this->viename.".php";
			$html = require $path;
			return $html;
		}
	}
?>