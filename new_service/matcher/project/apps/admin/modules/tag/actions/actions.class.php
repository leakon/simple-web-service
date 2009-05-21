<?php

class tagActions extends BaseBrandActions
{
	public function preExecute() {

		parent::preExecute();

		$this->type		= MatcherConstant::BRAND_TYPE_TAG;

		$this->brandName	= '标签';

		$this->useGlobalTemplate	= false;

	}

}
