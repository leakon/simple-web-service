<?php

/**
 * SofavDB_Table class: articles
 * auto generated at 2009-04-05 13:49:21
 */

class Table_articles extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("articles_en");

			$arrColumns	= array(
						'type',
						'type_id',
						'style_id',
						'category_id',
						'range_id',
						'view_cnt',
						'order_num',
						'published',
						'is_private',
						'index_show',
						'created_at',
						'published_at',
						'title',
						'pic',
						'pic_desc',
						'large_pic',
						'large_pic_desc',
						'keyword',
						'vol_num',
						'vol_num_all',
						'pdf',
						'detail',
						'params',
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
