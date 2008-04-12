<?php

/**
 * Subclass for representing a row from the 'sf_issue ' table.
 *
 *
 *
 * @package lib.model
 */
class Issue extends BaseIssue
{

	public function save($con = null) {


		$sfUser	= sfContext::getInstance()->getUser();

		$this->setUserId($sfUser->getId());

		return	parent::save();

	}

	public function setStatus($save_type) {

		$valueOfStatus	= IssuePeer::getStatusBySaveType($save_type);

	#	var_dump($save_type);
	#	var_dump($valueOfStatus);
	#	exit;

		return	parent::setStatus($valueOfStatus);


	}

}
