<?php

class Custom_Homepage {

	protected static
		$arrOptions		= NULL,
		$conf			= array();

	public static function setDataConf($arrConf) {

		self::$conf	= $arrConf;

	#	Debug::pr(self::$conf);

	}

	private static function getTopOptions($topCateId = 0) {

		if (empty(self::$arrOptions)) {

			self::$arrOptions	= array();
			foreach (Table_categories::getByParent(0, 99999) as $key => $objCategory) {
				self::$arrOptions[$objCategory->id]	= $objCategory->name;
			}

		}

		return	options_for_select(self::$arrOptions, $topCateId);

	}

	public static function genIndexBlock($name) {

		$arrFields	= array('link', 'pic', 'desc');

		foreach ($arrFields as $type) {

			if (!isset(self::$conf['block'][$name][$type])) {
				self::$conf['block'][$name][$type]	= '';
			}

		}

		$arrRet		= array();
		$arrRet['link']	= sprintf(
						'链接：<input type="text" name="%s[link]" value="%s" '
						. ' class="admin_block_link" />'
						. '',
						$name, S::E(self::$conf['block'][$name]['link'])
					);

		$arrRet['pic']	= sprintf(
						'配图：<input type="text" name="%s[pic]" value="%s" '
						. ' size="20"  class="admin_pic_url" />'
						. ''
						. '<p><img src="%s" /></p>',
						$name, S::E(self::$conf['block'][$name]['pic']),
						S::E(self::$conf['block'][$name]['pic'])
					);

		$arrRet['desc']	= sprintf(
						'描述：<textarea name="%s[desc]" '
						. ' class="admin_block_desc" />%s</textarea>'
						. '',
						$name, S::E(self::$conf['block'][$name]['desc'])
					);

		return	$arrRet;

	}




	public static function genCategorySelect($name) {


		$top		= 0;
		$pic		= '';

		if (isset(self::$conf['block']['cate_' . $name]['top'])) {
			$top	= self::$conf['block']['cate_' . $name]['top'];
		}

		if (isset(self::$conf['block']['cate_' . $name]['pic'])) {
			$pic	= self::$conf['block']['cate_' . $name]['pic'];
		}

		$arrRet		= array();
		$arrRet['top']	= sprintf(
						'<input type="text" name="cate_%s[top]" value="%s" '
						. ' id="id_cate_top_%s" size="8" /> <br />'
						. ''
						. '',
						$name, $top, $top
					);

		$arrRet['pic']	= sprintf(
						'配图：<input type="text" name="cate_%s[pic]" id="id_cate_pic_%s" class="admin_pic_url" value="%s" />'
						. ''
						. '<p><img src="%s" /></p>',

						$name, $name, $pic, $pic
					);


		$arrCategoryPath		= Table_categories::getCategoryPath($top);

		$lastCatId	= 0;
		$lastCatName	= '一级分类';
		$arrPath	= array();
		if (count($arrCategoryPath)) {

			foreach ($arrCategoryPath as $catId => $cateInfo) {

				$arrPath[]	= sprintf('<span id="id_cate_%d">%s</span>',
								$cateInfo['id'],
								S::E($cateInfo['name'])
							);
				$lastCatId	= $cateInfo['id'];
				$lastCatName	= S::E($cateInfo['name']);

			}
		}

		$arrRet['path']	= '路径：' . implode(' &gt; ', $arrPath);


		return	$arrRet;

	}

}
