<?php

class UserSession extends SimpleSymfonyUser {

	protected

		$cookieConf	= array(
					'path'		=> '/',
					'domain'	=> '.kk.com'
				),

		$cookieName	= 'matcher',			// SimpleCookie����Ҫ�� storage �� session_name ��죬��һ�����Ҫ������
		$cookieToken	= 'matcher/Symfony';		// �����ռ�

	public function getUserInfo($userId) {

		$userRecord		= new Table_data_user($userId);
		$arrUserInfo		= $userRecord->toArray();

		$arrRet			= array(
						'id'		=> isset($arrUserInfo['id']) ? $arrUserInfo['id'] : 0,
						'username'	=> isset($arrUserInfo['username']) ? $arrUserInfo['username'] : '',
						'mail'		=> isset($arrUserInfo['mail']) ? $arrUserInfo['mail'] : ''
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