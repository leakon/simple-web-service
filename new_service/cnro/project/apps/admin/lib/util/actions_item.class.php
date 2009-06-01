<?php

class ActionItem {

	public static function tagToLink($stringTag, $uri) {

		$arrTags	= array();

		if (strlen($stringTag)) {
			$arrTags	= explode(SofavConstant::WORD_SEPARATOR, $stringTag);
		}

		$arrHtml	= array();

		foreach ($arrTags as $tag) {

			$arrHtml[]	= '<a href="'. $uri . urlencode($tag) .'">' . S::E($tag) . '</a>';

		}

		return	implode('', $arrHtml);

	}

}