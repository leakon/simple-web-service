<?php

class MatcherConstant {

	const
		BRAND_TYPE_CAMERA		= 100,
		BRAND_TYPE_CAMERA_STYLE		= 120,
		BRAND_TYPE_CAMERA_MODEL		= 130,


		BRAND_TYPE_LENS			= 200,
		BRAND_TYPE_LENS_MODEL		= 230,


		BRAND_TYPE_STAND		= 300,
		BRAND_TYPE_STAND_MODEL		= 330,


		BRAND_TYPE_BAG			= 400,
		BRAND_TYPE_BAG_MODEL		= 430,


		BRAND_TYPE_FILTER		= 500,
		BRAND_TYPE_FILTER_MODEL		= 530,


		BRAND_TYPE_HOLDER		= 600,
		BRAND_TYPE_HOLDER_MODEL		= 630,

		BRAND_TYPE_CALIBER		= 700,	// 口径管理
		BRAND_TYPE_PRICE		= 800,	// 价格区间
		BRAND_TYPE_TAG			= 900,	// 标签

		/*
		// 容量
		BAG_VOL_A			= 100,
		BAG_VOL_B			= 200,
		BAG_VOL_C			= 300,
		BAG_VOL_D			= 400,
		BAG_VOL_E			= 500,
		*/

		BAG_VOL_TYPE			= 'ext_vol_type',		// A - E
		BAG_VOL_LONG			= 'ext_vol_long',		// 长焦
		BAG_VOL_WIDE			= 'ext_vol_wide',		// 广角
		BAG_VOL_FLASH			= 'ext_vol_flash',		// 闪光灯
		BAG_VOL_NOTEBOOK		= 'ext_vol_notebook',		// 笔记本
		BAG_VOL_ACCESSORY		= 'ext_vol_accessory',		// 附件

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


}