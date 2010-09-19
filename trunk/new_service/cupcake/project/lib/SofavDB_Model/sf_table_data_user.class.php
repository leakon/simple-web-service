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
	 * ������������룬�ҵ�ƥ����û� ID
	 *
	 * @param	string	$rawPass	��������
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
	 * ����������ת���� md5
	 *
	 * @param	string	$rawPass	��������
	 * @return	string			md5 �ַ���
	 */
	public static function makePassword($rawPass) {
		return	md5($rawPass);
	}


}
