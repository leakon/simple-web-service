<?php

/**
 * SofavDB_Table class: data_model
 * auto generated at 2009-05-21 11:06:12
 */

class Table_data_model extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("data_model");

			$arrColumns	= array(
						'product_id',
						'price_id',
						'caliber_id',
						'style_id',
						'type',
						'created_at',
						'name',
						'style',
						'link',
						'pic',
						'weight',
						'caliber',
						'min',
						'max',
						'detail',
						'serial',
					);

		$this->hasColumns($arrColumns);

	}



	public static function getResult($arrWhere) {

		$objWhere	= new Table_data_model();

		foreach ($arrWhere as $key => $val) {

			$objWhere->$key		= $val;

		}

		$arrResult	= SofavDB_Record::matchAll($objWhere, false);

		return		$arrResult;

	}

	/**
	 * 生成用于 option 的数组
	 * 遍历 $arrResult，选其中的 2 个字段分别作为 key 和 val
	 * 生成新数组
	 */
	public static function getOption($arrResult, $key, $val) {

		return		Array_Util::ColToPlain($arrResult, $key, $val);

	}


	public static function getTags($productId) {

		$arrWhere		= array();
		$arrWhere['type']	= MatcherConstant::BRAND_TYPE_TAG;		// 标签
		$arrWhere['product_id']	= $productId;					// 产品ID
		$arrResult		= Table_data_model::getResult($arrWhere);

		$arrTags		= self::getOption($arrResult, 'id', 'name');

		return			$arrTags;

	}



}
