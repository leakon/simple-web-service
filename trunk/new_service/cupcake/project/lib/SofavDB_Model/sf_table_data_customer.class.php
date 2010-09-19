<?php

/**
 * SofavDB_Table class: data_customer
 * auto generated at 2010-09-19 23:07:00
 */

class Table_data_customer extends SofavDB_Table {

	const
		STATUS_OK	= 1000;

	public function initialize() {

		$this->setTableName("data_customer");

			$arrColumns	= array(
						'name',
						'mobile',
						'address',
						'receive_time',
						'order_id',
						'status',
					);

		$this->hasColumns($arrColumns);

	}

	public static function confirmOrder($strOrderID) {

		$objCustomer		= new Table_data_customer();
		$objCustomer->order_id	= $strOrderID;

		$objMatchCustomer	= SofavDB_Record::match($objCustomer);

		if ($objMatchCustomer->id) {
			$objMatchCustomer->status	= self::STATUS_OK;
			$objMatchCustomer->save();
		}

	}

}
