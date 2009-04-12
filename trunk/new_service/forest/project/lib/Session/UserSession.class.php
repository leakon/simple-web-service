<?php

class UserSession extends SimpleSymfonyUser {

	protected

		$cookieConf	= array(
					'path'		=> '/',
					'domain'	=> ''
				),

		$cookieName	= 'forest_secret',		// SimpleCookie
		$cookieToken	= 'forest_secret/Symfony';

	public function getUserInfo($userId) {

	#	$userRecord		= new Sofav_Data_User($userId);
	#	$arrUserInfo		= $userRecord->toArray();

		if (1 == $userId) {
			$arrUserInfo			= array();
			$arrUserInfo['id']		= 1;
			$arrUserInfo['username']	= 'admin';
		}

		$arrRet			= array(
						'id'		=> $arrUserInfo['id'],
						'username'	=> $arrUserInfo['username'],
					//	'mail'		=> $arrUserInfo['mail']
					);

	#	var_dump($arrRet);

		return	$arrRet;
	}

	protected function onLoggedIn($userInfo = array()) {
		// 1577808000	= 2020-01-01
	#	return		$this->mySetCookie('mail', $userInfo['mail'], 1577808000);
	#	return		sfContext::getInstance()->getResponse()->setCookie('mail', $userInfo['mail'], 1577808000);
	#	$this->setAttribute('mail', $userInfo['username'], $this->nameSpace);
	}

}