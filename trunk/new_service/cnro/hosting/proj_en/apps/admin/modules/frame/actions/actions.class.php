<?php

class frameActions extends sfActions {

	public function executeIndex(sfWebRequest $request) {
	#	$this->forward('default', 'module');
		return	$this->redirect('/admin_en/index.php');
	}

	public function executeMenu(sfWebRequest $request) {
	}

	public function executeMain(sfWebRequest $request) {
		return	$this->redirect('portal/index');
	}


	public function executeLogin(sfWebRequest $request) {

	}

	public function executeSignOut(sfWebRequest $request) {

		$userObject	= $this->getUser();
		$userObject->setLoggedOut();

		return	$this->redirect('/admin_en/index.php');
	}

	public function executeDoLogin($request) {

		$username	= $request->getParameter('username', '');
		$password	= $request->getParameter('password', '');
		$refer		= $request->getParameter('refer', '');

		$userId		= Table_users::getValidUserId($username, $password);

		if ($userId) {

			$userObject	= $this->getUser();
			$userObject->setLoggedIn($userId);
			$userObject->addCredential('admin');

			$this->getUser()->setFlash('loginSuccess', true);

		#	var_dump(123);exit;

			return	$this->redirect('@homepage');

		}

		$this->getUser()->setFlash('loginSuccess', false);
		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	}



	public function executeError404(sfWebRequest $request) {
		return	$this->renderText('Error');
	}


}
