<?php

/**
 * SofavDB_Table class: data_session
 * auto generated at 2010-09-19 21:47:59
 */

class Table_data_session extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("data_session");

			$arrColumns	= array(
						'user_id',
						'sess_time',
						'sess_id',
						'sess_data',
					);

		$this->hasColumns($arrColumns);

	}

}
