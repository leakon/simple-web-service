<?php

class AdminSession extends SimpleSymfonyUser {

	protected

		$cookieConf	= array(
					'path'		=> '/',
					'domain'	=> SofavConf::ADMIN_COOKIE_DOMAIN
				),

		$cookieName	= 'sf_admin_sign',			// SimpleCookie，不要与 storage 的 session_name 搞混，这一点很重要！！！
		$cookieToken	= 'sf_admin_sign/Symfony';		// 命名空间

	public function getUserInfo($userId) {
		$userRecord		= new Sofav_Data_User($userId);
		return	$userRecord;
	}

	protected function onLoggedIn($objUserRecord) {

		$mail		= $objUserRecord->mail;

		// 1577808000	= 2020-01-01
	#	$this->mySetCookie('mail', $userInfo['mail'], 1577808000);
		$this->mySetCookie('mail', $mail, 1577808000);

		// 登录的时候重新设置证书（credential）
		// 检查登录用户白名单
		if (Sofav_Data_User::isAdmin($mail)) {
			$this->myAddCredential(SofavConf::ADMIN_CREDENTIAL);
		}

		return;
	}

}