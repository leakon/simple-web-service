<?php

/**
 * Leakon
 *
 * @package	Symfony 1.2
 * @author	Leakon <leakon@gmail.com>
 * @version	2009-02-22
 * @notice	add comment, cookieName is a secret cookie for relay session, do NOT use it as the session_name of storage.
 *
 * Simple user interface for Symfony PHP Framework
 */


/*
********************************
********************************
**** usage begin

	1	define your class extends SimpleSymfonyUser
	2	modify $nameSpace, $cookieName and $cookieToken to suit your application
	3	implement getUserInfo($userId) method to retriev user info by user id
	4	when user logged in, call setLoggedIn($userId)
	5	when user logged out, call setLoggedOut() or clearSession()

**** usage end
********************************
********************************
*/

abstract class SimpleSymfonyUser extends sfBasicSecurityUser {

	protected static
		$objSFResponse		= false;	// symfony Response object

	// "member" is default credential of an registered user.
	protected

		$nameSpace		= 'member',		// 命名空间
		$cookieName		= 'simCuki',		// SimpleCookie，不要与 storage 的 session_name 搞混，这一点很重要！！！
		$cookieToken		= 'SimpleCookieTK',
		$cookieRemember		= 'remember_me',

		$intLenSecretId		= 7,	// should be 7, max user id = 0xF000000, modify this value is deprecated
		$intLenSecretCheck	= 16,	// should be [16 - 32]
		$intLenSecretLeft	= 16,	// should be [16 - 32]
		$intLenSecretRight	= 32,	// should be [16 - 32]
		// cookie value length: $this->intLenSecretLeft + $this->intLenSecretId + $this->intLenSecretRight + $this->intLenSecretCheck
		// sub class modify the $intLenSecretCheck, $intLenSecretLeft and $intLenSecretRight to suit their application

		$cookieConf		= array(),
		$property		= array(),

		// 用户属性列表，用户登录的时候从数据库中读取下列字段，保存到 session 中
		$arrAttributeList	= array('id', 'username', 'mail'),

		$version		= '';

	public
		$authStatus		= 0;

	//********************************
	//********************************
	//**** public call methods begin

	/**
	 * Get user info by intval userId.
	 * Need to be implemented in child class.
	 *
	 * @return	instance of user data class
	 * @notice	properties returned from getUserInfo can be retrieved by $this->get($key)
	 */
	abstract function getUserInfo($userId);

	protected function onLoggedIn($objUserRecord) {}

	public function getId() {
		return	$this->isAuthenticated() ? $this->getAttribute('id', 0, $this->nameSpace) : 0;
	}

	public function getUsername() {
		return	$this->isAuthenticated() ? $this->getAttribute('username', '', $this->nameSpace) : '';
	}

	public function get($key, $default = '') {
		return	$this->isAuthenticated() ? $this->getAttribute($key, $default, $this->nameSpace) : '';
	}

