<?php

/**
 * SofavDB_Table class: articles
 * auto generated at 2009-04-01 00:33:37
 */

class Table_articles extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("articles");

			$arrColumns	= array(
						'category_id',
						'view_cnt',
						'published',
						'created_at',
						'title',
						'pic',
						'keyword',
						'view_group',
						'detail',
					);

		$this->hasColumns($arrColumns);

	}

}
