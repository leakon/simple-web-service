<?php

class portalActions extends sfActions {

	public function preExecute() {

		$this->objConf		= new Custom_Conf();

	}

	public function executeIndex(sfWebRequest $request) {

		$this->arrDataConf	= $this->objConf->getConf();

	}

	public function executeSave(sfWebRequest $request) {


		$arrParameters		= $request->getParameterHolder()->getAll();

	#	Debug::pre($arrParameters);

		$arrFields		= array(
						'block_1'		=> 1,
						'block_2'		=> 1,
						'block_3'		=> 1,
						'block_4'		=> 1,
						'block_5'		=> 1,
						'block_6'		=> 1,
		);


		$arrSavedForm		= array();


		foreach ($arrFields as $key => $v) {

			$fieldName	= 'cate_' . $key;

			if (isset($arrParameters[$fieldName]['top']) && isset($arrParameters[$fieldName]['sub'])) {

				$arrSavedForm[$fieldName]	= $arrParameters[$fieldName];

			}

		}

	#	Debug::pre($arrSavedForm);

		$this->objConf->setConf('block', $arrSavedForm);

		$refer	= $request->getParameter('refer', '');
		return	$this->redirect($refer);

	}


}
