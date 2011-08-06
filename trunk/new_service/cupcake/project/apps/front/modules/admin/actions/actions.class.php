<?php

/**
 * admin actions.
 *
 * @package    cupcake
 * @subpackage admin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class adminActions extends sfActions
{


	public function executeOrderDetailPass(sfWebRequest $request) {

		$strPass		= $request->getParameter('pass');

		if ('cupcakes' != $strPass) {
			die('None');
		}

		$this->setLayout('layout_pass');
		$this->setTemplate('orderDetail');

		$strOrderID		= $request->getParameter('order_id');

		$this->getDetail($strOrderID);

		// 留空，避免用户支付宝付款后，还提示未付款
		// 仅当支付宝付款，且付款状态为【未付款】时，才设置 empty
		if ($this->arrOrderDetail['pay_method'] == Table_data_order::PAY_METHOD_ALIPAY
			&& $this->arrOrderDetail['status'] == 0) {
			$this->arrOrderDetail['status']		= 'empty';
		}


	}

	protected function getDetail($strOrderID) {

		$this->arrOrderDetail	= Table_data_order::getDetail($strOrderID);

		if (empty($this->arrOrderDetail['order_id'])) {
			$this->renderText('Order not found');
		}


		// 获取客户信息
		$objCustomer		= new Table_data_customer();
		$objCustomer->order_id	= $this->arrOrderDetail['order_id'];

	#	Debug::pr($objCustomer);

		$arrCustomer		= SofavDB_Record::match($objCustomer, false);

		$this->arrOrderDetail['customer_name']		= $arrCustomer['name'];
		$this->arrOrderDetail['customer_mobile']	= $arrCustomer['mobile'];
		$this->arrOrderDetail['customer_address']	= $arrCustomer['address'];
		$this->arrOrderDetail['receive_time']		= $arrCustomer['receive_time'];

	}


	public function executeOrderDetail(sfWebRequest $request) {

		$this->setLayout('admin');

		$strOrderID		= $request->getParameter('order_id');

		$this->getDetail($strOrderID);

	#	Debug::pre($this->arrOrderDetail);

	#	return	sfView::NONE;

	}


	public function executeListOrder(sfWebRequest $request)  {

		$this->setLayout('admin');

		$criteria			= new SofavDB_Criteria(' ORDER BY created_at DESC ');
		$this->arrOrderResult		= SofavDB_Record_SE::findAll('Table_data_order', $criteria, false);
		$this->arrOrderResult		= Array_Util::toKeyIndexed($this->arrOrderResult, 'order_id');

		$criteria			= new SofavDB_Criteria('  ');
		$this->arrProdResult		= SofavDB_Record_SE::findAll('Table_data_product', $criteria, false);
		$this->arrProdResult		= Array_Util::toKeyIndexed($this->arrProdResult, 'id');

		$criteria			= new SofavDB_Criteria('  ');
		$this->arrCustomerResult	= SofavDB_Record_SE::findAll('Table_data_customer', $criteria, false);
		$this->arrCustomerResult	= Array_Util::toKeyIndexed($this->arrCustomerResult, 'order_id');

	#	Debug::pr($this->arrOrderResult);
	#	Debug::pr($this->arrProdResult);
	#	Debug::pr($this->arrCustomerResult);


		$this->arrResult	= array();

		foreach ($this->arrOrderResult as $key => $val) {


			$val['customer_name']		= $this->arrCustomerResult[$key]['name'];
			$val['customer_mobile']		= $this->arrCustomerResult[$key]['mobile'];
			$val['customer_address']	= $this->arrCustomerResult[$key]['address'];
			$val['receive_time']		= $this->arrCustomerResult[$key]['receive_time'];


			$this->arrResult[$key]	= $val;

		}



	#	Debug::pr($this->arrResult);

	}


	public function executeSetMenu(sfWebRequest $request)  {

		$this->setLayout('admin');
		
		$this->strLang		= $request->getParameter('lang', 'en');
		
		$intMenuID		= $request->getParameter('id', '');
		
		$objOneMenu		= new Table_data_menu($intMenuID);
		
		$this->arrEdit		= $objOneMenu->toArray();
		
		if ($this->strLang != 'ch' && $this->strLang != 'en') {
			$this->strLang	= 'en';
		}
		
		if ($this->arrEdit['id'] > 0) {
			$this->strLang	= $this->arrEdit['lang'];
		}
		
	#	Debug::pr($this->arrEdit);
	
		$this->arrCateOptions	= Table_data_category::getOptions($this->strLang);
		
		$this->arrCategories	= Table_data_category::getList();
		
	#	Debug::pr($this->arrCategories);
	
		if ($this->arrEdit['id'] > 0) {
			$this->arrEdit['button']	= '保存';
		} else {
			$this->arrEdit['button']	= '添加';
		}
		
		
		$this->arrResult	= Table_data_menu::getList();
		
	#	Debug::pr($arrList);

	}

	public function executeSaveMenu(sfWebRequest $request)  {

		$intMenuID		= $request->getParameter('id', '');
		
		if ($intMenuID > 0) {
			
			$objOneMenu		= new Table_data_menu($intMenuID);
			
		} else {
			
			$objOneMenu		= new Table_data_menu();
			
		}
		
		$arrParameters		= $request->getParameterHolder()->getAll();
		
	#	Debug::pre($arrParameters);
		
		$objOneMenu->fromArray($arrParameters);
		
		$bool			= $objOneMenu->save();
		
		$parameters	= array(
					'succ'		=> $bool ? 0 : 1,
				);
		ActionsUtil::redirect('admin/setMenu', $parameters);
		

	}


	public function executeDelMenu(sfWebRequest $request)  {
		
		$bool		= false;
		
		$intMenuID	= $request->getParameter('id', '');
			
		if (sfRequest::POST == $request->getMethod() && $intMenuID > 0) {
			
			$objOneMenu		= new Table_data_menu($intMenuID);
			
			$objOneMenu->delete();
		
		}
		
		$parameters	= array(
					'succ'		=> $bool ? 0 : 1,
				);
		ActionsUtil::redirect('admin/setMenu', $parameters);
		
	}








	public function executeSetCategory(sfWebRequest $request)  {

		$this->setLayout('admin');
		
		$intCateID		= $request->getParameter('id', '');
		
		$objOneCategory		= new Table_data_category($intCateID);
		
		$this->arrEdit		= $objOneCategory->toArray();
		
		if ($this->arrEdit['id'] > 0) {
			$this->arrEdit['button']	= '保存';
		} else {
			$this->arrEdit['button']	= '添加';
		}
		
		$this->arrResult	= Table_data_category::getList();
		
	#	Debug::pr($this->arrResult);
	
	

	}

	public function executeSaveCategory(sfWebRequest $request)  {

		$intCateID		= $request->getParameter('id', '');
		
		if ($intCateID > 0) {
			
			$objOneCategory		= new Table_data_category($intCateID);
			
		} else {
			
			$objOneCategory		= new Table_data_category();
			
		}
		
		$arrParameters		= $request->getParameterHolder()->getAll();
		
	#	Debug::pre($arrParameters);
		
		$objOneCategory->fromArray($arrParameters);
		
		$bool			= $objOneCategory->save();
		
		$parameters	= array(
					'succ'		=> $bool ? 0 : 1,
				);
		ActionsUtil::redirect('admin/setCategory', $parameters);
		

	}


	public function executeDelCategory(sfWebRequest $request)  {
		
		$bool		= false;
		
		$intCateID	= $request->getParameter('id', '');
			
		if (sfRequest::POST == $request->getMethod() && $intCateID > 0) {
			
			$objOneCategory		= new Table_data_category($intCateID);
			
			$objOneCategory->delete();
		
		}
		
		$parameters	= array(
					'succ'		=> $bool ? 0 : 1,
				);
		ActionsUtil::redirect('admin/setCategory', $parameters);
		
	}




	public function preExecute() {

		$this->objUser		= $this->getUser();
		$this->intUserId	= $this->objUser->getId();

	}

	public function executeIndex(sfWebRequest $request) {

		if ($this->intUserId > 0) {

			return	$this->redirect('admin/listOrder');

		}

		$this->forward('admin', 'signIn');


	}

	public function executeSignIn(sfWebRequest $request) {
		$this->setLayout('layout_login');
		$this->last_url		= sfConfig::get('accounts_login_last_url', '');
	}

	public function handleErrorAuthorize() {
		$this->forward('admin', 'signIn');
	}

	public function executeAuthorize($request) {

		$mail		= $request->getParameter('username', '');
		$password	= $request->getParameter('password', '');

		try {


			$arrRet		= Model_Accounts::signIn($mail, $password, $this->objUser, $request);

			// 登录成功
			if (Util::isRetOK($arrRet)) {
			} else {
				// 登录失败
				throw new Exception(sprintf("用户名无效或密码错误"), 1030);
			}

		} catch (Exception $exception) {

			$request->setError($exception->getCode(), $exception->getMessage());
			$request->setError('has_error', true);

			return	$this->forward('admin', 'signIn');
		}

		$parameters	= array(
				#	'msg'		=> 'signInSuccess',
				#	'last_url'	=> $this->last_url
				);
		ActionsUtil::redirect('admin/listOrder', $parameters);

	}

	// 退出登录
	public function executeSignOut($request) {
		$this->objUser->setLoggedOut();
		$this->redirect('admin/index');
	}


}
