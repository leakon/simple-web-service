<?php

/**
 * Debug
 *
 * @package     Sofav
 * @subpackage  Debug
 * @link        www.leakon.com
 * @version     2009-06-29
 * @author      Leakon <leakon@gmail.com>
 *
 * @notice	Add cpr(), cpre() for CLI mode print debug
 */
class Debug {

	public static function pr($arr, $nameSpace = '') {
		echo	'<pre style="font-family:Courier New; font-size:13px; text-align:left;">';
		if ($nameSpace) {
			echo	$nameSpace;
			echo	"\n";
		}
		print_r($arr);
		echo	'</pre>';
	}

	public static function eh($html, $nameSpace = '') {

		echo	'<pre style="font-family:Verdana; font-size:14px; text-align:left;">';
		if ($nameSpace) {
			echo	$nameSpace;
			echo	"\n";
		}
		echo	htmlspecialchars($html);
		echo	'</pre>';
	}

	public static function pre($arr, $nameSpace = '') {
		self::pr($arr, $nameSpace);
		exit;
	}

	public static function cpr($arr, $nameSpace = '', $encoding = 'UTF-8') {
		echo	"\n";
		if ($nameSpace) {
			echo	$nameSpace;
			echo	"\n";
		}

		$arr	= self::convert($arr, $encoding);

		print_r($arr);
		echo	"\n";
	}

	public static function cpre($arr, $nameSpace = '') {
		self::cpr($arr, $nameSpace);
		exit;
	}

	protected static function convert($array, $encoding = 'UTF-8') {

		if ('UTF-8' === $encoding) {
			return	$array;
		}

		if (is_array($array)) {

			foreach ($array as $key => $val) {
				$array[$key]	= self::convert($val, $encoding);
			}

		} else {

			$array	= mb_convert_encoding($array, $encoding, 'UTF-8');

		}

		return	$array;

	}


}