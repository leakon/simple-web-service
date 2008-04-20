<?php

/**
 * Subclass for representing a row from the 'rzx_maintance' table.
 *
 *
 *
 * @package lib.model
 */
class Maintance extends BaseMaintance
{

/*
	public function getMaintanceDetail() {
		return	strlen($this->maintance_detail) ? unserialize($this->maintance_detail) : array();
	}

	public function setMaintanceDetail($v) {
		$v	= serialize($v);
		parent::setMaintanceDetail($v);
	}
*/


	public function getMaintanceDetail() {
		$extra	= unserialize(parent::getMaintanceDetail());
		return	is_array($extra) ? $extra : array('detail' => array());
	}

	public function setMaintanceDetail($e) {
		$extra	= serialize(array('detail' => $e));
		return	parent::setMaintanceDetail($extra);
	}

}
