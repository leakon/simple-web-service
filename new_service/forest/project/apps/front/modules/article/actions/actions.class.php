<?php

class articleActions extends sfActions {

	public function preExecute() {
		$this->pageSize		= 20;
		$this->userId	= $this->getUser()->getId();
	}


	public function executeIndex(sfWebRequest $request) {
		$this->forward('default', 'module');
	}


	public function executeShow(sfWebRequest $request) {

		$this->arrNavPath		= array();

		$this->reqArticleId		= (int) $request->getParameter('id', 0);

		$this->articleItem		= new Table_articles($this->reqArticleId);
		$this->intSubCateId		= $this->articleItem->category_id;

		if ($this->articleItem->id) {

			if (!$this->articleItem->isPublished()) {

			#	Debug::pre($this->articleItem);

				return	$this->redirect('/');
			}


			if ($this->articleItem->is_private && !$this->userId) {
				return	$this->forward('account', 'private');
			#	return	$this->redirect('account/private');
			}




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

	public function executeSearch(sfWebRequest $request) {

		$this->objConf			= new Custom_Conf();
		$this->arrDataConf	= $this->objConf->getConf();

		$this->strKW		= S::KW($request->getParameter('kw', ''));


		if (strlen($this->strKW)) {

			$this->pager		= $this->getArticleByLike($this->strKW, $request);

		} else {

			$this->pager		= new Simple_Pager();

		}

		$this->arrResult		= $this->pager->getResults();


		$this->arrAllCategories		= Table_categories::getAll();

	}


	private function getArticleByLike($word, $request) {

			$categoryId		= 0;

			$parameter		= array(
				'word_1'	=> '%' . $word . '%',
				'word_2'	=> '%' . $word . '%',
				'word_3'	=> '%' . $word . '%',
			);

			$tableArticle	= new Table_articles();

			// use like
			$templateWhere	= 'FROM %s WHERE published = 1 AND ( title LIKE :word_1 OR detail LIKE :word_2 OR keyword LIKE :word_3) ';
		#	$templateWhere	= 'FROM %s WHERE published = 1 AND ( title LIKE :word_1 OR detail LIKE :word_2) ';

			if ($categoryId > 0) {
				$parameter['category_id']	= $categoryId;
				$templateWhere			.= ' AND category_id = :category_id ';
			}

			$sqlWhere	= sprintf($templateWhere, $tableArticle->getTableName());

					// "FROM ... WHERE ..." (without SELECT)
					// 用于生成 COUNT(*) 的 SQL 语句，统计符合条件的记录总数，注意是从 FROM 开始
			$stateCount	= $sqlWhere;
					// "SELECT c.*, m.* FROM ... WHERE ... ORDER ..." (without LIMIT)
					// 用于选取记录，这里可以指定字段，并加上排序字段
			$stateLimit	= 'SELECT * ' . $sqlWhere . ' ORDER BY published_at DESC';

			$pager		= new Simple_Pager();
			$pager->setCount($stateCount)->setLimit($stateLimit);
			$pager->setParameter($parameter);

			$page		= (int) $request->getParameter('page', 1);
			$pager->init($page, $this->pageSize);

			return	$pager;

	}












}
