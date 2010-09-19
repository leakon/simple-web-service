<?php

/**
 * SofavDB_Table class: data_order
 * auto generated at 2010-09-18 17:16:36
 */

class Table_data_order extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("data_order");

			$arrColumns	= array(
						'order_id',
						'total',
						'status',
						'created_at',
						'updated_at',
					);

		$this->hasColumns($arrColumns);

	}

}
