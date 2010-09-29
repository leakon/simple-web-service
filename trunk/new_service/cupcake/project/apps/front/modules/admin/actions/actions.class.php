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
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
#    $this->forward('default', 'module');
  }
  	
  	
	public function executeOrderDetailPass(sfWebRequest $request) {
		
		$strPass		= $request->getParameter('pass');
		
		if ('cupcakes' != $strPass) {
			die('None');
		}
		
		$this->setLayout('layout_pass');
		$this->setTemplate('orderDetail');
		
		$strOrderID		= $request->getParameter('order_id');
		
		$this->getDetail($strOrderID);
		
		
	}
	
	protected function getDetail($strOrderID) {
		
		$this->arrOrderDetail	= Table_data_order::getDetail($strOrderID);
		
		if (empty($this->arrOrderDetail['order_id'])) {
			$this->renderText('Order not found');
		}
		
		
		// 获取客户信息
		$objCustomer		= new Table_data_customer();
		$objCustomer->order_id	= $this->arrOrderDetail['order_id'];
		
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

}
