<?php

/**
 * account actions.
 *
 * @package    forest
 * @subpackage account
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class accountActions extends sfActions
{
	public function preExecute() {

		$this->setLayout(false);

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


	#	$this->redirect('accounts/index?msg=loginFailed');

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

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	}

	public function handleErrorCreate() {

		$this->forward('account', 'signUp');

	}

}
