<?php

class categoryActions extends sfActions {

	protected function categoryIndex(sfWebRequest $request) {

		$categoryId			= (int) $request->getParameter('id', 0);

		// id 为零时，代表创建顶级分类，否则是创建二级分类
		$this->isTopCategory		= 0 == $categoryId;

		$this->categoryItem		= new Table_categories($categoryId);

		$arrConf			= array(
							'type'		=> $this->intCategoryType,
							'limit'		=> 10,
						);

		$this->arrCategories		= Table_categories::getByParent($categoryId, $arrConf);

		$this->arrCategoryPath		= Table_categories::getCategoryPath($categoryId);

		$this->arrCategoryChildQty	= Table_categories::getChildQtyObj($this->arrCategories);



	#	Debug::pr($this->arrCategoryChildQty);

	}

	public function executeIndex(sfWebRequest $request) {

		$this->strType			= '文章分类';

		$this->intCategoryType		= CnroConstant::CATEGORY_TYPE_NEWS;

		$this->categoryIndex($request);

	}

	public function executeProduct(sfWebRequest $request) {

		$this->setTemplate('index');

		$this->strType			= '产品分类';

		$this->intCategoryType		= CnroConstant::CATEGORY_TYPE_PRODUCT;

		$this->categoryIndex($request);

	}

	public function executeRange(sfWebRequest $request) {

		$this->setTemplate('index');

		$this->strType			= '应用领域';

		$this->intCategoryType		= CnroConstant::CATEGORY_TYPE_PROD_RANGE;

		$this->categoryIndex($request);

	}

	public function executeType(sfWebRequest $request) {

		$this->setTemplate('once');

		$this->strType			= '设备类别';

		$this->intCategoryType		= CnroConstant::CATEGORY_TYPE_PROD_TYPE;

		$this->categoryIndex($request);

	}

	public function executeStyle(sfWebRequest $request) {

		$this->setTemplate('once');

		$this->strType			= '设备型号';

		$this->intCategoryType		= CnroConstant::CATEGORY_TYPE_PROD_STYLE;

		$this->categoryIndex($request);

	}


	public function executeSub(sfWebRequest $request) {

		$categoryId			= (int) $request->getParameter('id', 0);

		$this->categoryItem		= new Table_categories($categoryId);

	#	Debug::pr($this->categoryItem);

	}

	public function executeSave(sfWebRequest $request) {

		$arrParameters		= $request->getParameterHolder()->getAll();

		$categoryId		= (int) $request->getParameter('id', 0);
		$categoryItem		= new Table_categories($categoryId);

		if (isset($arrParameters['description_new'])) {
			$arrParameters['description']	= $arrParameters['description_new'];
		}

	#	Debug::pre($arrParameters);

		/*
		$cateType		= (int) $request->getParameter('type', 0);
		$parentId		= (int) $request->getParameter('parent_id', 0);
		$order_num		= (int) $request->getParameter('order_num', 0);
		$categoryName		= $request->getParameter('name', '');

		$categoryItem->type			= $cateType;
		$categoryItem->parent_id		= $parentId;
		$categoryItem->name			= $categoryName;
		$categoryItem->order_num		= $order_num;
		*/

		$categoryItem->fromArray($arrParameters);

		$bool		= $categoryItem->save();

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	}


	public function executeDelete(sfWebRequest $request) {

		$categoryId		= (int) $request->getParameter('id', 0);

		$categoryItem		= new Table_categories($categoryId);

		if ($categoryItem->id) {

			$categoryItem->delete();

		}

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);
	}


	public function executeSaveOrder(sfWebRequest $request) {

	#	Debug::pre($_POST);

		$arrOrders		= (array) $request->getParameter('order_num', array());

		foreach ($arrOrders as $categoryId => $orderNum) {

			$categoryItem		= new Table_categories($categoryId);

			if ($categoryItem->id) {

				$categoryItem->order_num	= $orderNum;
				$categoryItem->save();

			}

		}

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	}
}
