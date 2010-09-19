<?php

class IMG {

	public static function PATH() {
		return	'/images/';
	}

	public static function favIcon($url) {

		if (1 || SofavConf::ENV == 'dev') {
			// 本地开发时使用默认图片，加快加载速度
			return	SofavConf::FAVICON_HTTP_HOST . '/favicon.queue.ico';
		}

		return		SofavConf::FAVICON_HTTP_HOST . '/service/favicon/' . Url_Util::getDomainOnly($url);

	/*
		return		'/images/favicons/google_favicon.ico';

		$arrConf	= parse_url($url);
		return		'http://www.google.com/s2/favicons?domain=' . $arrConf['host'];
	*/

	}

	public static function privateIcon() {

		return		'<img src="/images/icons/private_lock.gif" alt="私密的书签 只有您自己可以看到" title="私密的书签 只有您自己可以看到" />';

	}

}
