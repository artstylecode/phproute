<?php 
	namespace route\render;
	abstract class  BaseRender 
	{
		/**
		 * 渲染器初始化方法
		 * @param  array $config 渲染器配置
		 * @return bool      
		 */
		public abstract function boot($config);
        /**
         * 加載模板文件
         * @param  string $url 模板文件路徑/名稱
         * @return bool      文件加載結果
         */
		public abstract function load($url);
        /**
         * 渲染模板
         * @return string 渲染輸出結果
         */
		public abstract function render($params);

		public function jsonRender($params)
		{
			header('Content-Type:application/json; charset=utf-8');
			return json_encode($params);
		}
	}

?>