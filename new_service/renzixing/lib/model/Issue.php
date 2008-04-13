<?php

/**
 * Subclass for representing a row from the 'sf_issue ' table.
 *
 *
 *
 * @package lib.model
 */
class Issue extends BaseIssue {

	protected
		$typeLevel,
		$skip_update_at	= false;

	public function save($con = null) {

		$sfUser	= sfContext::getInstance()->getUser();
		return	parent::save();
	}

	public function setStatus($save_type) {

		$valueOfStatus	= IssuePeer::getStatusBySaveType($save_type);
		return	parent::setStatus($valueOfStatus);
	}


	public function getExtra() {
		$extra	= unserialize(parent::getExtra());
		return	is_array($extra) ? $extra : array('extra' => array());
	}

	public function setExtra($e) {
		$extra	= serialize(array('extra' => $e));
		return	parent::setExtra($extra);
	}

	public function saveEdit10($action) {

	#	$this->typeLevel	= 10;
		$this->setType(10);

		$this->setId($action->getRequestParameter('id'));
		$this->setUserId($action->getUser()->getId());
		$this->setPriority($action->getRequestParameter('priority'));
		$this->setTitle($action->getRequestParameter('title'));
		$this->setDescription($action->getRequestParameter('description'));
		$this->setSolution($action->getRequestParameter('solution'));

		$contact	= array();
		$contact['contact_name']	= $action->getRequestParameter('contact_name');
		$contact['contact_value']	= $action->getRequestParameter('contact_value');



/*
		$this->setExtra($contact);

		$this->setStatus($action->getRequestParameter('save_type'));

		$this->statusToType($action);

		$this->doTerminate($action);
*/

		$this->save();


	}

	// 根据操作的不同类型，设置不同的 type
	protected function statusToType($action) {

		$arrLevelMap	= IssuePeer::getLevelMap($this->typeLevel);
		$saveType	= $action->getRequestParameter('save_type');

	#	var_dump($arrLevelMap);

		// 终止
		if ('terminated' == $saveType) {
			// 设置为当前处理级别
			$this->setType($this->typeLevel);
		}

		// 提交上级
		if ('submitted' == $saveType) {
			// 设置为当前处理级别
			$this->setType($arrLevelMap['next']);
		}

		// 打回下级
		if ('rejectted' == $saveType) {
			// 设置为当前处理级别
			$this->setType($arrLevelMap['prev']);
		}
	}

	protected function doTerminate($action) {
		if ('terminated' == $action->getRequestParameter('save_type')) {
			$this->setType($this->typeLevel);
		}
	}

	public function setUpdatedAt($v) {
		if ($this->skip_update_at) {
		} else {
			parent::setUpdatedAt($v);
		}
	}

	public function skipUpdatedAt() {
		$this->skip_update_at	= true;
	}

}
