<?php

/**
 * SofavDB_Table class: data_cart_detail
 * auto generated at 2010-09-19 21:47:59
 */

class Table_data_cart_detail extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("data_cart_detail");

			$arrColumns	= array(
						'cart_id',
						'product_id',
						'quantity',
						'price',
						'total',
					);

		$this->hasColumns($arrColumns);

	}

}
