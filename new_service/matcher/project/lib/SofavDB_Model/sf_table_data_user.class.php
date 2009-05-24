<?php

/**
 * SofavDB_Table class: data_user
 * auto generated at 2009-05-23 11:20:07
 */

class Table_data_user extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("data_user");

			$arrColumns	= array(
						'type',
						'username',
						'password',
						'department',
						'position',
						'telephone',
						'created_at',
					);

		$this->hasColumns($arrColumns);

	}

	public function beforeSave() {
		return	$this->password		= $this->setPassword($this->password);
	}

	public function setPassword($password) {
		return	$this->password		= md5($password);
	}

	public function isValidPassword($rawPass) {
		return	$this->password === md5($rawPass);
	}

	public static function getValidUserId($userName, $rawPass) {

		$tableUser		= new Table_data_user();

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
