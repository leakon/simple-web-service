<?php

/**
 * payment actions.
 *
 * @package    cupcake
 * @subpackage payment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class paymentActions extends sfActions
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



	// 创建支付宝订单
	public function executeCreateAlipay($request) {

		$this->strOrderID	= $request->getParameter('orderID', '');
		$this->strBankID	= $request->getParameter('bankID', '');

		$arrParameters		= $request->getParameterHolder()->getAll();

		Debug::pr($arrParameters);

		// 获取订单信息


		$objOrder		= new Table_data_order();

		$objOrder->order_id	= $this->strOrderID;

		$objMatchOrder		= SofavDB_Record::match($objOrder);

		$fltTotalFee		= 0.00;

		if ($objMatchOrder->id) {

			$fltTotalFee	= (float) $objMatchOrder->total;

		} else {


		}

		// $subject, $body, $show_url, $out_trade_no, $total_fee

		$arrOrderInfo		= array(

						'out_trade_no'		=> $this->strOrderID,
						'subject'		=> 'CupCake',
						'body'			=> 'CupCake Body',

						'show_url'		=> 'cart/view?cart_id=' . $this->strOrderID,
						'total_fee'		=> $fltTotalFee,


					);


		$this->strPayUrl	= Alipay::genPayUrl($arrOrderInfo);

		return	sfView::NONE;

	}




}
