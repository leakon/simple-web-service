<?php

class portalActions extends sfActions {


	public function preExecute() {

		$this->objConf			= new Custom_Conf();

		$this->defaultCategoryId	= 1000013;

	}


	public function executeIndex(sfWebRequest $request) {

		$this->arrDataConf_Block	= $this->objConf->getConf('block');

/*
		$this->arrDataRes	= array();

		foreach ($this->arrDataConf['block'] as $key => $val) {

			$subId		= isset($val['sub']) ? $val['sub'] : $this->defaultCategoryId;

			$total		= 5;

			if ('cate_head' == $key) {
				$total		= 7;
			}

			if (empty($this->arrDataRes[$subId])) {
				$this->arrDataRes[$subId]	= Table_articles::getByCategory($subId, $total, array('published' => 1));
			}

		}
*/


	}

}
