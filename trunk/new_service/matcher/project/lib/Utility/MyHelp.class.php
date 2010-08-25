<?php

class MyHelp {

	public static function showTagInput($arrTags, $itemId = 0) {

		$arrRet		= array();

		$arrPlain	= array();


		if ($itemId) {

			$mapItemTag		= new Model_Map_Base('Table_map_tag', $itemId, 'item_id', 'tag_id');
			$arrRes			= $mapItemTag->getMap();

			$arrPlain		= Array_Util::ColToPlain($arrRes, 'tag_id', 'item_id');

		}

		foreach ($arrTags as $tagId => $tagName) {

			$arrRet[]	= sprintf('<input %s type="checkbox" name="checked_tags[%d]" value="%d" id="id_tag_%d" />'
					. '<label for="id_tag_%d">%s</label>',
						(isset($arrPlain[$tagId]) ? ' checked="checked"' : ''),
						$tagId, $tagId, $tagId, $tagId, S::E($tagName)
					);

		}

		return	implode('', $arrRet);


	}


	public static function showInlineTag($arrTags, $itemId, $joinChar = ', ') {

		if ($itemId) {

			$mapItemTag		= new Model_Map_Base('Table_map_tag', $itemId, 'item_id', 'tag_id');
			$arrRes			= $mapItemTag->getMap();

		}

		$arrJoin		= array();
		foreach ($arrRes as $tagRecord) {

			$arrJoin[]	= $arrTags[$tagRecord['tag_id']];

		}

		return	implode($joinChar, $arrJoin);

	}

	public static function showBagVolume($itemRecord) {

		$arrTypes	= MatcherConstant::getVolumeType();

		$arrNames	= array();

		$arrResult	= array();

		$webDir		= '/matcher/images/';

		foreach (array_keys($arrTypes) as $columnName) {

			$shortName			= str_replace('ext_vol_', '', $columnName);
			$arrNames[$columnName]		= $shortName;

		}

		foreach ($arrNames as $columnName => $shortName) {

			if ($itemRecord[$columnName]) {

				$imgSrc		= $webDir . $shortName . '.gif';

				$arrResult[]	= sprintf('<a href="javascript:;"><img src="%s" alt="%s" title="%s" /></a>',
								$imgSrc, $arrTypes[$columnName], $arrTypes[$columnName],
								$itemRecord[$columnName]
							);

			}


		}

	#	Debug::pr($arrResult);

		return	implode('', $arrResult);

	}


	public static function getBagVols($objItem) {

			// 查询所有本 $objItem->id 摄影包对应的容量记录
			$objTable		= new Table_data_model();
			$conn			= SofavDB_Manager::getConnection();

			$templateWhere		= sprintf('SELECT * FROM %s WHERE type = %d AND product_id = %d ',
								$objTable->getTableName(),
								MatcherConstant::BRAND_TYPE_BAG_VOL,
								$objItem->id
							);

			$statement		= $conn->prepare($templateWhere);

			$statement->execute();

			$result			= $statement->fetchAll(PDO::FETCH_ASSOC);


			$arrRet		= array();

			foreach ($result as $val) {

				$arrRet[ $val['style_id'] ]	= $val;

			}

			return	$arrRet;

	}

	public static function showBagType($objItem) {

		// 获取所有相机类型

		$arrRet			= array();

		// 默认选取 A 类型的摄影包
	#	$radioCheckValue	= isset($objItem->ext_vol_type) ? $objItem->ext_vol_type : MatcherConstant::BAG_VOL_A;
	#	$radioCheckValue	= isset($objItem->ext_vol_type) ? $objItem->ext_vol_type : 0;

		$strTypes		= isset($objItem->ext_vol_types) ? $objItem->ext_vol_types : '';

		$arrTypes		= array();

		if (strlen($strTypes)) {

			$arrTypes	= explode(',', $strTypes);

			// 把 数值 改为 索引，便于后面查询
			$arrTypes	= array_flip($arrTypes);

		}

		$arrBagVols	= self::getBagVols($objItem);

	#	Debug::pr($arrBagVols);

		foreach (MatcherConstant::getVolumes() as $key_1 => $val_1) {

			$arrRet[]	= sprintf(''
						. '<input %s type="checkbox" name="ext_vol_types[%d]" value="%s" id="id_vol_type_%s" />'
						. '<label for="id_vol_type_%s">%s</label> &nbsp; &nbsp; ' . "\n",
					#	($radioCheckValue == $key_1 ? 'checked="checked"' : ''),
						(isset($arrTypes[$key_1]) ? 'checked="checked"' : ''),
						$key_1,
						$key_1, $key_1, $key_1, $val_1
					);







			$arrRet[]	= '<br />';

			foreach (MatcherConstant::getVolumeType() as $key_2 => $val_2) {


				if ($key_2 == MatcherConstant::BAG_VOL_ACCESSORY) {
					// 附件是 checkbox

					// $val_2 是字段名
					$checked	= isset($arrBagVols[$key_1][$key_2]) && '1' == $arrBagVols[$key_1][$key_2];

					$arrRet[]	= sprintf('<label for="id_vol_%s_%s">%s:</label>'
							. '<input type="checkbox" name="%s[%s]" value="1" id="id_vol_%s_%s" %s />'
							. ', &nbsp; &nbsp; ' . "<br />\n",
							$key_2, $key_1, $val_2,
							$key_2, $key_1, $key_2, $key_1,
							($checked ? 'checked="checked"' : '')


						);

				} else {

					// $val_2 是字段名
					$value		= isset($arrBagVols[$key_1][$key_2]) ? $arrBagVols[$key_1][$key_2] : '';

					$arrRet[]	= sprintf('<label for="id_vol_%s_%s">%s:</label>'
							. '<input type="text" name="%s[%s]" value="%s" id="id_vol_%s_%s" size="4" />'
							. ', &nbsp; &nbsp;  ' . "\n",
							$key_2, $key_1, $val_2,
							$key_2, $key_1, $value, $key_2, $key_1

						);
				}

			}

			$arrRet[]	= '<hr />';

		} // EndOf foreach (MatcherConstant::getVolumes())

		return	implode('', $arrRet);

	}


