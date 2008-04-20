<?php

class HelperView {

	public static function getRefer() {

	#	$request	= $this->getContext()->getRequest();
		$request	= sfContext::getInstance()->getRequest();

		if ($reqRefer = $request->getParameter('refer')) {
			// first, check the request look for refer url
			return	$reqRefer;

		} else if ($browserRefer = $request->getReferer()) {
			// second, check the browser refer
			return	$browserRefer;

		}

		return	'';
	}


	public static function getString($var, $default = '') {
		return	strlen($var) ? $val : $default;
	}

	public static function getArray($arr, $index, $default = '') {
		return	isset($arr[$index]) ? $arr[$index] : $default;
	}

	public static function pr($arr) {
		echo	'<pre>';
		print_r($arr);
		echo	'</pre>';
	}

	public static function getTextArea($str) {

		return	nl2br($str);

	}


}

