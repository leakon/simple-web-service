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
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeXXXIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }




	public function executeIndex($request) {

		$this->setTemplate('ordering');

		$this->pager		= $this->getListPager($request);

		$this->arrResult	= $this->pager->getResults();

		$this->arrResult_Common		= array();
		$this->arrResult_Special	= array();

		foreach ($this->arrResult as $record) {

			if (100 == $record['category']) {
				$this->arrResult_Common[]	= $record;
			}

			if (200 == $record['category']) {
				$this->arrResult_Special[]	= $record;
			}

		}

	#	Debug::pr($this->arrResult);

	}



	protected function getListPager($request) {

		$intPage	= (int) $request->getParameter('page', 1);
		$intSize	= 20;


		$objTable	= new Table_data_product();

		$sqlWhere	= sprintf('FROM %s ', $objTable->getTableName());

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
