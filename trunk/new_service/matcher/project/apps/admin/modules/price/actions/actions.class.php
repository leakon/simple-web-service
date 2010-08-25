<?php

class priceActions extends BaseBrandActions
{
	public function preExecute() {

		parent::preExecute();

		$this->type		= MatcherConstant::BRAND_TYPE_PRICE;

		$this->brandName	= '价格区间';

		$this->strCName		= '区间';		// 中文名，默认是品牌

		$this->useGlobalTemplate	= false;

	}

	protected function getIndexData(sfWebRequest $request) {

		$tableDataTag		= new $this->dataClass();

		$this->pager		= new SofavDB_Pager($tableDataTag);

		$this->product_id	= $request->getParameter('product_id', 0);

		$where			= array(
							'type'		=> $this->type,
						);

		if ($this->product_id > 0) {

			$where['product_id']	= $this->product_id;

		}


		$order			= array('id' => 'DESC');

		$page			= (int) $request->getParameter('page', 1);
		$this->pager->init($page, sfConfig::get('app_page_size', $this->intPageSize), array('where' => $where, 'order' => $order));

		$this->arrResult	= $this->pager->getResults();

		$this->dataItem		= new $this->dataClass();

		$this->hasErrors	= $request->hasErrors();
		if ($this->hasErrors) {
			$arrParameters		= $request->getParameterHolder()->getAll();
			$this->dataItem->fromArray($arrParameters);
		}

	}

}
