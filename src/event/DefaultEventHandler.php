<?php
	namespace route\event;
	/**
	 * 默认事件处理器
	 */
	class DefaultEventHandler implements IEvent
	{
		
		/**
		 * 时间派遣接口
		 * @return [type]            [description]
		 */
		public function dispatch($eventname)
		{
			//echo "</br>current event:$eventname";
		}
	}
 ?>