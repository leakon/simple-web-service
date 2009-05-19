<?php

class cameraActions extends BaseBrandActions
{
	public function preExecute() {

		parent::preExecute();

		$this->type		= MatcherConstant::BRAND_TYPE_CAMERA;

		$this->brandName	= '相机';

	}

}
