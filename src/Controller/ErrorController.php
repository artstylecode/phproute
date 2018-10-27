<?php 
	namespace route\controller;
	/**
	 * 
	 */
	class ErrorController
	{
		public function actionNotFound($controller, $action)
		{
			return "<<!DOCTYPE html>
			<html>
			<head>
				<title>page not found</title>
			</head>
			<body>
				<h2>not found page controller:$controller action:$action</h2>
			</body>
			</html>";
		}
	}
 ?>