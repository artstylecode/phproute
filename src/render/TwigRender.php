<?php 
	namespace route\render;

	/**
	 * twig引擎渲染器
	 */
	class TwigRender extends BaseRender
	{
		private $viename;
		private $twig;
		const SUBFIX="twig";

		public function __construct($config)
		{
			$srcDir = \Application::$baseDir;
			$loader = new \Twig_Loader_Filesystem($srcDir.'/views');
			$this->twig = new \Twig_Environment($loader, array(
			    'cache' => $srcDir.'/cache',
			    'debug' => true
			));
			
		}

		/**
		 * 渲染器初始化方法
		 * @param  array $config 渲染器配置
		 * @return bool      
		 */
		public  function boot($config)
		{
			
			

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

			
			$template = $this->twig ->load($this->viename.'.'.self::SUBFIX);
			if($template)
				return $template ->render($params);
			else
				return "12312";
		}
	}
?>