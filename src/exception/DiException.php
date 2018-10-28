<?php
	namespace route\exception;
	/**
	 * 依赖注入异常
	 */
	class DiException extends \Exception
	{
		public __construct ([ string $message = "" [, int $code = 0 [, Throwable $previous = NULL ]]] )
		{
			parent::__construct($message, $code, $previous);
		}
		
	}

?>