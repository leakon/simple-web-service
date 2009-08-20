<?php

/**
 * SofavDB_Symfony provides connectivity for the SofavDB database abstraction layer
 *
 * <b>Optional parameters:</b>
 *
 * # <b>dsn</b>            - [none]   - The DSN formatted connection string.
 *
 * @package     SofavDB
 * @subpackage  Symfony
 * @link        www.leakon.com
 * @version     2008-10-15
 * @author      Leakon <leakon@gmail.com>
 */
class SofavDB_Symfony extends sfDatabase {

	public function initialize($parameters = array()) {

		parent::initialize($parameters);

		$this->addDSN();

	}

	public function addDSN() {

		// dsn example:	mysql://root:123456@localhost:3306/sofav_2008?encoding=utf8&persistent=off
		$dsn		= $this->getParameter('dsn', false);

		if (false === $dsn) {
			// missing required dsn parameter
			throw new sfDatabaseException(
				'[SofavDB_Symfony] Database configuration specifies method "dsn", but is missing dsn parameter.');
		}

		SofavDB_Manager::addDataSource($dsn);
	}

	/**
	 * Connect to the database.
	 *
	 * @throws <b>sfDatabaseException</b> If a connection could not be created.
	 */
	public function connect() {

		try {

			$this->connection	= SofavDB_Manager::getConnection($this->getParameter('name', 'Table'));

			// get our resource
			$this->resource		=& $this->connection;

		} catch (SQLException $e) {
			throw new sfDatabaseException('[SofavDB_Symfony]' . $e->toString());
		}
	}

	/**
	 * Execute the shutdown procedure.
	 *
	 * @return void
	 *
	 * @throws <b>sfDatabaseException</b> If an error occurs while shutting down this database.
	 */
	public function shutdown() {
		if ($this->connection !== NULL) {
			$this->connection	= NULL;
		}
	}

}
