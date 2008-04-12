<?php

/**
 * Common user interface
 */
class mySimpleUser extends sfBasicSecurityUser {

	const
		NS_MEMBER	= 'member',		// name space of member
		PASSPORT_NAME	= 'passport',		// cookie name of passport
		PASSPORT_TOKEN	= 'SofavPassPortTK',
		VERSION		= '2008-04-05';

	// constructor
	public function initialize($context, $parameters = null) {

		// initialize parent
		parent::initialize($context, $parameters);

		$session	= $this->isAuthenticated() ? 1 : 0;	// 2 ^ 0
		$passport	= $this->validatePassport() ? 2 : 0;	// 2 ^ 1

		$status		= $session + $passport;

		$GLOBALS['status_codes_glb']	= $status;

		switch ($status) {

			case	0 :		// session and passport are both invalid
				$this->clearSession();
				break;

			case	1 :		// session is OK but passport is invalid
				$this->setPassport();
				break;

			case	2 :		// passport is OK but session is invalid
				$this->relaySession();
				break;

			case	3 :		// session and passport are both OK
				break;

		}

		return	$context;

	}

	// call me when user has just successfully loged in
	public function setLoggedIn($userId) {

		$userInfo	= UserPeer::getSessionInfo($userId);

		if (!empty($userInfo['id']) && !empty($userInfo['username'])) {

			// set user login status
			$this->setAuthenticated(true);

			// set credential, member is default
			$this->addCredential(self::NS_MEMBER);

			$this->setAttribute('id', $userInfo['id'], self::NS_MEMBER);
			$this->setAttribute('username', $userInfo['username'], self::NS_MEMBER);

			$this->setPassport();

			return	true;

		}

		return	false;

	}

	// clear session and passport
	public function clearSession() {
		$response	= $this->getContext()->getResponse();
		$response->setCookie(self::PASSPORT_NAME, '', 0);	// 0 = 1970-01-01
		$this->setAuthenticated(false);
		$this->clearCredentials();
		$this->clearAttributes();
		return	true;
	}

	// clear session but reserve passport (leave the chance to get username from cookie)
	public function logOut() {
		$response	= $this->getContext()->getResponse();
		$userId		= $this->getId();
		$response->setCookie(self::PASSPORT_NAME, substr(md5(rand(0, 999)), 0, 16) . $userId, 1577808000);	// 1577808000 = 2020-01-01
		$this->setAuthenticated(false);
		$this->clearCredentials();
		$this->clearAttributes();
		return	true;
	}

	public function getId() {
		return	$this->getAttribute('id', 0, self::NS_MEMBER);
	}

	public function getUsername() {
		return	$this->getAttribute('username', '', self::NS_MEMBER);
	}

	// following are private method

	private function setPassport() {

		$randString	= rand(0, 99999) . $_SERVER['REQUEST_TIME'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'];
		$firstPart	= substr(md5($randString), 0, 8);

		$fromString	= $this->getId() . $firstPart . self::PASSPORT_TOKEN;
		$secondPart	= substr(md5($fromString), 0, 8);

		$setString	= $firstPart . $secondPart . $this->getId();

		$response	= $this->getContext()->getResponse();
		$response->setCookie(self::PASSPORT_NAME, $setString, 1577808000);	// 1577808000 = 2020-01-01

	}

	// validate passport cookie, return userId if it is valid
	private function validatePassport() {

		$request	= $this->getContext()->getRequest();
		$passport	= $request->getCookie(self::PASSPORT_NAME, '');

		if (strlen($passport) > 16) {

			$firstPart	= substr($passport, 0, 8);
			$secondPart	= substr($passport, 8, 8);
			$userId		= intval(substr($passport, 16, 8));

			if ($secondPart == substr(md5($userId . $firstPart . self::PASSPORT_TOKEN), 0, 8)) {
				return	$userId;
			}
		}

		return	false;
	}

	// validate passport from cookie when session is timeout, get user info by id and reset passport
	private function relaySession() {

		if ($userId = $this->validatePassport()) {
			return	$this->setLoggedIn($userId);
		}

		return	false;
	}

	// clear id and username from session
	private function clearAttributes() {
		$this->setAttribute('id', 0, self::NS_MEMBER);
		$this->setAttribute('username', '', self::NS_MEMBER);
		return	true;
	}

}
