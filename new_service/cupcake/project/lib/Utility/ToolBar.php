<?php

class ToolBar {

	public static function getLink($strAction = 'toolbar') {

/*

参考 http://amplify.com/m-iphone/ 工具栏 url

*/


		$strHref	= sprintf("javascript:
(

function(k) {

	if(window._SfS_) {
		_SfS_(k)
	} else {
		document.body.appendChild(document.createElement('script')).src='http://%s/bookmarklet/'+k;
	}
}

)('%s');
",
			SYMFONY_SERVER_HOST,
			$strAction
		);

		$strHref	= str_replace(
					//					Space
					array("\t",	"\r\n",		"\n",	" ",	"var"),
					array('',	'',		'',	'',	'var '),

				$strHref);

		return	$strHref;

	}


}