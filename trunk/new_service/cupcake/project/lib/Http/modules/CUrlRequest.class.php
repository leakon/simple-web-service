<?php

/**
 * 基于 CUrl 封装的请求类，实现 doPost 和 doGet 接口
 *
 * @author	Leakon
 * @version	2009-11-06
 * @notice	增加 user_agent 参数
 */

class CUrlRequest extends BaseRequest {

	protected static function doPost($strUrl, $mixedParam, $options) {

		// 默认不输出 header	[true|false]
		$options['header']	= isset($options['header']) ? $options['header'] : false;
		$options['user_agent']	= isset($options['user_agent']) ? $options['user_agent'] : '';

		// 发送请求的时候设置的 header
		$options['http_header']	= (array) (isset($options['http_header']) ? $options['http_header'] : array());

		// 设置处理 response header 的触发器
		$options['header_function']	= isset($options['header_function']) ? $options['header_function'] : '';

	#	$timer		= new sfTimer();

		// create a new cURL resource
		$rsCUrl		= curl_init();

		curl_setopt($rsCUrl, CURLOPT_FOLLOWLOCATION, true);		// Follow redirection
		curl_setopt($rsCUrl, CURLOPT_FORBID_REUSE, true);		// 长连接
		curl_setopt($rsCUrl, CURLOPT_POST, true);
		curl_setopt($rsCUrl, CURLOPT_RETURNTRANSFER, true);		// 返回应答数据到变量
		curl_setopt($rsCUrl, CURLOPT_HEADER, $options['header']);	// TRUE to include the header in the output

		curl_setopt($rsCUrl, CURLOPT_CONNECTTIMEOUT, 30);		// 连接超时时间
		curl_setopt($rsCUrl, CURLOPT_MAXREDIRS, 8);			// 重定向次数
		curl_setopt($rsCUrl, CURLOPT_PORT, $options['port']);		// 端口号
		curl_setopt($rsCUrl, CURLOPT_TIMEOUT, $options['timeout']);	// 总超时时间

		if (count($options['http_header'])) {
			curl_setopt($rsCUrl, CURLOPT_HTTPHEADER, $options['http_header']);
		}

		if ($options['header_function']) {
			curl_setopt($rsCUrl, CURLOPT_HEADERFUNCTION, $options['header_function']);
		}

		// The contents of the "User-Agent: " header to be used in a HTTP request.
		curl_setopt($rsCUrl, CURLOPT_USERAGENT, $options['user_agent']);

		curl_setopt($rsCUrl, CURLOPT_URL, $strUrl);
		curl_setopt($rsCUrl, CURLOPT_POSTFIELDS, $mixedParam);		// 数据

		// grab URL and pass it to the browser
		$response	= curl_exec($rsCUrl);

	#	$elapsedTime	= $timer->getElapsedTime();

		// Debug，判断是否会重复发送相同的请求
	#	$strLog		= sprintf('[TIME:%8.2f]seconds', $elapsedTime);
	#	MyLog::doLog($strLog, 'debug', 'debug.post_curl');

		// close cURL resource, and free up system resources
		curl_close($rsCUrl);

		return	$response;

	}

	protected static function doGet($strUrl, $options) {

		// 默认不输出 header	[true|false]
		$options['header']	= isset($options['header']) ? $options['header'] : false;
		$options['user_agent']	= isset($options['user_agent']) ? $options['user_agent'] : '';

		// 发送请求的时候设置的 header
		$options['http_header']	= (array) (isset($options['http_header']) ? $options['http_header'] : array());

		// 设置处理 response header 的触发器
		$options['header_function']	= isset($options['header_function']) ? $options['header_function'] : '';

		// create a new cURL resource
		$rsCUrl		= curl_init();

		curl_setopt($rsCUrl, CURLOPT_FOLLOWLOCATION, true);		// Follow redirection
		curl_setopt($rsCUrl, CURLOPT_FORBID_REUSE, true);		// 长连接
		curl_setopt($rsCUrl, CURLOPT_RETURNTRANSFER, true);		// 返回应答数据到变量
		curl_setopt($rsCUrl, CURLOPT_HEADER, $options['header']);	// TRUE to include the header in the output

		curl_setopt($rsCUrl, CURLOPT_CONNECTTIMEOUT, 30);		// 连接超时时间
		curl_setopt($rsCUrl, CURLOPT_MAXREDIRS, 8);			// 重定向次数
		curl_setopt($rsCUrl, CURLOPT_PORT, $options['port']);		// 端口号
		curl_setopt($rsCUrl, CURLOPT_TIMEOUT, $options['timeout']);	// 总超时时间

		if (count($options['http_header'])) {
			curl_setopt($rsCUrl, CURLOPT_HTTPHEADER, $options['http_header']);
		}

		if ($options['header_function']) {
			curl_setopt($rsCUrl, CURLOPT_HEADERFUNCTION, $options['header_function']);
		}

		// The contents of the "User-Agent: " header to be used in a HTTP request.
		curl_setopt($rsCUrl, CURLOPT_USERAGENT, $options['user_agent']);

		curl_setopt($rsCUrl, CURLOPT_URL, $strUrl);

		// grab URL and pass it to the browser
		$response	= curl_exec($rsCUrl);

		// close cURL resource, and free up system resources
		curl_close($rsCUrl);

		return	$response;

	}


}