	// Constructor, corresponding to Symfony 1.1
	public function initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array()) {

		// initialize parent
		parent::initialize($dispatcher, $storage, $options);

		if (!isset($this->cookieConf['path'])) {
			$this->cookieConf['path']	= '/';
		}
		if (!isset($this->cookieConf['domain'])) {
			$this->cookieConf['domain']	= '';
		}
		if (!isset($this->cookieConf['secure'])) {
			$this->cookieConf['secure']	= false;
		}
		if (!isset($this->cookieConf['httpOnly'])) {
			$this->cookieConf['httpOnly']	= false;
		}

		$session		= $this->isAuthenticated() ? 1 : 0;	// 2 ^ 0
		$arrCookieResult	= $this->validateSecretCookie();
		$cookie			= $arrCookieResult['valid'] ? 2 : 0;	// 2 ^ 1

		$status			= $session + $cookie;
		$this->authStatus	= $status;

		switch ($status) {

		#	case	0 :		// Session: 0	Cookie: 0
			#	$this->clearSession();
			#	break;

			case	1 :		// Session: 1	Cookie: 0
				$this->sendCookie();
				break;

			case	2 :		// Session: 0	Cookie: 1
				// should check "rememberMe" from cookie to decide whether to relay session
				// and check userId fetched from cookie
				if ($this->issetRememberMe() && !empty($arrCookieResult['id'])) {
					$this->relaySession($arrCookieResult['id']);
				}
				break;

		#	case	3 :		// Session: 1	Cookie: 1
		#		break;

		}

	}

	/**
	 * 延续 session
	 *
	 * 使用现有的 session，并设置为已登录
	 * Use EXISTING session and set it authenticated with credential
	 *
	 * this method is user for grant session from other session management
	 * which means user's session is valid and should be granted under symfony framework
	 */
	public function relaySession($userId) {

		$objUserRecord	= $this->getUserInfo($userId);

		if (!empty($objUserRecord->id) && !empty($objUserRecord->username)) {

			$this->onLoggedIn($objUserRecord);

			if (true !== $this->authenticated) {
				$this->authenticated	= true;
			}
			if (!$this->hasCredential($this->nameSpace)) {
				$this->credentials[]	= $this->nameSpace;
			}

			// 从用户对象中获取指定的 3 个字段的值
			foreach ($this->arrAttributeList as $strKey) {
				if (isset($objUserRecord->$strKey)) {
					$this->setAttribute($strKey, $objUserRecord->$strKey, $this->nameSpace);
				}
			}

			$this->sendCookie();

			return	true;
		}

		return	false;
	}


	/**
	 * 设置证书，避免重新生成 session id
	 *
	 */
	public function myAddCredential($credential) {
		if (!in_array($credential, $this->credentials)) {
			$this->credentials[]	= $credential;
		}
		return	true;
	}

	/**
	 * 设置登录状态
	 *
	 * 重新创建 session，并用 session_name 指定的字段名写入到 cookie
	 * 仅应在用户登录流程中调用本方法
	 *
	 * call me when user has just successfully logged in
	 * this method is only suitable for login action
	 * which means user doesn't have a valid session, this method will generate a new one
	 */
	public function setLoggedIn($userId) {
		// 登录的时候为什么要重新设置 session_id ? (2009-11-25)
	#	$this->storage->regenerate(false);
		return	$this->relaySession($userId);
	}

	// clear session but preserve cookie (leave the chance to get username from cookie)
	public function setLoggedOut() {
		$this->clearCredentials();
		$this->clearAttributes();
		$this->setAuthenticated(false);		// 这一步调用，重新生成了 session_id

		// rememberMe
		if ($this->issetRememberMe()) {
			$this->removeRememberMe();
		}
	}

	// clear session and cookie
	public function clearSession() {
		$this->destroyCookie();
	}

	//**** public call methods end
	//********************************
	//********************************


	// ******** [[Generator]] ********
	// the biggest user id cain be 251658240 = 0xF000000 (7 bytes hex)
	protected function genSecretCookieFromUserId($intUserId) {

		$strCheck	= substr(md5($intUserId . $this->cookieToken), 0, $this->intLenSecretCheck);

		$randString	= rand(0, 9999999) . $this->cookieToken . $_SERVER['REQUEST_TIME'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'];

		// First, get $this->intLenSecretLeft bytes hex string
		$leftPart	= substr(md5($randString), 0, $this->intLenSecretLeft);

		$arrRes		= $this->makeSecret($leftPart);
		$rightPart	= $arrRes['right_part'];

		// subtract user id, the final int number is zero or positive (>= 0)
		$secretId	= dechex($arrRes['secret_base'] - $intUserId);

		$len		= strlen($secretId);

		if ($len < $this->intLenSecretId) {
			$count		= $this->intLenSecretId - $len;
			$secretId	= str_repeat('0', $count) . $secretId;
		}

		// Final, return combination string = left + secret + right + check
		return	$leftPart . $secretId . $rightPart . $strCheck;
	}

	// ******** [[Validator]] ********
	/**
	 * validate secret cookie and retrieve userId
	 *
	 * @return:
		$arrRet	= array(
			'valid'	=> true,
			'id'	=> 1234
			)
	 */
	protected function validateSecretCookie() {
		// get cookie from client browser
		$secretCookie	= sfContext::getInstance()->getRequest()->getCookie($this->cookieName, '');
		return	$this->validateSecret($secretCookie);
	}

	protected function validateSecret($secret) {

		// get cookie from client browser
		$secretCookie		= $secret;

		$boolRightPartValid	= false;
		$boolIdCheckValid	= false;

		// default return value
		$arrRet		= array(
					'valid'	=> false,
					'id'	=> 0,
				);

		if (!$secretCookie) {
			return	$arrRet;
		}

		// retrieved values from cookie
		$pos				= 0;
		$arrRetrieved			= array();
		$arrRetrieved['left_part']	= substr($secretCookie, $pos, $this->intLenSecretLeft);
		$pos += $this->intLenSecretLeft;

		$arrRetrieved['secret_part']	= substr($secretCookie, $pos, $this->intLenSecretId);
		$pos += $this->intLenSecretId;

		$arrRetrieved['right_part']	= substr($secretCookie, $pos, $this->intLenSecretRight);
		$pos += $this->intLenSecretRight;

		$arrRetrieved['check_part']	= substr($secretCookie, $pos);

		// figure out the expected result
		$arrExpected			= $this->makeSecret($arrRetrieved['left_part']);

		$arrRetrieved['user_id']	= intval($arrExpected['secret_base'] - hexdec($arrRetrieved['secret_part']));

		$encryptedCheckString		= substr(md5($arrRetrieved['user_id'] . $this->cookieToken), 0, $this->intLenSecretCheck);

		// validate the right part of cookie
		if ($arrRetrieved['right_part'] === $arrExpected['right_part']) {
			$boolRightPartValid	= true;
		}

		// validate the right part of cookie
		if ($encryptedCheckString === $arrRetrieved['check_part']) {
			$boolIdCheckValid	= true;
		}

		if ($arrRetrieved['user_id'] > 0 && true === $boolRightPartValid && true === $boolRightPartValid) {
			$arrRet['id']		= $arrRetrieved['user_id'];
			$arrRet['valid']	= true;
		}

		return	$arrRet;
	}

	private function makeSecret($strLeftPart) {

		// use $leftPart to generate a new $this->intLenSecretRight bytes hex string
		$rightPart	= substr(md5($strLeftPart . $this->cookieToken), 0, $this->intLenSecretRight);

		// generate secretId
		$secretPart	= substr($rightPart, 0, $this->intLenSecretId);	// from pos[0] to pos[6] (7 chars)
		// make sure the first $this->intLenSecretId bytes of right part not less than 0xF000000 (>= 251658240)
		$secretPart[0]	= 'f';
		$secretBase	= hexdec($secretPart);		// convert to decade number

		return		array(
			'right_part'	=> $rightPart,		// string
			'secret_base'	=> $secretBase		// int
		);
	}

	private function destroyCookie() {
		// 404438400	= 1982-10-26 08:00
		return		$this->mySetCookie($this->cookieName, '', 404438400);
	}

	private function sendCookie() {
		$secretCookie	= $this->genSecretCookieFromUserId($this->getId());
		// 1577808000	= 2020-01-01
		return		$this->mySetCookie($this->cookieName, $secretCookie, 1577808000);
	}

	// clear id and username from session
	private function clearAttributes() {
		$this->setAttribute('id', 0, $this->nameSpace);
		$this->setAttribute('username', '', $this->nameSpace);
		$this->getAttributeHolder()->clear();
	}

	protected function issetRememberMe() {
		return		'1' == sfContext::getInstance()->getRequest()->getCookie($this->cookieRemember, '0');
	}

	public function setRememberMe() {
		// 1577808000	= 2020-01-01
		return		$this->mySetCookie($this->cookieRemember, '1', 1577808000);
	}

	public function removeRememberMe() {
		// 1577808000	= 2020-01-01
		return		$this->mySetCookie($this->cookieRemember, '0', 1577808000);
	}

	protected function mySetCookie($name, $value, $expire = null) {
		if (false === self::$objSFResponse) {
			self::$objSFResponse	= sfContext::getInstance()->getResponse();
		}

	#	只有测试的时候才需要记录日志
	#	$strLog		= sprintf("Name[%s]	Value[%s]	Path[%s]	Domain[%s]",
	#					$name, $value, $this->cookieConf['path'], $this->cookieConf['domain']);
	#	MyLog::doLog($strLog, 'message', 'SetCookie');

		return	self::$objSFResponse->setCookie($name, $value, $expire,
								$this->cookieConf['path'], $this->cookieConf['domain'],
								$this->cookieConf['secure'], $this->cookieConf['httpOnly']);
	}


	/**
	 * 公有的设置 cookie 的方法
	 * 这样可以与其他 cookie 共用相同的 path, domain 等配置
	 */
	public function setUserCookie($name, $value, $expire = null) {
		return	$this->mySetCookie($name, $value, $expire);
	}



}

