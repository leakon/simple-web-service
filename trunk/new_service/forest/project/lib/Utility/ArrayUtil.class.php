<?php



class ArrayUtil {


	/**
	 * 按集合中数组的字段进行排序
	 */
	public static function sortColumn(&$arrRecords, $colName, $reverse = false) {

		$arrOrder	= array();

		foreach (array_keys($arrRecords) as $key) {
			$arrOrder[$key]		= $arrRecords[$key][$colName];
		}

		if ($reverse) {
			arsort($arrOrder);	// 降序
		} else {
			asort($arrOrder);	// 升序
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
	public static function sortProperty(&$arrRecords, $propertyName, $reverse = false) {

		$arrOrder	= array();

		foreach (array_keys($arrRecords) as $key) {
			$arrOrder[$key]		= $arrRecords[$key]->$propertyName;
		}

		if ($reverse) {
			arsort($arrOrder);	// 降序
		} else {
			asort($arrOrder);	// 升序
		}

		$arrRet		= array();

		foreach (array_keys($arrOrder) as $key) {
			$arrRet[$key]		= $arrRecords[$key];
		}

		return	$arrRet;

	}
}
