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

}
