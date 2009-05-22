<?php

class searchActions extends sfActions {

	public function executeIndex(sfWebRequest $request) {

		$this->arrOption		= $this->getAllOption();


	}

	public function executeResult(sfWebRequest $request) {

		$this->setTemplate('index');

	}

	protected function getFormOption($type, $colKey = 'id', $colVal = 'name') {

		$arrWhere		= array();
		$arrWhere['type']	= $type;
		$arrResult		= Table_data_model::getResult($arrWhere);
		return			Table_data_model::getOption($arrResult, $colKey, $colVal);

	}


	protected function getAllOption() {

		$arrOptions			= array();

		// 相机品牌
		$arrOptions['camera']		= $this->getFormOption(MatcherConstant::BRAND_TYPE_CAMERA);
		// 相机型号
		$arrOptions['camera_mode']	= $this->getFormOption(MatcherConstant::BRAND_TYPE_CAMERA_MODEL, 'id', array('product_id', 'style'));

		// 镜头品牌
		$arrOptions['lens']		= $this->getFormOption(MatcherConstant::BRAND_TYPE_LENS);
		// 镜头型号
		$arrOptions['lens_mode']	= $this->getFormOption(MatcherConstant::BRAND_TYPE_LENS_MODEL, 'id', array('product_id', 'style'));

		$price				= array();
		$price['price_min']		= $this->getFormOption(MatcherConstant::BRAND_TYPE_PRICE, 'id', 'min');
		$price['price_max']		= $this->getFormOption(MatcherConstant::BRAND_TYPE_PRICE, 'id', 'max');

		$arrOptions['price']		= array();
		foreach ($price['price_min'] as $id => $min) {
			$arrOptions['price'][$id]	= sprintf('%d - %d', $min, $price['price_max'][$id]);
		}

		return	$arrOptions;

	}


}
