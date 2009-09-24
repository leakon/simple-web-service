<?php

/**
 * category actions.
 *
 * @package    v
 * @subpackage category
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class categoryActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('category', 'list');
  }

	public function preExecute() {
	}

	public function executeList(sfWebRequest $request) {


		$this->pageNum			= (int) $request->getParameter('page', 1);

		$this->arrNavPath		= array();

		$this->intSubCateId		= 0;


		$this->reqCategoryId		= (int) $request->getParameter('id', 0);

		// 090613 点击资讯中心频道后，页面默认停留在公司新闻的列表页状态下。
		if (1000059 == $this->reqCategoryId) {
			return	$this->redirect('category/list?id=1000067');
		}


		$this->categoryItem		= new Table_categories($this->reqCategoryId);
		$this->topCategoryId		= $this->categoryItem->parent_id;

		$this->arrNavPath[2]		= $this->categoryItem;

		$cateId				= $this->reqCategoryId;


		$tableArticle			= new Table_articles();
		$this->articlePager		= new SofavDB_Pager($tableArticle);

		// req 的 id 是二级分类的 id
		if ($this->topCategoryId) {

			$this->intSubCateId		= $this->reqCategoryId;

			$cateId				= $this->topCategoryId;

			$this->topCategoryItem		= new Table_categories($cateId);

			$this->arrNavPath[1]		= $this->topCategoryItem;


			// 获取二级分类的文章 pager
			$this->articlePager		= $this->getArticlePager($this->reqCategoryId, 1, 5);

		}

		$this->arrSubCategories		= Table_categories::getByParent($cateId);

		$this->arrSubArticles		= array();
		if (count($this->arrSubCategories)) {

			if ($this->intSubCateId) {

				$catId				= $this->intSubCateId;
				$this->arrSubArticles[$catId]	= $this->getArticlePager($catId, $this->pageNum, 15);

			} else {

				foreach ($this->arrSubCategories as $key => $val) {
					$catId				= $val->id;
					$this->arrSubArticles[$catId]	= $this->getArticlePager($catId, 1, 5);
				}

			}


		}


		ksort($this->arrNavPath);

		if (isset($this->categoryItem->description) && strlen($this->categoryItem->description)) {
			$this->setTemplate('listContent');
		}


	}




















	private function getArticlePager($categoryId, $page = 1, $size = 10) {

		$tableArticle		= new Table_articles();

		$objPager		= new SofavDB_Pager($tableArticle);

		$where			= array('category_id' => $categoryId, 'published' => 1);
		$order			= array('published_at' => 'DESC');

		$objPager->init($page, $size, array('where' => $where, 'order' => $order));

		return	$objPager;

	}


	private function getRangeArticlePager($range_id, $page = 1, $size = 10) {

		$tableArticle		= new Table_articles();

		$objPager		= new SofavDB_Pager($tableArticle);

		$where			= array(
						'type'		=> CnroConstant::CATEGORY_TYPE_PRODUCT,
						'range_id'	=> $range_id,
						'published'	=> 1
					);
		$order			= array('published_at' => 'DESC', 'created_at' => 'DESC');

		$objPager->init($page, $size, array('where' => $where, 'order' => $order));

		return	$objPager;

	}

	public function executeJson(sfWebRequest $request) {

		$categoryId			= (int) $request->getParameter('id', 0);
		$categoryType			= (int) $request->getParameter('type', 0);

		$arrConf			= array(
							'type'		=> $categoryType,
							'limit'		=> 99999,
						);

		$this->arrCategories		= Table_categories::getByParent($categoryId, $arrConf);

		$this->arrCategoryChildQty	= Table_categories::getChildQtyObj($this->arrCategories);

		$arrRet		= array();

		foreach ($this->arrCategories as $key => $val) {

			$tmp			= array();
			$tmp['id']		= $val->id;
			$tmp['parent_id']	= $val->parent_id;
			$tmp['type']		= $val->type;
			$tmp['name']		= S::E($val->name);

			$arrRet[$tmp['id']]	= $tmp;


		}

	#	Debug::pre($arrRet);

		return $this->renderText(json_encode($arrRet));

	}



	public function executeRange(sfWebRequest $request) {

		$this->forSpecial($request);

	}

	public function executeProduct(sfWebRequest $request) {

		$this->forSpecial($request);

		$this->arrSubArticles		= array();

		if ($this->reqId) {
		#	$this->articlePager	= $this->getRangeArticlePager($this->reqId, 1, 5);
			$this->arrSubArticles[$this->reqId]	= $this->getRangeArticlePager($this->reqId, $this->pageNum, 15);

		//	Debug::pr($this->arrSubArticles);

		}

		// 如果有下级分类，则显示分类信息，不显示产品
		$this->arrRealSubCategories		= Table_categories::getAllChildern($this->reqId);
	#	var_dump(count($this->arrRealSubCategories));
		if (count($this->arrRealSubCategories)) {

			$option		= array(
						'limit'		=> 1000,
						'to_array'	=> true
					);
			$this->arrRealSubCategoryList	= Table_categories::getByParent($this->reqId, $option);

			$this->setTemplate('productCategory');

		#	Debug::pr($this->arrRealSubCategoryList);

		}


		if (isset($this->arrObjSubCate) && count($this->arrObjSubCate)) {

			if ($this->reqId) {

			#	echo	23134;

			#	$this->arrSubArticles[$this->reqId]	= $this->getRangeArticlePager($this->reqId, $this->pageNum, 15);

			} else {

				$this->arrSubRange	= array();

				foreach ($this->arrSubCategories as $catId => $val) {
				#	$catId				= $val['id'];
				#	var_dump($val);
					$this->arrSubArticles[$catId]	= $this->getRangeArticlePager($catId, 1, 1);

					$option				= array('limit' => 4);
					$option['to_array']		= true;
					$option['type']			= CnroConstant::CATEGORY_TYPE_PROD_RANGE;
					$res				= Table_categories::getByParent($catId, $option);
					$this->arrSubRange[$catId]	= Array_Util::ColToPlain($res, 'id', 'name');

				}

			}

		}

	#	Debug::pr($this->arrSubArticles);


	}

	protected function forSpecial(sfWebRequest $request, $rangeId = 0) {

		$this->pageNum			= (int) $request->getParameter('page', 1);

		$this->arrNavPath		= array();

		$this->reqId			= (int) $request->getParameter('id', 0);
		$this->reqId			= $this->reqId >= 0 ? $this->reqId : 0;
	#	$this->reqType			= $request->getParameter('type', 'range');
		$this->reqType			= $this->getContext()->getActionName();

		if ($rangeId) {
			$this->reqId	= $rangeId;
		}

		$arrType	= array(
						'product'	=> 1,
						'range'		=> 1,
					);

		if (empty($arrType[$this->reqType])) {
			$this->reqType	= 'range';
		}

        	if ('product' == $this->reqType) {
        		$obj			= new Table_categories();
        		$obj->name		= '产品中心';
        		$this->arrNavPath[]	= $obj;
        	}

        	if ('range' == $this->reqType) {
        		$obj			= new Table_categories();
        		$obj->name		= '应用领域';
        		$this->arrNavPath[]	= $obj;
        	}


		$this->arrSubCategories		= array();

		$this->objCategory		= new Table_categories($this->reqId);

		if ($this->reqId) {
			$this->arrParents	= Table_categories::getCategoryPath($this->reqId);
		#	Debug::pr($this->arrParents);
			foreach ($this->arrParents as $val) {
				$obj			= new Table_categories($val['id']);
				$this->arrNavPath[]	= $obj;
			}
		}

		$option				= array('limit' => 1000);
		$option['to_array']		= true;
		$option['type']			= CnroConstant::CATEGORY_TYPE_PROD_RANGE;
		$this->arrObjSubCate		= Table_categories::getByParent($this->reqId, $option);
		$this->arrSubCategories		= Array_Util::ColToPlain($this->arrObjSubCate, 'id', 'name');

		if (empty($this->arrSubCategories)) {

			$pos		= count($this->arrNavPath) - 2;

			if (isset($this->arrNavPath[$pos])) {

				$id				= $this->arrNavPath[$pos]->id;

				$option				= array('limit' => 1000);
				$option['to_array']		= true;
				$option['type']			= CnroConstant::CATEGORY_TYPE_PROD_RANGE;
				$this->arrObjSubCate		= Table_categories::getByParent($id, $option);
				$this->arrSubCategories		= Array_Util::ColToPlain($this->arrObjSubCate, 'id', 'name');
			}

		#	Debug::pr($this->arrNavPath);

		}


	#	Debug::pr($this->arrNavPath);
	#	Debug::pr($this->arrSubCategories);

	}






















}
