<?php

class ActionSecurity {

	public static function denyForUserId(&$dataObject) {

		// 根据对象的 user_id 属性判断访问权限
		// 如果不是当前用户则自动跳转
		if (isset($dataObject->user_id)) {
			$sfUserId = sfContext::getInstance()->getUser()->getId();
			if ($sfUserId == $dataObject->user_id) {
				return	true;
			}
		}

		// Need Log
		ActionsUtil::notAuthorized();
	}


	/*
		从提交的表单中获取 $arrFormList 数组，并串联每个元素的 $field 字段
		用本次计算的密钥，与 FORM 提交的字符串密钥进行对比
		用于验证 FORM 提交的 $arrFormList 是否合法（或者说验证数组是否被篡改过）

		合法返回 true
		非法返回 false
	*/
	public static function isValidFormKey(&$arrFormList, $field = false, $formKey = '') {
		$md5	= self::signKeyFromArray($arrFormList, $field);
		return	$md5 === strval($formKey);
	}

	/*
		串联 $arrList 数组每个元素的 $field 字段，按字符串排序后，生成密钥

		注意，如果 $field = false，则指明 $arrList 是 index => index 的格式
		这时是把每个 index 串联并排序
	*/
	public static function signKeyFromArray(&$arrList, $field = false) {

		if (false === $field) {

			$arrField	= $arrList;

		} else {

			$arrField	= array();

			foreach ($arrList as $key => $val) {
				if (isset($val[$field])) {
					$arrField[]	= strval($val[$field]);
				}
			}
		}

		sort($arrField, SORT_STRING);
		$strField	= implode('_', $arrField);

		$md5		= md5(SofavConstant::SECRET_KEY . $strField);

		return	$md5;

	}


}
