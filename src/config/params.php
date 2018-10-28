<?php
//框架配置文件
	return array
	(
	"injection" => 
		[	
			[
				"class" => "route\controller\Controller",
				"field" => 
				[
					"name" => "_Render",
					"class" => "route\\render\\TwigRender",//渲染器類名
					"type" => "construct",//construct,single,factory
					"method" => "",//获取实例方法名
					"config" => //初始化函數參數
					[
						"root" => "views/"
					],
					"isSingle" => true//單例

				]
			],
			[
				"class" => "Application",
				"field" => 
				[
					"name" => "eventManager",
					"class" => "route\\event\\EventManager",//渲染器類名
					"type" => "single",//construct,single,factory
					"method" => "getInstance",//获取实例方法名
					"config" => //初始化函數參數
					[
						"root" => "views/"
					],
					"isSingle" => true//單例

				]
			]

		]
		
		
	)
 ?>