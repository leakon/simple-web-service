<?php

class categoryActions extends sfActions {

	public function executeIndex(sfWebRequest $request) {

		$categoryId			= (int) $request->getParameter('id', 0);

		// id 为零时，代表创建顶级分类，否则是创建二级分类
		$this->isTopCategory		= 0 == $categoryId;

		$this->categoryItem		= new Table_categories($categoryId);

		$this->arrCategories		= Table_categories::getByParent($categoryId);

	}

	public function executeSub(sfWebRequest $request) {

		$categoryId			= (int) $request->getParameter('id', 0);

		$this->categoryItem		= new Table_categories($categoryId);

	#	Debug::pr($this->categoryItem);

	}

	public function executeSave(sfWebRequest $request) {

		$categoryId		= (int) $request->getParameter('id', 0);
		$parentId		= (int) $request->getParameter('parent_id', 0);
		$order_num		= (int) $request->getParameter('order_num', 0);
		$categoryName		= $request->getParameter('name', '');

		$categoryItem		= new Table_categories($categoryId);

		if ($categoryItem->id) {

		} else {

		}

		$categoryItem->parent_id		= $parentId;
		$categoryItem->name			= $categoryName;
		$categoryItem->order_num		= $order_num;

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
