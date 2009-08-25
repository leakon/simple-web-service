<?php

class portalActions extends sfActions {

	public function preExecute() {

		$this->objConf		= new Custom_Conf();

		$this->arrConf_PASS	= $this->objConf->getConf('password');
		if (!isset($this->arrConf_PASS['password'])) {
			$this->objConf->setConf('password', array('password' => 'admin'));
		}

	}

	public function executeIndex(sfWebRequest $request) {

		$this->arrDataConf	= $this->objConf->getConf();

	}

	public function executeSave(sfWebRequest $request) {

		$arrParameters		= $request->getParameterHolder()->getAll();

		$arrFields		= array(

			#	'block_1'		=> 1,
			#	'block_2'		=> 1,
			#	'block_3'		=> 1,

				'image_nitrogen'		=> 1,
				'image_vegetables'		=> 1,
				'image_hypoxic'		=> 1,

				'middle_left'		=> 1,
				'middle_right'		=> 1,

				'right_1'		=> 1,
				'right_2'		=> 1,

				'contacts'		=> 1,
				'cooperate'		=> 1,
				'nav_num'		=> 1,
				'product_pos'		=> 1,
				'range_pos'		=> 1,

				'nav_pic_src'		=> 1,
				'nav_pic_link'		=> 1,


		);

		$arrSavedForm		= array();

		foreach ($arrFields as $fieldName => $v) {

			$arrSavedForm[$fieldName]	= $arrParameters[$fieldName];

			/*
		#	if (isset($arrParameters[$fieldName]['top']) && isset($arrParameters[$fieldName]['sub'])) {
			if (isset($arrParameters[$fieldName])) {
			#	$arrSavedForm[$fieldName]	= $arrParameters[$fieldName];

			}
			*/

		}

	#	Debug::pre($arrSavedForm);

		$this->objConf->setConf('block', $arrSavedForm);



		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	}


	private function getArticleByTotal($request, $option = NULL) {

			$parameter		= array();

			$tableArticle	= new Table_messages();

			// use like
			$templateWhere	= 'FROM %s WHERE 1 ';

			$sqlWhere	= sprintf($templateWhere, $tableArticle->getTableName());

					// "FROM ... WHERE ..." (without SELECT)
					// 用于生成 COUNT(*) 的 SQL 语句，统计符合条件的记录总数，注意是从 FROM 开始
			$stateCount	= $sqlWhere;
					// "SELECT c.*, m.* FROM ... WHERE ... ORDER ..." (without LIMIT)
					// 用于选取记录，这里可以指定字段，并加上排序字段
			$stateLimit	= 'SELECT * ' . $sqlWhere . ' ORDER BY id DESC';

			$pager		= new Simple_Pager();
			$pager->setCount($stateCount)->setLimit($stateLimit);
			$pager->setParameter($parameter);

			$page		= (int) $request->getParameter('page', 1);
			$pager->init($page, $this->pageSize);

			return	$pager;

	}

	public function executeDeleteMessage(sfWebRequest $request) {

		$this->articleId		= $request->getParameter('id', 0);
		$this->articleItem		= new Table_messages($this->articleId);

		if ($this->articleItem->id) {
			$this->articleItem->delete();
		}

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	}


	public function executeMessage(sfWebRequest $request) {

		$this->pageSize		= 15;

		$this->arrConf_Message	= $this->objConf->getConf('message');

		$this->pager		= $this->getArticleByTotal($request);
		$this->arrResult	= $this->pager->getResults();

	}

	public function executeSaveMessage(sfWebRequest $request) {

		$this->arrConf_Message	= $this->objConf->getConf('message');

		$arrParameters		= $request->getParameterHolder()->getAll();

		if (isset($this->arrConf_Message)) {
			$this->arrConf_Message	= $this->arrConf_Message ? '0' : '1';
		}



		$this->objConf->setConf('message', $this->arrConf_Message);

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	}

