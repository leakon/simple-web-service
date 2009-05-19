<?php

/**
 * SQL_Util
 *
 * @package     Sofav
 * @subpackage  SQL_Util
 * @link        www.leakon.com
 * @version     2009-05-1
 * @author      Leakon <leakon@gmail.com>
 * @description	����SQL�����صĹ��ߺ�����
 *
 * @notice
 */
class SQL_Util {

	/**
	 * �Ѱ������� id Ԫ�ص����飬�зֳɶ�������飬���������� WHERE IN (xxx) ���������
	 * ���� MySQL ÿ�����ɽ��ܵ��ַ����������ޣ��������һ�����ʵ������鳤�ȣ����� xxx �������ǳ��б�Ҫ
	 * @param 1	ԭʼ������
	 * @param 2	ÿ��������ĳ��ȣ�������
	 * @param 3	ʹ��ԭʼ����� key ���� value ��Ϊ�������ֵ
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

