<?php

/**
 * SQL_Util
 *
 * @package     Sofav
 * @subpackage  SQL_Util
 * @link        www.leakon.com
 * @version     2009-05-1
 * @author      Leakon <leakon@gmail.com>
 * @description	用于SQL语句相关的工具函数库
 *
 * @notice
 */
class SQL_Util {

	/**
	 * 把包含大量 id 元素的数组，切分成多个子数组，可用于生成 WHERE IN (xxx) 这样的语句
	 * 由于 MySQL 每条语句可接受的字符串长度有限，因此设置一个合适的子数组长度，避免 xxx 过长，非常有必要
	 * @param 1	原始长数组
	 * @param 2	每个子数组的长度（整数）
	 * @param 3	使用原始数组的 key 还是 value 作为子数组的值
	 */
	public static function sliceArray(&$arrInput, $intLength, $useKey = false) {

		$arrOutput	= array();
		$arrOutIndex	= 0;
		$intPos		= 0;

		foreach ($arrInput as $key => $val) {

			if (empty($arrOutput[$arrOutIndex])) {
				$arrOutput[$arrOutIndex]	= array();
			}

			$arrOutput[$arrOutIndex][$intPos]	= $useKey ? $key : $val;

			$intPos++;
			if ($intPos == $intLength) {
				$arrOutIndex++;
				$intPos				= 0;
			}

		}

		return	$arrOutput;

	}

	public static function joinRange(&$arrRange, $joinChar = ',', $quoteChar = "'") {

		$arrLines	= array();

		foreach ($arrRange as $val) {
			$arrLines[]	= $quoteChar . $val . $quoteChar;
		}

		return	implode($joinChar, $arrLines);

	}


}

