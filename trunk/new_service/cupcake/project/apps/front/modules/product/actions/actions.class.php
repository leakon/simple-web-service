<?php

/**
 * product actions.
 *
 * @package    cupcake
 * @subpackage product
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class productActions extends sfActions
{
	
	public function preExecute() {
		
		$this->strLang		= 'en';
		
	}
	
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeXXXIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }


	
	public function executeIndexCh($request) {
		
		$this->setLayout('layout_ch');
		
		$this->setTemplate('orderingCh');
		
		$this->strLang		= 'ch';
		
		$this->pager		= $this->getListPager($request);

		$this->arrResult	= $this->pager->getResults();

		$this->arrResult_Common		= array();
		$this->arrResult_Special	= array();

		foreach ($this->arrResult as $record) {

			if (Table_data_product::CATEGORY_NORMAL == $record['category']) {
				$this->arrResult_Common[]	= $record;
			}

			if (Table_data_product::CATEGORY_SPECIAL == $record['category']) {
				$this->arrResult_Special[]	= $record;
			}

		}

		usort($this->arrResult_Special, array($this, 'compareResult'));
		
	#	Debug::pr($this->arrResult_Special);

	}
	
	

	public function executeIndex($request) {

		$this->setTemplate('ordering');

		$this->pager		= $this->getListPager($request);

		$this->arrResult	= $this->pager->getResults();

		$this->arrResult_Common		= array();
		$this->arrResult_Special	= array();

		foreach ($this->arrResult as $record) {

			if (Table_data_product::CATEGORY_NORMAL == $record['category']) {
				$this->arrResult_Common[]	= $record;
			}

			if (Table_data_product::CATEGORY_SPECIAL == $record['category']) {
				$this->arrResult_Special[]	= $record;
			}

		}
		
		usort($this->arrResult_Special, array($this, 'compareResult'));
		
	#	Debug::pr($this->arrResult_Special);

	}


	public function compareResult($left, $right) {
		if ($left['sort_id'] == $right['sort_id']) {
			return 0;
		}
		return ($left['sort_id'] < $right['sort_id']) ? -1 : 1;
	}



	protected function getListPager($request) {

		$intPage	= (int) $request->getParameter('page', 1);
		$intSize	= 20;


		$objTable	= new Table_data_product();

		$sqlWhere	= sprintf("FROM %s WHERE lang = '%s' ", $objTable->getTableName(), $this->strLang);

				// "FROM ... WHERE ..." (without SELECT)
		$stateCount	= $sqlWhere;
				// "SELECT c.*, m.* FROM ... WHERE ... ORDER ..." (without LIMIT)
		$stateLimit	= 'SELECT * ' . $sqlWhere . ' ORDER BY id ASC';

		$pager		= new Simple_Pager();
		$pager->setCount($stateCount)->setLimit($stateLimit);

		$pager->init($intPage, $intSize);

		return	$pager;

	}







}
