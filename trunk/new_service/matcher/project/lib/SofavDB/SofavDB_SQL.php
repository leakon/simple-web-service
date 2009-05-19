<?php

/**
 * SQL
 *
 * @package     SofavDB
 * @subpackage  SQL
 * @link        www.leakon.com
 * @version     2009-03-18
 * @author      Leakon <leakon@gmail.com>
 *
 */
class SofavDB_SQL extends SofavDB_Criteria {

	protected static
		$singletonConn		= NULL;

	public function execute(&$connection) {
		$statement	= $connection->prepare($this->strStatement);
		return		$statement->execute($this->arrBinding);
	}

	public function fetchAll(&$connection) {
		$statement	= $connection->prepare($this->strStatement);
		$statement->execute($this->arrBinding);
		return		$statement->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function exec($SQL, $connName = 'Table') {

		if (empty(self::$singletonConn)) {
			self::$singletonConn	= SofavDB_Manager::getConnection($connName);
		}

		return	self::$singletonConn->exec($SQL);

	}

}