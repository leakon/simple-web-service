<?php

class caliberActions extends BaseBrandActions
{
	public function preExecute() {

		parent::preExecute();

		$this->type		= MatcherConstant::BRAND_TYPE_CALIBER;

		$this->brandName	= '镜头口径';

		$this->strCName		= '类型（单位mm）';		// 中文名，默认是品牌

	}

}
