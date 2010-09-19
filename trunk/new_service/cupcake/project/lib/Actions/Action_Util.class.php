<?php

/**
 * ActionsUtil
 *
 * @package     Sofav
 * @subpackage  ActionsUtil
 * @link        www.leakon.com
 * @version     2009-11-23
 * @author      Leakon <leakon@gmail.com>
 *
 * @notice	update redirect() and fix queryString repeat bugs, move logic code to Url_Util::combineUriParam()
 */

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

		$location	= '/';

		if (false !== $refer && strlen($refer)) {	// 否则明确设置字符串类型的 refer

			$location	= $refer;

		} else {					// 留空，则默认分析 uri 和 parameters 的数据执行跳转

			$urlPrefix	= sfContext::getInstance()->getController()->genUrl($uri);
			$location	= Url_Util::combineUriParam($urlPrefix, $parameters);
		}


		sfContext::getInstance()->getController()->redirect($location, 0, 302);
		throw new sfStopException();

		/*
	#	Debug::pre($location);
		header('Location: ' . $location);
		exit;
		*/
	}

	public static function referBack() {

		$controller	= sfContext::getInstance()->getController();
		$request	= sfContext::getInstance()->getRequest();
		$refer		= $request->getParameter('refer', '');

		$location	= '';

		if ($refer) {
			$location	= $refer;
		} else {
			$location	= '/';
		}

		header('Location: ' . $location);
		exit;
	}

	/**
	 * 在禁止浏览器缓存的地方设置 HTTP Header
	 *
	 */
	public static function headerNoCache() {

		header("Expires: Tue, 26 Oct 1982 08:30:00 GMT");
		header("Cache-Control: no-cache");
		header("Pragma: no-cache");

	}

}
