<?php

/**
 * SofavDB_Table class: data_category
 * auto generated at 2011-08-06 14:38:57
 */

class Table_data_category extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("data_category");

			$arrColumns	= array(
						'lang',
						'title',
						'sort_id',
					);

		$this->hasColumns($arrColumns);

	}

	public static function getOptions($lang = '') {
		
		$arrList	= self::getList($lang);
		
		$arrOption	= array();
		
		foreach ($arrList as $oneCate) {
			
			$intCateID		= $oneCate['id'];
			$strTitle		= $oneCate['title'];
			
			$arrOption[$intCateID]	= $strTitle;
			
		}
		
		return	$arrOption;
		
	}
	
	
	public static function getList($lang = '') {
		
		
		if (strlen($lang)) {
			
			$objCriteria	= new SofavDB_Criteria(' WHERE lang = :lang ORDER BY sort_id DESC ');
		
			$objCriteria->bind(
						array(
							'lang'	=> $lang,
						)
					);
					
		} else {
			
			$objCriteria	= new SofavDB_Criteria(' ORDER BY lang DESC, sort_id DESC ');
			
		}
		
	#	Debug::pr($objCriteria);
		
		$arrResult	= SofavDB_Record_SE::findAll('Table_data_category', $objCriteria, false);
			
		$arrResult	= Array_Util::toKeyIndexed($arrResult, 'id');
	
		return	$arrResult;
		
	}
	
	
}
