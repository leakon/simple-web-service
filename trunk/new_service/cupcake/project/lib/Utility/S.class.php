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

	/**
	 * 取模，返回指定的 html 片段
	 * 用于 li 标签生成的列表，当每行 n 列时，为了避免每一列的高度不一致导致下一行不能正确显示
	 * 在 2 行之间插入一个全宽度的 li，可以避免此类问题
	 */
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
	#	$cont	= str_replace("'", "\'", $cont);
		$cont	= addslashes($cont);	// 使用 addslashes 才是安全的方法
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

	public static function Money($floatMoney) {
		$str		= number_format($floatMoney, 2, '.', ',');
		return		$str;
	}

	public static function curr($bool, $class = 'current') {
		return	$bool ? $class : '';
	}

	public static function richTime($key, $value) {

		return input_date_tag($key, $value, array(
								'rich'			=> true,
								'format'		=> 'yyyy-MM-dd HH:mm:ss',
								'calendar_options'	=> 'showsTime: true',
							));

	}

	public static function dateTime($key, $value) {

		return input_date_tag($key, $value, array(
								'rich'			=> true,
								'format'		=> 'yyyy-MM-dd',
								'calendar_options'	=> 'showsTime: false',
							));

	}


	public static function StaticVer() {
		return	sfConfig::get('app_front_static_cache_version', '');
	}



}
