<?php

/**
 * SofavDB_Table class: categories
 * auto generated at 2009-04-05 13:49:21
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

	public static function getByParent($parentId = 0, $limit = 10) {

		$objCategory			= new Table_categories();
		$objCategory->parent_id		= $parentId;

		$arrCategories			= SofavDB_Record::matchAll($objCategory);

		$arrCategories			= ArrayUtil::sortProperty($arrCategories, 'order_num');

		$arrRet		= array();
		foreach ($arrCategories as $key => $val) {

			if ($limit-- > 0) {
				$arrRet[$key]	= $val;
			} else {
				break;
			}

		}

		return	$arrRet;

	}

}
