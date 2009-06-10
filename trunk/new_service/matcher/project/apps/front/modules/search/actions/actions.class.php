<?php

class searchActions extends sfActions {

	public function preExecute() {

		$this->type		= 0;
		$this->dataClass	= 'Table_data_model';
		$this->strModuleName	= $this->getContext()->getModuleName();

		$this->arrProducts	= MatcherConstant::getProducts();

		$this->webUploadDir	= ProjectConfiguration::getWebUploadDir();

		$this->pageSize		= 20;

	}


	public function executeIndex(sfWebRequest $request) {

		$this->arrOption		= $this->getAllOption();
		$this->getResult($request);

	}

	public function executeResult(sfWebRequest $request) {

		$this->setTemplate('index');

		$this->arrOption		= $this->getAllOption();
		$this->getResult($request);


	}

	protected function getFormOption($type, $colKey = 'id', $colVal = 'name') {

		$arrWhere		= array();
		$arrWhere['type']	= $type;
		$arrResult		= Table_data_model::getResult($arrWhere);
		return			Table_data_model::getOption($arrResult, $colKey, $colVal);

	}



	protected function getResult(sfWebRequest $request) {


		$this->arrOption	= $this->getAllOption();

	#	Debug::pr($this->arrOption);

		$from			= $request->getParameter('from', '');
		$type			= $request->getParameter('type', '');

		$this->showResult	= false;

		if ($from == 'result') {

			$this->showResult	= true;

			$arrCall	= array(
						'bag'		=> 'getResBag',
						'stand'		=> 'getResStand',
						'holder'	=> 'getResHolder',
						'filter'	=> 'getResFilter',
					);

			if (empty($arrCall[$type])) {
				$type 	= 'bag';
			}

			$this->partialName	= $type;

			$callFunc	= $arrCall[$type];

			$this->$callFunc($request);
		#	$this->getResBag($request);

			return;

		}


		$tableDataTag		= new $this->dataClass();

		$this->pager		= new SofavDB_Pager($tableDataTag);

		$where			= array('type' => $this->type);
		$order			= array('id' => 'DESC');

		$page			= (int) $request->getParameter('page', 1);
		$this->pager->init($page, sfConfig::get('app_page_size', 5), array('where' => $where, 'order' => $order));

		$this->arrResult	= $this->pager->getResults();

		$this->dataItem		= new $this->dataClass();

	}

	// 搜索滤镜
	protected function getResFilter($request) {

		$intType		= MatcherConstant::BRAND_TYPE_FILTER_MODEL;

		$objTable		= new $this->dataClass();
		$page			= (int) $request->getParameter('page', 1);

		$arrParameters		= $request->getParameterHolder()->getAll();

		// 镜头口径
		$intCaliber		= $this->getLensCaliber($request);

	#	Debug::pr($intCaliber);

		$templateWhere		= 'FROM %s WHERE type = %d AND caliber = %d';
		$sqlWhere		= sprintf($templateWhere, $objTable->getTableName(), $intType, $intCaliber);


				// "FROM ... WHERE ..." (without SELECT)
		$stateCount	= $sqlWhere;
				// "SELECT c.*, m.* FROM ... WHERE ... ORDER ..." (without LIMIT)
		$stateLimit	= 'SELECT * ' . $sqlWhere . ' ORDER BY id DESC';


		$pager		= new Simple_Pager();
		$pager->setCount($stateCount)->setLimit($stateLimit);
	#	$pager->setParameter($parameter);

		$pager->init($page, $this->pageSize);

		$this->pager		= $pager;

		$this->arrResult	= $this->pager->getResults();


	}

	// 搜索脚架
	protected function getResHolder($request) {
		$this->getResStand($request, 'holder');
	}
	// 搜索脚架
	protected function getResStand($request, $strType = 'stand') {

		$intType		= MatcherConstant::BRAND_TYPE_STAND_MODEL;
		if ($strType == 'holder') {
			$intType	= MatcherConstant::BRAND_TYPE_HOLDER_MODEL;
		}


		$objTable		= new $this->dataClass();
		$page			= (int) $request->getParameter('page', 1);

		$arrParameters		= $request->getParameterHolder()->getAll();

		// 计算相机和镜头重量
		$arrWeight		= $this->get2Weight($request);

	#	Debug::pr($arrWeight);

		$templateWhere		= 'FROM %s WHERE type = %d AND ( weight > %d OR weight = %d )  ';
		$sqlWhere		= sprintf($templateWhere, $objTable->getTableName(), $intType, $arrWeight['total'], $arrWeight['total']);


				// "FROM ... WHERE ..." (without SELECT)
		$stateCount	= $sqlWhere;
				// "SELECT c.*, m.* FROM ... WHERE ... ORDER ..." (without LIMIT)
		$stateLimit	= 'SELECT * ' . $sqlWhere . ' ORDER BY id DESC';


		$pager		= new Simple_Pager();
		$pager->setCount($stateCount)->setLimit($stateLimit);
	#	$pager->setParameter($parameter);

		$pager->init($page, $this->pageSize);

		$this->pager		= $pager;

		$this->arrResult	= $this->pager->getResults();


	}


