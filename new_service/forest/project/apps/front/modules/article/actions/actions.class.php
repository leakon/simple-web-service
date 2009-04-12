<?php

/**
 * article actions.
 *
 * @package    forest
 * @subpackage article
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class articleActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }


	public function executeShow(sfWebRequest $request) {


		$this->arrNavPath		= array();


		$this->reqArticleId		= (int) $request->getParameter('id', 0);

		$this->articleItem		= new Table_articles($this->reqArticleId);
		$this->intSubCateId		= $this->articleItem->category_id;

		if ($this->articleItem->id) {
			$this->articleItem->view_cnt++;
			$this->articleItem->save();
		}


		$this->categoryItem		= new Table_categories($this->intSubCateId);
		$this->topCategoryId		= $this->categoryItem->parent_id;

		$this->arrNavPath[2]		= $this->categoryItem;

		// req 的 id 是二级分类的 id
		if ($this->topCategoryId) {

			$cateId				= $this->topCategoryId;

			$this->topCategoryItem		= new Table_categories($cateId);

			$this->arrNavPath[1]		= $this->topCategoryItem;

		}

		$this->arrSubCategories		= Table_categories::getByParent($cateId);

		ksort($this->arrNavPath);


	}
}
