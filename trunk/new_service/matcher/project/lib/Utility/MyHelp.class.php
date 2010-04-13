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

	public static function showBagType($objItem) {

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

		foreach (MatcherConstant::getVolumes() as $key_1 => $val_1) {

			$arrRet[]	= sprintf(''
						. '<input %s type="checkbox" name="ext_vol_types[%d]" value="%s" id="id_vol_type_%s" />'
						. '<label for="id_vol_type_%s">%s</label> &nbsp; &nbsp; ' . "\n",
					#	($radioCheckValue == $key_1 ? 'checked="checked"' : ''),
						(isset($arrTypes[$key_1]) ? 'checked="checked"' : ''),
						$key_1,
						$key_1, $key_1, $key_1, $val_1
					);

		}

		$arrRet[]	= '<br />';

		foreach (MatcherConstant::getVolumeType() as $key_1 => $val_1) {


			if ($key_1 == MatcherConstant::BAG_VOL_ACCESSORY) {
				// 附件是 checkbox

				// $val_1 是字段名
				$checked	= isset($objItem->$key_1) && '1' == $objItem->$key_1;

				$arrRet[]	= sprintf('<label for="id_vol_%s">%s</label>'
						. '<input type="checkbox" name="%s" value="1" id="id_vol_%s" %s />'
						. ' &nbsp; &nbsp; ' . "<br />\n",
						$key_1, $val_1,
						$key_1, $key_1,
						($checked ? 'checked="checked"' : '')


					);

			} else {

				// $val_1 是字段名
				$value		= isset($objItem->$key_1) ? $objItem->$key_1 : '';

				$arrRet[]	= sprintf('<label for="id_vol_%s">%s</label>'
						. '<input type="text" name="%s" value="%s" id="id_vol_%s" size="4" />'
						. '&nbsp; &nbsp;  ' . "\n",
						$key_1, $val_1,
						$key_1, $value, $key_1

					);
			}

		}

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

}
