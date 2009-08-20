<?php

/**
 * SofavDB_Table class: messages
 * auto generated at 2009-06-02 10:38:15
 */

class Table_messages extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("messages");

			$arrColumns	= array(
						'gender',
						'is_published',
						'created_at',
						'remote_addr',
						'name',
						'location',
						'mail',
						'phone',
						'title',
						'message',
					);

		$this->hasColumns($arrColumns);

	}

}
