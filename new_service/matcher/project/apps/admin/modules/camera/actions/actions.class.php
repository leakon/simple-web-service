<?php

class cameraActions extends BaseBrandActions
{
	public function preExecute() {

		parent::preExecute();

		$this->type		= MatcherConstant::BRAND_TYPE_CAMERA;

		$this->brandName	= '相机品牌';

	}


	public function executeStyle(sfWebRequest $request) {

		$this->useGlobalTemplate	= false;

		$this->brandName		= '相机类型';

		$this->type			= MatcherConstant::BRAND_TYPE_CAMERA_STYLE;

		$this->getIndexData($request);

	}

	public function executeEditStyle(sfWebRequest $request) {

		$this->useGlobalTemplate	= false;

		$this->brandName		= '相机类型';

		$this->type			= MatcherConstant::BRAND_TYPE_CAMERA_STYLE;

		$this->getEditData($request);

	}


	protected function getFormOption() {

		$arrWhere		= array();
		$arrWhere['type']	= MatcherConstant::BRAND_TYPE_CAMERA;		// 相机品牌
		$arrResult		= Table_data_model::getResult($arrWhere);
		$this->arrProducts	= Table_data_model::getOption($arrResult, 'id', 'name');

		$arrWhere		= array();
		$arrWhere['type']	= MatcherConstant::BRAND_TYPE_CAMERA_STYLE;	// 相机类型
		$arrResult		= Table_data_model::getResult($arrWhere);
		$this->arrStyles	= Table_data_model::getOption($arrResult, 'id', 'name');

	}


	public function executeModel(sfWebRequest $request) {

		$this->useGlobalTemplate	= false;

		$this->brandName		= '相机型号';

		$this->type			= MatcherConstant::BRAND_TYPE_CAMERA_Model;

		$this->getIndexData($request);

		$this->getFormOption();


	}

	public function executeEditModel(sfWebRequest $request) {

		$this->useGlobalTemplate	= false;

		$this->brandName		= '相机型号';

		$this->type			= MatcherConstant::BRAND_TYPE_CAMERA_Model;

		$this->getEditData($request);

		$this->getFormOption();

	}


}
