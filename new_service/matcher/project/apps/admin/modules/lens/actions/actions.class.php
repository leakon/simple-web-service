<?php

class lensActions extends BaseBrandActions
{
	public function preExecute() {

		parent::preExecute();

		$this->type		= MatcherConstant::BRAND_TYPE_LENS;

		$this->brandName	= '镜头品牌';

	}


	protected function getFormOption() {

		$arrWhere		= array();
		$arrWhere['type']	= MatcherConstant::BRAND_TYPE_LENS;		// 镜头品牌
		$arrResult		= Table_data_model::getResult($arrWhere);
		$this->arrProducts	= Table_data_model::getOption($arrResult, 'id', 'name');

		$arrWhere		= array();
		$arrWhere['type']	= MatcherConstant::BRAND_TYPE_CALIBER;		// 镜头口径
		$arrResult		= Table_data_model::getResult($arrWhere);
		$this->arrStyles	= Table_data_model::getOption($arrResult, 'id', 'name');

	}


	public function executeModel(sfWebRequest $request) {

		$this->useGlobalTemplate	= false;

		$this->brandName		= '镜头型号';

		$this->type			= MatcherConstant::BRAND_TYPE_LENS_MODEL;

		$this->getIndexData($request);

		$this->getFormOption();


	}

	public function executeEditModel(sfWebRequest $request) {

		$this->useGlobalTemplate	= false;

		$this->brandName		= '镜头型号';

		$this->type			= MatcherConstant::BRAND_TYPE_LENS_MODEL;

		$this->getEditData($request);

		$this->getFormOption();

	}



}
