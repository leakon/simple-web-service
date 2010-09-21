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
