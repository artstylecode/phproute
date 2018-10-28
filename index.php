<?php 	require "vendor/autoload.php";
		use route\core\ReflectionUtils;
		$params = require "src/config/params.php";
		$obj = ReflectionUtils::getInstance($params["render"]["class"],[]);
		var_dump($obj);