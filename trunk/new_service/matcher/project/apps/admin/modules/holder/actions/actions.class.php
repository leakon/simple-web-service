<?php

class holderActions extends BaseBrandActions
{
	public function preExecute() {

		parent::preExecute();

		$this->type		= MatcherConstant::BRAND_TYPE_HOLDER;

		$this->brandName	= '云台';

	}

}
