<?php

class Vars {

	public static function getByKey(&$arrVar, $strKey, $default = '') {

		return	isset($arrVar[$strKey]) ? $arrVar[$strKey] : $default;

	}


}