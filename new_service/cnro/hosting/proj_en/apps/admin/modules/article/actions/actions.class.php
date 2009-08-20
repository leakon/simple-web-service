<?php

class articleActions extends sfActions {

	public function preExecute() {

		$this->pageSize		= 20;
	}

	public function executeIndex(sfWebRequest $request) {

		$this->categoryId		= $request->getParameter('category_id', 0);
		$this->strKW		= S::KW($request->getParameter('kw', ''));

		if (strlen($this->strKW)) {

			$this->pager		= $this->getArticleByLike($this->categoryId, $this->strKW, $request);

		} else {

			$this->pager		= $this->getArticleByTotal($this->categoryId, $request);

		}

		$this->arrResult		= $this->pager->getResults();

		$this->arrAllCategories		= Table_categories::getAll();

	}

	public function executeListProduct(sfWebRequest $request) {

		$this->strKW			= S::KW($request->getParameter('kw', ''));

		if (strlen($this->strKW)) {

			$this->pager		= $this->getRangeByLike(CnroConstant::CATEGORY_TYPE_PRODUCT, $this->strKW, $request);

		} else {

			$this->pager		= $this->getRangeByTotal(CnroConstant::CATEGORY_TYPE_PRODUCT, $request);

		}

		$this->arrResult		= $this->pager->getResults();

		$this->arrAllCategories		= Table_categories::getAllByType(CnroConstant::CATEGORY_TYPE_PROD_RANGE);


		$option			= array('limit' => 1000);
		$option['to_array']	= true;
		$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_RANGE;
		$res			= Table_categories::getByParent(0, $option);
		$this->arrRanges	= Array_Util::ColToPlain($res, 'id', 'name');

		$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_TYPE;
		$res			= Table_categories::getByParent(0, $option);
		$this->arrTypes		= Array_Util::ColToPlain($res, 'id', 'name');

		$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_STYLE;
		$res			= Table_categories::getByParent(0, $option);
		$this->arrStyle		= Array_Util::ColToPlain($res, 'id', 'name');

	}

	public function executeListRange(sfWebRequest $request) {

		$this->strKW			= S::KW($request->getParameter('kw', ''));

		if (strlen($this->strKW)) {

			$this->pager		= $this->getRangeByLike(CnroConstant::CATEGORY_TYPE_PROD_RANGE, $this->strKW, $request);

		} else {

			$this->pager		= $this->getRangeByTotal(CnroConstant::CATEGORY_TYPE_PROD_RANGE, $request);

		}

		$this->arrResult		= $this->pager->getResults();

		$this->arrAllCategories		= Table_categories::getAll();

		$this->arrAllCategories		= Table_categories::getAllByType(CnroConstant::CATEGORY_TYPE_PROD_RANGE);

		$option			= array('limit' => 1000);
		$option['to_array']	= true;
		$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_RANGE;
		$res			= Table_categories::getByParent(0, $option);
		$this->arrRanges	= Array_Util::ColToPlain($res, 'id', 'name');

		$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_TYPE;
		$res			= Table_categories::getByParent(0, $option);
		$this->arrTypes		= Array_Util::ColToPlain($res, 'id', 'name');

		$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_STYLE;
		$res			= Table_categories::getByParent(0, $option);
		$this->arrStyle		= Array_Util::ColToPlain($res, 'id', 'name');

	}




	public function executeAudit(sfWebRequest $request) {

	#	$this->topCateId	= $request->getParameter('top_category', 0);
	#	$this->subCateId	= $request->getParameter('sub_category', 0);
		$this->categoryId		= $request->getParameter('category_id', 0);
		$this->strKW		= S::KW($request->getParameter('kw', ''));

		$option			= array(
						'published'	=> 0,
					);
		$this->pager		= $this->getArticleByTotal($this->categoryId, $request, $option);


		$this->arrResult		= $this->pager->getResults();

		$this->arrAllCategories		= Table_categories::getAll();

	}

