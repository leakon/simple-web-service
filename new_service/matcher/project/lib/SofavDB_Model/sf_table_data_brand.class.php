<?php

/**
 * SofavDB_Table class: data_brand
 * auto generated at 2009-05-19 21:22:26
 */

class Table_data_brand extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("data_brand");

			$arrColumns	= array(
						'type',
						'created_at',
						'name',
					);

		$this->hasColumns($arrColumns);

	}

}
