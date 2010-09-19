<?php

/**
 * Url 工具箱
 *
 * @package     Sofav
 * @subpackage  ActionsUtil
 * @link        www.leakon.com
 * @version	2010-02-12
 * @author      Leakon <leakon@gmail.com>
 *
 * @notice	处理 bug，修正了 combineUriParam 方法返回的 url 最后字符是 ? 的问题
 * @comment	尝试过把正则表达式由字符串替换成类常量用来优化性能，但经过测试，性能不升反降
 		运行 50 万次
 		字符串：[31284.85]q/s	[15.98]seconds
 		类常量：[29175.49]q/s	[17.14]seconds
 */

class Url_Util {

	/**
	 * 合并路径，处理绝对和相对路径
	 * 如果有不确定的问题，则参考浏览器的处理逻辑
	 * @param	$strUrl		未知的路径，可能是相对或绝对的
	 * @param	$strBaseUrl	指定的 http 开头的 url
	 				如果 $strUrl 是 / 开头的本域绝对路径，或相对路径
	 				则以 $strBaseUrl 为基础拼出 http 开头的绝对 url
	 *
	 * @return	http 开头的绝对 url
	 */
	public static function makeAbsoluteUrl($strUrl, $strBaseUrl) {

		$strUrlRet	= '';

		// 检查 javascript: 伪链接

		if (preg_match("#^\s*javascript:.*#i", $strUrl)) {
			return	$strBaseUrl;
		}

		// "//" 开头的绝对路径 url
		// 这种 url 很罕见，但确实是可以被浏览器识别的资源路径，按照绝对路径处理，前面补全 "http:"
		if (0 === strpos($strUrl, '//')) {
			return	'http:' . $strUrl;
		}

		// http 开头的绝对路径 url
		if (preg_match("#^http[s]?://#i", $strUrl)) {

			/*
			当 $strUrl = 'http://' 的时候，各浏览器处理策略都不一样
			Firefox		-> http:///
			IE7		-> http:///
			Opera		-> http:/
			Safari		-> http:/
			Chrome		-> http:
			*/

			// 我采用更合理的方式，返回基准域名
			if (!self::isHttpUrl($strUrl)) {
				return	$strBaseUrl;
			}




			$strBaseUrl	= $strUrl;
			$strUrl		= preg_replace("#^http[s]?://[^/]*#i", '', $strUrl);
		}

		// 需要用指定的域名合并，得到的 $strHttpDomain 是 http://www.sample.com 形式的 url，结尾没有斜线 "/"
		$strHttpDomain		= self::getHttpDomain($strBaseUrl);

		// 检查是否已斜线 "/" 开头
	#	if (preg_match("#^/.*#i", $strUrl)) {
		if (0 === strpos($strUrl, '/')) {

		#	$strUrlRet	= $strHttpDomain . $strUrl;
			$newCombinedPath	= $strUrl;

		} else {
			// 纯相对路径

			$arrUrlInfo	= parse_url($strBaseUrl);

			// 获取基准域名的路径 $strBaseUrlPath
			$strBaseUrlPath	= isset($arrUrlInfo['path']) ? $arrUrlInfo['path'] : '/';

			/*
			dirname 的输出范例
			Array
			(
			    [0] => []						-> []
			    [1] => [/]						-> [/]
			    [2] => [/help]					-> [/]
			    [3] => [/help/]					-> [/]
			    [4] => [/help/index.html]				-> [/help]
			    [5] => [/history/list/date/2009-05-08/test.php/]	-> [/history/list/date/2009-05-08]
			    [6] => [/history/list/date/2009-05-08/test.php]	-> [/history/list/date/2009-05-08]
			    [7] => [/history/list/date/2009-05-08////]		-> [/history/list/date]
			    [8] => [/history/list/date/2009-05-08//]		-> [/history/list/date]
			    [9] => [/history/list/date/2009-05-08/]		-> [/history/list/date]
			    [10] => [/history/list/date/2009-05-08]		-> [/history/list/date]
			)
			*/

			/*
			浏览器的输出范例（Firefox 3.5）
			页面中包含 <a href="../index.html">../index.html</a>，鼠标放到链接上，状态栏依次显示
			/history/list/date/2009-05-08/test.php/		-> /history/list/date/2009-05-08/index.html
			/history/list/date/2009-05-08/test.php		-> /history/list/date/index.html
			/history/list/date/2009-05-08////		-> /history/list/date/2009-05-08///index.html
			/history/list/date/2009-05-08//			-> /history/list/date/2009-05-08/index.html
			/history/list/date/2009-05-08/			-> /history/list/date/index.html
			/history/list/date/2009-05-08			-> /history/list/index.html
			*/


		################################################################
		## Removed, but keep for some days
		##	/*
		##		对比上述 2 套输出，得出结论：dirname() 函数在当前环境不适用！！！
		##	*/
		##	$strBaseUrlPath	= dirname($strBaseUrlPath);
		################################################################


			// 到这里，$strBaseUrlPath 一定是以斜线 "/" 开头的字符或字符串
			/*
				通过判断结尾是否为 "/" 来判断路径
			*/
			$strLastCharOfPath	= substr($strBaseUrlPath, -1);
			if ('/' === $strLastCharOfPath) {
				// 已 "/" 结尾
				$newCombinedPath	= $strBaseUrlPath . $strUrl;

			} else {
				// 非 "/" 结尾
				$intLastSlashPos	= strrpos($strBaseUrlPath, '/');

				$newCombinedPath	= substr($strBaseUrlPath, 0, $intLastSlashPos + 1) . $strUrl;
			}

		################################################################
		## Removed, but keep for some days
		##	/*
		##	// Windows env dirname('/') -> string(1) "\"
		##	// Windows 环境下，"/" 这个路径会被 dirname 转换为反斜线 "\"
		##	if ("\\" === $strBaseUrlPath) {
		##		$strBaseUrlPath	= '/';
		##	}
		##
		##	// 如果路径是斜线 "/"，则不需改变什么
		##	if ('/' === $strBaseUrlPath) {
		##	} else {
		##		// 否则，应该在路径结尾加上 "/"，因为 parse_url 得到的路径不带结尾的斜线 "/"
		##		$strBaseUrlPath	.= '/';
		##	}
		##	*/
		################################################################

		#	$strUrlRet	= $strHttpDomain . $strBaseUrlPath . $strUrl;

		}

		// 检查 $newCombinedPath 是否包含指向上层目录的相对路径（即包含 "../" 这样的字符串）
		while (false !== strpos($newCombinedPath, '../')) {
			$newCombinedPath	= preg_replace("#/?[^/]*/\.\.#i", '', $newCombinedPath);
		}

		$strUrlRet	= $strHttpDomain . $newCombinedPath;

		return		$strUrlRet;
	}


