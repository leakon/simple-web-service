<?php

/**
 * SofavDB_Table class: data_cart
 * auto generated at 2010-09-18 23:42:35
 */

class Table_data_cart extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("data_cart");

			$arrColumns	= array(
						'user_id',
						'product_id',
						'quantity',
						'price',
						'total',
					);

		$this->hasColumns($arrColumns);

	}

}
