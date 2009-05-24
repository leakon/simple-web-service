<?php

class bagActions extends BaseBrandActions
{
	public function preExecute() {

		parent::preExecute();

		$this->type		= MatcherConstant::BRAND_TYPE_BAG;

		$this->brandName	= '摄影包品牌';


	}


	protected function getFormOption() {

		$arrWhere		= array();
		$arrWhere['type']	= MatcherConstant::BRAND_TYPE_BAG;		// 摄影包品牌
		$arrResult		= Table_data_model::getResult($arrWhere);
		$this->arrProducts	= Table_data_model::getOption($arrResult, 'id', 'name');


		$arrWhere		= array();
		$arrWhere['type']	= MatcherConstant::BRAND_TYPE_PRICE;		// 价格区间
		$arrResult		= Table_data_model::getResult($arrWhere);

		$arrMin			= Table_data_model::getOption($arrResult, 'id', 'min');
		$arrMax			= Table_data_model::getOption($arrResult, 'id', 'max');
		$this->arrStyles	= array();
		foreach ($arrMin as $id => $minVal) {
			$this->arrStyles[$id]	= sprintf('%s - %s', $minVal, $arrMax[$id]);
		}

		// 显示 脚架 专用标签
		$this->arrTags		= Table_data_model::getTags(MatcherConstant::BRAND_TYPE_BAG);

	}


	public function executeModel(sfWebRequest $request) {

		$this->useGlobalTemplate	= false;
	#	$this->setTemplate('model', 'stand');

		$this->brandName		= '摄影包型号';

		$this->type			= MatcherConstant::BRAND_TYPE_BAG_MODEL;

		$this->getIndexData($request);

		$this->getFormOption();


	}

	public function executeEditModel(sfWebRequest $request) {

		$this->useGlobalTemplate	= false;
	#	$this->setTemplate('editModel', 'stand');

		$this->brandName		= '摄影包型号';

		$this->type			= MatcherConstant::BRAND_TYPE_BAG_MODEL;

		$this->getEditData($request);

		$this->getFormOption();

	}



}
