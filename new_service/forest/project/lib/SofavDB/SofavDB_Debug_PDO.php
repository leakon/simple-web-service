<?php

/**
 * Debug_PDO
 *
 * @package     SofavDB
 * @subpackage  Debug_PDO
 * @link        www.leakon.com
 * @version     2009-01-10
 * @author      Leakon <leakon@gmail.com>
 */
class SofavDB_Debug_PDO extends PDO {

	public function prepare($statement, $driver_options = array()) {

		$parentStatement	= parent::prepare($statement, $driver_options);
		$debugStatement		= new SofavDB_Debug_PDO_Statement($parentStatement, $statement);

		return			$debugStatement;
	}

	public static function getTimer($detail = false) {
		return	SofavDB_Debug_PDO_Statement::getTimer($detail);
	}

}

/**
 * Debug_PDO_Statement
 *
 * @package     SofavDB
 * @subpackage  Debug_PDO_Statement
 * @link        www.leakon.com
 * @version     2009-01-07
 * @author      Leakon <leakon@gmail.com>
 */
class SofavDB_Debug_PDO_Statement {

	protected
		$sqlPrepare	= '',
		$PDOStatement	= NULL;

	protected static
		$arrTimerLog	= array();

	public function __construct(PDOStatement $instanceStatement, $sqlToPrepare = '') {

		if ($instanceStatement) {
			$this->PDOStatement	= $instanceStatement;
		}

		$this->sqlPrepare	= $sqlToPrepare;
	}

	public function __call($method, $arguments) {

		$arrTimer		= array();
		$arrTimer['type']	= 'PDOStatement::' . $method;
		$arrTimer['begin']	= microtime(true);
		$ret			= call_user_func_array(array($this->PDOStatement, $method), $arguments);
		$arrTimer['end']	= microtime(true);

		if ('execute' == $method) {
			$arrTimer['sql']	= '[' . $ret . '] ' . $this->sqlPrepare;
		}

		self::$arrTimerLog[]	= $arrTimer;

		return	$ret;
	}

	public static function getTimer($detail = false) {

		if (count(self::$arrTimerLog)) {

			$arrLog		= self::$arrTimerLog;

			$totalTime	= 0.0;

			foreach ($arrLog as $key => $arrTimer) {

				if ('PDOStatement::execute' != $arrTimer['type']) {
					unset($arrLog[$key]);
					continue;
				}

				$eachTime			= sprintf('%4.6f', $arrTimer['end'] - $arrTimer['begin']);
				$arrLog[$key]['time']		= number_format($eachTime * 1000, 3, '.', ',') . ' ms';
				$totalTime			+= $eachTime;

				if (!$detail) {
					unset($arrLog[$key]['begin']);
					unset($arrLog[$key]['end']);
				}

			}

			$arrLog['total_time']	= number_format($totalTime * 1000, 3, '.', ',') . ' ms';

			return	$arrLog;
		}

		return	self::$arrTimerLog;
	}

}
