<?php

class BaseBrandActions extends sfActions {

	public function preExecute() {

		$this->type		= 0;
		$this->dataClass	= 'Table_data_model';
		$this->strModuleName	= $this->getContext()->getModuleName();

		$this->strCName		= '品牌';		// 中文名，默认是品牌

		$this->useGlobalTemplate	= true;

		$this->arrProducts	= MatcherConstant::getProducts();

		$this->webUploadDir	= ProjectConfiguration::getWebUploadDir();

		$this->intPageSize	= 30;		// 翻页

	}

	protected function getIndexData(sfWebRequest $request) {

		$tableDataTag		= new $this->dataClass();

		$this->pager		= new SofavDB_Pager($tableDataTag);

		$where			= array('type' => $this->type);
		$order			= array('id' => 'DESC');

		$page			= (int) $request->getParameter('page', 1);
		$this->pager->init($page, sfConfig::get('app_page_size', $this->intPageSize), array('where' => $where, 'order' => $order));

		$this->arrResult	= $this->pager->getResults();

		$this->dataItem		= new $this->dataClass();

		$this->hasErrors	= $request->hasErrors();
		if ($this->hasErrors) {
			$arrParameters		= $request->getParameterHolder()->getAll();
			$this->dataItem->fromArray($arrParameters);
		}

	}

	protected function getSearchData(sfWebRequest $request) {

		$tableDataTag		= new $this->dataClass();

		$word			= $request->getParameter('word', '');
		$word			= '%' . $word . '%';
		$conn			= SofavDB_Manager::getConnection();

		$where			= array('type' => $this->type);

		$templateWhere		= "FROM %s WHERE type = %d AND name LIKE %s";
		$sqlWhere		= sprintf($templateWhere, $tableDataTag->getTableName(), $this->type, $conn->quote($word));


				// "FROM ... WHERE ..." (without SELECT)
		$stateCount	= $sqlWhere;
				// "SELECT c.*, m.* FROM ... WHERE ... ORDER ..." (without LIMIT)
		$stateLimit	= 'SELECT * ' . $sqlWhere . ' ORDER BY id DESC';


		$this->pager		= new Simple_Pager();
		$this->pager->setCount($stateCount)->setLimit($stateLimit);

		$page			= (int) $request->getParameter('page', 1);
		$this->pager->init($page, sfConfig::get('app_page_size', $this->intPageSize));

		$this->arrResult	= $this->pager->getResults();

		$this->dataItem		= new $this->dataClass();

		$this->hasErrors	= $request->hasErrors();
		if ($this->hasErrors) {
			$arrParameters		= $request->getParameterHolder()->getAll();
			$this->dataItem->fromArray($arrParameters);
		}

	}


	public function executeIndex(sfWebRequest $request) {

		if ($this->useGlobalTemplate) {
			$this->setTemplate('index', 'camera');
		}

		$this->getIndexData($request);

	}

	public function executeSearch(sfWebRequest $request) {

		if ($this->useGlobalTemplate) {
			$this->setTemplate('index', 'camera');
		}

		$this->getSearchData($request);

	}


	public function executeAdd($request) {

		$tagName		= $request->getParameter('name', '');
		$tagType		= (int) $request->getParameter('type', 0);
		$bool			= false;

		if (strlen($tagName)) {

			$tableTag		= new $this->dataClass();
			$tableTag->name		= $tagName;
			$tableTag->type		= $tagType;

			$bool			= $tableTag->save();

			// 保存失败，只可能是与现有的唯一索引冲突
			if (!$bool) {
				$request->setError('name', $tagName . ' 已存在');
				$from	= $request->getParameter('from', 'index');
				$this->forward($this->strModuleName, $from);
			}

		} else {

			$request->setError('name', '名称不能为空');
			$from	= $request->getParameter('from', 'index');
			$this->forward($this->strModuleName, $from);

		}

		$parameters		= array();
	#	$parameters['saved']	= intval($bool);

		$refer			= $request->getParameter('refer');
		$refer			= false;

		return	ActionsUtil::redirect($this->strModuleName . '/index', $parameters, $refer);

	}

	public function executeSave($request) {

		ActionsUtil::needPOST($request);		// 必须是 POST 方法

		$arrParameters		= $request->getParameterHolder()->getAll();

		$bool			= false;
		$tagId			= (int) $request->getParameter('id', 0);
		$tagItem		= new $this->dataClass($tagId);

		$tagItem->fromArray($arrParameters);

		$bool			= $tagItem->save();

		$parameters		= array();
	#	$parameters['saved']	= intval($bool);

		$refer			= $request->getParameter('refer');
	#	$refer			= false;

		$uri			= sprintf('%s/%s', $this->strModuleName, $request->getParameter('from', 'index'));

		return	ActionsUtil::redirect($uri, $parameters, $refer);

	}

