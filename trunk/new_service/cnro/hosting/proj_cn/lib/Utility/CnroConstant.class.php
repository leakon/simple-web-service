<?php

class CnroConstant {

	const
		CATEGORY_TYPE_ALL		= -1982,	// 所有分类

		CATEGORY_TYPE_NEWS		= 100,		// 信息分类
		CATEGORY_TYPE_PRODUCT		= 200,		// 产品分类
		CATEGORY_TYPE_PROD_RANGE	= 220,		// 产品应用领域

		CATEGORY_TYPE_PROD_TYPE		= 400,		// 设备类别
		CATEGORY_TYPE_PROD_STYLE	= 500,		// 设备型号


	#	ARTICLE_TYPE_NEWS		= 1200,		// 文章
	#	ARTICLE_TYPE_PRODUCT		= 2200,		// 产品
	#	ARTICLE_TYPE_RANGE		= 3200,		// 应用领域

		VERSION				= '';



	public static function getProducts() {

		$arrRet		= array(

				self::BRAND_TYPE_CAMERA		=> '相机',
				self::BRAND_TYPE_LENS		=> '镜头',
				self::BRAND_TYPE_STAND		=> '脚架',
				self::BRAND_TYPE_BAG		=> '摄影包',
				self::BRAND_TYPE_FILTER		=> '滤镜',
				self::BRAND_TYPE_HOLDER		=> '云台',

				);

		return		$arrRet;

	}

	public static function getVolumns() {


		$arrWhere		= array();
		$arrWhere['type']	= MatcherConstant::BRAND_TYPE_CAMERA_STYLE;		// 相机型号
		$arrResult		= Table_data_model::getResult($arrWhere);
		$arrCameraTypes		= Table_data_model::getOption($arrResult, 'id', 'name');

		asort($arrCameraTypes);

		return		$arrCameraTypes;

		/*
		$arrRet		= array(

				self::BAG_VOL_A		=> 'A',
				self::BAG_VOL_B		=> 'B',
				self::BAG_VOL_C		=> 'C',
				self::BAG_VOL_D		=> 'D',
				self::BAG_VOL_E		=> 'E',

				);

		return		$arrRet;
		*/

	}

	public static function getVolumnType() {

		$arrRet		= array(

				self::BAG_VOL_LONG		=> '长焦',
				self::BAG_VOL_WIDE		=> '广角',
				self::BAG_VOL_FLASH		=> '闪光灯',
				self::BAG_VOL_NOTEBOOK		=> '笔记本',
				self::BAG_VOL_ACCESSORY		=> '附件',

				);

		return		$arrRet;

	}

	public static function getAllTypes() {

		$arr	= array(
				self::BRAND_TYPE_CAMERA,
				self::BRAND_TYPE_CAMERA_STYLE,
				self::BRAND_TYPE_CAMERA_MODEL,
				self::BRAND_TYPE_LENS,
				self::BRAND_TYPE_LENS_MODEL,
				self::BRAND_TYPE_STAND,
				self::BRAND_TYPE_STAND_MODEL,
				self::BRAND_TYPE_BAG,
				self::BRAND_TYPE_BAG_MODEL,
				self::BRAND_TYPE_FILTER,
				self::BRAND_TYPE_FILTER_MODEL,
				self::BRAND_TYPE_HOLDER,
				self::BRAND_TYPE_HOLDER_MODEL,
				self::BRAND_TYPE_CALIBER,
				self::BRAND_TYPE_PRICE,
				self::BRAND_TYPE_TAG,
			);

		$arrRet		= array();

		foreach ($arr as $val) {
			$arrRet[$val]	= $val;
		}

		return	$arrRet;

	}

	public static function getFckEdtor() {

		$arrRet		= array(
				'fck_dir'	=> sfConfig::get('sf_web_dir') . '/../../admin/',
				'base_path'	=> '/admin/fckeditor/',
			);

		$arrRet['include_dir']	= $arrRet['fck_dir'] . 'fckeditor/fckeditor.php';

		return	$arrRet;

	}

}