<?php

class S {

	protected static
		$ncrConvMap	= array(0x7F, 0xFFFFFF, 0x0, 0xFFFFFF);

	public static function E($str, $nl2br = false) {
		if ($nl2br) {
			return	nl2br(htmlspecialchars($str, ENT_COMPAT, 'UTF-8'));
		} else {
			return	htmlspecialchars($str, ENT_COMPAT, 'UTF-8');
		}
	}

	public static function KW($keyword) {

		if (!Util::isUTF8($keyword)) {
			$keyword	= mb_convert_encoding($keyword, 'UTF-8', 'GBK');
		}

		$keyword	= str_replace('%', '', $keyword);
		$keyword	= trim($keyword);
		return		$keyword;
	}

	public static function TK($string, $width = 8, $marker = '...') {
		return	mb_strimwidth($string, 0, $width, $marker, 'UTF-8');
	}

	public static function modHTML($html, $mod = 4, &$key) {
		$ret	= '';
		if ($key && 0 == ($key % $mod)) {
			$ret	=& $html;
		}
		return	$ret;
	}

	public static function trimLine($cont) {
		$cont	= str_replace("\r", '', $cont);
		$cont	= str_replace("\n", ' ', $cont);
		return	$cont;
	}

	public static function toLoaderJS($cont) {

		$cont	= self::trimLine($cont);
		$cont	= str_replace("'", "\'", $cont);
		$cont	= SofavConstant::TOOLBAR_RENDER_VAR . " = '" . $cont . "';";

		return	$cont;
	}

	public static function addSlashes4JS($cont) {

		$cont	= self::trimLine($cont);
		$cont	= str_replace("'", "\'", $cont);

		return	$cont;
	}

	public static function toNCR($str) {
		$str		= mb_encode_numericentity($str, self::$ncrConvMap, 'UTF-8');
		return		$str;
	}

	public static function curr($bool, $class = 'current') {
		return	$bool ? $class : '';
	}
}
