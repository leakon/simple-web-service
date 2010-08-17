<?php

class bagActions extends BaseBrandActions
{
	public function preExecute() {

		parent::preExecute();

		$this->type		= MatcherConstant::BRAND_TYPE_BAG;

		$this->brandName	= '摄影包品牌';


	}


	protected function getFormOption() {

		$arrWhere		= array();
		$arrWhere['type']	= MatcherConstant::BRAND_TYPE_BAG;		// 摄影包品牌
		$arrResult		= Table_data_model::getResult($arrWhere);
		$this->arrProducts	= Table_data_model::getOption($arrResult, 'id', 'name');


		$arrWhere		= array();
		$arrWhere['type']	= MatcherConstant::BRAND_TYPE_PRICE;		// 价格区间
		$arrResult		= Table_data_model::getResult($arrWhere);

		$arrMin			= Table_data_model::getOption($arrResult, 'id', 'min');
		$arrMax			= Table_data_model::getOption($arrResult, 'id', 'max');
		$this->arrStyles	= array();
		foreach ($arrMin as $id => $minVal) {
			$this->arrStyles[$id]	= sprintf('%s - %s', $minVal, $arrMax[$id]);
		}

		// 显示 脚架 专用标签
		$this->arrTags		= Table_data_model::getTags(MatcherConstant::BRAND_TYPE_BAG);

	}


	public function executeModel(sfWebRequest $request) {

		$this->useGlobalTemplate	= false;
	#	$this->setTemplate('model', 'stand');

		$this->brandName		= '摄影包型号';

		$this->type			= MatcherConstant::BRAND_TYPE_BAG_MODEL;

		$this->getIndexData($request);

		$this->getFormOption();


	}

	public function executeEditModel(sfWebRequest $request) {

		$this->useGlobalTemplate	= false;
	#	$this->setTemplate('editModel', 'stand');

		$this->brandName		= '摄影包型号';

		$this->type			= MatcherConstant::BRAND_TYPE_BAG_MODEL;

		$this->getEditData($request);

		$this->getFormOption();

	}

	// 保存多字段表单
	// Com	= complicated
	public function executeSaveBag($request) {

		ActionsUtil::needPOST($request);		// 必须是 POST 方法


		$bool			= false;
		$tagId			= (int) $request->getParameter('id', 0);
		$tagItem		= new $this->dataClass($tagId);


		$arrParameters		= $request->getParameterHolder()->getAll();


		// 摄影包可选择多个级别，字段名称是 ext_vol_types

		if (isset($arrParameters['ext_vol_types']) && count($arrParameters['ext_vol_types'])) {


			$arrExtVolTypes		= $arrParameters['ext_vol_types'];

			$arrParameters['ext_vol_types']		= implode(',', $arrParameters['ext_vol_types']);

			if (strlen($arrParameters['ext_vol_types'])) {
				$arrParameters['ext_vol_types']		= ',' . $arrParameters['ext_vol_types'] . ',';
			}

		#	Debug::pr($arrExtVolTypes);

			########################
			#### Save Bag Style Map
			########################


			// 删除所有本 $tagItem->id 摄影包对应的容量记录
			$objTable		= new Table_data_model();
			$conn			= SofavDB_Manager::getConnection();

			$templateWhere		= sprintf('DELETE FROM %s WHERE type = %d AND product_id = %d ',
								$objTable->getTableName(),
								MatcherConstant::BRAND_TYPE_BAG_VOL,
								$tagItem->id
							);

			$statement		= $conn->prepare($templateWhere);

			$statement->execute();

			// 更新映射关系
			$mapItemTag		= new Model_Map_Base('Table_map_bag_style', $tagItem->id, 'bag_id', 'style_id');
			$arrRes			= $mapItemTag->update($arrExtVolTypes, false);

			$arrMap			= $mapItemTag->getMap();

		#	$arrStyle_Bag	= array();

			$arrTypes	= MatcherConstant::getVolumeType();

			// 把新的 $tagItem->id 摄影包对应的容量记录添加到表中
			foreach ($arrMap as $oneMap) {

			#	$arrStyle_Bag[ $oneMap['style_id'] ]	= $oneMap['bag_id'];

				$objNewItem			= new Table_data_model();

				$objNewItem->type		= MatcherConstant::BRAND_TYPE_BAG_VOL;
				$objNewItem->product_id		= $tagItem->id;
				$objNewItem->style_id		= $oneMap['style_id'];

				$arrFrom		= array();

				foreach ($arrTypes as $typeName => $cn) {

					if (isset($arrParameters[$typeName][$oneMap['style_id']])) {
						$arrFrom[$typeName]	= $arrParameters[$typeName][$oneMap['style_id']];
					}

				}

				$objNewItem->fromArray($arrFrom);

				$objNewItem->save();

			#	Debug::pr($arrFrom);



			}

		#	Debug::pre($arrStyle_Bag);
		#	Debug::pre($arrMap);
#
			########################
			########################




		}

	#	Debug::pre($arrParameters);


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


}
