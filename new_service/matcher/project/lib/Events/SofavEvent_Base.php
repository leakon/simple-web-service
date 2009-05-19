<?php

/**
 * SofavEvent_Base
 *
 * @package     Event
 * @subpackage  Base
 * @link        www.leakon.com
 * @version     2009-03-25
 * @author      Leakon <leakon@gmail.com>
 * @description	事件处理，有些用户操作，需要连续对多个 map 表进行写操作，这里可以统一处理，避免疏漏，同时生成备查日志
 *
 * @notice	add comment
 */
class SofavEvent_Base {

	protected
		$property	= array();

	public function __construct($property = array()) {
		$this->property		= $property;
		$this->setup();
	}

	public function notify($eventName, $property) {

		if (method_exists($this, $eventName)) {

			// doLog, before calling event
			// ...

			// call event
			$ret	= call_user_func(array($this, $eventName), $property);

			// doLog, after calling event
			// ...

			/*
			分 2 次记录日志，就是为了检查多步操作是否全部完成
			类似于 innodb 的事务操作，只是这里不开启事务处理，仅仅是记下日志
			*/

			return	$ret;

		}

		return	false;

	}

	// abstract method
	protected function setup() {
	}

}

