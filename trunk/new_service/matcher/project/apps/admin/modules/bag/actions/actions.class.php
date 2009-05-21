<?php

class bagActions extends BaseBrandActions
{
	public function preExecute() {

		parent::preExecute();

		$this->type		= MatcherConstant::BRAND_TYPE_BAG;

		$this->brandName	= '摄影包品牌';

	}

}
