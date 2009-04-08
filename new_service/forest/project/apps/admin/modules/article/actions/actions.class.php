<?php

class articleActions extends sfActions {

	public function preExecute() {

		$this->pageSize		= 20;
	}

	public function executeIndex(sfWebRequest $request) {


		$this->topCateId	= $request->getParameter('top_category', 0);
		$this->subCateId	= $request->getParameter('sub_category', 0);
		$this->strKW		= S::KW($request->getParameter('kw', ''));


		if (strlen($this->strKW)) {

			$this->pager		= $this->getArticleByLike($this->subCateId, $this->strKW, $request);

		} else {

			$this->pager		= $this->getArticleByTotal($this->subCateId, $request);

		}

		$this->arrResult		= $this->pager->getResults();


		$this->arrAllCategories		= Table_categories::getAll();

	}


	private function getArticleByLike($categoryId, $word, $request) {

			$parameter		= array(
				'word_1'	=> '%' . $word . '%',
				'word_2'	=> '%' . $word . '%',
				'word_3'	=> '%' . $word . '%',
			);

			$tableArticle	= new Table_articles();

			// use like
			$templateWhere	= 'FROM %s WHERE (title LIKE :word_1 OR detail LIKE :word_2 OR keyword LIKE :word_3) ';

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
			$stateLimit	= 'SELECT * ' . $sqlWhere . ' ORDER BY created_at DESC';

			$pager		= new Simple_Pager();
			$pager->setCount($stateCount)->setLimit($stateLimit);
			$pager->setParameter($parameter);

			$page		= (int) $request->getParameter('page', 1);
			$pager->init($page, $this->pageSize);

			return	$pager;

	}

	private function getArticleByTotal($categoryId, $request) {

			$parameter		= array();

			$tableArticle	= new Table_articles();

			// use like
			$templateWhere	= 'FROM %s  ';

			if ($categoryId > 0) {
				$parameter['category_id']	= $categoryId;
				$templateWhere			.= ' WHERE category_id = :category_id ';
			}

			$sqlWhere	= sprintf($templateWhere, $tableArticle->getTableName());

					// "FROM ... WHERE ..." (without SELECT)
					// 用于生成 COUNT(*) 的 SQL 语句，统计符合条件的记录总数，注意是从 FROM 开始
			$stateCount	= $sqlWhere;
					// "SELECT c.*, m.* FROM ... WHERE ... ORDER ..." (without LIMIT)
					// 用于选取记录，这里可以指定字段，并加上排序字段
			$stateLimit	= 'SELECT * ' . $sqlWhere . ' ORDER BY created_at DESC';

			$pager		= new Simple_Pager();
			$pager->setCount($stateCount)->setLimit($stateLimit);
			$pager->setParameter($parameter);

			$page		= (int) $request->getParameter('page', 1);
			$pager->init($page, $this->pageSize);

			return	$pager;

	}


	public function executeEdit(sfWebRequest $request) {


		$this->arrAllCategories		= Table_categories::getAll();

		$this->articleId		= $request->getParameter('id', 0);

		$this->articleItem		= new Table_articles($this->articleId);

		$this->subCateId		= $this->articleItem->category_id;

		$this->arrSubCategory		= $this->arrAllCategories[$this->subCateId];

		$this->topCateId		= $this->arrAllCategories[$this->arrSubCategory['parent_id']]['id'];

	}

	public function executeSave(sfWebRequest $request) {

		$this->articleId		= $request->getParameter('id', 0);

		if ($this->articleId) {

			$this->articleItem		= new Table_articles($this->articleId);

			$this->articleItem->detail	= $request->getParameter('detail', '');

			$this->articleItem->save();


		}

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);


	}


}
