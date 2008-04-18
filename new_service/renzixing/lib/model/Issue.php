<?php

/**
 * Subclass for representing a row from the 'sf_issue ' table.
 *
 *
 *
 * @package lib.model
 */
class Issue extends BaseIssue {

	// 设置此函数，可以屏蔽自动保存时间的功能
	public function setUpdatedAt($confirm) {
		if ($confirm === true) {
			parent::setUpdatedAt(date('Y-m-d H:i:s'));
		}
	}

	public function save($con = null) {

		$sfUserId	= sfContext::getInstance()->getUser()->getId();
		$issueUserId	= $this->getUserId();

		if (0 == $issueUserId || $issueUserId == $sfUserId) {

			$this->setUserId($sfUserId);
			return	parent::save();

		} else {
			sfContext::getInstance()->getController()->forward('default', 'secure');
			exit;
		}

	}

	public function saveWithOutUser() {
		return	parent::save();
	}

	public function getType() {
		$type	= parent::getType();
		return	empty($type) ? IssuePeer::TYPE_AGENCY: $type;
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

	public function getUploadFiles() {
		return	strlen($this->upload_files) ? unserialize() : array();
	}

	public function setUploadFiles($v) {
		$v	= serialize($v);
		parent::setUploadFiles($v);
	}


	// 处理 办事处
	public function saveEditAgency($action) {

		$contact	= array();
		$contact['contact_name']	= $action->getRequestParameter('contact_name');
		$contact['contact_value']	= $action->getRequestParameter('contact_value');
		$this->setExtra($contact);

		$this->setUpdatedAt(true);
		$this->save();
	}

	// 处理 客服中心
	public function saveEditSupport($action) {

		$contact	= array();
		$contact['verify_result']	= $action->getRequestParameter('verify_result');
		$contact['verify_date']		= $action->getRequestParameter('verify_date');

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

	// 只有是 default 或 rejected 状态，才是编辑模式
	public function inEditMode() {
		return	$this->getStatus() < IssuePeer::STATUS_SUBMITTED;
	}

	public function isEditor() {
		return	$this->getUserId() == sfContext::getInstance()->getUser()->getId();
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

		return	$this->getUserId() > 0;

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
		// 然后删除本条记录和 next item
		if (IssuePeer::STATUS_REJECTTED == $currentStatus) {

			$prevIssue	= $this->getFriendIssue('prev');
			if ($prevIssue) {


				$string		= sprintf("[%s] %s to [%s]",
							IssuePeer::getTypeString($this->getType()),
							IssuePeer::getStatusString($currentStatus),
							IssuePeer::getTypeString($prevIssue->getType())
						);
				$prevIssue->setProgress($string);


				$prevIssue->setStatus(IssuePeer::STATUS_REJECTTED);
			#	$prevIssue->save();
				$prevIssue->saveWithOutUser();
			}

			$prevIssue->deleteForRejection();
			return;


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
			#	$nextIssue->save();
				$nextIssue->saveWithOutUser();
				$targetIssue	= $nextIssue;
			} else {

				/*
				$targetIssue	= new Issue();
				$targetIssue->setParentId($this->getId());
				$targetIssue->setType($this->getFriendType('next'));
				*/

				$targetIssue	= $this->newNextIssue();

				// 不用保存
			#	$targetIssue->save();

			}

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

	#	$agencyIssue->save();
		$agencyIssue->saveWithOutUser();

	}

	// 设置为驳回，则删除针对此条 Issue 的所有后续 Issue
	public function deleteForRejection() {

		$baseId	= $this->getBaseId();

		// 得到 baseId，把所有 parent_id 指向 baseId 的后续 Issue 都删除
		$SQL	= sprintf("DELETE FROM %s WHERE %s = %d AND %s > %d",

						IssuePeer::TABLE_NAME,
						IssuePeer::PARENT_ID,
						$baseId,
						IssuePeer::TYPE,
						$this->getStatus()
				);

	#	var_dump($SQL);exit;

		return	SimpleDB::execute($SQL);

	}

	public function newNextIssue() {

		$nextIssue	= new Issue();

		$nextIssue->setUserId(sfContext::getInstance()->getUser()->getId());
		$nextIssue->setParentId($this->getId());
		$nextIssue->setType($this->getFriendType('next'));

		return	$nextIssue;

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



}
