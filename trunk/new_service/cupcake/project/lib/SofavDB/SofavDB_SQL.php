<?php

/**
 * SQL
 *
 * @package     SofavDB
 * @subpackage  SQL
 * @link        www.leakon.com
 * @version     2010-01-06
 * @author      Leakon <leakon@gmail.com>
 *
 * @notice	add fetchTotal()
 */

class SofavDB_SQL extends SofavDB_Criteria {

	protected static
		$singletonConn		= NULL;

	/**
	 * 执行 SQL 语句，用安全的方式绑定参数
	 *
	 * @param string	$sqlTemplate		SQL 语句模板，参数值部分使用占位符
	 						如：WHERE username = :username
	 * @param array		$arrParameters		Key => Value 设置的参数值，由 PDO 自动进行安全转义
	 *
	 * @return array	标准的返回值数组
	 			affected_rows: 影响的行数
	 *
	 * @notice		曾经遇到过 bind 参数时发生的错误，当 2 个 Key 中的一个是另一个的子集时，bind 会出错？
	 			比如有 2 个占位符：user、user_type
	 *
	 */
	public static function execute($sqlTemplate, $arrParameters = array(), $connName = 'Table') {

		$arrRet		= array('errno' => Util::ERRNO_SUCCESS);

		$conn		= SofavDB_Manager::getConnection($connName);

		$statement	= $conn->prepare($sqlTemplate);

		foreach ($arrParameters as $key => $val) {
			$placeHolder	= ':' . $key;
			$statement->bindParam($placeHolder, $val);
		}

		$bool		= $statement->execute();

		$arrRet['errno']	= $bool ? Util::ERRNO_SUCCESS : $statement->errorCode();
		if (!$bool) {
			$arrRet['error']	= $statement->errorInfo();
		}
		$arrRet['affected_rows']	= $statement->rowCount();

		return	$arrRet;
	}

	public static function fetch($sqlTemplate, $arrParameters = array(), $connName = 'Table') {

		$arrRet		= array();

		$arrRet		= self::fetchAll($sqlTemplate, $arrParameters, $connName);

		if (isset($arrRet['result'][0])) {
			$arrFirst		= $arrRet['result'][0];
			$arrRet['result']	= $arrFirst;
		}

		return	$arrRet;
	}

	public static function fetchAll($sqlTemplate, $arrParameters = array(), $connName = 'Table') {

		$arrRet		= array('errno' => Util::ERRNO_SUCCESS);

		$conn		= SofavDB_Manager::getConnection($connName);

		$statement	= $conn->prepare($sqlTemplate);

		foreach ($arrParameters as $key => $val) {
			$placeHolder	= ':' . $key;
			$statement->bindParam($placeHolder, $val);
		}

		$bool			= $statement->execute();
		$arrRet['result']	= array();

		$arrRet['errno']	= $bool ? Util::ERRNO_SUCCESS : $statement->errorCode();
		if ($bool) {
			$arrRet['result']	= $statement->fetchAll(PDO::FETCH_ASSOC);
		} else {
			$arrRet['error']	= $statement->errorInfo();
		}

		return	$arrRet;
	}

	/**
	 * 获取返回结果集中第 0 条记录的 total 字段
	 *
	 * SELECT COUNT(*) AS total FROM ...
	 * 如果不用 total 这个字段名，可以在第 2 个参数中设置其他名字
	 */
	public static function fetchTotal($sqlTemplate, $key = 'total', $arrParameters = array(), $connName = 'Table') {

		$arrRet		= array(
					'result'	=> 0
				);

		$arrResult	= self::fetchAll($sqlTemplate, $arrParameters, $connName);

		if (isset($arrResult['result'][0][$key])) {
			$arrRet['result']	= (int) $arrResult['result'][0][$key];
		}

		return	$arrRet;
	}

	public static function exec($SQL, $connName = 'Table') {

		if (empty(self::$singletonConn)) {
			self::$singletonConn	= SofavDB_Manager::getConnection($connName);
		}

		return	self::$singletonConn->exec($SQL);

	}

}