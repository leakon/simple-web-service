<?php

class lensActions extends BaseBrandActions
{
	public function preExecute() {

		parent::preExecute();

		$this->type		= MatcherConstant::BRAND_TYPE_LENS;

		$this->brandName	= '镜头品牌';

	}

}
