<?php

/**
 * Pager
 *
 * @package     SofavDB
 * @subpackage  Pager
 * @link        www.leakon.com
 * @version     2009-01-05
 * @author      Leakon <leakon@gmail.com>
 */
class SofavDB_Pager extends Simple_Pager {

	protected
		$useObject	= false,	// whether return OBJECT type results

		$tableObject	= NULL,
		$property	= array();


	public function __construct(SofavDB_Table $tableObject) {
		$this->tableObject	= $tableObject;
	}

	public function useObject($value = true) {
		$this->useObject	= $value;
	}

	public function init($pageNumber = 1, $pageSize = 10, $property = array()) {

		$conn			= SofavDB_Manager::getConnection();

		if (!isset($property['where'])) {
			$property['where']	= array();
		}

		if (!isset($property['order'])) {
			$property['order']	= array();
		}

		$criteriaCount		= new SofavDB_Criteria();
		$criteriaCount->bind($property['where']);

		// find array-result
		$SqlCount		= sprintf('SELECT COUNT(*) AS total FROM %s %s',
							$this->tableObject->getTableName(), $criteriaCount->getStatement());

		$this->savedState['count']	= $SqlCount;

		$statementCount		= $conn->prepare($SqlCount);
		$arrBinding		= $criteriaCount->getBinding();
		$statementCount->execute($arrBinding);
		$arrRecords		= $statementCount->fetchAll(PDO::FETCH_ASSOC);

		$totalCount		= 0;
		if (isset($arrRecords[0]['total'])) {
			$totalCount	= (int) $arrRecords[0]['total'];
			if ($totalCount < 0) {
				$totalCount	= 0;
			}
		}

		$arrLimit		= $this->getLimit($pageNumber, $pageSize, $totalCount);

		$limit			= 'LIMIT ' . $arrLimit['start'] . ', ' . $arrLimit['count'];

		$strOrder		= '';
		if (count($property['order'])) {

			$arrOrders	= array();
			foreach ($property['order'] as $column => $order) {
				$arrOrders[]	= $column . ' ' . $order;
			}

			$strOrder	= 'ORDER BY ' . implode(',', $arrOrders);
		}

		$criteriaSelect		= new SofavDB_Criteria('WHERE @where ' . $strOrder . ' ' . $limit);
		$criteriaSelect->bind($property['where']);
		// find array-result
		$SqlSelect		= sprintf('SELECT * FROM %s %s',
							$this->tableObject->getTableName(), $criteriaSelect->getStatement());

		$this->savedState['limit']	= $SqlSelect;

		$statementSelect	= $conn->prepare($SqlSelect);
		$arrBinding		= $criteriaSelect->getBinding();
		$statementSelect->execute($arrBinding);

		$this->savedState['parameter']	= $arrBinding;

		$arrRecords		= $statementSelect->fetchAll(PDO::FETCH_ASSOC);

		// return OBJECT type result
		if ($this->useObject) {

			$cloneObject	= clone $this->tableObject;
			$cloneObject->reset();

			foreach ($arrRecords as $key => $arrItem) {
				$objNew			= clone $cloneObject;
				$arrRecords[$key]	= $objNew->hydrate($arrItem);
			}
		}

		// use ARRAY type result
		$this->result	= (array) $arrRecords;

		// set parent properties

		$this->setNbResults($totalCount);
		$this->setMaxPerPage($pageSize);
		$this->setPage($pageNumber);
		$this->setLastPage(ceil($totalCount / $pageSize));


		return	$this->result;

	}

}

