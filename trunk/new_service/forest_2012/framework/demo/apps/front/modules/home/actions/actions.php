<?php

class homeActions extends SPF_Actions {

	public function preExecute() {
	    
	}


	public function executeIndex($request) {
        
        $this->type = 'llk';
        
        $this->words    = array();
        
        $this->words[]  = myBaseTestAutoLoad::sayHi();
        $this->words[]  = myTestAutoLoad::hello();

	}

	public function executeSignIn($request) {

	}


}
