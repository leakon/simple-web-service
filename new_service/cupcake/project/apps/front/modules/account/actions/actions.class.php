<?php

/**
 * account actions.
 *
 * @package    cupcake
 * @subpackage account
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class accountActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  
  

	/**
	 * ��֤�û���¼��Ϣ���ɹ������õ�¼״̬
	 *
	 */
	public function executeAuthorize($request) {

		$mail		= $request->getParameter('mail', '');
		$password	= $request->getParameter('password', '');
		$last_url	= $request->getParameter('last_url', '');

		$arrRet		= Model_Accounts::signIn($mail, $password, $this->objUser, $request);

		// ��¼�ɹ�
		if (Util::isRetOK($arrRet)) {

			if (strlen($last_url)) {
				return	$this->redirect($last_url);
			} else {
				return	$this->redirect('accounts/index?msg=signInSuccess');
			}

		} else {
			// ��¼ʧ��

			if (Model_Accounts::ERROR_MAIL_PASSWORD_MISMATCH == $arrRet['errno']) {

				$request->setError('error_message', SofavErrorMessage::ACCOUNTS_MAIL_PASSWORD_MISMATCH);

			} else if (Model_Accounts::ERROR_NOT_ACTIVATED == $arrRet['errno']) {

				$request->setError('error_message', SofavErrorMessage::ACCOUNTS_MAIL_NOT_ACTIVATED);
				$request->setError('error_code', Model_Accounts::ERROR_NOT_ACTIVATED);

			}

			return	$this->forward('accounts', 'signIn');
		}
	}

	// �˳���¼
	public function executeSignOut($request) {
		$this->objUser->setLoggedOut();
		$this->redirect('@homepage?msg=signOut');
	}
  
  
  
  
}
