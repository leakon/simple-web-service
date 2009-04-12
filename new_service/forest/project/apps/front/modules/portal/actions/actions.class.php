<?php

class portalActions extends sfActions {


	public function preExecute() {

		$this->objConf			= new Custom_Conf();

		$this->defaultCategoryId	= 1000013;

	}


	public function executeIndex(sfWebRequest $request) {

		$this->arrDataConf	= $this->objConf->getConf();

		$this->arrDataRes	= array();

		foreach ($this->arrDataConf['block'] as $key => $val) {

			$subId		= isset($val['sub']) ? $val['sub'] : $this->defaultCategoryId;

			if (empty($this->arrDataRes[$subId])) {
				$this->arrDataRes[$subId]	= Table_articles::getByCategory($subId, 5);
			}

		}


	}

}
