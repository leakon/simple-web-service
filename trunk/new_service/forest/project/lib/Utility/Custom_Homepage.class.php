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


	public static function genCategorySelect($name) {

		$top		= 0;
		$sub		= 0;
		$pic		= '';

		if (isset(self::$conf['block']['cate_' . $name]['top'])) {
			$top	= self::$conf['block']['cate_' . $name]['top'];
		}

		if (isset(self::$conf['block']['cate_' . $name]['sub'])) {
			$sub	= self::$conf['block']['cate_' . $name]['sub'];
		}

		if (isset(self::$conf['block']['cate_' . $name]['pic'])) {
			$pic	= self::$conf['block']['cate_' . $name]['pic'];
		}

		$arrRet		= array();
		$arrRet['top']	= sprintf(
						'<select name="cate_%s[top]" onchange="ChangeCategory(this, $(\'id_cate_sub_%s\'))"'
						. ' id="id_cate_top_%s">'
						. '<option value="0">请选择</option>'
						. '%s</select>',
						$name, $name, $name, self::getTopOptions($top)
					);

		$arrRet['sub']	= sprintf(
						'<select name="cate_%s[sub]" id="id_cate_sub_%s">'
						. '</select>'
						. '<script type="text/javascript">'
						. 'ChangeCategory($(\'id_cate_top_%s\'), $(\'id_cate_sub_%s\')'
						. ', %d, %d);</script>',
						$name, $name, $name, $name, $top, $sub
					);


		$arrRet['pic']	= sprintf(
						'配图：<input type="text" name="cate_%s[pic]" id="id_cate_pic_%s" value="%s" />'
						. ''
						. '<p><img src="%s" /></p>',

						$name, $name, $pic, $pic
					);

		return	$arrRet;

	}

}