	/**
	 * 获取 url 中从 http 到域名结束的部分	(Sample: http://www.leakon.com)
	 * @return	http 开始的域名 url，不包含结尾的 "/"
	 */
	public static function getHttpDomain($strUrl) {
		$strRet		= '';
		if (preg_match("#^http[s]?://.*#i", $strUrl)) {
			$strRet		= preg_replace("#^(http[s]?://[^/]*)/*.*#i", "\$1", $strUrl);
		}
		$strRet		= strtolower($strRet);
		return	$strRet;
	}


	/**
	 * 获取 url 中的主机名	(Sample: www.leakon.com)
	 * @return	host.domain.com
	 */
	public static function getDomainOnly($strUrl) {
		/*
		$strRet		= preg_replace("#^http[s]?://([^/]*)/*.*#i", "\$1", $strUrl);
		$strRet		= preg_replace("#[^.a-zA-Z0-9\-]#i", '', $strRet);
		$strRet		= strtolower($strRet);
		*/
		$strRet		= self::getOrgDomainOnly($strUrl);
		$strRet		= preg_replace("#[^.a-zA-Z0-9\-:]#i", '', $strRet);
		return	$strRet;
	}


	/**
	 * 获取 url 中的主机名，不修正错误，跟 getDomainOnly 之差一行	(Sample: www.leakon.com)
	 * @return	host.domain.com
	 */
	public static function getOrgDomainOnly($strUrl) {
		// 必须是 http 开头
		// 或者是 纯域名开头 host.domain.com/abc.html
		if (preg_match("#^http[s]?://[^./]+\.[^./]+#i", $strUrl)
			|| preg_match("#^[^./]+\.[^./]+/*.*#i", $strUrl)) {
			$strRet		= preg_replace("#^http[s]?://([^/]*)/*.*#i", "\$1", $strUrl);
		#	$strRet		= preg_replace("#[^.a-zA-Z0-9\-]#i", '', $strRet);
			$strRet		= strtolower($strRet);
		} else {
			$strRet		= '';
		}
		return	$strRet;
	}


