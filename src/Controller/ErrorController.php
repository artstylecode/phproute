<?php 
	namespace route\controller;
	/**
	 * 
	 */
	class ErrorController extends Controller
	{
		public function NotFound($controller, $action)
		{
			return $this->render("error/notfound", ["list" =>["1","2","3"]]);
		}
	}
 ?>