	public function executePublish(sfWebRequest $request) {

		$arrItems	= (array) $request->getParameter('checked_item', array());
		$publish	= (int) $request->getParameter('publish', -1);

		if ($publish > -1 && count($arrItems)) {

			foreach ($arrItems as $articleId) {

				$objArticle		= new Table_articles($articleId);

				if ($objArticle->id) {
					$objArticle->published	= $publish;
					$objArticle->save();
				}

			}

		}

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	#	Debug::pr($publish);
	#	Debug::pre($arrItems);

	}
	public function executePrivate(sfWebRequest $request) {

		$arrItems	= (array) $request->getParameter('checked_item', array());
		$is_private	= (int) $request->getParameter('is_private', -1);

		if ($is_private > -1 && count($arrItems)) {

			foreach ($arrItems as $articleId) {

				$objArticle		= new Table_articles($articleId);

				if ($objArticle->id) {
					$objArticle->is_private	= $is_private;
					$objArticle->save();
				}

			}

		}

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	#	Debug::pr($publish);
	#	Debug::pre($arrItems);

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

			$parameter['type']	= CnroConstant::CATEGORY_TYPE_NEWS;
			$templateWhere		.= ' AND type = :type ';

			if ($categoryId > 0) {
				$parameter['category_id']	= $categoryId;
				$templateWhere			.= ' AND category_id = :category_id ';
			}

			$sqlWhere	= sprintf($templateWhere, $tableArticle->getTableName());

					// "FROM ... WHERE ..." (without SELECT)
					// �������� COUNT(*) �� SQL ��䣬ͳ�Ʒ��������ļ�¼������ע���Ǵ� FROM ��ʼ
			$stateCount	= $sqlWhere;
					// "SELECT c.*, m.* FROM ... WHERE ... ORDER ..." (without LIMIT)
					// ����ѡȡ��¼���������ָ���ֶΣ������������ֶ�
			$stateLimit	= 'SELECT * ' . $sqlWhere . ' ORDER BY published_at DESC';

			$pager		= new Simple_Pager();
			$pager->setCount($stateCount)->setLimit($stateLimit);
			$pager->setParameter($parameter);

			$page		= (int) $request->getParameter('page', 1);
			$pager->init($page, $this->pageSize);

			return	$pager;

	}

	private function getArticleByTotal($categoryId, $request, $option = NULL) {

			$parameter		= array();

			$tableArticle	= new Table_articles();
			// use like
			$templateWhere	= 'FROM %s WHERE 1 ';

			$parameter['type']	= CnroConstant::CATEGORY_TYPE_NEWS;
			$templateWhere		.= ' AND type = :type ';

			if ($categoryId > 0) {
				$parameter['category_id']	= $categoryId;
				$templateWhere			.= ' AND category_id = :category_id ';
			}

			if (isset($option['published'])) {
				$parameter['published']	= $option['published'];
				$templateWhere			.= ' AND published = :published ';
			}

			$sqlWhere	= sprintf($templateWhere, $tableArticle->getTableName());

					// "FROM ... WHERE ..." (without SELECT)
					// �������� COUNT(*) �� SQL ��䣬ͳ�Ʒ��������ļ�¼������ע���Ǵ� FROM ��ʼ
			$stateCount	= $sqlWhere;
					// "SELECT c.*, m.* FROM ... WHERE ... ORDER ..." (without LIMIT)
					// ����ѡȡ��¼���������ָ���ֶΣ������������ֶ�
			$stateLimit	= 'SELECT * ' . $sqlWhere . ' ORDER BY created_at DESC';

			$pager		= new Simple_Pager();
			$pager->setCount($stateCount)->setLimit($stateLimit);
			$pager->setParameter($parameter);

			$page		= (int) $request->getParameter('page', 1);
			$pager->init($page, $this->pageSize);

			return	$pager;

	}

	public function executeNew(sfWebRequest $request) {
		$this->setTemplate('edit');
		$this->articleId		= $request->getParameter('id', 0);
		$this->articleItem		= new Table_articles($this->articleId);
		$this->arrCategoryPath		= Table_categories::getCategoryPath($this->articleItem->category_id);
	}

	public function executeEdit(sfWebRequest $request) {
	#	$this->arrAllCategories		= Table_categories::getAll();
		$this->articleId		= $request->getParameter('id', 0);
		$this->articleItem		= new Table_articles($this->articleId);
		$this->arrCategoryPath		= Table_categories::getCategoryPath($this->articleItem->category_id);
	}

	public function executeNewProduct(sfWebRequest $request) {
		$this->setTemplate('editProduct');
		$this->articleId		= $request->getParameter('id', 0);
		$this->articleItem		= new Table_articles($this->articleId);
		$this->arrCategoryPath		= Table_categories::getCategoryPath($this->articleItem->category_id);
		$this->arrRangePath		= Table_categories::getCategoryPath($this->articleItem->range_id);

		$option			= array('limit' => 1000);
		$option['to_array']	= true;
		$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_RANGE;
		$res			= Table_categories::getByParent(0, $option);
		$this->arrRanges	= Array_Util::ColToPlain($res, 'id', 'name');

		$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_TYPE;
		$res			= Table_categories::getByParent(0, $option);
		$this->arrTypes		= Array_Util::ColToPlain($res, 'id', 'name');

		$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_STYLE;
		$res			= Table_categories::getByParent(0, $option);
		$this->arrStyle		= Array_Util::ColToPlain($res, 'id', 'name');

		$this->articleType		= CnroConstant::CATEGORY_TYPE_PRODUCT;
	}

