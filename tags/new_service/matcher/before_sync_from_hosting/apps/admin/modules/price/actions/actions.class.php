<?php

class priceActions extends BaseBrandActions
{
	public function preExecute() {

		parent::preExecute();

		$this->type		= MatcherConstant::BRAND_TYPE_PRICE;

		$this->brandName	= '价格区间';

		$this->strCName		= '区间';		// 中文名，默认是品牌

		$this->useGlobalTemplate	= false;
	}

}
