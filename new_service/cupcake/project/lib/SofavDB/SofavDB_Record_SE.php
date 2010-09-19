<?php

/**
 * Record Simple Edition
 *
 * @package     SofavDB
 * @subpackage  Record_SE
 * @link        www.leakon.com
 * @version     2009-11-10
 * @author      Leakon <leakon@gmail.com>
 *
 * @notice	Simple method, never create object before call static methods
 */
class SofavDB_Record_SE {

	public static function find($strTableClass, SofavDB_Criteria $criteria, $findObject = true) {
		$obj		= new $strTableClass();
		return		SofavDB_Record::find($obj, $criteria, $findObject);
	}

	public static function findAll($strTableClass, SofavDB_Criteria $criteria, $findObject = true) {
		$obj		= new $strTableClass();
		return		SofavDB_Record::findAll($obj, $criteria, $findObject);
	}

	public static function matchAll($strTableClass, $findObject = true) {
		$obj		= new $strTableClass();
		return		SofavDB_Record::matchAll($obj, $findObject);
	}

	public static function match($strTableClass, $findObject = true) {
		$obj		= new $strTableClass();
		return		SofavDB_Record::match($obj, $findObject);
	}


}
