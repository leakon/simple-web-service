<?php

/**
 * Criteria
 *
 * @package     SofavDB
 * @subpackage  Criteria
 * @link        www.leakon.com
 * @version     2008-12-03
 * @author      Leakon <leakon@gmail.com>
 */
class SofavDB_Criteria {

	protected
		$strStatement	= '',
		$arrBinding	= array();

	protected static
		$instance	= NULL;

	/**
	 * Constructor
	 *
	 * @param String	statement with PLACEHOLDER, which has a preceding "@"
	 */
	public function __construct($statement = 'WHERE @where') {
		$this->strStatement	= $statement;
		return	$this;
	}

	/**
	 * Get existing instance
	 *
	 * for performance reason
	 */
	public static function getInstance($statement = 'WHERE @where') {
	//	return	new SofavDB_Criteria($statement);
		if (empty(self::$instance)) {
			self::$instance	= new SofavDB_Criteria($statement);
		} else {
			self::$instance->reset($statement);
		}
		return	self::$instance;
	}

	public function reset($statement = 'WHERE @where') {
		$this->strStatement	= $statement;
		$this->arrBinding	= array();
		return	$this;
	}

	/**
	 * Utility to join key value pairs into a sql statement.
	 *
	 * See SofavDB::findAll()'s instruction
	 *
	 * @notice	value binding in array will be auto escaped by PDO
	 *		in another word, place the value in constructor can NOT be esacped
	 *
	 * @example
	 *		// is dangerous
	 *		$criteria	= new SofavDB_Criteria("WHERE $where");
	 *
	 *		// is correct
	 *		$criteria	= new SofavDB_Criteria("WHERE @placeHolder");
	 *		$criteria->bind(array('name' => $name, 'pass' => $pass), 'AND', '@placeHolder');
	 *
	 */
	public function bind($arrKeyValue, $relation = 'AND', $placeHolder = '@where') {

		$holderValue	= '1';
		$arrJoin	= array();

		foreach ($arrKeyValue as $key => $val) {
			$arrJoin[]	= sprintf('%s = :%s', $key, $key);
		}

		if (count($arrJoin)) {
			$holderValue	= implode(' ' . $relation . ' ', $arrJoin);
		}

		if ($placeHolder) {
			$this->strStatement	= str_replace($placeHolder, $holderValue, $this->strStatement);
		}

		$this->arrBinding	= array_merge($this->arrBinding, $arrKeyValue);

		// $criteria->bind()->bind()->bind()...
		return	$this;
	}

	public function getStatement() {

		// if statement still has some placeholders
		if (false !== strpos($this->strStatement, '@')) {
			$this->strStatement	= str_replace('WHERE @where', '', $this->strStatement);
			$this->strStatement	= preg_replace("/\@[^@]*/", '', $this->strStatement);
		}

		return	$this->strStatement;
	}

	public function getBinding() {
		return	$this->arrBinding;
	}

}
