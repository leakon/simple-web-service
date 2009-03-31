<?php

/**
 * Table
 *
 * @package     SofavDB
 * @subpackage  Table
 * @link        www.leakon.com
 * @version     2009-02-23
 * @author      Leakon <leakon@gmail.com>
 *
 * @notice	add new method getConnectionName()
 */
abstract class SofavDB_Table {

	/**
	 * Initialization
	 *
	 * @notice: This public function should be implemented in sub-class.
	 * @example:
			public function initialize() {

				$this->setTableName('users');

				$this->hasColumn('username');
				$this->hasColumn('password');
				$this->hasColumn('mail');
				$this->hasColumn('create_time');
			}
	 */
	abstract function initialize();


	/* ---------------------------------------------------- */
	/* Following codes should not be concerned by sub-class */
	protected
		$connectionName		= 'Table',		// SofavDB_Manager::getConnection($connectionName);
		$tableName		= '',
		$arrProperties		= array('id' => NULL),	// array which holds record columns, id is the default incremental primary key
		$arrModifiedColumns	= array();

	// define table name
	protected function setTableName($tableName) {
		$this->tableName	= $tableName;
	}

	// define a table column
	protected function hasColumn($columnName) {
		// for performance reason, I do NOT check whether the column has been added before
		$this->arrProperties[$columnName]	= NULL;
	}

	// for high performance, same with hasColumn
	protected function hasColumns($arrColumnsName) {
		foreach ($arrColumnsName as $columnName) {
			$this->arrProperties[$columnName]	= NULL;
		}
	}

	/**
	 * Get table name
	 *
	 * It's useful when you have data stored on multiple table, like data_0, data_1, ..., data_15
	 * You can redefine your hash logic which get the real table to handle
	 */
	public function getTableName() {
		return	$this->tableName;
	}

	public function getConnectionName() {
		return	$this->connectionName;
	}

	public function reset() {
		$this->arrModifiedColumns	= array();
		foreach ($this->arrProperties as $columnName => $val) {
			$this->arrProperties[$columnName]	= NULL;
		}
	}

	public function __construct($id = false) {

		// initialize table definition, defined in sub-class
		$this->initialize();

		if ($id) {

			$criteria	= new SofavDB_Criteria();
			$criteria->bind(array('id' => $id));
			$arrRecord	= SofavDB_Record::find($this, $criteria, false);
			if (isset($arrRecord['id'])) {
				$this->arrProperties['id']	= $id;
				$this->hydrate($arrRecord);
			}
		}
	}

	/**
	 * Hydrate, convert array-record to object-record
	 */
	public function hydrate($arrSingleResult) {

		foreach ($this->arrProperties as $columnName => $columnValue) {
			if (isset($arrSingleResult[$columnName])) {
				$this->arrProperties[$columnName]	= $arrSingleResult[$columnName];
			}
		}

		$this->afterHydrate($arrSingleResult);

		return	$this;
	}

	public function save() {

		$this->beforeSave();

		$ret	= empty($this->arrProperties['id']) ? $this->doInsert() : $this->doUpdate();
		// clear modified column
		$this->arrModifiedColumns	= array();
		return	$ret;
	}

	public function delete() {

		if ($this->arrProperties['id']) {

			$criteria	= new SofavDB_Criteria();
			$arrWhere	= array('id' => $this->arrProperties['id']);
			$criteria->bind($arrWhere);

			$bool		= SofavDB_Record::doDelete($this, $criteria);

			$this->arrProperties['id']	= NULL;
			$this->arrModifiedColumns	= array();

			return	$bool;

		}

		return	false;
	}

