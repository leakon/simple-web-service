<?php

class searchActions extends sfActions {

	public function preExecute() {

		$this->type		= 0;
		$this->dataClass	= 'Table_data_model';
		$this->strModuleName	= $this->getContext()->getModuleName();

		$this->arrProducts	= MatcherConstant::getProducts();

		$this->webUploadDir	= ProjectConfiguration::getWebUploadDir();


	}


	public function executeIndex(sfWebRequest $request) {

		$this->arrOption		= $this->getAllOption();
		$this->getResult($request);

	}

	public function executeResult(sfWebRequest $request) {

		$this->setTemplate('index');

		$this->arrOption		= $this->getAllOption();
		$this->getResult($request);

		$arrParameters		= $request->getParameterHolder()->getAll();

		$from			= $request->getParameter('from', '');
		if ($from == 'result') {
			Debug::pre($arrParameters);
		}

	}

	protected function getFormOption($type, $colKey = 'id', $colVal = 'name') {

		$arrWhere		= array();
		$arrWhere['type']	= $type;
		$arrResult		= Table_data_model::getResult($arrWhere);
		return			Table_data_model::getOption($arrResult, $colKey, $colVal);

	}



	protected function getResult(sfWebRequest $request) {

		$tableDataTag		= new $this->dataClass();

		$this->pager		= new SofavDB_Pager($tableDataTag);

		$where			= array('type' => $this->type);
		$order			= array('id' => 'DESC');

		$page			= (int) $request->getParameter('page', 1);
		$this->pager->init($page, sfConfig::get('app_page_size', 5), array('where' => $where, 'order' => $order));

		$this->arrResult	= $this->pager->getResults();

		$this->dataItem		= new $this->dataClass();

	}


	protected function getAllOption() {

		$arrOptions			= array();

		// 相机品牌
		$arrOptions['camera']		= $this->getFormOption(MatcherConstant::BRAND_TYPE_CAMERA);
		// 相机型号
		$arrOptions['camera_model']	= $this->getFormOption(MatcherConstant::BRAND_TYPE_CAMERA_MODEL, 'id', array('product_id', 'style'));

		// 镜头品牌
		$arrOptions['lens']		= $this->getFormOption(MatcherConstant::BRAND_TYPE_LENS);
		// 镜头型号
		$arrOptions['lens_model']	= $this->getFormOption(MatcherConstant::BRAND_TYPE_LENS_MODEL, 'id', array('product_id', 'style'));

		$price				= array();
		$price['price_min']		= $this->getFormOption(MatcherConstant::BRAND_TYPE_PRICE, 'id', 'min');
		$price['price_max']		= $this->getFormOption(MatcherConstant::BRAND_TYPE_PRICE, 'id', 'max');

		$arrOptions['price']		= array();
		foreach ($price['price_min'] as $id => $min) {
			$arrOptions['price'][$id]	= sprintf('%d - %d', $min, $price['price_max'][$id]);
		}

	#	$arrProducts		= MatcherConstant::getProducts();

		$arrType		= array(
						MatcherConstant::BRAND_TYPE_BAG		=> 'bag',
						MatcherConstant::BRAND_TYPE_STAND	=> 'stand',
						MatcherConstant::BRAND_TYPE_HOLDER	=> 'holder',
						MatcherConstant::BRAND_TYPE_FILTER	=> 'filter',
					);

		$arrTags		= array();
		foreach ($arrType as $typeId => $typeString) {
			$arrTags[$typeString]		= Table_data_model::getTags($typeId);
			$arrProducts[$typeString]	= $this->getFormOption($typeId);
		}
		$arrOptions['tags']	= $arrTags;
		$arrOptions['products']	= $arrProducts;

		return	$arrOptions;

	}


}
