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
		$typeLevel;

	// 设置此函数，可以屏蔽自动保存时间的功能
	public function setUpdatedAt($confirm) {
		if ($confirm === true) {
			parent::setUpdatedAt(date('Y-m-d H:i:s'));
		}
	}

	public function save($con = null) {

		$sfUser	= sfContext::getInstance()->getUser();
		return	parent::save();
	}

	public function getTypeString() {
		return	IssuePeer::getTypeString($this->getType(), 2);
	}


	public function getExtra() {
		$extra	= unserialize(parent::getExtra());
		return	is_array($extra) ? $extra : array('extra' => array());
	}

	public function setExtra($e) {
		$extra	= serialize(array('extra' => $e));
		return	parent::setExtra($extra);
	}


	// 处理 办事处
	public function saveEditAgency($action) {

	#	$this->typeLevel	= 10;
	#	$this->setType(IssuePeer::TYPE_AGENCY);

/*
		$this->setId($action->getRequestParameter('id'));
		$this->setUserId($action->getUser()->getId());
		$this->setPriority($action->getRequestParameter('priority'));
		$this->setTitle($action->getRequestParameter('title'));
		$this->setDescription($action->getRequestParameter('description'));
		$this->setSolution($action->getRequestParameter('solution'));
*/

		$contact	= array();
		$contact['contact_name']	= $action->getRequestParameter('contact_name');
		$contact['contact_value']	= $action->getRequestParameter('contact_value');
		$this->setExtra($contact);

/*
		$this->setStatus($action->getRequestParameter('save_type'));
		$this->statusToType($action);
		$this->doTerminate($action);
*/
		$this->setUpdatedAt(true);
		$this->save();
	}

	// 处理 客服中心
	public function saveEditSupport($action) {


		$contact	= array();
		$contact['verify_result']	= $action->getRequestParameter('verify_result');
		$contact['verify_date']	= $action->getRequestParameter('verify_date');

		$this->setExtra($contact);
		$this->setUpdatedAt(true);
		$this->save();
	}

	// 处理 事业部
	public function saveEditDivision($action) {

		$contact	= array();
		$contact['solution_status']	= $action->getRequestParameter('solution_status');
		$contact['solution_deadline']	= $action->getRequestParameter('solution_deadline');

		$this->setExtra($contact);
		$this->setUpdatedAt(true);
		$this->save();
	}

	// 得到当前条目对应的 Agency ID
	public function getBaseId() {
		return	$this->getParentId() > 0 ? $this->getParentId() : $this->getId();
	}

	public function isEditable() {

		$prevIssue	= $this->getFriendIssue('prev');
		$prevId		= $prevIssue->getId();

		$selfId		= $this->getId();

		if ($selfId == $prevId) {
			if ($this->getStatus() < IssuePeer::STATUS_SUBMITTED) {
				return	true;
			} else {
				return	false;
			}
		} else {
			return	$prevIssue->getStatus() == IssuePeer::STATUS_SUBMITTED && $this->getStatus() < IssuePeer::STATUS_SUBMITTED;
		}

	}

	public function isShowable() {

		$prevIssue	= $this->getFriendIssue('prev');
		$prevId		= $prevIssue->getId();

		$selfId		= $this->getId();

		if ($selfId == $prevId) {
			if ($this->getStatus() >= IssuePeer::STATUS_SUBMITTED) {
				return	true;
			} else {
				return	false;
			}
		} else {
			return	$prevIssue->getStatus() >= IssuePeer::STATUS_SUBMITTED && $this->getStatus() >= IssuePeer::STATUS_SUBMITTED;
		}
	}


	public function setPrevRejected() {

		$this->setStatus(IssuePeer::STATUS_REJECTTED);
		$this->save();

		$prevIssue	= $this->getFriendIssue('prev');
		if ($prevIssue && $prevIssue->getId() != $this->getId()) {
			$this->setPrevRejected();
		}
	}


	// 根据提交的 status 信息，处理各个级别的状态
	public function handleDecision() {

		$agencyIssue	= $this->getAgencyIssue();

		$baseId		= $this->getBaseId();

		// 得到绑定的 Issue 数组
		$arrGroup	= IssuePeer::getGroupedIssue($baseId);

		$currentStatus	= $this->getStatus();

		// 用于记录 progress 的目的 Issue
		$targetIssue	= null;

		// Rejectted
		// 驳回，设置 prev 的 status 为 Rejectted
		if (IssuePeer::STATUS_REJECTTED == $currentStatus) {

			$prevIssue	= $this->getFriendIssue('prev');
			if ($prevIssue) {
				$prevIssue->setStatus(IssuePeer::STATUS_REJECTTED);
				$prevIssue->save();
			}

		#	$agencyIssue->setStatus(IssuePeer::STATUS_REJECTTED);
		#	$agencyIssue->save();

			$targetIssue	= $prevIssue;
		}

		// Submitted
		// 提交，设置 next 的 status 为 Default
		if (IssuePeer::STATUS_SUBMITTED == $currentStatus) {
			$nextIssue	= $this->getFriendIssue('next');
			if ($nextIssue) {
				$nextIssue->setStatus(IssuePeer::STATUS_DEFAULT);
				$nextIssue->save();
			}

			$targetIssue	= $nextIssue;
		}



		if ($targetIssue) {
			$string		= sprintf("[%s] %s to [%s]",
						IssuePeer::getTypeString($this->getType()),
						IssuePeer::getStatusString($currentStatus),
						IssuePeer::getTypeString($targetIssue->getType())
					);
			$agencyIssue->setProgress($string);
		}

		if (IssuePeer::STATUS_TERMINATED == $currentStatus) {
			$agencyIssue->setStatus(IssuePeer::STATUS_TERMINATED);
			$agencyIssue->setProgress('已终止');
		}

		$agencyIssue->save();

	}

	public function getAgencyIssue() {

		$baseId		= $this->getBaseId();

		// 得到绑定的 Issue 数组
		$arrGroup	= IssuePeer::getGroupedIssue($baseId);

		$strIndexType	= IssuePeer::getTypeString(IssuePeer::TYPE_AGENCY, 2);

		return	isset($arrGroup[$strIndexType]) ? $arrGroup[$strIndexType] : null;
	}

	// 获取上下级 Issue
	public function getFriendIssue($act = 'next') {

		$baseId		= $this->getBaseId();

		// 得到绑定的 Issue 数组
		$arrGroup	= IssuePeer::getGroupedIssue($baseId);

		$intFriendType	= $this->getFriendType($act);

		// Agency, Support, Division
		$strIndexType	= IssuePeer::getTypeString($intFriendType, 2);

		return	isset($arrGroup[$strIndexType]) ? $arrGroup[$strIndexType] : null;
	}

	// 获取上下级 Issue Type
	public function getFriendType($act = 'next') {

		$arrMap		= array(

				IssuePeer::TYPE_AGENCY	=> array(
						'prev'	=> IssuePeer::TYPE_AGENCY,
						'next'	=> IssuePeer::TYPE_SUPPORT,
					),
				IssuePeer::TYPE_SUPPORT	=> array(
						'prev'	=> IssuePeer::TYPE_AGENCY,
						'next'	=> IssuePeer::TYPE_DIVISION,
					),
				IssuePeer::TYPE_DIVISION	=> array(
						'prev'	=> IssuePeer::TYPE_SUPPORT,
						'next'	=> IssuePeer::TYPE_DIVISION,
					),

		);

		return	$arrMap[$this->getType()][$act];

	}








/*

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

	public function doTerminate($action) {
		if ('terminated' == $action->getRequestParameter('save_type')) {
			$this->setType($this->typeLevel);
		}
	}
*/


}
