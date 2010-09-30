<?php

/**
 * @package Model_Accounts
 *
 * 帐户模块
 *
 */


/**
 * 帐户模块
 *
 */
class Model_Accounts {

	const
		ERROR_MAIL_PASSWORD_MISMATCH		= 1000,		// 邮箱和密码不匹配
		ERROR_NOT_ACTIVATED			= 2000,		// 帐户未激活
		ERROR_MAIL_NOT_EXIST			= 3000,		// 邮件不存在
		ERROR_SET_ACTIVATED_FAILED		= 4000,		// 设置激活失败
		VERSION					= '';

	/**
	 * 验证邮件地址是否存在
	 *
	 * @param string	$mail	邮箱
	 *
	 * @return bool		true: 存在
	 			false: 不存在
	 */
	public static function isMailExist($mail) {

		$objRecord		= new Table_data_user();
		$objRecord->mail	= $mail;

		$objFound		= SofavDB_Record::match($objRecord);

		return	$objFound->id > 0;

	}


	/**
	 * 用户登录，并设置属性
	 *
	 * @param string	$strMail		邮箱
	 * @param string	$strRawPassword		原始密码
	 * @param string	$objUser		用户对象
	 * @param string	$request		WebRequest对象
	 *
	 * @return	arrReturn
	 */
	public static function signIn($strMail, $strRawPassword, $objUser = false, $request = false) {

		$arrRet		= self::checkSignIn($strMail, $strRawPassword);

		// 如果登录成功，并设置了用户对象
		if (Util::isRetOK($arrRet) && $objUser) {

			$intUserId	= $arrRet['user_id'];

			self::signInByUserId($intUserId, $objUser, $request);


		}

		return	$arrRet;

	}



	/**
	 * 根据用户 ID 设置登录，并设置属性
	 *
	 * @param int		$intUseriD		用户 ID
	 * @param string	$objUser		用户对象
	 * @param string	$request		WebRequest对象
	 *
	 * @return bool		成功返回 true 否则返回 fales
	 */
	public static function signInByUserId($intUserId, $objUser = false, $request = false) {

		$bool		= false;

		// 如果设置了用户对象
		if ($objUser) {

			// 设置 Session 和 Cookie
			$objUser->setLoggedIn($intUserId);

			$objUser->setFlash('signInSuccess', true);

			$bool	= true;

		}

		return	$bool;

	}



	/**
	 * 检查用户登录
	 * <1> 匹配用户名密码
	 * <2> 检查用户状态（是否已激活）
	 *
	 * @param string	$strMail		用户邮箱
	 * @param string	$strRawPassword		原始密码
	 *
	 * @return array	$arrReturn	Util::getReturn()
	 */
	public static function checkSignIn($strMail, $strRawPassword) {

		$arrReturn		= Util::getReturn();
		$arrReturn['user_id']	= 0;
		
		try {
			
			$tableUser		= new Table_data_user();

			$tableUser->mail	= $strMail;
			$tableUser->password	= Table_data_user::makePassword($strRawPassword);

			$objUserRecord		= SofavDB_Record::match($tableUser);
			
		#	Debug::pr($objUserRecord);
			
			if (empty($objUserRecord->id)) {
				
				throw new Exception(sprintf("Mail and password is not match"), 1000);
			}

			$arrReturn['user_id']	= $objUserRecord->id;

		} catch (Exception $exception) {
			
			$arrReturn['errno']	= $exception->getCode();
			
		}
		
	#	Debug::pre($arrReturn);

		return	$arrReturn;

	}






}

