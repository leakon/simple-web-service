<?php

class portalActions extends sfActions {


	public function preExecute() {

		$this->objConf			= new Custom_Conf();

		$this->defaultCategoryId	= 1000013;

	}


	public function executeIndex(sfWebRequest $request) {

		$this->arrDataConf_Block	= $this->objConf->getConf('block');


		$option			= array('limit' => 1000);
		$option['to_array']	= true;


		$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_RANGE;
		$res			= Table_categories::getByParent(0, $option);
		$this->arrRanges	= Array_Util::ColToPlain($res, 'id', 'name');

		$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_TYPE;
		$res			= Table_categories::getByParent(0, $option);
		$this->arrTypes		= Array_Util::ColToPlain($res, 'id', 'name');

		$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_STYLE;
		$res			= Table_categories::getByParent(0, $option);
		$this->arrStyle		= Array_Util::ColToPlain($res, 'id', 'name');


	}


	public function executePartner(sfWebRequest $request) {

		sfConfig::set('override_category_id', -1);

		$this->arrDataConf_Block	= $this->objConf->getConf('block');

	}

	public function executeContact(sfWebRequest $request) {

		sfConfig::set('override_category_id', -1);

		$this->arrDataConf_Block	= $this->objConf->getConf('block');

	}

	public function executeSaveMessage(sfWebRequest $request) {

		ActionsUtil::needPOST($request);		// 必须是 POST 方法


		$this->arrConf_Filter	= $this->objConf->getConf('filter');

	#	Debug::pre($this->arrConf_Filter);


		$arrParameters		= $request->getParameterHolder()->getAll();

		foreach ($this->arrConf_Filter as $filterWord) {

			$arrParameters['title']		= str_replace($filterWord, '*', $arrParameters['title']);
			$arrParameters['message']	= str_replace($filterWord, '*', $arrParameters['message']);

		}


		if (isset($_SESSION['auth_code']) && isset($arrParameters['verify_code'])
			&& $_SESSION['auth_code'] == $arrParameters['verify_code'])
		{

		} else {
		#	die('请输入正确的验证码');
			return	$this->redirect('portal/contact?result=code_error');
		}

		$bool			= false;
		$tagItem		= new Table_messages();

		$arrParameters['remote_addr']	= $_SERVER['REMOTE_ADDR'];

		$tagItem->fromArray($arrParameters);

		$bool			= $tagItem->save();

		return	$this->redirect('portal/contact?result=success');

/*
		$parameters		= array();

		$refer			= $request->getParameter('refer');
	#	$refer			= false;

		$uri			= sprintf('%s/%s', $this->strModuleName, $request->getParameter('from', 'index'));

		return	ActionsUtil::redirect($uri, $parameters, $refer);
*/


	}


}