	public function executeEditProduct(sfWebRequest $request) {
		$this->setTemplate('editProduct');
	#	$this->arrAllCategories		= Table_categories::getAll();
		$this->articleId		= $request->getParameter('id', 0);
		$this->articleItem		= new Table_articles($this->articleId);
		$this->arrCategoryPath		= Table_categories::getCategoryPath($this->articleItem->category_id);
		$this->arrRangePath		= Table_categories::getCategoryPath($this->articleItem->range_id);

		$option			= array('limit' => 1000);
		$option['to_array']	= true;
		$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_RANGE;
		$res			= Table_categories::getByParent(0, $option);
		$this->arrRanges	= Array_Util::ColToPlain($res, 'id', 'name');

		$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_TYPE;
		$res			= Table_categories::getByParent(0, $option);
		$this->arrTypes		= Array_Util::ColToPlain($res, 'id', 'name');

		$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_STYLE;
		$res			= Table_categories::getByParent(0, $option);
		$this->arrStyle		= Array_Util::ColToPlain($res, 'id', 'name');
		$this->articleType		= CnroConstant::CATEGORY_TYPE_PRODUCT;
	}

	public function executeNewRange(sfWebRequest $request) {
		$this->setTemplate('editRange');
		$this->articleId		= $request->getParameter('id', 0);
		$this->articleItem		= new Table_articles($this->articleId);
		$this->arrRangePath		= Table_categories::getCategoryPath($this->articleItem->range_id);
		$this->articleType		= CnroConstant::CATEGORY_TYPE_PROD_RANGE;
	}

	public function executeEditRange(sfWebRequest $request) {
		$this->setTemplate('editRange');
		$this->articleId		= $request->getParameter('id', 0);
		$this->articleItem		= new Table_articles($this->articleId);
		$this->arrRangePath		= Table_categories::getCategoryPath($this->articleItem->range_id);
		$this->articleType		= CnroConstant::CATEGORY_TYPE_PROD_RANGE;
	}


	public function executeSave(sfWebRequest $request) {

		$this->articleId		= $request->getParameter('id', 0);
		$this->categoryId		= $request->getParameter('category_id', 0);

		$boolIsNewArticle		= $this->articleId == 0;


		$this->articleItem		= new Table_articles($this->articleId);

		if (!$this->articleItem->id) {
			$this->articleItem->save();
		}

		$arrParameters		= $request->getParameterHolder()->getAll();

		$arrUploads		= array(
						'pic'		=> 'upload_pic',
						'large_pic'	=> 'upload_large_pic',
						'pdf'		=> 'upload_pdf',
					);
		foreach ($arrUploads as $propertyName => $fieldName) {

			$uploadFile				= false;
			$uploadFile				= $this->saveUploadFile($this->articleItem->id, $fieldName);

	#	Debug::pr($uploadFile);

			if ($uploadFile) {
				$arrParameters[$propertyName]	= $uploadFile;
			}
		}

	#	Debug::pr($arrParameters);

		$this->articleItem->fromArray($arrParameters);
		$this->articleItem->save();

		$this->getUser()->setFlash('article_saved_ok', true);

		if ($boolIsNewArticle && $this->articleItem->id) {
		#	return	$this->redirect('article/edit?id=' . $this->articleItem->id);

			$arrActions	= array(
						-1					=> 'edit',
						CnroConstant::CATEGORY_TYPE_PRODUCT	=> 'editProduct',
						CnroConstant::CATEGORY_TYPE_PROD_RANGE	=> 'editRange',
					);

			$editType	= $this->articleItem->type;
			if (!isset($arrActions[$editType])) {
				$editType	= -1;
			}

			$action		= $arrActions[$editType];
			return	$this->redirect('article/'.$action.'?id=' . $this->articleItem->id);
		}

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	}

