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
						'ext_vol_type',
						'ext_vol_long',
						'ext_vol_wide',
						'ext_vol_flash',
						'ext_vol_notebook',
						'ext_vol_accessory',
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
	 * �������� option ������
	 * ���� $arrResult��ѡ���е� 2 ���ֶηֱ���Ϊ key �� val
	 * ����������
	 */
	public static function getOption($arrResult, $key, $val) {

		if (is_array($val)) {
			return	Array_Util::ColToCom($arrResult, $key, $val);
		} else {

			return	Array_Util::ColToPlain($arrResult, $key, $val);
		}

	}


	public static function getTags($productId) {

		$arrWhere		= array();
		$arrWhere['type']	= MatcherConstant::BRAND_TYPE_TAG;		// ��ǩ
		$arrWhere['product_id']	= $productId;					// ��ƷID
		$arrResult		= Table_data_model::getResult($arrWhere);

		$arrTags		= self::getOption($arrResult, 'id', 'name');

		return			$arrTags;

	}



}
