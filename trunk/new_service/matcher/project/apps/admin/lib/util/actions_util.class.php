<?php

class ActionsUtil {

	public static function needTrue($ifTrue = false) {
		if (true !== $ifTrue) {
			die("needTrue!");
		}
	}

	public static function notAuthorized($info = array()) {
		die("Not authorized!");
	}

	public static function dieSuspicious($ifFalse = false) {
		if (false === $ifFalse) {
			die("You did something suspicious!");
		}
	}

	public static function needPOST(&$request) {
		if (sfRequest::POST != $request->getMethod()) {
			return	self::notAuthorized();
		}
		return	true;
	}

	public static function redirect($uri, $parameters, $refer = false) {

		if (true === $refer) {				// 如果设置为 true，则自动获取 request 的 refer 字段
			$request	= sfContext::getInstance()->getRequest();
			$refer		= $request->getParameter('refer', '');
		}

		if (false !== $refer && strlen($refer)) {	// 否则明确设置字符串类型的 refer

			$location	= $refer;

		} else {					// 留空，则默认分析 uri 和 parameters 的数据执行跳转

		#	$queryString	= is_array($parameters) ? http_build_query($parameters) : $parameters;

			if (is_array($parameters)) {
				$arrPairs	= array();
				foreach ($parameters as $key => $val) {
					$arrPairs[]	= $key . '=' . urlencode($val);
				}

				$queryString	= implode('&', $arrPairs);

			} else {
				$queryString	= $parameters;
			}

			$urlPrefix	= sfContext::getInstance()->getController()->genUrl($uri);

			$location	= $urlPrefix;
			$location	.= (true === strpos($urlPrefix, '?')) ? '&' : '?';
			$location	.= $queryString;
		}

		header('Location: ' . $location);
		exit;
	}

	public static function referBack() {

		$controller	= sfContext::getInstance()->getController();

		$request	= sfContext::getInstance()->getRequest();

		$refer		= $request->getParameter('refer', '');

		$location	= '';

		if ($refer) {

			$location	= $refer;

		} else {

			$refer		= '/';

		}

		header('Location: ' . $location);
		exit;

	}


}