	// 保存多字段表单
	// Com	= complicated
	public function executeSaveCom($request) {

		ActionsUtil::needPOST($request);		// 必须是 POST 方法

		$arrParameters		= $request->getParameterHolder()->getAll();

		########################
		#### Upload Pic
		########################
		$storeFilePath		= false;
		$webFilePath		= '';
		$hasFile		= isset($_FILES['pic']['name']);
		if ($hasFile && file_exists($_FILES['pic']['tmp_name'])) {

			$uploadDir		= ProjectConfiguration::getUploadDir();		// 上传目录
			$picDate		= date('Ymd');
			$storeDir		= $uploadDir . $picDate;
			if (!file_exists($storeDir)) {
				mkdir($storeDir);
			}

			$picName		= MyPic::formatPicFileName($_FILES['pic']['name']);
			$storeFilePath		= $storeDir . '/' . $picName;		// 存储路径
			$webFilePath		= $picDate . '/' . $picName;		// 访问路径

			move_uploaded_file($_FILES['pic']['tmp_name'], $storeFilePath);

		}


		$arrParameters['pic']	= $webFilePath;
		// 在编辑界面，使用 pic_save 字段保存图片地址
		// 并且没有上传新文件
		if (isset($arrParameters['pic_save']) && false === $storeFilePath) {
			$arrParameters['pic']	= $arrParameters['pic_save'];
		}
		########################
		########################


	#	Debug::pre($arrParameters);





		/*
		Debug::pr($_FILES);
		Debug::pr($picName);
		Debug::pr($uploadDir);
		Debug::pre($arrParameters);
		*/


		$bool			= false;
		$tagId			= (int) $request->getParameter('id', 0);
		$tagItem		= new $this->dataClass($tagId);

		$tagItem->fromArray($arrParameters);

		$bool			= $tagItem->save();


		########################
		#### Save Tag Map
		########################

			if (isset($arrParameters['checked_tags'])) {

				$mapItemTag		= new Model_Map_Base('Table_map_tag', $tagItem->id, 'item_id', 'tag_id');
				$arrRes			= $mapItemTag->update($arrParameters['checked_tags'], false);

			}

		########################
		########################





		$parameters		= array();
	#	$parameters['saved']	= intval($bool);

		$refer			= $request->getParameter('refer');
	#	$refer			= false;

		$uri			= sprintf('%s/%s', $this->strModuleName, $request->getParameter('from', 'index'));

		return	ActionsUtil::redirect($uri, $parameters, $refer);

	}

	protected function hasRelatedItem($deleteId) {

		$_data_class		= $this->dataClass;

		$tagItem		= new $_data_class();

		$conn		= SofavDB_Manager::getConnection();

		$arrDetect	= array(
					'product_id',
					'price_id',
					'caliber_id',
					'style_id',
				);

		$arrWhere	= array();

		foreach ($arrDetect as $field) {
			$arrWhere[]	= $field . ' = ' . $deleteId;
		}

		$sqlWhere	= implode(' OR ', $arrWhere);

		$sqlTemplate	= sprintf(' SELECT COUNT(*) AS total FROM %s WHERE %s ',
						$tagItem->getTableName(),
						$sqlWhere
					);

		$statement	= $conn->prepare($sqlTemplate);
		$statement->execute();
		$result		= $statement->fetchAll(PDO::FETCH_ASSOC);

		$total		= isset($result[0]['total']) ? $result[0]['total'] : 0;

		$total_2	= 0;

		if (0 == $total) {

			$tableMap		= new Table_map_tag();
			$tableMap->tag_id	= $deleteId;

			$arrMatched		= SofavDB_Record::matchAll($tableMap);

			$total_2		= count($arrMatched);

		}

		$number		= $total + $total_2;

		return		$number > 0;

	}

	public function executeDeleteAll($request) {

		ActionsUtil::needPOST($request);		// 必须是 POST 方法

		$bool			= false;
		$arrIds			= (array) $request->getParameter('checked_folder', array());

	#	Debug::pre($arrIds);

		$_data_class		= $this->dataClass;

		foreach ($arrIds as $tagId) {

		#	echo	$tagId;

			$tagItem		= new $_data_class($tagId);

			if ($tagItem->id) {

			#	Debug::pr($tagItem);

				if ($this->hasRelatedItem($tagId)) {
					return	$this->redirect('user/deleteError');
					exit;
				}

			#	var_dump($tagId);

				$bool			= $tagItem->delete();

			}
		}

		$parameters		= array();
	#	$parameters['deleted']	= intval($bool);

		$refer			= $request->getParameter('refer');
	#	$refer			= false;

		return	ActionsUtil::redirect($this->strModuleName . '/index', $parameters, $refer);
	}

	public function executeDelete($request) {

		ActionsUtil::needPOST($request);		// 必须是 POST 方法

		$bool			= false;
		$tagId			= (int) $request->getParameter('id', 0);
		$_data_class		= $this->dataClass;

		if ($tagId) {

			$tagItem		= new $_data_class($tagId);

			if ($tagItem->id) {

				$deleteId	= $tagItem->id;

				if ($this->hasRelatedItem($deleteId)) {
					return	$this->redirect('user/deleteError');
				}

			#	die('disable delete ' . $deleteId);
			#	exit;

				$bool			= $tagItem->delete();

			}

			$result			= $bool ? 'Success' : 'Failure';

		#	$this->redirect($this->strModuleName . '/index');
		}

		$parameters		= array();
	#	$parameters['deleted']	= intval($bool);

		$refer			= $request->getParameter('refer');
	#	$refer			= false;

		return	ActionsUtil::redirect($this->strModuleName . '/index', $parameters, $refer);
	}

	protected function getEditData(sfWebRequest $request) {

		$_data_class		= $this->dataClass;

		$tagId			= (int) $request->getParameter('id', 0);

		$this->dataItem		= new $_data_class($tagId);

	}

	public function executeEdit($request) {

		if ($this->useGlobalTemplate) {
			$this->setTemplate('edit', 'camera');
		}

		$this->getEditData($request);


	}



}
