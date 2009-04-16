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
						'published_at',
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

	public function isPublished() {
		return	$this->published == 1;
	}

	public static function getByCategory($categoryId = 0, $limit = 10, $option = null) {

		$objArticle			= new Table_articles();
		$objArticle->category_id	= $categoryId;

		$arrWhere			= array(
							'category_id'	=> $categoryId
						);

		if (isset($option['published'])) {
			$arrWhere['published']	= $option['published'];
		}

		$critera			= new SofavDB_Criteria(' WHERE @where ORDER BY published_at DESC LIMIT 0, ' . $limit);
		$critera->bind($arrWhere, 'AND', '@where');

		$arrArticles			= SofavDB_Record::findAll($objArticle, $critera, false);

		return	$arrArticles;

	}

}
