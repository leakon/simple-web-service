<?php

class userNameValidator extends sfValidator {

	public function initialize($context, $parameters = null) {
		parent::initialize($context);

		// set defaults
		$this->setParameter('exists_error', '');
		$this->setParameter('chars_error', '');
		$this->getParameterHolder()->add($parameters);

		return true;
	}

	public function execute(&$username, &$error) {

		// check username character
		if (!UserPeer::isValidUsername($username)) {
			$error	= $this->getParameterHolder()->get('chars_error');
			return	false;
		}

		// check user existence
		if (UserPeer::userExists($username)) {
			$error	= $this->getParameterHolder()->get('exists_error');
			return	false;
		}

		return	true;
	}

}