	// 搜索摄影包
	protected function getResBag($request) {

		$objTable		= new $this->dataClass();
		$page			= (int) $request->getParameter('page', 1);

		$arrParameters		= $request->getParameterHolder()->getAll();

		$cameraStyle		= $this->getCameraStyle($request);

		$conn			= SofavDB_Manager::getConnection();

		$templateWhere		= sprintf('SELECT id, name FROM %s WHERE type = %d AND ( name > :style_1 OR name = :style_2 ) ',
							$objTable->getTableName(), MatcherConstant::BRAND_TYPE_CAMERA_STYLE);

		$statement		= $conn->prepare($templateWhere);
		$statement->bindValue(':style_1', $cameraStyle, PDO::PARAM_STR);
		$statement->bindValue(':style_2', $cameraStyle, PDO::PARAM_STR);

		$statement->execute();

		$result			= $statement->fetchAll(PDO::FETCH_ASSOC);

		// 得到符合条件的 id 列表
		$arrKVRes		= Array_Util::ColToPlain($result, 'id', 'id');

		$ext_vol_type		= implode(',', $arrKVRes);

	#	Debug::pre($result);
	#	Debug::pre($arrKVRes);


		$strWhereTag	= $this->getWhereTag($request, 't_tag.');

		if (strlen($strWhereTag)) {

		#	Debug::pr($strWhereTag);

			$tableTag	= new Table_map_tag();

			$templateWhere	= 'FROM %s AS t_tag LEFT JOIN %s AS t_model '
					. 'ON t_tag.item_id = t_model.id '
					. 'WHERE %s AND t_model.ext_vol_type IN (%s) AND %s ';
			$sqlWhere	= sprintf($templateWhere, $tableTag->getTableName(), $objTable->getTableName(),
						$strWhereTag, $ext_vol_type, $this->getWhereProduct($request, 't_tag.'));


					// "FROM ... WHERE ..." (without SELECT)
			$stateCount	= $sqlWhere;
					// "SELECT c.*, m.* FROM ... WHERE ... ORDER ..." (without LIMIT)
			$stateLimit	= 'SELECT * ' . $sqlWhere . ' ORDER BY t_model.id DESC';

		} else {

			$templateWhere	= 'FROM %s WHERE ext_vol_type IN (%s) AND %s ';
			$sqlWhere	= sprintf($templateWhere, $objTable->getTableName(), $ext_vol_type, $this->getWhereProduct($request));


					// "FROM ... WHERE ..." (without SELECT)
			$stateCount	= $sqlWhere;
					// "SELECT c.*, m.* FROM ... WHERE ... ORDER ..." (without LIMIT)
			$stateLimit	= 'SELECT * ' . $sqlWhere . ' ORDER BY id DESC';

		}




		$pager		= new Simple_Pager();
		$pager->setCount($stateCount)->setLimit($stateLimit);
	#	$pager->setParameter($parameter);

		$pager->init($page, $this->pageSize);

		$this->pager		= $pager;

		$this->arrResult	= $this->pager->getResults();


	}

	protected function getWhereProduct($request, $alias = '') {

		$retVar		= '1';

		// product_id
		$product	= (int) $request->getParameter('product', 0);
		if ($product) {
			$retVar	= $alias . 'product_id = ' . $product;
		}

		return	$retVar;

	}

	protected function getWhereTag($request, $alias = '') {

		$strRet		= '';

		// tags_id
		$arrTags	= (array) $request->getParameter('checked_product', array());
		$arrSafeTags	= array();
		foreach ($arrTags as $key => $val) {
			$arrSafeTags[intval($key)]	= intval($val);
		}

		if (count($arrSafeTags)) {

			$strRet		= sprintf(' %stag_id IN (%s) ', $alias, implode(',', $arrSafeTags));

		}

		return	$strRet;

	}

