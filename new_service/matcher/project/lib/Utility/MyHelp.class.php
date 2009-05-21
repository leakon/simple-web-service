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

}
