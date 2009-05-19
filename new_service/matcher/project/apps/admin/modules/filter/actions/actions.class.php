<?php

class filterActions extends BaseBrandActions
{
	public function preExecute() {

		parent::preExecute();

		$this->type		= MatcherConstant::BRAND_TYPE_FILTER;

		$this->brandName	= '滤镜';

	}

}
