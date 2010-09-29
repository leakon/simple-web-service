<?php

/**
 * cart actions.
 *
 * @package    cupcake
 * @subpackage cart
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class cartActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
    return $this->redirect('@homepage');
    
  }






	public function executeCreate($request) {

		$arrParameters		= $request->getParameterHolder()->getAll();
	#	Debug::pr($arrParameters);

		$arrProductIDs		= array();

		foreach ((array) $request->getParameter('product_checked', array()) as $intProdID => $null) {

			if ($intProdID > 0 && isset($arrParameters['product_qty'][$intProdID])
				&& $arrParameters['product_qty'][$intProdID] > 0) {

				$arrProductIDs[$intProdID]	= (int) $arrParameters['product_qty'][$intProdID];

			}

		}

		$arrResult	= array();

		if (count($arrProductIDs) > 0) {

			$arrProdIDs	= array_keys($arrProductIDs);
			$criteria	= new SofavDB_Criteria(sprintf('WHERE id IN (%s) ', implode(',', $arrProdIDs)));
			$arrResult	= SofavDB_Record_SE::findAll('Table_data_product', $criteria, false);

		}
		
		$strProductCH		= '';
		$strLangCH		= '';
		if ('ch' == $request->getParameter('lang', '')) {
			$strProductCH		= 'Ch';
			$strLangCH		= '&lang=ch';
		}

		if (count($arrResult)) {

			// 生成唯一的购物车 ID
			$strCartID		= IDGenerator::getFixedID('cart_id');

			foreach ($arrResult as $key => $val) {

				$objCartDetail			= new Table_data_cart_detail();

				$objCartDetail->cart_id		= $strCartID;
				$objCartDetail->product_id	= $val['id'];
				$objCartDetail->quantity	= $arrProductIDs[ $val['id'] ];
				$objCartDetail->price		= $val['price'];
				$objCartDetail->total		= sprintf('%f', $objCartDetail->price * $objCartDetail->quantity);

				$objCartDetail->save();

			}

			$strRedirect	= sprintf('cart/fillAddress?cartID=%s' . $strLangCH, $strCartID);

		} else {

			$strRedirect	= sprintf('product/index'.$strProductCH.'?msg=cartIsEmpty');

		}

		return	$this->redirect($strRedirect);

	#	Debug::pr($this->arrProducts);
	#	Debug::pr($arrResult);
	#	return	sfView::NONE;

	}

	// Step [2]
	// 填写送货信息
	public function executeFillAddress($request) {

		if ('ch' == $request->getParameter('lang', '')) {
			
			$this->setLayout('layout_ch');
			$this->setTemplate('fillAddressCh');
		}


		$this->strCartID	= $request->getParameter('cartID', '');
	
		$this->intTotal		= Table_data_cart::calcCartSum($this->strCartID);
		
		$this->intTotal		= Table_data_order::getDiscount($this->intTotal);
		
	//	var_dump($fltTotal);
	
	}


	// Step [2]
	// 保存送货信息
	public function executeSaveAddress($request) {

/*

	'name',
	'mobile',
	'address',
	'receive_time',
	'order_id',
	'status',

*/

		$strProductCH		= '';
		$strLangCH		= '';
		if ('ch' == $request->getParameter('lang', '')) {
			$strProductCH		= 'Ch';
			$strLangCH		= '&lang=ch';
		}

		$arrParameters		= $request->getParameterHolder()->getAll();

		// 防止 fromArray 的时候 status 字段被非法设置
		if (isset($arrParameters['status'])) {
			unset($arrParameters['status']);
		}

		$objCustomer		= new Table_data_customer();
		
		$arrParameters['name']		= $arrParameters['customer_name'];
		$arrParameters['receive_time']	= $arrParameters['receive_day'] . ' ' . $arrParameters['receive_time'];
		
		
		$objCustomer->fromArray($arrParameters);

		$bool			= $objCustomer->save();

		if ($bool) {

			$strOrderID	= $request->getParameter('order_id', '');

			$strRedirect	= sprintf('cart/selectPayment?orderID=%s' . $strLangCH, $strOrderID);

		} else {

			$strRedirect	= sprintf('product/index'.$strProductCH.'?msg=saveAddressFailed');

		}

		return	$this->redirect($strRedirect);


	#	Debug::pr($objCustomer);

	}


	// Step [3]
	// 选择支付方式
	public function executeSelectPayment($request) {

		if ('ch' == $request->getParameter('lang', '')) {
			
			$this->setLayout('layout_ch');
			$this->setTemplate('selectPaymentCh');
		}

		$this->strOrderID	= $request->getParameter('orderID', '');

		$this->intTotal		= Table_data_cart::calcCartSum($this->strOrderID, 'order_id', 'Table_data_order_detail');
		
		$this->intTotal		= Table_data_order::getDiscount($this->intTotal);
		
	}


	// Step [3]
	public function executePayOrder($request) {

		$strProductCH		= '';
		$strLangCH		= '';
		if ('ch' == $request->getParameter('lang', '')) {
			$strProductCH		= 'Ch';
			$strLangCH		= '&lang=ch';
		}
		
		$this->strOrderID	= $request->getParameter('order_id', '');
		$this->strPayMethod	= $request->getParameter('pay_method', '');


		if (empty($this->strOrderID)) {
			return	$this->redirect('product/index'.$strProductCH.'?msg=payError_EmptyOrderID');
		}

		$arrValidPayMehtods	= array(
						'cash'		=> Table_data_order::PAY_METHOD_CASH,
						'alipay'	=> Table_data_order::PAY_METHOD_ALIPAY,
						'paypal'	=> Table_data_order::PAY_METHOD_PAYPAL,
					);

		if (empty($this->strPayMethod) || empty($arrValidPayMehtods[ $this->strPayMethod ])) {
			return	$this->redirect('product/index'.$strProductCH.'?msg=payError_EmptyPayMethod');
		}
		
		$intPayMethod		= $arrValidPayMehtods[ $this->strPayMethod ];

		// 复制购物车到订单

		$criteria	= new SofavDB_Criteria(sprintf('WHERE @where'));
		$arrParam	= array(
					'cart_id'	=> $this->strOrderID,
				);
		$arrResult	= SofavDB_Record_SE::findAll('Table_data_cart_detail', $criteria->bind($arrParam), false);

	//	Debug::pr($arrParam);
	//	Debug::pr($arrResult);

		// 删除所有已存在的 order detail

		$objOrderDetail		= new Table_data_order_detail();
		$SQL			= sprintf('DELETE FROM %s WHERE order_id = :order_id', $objOrderDetail->getTableName());

		$arrParam	= array(
					'order_id'	=> $this->strOrderID,
				);

		SofavDB_SQL::execute($SQL, $arrParam);

		$fltTotal	= 0.00;

		foreach ($arrResult as $key => $val) {

			$objOrderDetail		= new Table_data_order_detail();

			unset($val['id']);

			$val['order_id']	= $this->strOrderID;

			$fltTotal		+= (float) $val['total'];

			$objOrderDetail->fromArray($val);

			$objOrderDetail->save();

		}

		// 添加订单记录
		// 如果已存在则更新订单
		
		$fltTotal		= Table_data_order::getDiscount($fltTotal);
		
		$objOrder		= new Table_data_order();

		$objOrder->order_id	= $this->strOrderID;

		$objMatchOrder		= SofavDB_Record::match($objOrder);

		if ($objMatchOrder->id) {

			$objMatchOrder->total		= $fltTotal;
			$objMatchOrder->pay_method	= $intPayMethod;
			$objMatchOrder->save();

		} else {

			$objOrder->total		= $fltTotal;
			$objOrder->pay_method		= $intPayMethod;
			$objOrder->save();

		}
		
		// 发邮件
		Table_data_order::sendOrderDetailMail($this->strOrderID);
		

		// 关联客户地址信息
		Table_data_customer::confirmOrder($this->strOrderID);


		$strRedirect		= sprintf('cart/finish'.$strProductCH);

		if ('alipay' == $this->strPayMethod) {

			$strBankID	= $request->getParameter('bank_id', '');

			$strRedirect		= sprintf('payment/createAlipay?orderID=%s', $this->strOrderID);

		}

		return	$this->redirect($strRedirect);

		return	sfView::NONE;

	}

	// 订单完成
	public function executeFinish($request) {
	}
	
	public function executeFinishCh($request) {
		$this->setLayout('layout_ch');
	}

}
