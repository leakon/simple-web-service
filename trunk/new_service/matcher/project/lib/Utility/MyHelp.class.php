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


	public static function showBagType($objItem) {

		$arrRet			= array();

		// 默认选取 A 类型的摄影包
	#	$radioCheckValue	= isset($objItem->ext_vol_type) ? $objItem->ext_vol_type : MatcherConstant::BAG_VOL_A;
		$radioCheckValue	= isset($objItem->ext_vol_type) ? $objItem->ext_vol_type : 0;

		foreach (MatcherConstant::getVolumns() as $key_1 => $val_1) {

			$arrRet[]	= sprintf(''
						. '<input %s type="radio" name="ext_vol_type" value="%s" id="id_vol_type_%s" />'
						. '<label for="id_vol_type_%s">%s</label> &nbsp; &nbsp; ' . "\n",
						($radioCheckValue == $key_1 ? 'checked="checked"' : ''),
						$key_1, $key_1, $key_1, $val_1
					);

		}

		$arrRet[]	= '<br />';

		foreach (MatcherConstant::getVolumnType() as $key_1 => $val_1) {


			if ($key_1 == MatcherConstant::BAG_VOL_ACCESSORY) {
				// 附件是 checkbox

				// $val_1 是字段名
				$checked	= isset($objItem->$key_1) && '1' == $objItem->$key_1;

				$arrRet[]	= sprintf('<label for="id_vol_%s">%s</label>'
						. '<input type="checkbox" name="%s" value="1" id="id_vol_%s" %s />'
						. ' &nbsp; &nbsp; ' . "\n",
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

	public static function showBagInlineType($itemRecord, $sepChar = ', ') {

		$arrRet			= array();

		$arrResult		= MatcherConstant::getVolumns();

		if (isset($itemRecord['ext_vol_type'])) {

			$key			= $itemRecord['ext_vol_type'];

			$arrRet[]		= isset($arrResult[$key]) ? ('[' . $arrResult[$key] . ']') : '';

		}

		foreach (MatcherConstant::getVolumnType() as $key_1 => $val_1) {

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
