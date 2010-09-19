<?php

/**
 * SofavDB_Trans
 * handle multiple transaction operations
 *
 * @package     SofavDB
 * @subpackage  Symfony
 * @link        www.leakon.com
 * @version     2009-08-02
 * @author      Leakon <leakon@gmail.com>
 */
class SofavDB_Trans {

	const	ENABLE_LOG		= false;

	static	$arrStack		= array();
	static	$arrHasRollBack		= array();

	public static function begin($connName = 'Table') {

		$ret	= false;
		$log	= '';

		// 已经有 rollBack 请求，后续所有的 begin 全部抛出异常
		if (isset(self::$arrHasRollBack[$connName]) && true === self::$arrHasRollBack[$connName]) {
			throw new Exception('Found previous rollBack() request, skip following transactions. [Skip begin()]');
			return	$ret;
		}

		if (empty(self::$arrStack[$connName])) {
			self::$arrStack[$connName]	= array();
			$conn	= SofavDB_Manager::getConnection($connName);
			$ret	= $conn->beginTransaction();
			$log	.= "---- New ---- \n";
			$log	.= '[Begin   ]	[Run]';
		} else {
			$log	.= '[Begin   ]	[Skip]';
		}

		array_push(self::$arrStack[$connName], '1');

		if (true === self::ENABLE_LOG && strlen($log)) {
			$log	.= sprintf("	[length][%d]\n", count(self::$arrStack[$connName]));
			echo	$log;
		}

		return	$ret;
	}

	public static function commit($connName = 'Table') {

		$ret		= false;
		$log		= '';
		$intStackLength	= 0;

		// 已经有 rollBack 请求，后续所有的 commit 全部抛出异常
		if (isset(self::$arrHasRollBack[$connName]) && true === self::$arrHasRollBack[$connName]) {
			throw new Exception('Found previous rollBack() request, skip following transactions. [Skip commit()]');
			return	$ret;
		}

		if (isset(self::$arrStack[$connName]) && count(self::$arrStack[$connName])) {

			$intStackLength		= count(self::$arrStack[$connName]);

			array_pop(self::$arrStack[$connName]);
			if (empty(self::$arrStack[$connName])) {
				$conn	= SofavDB_Manager::getConnection($connName);
				$ret	= $conn->commit();
				$log	.= '[Commit  ]	[Run]';
			} else {
				$log	.= '[Commit  ]	[Skip]';
			}

			if (true === self::ENABLE_LOG && strlen($log)) {
				$log	.= sprintf("	[length][%d]\n", count(self::$arrStack[$connName]));
				echo	$log;
			}

		}

		return	$ret;

	}

	public static function rollBack($connName = 'Table') {

		$ret		= false;
		$log		= '';

		$intStackLength	= 0;

		if (isset(self::$arrStack[$connName]) && count(self::$arrStack[$connName])) {

			$intStackLength		= count(self::$arrStack[$connName]);

			if (1 === $intStackLength) {
				// 对应最外层的 Begin

				unset(self::$arrStack[$connName]);
				unset(self::$arrHasRollBack[$connName]);
				$conn	= SofavDB_Manager::getConnection($connName);
				$ret	= $conn->rollBack();

				$log	.= '[RollBack]	[Run]	[ClearTrans]' . "\n";

			} else {

				// 已经有 rollBack 请求，后续所有的 rollBack 全部忽略
				if (isset(self::$arrHasRollBack[$connName]) && true === self::$arrHasRollBack[$connName]) {

					$log	.= '[RollBack]	[Skip]';

				} else {

					// 还未有 rollBack 请求，设置标志位
					self::$arrHasRollBack[$connName]	= true;

					$log	.= '[RollBack]	[Call]';
				}

				array_pop(self::$arrStack[$connName]);

			}

			if (true === self::ENABLE_LOG && strlen($log)) {
				if (isset(self::$arrStack[$connName])) {
					$log	.= sprintf("	[length][%d]\n", count(self::$arrStack[$connName]));
				}
				echo	$log;
			}

		}

		return	$ret;

	}

}
