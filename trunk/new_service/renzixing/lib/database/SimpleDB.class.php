<?php

class SimpleDB {

	private static function getConnection() {

		static	$SimpleDBConnectionStatic = null;

		if (empty($SimpleDBConnectionStatic)) {

			// initialize database manager
			$databaseManager = new sfDatabaseManager();
			$databaseManager->initialize();

			// batch process here

			$dbInstance = $databaseManager->getDatabase('propel');
			$SimpleDBConnectionStatic = $dbInstance->getConnection();

			$statement = $SimpleDBConnectionStatic->prepareStatement("SET NAMES 'UTF8'");
			$resultset = $statement->executeQuery();

		}

		return	$SimpleDBConnectionStatic;
	}

/*
	private static function getResource() {

	}
*/

	public static function execute($SQL) {

		$statement = self::getConnection()->prepareStatement($SQL);
		$resultset = $statement->executeQuery();

		return	array(
		#	'resource'	=> $resultset,
			'bool'		=> $resultset->getResource(),
			'updated'	=> self::getConnection()->getUpdateCount()
		);
	}


	public static function fetchAll($SQL) {

		$statement = self::getConnection()->prepareStatement($SQL);
		$resultset = $statement->executeQuery();

		$arrRet = array();
		if ($intRecordCount = $resultset->getRecordCount()) {
			$resultset->first();
			for ($i = 0; $i < $intRecordCount; ++$i) {
				$arrRet[]	= $resultset->getRow();
				$resultset->next();
			}
		}

		return	$arrRet;

	}

	public static function escape($string) {

		static	$SimpleDBResourceStatic = null;

		if (empty($SimpleDBResourceStatic)) {
			$SimpleDBResourceStatic = $connnection->getResource();
		}

		return	mysql_real_escape_string($string, $SimpleDBResourceStatic);

	}


}