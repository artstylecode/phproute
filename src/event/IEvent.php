<?php
	namespace route\event;
	interface IEvent
	{
		/**
		 * 时间派遣接口
		 * @return [type]            [description]
		 */
		public function dispatch($eventname);
	}
 ?>