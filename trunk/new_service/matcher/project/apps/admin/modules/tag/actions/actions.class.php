<?php

class tagActions extends BaseBrandActions
{
	public function preExecute() {

		parent::preExecute();

		$this->type		= MatcherConstant::BRAND_TYPE_TAG;

	#	var_dump($this->type);

		$this->brandName	= '标签';

		$this->useGlobalTemplate	= false;

	}


	public function executeSearchXXX(sfWebRequest $request) {

		$this->useGlobalTemplate	= true;

		parent::executeSearch($request);

	}


}
