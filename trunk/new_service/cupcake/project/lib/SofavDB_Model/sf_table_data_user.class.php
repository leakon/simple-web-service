<?php

/**
 * SofavDB_Table class: data_user
 * auto generated at 2010-09-18 17:16:36
 */

class Table_data_user extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("data_user");

			$arrColumns	= array(
						'mail',
						'password',
						'username',
						'created_at',
					);

		$this->hasColumns($arrColumns);

	}


	/**
	 * 根据邮箱和密码，找到匹配的用户 ID
	 *
	 * @param	string	$rawPass	明文密码
	 * @return	int
	 */
	public static function getUserId($userMail, $rawPass) {

		$tableUser		= new Table_data_user();

		$tableUser->mail	= $userMail;
		$tableUser->password	= self::makePassword($rawPass);

		$userRecord		= SofavDB_Record::match($tableUser);

		return	(int) $userRecord->id;
	}

	public function isValidPassword($rawPass) {
		return	$this->password === self::makePassword($rawPass);
	}

	public function setPassword($rawPass) {
		return	$this->password	= self::makePassword($rawPass);
	}

	/**
	 * 把明文密码转换成 md5
	 *
	 * @param	string	$rawPass	明文密码
	 * @return	string			md5 字符串
	 */
	public static function makePassword($rawPass) {
		return	md5($rawPass);
	}


}
