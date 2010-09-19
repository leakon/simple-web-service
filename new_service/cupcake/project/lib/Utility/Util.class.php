<?php

/**
 * Util
 *
 * @package     Sofav
 * @subpackage  Util
 * @link        www.leakon.com
 * @version     2009-11-11
 * @author      Leakon <leakon@gmail.com>
 *
 * @notice	add Util::ERRNO_SUCCESS.
 */

class Util {

	const
		ERRNO_SUCCESS		= 0;		// 成功的 errno 数值

	protected static
		$standardReturn		= array('errno' => self::ERRNO_SUCCESS, 'error' => '');

	public static function getReturn() {
		return	self::$standardReturn;
	}

	public static function isRetOK(&$arrRet) {
		return	isset($arrRet['errno']) && self::ERRNO_SUCCESS === $arrRet['errno'];
	}


	// From http://w3.org/International/questions/qa-forms-utf-8.html
	public static function isUTF8($string) {

		//	IF mb_string is compiled, use mb_detect_order & mb_detect_encoding is prefered.
		//	mb_detect_order("UTF-8,GBK,SJIS,EUC-JP");
		//	$encoding	= mb_detect_encoding($string);

		$regex	= '/^('
			. '[\x09\x0A\x0D\x20-\x7E]|'		# ASCII
			. '[\xC2-\xDF][\x80-\xBF]|'		# non-overlong 2-byte
			. '\xE0[\xA0-\xBF][\x80-\xBF]|'		# excluding overlongs
			. '[\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}|'	# straight 3-byte
			. '\xED[\x80-\x9F][\x80-\xBF]|'		# excluding surrogates
			. '\xF0[\x90-\xBF][\x80-\xBF]{2}|'	# planes 1-3
			. '[\xF1-\xF3][\x80-\xBF]{3}|'		# planes 4-15
			. '\xF4[\x80-\x8F][\x80-\xBF]{2}'	# plane 16
			. ')*\z/x';

		return	1 == preg_match($regex, $string);
	}
}
