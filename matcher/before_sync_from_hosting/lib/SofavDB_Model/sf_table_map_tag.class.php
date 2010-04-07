<?php

/**
 * SofavDB_Table class: map_tag
 * auto generated at 2009-05-21 21:33:24
 */

class Table_map_tag extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("map_tag");

			$arrColumns	= array(
						'item_id',
						'tag_id',
					);

		$this->hasColumns($arrColumns);

	}

}
