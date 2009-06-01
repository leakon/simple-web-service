<?php

/**
 * SofavDB_Table class: users
 * auto generated at 2009-06-01 15:22:18
 */

class Table_users extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("users");

			$arrColumns	= array(
						'type',
						'username',
						'password',
						'mail',
						'question',
						'answer',
						'birthday',
						'created_at',
					);

		$this->hasColumns($arrColumns);

	}

	public function setPassword($password) {
		return	$this->password		= md5($password);
	}

	public static function getValidUserId($userName, $rawPass) {

		$tableUser		= new Table_users();

		$tableUser->username	= $userName;
		$tableUser->setPassword($rawPass);

		$userRecord		= SofavDB_Record::match($tableUser, false);

		if (isset($userRecord['id']) && $userRecord['id'] > 0) {
			return	$userRecord['id'];
		} else {
			return	false;
		}

	}


}
