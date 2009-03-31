<?php

class Debug {

	static public function pr($arr, $nameSpace = '') {
		echo	'<pre style="font-family:Courier New; font-size:13px">';
		if ($nameSpace) {
			echo	$nameSpace;
			echo	"\n";
		}
		print_r($arr);
		echo	'</pre>';
	}

	static public function eh($html, $nameSpace = '') {

		echo	'<pre style="font-family:Verdana; font-size:14px">';
		if ($nameSpace) {
			echo	$nameSpace;
			echo	"\n";
		}
		echo	htmlspecialchars($html);
		echo	'</pre>';
	}

	static public function pre($arr, $nameSpace = '') {
		self::pr($arr, $nameSpace);
		exit;
	}
}