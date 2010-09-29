<?php

/**
 * SofavDB_Table class: data_product
 * auto generated at 2010-09-22 00:10:42
 */

class Table_data_product extends SofavDB_Table {
	
	const
		CATEGORY_NORMAL		= 100,		// 普通
		CATEGORY_SPECIAL	= 200,		// 打折
		VER			= 1;
		
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

	public static function getAllProducts() {
		
		$arrResult	= SofavDB_Record_SE::findAll('Table_data_product', new SofavDB_Criteria(), false);
			
		$arrResult	= Array_Util::toKeyIndexed($arrResult, 'id');
	
		return	$arrResult;
		
	}
	
}
