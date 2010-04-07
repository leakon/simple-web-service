<?php

/**
 * PagerBase
 *
 * @package     SofavDB
 * @subpackage  PagerBase
 * @link        www.leakon.com
 * @version     2009-01-13
 * @modified	getLimit() fix abnormal page number
 * @author      Leakon <leakon@gmail.com>
 */
class Simple_Pager_Base {

	protected
		$page			= 1,
		$maxPerPage		= 0,
		$lastPage		= 1,
		$nbResults		= 0,
		$cursor			= 1,
		$currentMaxLink		= 1,
		$result			= array();

	/**
	 * get limit array
	 *
	 * @param int	$page		page number from request
	 * @param int	$size		item number in each page
	 * @param int	$total		total matched records in database
	 */
	public function getLimit($page, $size, $total) {

		if ($page < 1) {
			$page	= 1;
		}

		$arrReturn	= array(
			'start'	=> 0,
			'count'	=> $size
		);

		// for start
		if ($page) {
			$arrReturn['start']	= ($page - 1) * $size;
		}

		// 最后一条记录的索引 = $total - 1
		// 因此如果 start 超过最后的索引，则应该找到真正的最后一页
		if ($total && $arrReturn['start'] > ($total - 1)) {
			// total=23, size=10, then page=5 will match the case
			// should reset to last page
			// ceil(23/10)	=> 3
			// 3 is the last page number
			$page			= ceil($total / $size);
			$arrReturn['start']	= ($page - 1) * $size;
		}

		return	$arrReturn;

	}

	public function getResults() {
		return	$this->result;
	}

	public function getCurrentMaxLink()
	{
		return $this->currentMaxLink;
	}

	public function getLinks($nb_links = 5)
	{
		$links = array();
		$tmp   = $this->page - floor($nb_links / 2);
		$check = $this->lastPage - $nb_links + 1;
		$limit = ($check > 0) ? $check : 1;
		$begin = ($tmp > 0) ? (($tmp > $limit) ? $limit : $tmp) : 1;

		$i = $begin;
		while (($i < $begin + $nb_links) && ($i <= $this->lastPage))
		{
			$links[] = $i++;
		}

		$this->currentMaxLink = $links[count($links) - 1];

		return $links;
	}

	public function haveToPaginate()
	{
		return (($this->getPage() != 0) && ($this->getNbResults() > $this->getMaxPerPage()));
	}

	public function getNbResults()
	{
		return $this->nbResults;
	}

	protected function setNbResults($nb)
	{
		$this->nbResults = $nb;
	}

	public function getFirstPage()
	{
		return 1;
	}

	public function getLastPage()
	{
		return $this->lastPage;
	}

	protected function setLastPage($page)
	{
		$this->lastPage = $page;
		if ($this->getPage() > $page)
		{
			$this->setPage($page);
		}
	}

	public function getPage()
	{
		return $this->page;
	}

	public function getNextPage()
	{
		return min($this->getPage() + 1, $this->getLastPage());
	}

	public function getPreviousPage()
	{
		return max($this->getPage() - 1, $this->getFirstPage());
	}

	public function setPage($page)
	{
		$page = intval($page);

		$this->page = ($page <= 0) ? 1 : $page;
	}

	public function getMaxPerPage()
	{
		return $this->maxPerPage;
	}

	public function setMaxPerPage($max)
	{
		if ($max > 0)
		{
			$this->maxPerPage = $max;
			if ($this->page == 0)
			{
				$this->page = 1;
			}
		}
		else if ($max == 0)
		{
			$this->maxPerPage = 0;
			$this->page = 0;
		}
		else
		{
			$this->maxPerPage = 1;
			if ($this->page == 0)
			{
				$this->page = 1;
			}
		}
	}

}


class Simple_Pager extends Simple_Pager_Base {

	protected
		$stateCount	= '',
		$stateLimit	= '',
		$stateParameter	= array();

	protected
		$savedState	= array();

	public function setCount($strStatement) {
		$this->stateCount	= $strStatement;
		return	$this;
	}

	public function setLimit($strStatement) {
		$this->stateLimit	= $strStatement;
		return	$this;
	}

	public function setParameter($stateParameter) {
		$this->stateParameter	= $stateParameter;
		return	$this;
	}

	public function init($pageNumber = 1, $pageSize = 10) {

	#	$parameter		= array();

		$parameter		= $this->stateParameter;

		$conn			= SofavDB_Manager::getConnection();

		$SqlCount		= 'SELECT COUNT(*) AS total ' . $this->stateCount;

		$this->savedState['count']	= $SqlCount;

		$statementCount		= $conn->prepare($SqlCount);
		$statementCount->execute($parameter);
		$arrRecords		= $statementCount->fetchAll(PDO::FETCH_ASSOC);

		$totalCount		= 0;
		if (isset($arrRecords[0]['total'])) {
			$totalCount	= (int) $arrRecords[0]['total'];
			if ($totalCount < 0) {
				$totalCount	= 0;
			}
		}

		$arrLimit		= $this->getLimit($pageNumber, $pageSize, $totalCount);

		$limit			= ' LIMIT ' . $arrLimit['start'] . ', ' . $arrLimit['count'];
		$SqlLimit		= $this->stateLimit . $limit;

		$this->savedState['limit']	= $SqlLimit;

		$statementSelect	= $conn->prepare($SqlLimit);

		$statementSelect->execute($parameter);
		$this->savedState['parameter']	= $parameter;

		$arrRecords		= $statementSelect->fetchAll(PDO::FETCH_ASSOC);

		$this->result	= (array) $arrRecords;

		// set parent properties

		$this->setNbResults($totalCount);
		$this->setMaxPerPage($pageSize);
		$this->setPage($pageNumber);
		$this->setLastPage(ceil($totalCount / $pageSize));

		return	$this->result;

	}

	public function getState() {
		return	$this->savedState;
	}

	public function getPageUri($arrSkipParameter = array('page')) {
		return	self::getQueryString($arrSkipParameter);
	}

	public function getPageQueryString($arrSkipParameter = array('page')) {
		return	self::getQueryString($arrSkipParameter);
	}

	public static function getQueryString($arrSkipParameter = array('page')) {

		$queryString	= $_SERVER['QUERY_STRING'];

		parse_str($queryString, $arrParameters);

		$retUri		= '?';

		foreach ($arrSkipParameter as $oneParameter) {
			if (isset($arrParameters[$oneParameter])) {
				unset($arrParameters[$oneParameter]);
			}
		}

		$arrPairs	= array();

		foreach ($arrParameters as $key => $val) {
			$arrPairs[]	= $key . '=' . $val;
		}

		if (count($arrPairs)) {
			$retUri	.= implode('&', $arrPairs) . '&';
		}

		return	$retUri;
	}

	public static function trim($queryString) {
		return	preg_replace("/[?&]*$/i", '', $queryString);
	}

}