	public function executeFilter(sfWebRequest $request) {

		$this->arrConf_Filter	= $this->objConf->getConf('filter');

	}

	public function executeSaveFilter(sfWebRequest $request) {

		$this->arrConf_Filter	= $this->objConf->getConf('filter');

		$arrParameters		= $request->getParameterHolder()->getAll();

		if (isset($arrParameters['add_words'])) {
			foreach ($arrParameters['add_words'] as $word) {
				$word				= trim($word);
				if (strlen($word)) {
					$md5				= md5($word);
					$this->arrConf_Filter[$md5]	= $word;
				}
			}
		} else {

		#	Debug::pre($arrParameters);
		}

		if (isset($arrParameters['delete_words'])) {

			foreach ($arrParameters['delete_words'] as $word) {
				$word				= trim($word);
				if (strlen($word)) {
					$md5				= md5($word);
					if (isset($this->arrConf_Filter[$md5])) {
						unset($this->arrConf_Filter[$md5]);
					}
				}
			}

		}


		$this->objConf->setConf('filter', $this->arrConf_Filter);

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	}


	public function executeFriend(sfWebRequest $request) {

		$this->arrConf_HELP	= $this->objConf->getConf('help');

	}

	public function executeSaveFriend(sfWebRequest $request) {

		$arrParameters		= $request->getParameterHolder()->getAll();


		$arrFields		= array(

				'friend_total'		=> 1,
				'friend_text'		=> 1,
				'friend_link'		=> 1,

		);

		$arrSavedForm		= array();

		foreach ($arrFields as $fieldName => $v) {

			if (isset($arrParameters[$fieldName])) {
				$arrSavedForm[$fieldName]	= $arrParameters[$fieldName];

			}

		}

		$this->objConf->setConf('help', $arrSavedForm);

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	}

	public function executeAdvertise(sfWebRequest $request) {

		$this->arrDataConf	= $this->objConf->getConf();
	}

	public function executeSaveAdvertise(sfWebRequest $request) {

		$arrParameters		= $request->getParameterHolder()->getAll();

	#	Debug::pre($arrParameters);

		$arrFields		= array(

				'article_ad_1'		=> 1,
				'article_ad_2'		=> 1,
				'article_ad_1_link'	=> 1,
				'article_ad_2_link'	=> 1,

		);

		$arrData		= $this->objConf->getConf();
	#	$arrSavedForm		= array();
		$arrSavedForm		=& $arrData['block'];

		foreach ($arrFields as $fieldName => $v) {

		#	if (isset($arrParameters[$fieldName]['top']) && isset($arrParameters[$fieldName]['sub'])) {
			if (isset($arrParameters[$fieldName])) {
				$arrSavedForm[$fieldName]	= $arrParameters[$fieldName];

			}

		}

	#	Debug::pre($arrSavedForm);
	#	Debug::pre($arrData);

		$this->objConf->setConf('block', $arrSavedForm);

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	}

	public function executePassword(sfWebRequest $request) {

		$this->arrConf_PASS	= $this->objConf->getConf('password');

	}

	public function executeSavePass(sfWebRequest $request) {

		$this->arrConf_PASS	= $this->objConf->getConf('password');

		$old_pass		= $request->getParameter('old_pass', '');
		$password		= $request->getParameter('password', '');
		$confirm		= $request->getParameter('confirm', '');

		if ($this->arrConf_PASS['password'] == $old_pass && $password == $confirm) {

			$arrParameters		= $request->getParameterHolder()->getAll();


			$arrFields		= array(

					'password'		=> 1,

			);

			$arrSavedForm		= array();

			foreach ($arrFields as $fieldName => $v) {

				if (isset($arrParameters[$fieldName])) {
					$arrSavedForm[$fieldName]	= $arrParameters[$fieldName];

				}

			}

			$this->objConf->setConf('password', $arrSavedForm);


			$this->getUser()->setFlash('newPasswordOK', true);

		} else {

			$this->getUser()->setFlash('newPasswordOK', false);

		}

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	}

}
