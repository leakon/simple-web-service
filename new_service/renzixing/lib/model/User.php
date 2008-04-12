<?php

/**
 * Subclass for representing a row from the 'sf_user' table.
 *
 *
 *
 * @package lib.model
 */
class User extends BaseUser
{
	public function setPassword($pass) {

		parent::setPassword(UserPeer::encryptPassword($pass));

	}
}