	private function saveUploadFile($articleId, $fieldName) {

			$webImagePath		= false;

			$filePath		= isset($_FILES[$fieldName]['tmp_name']) ?
							$_FILES[$fieldName]['tmp_name'] : 'NULL';

			if (file_exists($filePath)) {

				$arrNamePart		= explode('.', $_FILES[$fieldName]['name']);
				$extName		= array_pop($arrNamePart);
				$extName		= strtolower($extName);

				$webImagePath		= sprintf('/uploads/images/%08d.%s.%s',
									$articleId,
									$fieldName,
									$extName
								);

				$serverImagePath	= sfConfig::get('sf_host_dir') . $webImagePath;

				// remove existing file
				if (file_exists($serverImagePath)) {
					unlink($serverImagePath);
				}

				$bool			= move_uploaded_file($filePath, $serverImagePath);

			}

			return	$webImagePath;

	}

	private function saveUploadImage($articleId) {

			$webImagePath		= false;

		#	Debug::pre($_FILES);

			$filePath		= isset($_FILES['upload_pic']['tmp_name']) ?
							$_FILES['upload_pic']['tmp_name'] : 'NULL';

			if (file_exists($filePath)) {

				$arrNamePart		= explode('.', $_FILES['upload_pic']['name']);
				$extName		= array_pop($arrNamePart);

				/*
				$webImagePath		= sprintf('/uploads/article_images/%08d_%s_%d.%s',
									$articleId,
									date('Ymd_His'),
									rand(1000, 9999),
									$extName
								);
				*/

				$webImagePath		= sprintf('/uploads/images/%08d.%s',
									$articleId,
									$extName
								);

				$serverImagePath	= sfConfig::get('sf_host_dir') . $webImagePath;

				// remove existing file

				if (file_exists($serverImagePath)) {
					unlink($serverImagePath);
				}

				$bool			= move_uploaded_file($filePath, $serverImagePath);

			}

			return	$webImagePath;

	}

	public function executeDelete(sfWebRequest $request) {

		$this->articleId		= $request->getParameter('id', 0);
		$this->articleItem		= new Table_articles($this->articleId);

		if ($this->articleItem->id) {
			$this->articleItem->delete();
		}


		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	}

	private function getRangeByLike($type, $word, $request) {

			$parameter		= array(
				'word_1'	=> '%' . $word . '%',
				'word_2'	=> '%' . $word . '%',
				'word_3'	=> '%' . $word . '%',
			);

			$tableArticle	= new Table_articles();

			// use like
			$templateWhere	= 'FROM %s WHERE (title LIKE :word_1 OR detail LIKE :word_2 OR keyword LIKE :word_3) ';

			$parameter['type']	= $type;
			$templateWhere		.= ' AND type = :type ';

			$sqlWhere	= sprintf($templateWhere, $tableArticle->getTableName());

					// "FROM ... WHERE ..." (without SELECT)
					// �������� COUNT(*) �� SQL ��䣬ͳ�Ʒ��������ļ�¼������ע���Ǵ� FROM ��ʼ
			$stateCount	= $sqlWhere;
					// "SELECT c.*, m.* FROM ... WHERE ... ORDER ..." (without LIMIT)
					// ����ѡȡ��¼���������ָ���ֶΣ������������ֶ�
			$stateLimit	= 'SELECT * ' . $sqlWhere . ' ORDER BY published_at DESC';

			$pager		= new Simple_Pager();
			$pager->setCount($stateCount)->setLimit($stateLimit);
			$pager->setParameter($parameter);

			$page		= (int) $request->getParameter('page', 1);
			$pager->init($page, $this->pageSize);

			return	$pager;

	}

	private function getRangeByTotal($type, $request, $option = NULL) {

			$parameter		= array();

			$tableArticle	= new Table_articles();

			// use like
			$templateWhere	= 'FROM %s WHERE 1 ';

			$parameter['type']	= $type;
			$templateWhere		.= ' AND type = :type ';

			if (isset($option['published'])) {
				$parameter['published']	= $option['published'];
				$templateWhere			.= ' AND published = :published ';
			}

			$sqlWhere	= sprintf($templateWhere, $tableArticle->getTableName());

					// "FROM ... WHERE ..." (without SELECT)
					// �������� COUNT(*) �� SQL ��䣬ͳ�Ʒ��������ļ�¼������ע���Ǵ� FROM ��ʼ
			$stateCount	= $sqlWhere;
					// "SELECT c.*, m.* FROM ... WHERE ... ORDER ..." (without LIMIT)
					// ����ѡȡ��¼���������ָ���ֶΣ������������ֶ�
			$stateLimit	= 'SELECT * ' . $sqlWhere . ' ORDER BY created_at DESC';

			$pager		= new Simple_Pager();
			$pager->setCount($stateCount)->setLimit($stateLimit);
			$pager->setParameter($parameter);

			$page		= (int) $request->getParameter('page', 1);
			$pager->init($page, $this->pageSize);

			return	$pager;

	}


}