	// 在管理后台显示摄影包列表，在容量列中显示字符
	public static function showBagInlineType($itemRecord, $sepChar = ', ') {

		$arrRet			= array();

		$arrResult		= MatcherConstant::getVolumes();

		if (isset($itemRecord['ext_vol_types'])) {

			$strTypes			= $itemRecord['ext_vol_types'];

			$arrTypes	= explode(',', $strTypes);

			// 把 数值 改为 索引，便于后面查询
		#	$arrTypes	= array_flip($arrTypes);

			$arrSelected	= array();

			foreach ($arrTypes as $key) {

				if (isset($arrResult[$key])) {

					$arrSelected[]	= $arrResult[$key];

				}

			}

			if (count($arrSelected)) {
				$arrRet[]		= '[' . implode(',', $arrSelected) . ']';
			}

		#	$arrRet[]		= isset($arrResult[$key]) ? ('[' . $arrResult[$key] . ']') : '';

		}

		foreach (MatcherConstant::getVolumeType() as $key_1 => $val_1) {

			if ($key_1 == MatcherConstant::BAG_VOL_ACCESSORY) {

				if (isset($itemRecord[$key_1])) {

					$arrRet[]	= sprintf('%s', $val_1);

				}


			} else {

				if (isset($itemRecord[$key_1])) {

					$arrRet[]	= sprintf('%s:%d', $val_1, $itemRecord[$key_1]);

				}

			}

		}

	#	Debug::pr($arrRet);

		return	implode($sepChar, $arrRet);

	}



	protected static $arrPrices	= array();

	public static function showItemPrice($priceId) {

		if (empty(self::$arrPrices)) {

			self::$arrPrices	= self::getPriceRanges();

		}

		$strRet		= '';

		if (isset(self::$arrPrices[$priceId])) {

			$strRet	= self::$arrPrices[$priceId];

		}

		return	$strRet;

	}


	public static function getPriceRanges() {

		$tableDataTag		= new Table_data_model();

		$pager			= new SofavDB_Pager($tableDataTag);

		$where			= array(
							'type'		=> MatcherConstant::BRAND_TYPE_PRICE,
						);

		$order			= array('min' => 'DESC');

		$pager->init($page, sfConfig::get('app_page_size', 100), array('where' => $where, 'order' => $order));

		$arrResult	= $pager->getResults();

		$arrOptions	= array();

		foreach ($arrResult as $val) {

			$arrOptions[ $val['id'] ]	= sprintf("%d - %d", $val['min'], $val['max']);

		}

		return	$arrOptions;

	}



	// 显示某个产品的价格区间
	public static function showProductPrice($productId = 0, $priceId = 0) {

		$tableDataTag		= new Table_data_model();

		$pager			= new SofavDB_Pager($tableDataTag);

		$where			= array(
							'type'		=> MatcherConstant::BRAND_TYPE_PRICE,
						);

		if ($productId > 0) {

			$where['product_id']	= $productId;

		}

		$order			= array('min' => 'DESC');

		$pager->init($page, sfConfig::get('app_page_size', 100), array('where' => $where, 'order' => $order));

		$arrResult	= $pager->getResults();

		$arrOptions	= array();

		foreach ($arrResult as $val) {

			$arrOptions[ $val['id'] ]	= sprintf("%d - %d", $val['min'], $val['max']);

		}

	//	$arrProducts	= MatcherConstant::getProducts();

		$strHtml	= '';

	//	$strHtml	.= '<select name="'.$strName.'">';
		$strHtml	.= options_for_select($arrOptions, $priceId);
	//	$strHtml	.= '</select>';

		$strHtml	= str_replace("\r\n", "", $strHtml);
		$strHtml	= str_replace("\n", "", $strHtml);

		return	$strHtml;

	}


}
