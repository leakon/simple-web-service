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

	#	Debug::pr($arrParameters);

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

		$show_url		= $this->context->getController()->genUrl('cart/view?cart_id=' . $this->strOrderID, true);

		$arrOrderInfo		= array(

						'out_trade_no'		=> $this->strOrderID,
						'subject'		=> 'CupCake',
						'body'			=> 'CupCake Body',

						'show_url'		=> $show_url,
						'total_fee'		=> $fltTotalFee,

					);

		// 测试的时候付款金额写 0.01
		$arrOrderInfo['total_fee']	= 0.01;

		$this->strPayUrl		= Alipay::genPayUrl($arrOrderInfo);

		return	$this->redirect($this->strPayUrl);

	#	var_dump($this->strPayUrl);

	#	return	sfView::NONE;

	}


	// 创建支付宝订单
	public function executeAlipayReturn($request) {

		return	$this->redirect('cart/finish');

	}


	// 支付宝通知付款情况订单
	public function executeAlipayNotify($request) {

		$bool		= Alipay::verifyNotification($_POST);

		$strReturn	= $bool ? 'success' : 'false';

		return	$this->renderText($strReturn);

	}

}
