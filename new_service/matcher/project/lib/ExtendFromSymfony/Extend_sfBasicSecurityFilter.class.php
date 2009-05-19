<?php

class SofavBasicSecurityFilter extends sfBasicSecurityFilter {

	protected function forwardToLoginAction() {
		sfConfig::set('accounts_login_last_url', $this->context->getRequest()->getUri());
		$this->context->getController()->forward(sfConfig::get('sf_login_module'), sfConfig::get('sf_login_action'));
		throw new sfStopException();
	}

}
