<?php

/**
 * Manager
 *
 * @package     SofavDB
 * @subpackage  Manager
 * @link        www.leakon.com
 * @version     2009-04-011
 * @author      Leakon <leakon@gmail.com>
 *
 * @notice	add default empty string to $conf['user'] and $conf['pass']
 */
class SofavDB_Manager {

	protected static
		$magicQuotesGPC		= false,
		$arrConnections		= array(),
		$arrDataSources		= array();

	public static function getConnection($connectionName = 'Table') {

		if (!isset(self::$arrConnections[$connectionName])) {
			try {
				$conf	= self::getConf($connectionName);

				$arrPDOOptions	= array();
				if (isset($conf['persistent'])) {
					$arrPDOOptions[PDO::ATTR_PERSISTENT]	= true;
				}

				if (isset($conf['debug']) && 'on' === $conf['debug']) {
					$conn	= new SofavDB_Debug_PDO($conf['dsn'], $conf['user'], $conf['pass'], $arrPDOOptions);
				} else {
					$conn	= new PDO($conf['dsn'], $conf['user'], $conf['pass'], $arrPDOOptions);
				}

			} catch (PDOException $e) {
				die('[SofavDB_Manager] Connection failed: ' . $e->getMessage());
			}
			if (isset($conf['encoding'])) {
				$conn->exec('SET NAMES ' . $conf['encoding']);
			}
			self::$arrConnections[$connectionName]	=& $conn;
		}

		return	self::$arrConnections[$connectionName];
	}

	// Get recently used database config
	public static function getConf($connectionName = 'Table') {

		if (isset(self::$arrDataSources[$connectionName])) {

			// example	mysql://root:123456@localhost:3306/sofav?encoding=utf8&persistent=on&debug=on
			// array	host, port, user, pass, db, encoding, persistent, debug, etc
			$arrParts		= parse_url(self::$arrDataSources[$connectionName]);

			// $arrParts['path'] = '/sofav_2008'
			$arrParts['db']		= substr($arrParts['path'], 1);

			// parse query_string to parameter array
			parse_str($arrParts['query'], $queryParameters);

			$arrConf		= array_merge($queryParameters, $arrParts);

			$arrConf['dsn']		= sprintf('%s:host=%s;port=%d;dbname=%s',
								$arrConf['scheme'], $arrConf['host'],
								isset($arrConf['port']) ? $arrConf['port'] : '3306',
								isset($arrConf['db']) ? $arrConf['db'] : ''
							);

			if (!isset($arrConf['user'])) {
				$arrConf['user']	= '';
			}

			if (!isset($arrConf['pass'])) {
				$arrConf['pass']	= '';
			}

			return	$arrConf;

		}

		return	array();
	}

	public static function addDataSource($strDataSource) {

		$strDataSource	= trim(str_replace("\r\n", "\n", $strDataSource));
		$arrSource	= array();

		foreach (explode("\n", $strDataSource) as $strItem) {

			// strip comments and space
			$strItem	= trim(preg_replace("/\#.*/i", "", $strItem));

			if (strlen($strItem)) {

				/*
					# The first connection
					first:	mysql://pma@localhost:3306/sofav?encoding=utf8&persistent=off	# test comment

					# The first connection
					second: mysql://root:123456@localhost:3306/sofav_2008?encoding=utf8&persistent=on
				*/
				$source	= preg_match("/[\t\s]*([^\t\s]+)\:[\t\s]+([^\#\t\s]*\#*.*)/i", $strItem, $matches);

				if (isset($matches[1]) && isset($matches[2])) {
					self::$arrDataSources[$matches[1]]	= trim($matches[2]);
				}
			}
		}

		return	self::$arrDataSources;
	}

	/**
	 * Restore original value of $_GET, $_POST, $_COOKIE (or $_REQUEST) by stripping slashes recusively
	 * only if get_magic_quotes_gpc() returns "1"
	 */
	public static function unQuote($mixedVar) {

		if (false === self::$magicQuotesGPC) {
			self::$magicQuotesGPC	= get_magic_quotes_gpc();
		}

		// magic_quotes_gpc = Off (php.ini)
		if (0 === self::$magicQuotesGPC) {
			return	$mixedVar;
		}

		// maybe a recusive call, helpful to skip detecting magicQuote above
		return	self::deepStripSlashes($mixedVar);
	}

	private static function deepStripSlashes($mixedVar) {

		$retVar		= NULL;

		if (!is_array($mixedVar)) {
			// most of cases are not array
			// so this branch get a higher priority and a better performance
			$retVar	= stripslashes($mixedVar);
		} else {
			foreach ($mixedVar as $key => $val) {
				$retVar[$key]	= self::deepStripSlashes($val);
			}
		}

		return	$retVar;
	}

}
