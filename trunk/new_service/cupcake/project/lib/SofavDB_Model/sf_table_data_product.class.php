<?php

/**
 * SofavDB_Table class: data_product
 * auto generated at 2010-09-22 00:10:42
 */

class Table_data_product extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("data_product");

			$arrColumns	= array(
						'category',
						'lang',
						'name',
						'abstract',
						'detail',
						'special',
						'pic',
						'price',
						'quantity',
					);

		$this->hasColumns($arrColumns);

	}

}
