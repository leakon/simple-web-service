<?php

/**
 * SofavDB_Table class: data_menu
 * auto generated at 2011-08-06 14:24:37
 */

class Table_data_menu extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("data_menu");

			$arrColumns	= array(
						'lang',
						'category',
						'pid',
						'title',
						'price',
						'sort_id',
					);

		$this->hasColumns($arrColumns);

	}
	
	
	public static function getList($lang = '') {
		
		$objCriteria	= new SofavDB_Criteria();
		
		if (strlen($lang)) {
			
			$objCriteria->bind(
						array(
							'lang'	=> $lang,
						)
					);
					
		}
		
		$arrResult	= SofavDB_Record_SE::findAll('Table_data_menu', $objCriteria, false);
			
		$arrResult	= Array_Util::toKeyIndexed($arrResult, 'id');
	
		return	$arrResult;
		
	}
	

}
