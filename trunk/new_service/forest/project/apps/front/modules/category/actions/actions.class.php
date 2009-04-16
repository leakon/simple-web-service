<?php

/**
 * category actions.
 *
 * @package    forest
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


	}

	private function getArticlePager($categoryId, $page = 1, $size = 10) {

		$tableArticle		= new Table_articles();

		$objPager		= new SofavDB_Pager($tableArticle);

		$where			= array('category_id' => $categoryId, 'published' => 1);
		$order			= array('created_at' => 'DESC');

		$objPager->init($page, $size, array('where' => $where, 'order' => $order));

		return	$objPager;

	}

}
