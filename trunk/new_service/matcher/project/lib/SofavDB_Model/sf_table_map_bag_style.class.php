<?php

/**
 * SofavDB_Table class: map_bag_style
 * auto generated at 2009-05-21 21:33:24
 */

class Table_map_bag_style extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("map_bag_style");

			$arrColumns	= array(
						'bag_id',
						'style_id',
					);

		$this->hasColumns($arrColumns);

	}

}
