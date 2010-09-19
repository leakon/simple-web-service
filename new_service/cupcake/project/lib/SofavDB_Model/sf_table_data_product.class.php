<?php

/**
 * SofavDB_Table class: data_product
 * auto generated at 2010-09-19 21:47:59
 */

class Table_data_product extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("data_product");

			$arrColumns	= array(
						'name',
						'abstract',
						'detail',
						'pic',
						'price',
						'quantity',
					);

		$this->hasColumns($arrColumns);

	}

}