	// 计算镜头口径
	protected function getLensCaliber($request) {

		$retVar		= 0;
		$cailiberId	= 0;

		$intLensModelId		= (int) $request->getParameter('lens_model_id', 0);
		if ($intLensModelId) {
			// 镜头型号
			$tableLensModel		= new $this->dataClass($intLensModelId);
		#	Debug::pre($tableLensModel);

			if ($tableLensModel->id) {
				$cailiberId		= $tableLensModel->caliber_id;
			}
		}

		if ($cailiberId) {

			$tableCaliber		= new $this->dataClass($cailiberId);
		#	Debug::pre($tableCaliber);

			if ($tableCaliber->id) {
				$retVar		= $tableCaliber->name;
			}

		}

		return	$retVar;
	}

	// 计算相机和镜头重量
	protected function get2Weight($request) {

		$retVal		= false;

		$intCameraModelId	= (int) $request->getParameter('camera_model_id', 0);
		$intLensModelId		= (int) $request->getParameter('lens_model_id', 0);

		$arrRet		= array(
					'camera'	=> 0,
					'lens'		=> 0,
				);

		if ($intCameraModelId) {
			// 相机型号
			$tableCameraModel	= new $this->dataClass($intCameraModelId);
		#	Debug::pre($tableCameraModel);

			if ($tableCameraModel->id) {
				$arrRet['camera']	= $tableCameraModel->weight;
			}
		}
		if ($intLensModelId) {
			// 镜头型号
			$tableLensModel		= new $this->dataClass($intLensModelId);
		#	Debug::pre($tableCameraModel);

			if ($tableLensModel->id) {
				$arrRet['lens']	= $tableLensModel->weight;
			}
		}

		$arrRet['total']	= $arrRet['camera'] + $arrRet['lens'];

		return	$arrRet;

	}


	// 获取相机类型
	protected function getCameraStyle($request) {

		$retVal		= false;

		// 获取相机类型
		$intCameraModelId	= (int) $request->getParameter('camera_model_id', 0);
		if ($intCameraModelId) {
			// 相机型号
			$tableCameraModel	= new $this->dataClass($intCameraModelId);
		#	Debug::pre($tableCameraModel);

			if ($tableCameraModel->id) {

				// 相机类型 id
				$intCameraStyleId	= $tableCameraModel->style_id;

				// 相机类型
				$tableCameraStyle	= new $this->dataClass($intCameraStyleId);

				if ($tableCameraStyle->id) {
				#	Debug::pr($tableCameraStyle);

					$retVal		= $tableCameraStyle->name;

				}

			}
		}

		return	$retVal;

	}

	protected function getAllOption() {

		$arrOptions			= array();

		// 相机品牌
		$arrOptions['camera']		= $this->getFormOption(MatcherConstant::BRAND_TYPE_CAMERA);
		// 相机型号
		$arrOptions['camera_model']	= $this->getFormOption(MatcherConstant::BRAND_TYPE_CAMERA_MODEL, 'id', array('product_id', 'style'));

		// 镜头品牌
		$arrOptions['lens']		= $this->getFormOption(MatcherConstant::BRAND_TYPE_LENS);
		// 镜头型号
		$arrOptions['lens_model']	= $this->getFormOption(MatcherConstant::BRAND_TYPE_LENS_MODEL, 'id', array('product_id', 'style'));

		$price				= array();
		$price['price_min']		= $this->getFormOption(MatcherConstant::BRAND_TYPE_PRICE, 'id', 'min');
		$price['price_max']		= $this->getFormOption(MatcherConstant::BRAND_TYPE_PRICE, 'id', 'max');

	#	Debug::pr($price['price_min']);

		asort($price['price_min'], SORT_NUMERIC);
	#	$price['price_min']		= Array_Util::sortColumn($price['price_min'], 'id');

		$arrOptions['price']		= array(0 => '全部');
		foreach ($price['price_min'] as $id => $min) {
			$arrOptions['price'][$id]	= sprintf('%d - %d', $min, $price['price_max'][$id]);
		}



	#	$arrProducts		= MatcherConstant::getProducts();

		$arrType		= array(
						MatcherConstant::BRAND_TYPE_BAG		=> 'bag',
						MatcherConstant::BRAND_TYPE_STAND	=> 'stand',
						MatcherConstant::BRAND_TYPE_HOLDER	=> 'holder',
						MatcherConstant::BRAND_TYPE_FILTER	=> 'filter',
					);

		$arrTags		= array();
		foreach ($arrType as $typeId => $typeString) {
			$arrTags[$typeString]		= Table_data_model::getTags($typeId);
			$arrProducts[$typeString]	= $this->getFormOption($typeId);
		}
		$arrOptions['tags']	= $arrTags;
		$arrOptions['products']	= $arrProducts;

		return	$arrOptions;

	}


}