	/**
	 * 判断是否是 http 开始的 url	(Sample: http://www.leakon.com)
	 * @return	bool
	 */
	public static function isHttpUrl($strUrl) {
		// http 开头的绝对路径 url
		// 域名部分至少包含：一串字符跟上一个点然后再一串字符
		$bool	= true;
		$bool	= $bool && 1 === preg_match("#^http[s]?://([^./]+\.[^./]+[^/]*)/?.*#i", $strUrl, $match);
		$bool	= $bool && isset($match[1]) && self::isValidDomain($match[1]);
		return	$bool;
	#	return	1 === preg_match("#^http[s]?://[^./]+[.][^./]+.*#i", $strUrl);
	}


	/**
	 * 判断是否是合法的域名	(www.leakon.com)
	 * @return	bool
	 */
	public static function isValidDomain($strDomain) {
		// 域名部分至少包含：一串字符跟上一个点然后再一串字符
		$strDomain	= strtolower($strDomain);
		return	1 === preg_match("#^([0-9a-z\-]+\.)+[0-9a-z\-]+$#i", $strDomain);
	}


	/**
	 * 合并 uri 和 附加的参数
	 * 先解析 uri 的 queryString 部分，然后用 params 设置的参数与 uri 解析的数组合并
	 *
	 * @param	string		$strUri		输入的 uri 参数
	 * @param	mixed		$mixedParam	输入附加参数，可以是数组或 queryString
	 *
	 * @return	string
	 */
	public static function combineUriParam($strUri, $mixedParam) {

		$strRet		= '';

		$arrUrlConf	= parse_url($strUri);

		$strOldQueryString	= isset($arrUrlConf['query']) ? $arrUrlConf['query'] : '';

		$arrOldQueryString	= array();
		$arrNewQueryString	= array();
		$arrFinalQueryString	= array();

		parse_str($strOldQueryString, $arrOldQueryString);

		if (is_string($mixedParam)) {
			parse_str($mixedParam, $arrNewQueryString);
		} else {
			$arrNewQueryString	= $mixedParam;
		}

		$arrFinalQueryString	= array_merge($arrOldQueryString, $arrNewQueryString);

		$arrFinalQueryString	= Array_Util::deepUrlEncode($arrFinalQueryString);

		$queryString		= http_build_query($arrFinalQueryString);

		$queryString		= urldecode($queryString);
		$queryString		= htmlspecialchars_decode($queryString, ENT_QUOTES);
	#	if (false !== strpos($queryString, '&amp;')) {
	#		$queryString	= str_replace('&amp;', '&', $queryString);
	#	}
	#	Debug::cpr($arrFinalQueryString);

		$posQuestion		= strpos($strUri, '?');

		// 没有 问号 "?" 字符
		if (false === $posQuestion) {

			$strRet		= $strUri . (strlen($queryString) ? ('?' . $queryString) : '');

		} else {

			$strRet		= substr($strUri, 0, $posQuestion + 1) . $queryString;

		}

		return	$strRet;

	}


	/**
	 * 修改有问题的 url
	 *
	 */
	public static function fixUrl($strUrl) {

		// 域名结尾加上斜线 "/"
		if (preg_match("#^http[s]?://[^/]+$#i", $strUrl)) {
			$strUrl		.= '/';
		}

		// 处理结尾多余的反斜线 "\"
		if (preg_match('#^http[s]?://[^/]+/[\\\]+$#i', $strUrl)) {
			$strUrl		= preg_replace("#/[\\\]+#i", '/', $strUrl);
		}

		return	$strUrl;
	}


}
