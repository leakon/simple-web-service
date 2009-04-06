<?php

/**
 * SofavDB_Table class: articles
 * auto generated at 2009-04-05 13:49:21
 */

class Table_articles extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("articles");

			$arrColumns	= array(
						'category_id',
						'view_cnt',
						'order_num',
						'published',
						'created_at',
						'title',
						'pic',
						'keyword',
						'view_group',
						'vol_num',
						'vol_num_all',
						'detail',
					);

		$this->hasColumns($arrColumns);

	}

}
