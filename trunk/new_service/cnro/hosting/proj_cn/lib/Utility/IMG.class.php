<?php

class IMG {

	public static function PATH() {
		return	'/images/';
	}

	public static function favIcon($url) {

		return		'/images/favicons/google_favicon.ico';

		$arrConf	= parse_url($url);
		return		'http://www.google.com/s2/favicons?domain=' . $arrConf['host'];
	}

}
