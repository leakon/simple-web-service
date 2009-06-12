<?php

/**
 * SofavDB_Table class: categories
 * auto generated at 2009-04-05 13:49:21
 */

class Table_categories extends SofavDB_Table {

	public function initialize() {

		$this->setTableName("categories");

			$arrColumns	= array(
						'type',
						'parent_id',
						'order_num',
						'name',
						'pic',
						'banner_pic',
						'description',
					);

		$this->hasColumns($arrColumns);

	}

	public static function getByParent($parentId = 0, $arrConf = false) {

		$limit		= isset($arrConf['limit']) ? $arrConf['limit'] : 10;
		$type		= isset($arrConf['type']) ? $arrConf['type'] : CnroConstant::CATEGORY_TYPE_ALL;
		$toArray	= isset($arrConf['to_array']) ? $arrConf['to_array'] : false;

		$objCategory			= new Table_categories();
		$objCategory->parent_id		= $parentId;
		// show all category
		if (CnroConstant::CATEGORY_TYPE_ALL != $type) {
			$objCategory->type		= $type;
		}


		$arrCategories			= SofavDB_Record::matchAll($objCategory, !$toArray);

		if ($toArray) {
			$arrCategories			= ArrayUtil::sortColumn($arrCategories, 'order_num');
		} else {
			$arrCategories			= ArrayUtil::sortProperty($arrCategories, 'order_num');
		}

		$arrRet		= array();
		foreach ($arrCategories as $key => $val) {

			if ($limit-- > 0) {
				$arrRet[$key]	= $val;
			} else {
				break;
			}

		}

		return	$arrRet;

	}

	// 倒序排列，第一个元素是一级分类，第N个元素是N级分类
	public static function getCategoryPath($cateId) {

		$arrRet		= array();

		if ($cateId) {

			$found		= true;

			while ($found) {

				$tableCategory	= new Table_categories($cateId);

				if ($tableCategory->id) {
					$arrRet[$cateId]	= $tableCategory->toArray();
				}

				if ($tableCategory->parent_id) {
					$cateId		= $tableCategory->parent_id;
					$found		= true;
				} else {
					$found		= false;
				}

			}

		}

		// 倒序排列，第一个元素是一级分类，第N个元素是N级分类
		return	array_reverse($arrRet, true);

	#	return	$arrRet;

	}

	public static function getChildQty($arrCategories) {

		$arrQty		= array();

		foreach ($arrCategories as $catId => $catInfo) {

			$id			= $catInfo['id'];
			$model			= new Table_categories();
			$model->parent_id	= $id;
			$arrRes			= SofavDB_Record::matchAll($model, false);

			$arrQty[$catId]		= count($arrRes);

		}

		return	$arrQty;

	}

	public static function getChildQtyObj($arrCategories) {

		$arrQty		= array();

		foreach ($arrCategories as $catId => $catInfo) {

			$id			= $catInfo->id;
			$model			= new Table_categories();
			$model->parent_id	= $id;
			$arrRes			= SofavDB_Record::matchAll($model, false);

			$arrQty[$catId]		= count($arrRes);

		}

		return	$arrQty;

	}

	public static function getAll() {

		$objCategory			= new Table_categories();
		$critera			= new SofavDB_Criteria('');
		$arrCategories			= SofavDB_Record::findAll($objCategory, $critera, false);

		$arrRet		= array();
		foreach ($arrCategories as $key => $val) {

			$arrRet[$val['id']]	= $val;

		}

		return	$arrRet;

	}

	public static function getAllByType($type) {

		// show all category
		$objCategory			= new Table_categories();
		$objCategory->type		= $type;
		$arrCategories			= SofavDB_Record::matchAll($objCategory, false);

		$arrRet		= array();
		foreach ($arrCategories as $key => $val) {
			$arrRet[$val['id']]	= $val;
		}

		return	$arrRet;

	}


	public static function getAllChildern($id) {

		$arrCategories			= array();

		$objCategory			= new Table_categories();
		$objCategory->parent_id		= $id;
		$arrCategories			= SofavDB_Record::matchAll($objCategory, false);

		$arrCategories			= Array_Util::ColToPlain($arrCategories, 'id', 'name');

		if (count($arrCategories)) {

			$arrTmp		= array();
			foreach ($arrCategories as $id => $null) {

				$arr		= call_user_func(array('Table_categories', 'getAllChildern'), $id);

				foreach ($arr as $id_2 => $name_2) {
					$arrTmp[$id_2]	= $name_2;
				}


			}

			foreach ($arrTmp as $id => $name) {
				$arrCategories[$id]	= $name;
			}

		}

		return	$arrCategories;

	}


	public static function getPlain($id) {

		$option				= array('limit' => 1000);
		$option['to_array']		= true;
		$option['type']			= CnroConstant::CATEGORY_TYPE_PROD_RANGE;
		$arrObjSubCate			= Table_categories::getByParent($id, $option);

		Array_Util::sortColumn($arrObjSubCate, 'order_num');

		$arrSubCategories		= Array_Util::ColToPlain($arrObjSubCate, 'id', 'name');

		return	$arrSubCategories;

	}


}
