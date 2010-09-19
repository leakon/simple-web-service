<?php

/**
 * 简单请求类
 *
 * @author	Leakon
 * @version	2009-11-06
 * @notice	增加 getWithCUrlHeader 方法，获取响应的时候同时获取 HTTP HEADER
 */

class SimpleRequest extends CUrlRequest {

	const
		REGEX_MATCH_PORT	= '#http[s]?://[^/:]*[:]?(\d*)[/]?.*#i';

	/**
	 * 发送 POST 请求
	 */
	public static function post($strUrl, $mixedParam, $options = NULL) {

		preg_match(self::REGEX_MATCH_PORT, $strUrl, $matches);
		if (isset($matches[1])) {
			$options['port']	= (int) $matches[1];
		}

		// 默认端口号 80
		$options['port']	= isset($options['port']) ? $options['port'] : 80;
		// 超时设置
		$options['timeout']	= isset($options['timeout']) ? $options['timeout'] : SofavConstant::SIMPLE_REQUEST_TIMEOUT;

		if (is_array($mixedParam)) {

			$mixedParam	= self::joinArrayParam($mixedParam);

		}

		return	parent::doPost($strUrl, $mixedParam, $options);

	}

	/**
	 * 发送 GET 请求
	 */
	public static function get($strUrl, $mixedParam, $options = NULL) {

		preg_match(self::REGEX_MATCH_PORT, $strUrl, $matches);
		if (isset($matches[1])) {
			$options['port']	= (int) $matches[1];
		}

		// 默认端口号 80
		$options['port']	= isset($options['port']) ? $options['port'] : 80;
		// 超时设置
		$options['timeout']	= isset($options['timeout']) ? $options['timeout'] : SofavConstant::SIMPLE_REQUEST_TIMEOUT;;

		if (is_array($mixedParam)) {

			$mixedParam	= self::joinArrayParam($mixedParam);

		}

		$paramSeparator		= false === strpos($strUrl, '?') ? '?' : '&';

		if (strlen($mixedParam)) {
			$strUrl		.= $paramSeparator . $mixedParam;
		}

		return	parent::doGet($strUrl, $options);

	}

	/**
	 * 用 CUrl 接口的 get 方式获取 url 的 header 和 body，并返回 redirect 之后的绝对路径
	 * @param	$strUrl		指定的 http 开头的 url
	 *
	 * @return	$strUrl		包含 location，header 和 body
	 */
	public static function getWithCUrlHeader($strUrl, $mixedParam = array(), $options = NULL) {

		$options['header']	= true;

		$html		= self::get($strUrl, $mixedParam, $options);

		// 如果用的是 CUrl 接口的 SimpleRequest，遇到 301 或 302 状态码的时候，会有多个 header，应循环获取
		$isMultipleHeader	= false;

		$location		= $strUrl;
		$statusCode		= 0;

		do {

			$headerEndPos	= strpos($html, "\r\n\r\n");
			$strHeader	= substr($html, 0, $headerEndPos);
			$strContent	= substr($html, $headerEndPos + 4);

		#	var_dump($strHeader);echo "\n";

			// Location
			preg_match("#Location: ([^\r\n]*)#i", $strHeader, $matches);
			$strLocation	= isset($matches[1]) ? strval($matches[1]) : '';

			// Status
			preg_match("#http[s]?/\d+\.\d+ (\d+) .*#i", $strHeader, $matches);
			$statusCode	= isset($matches[1]) ? intval($matches[1]) : 0;

			// 如果是 301 或 302，说明有 Location 字段，CUrl 会把所有头部都列出来，因此要把 content 当作 html 重新解析
			if (301 === $statusCode || 302 === $statusCode) {
				$isMultipleHeader	= true;
				$html			= $strContent;

				// Location 指令的值，在 $strUrl 基础上合并，得到最新的 url
				$location		= Url_Util::makeAbsoluteUrl($strLocation, $strUrl);

			} else {
				$isMultipleHeader	= false;
			}

		} while (true === $isMultipleHeader);

		$arrRet		= array(
					'status'	=> $statusCode,
					'location'	=> $location,
					'header'	=> $strHeader,
					'body'		=> $strContent
				);

		return	$arrRet;

	}


}

