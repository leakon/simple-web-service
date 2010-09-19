<?php

/**
 * Array_Util
 *
 * @package     Sofav
 * @subpackage  Array_Util
 * @link        www.leakon.com
 * @version     2009-11-05
 * @author      Leakon <leakon@gmail.com>
 * @description	与 PHP 多维数组相关的工具集
 *
 * @notice	deepUrlEncode 初始化默认返回值类型
 */
class Array_Util {

	/**
	 * 差集分类，$arrList 和 $arrNeedle 都是符合 “查询结构” 的一维数组
	 * 通过交叉对比，在 $arrList 中出现的 key，划分到 added 中
	 * 在 $arrList 不存在的 key，则划分到 removed 中
	 */
	public static function diffAddRemove($arrList, $arrNeedle) {

		$arrRet			= array();

		$arrNeedAdd		= array();
		$arrNeedRemove		= array();

		foreach ($arrList as $itemId => $itemId_2) {

			if (isset($arrNeedle[$itemId])) {
				$arrNeedAdd[$itemId]	= $itemId;
			} else {
				$arrNeedRemove[$itemId]	= $itemId;
			}

		}

		$arrRet['removed']	= $arrNeedRemove;
		$arrRet['added']	= $arrNeedAdd;

		return	$arrRet;

	}

	/**
	 * 把数组的 value 设置为 key，同时维持 value 不变
	 */
	public static function valueToKey(&$arrOriginal, $needFlip = true) {

		if ($needFlip) {

			$arrTmp	= array();

			foreach ($arrOriginal as $value) {
				$arrTmp[$value]		= $value;
			}

			$arrOriginal	= $arrTmp;
		}

	#	return	$arrOriginal;
	}

	/**
	 * 把数组的 key 设置为 value，同时维持 key 不变
	 */
	public static function keyToValue(&$arrOriginal, $needFlip = true) {

		if ($needFlip) {

			$arrTmp	= array();

			foreach (array_keys($arrOriginal) as $key) {
				$arrTmp[$key]		= $key;
			}

			$arrOriginal	= $arrTmp;
		}

	#	return	$arrOriginal;
	}

	/**
	 * 获取合法的 Map 元素
	 * $arrMap: index => index
	 * $arrMap 中的元素在 $arrTotalRecord 中出现时，标记为合法元素并取出
	 */
	public static function getMatched(&$arrTotalRecord, &$arrMap, $testCol = 'id') {

		$arrValidMap	= array();

		foreach ($arrTotalRecord as $key => $val) {

			if (isset($val[$testCol])) {

				$id	= $val[$testCol];

				if (isset($arrMap[$id])) {
					$arrValidMap[$id]	= $id;
				}

			}

		}

		return	$arrValidMap;
	}


	/**
	 * $arrList 与 $arrMap 做比较，比较的依据是子数组的 $listCol 与 $mapCol 字段的值是否相等
	 * 相等则给 $arrList 标记 checked
	 *
	 * 如果忽略了 $mapCol 参数，意味着 $arrMap 是 “查询结构”，即 index => index，可以按索引快速查询
	 */
	public static function markMatched(&$arrList, $listCol, &$arrMap, $mapCol = false) {

		$intCountChecked	= 0;

		if (false === $mapCol) {

			// $arrMap 已经是查询结构
			$arrSearch	=& $arrMap;

		} else {

			// 生成查询结构

			$arrSearch	= array();

			foreach ($arrMap as $record) {
				// 根据 $mapCol 字段生成查询结构
				if (isset($record[$mapCol])) {
					$mapId			= $record[$mapCol];
					$arrSearch[$mapId]	= $mapId;
				}
			}
		}

		// $arrSearch 必须是 index => index 的“查询结构结构，可以按索引快速查询
		foreach ($arrList as $key => $val) {

			if (isset($val[$listCol])) {

				$id		= $val[$listCol];

				// 匹配了 map，标记为 checked
				if (isset($arrSearch[$id])) {
					$arrList[$key]['checked']	= 1;
					$intCountChecked++;
				}
			}

		}

		return	$intCountChecked;
	}


