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
    $this->forward('default', 'module');
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

		if (count($arrResult)) {

			// ����Ψһ�Ĺ��ﳵ ID
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

			$strRedirect	= sprintf('cart/fillAddress?cartID=%s', $strCartID);

		} else {

			$strRedirect	= sprintf('product/index?msg=cartIsEmpty');

		}

		return	$this->redirect($strRedirect);

	#	Debug::pr($this->arrProducts);
	#	Debug::pr($arrResult);
	#	return	sfView::NONE;

	}

	// Step [2]
	// ��д�ͻ���Ϣ
	public function executeFillAddress($request) {

		$this->strCartID	= $request->getParameter('cartID', '');

	}


	// Step [2]
	// �����ͻ���Ϣ
	public function executeSaveAddress($request) {

/*

	'name',
	'mobile',
	'address',
	'receive_time',
	'order_id',
	'status',

*/


		$arrParameters		= $request->getParameterHolder()->getAll();

		// ��ֹ fromArray ��ʱ�� status �ֶα��Ƿ�����
		if (isset($arrParameters['status'])) {
			unset($arrParameters['status']);
		}

		$objCustomer		= new Table_data_customer();

		$objCustomer->fromArray($arrParameters);

		$bool			= $objCustomer->save();

		if ($bool) {

			$strOrderID	= $request->getParameter('order_id', '');

			$strRedirect	= sprintf('cart/selectPayment?orderID=%s', $strOrderID);

		} else {

			$strRedirect	= sprintf('product/index?msg=saveAddressFailed');

		}

		return	$this->redirect($strRedirect);


	#	Debug::pr($objCustomer);

	}


	// Step [3]
	// ѡ��֧����ʽ
	public function executeSelectPayment($request) {

		$this->strOrderID	= $request->getParameter('orderID', '');

	}


	// Step [3]
	public function executePayOrder($request) {

		$this->strOrderID	= $request->getParameter('order_id', '');
		$this->strPayMethod	= $request->getParameter('pay_method', '');


		if (empty($this->strOrderID)) {
			return	$this->redirect('product/index?msg=payError_EmptyOrderID');
		}

		$arrValidPayMehtods	= array(
						'cash'		=> 1,
						'alipay'	=> 1,
					);

		if (empty($this->strPayMethod) || empty($arrValidPayMehtods[ $this->strPayMethod ])) {
			return	$this->redirect('product/index?msg=payError_EmptyPayMethod');
		}

		// ���ƹ��ﳵ������

		$criteria	= new SofavDB_Criteria(sprintf('WHERE @where'));
		$arrParam	= array(
					'cart_id'	=> $this->strOrderID,
				);
		$arrResult	= SofavDB_Record_SE::findAll('Table_data_cart_detail', $criteria->bind($arrParam), false);

		Debug::pr($arrParam);
		Debug::pr($arrResult);

		//

		return	sfView::NONE;

	}


}