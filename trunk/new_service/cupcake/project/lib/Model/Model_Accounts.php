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

/*
			// 设置 Session 和 Cookie
			$objUser->setLoggedIn($intUserId);

			$objUser->setFlash('signInSuccess', true);

			// 如果设置了 WebRequest对象
			if ($request) {

				$strRememberMe	= $request->getParameter('remember_me', '0');

				// 记录登录状态
				if ('1' == $strRememberMe) {
					$objUser->setRememberMe();
				}

			}
*/


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

			// 如果设置了 WebRequest对象
			if ($request) {

				$strRememberMe	= $request->getParameter('remember_me', '0');

				// 记录登录状态
				if ('1' == $strRememberMe) {
					$objUser->setRememberMe();
				}

			}

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

			if (empty($objUserRecord->id)) {
				throw new SofavException(self::ERROR_MAIL_PASSWORD_MISMATCH, sprintf("Mail and password is not match"));
			}

			$arrReturn['user_id']	= $objUserRecord->id;


			// 密码匹配，检查用户激活状态
			if (!$objUserRecord->isActivated()) {
				throw new SofavException(self::ERROR_NOT_ACTIVATED, sprintf("Account is not activated"));
			}

		} catch (SofavException $exception) {

			$exception->writeToReturn($arrReturn);

		}

		return	$arrReturn;

	}



	/**
	 * 激活指定 $strSign 的帐户
	 *
	 * @param string	$strSign	用户签名
	 *
	 * @return array	$arrReturn	Util::getReturn()
	 			包含 user_id 字段，默认为 0，激活成功返回用户ID
	 */
	public static function activate($strSign) {

		$arrReturn		= Util::getReturn();
		$arrReturn['user_id']	= 0;

		try {

			$tableUser		= new Table_data_user();

			$tableUser->sign	= $strSign;

			$arrRecords		= SofavDB_Record::matchAll($tableUser);

			$intTotal		= count($arrRecords);

			// 如果匹配的总数不唯一，则抛出异常
			if (1 !== $intTotal) {

				if (0 == $intTotal) {
					// 找不到匹配的 sign
					throw new SofavException(self::ERROR_MAIL_PASSWORD_MISMATCH, sprintf("Could NOT find matching sign"));
				} else {
					// 找到多个 sign
					throw new SofavException(self::ERROR_MAIL_PASSWORD_MISMATCH,
							sprintf("Found %d matching signs, expected one", $intTotal));

				}

			}

			// 密码匹配，检查用户激活状态
			if ($arrRecords[0]->isActivated()) {
				throw new SofavException(self::ERROR_NOT_ACTIVATED, sprintf("Account is already activated"));
			}

			// 设置用户为已激活
			if (!$arrRecords[0]->setActivated()) {
				throw new SofavException(self::ERROR_SET_ACTIVATED_FAILED, sprintf("Failed to set to activated"));
			}

			// 设置用户ID
			$arrReturn['user_id']	= $arrRecords[0]->id;

		} catch (SofavException $exception) {

			$exception->writeToReturn($arrReturn);

		}

		return	$arrReturn;
	}



	/**
	 * 封装创建用户的逻辑
	 *
	 * <1> User 表创建新记录
	 * <2> 与邀请码创建人关联
	 * <3> 发送验证邮件
	 *
	 * @param array		$arrInfo	用户信息数组
	 			必须包含下列元素
	 						homepage
	 						username
	 						mail
	 						password	(原始密码)
	 *
	 * @return array	$arrReturn	Util::getReturn()
	 */
	public static function create($arrInfo) {

		$arrReturn		= Util::getReturn();

		try {
			// <1>
			$objUser		= new Table_data_user();

			$objUser->homepage	= $arrInfo['homepage'];
			$objUser->username	= $arrInfo['username'];
			$objUser->mail		= $arrInfo['mail'];

			$objUser->setPassword($arrInfo['password']);
		#	$objUser->password	= Table_data_user::setPassword($arrInfo['password']);

			$intUserId		= $objUser->save();

			if (!$intUserId) {
				throw new SofavException(1000, sprintf("[Model_Accounts::create] Create user record failed"));
			}


			// <2>
			Model_Invitation::accept($arrInfo['serial'], $intUserId);


			// <3>
			// 加入邮件发送队列
			TaskActivationMail::add($objUser->toArray());


		} catch (SofavException $exception) {

			$exception->writeToReturn($arrReturn);
			$strLog		= sprintf("Errno[%d]	Error[%s]",
							$exception->getCode(), $exception->getMessage());
			MyLog::doLog($strLog, 'message', 'Error');

		#	Debug::pr(SofavDB_Debug_PDO::getTimer());
		#	Debug::pre($arrReturn);


		}

		return	$arrReturn;

	}



	/**
	 * 重新发送验证邮件
	 *
	 * <1> 验证用户 mail 是否存在
	 * <2> 并且状态是未激活
	 * <3> 发送验证邮件
	 *
	 * @param string	$strMail	用户邮箱
	 *
	 * @return array	$arrReturn	Util::getReturn()
	 */
	public static function reSendActivateMail($strMail) {

		$arrReturn		= Util::getReturn();

		try {

			// <1>
			$tableUser		= new Table_data_user();

			$tableUser->mail	= $strMail;

			$objUserRecord		= SofavDB_Record::match($tableUser);

			if (empty($objUserRecord->id)) {
				throw new SofavException(self::ERROR_MAIL_NOT_EXIST, sprintf("Mail is not exists"));
			}


			// <2>
			// 如果帐户已激活，则不必再发邮件
			if ($objUserRecord->isActivated()) {
				throw new SofavException(self::ERROR_MAIL_NOT_EXIST, sprintf("Account already activated"));
			}


			// <3>
			// 加入邮件发送队列
			TaskActivationMail::add($objUserRecord->toArray());


		} catch (SofavException $exception) {

			$exception->writeToReturn($arrReturn);
			$strLog		= sprintf("Errno[%d]	Error[%s]",
							$exception->getCode(), $exception->getMessage());
			MyLog::doLog($strLog, 'message', 'Error');

		#	Debug::pr(SofavDB_Debug_PDO::getTimer());
		#	Debug::pre($arrReturn);


		}

		return	$arrReturn;

	}


}

