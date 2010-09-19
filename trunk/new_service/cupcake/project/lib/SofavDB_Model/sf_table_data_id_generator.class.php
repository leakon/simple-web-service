<?php

/**
 * SofavDB_Table class: data_id_generator
 * auto generated at 2010-09-19 21:47:59
 */

class Table_data_id_generator extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("data_id_generator");

			$arrColumns	= array(
						'name',
						'uniq_id',
					);

		$this->hasColumns($arrColumns);

	}

}
