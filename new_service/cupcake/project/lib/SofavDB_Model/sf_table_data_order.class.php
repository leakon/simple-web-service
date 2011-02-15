<?php

/**
 * SofavDB_Table class: data_order
 * auto generated at 2010-09-20 20:37:28
 */

class Table_data_order extends SofavDB_Table {

	const
		PAY_METHOD_CASH		= 1000,		// 现金
		PAY_METHOD_ALIPAY	= 2000,		// 支付宝
		PAY_METHOD_PAYPAL	= 3000,		// Paypal

		STATUS_PAYED_SUCCESS	= 2000,		// 付款成功

		VERSION			= 0;

	public function initialize() {

		$this->setTableName("data_order");

			$arrColumns	= array(
						'order_id',
						'total',
						'status',
						'pay_method',
						'created_at',
						'updated_at',
					);

		$this->hasColumns($arrColumns);

	}

	public static function getDiscount($intTotal) {

		if ($intTotal >= 220) {

			$intDivide	= floor($intTotal / 220);

			$intTotal	-= $intDivide * 56;

		} else if ($intTotal >= 138) {

			$intTotal	-= 23;

		}

		return	$intTotal;

	}


	public static function getDetail($strOrderID) {

		$arrReturn		= array();

		// 获取订单信息
		$objOrder		= new Table_data_order();
		$objOrder->order_id	= $strOrderID;

		$arrOrder		= SofavDB_Record::match($objOrder, false);

	#	Debug::pr($arrOrder);

		if (isset($arrOrder['id'])) {

			$arrMapCategory		= array(

							Table_data_product::CATEGORY_NORMAL	=> 'normal',
							Table_data_product::CATEGORY_SPECIAL	=> 'special',

						);

			// 查询订单详情



			$criteria	= new SofavDB_Criteria(sprintf('WHERE @where'));
			$arrParam	= array(
						'order_id'	=> $strOrderID,
					);

			$arrResult	= SofavDB_Record_SE::findAll('Table_data_order_detail', $criteria->bind($arrParam), false);

			$arrProducts	= Table_data_product::getAllProducts();


			$arrDetail	= array();

			foreach ($arrResult as $val) {

				$intProductID	= $val['product_id'];

				$intCategory	= $arrProducts[$intProductID]['category'];

				$arrOne		= array(

							'product_name'		=> $arrProducts[$intProductID]['name'],
							'category'		=> $arrMapCategory[$intCategory],
							'pic'			=> $arrProducts[$intProductID]['pic'],
							'price'			=> $arrProducts[$intProductID]['price'],
							'quantity'		=> $val['quantity'],
							'special'		=> $arrProducts[$intProductID]['special'],

						);

				$arrDetail[]	= $arrOne;

			}

		#	Debug::pr($arrResult);
		#	Debug::pr($arrProducts);
		#	Debug::pr($arrDetail);

			$arrReturn		= $arrOrder;

			$arrReturn['detail']	= $arrDetail;

		}

	#	Debug::pr($arrReturn);

		return	$arrReturn;

	}


	public static function getOrderHtml($strOrderID) {

		// 获取邮件正文

		// SYMFONY_SERVER_HOST
		$strHost	= SYMFONY_SERVER_HOST;

	//	if (1 || file_exists('F:/usr/ColibriCupcakes/')) {
		if (false !== strpos(SYMFONY_SERVER_HOST, 'www.colibricupcakes.com')) {
			$strHost	= 'colibricupcakes.baolaa.com';
		}

		$strUrl		= sprintf('http://%s/index.php/admin/orderDetailPass/order_id/%s?pass=cupcakes',
						$strHost, $strOrderID);

		$strHtml	= file_get_contents($strUrl);

		$log		= sprintf("order_id[%s]	url[%s]",
					$strOrderID, $strUrl);
		MyLog::doLog($log);

		/*
		*/
		return	$strHtml;

	}

	public static function sendOrderDetailMail($strOrderID) {

		$strHtml	= self::getOrderHtml($strOrderID);

		$address	= array(
					'leakon@hotmail.com',
					'info@colibricupcakes.com',
				);

		$title		= sprintf('Order [%s] COLIBRI Cup Cakes', $strOrderID);
		$res		= MailWork::send($address, $title, $strHtml);

	}

}
