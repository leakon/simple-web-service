<?php

class Data_Check {

	public static function isExist($request, $strDataClass) {

		$arrRet		= array(
					'result'	=> 'error'
				);

		if (sfRequest::POST == $request->getMethod()) {

			$itemId			= $request->getParameter('id', 0);
			$itemName		= $request->getParameter('name', '');

			$objTable		= new $strDataClass();
			$userId			= sfContext::getInstance()->getUser()->getId();
			$objTable->user_id	= $userId;
			$objTable->name		= $itemName;

			$objFound		= SofavDB_Record::match($objTable);

			if ($objFound->id && $itemId != $objFound->id) {
				$arrRet['result']	= 'exist';
			}

		} else {

			$arrRet['result']	= 'not_found';
		}

		return	$arrRet;
	}

}

