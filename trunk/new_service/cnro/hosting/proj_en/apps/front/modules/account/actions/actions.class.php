<?php

/**
 * account actions.
 *
 * @package    cnro
 * @subpackage account
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class accountActions extends sfActions
{
	public function preExecute() {

	#	$this->setLayout(false);
		$this->userId	= $this->getUser()->getId();

	}

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('account', 'signIn');
  }


	public function executeSignIn(sfWebRequest $request) {

		$this->getResponse()->setTitle('用户登陆 中国林业生物质能源网');

	}

	public function executeSignUp(sfWebRequest $request) {


	}

	public function executeSignOut(sfWebRequest $request) {


		$this->getUser()->setLoggedOut();

		$this->redirect('/');

	}


	public function executeAuthorize($request) {

		$username	= $request->getParameter('username', '');
		$password	= $request->getParameter('password', '');
		$rememberMe	= $request->getParameter('remember_me', '');
		$last_url	= $request->getParameter('last_url', '');

		$userId		= Table_users::getValidUserId($username, $password);

		if ($userId) {

			$userObject	= $this->getUser();
			$userObject->setLoggedIn($userId);

			if ('1' == $rememberMe) {
				$userObject->setRememberMe();
			}

			$this->getUser()->setFlash('loginSuccess', true);

			if (strlen($last_url)) {
				return	$this->redirect($last_url);
			} else {
				return	$this->redirect('/?msg=loginSuccess');
			}

		}

		$this->getUser()->setFlash('sign_in_username', $username);

		return	$this->redirect('account/signIn?msg=pass_error');


	#	$this->redirect('account/index?msg=loginFailed');

		$parameters	= array(
					'msg'		=> 'loginFailed',
					'last_url'	=> $last_url
				);
		ActionsUtil::redirect('history/index', $parameters);

	}

	public function executeCreate(sfWebRequest $request) {

		$objUser		= new Table_users();
		$objUser->username	= $request->getParameter('username');
		$objUser->setPassword($request->getParameter('password'));
		$objUser->mail		= $request->getParameter('mail');


		$boolSavedOK	= $objUser->save();

		if ($boolSavedOK) {

			// get user info, set it to user session
		 	$this->getUser()->setLoggedIn($objUser->id);

		} else {

			return	$this->redirect('account/signUp?msg=exist&username=' . $objUser->username);

		}

		return	$this->redirect('/?msg=loggedIn');


		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	}

	public function handleErrorCreate() {

		$this->forward('account', 'signUp');

	}

	public function executePrivate(sfWebRequest $request) {

		$this->getResponse()->setTitle('需要登陆');

	}

	public function executeError(sfWebRequest $request) {

		$this->setLayout(false);

		$this->getResponse()->setTitle('资源不存在');

	}

	public function executeSetting(sfWebRequest $request) {

		$this->getResponse()->setTitle('修改密码');

	}

	public function executeSavePassword($request) {

		$old_pass	= $request->getParameter('old_pass', '');
		$password	= $request->getParameter('password', '');
		$confirm	= $request->getParameter('confirm', '');

		$tableUser	= new Table_users($this->userId);

		$dbPassword	= $tableUser->password;
		$oldPassword	= $tableUser->setPassword($old_pass);

		if ($tableUser->id && $dbPassword == $oldPassword) {

			$tableUser->setPassword($password);

			$this->getUser()->setFlash('message', $tableUser->save());

			return	$this->redirect('account/setting?msg=savePassOK');


		} else {


			$request->setError('old_pass', '原始密码不正确');

			return	$this->forward('account', 'setting');

		}

	}

	public function handleErrorSavePassword() {
		$this->forward('account', 'setting');
	}

}
