<?php

/**
 * SofavDB_Table class: data_cart
 * auto generated at 2010-09-19 21:47:59
 */

class Table_data_cart extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("data_cart");

			$arrColumns	= array(
						'cart_id',
						'user_id',
						'created_at',
					);

		$this->hasColumns($arrColumns);

	}

}
