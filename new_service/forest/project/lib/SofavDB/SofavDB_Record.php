<?php

/**
 * Record
 *
 * @package     SofavDB
 * @subpackage  Record
 * @link        www.leakon.com
 * @version     2009-02-23
 * @author      Leakon <leakon@gmail.com>
 *
 * @notice	SofavDB_Manager::getConnection($tableObject->getConnectionName())
 */
class SofavDB_Record {

	/**
	 * Get one record
	 *
	 * @return	Object/Array
	 */
	public static function find(SofavDB_Table $tableObject, SofavDB_Criteria $criteria, $findObject = true) {

		$arrRecords	= self::findAll($tableObject, $criteria, $findObject);

		if (isset($arrRecords[0])) {
			return	$arrRecords[0];
		}

		// not found first record, return default value
	#	$tableObject->reset();
		$newObject	= clone $tableObject;
		$newObject->reset();

		return	$findObject ? $newObject : array();
	}

	/**
	 * Get all records
	 *
	 * @example
			$criteria	= new SofavDB_Criteria();
			$criteria->bind(array('id' => 10, 'name' => "leakon's sofav"));

			// OR:

			$criteria	= new SofavDB_Criteria('WHERE @placeholder_1 ORDER BY id DESC LIMIT 0, 10');
			$criteria->bind(array('id' => 10, 'name' => "leakon's sofav"), 'OR', '@placeholder_1');
		//	=> WHERE id = :id OR name = :name ORDER BY id DESC LIMIT 0, 10
		//	$arrBinding	= array('id' => 10, 'name' => "leakon's sofav");
		//	final sql	= 'SELECT * FROM table_name WHERE id = '10' OR name = 'leakon\'s sofav' ORDER BY id DESC LIMIT 0, 10';

			$user			= new User();
			$objectRecords		= SofavDB_Record::findAll($user, $criteria);		// get object
			$objectRecords[0]	=> (OBJECT);
			$objectRecords[1]	=> (OBJECT);
			...
			$objectRecords[9]	=> (OBJECT);

			// OR
			$arrayRecords		= SofavDB_Record::findAll($user, $criteria, false);	// get array
			$arrayRecords[0]	=> array(...);
			$arrayRecords[1]	=> array(...);
			...
			$arrayRecords[9]	=> array(...);


	 * @notice
	 		It's not necessary to escape the value
	 		The value will be escaped by PDO

	 *
	 * @return	Object/Array
	 */
	public static function findAll(SofavDB_Table $tableObject, SofavDB_Criteria $criteria, $findObject = true) {

		// find array-result
		$strSQL			= sprintf('SELECT * FROM %s %s', $tableObject->getTableName(), $criteria->getStatement());
		$statement		= SofavDB_Manager::getConnection($tableObject->getConnectionName())->prepare($strSQL);
		$arrBinding		= $criteria->getBinding();
		$bool			= $statement->execute($arrBinding);
	//	self::catchError($tableObject, $bool);
		$arrRecords		= $statement->fetchAll(PDO::FETCH_ASSOC);

		// hydrate array to object
		if (true === $findObject) {

			$arrAllObjects	= array();

			if ($arrRecords) {

			#	$className	= get_class($tableObject);

			#	$tableObject->reset();	// clear all property's value
				$newObject	= clone $tableObject;
				$newObject->reset();

				foreach ($arrRecords as $key => $arrSingleRecord) {
					// $arrSingleRecord is an array

				#	$singleObj		= new $className();
				#	$arrAllObjects[$key]	= $singleObj->hydrate($arrSingleRecord);

				#	$tableObject->reset();	// clear all property's value
				#	$cloneObject		= clone $tableObject;
					$cloneObject		= clone $newObject;

				#	Debug::pr($tableObject);
				#	Debug::pr($arrSingleRecord);

					$arrAllObjects[$key]	= $cloneObject->hydrate($arrSingleRecord);

				}

			}

		#	Debug::pr($arrAllObjects);

			return	$arrAllObjects;
		}

		// or return array-result
		return	$arrRecords;
	}

	public static function matchAll(SofavDB_Table $tableObject, $findObject = true) {

		$arrWhere	= array();
		$arrRecords	= array();

		$arrProperty	= $tableObject->toArray();

		foreach ($arrProperty as $key => $val) {
			if (isset($val)) {
				$arrWhere[$key]	= $val;
			}
		}

		if ($arrWhere) {

			$criteria	= new SofavDB_Criteria();
			$criteria->bind($arrWhere);
			$arrRecords	= self::findAll($tableObject, $criteria, $findObject);

		}

		return	$arrRecords;
	}

	public static function match(SofavDB_Table $tableObject, $findObject = true) {

		$arrRecords	= self::matchAll($tableObject, $findObject);

		if (isset($arrRecords[0])) {
			return	$arrRecords[0];
		}

		// not found first record, return default value
	#	$tableObject->reset();
		$newObject	= clone $tableObject;
		$newObject->reset();
		return	$findObject ? $newObject : array();
	}

	public static function doInsert(SofavDB_Table $tableObject, SofavDB_Criteria $criteria) {

		$conn			= SofavDB_Manager::getConnection($tableObject->getConnectionName());
		$strSQL			= sprintf('INSERT INTO %s SET %s', $tableObject->getTableName(), $criteria->getStatement());
		$statement		= $conn->prepare($strSQL);
		$arrBinding		= $criteria->getBinding();

		$bool			= $statement->execute($arrBinding);
	//	self::catchError($tableObject, $bool);

		$insertId		= $conn->lastInsertId();

		return	$bool ? $insertId : false;
	}

	public static function doUpdate(SofavDB_Table $tableObject, SofavDB_Criteria $criteria) {

		$conn			= SofavDB_Manager::getConnection($tableObject->getConnectionName());
		$strSQL			= sprintf('UPDATE %s %s', $tableObject->getTableName(), $criteria->getStatement());
		$statement		= $conn->prepare($strSQL);
		$arrBinding		= $criteria->getBinding();

		$bool			= $statement->execute($arrBinding);
	//	self::catchError($tableObject, $bool);

		return	$bool;
	}

	public static function doDelete(SofavDB_Table $tableObject, SofavDB_Criteria $criteria) {

		$conn			= SofavDB_Manager::getConnection($tableObject->getConnectionName());
		$strSQL			= sprintf('DELETE FROM %s %s', $tableObject->getTableName(), $criteria->getStatement());
		$statement		= $conn->prepare($strSQL);
		$arrBinding		= $criteria->getBinding();

		$bool			= $statement->execute($arrBinding);
	//	self::catchError($tableObject, $bool);

		return	$bool;
	}

	protected static function catchError($tableObject, $bool = false) {

		$errroInfo	= array();
		if (!$bool) {
			$errroInfo	= SofavDB_Manager::getConnection($tableObject->getConnectionName())->errorInfo();
		}

		/*
			use system function log the error
			error_log(...);
		*/
	}

}