	protected function doInsert() {

		if (!$this->isModified()) {
			return;
		}

		if (array_key_exists('create_time', $this->arrProperties) && empty($this->arrProperties['create_time'])) {
			$this->arrProperties['create_time']	= time();
		}

		if (array_key_exists('created_at', $this->arrProperties) && empty($this->arrProperties['created_at'])) {
			$this->arrProperties['created_at']	= date('Y-m-d H:i:s');
		}

		$arrBinding	= array();
		foreach ($this->arrProperties as $key => $val) {

			// some column is "NOT NULL", so it must be skipped when executing INSERT sql
			if (isset($this->arrProperties[$key])) {
				$arrBinding[$key]	= $val;
			}
		}

		$criteria	= new SofavDB_Criteria('@set');
		$criteria->bind($arrBinding, ',', '@set');
		$insertId	= SofavDB_Record::doInsert($this, $criteria);

		if ($insertId) {
			$this->arrProperties['id']	= $insertId;
		}

		return		$insertId;
	}

	protected function doUpdate() {

		$this->beforeUpdate();

		if (!$this->isModified()) {
			return;
		}

		$arrJoin	= array();
		foreach ($this->arrModifiedColumns as $key => $true) {
			$arrJoin[$key]		= $this->arrProperties[$key];
		}

		if (array_key_exists('update_time', $this->arrProperties)) {
			$this->arrProperties['update_time']	= $arrJoin['update_time']	= time();
		}

		if (array_key_exists('updated_at', $this->arrProperties)) {
			$this->arrProperties['updated_at']	= $arrJoin['updated_at']	= date('Y-m-d H:i:s');
		}

		$criteria	= new SofavDB_Criteria('SET @set WHERE @where');
		$arrWhere	= array('id' => $this->arrProperties['id']);
		$criteria->bind($arrJoin, ',', '@set')->bind($arrWhere, '', '@where');
		$bool		= SofavDB_Record::doUpdate($this, $criteria);

		return		$bool ? $this->arrProperties['id'] : false;
	}

	protected function beforeUpdate() {
		/* implemented in sub-class */
	}

	protected function beforeSave() {
		/* implemented in sub-class */
	}

	protected function afterHydrate($arrOneRecord) {
		/* implemented in sub-class */
		// modifiy properties
	}

	protected function afterFromArray($arrParameters) {
		/* implemented in sub-class */
		// modifiy properties
	}

	protected function afterToArray($copiedProperty) {
		/* implemented in sub-class */
		// return modified array
		return	$copiedProperty;
	}

	/**
	 * Set properties from array
	 *
	 * It's similar with $this->hydrate($arr), but set value in lazy form
	 */
	public function fromArray($arrParameters) {

		if (isset($arrParameters['id'])) {
			unset($arrParameters['id']);
		}

		foreach ($this->arrProperties as $columnName => $columnValue) {

			// if column is defined and not equal to params, update the value and mark column as modified
			if (isset($arrParameters[$columnName]) &&
				$this->arrProperties[$columnName] != $arrParameters[$columnName]) {

			//	$this->arrProperties[$columnName]	= $arrParameters[$columnName];
			//	$this->arrModifiedColumns[$columnName]	= true;		// marked as modified
				$this->set($columnName, $arrParameters[$columnName]);
			}
		}

		$this->afterFromArray($arrParameters);

		return	$this;
	}

	public function toArray() {

		$arrProperty		= $this->arrProperties;
		$arrProperty['id']	= $this->id;

		$arrProperty		= $this->afterToArray($arrProperty);

		return	$arrProperty;
	}

	protected function isModified() {
		return	count($this->arrModifiedColumns);
	}

	/**
	 * set property in class, and mark column as modified
	 *
	 */
	protected function set($key, $value) {
		$this->arrModifiedColumns[$key]	= true;		// marked as modified
		$this->arrProperties[$key]	= $value;
		return	$value;
	}

	/* magic method */
	public function __set($key, $value) {
		if (array_key_exists($key, $this->arrProperties)) {
		//	$this->arrModifiedColumns[$key]	= true;		// marked as modified
		//	$this->arrProperties[$key]	= $value;
			$this->set($key, $value);
		}
		return	$value;
	}

	public function __get($key) {
		return	isset($this->arrProperties[$key]) ? $this->arrProperties[$key] : NULL;
	}

	public function __isset($key) {
		return	isset($this->arrProperties[$key]);
	}

}
