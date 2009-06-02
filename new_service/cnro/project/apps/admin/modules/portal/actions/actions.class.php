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

	#	Debug::pre($arrParameters);

		$arrFields		= array(

				'cate_focus'			=> 1,
				'cate_head'			=> 1,

				'cate_news_1'		=> 1,
				'cate_news_2'		=> 1,

				'cate_block_1'		=> 1,
				'cate_block_2'		=> 1,
				'cate_block_3'		=> 1,
				'cate_block_4'		=> 1,
				'cate_block_5'		=> 1,
				'cate_block_6'		=> 1,

				'use_user'		=> 1,
				'index_ad_1'		=> 1,
				'index_ad_2'		=> 1,
				'index_ad_1_link'	=> 1,
				'index_ad_2_link'	=> 1,

				'cate_scroll_1'		=> 1,
				'cate_scroll_2'		=> 1,

				'cate_side_1'		=> 1,
				'cate_side_2'		=> 1,

				'friend_total'		=> 1,
				'friend_text'		=> 1,
				'friend_link'		=> 1,

		);



		$arrSavedForm		= array();


		foreach ($arrFields as $fieldName => $v) {

		#	if (isset($arrParameters[$fieldName]['top']) && isset($arrParameters[$fieldName]['sub'])) {
			if (isset($arrParameters[$fieldName])) {
				$arrSavedForm[$fieldName]	= $arrParameters[$fieldName];

			}

		}

	#	Debug::pre($arrSavedForm);

		$this->objConf->setConf('block', $arrSavedForm);

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	}
	public function executeMessage(sfWebRequest $request) {

		$this->arrConf_Message	= $this->objConf->getConf('message');

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
