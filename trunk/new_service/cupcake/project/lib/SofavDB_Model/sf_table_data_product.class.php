<?php

/**
 * SofavDB_Table class: data_product
 * auto generated at 2010-09-18 17:16:36
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
