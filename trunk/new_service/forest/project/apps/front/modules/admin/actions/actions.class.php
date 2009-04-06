<?php

/**
 * admin actions.
 *
 * @package    forest
 * @subpackage admin
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class adminActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'category');
  }



	public function executeCategory(sfWebRequest $request) {

		$categoryId			= (int) $request->getParameter('id', 0);

		// id 为零时，代表创建顶级分类，否则是创建二级分类
		$this->isTopCategory		= 0 == $categoryId;

		$this->categoryItem		= new Table_categories($categoryId);

		$this->arrCategories		= Table_categories::getByParent($categoryId);

	}

	public function executeEditCategory(sfWebRequest $request) {

		$categoryId			= (int) $request->getParameter('id', 0);

		$this->categoryItem		= new Table_categories($categoryId);

	#	Debug::pr($this->categoryItem);

	}

	public function executeSaveCategory(sfWebRequest $request) {

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


	public function executeDeleteCategory(sfWebRequest $request) {

		$categoryId		= (int) $request->getParameter('id', 0);

		$categoryItem		= new Table_categories($categoryId);

		if ($categoryItem->id) {

			$categoryItem->delete();

		}

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);
	}


	public function executeSaveCategoryOrder(sfWebRequest $request) {

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


	public function executeConn(sfWebRequest $request) {


	//	$conn		= mssql_connect('192.168.10.131:1433', 'sa', '123456');
		$conn		= mssql_connect('192.168.10.131', 'forest', '123456');

	//	var_dump($conn);

		return	$this->renderText('');

	}


}
