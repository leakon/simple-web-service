<?php

/**
 * Subclass for performing query and update operations on the 'sf_user' table.
 *
 *
 *
 * @package lib.model
 */
class UserPeer extends BaseUserPeer
{

	public static function isValidUsername($userName) {
		return	true;
	#	return	!preg_match("/[^a-zA-Z0-9_]/i", $userName);
	}

	public static function userExists($userName) {

		$c		= new Criteria();
		$c->add(self::USERNAME, $userName);
		$user		= UserPeer::doSelectOne($c);

		return		empty($user) ? false : $user;

	}

	public static function getSessionInfo($userId) {

		$arrInfo	= array();

		$c		= new Criteria();
		$c->add(self::ID, $userId);
		$user		= UserPeer::doSelectOne($c);

		if (!empty($user)) {

			$arrInfo['id']		= $user->getId();
			$arrInfo['username']	= $user->getUsername();

		}

		return	$arrInfo;
	}

	public static function checkPassword($userName, $password) {

		$c		= new Criteria();
		$c->add(self::USERNAME, $userName);
		$user		= UserPeer::doSelectOne($c);

		if (!empty($user) && self::encryptPassword($password) == $user->getPassword()) {
			return	$user;
		} else {
			return	false;
		}
	}

	public static function encryptPassword($stringPass) {
		return	md5($stringPass);
	}
}
