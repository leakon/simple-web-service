<?php

class ActionSecurity {

	public static function denyForUserId(&$dataObject) {

		// ���ݶ���� user_id �����жϷ���Ȩ��
		// ������ǵ�ǰ�û����Զ���ת
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
		���ύ�ı��л�ȡ $arrFormList ���飬������ÿ��Ԫ�ص� $field �ֶ�
		�ñ��μ������Կ���� FORM �ύ���ַ�����Կ���жԱ�
		������֤ FORM �ύ�� $arrFormList �Ƿ�Ϸ�������˵��֤�����Ƿ񱻴۸Ĺ���

		�Ϸ����� true
		�Ƿ����� false
	*/
	public static function isValidFormKey(&$arrFormList, $field = false, $formKey = '') {
		$md5	= self::signKeyFromArray($arrFormList, $field);
		return	$md5 === strval($formKey);
	}

	/*
		���� $arrList ����ÿ��Ԫ�ص� $field �ֶΣ����ַ��������������Կ

		ע�⣬��� $field = false����ָ�� $arrList �� index => index �ĸ�ʽ
		��ʱ�ǰ�ÿ�� index ����������
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
