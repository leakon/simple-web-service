<?php

class UserSession extends SimpleSymfonyUser {

	protected

		$cookieConf	= array(
					'path'		=> '/',
					'domain'	=> '.mysofav.com'
				),

		$cookieName	= 'sofav2008',			// SimpleCookie，不要与 storage 的 session_name 搞混，这一点很重要！！！
		$cookieToken	= 'sofav2008/Symfony';		// 命名空间

	public function getUserInfo($userId) {

		$userRecord		= new Sofav_Data_User($userId);
		$arrUserInfo		= $userRecord->toArray();

		$arrRet			= array(
						'id'		=> $arrUserInfo['id'],
						'username'	=> $arrUserInfo['username'],
						'mail'		=> $arrUserInfo['mail']
					);

		return	$arrRet;
	}

	protected function onLoggedIn($userInfo = array()) {
		// 1577808000	= 2020-01-01
		return		$this->mySetCookie('mail', $userInfo['mail'], 1577808000);
	#	return		sfContext::getInstance()->getResponse()->setCookie('mail', $userInfo['mail'], 1577808000);
	#	$this->setAttribute('mail', $userInfo['username'], $this->nameSpace);
	}

}