<?php

class userPasswordValidator extends sfValidator {

	public function initialize($context, $parameters = null) {
		parent::initialize($context);

		// set defaults
		$this->setParameter('password_error', '');
		$this->getParameterHolder()->add($parameters);

		return true;
	}

	public function execute(&$password, &$error) {

		// check user password
		if (!UserPeer::checkPassword(sfContext::getInstance()->getUser()->getUsername(), $password)) {
			$error	= $this->getParameterHolder()->get('password_error');
			return	false;
		}

		return	true;
	}

}