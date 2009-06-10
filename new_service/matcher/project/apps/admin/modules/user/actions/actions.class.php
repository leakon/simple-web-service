<?php

class userActions extends sfActions {
#class userActions extends BaseBrandActions {

	public function preExecute() {

	#	parent::preExecute();
	#	$this->type		= 1;

		$userId		= $this->getUser()->getId();

		$action		= $this->getContext()->getActionName();

		if ($userId) {

			$arrRedirectHome	= array(
					'index'		=> 1,
				);

			if (isset($arrRedirectHome[$action])) {
				return	$this->redirect('@homepage');
			}
		}


		$this->strModuleName	= $this->getContext()->getModuleName();
		$this->dataClass	= 'Table_data_user';
		$this->brandName 	= '用户';
		$this->strCName		= '姓名';

	}

	public function executeIndex(sfWebRequest $request) {

	}

	public function executeAuthorize($request) {

		$username	= $request->getParameter('username', '');
		$password	= $request->getParameter('password', '');
		$refer		= $request->getParameter('refer', '');

		$userId		= Table_data_user::getValidUserId($username, $password);

		if ($userId) {

			$userObject	= $this->getUser();
			$userObject->setLoggedIn($userId);

		#	if ('1' == $rememberMe) {
		#		$userObject->setRememberMe();
		#	}

			$this->getUser()->setFlash('loginSuccess', true);


			return	$this->redirect('/matcher/admin/index.php');
		#	return	$this->redirect('user/index');

		#	if (strlen($refer)) {
		#		return	$this->redirect($refer);
		#	} else {
		#		return	$this->redirect('/?msg=loginSuccess');
		#	}

		}

		$this->getUser()->setFlash('sign_in_username', $username);

		return	$this->redirect('user/index?msg=pass_error');


	#	$this->redirect('account/index?msg=loginFailed');

		$parameters	= array(
					'msg'		=> 'loginFailed',
					'last_url'	=> $refer
				);
		ActionsUtil::redirect('user/index', $parameters);

	}

	public function executeLogout(sfWebRequest $request) {

		$this->getUser()->setLoggedOut();

		$this->redirect('user/index');

	}

	public function executeError(sfWebRequest $request) {

	}

	public function executeList(sfWebRequest $request) {

		$this->setLayout('layout');

		$this->getIndexData($request);

	}


	protected function getIndexData(sfWebRequest $request) {

		$tableDataTag		= new $this->dataClass();

		$this->pager		= new SofavDB_Pager($tableDataTag);

		$where			= array();
		$order			= array('id' => 'DESC');

		$page			= (int) $request->getParameter('page', 1);
		$this->pager->init($page, sfConfig::get('app_page_size', 5), array('where' => $where, 'order' => $order));

		$this->arrResult	= $this->pager->getResults();

		$this->dataItem		= new $this->dataClass();

		$this->hasErrors	= $request->hasErrors();
		if ($this->hasErrors) {
			$arrParameters		= $request->getParameterHolder()->getAll();
			$this->dataItem->fromArray($arrParameters);
		}

	}

	public function executeSaveProfile($request) {
		$this->executeSave($request);
	}

	public function handleErrorSaveProfile() {
		$request	= $this->getRequest();
		$from		= $request->getParameter('from', 'list');
		$this->forward('user', $from);
	}

	public function executeSave($request) {

		ActionsUtil::needPOST($request);		// 必须是 POST 方法

		$arrParameters		= $request->getParameterHolder()->getAll();

		$bool			= false;
		$tagId			= (int) $request->getParameter('id', 0);
		$tagItem		= new $this->dataClass($tagId);

		if (isset($arrParameters['password']) && 0 == strlen($arrParameters['password'])) {
			unset($arrParameters['password']);
		}

		$tagItem->fromArray($arrParameters);

		$bool			= $tagItem->save();

		$parameters		= array();
	#	$parameters['saved']	= intval($bool);

		$refer			= $request->getParameter('refer');
		$refer			= false;

		$uri			= sprintf('%s/%s', $this->strModuleName, $request->getParameter('from', 'index'));

		if ($tagId) {
			$uri	.= '?id=' . $tagId;
		}


		return	ActionsUtil::redirect($uri, $parameters, $refer);

	}

	public function handleErrorSave() {
		$request	= $this->getRequest();
		$from		= $request->getParameter('from', 'list');
		$this->forward('user', $from);
	}

	public function executeEdit($request) {

		$this->setLayout('layout');

		$_data_class		= $this->dataClass;

		$tagId			= (int) $request->getParameter('id', 0);

		$this->dataItem		= new $_data_class($tagId);

	}

	public function executePassword($request) {

		$this->setLayout('layout');

		$_data_class		= $this->dataClass;

		$this->dataItem		= new $_data_class($this->getUser()->getId());

	}

	public function executeSavePassword($request) {

		ActionsUtil::needPOST($request);		// 必须是 POST 方法

		$old_pass	= $request->getParameter('old_pass', '');
		$password	= $request->getParameter('password', '');
		$confirm	= $request->getParameter('confirm', '');

		$tableUser	= new $this->dataClass($this->getUser()->getId());

		if ($tableUser->id && $tableUser->isValidPassword($old_pass)) {

			$tableUser->setPassword($password);

			$this->getUser()->setFlash('message', $tableUser->save());

			return	$this->redirect('user/password');


		} else {


			$request->setError('old_pass', '原始密码不正确');

			return	$this->forward('user', 'password');

		}

		return	ActionsUtil::redirect($uri, $parameters, $refer);

	}

	public function handleErrorSavePassword() {
		$this->forward('user', 'password');
	}

	public function executeDelete($request) {

		ActionsUtil::needPOST($request);		// 必须是 POST 方法

		$bool			= false;
		$tagId			= (int) $request->getParameter('id', 0);
		$_data_class		= $this->dataClass;

		if ($tagId) {


			$tagItem		= new $_data_class($tagId);

			if ($tagItem->id) {

				if (1 == $tagItem->type) {

					return	$this->redirect($this->strModuleName . '/list?msg=adminCannotDelete');

				} else {

					$bool			= $tagItem->delete();
				}

			}

			$result			= $bool ? 'Success' : 'Failure';

		#	$this->redirect($this->strModuleName . '/index');
		}

		$parameters		= array();
	#	$parameters['deleted']	= intval($bool);

		$refer			= $request->getParameter('refer');
	#	$refer			= false;

		return	ActionsUtil::redirect($this->strModuleName . '/index', $parameters, $refer);
	}



	public function executeFrameTop($request) {
		$this->setLayout('layout_frame');
	}
	public function executeFrameLeft($request) {
		$this->setLayout('layout_frame');
	}
	public function executeFrameFoot($request) {
		$this->setLayout('layout_frame');
	}




}
