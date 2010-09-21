<?php

/**
 * SofavDB_Table class: data_cart
 * auto generated at 2010-09-19 21:47:59
 */

class Table_data_cart extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("data_cart");

			$arrColumns	= array(
						'cart_id',
						'user_id',
						'created_at',
					);

		$this->hasColumns($arrColumns);

	}
	
	public static function calcCartSum($strCartID, $strField = 'cart_id', $strTable = 'Table_data_cart_detail') {
		
		$criteria	= new SofavDB_Criteria(sprintf('WHERE @where'));
		$arrParam	= array(
					'cart_id'	=> $strCartID,
				);
		$arrResult	= SofavDB_Record_SE::findAll('Table_data_cart_detail', $criteria->bind($arrParam), false);

		$fltTotal	= 0.00;

		foreach ($arrResult as $key => $val) {

			$fltTotal		+= (float) $val['total'];

		}
		
		$intTotal	= (int) $fltTotal;
		
		if ($intTotal > 0) {
			
		} else {
			$intTotal	= 0;
		}
		
		return	$intTotal;
		
		
	}

}
