<?php

/**
 * SofavDB_Table class: data_order_detail
 * auto generated at 2010-09-18 17:16:36
 */

class Table_data_order_detail extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("data_order_detail");

			$arrColumns	= array(
						'order_id',
						'product_id',
						'quantity',
						'price',
						'total',
					);

		$this->hasColumns($arrColumns);

	}

}
