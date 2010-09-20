<?php

/**
 * SofavDB_Table class: debug_log
 * auto generated at 2010-09-20 21:18:57
 */

class Table_debug_log extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("debug_log");

			$arrColumns	= array(
						'category',
						'object_id',
						'content',
						'created_at',
					);

		$this->hasColumns($arrColumns);

	}

	public static function record($arrData = array()) {
		
		if (isset($arrData['content'])) {
			$arrData['content']	= serialize($arrData['content']);
		}
		
		$objTable	= new Table_debug_log();
		
		$objTable->fromArray($arrData);
		
		$objTable->save();
		
	}
	
}
