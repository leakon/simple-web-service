<?php

class BaseRequest {

	/**
	 * 串联请求数据
	 *
	 * @param $mixedParam		POST 参数，如果是数组，目前只支持一维数组
	 *
	 */
	protected static function joinArrayParam($mixedParam) {

		if (is_array($mixedParam)) {

			$mixedParam	= Array_Util::deepUrlEncode($mixedParam);

			$arrParam	= array();
			foreach ($mixedParam as $key => $val) {
				$arrParam[]	= $key . '=' . $val;
			}

			// join the params and convert it to string
			$mixedParam	= implode('&', $arrParam);

		}

		return	$mixedParam;

	}

}

