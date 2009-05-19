<?php

class standActions extends BaseBrandActions
{
	public function preExecute() {

		parent::preExecute();

		$this->type		= MatcherConstant::BRAND_TYPE_STAND;

		$this->brandName	= '脚架';

	}

}