	/**
	 * 按字段，生成一维数组，或生成用于 html option 的数组
	 * 遍历 $arrResult，选其中的 2 个字段分别作为 key 和 val
	 * 生成新数组
	 */
	public static function ColToPlain(&$arrResult, $key, $val) {

		$arrRet		= array();

		foreach ($arrResult as $record) {

			if (isset($record[$key]) && isset($record[$val])) {

				$arrRet[$record[$key]]	= $record[$val];

			}

		}

		return	$arrRet;

	}

	/**
	 * 按字段，生成多维数组
	 * 遍历 $arrResult，选其中的 1 个字段分别作为 key，多个字段作为子数组
	 * 生成新数组
	 */
	public static function ColToCom(&$arrResult, $key, $arrVal) {

		$arrRet		= array();

		foreach ($arrResult as $record) {

			if (isset($record[$key])) {

				$arrTmp		= array();

				foreach ($arrVal as $val) {

					if (isset($record[$val])) {
						$arrTmp[$val]	= $record[$val];
					}

				}

				$arrRet[$record[$key]]	= $arrTmp;

			}

		}

		return	$arrRet;

	}


	/**
	 * 按集合中数组的字段进行排序
	 */
	public static function sortColumn(&$arrRecords, $colName, $reverse = false, $sort_flags = false) {

		$arrOrder	= array();

		foreach (array_keys($arrRecords) as $key) {
			$arrOrder[$key]		= $arrRecords[$key][$colName];
		}

		if (false === $sort_flags) {

			if ($reverse) {
				arsort($arrOrder);	// 降序
			} else {
				asort($arrOrder);	// 升序
			}

		} else {

			if ($reverse) {
				arsort($arrOrder, $sort_flags);	// 降序
			} else {
				asort($arrOrder, $sort_flags);	// 升序
			}

		}

		$arrRet		= array();

		foreach (array_keys($arrOrder) as $key) {
			$arrRet[$key]		= $arrRecords[$key];
		}

		return	$arrRet;

	}

	/**
	 * 按集合中对象的字段进行排序
	 */
	public static function sortProperty(&$arrRecords, $propertyName, $reverse = false, $sort_flags = false) {

		$arrOrder	= array();

		foreach (array_keys($arrRecords) as $key) {
			$arrOrder[$key]		= $arrRecords[$key]->$propertyName;
		}

		if (false === $sort_flags) {

			if ($reverse) {
				arsort($arrOrder);	// 降序
			} else {
				asort($arrOrder);	// 升序
			}

		} else {

			if ($reverse) {
				arsort($arrOrder, $sort_flags);	// 降序
			} else {
				asort($arrOrder, $sort_flags);	// 升序
			}

		}

		$arrRet		= array();

		foreach (array_keys($arrOrder) as $key) {
			$arrRet[$key]		= $arrRecords[$key];
		}

		return	$arrRet;

	}

	public static function deepUrlEncode($mixedVar) {

		if (is_array($mixedVar)) {

			// init array
			$retVar		= array();

			foreach ($mixedVar as $key => $val) {
				$retVar[$key]	= self::deepUrlEncode($val);
			}
		} else {

			// init string
			$retVar		= '';

			// most of cases are not array
			// so this branch get a higher priority and a better performance
			$retVar	= urlencode($mixedVar);
		}

		return	$retVar;
	}

	public static function deepUrlDecode($mixedVar) {

		$retVar		= NULL;

		if (is_array($mixedVar)) {
			foreach ($mixedVar as $key => $val) {
				$retVar[$key]	= self::deepUrlEncode($val);
			}
		} else {
			// most of cases are not array
			// so this branch get a higher priority and a better performance
			$retVar	= urldecode($mixedVar);
		}

		return	$retVar;
	}


	public static function quoteArray($arrInput, $quoteChar = "'") {

		foreach ($arrInput as $key => $val) {
			$arrInput[$key]	= $quoteChar . $val . $quoteChar;
		}

		return	$arrInput;

	}

}
