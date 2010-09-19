<?php

class UserSession extends SimpleSymfonyUser {

	protected

		$cookieConf	= array(
					'path'		=> '/',
					'domain'	=> ProjConf::USER_COOKIE_DOMAIN
				),

		$cookieName	= 'ccake_sign',			// SimpleCookie，不要与 storage 的 session_name 搞混，这一点很重要！！！
		$cookieToken	= 'ccake/Symfony';		// 命名空间

	public function getUserInfo($userId) {
		$userRecord		= new Table_data_user($userId);
		return	$userRecord;
	}

	protected function onLoggedIn($objUserRecord) {

		$mail		= $objUserRecord->mail;

		// 1577808000	= 2020-01-01
	#	$this->mySetCookie('mail', $userInfo['mail'], 1577808000);
		$this->mySetCookie('mail', $mail, 1577808000);

		return;
	}

}