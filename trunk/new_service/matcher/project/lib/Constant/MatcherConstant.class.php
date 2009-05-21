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
		BRAND_TYPE_FILTER		= 500,
		BRAND_TYPE_HOLDER		= 600,

		BRAND_TYPE_CALIBER		= 700,	// 口径管理
		BRAND_TYPE_PRICE		= 800,	// 价格区间
		BRAND_TYPE_TAG			= 900,	// 标签







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



}