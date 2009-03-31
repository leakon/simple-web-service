<?php

/**
 * SofavDB_Table class: categories
 * auto generated at 2009-04-01 00:33:37
 */

class Table_categories extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("categories");

			$arrColumns	= array(
						'parent_id',
						'order_num',
						'name',
					);

		$this->hasColumns($arrColumns);

	}

}
