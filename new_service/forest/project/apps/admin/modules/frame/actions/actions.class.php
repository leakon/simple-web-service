<?php

class frameActions extends sfActions {

	public function executeIndex(sfWebRequest $request) {
	#	$this->forward('default', 'module');
		return	$this->redirect('/admin/index.php');
	}

	public function executeMenu(sfWebRequest $request) {
	}

	public function executeMain(sfWebRequest $request) {
	}

}
