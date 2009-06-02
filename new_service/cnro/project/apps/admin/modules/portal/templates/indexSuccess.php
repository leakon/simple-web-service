
<?php

$arrOptionNoPic	= array(
			'has_pic'	=> false
		);


	$GLOBALS['global_data']		= $arrDataConf;
	Custom_Homepage::setDataConf($arrDataConf);

#	Debug::pr($arrDataConf);


	function showTD($name, $option = array()) {

		if (!isset($option['has_pic'])) {
			$option['has_pic']	= true;
		}

		$arr	= Custom_Homepage::genCategorySelect($name);

		$str	= '';

		$str	.= '<h3>' . $name . '</h3>';

	#	$str	.= '<p>' . $arr['top'] . '</p>';
	#	$str	.= '<p>' . $arr['sub'] . '</p>';

		$str	.= '分类：' . $arr['top'] . '';
		$str	.= '';
		$str	.= '' . $arr['path'] . '';

		if ($option['has_pic'] && isset($arr['pic'])) {
			$str	.= '<p>' . $arr['pic'] . '</p>';
		}

		return	$str;

	}


	function showADBanner($name, $option = array()) {

		$arrDataConf		= $GLOBALS['global_data'];

	#	var_dump($arrDataConf);

		if (!isset($option['has_pic'])) {
			$option['has_pic']	= true;
		}

		$str	= '';

		$str	.= '<h3>' . $name . '</h3>';


		$str	.= sprintf('链接：<input type="text" name="%s" class="admin_pic_url" value="%s" /> <br />'
					. '地址：<input type="text" name="%s" class="admin_pic_url" value="%s" /> 留空则不显示，后缀为swf则显示FLASH',
					$name . '_link',
					isset($arrDataConf['block'][$name]) ? S::E($arrDataConf['block'][$name . '_link']) : '#',
					$name,
					isset($arrDataConf['block'][$name]) ? S::E($arrDataConf['block'][$name]) : ''
				);

		if ($option['has_pic'] && isset($arrDataConf['block'][$name])) {

			$imgLink	= isset($arrDataConf['block'][$name . '_link']) ? $arrDataConf['block'][$name . '_link'] : '#';

			$imgSrc		= $arrDataConf['block'][$name];

			$tmp		= explode('.', $imgSrc);
			$ext		= array_pop($tmp);
		#	var_dump($ext);


			if ('swf' == $ext) {
				$str	.= sprintf('<p><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="220" height="33"><param name="movie" value="%s"><param name="quality" value="high"><param name="menu" value="false"><param name="wmode" value="opaque"><param name="FlashVars" value=""><embed src="%s" wmode="opaque" flashvars="" false="" quality="high" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" width="220" height="33"></object></p>', $imgSrc, $imgSrc);
			} else {
				$str	.= sprintf('<p><a href="%s" target="_blank"><img src="%s" width="220" height="33" /></a></p>', $imgLink, $imgSrc);
			}

		}

		return	$str;

	}



?>
<div class="itemtitle"><h3>首页设置</h3></div>


<form method="get" id="show_category_form" action="#">
选中的分类ID：<br />
<input type="text" name="category_id" value="" id="form_category_id" />
</form>

<!-- 树形分类预览 Begin -->
<div id="article_category" class="category_box"></div>
<script type="text/javascript">
var objConf		= {
				'box_id':		'article_category',
				'category_type':	'<?php echo CnroConstant::CATEGORY_TYPE_ALL ?>',
				'form_id':		'show_category_form',
				'form_field':		'form_category_id'
			}
var objSelectTree	= new SimpleSelectTree(objConf);
</script>
<!-- 树形分类预览 End -->



<form method="post" action="<?php echo url_for('portal/save') ?>">

<p>
<input type="submit" value="保存" class="btn" />
</p>

<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />


<div id="contentBox">

<div class="left">
	<table border="0" class="leftCol tb tb2">

	<tr>
		<td>
			<?php
				echo	showTD('focus', $arrOptionNoPic);
			?>
		</td>
		<td>
			<?php
				echo	showTD('head', $arrOptionNoPic);
			?>
		</td>
	</tr>

	<tr>
		<td colspan="2">

			<?php
				echo	showADBanner('index_ad_1');
			?>

		</td>
	</tr>


	<tr>
		<td>
			<?php
				echo	showTD('news_1');
			?>
		</td>
		<td>
			<?php
				echo	showTD('news_2');
			?>
		</td>
	</tr>


	<tr>
		<td colspan="2">
			<?php
				echo	showADBanner('index_ad_2');
			?>
		</td>
	</tr>


	<tr>
		<td>
			<?php
				echo	showTD('block_1');
			?>
		</td>
		<td>
			<?php
				echo	showTD('block_2');
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php
				echo	showTD('block_3');
			?>
		</td>
		<td>
			<?php
				echo	showTD('block_4');
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php
				echo	showTD('block_5');
			?>
		</td>
		<td>
			<?php
				echo	showTD('block_6');
			?>
		</td>
	</tr>


	</table>

</div>




<?php


#	Debug::pr($arrDataConf);

?>

<div class="right">
	<table border="0" class="tb tb2">
	<tr>
		<td>
			<?php echo checkbox_tag( 'use_user', 1, isset($arrDataConf['block']['use_user'] ), array('id' => 'id_use_user')) ?>
			<label for="id_use_user">开启用户注册/登录</labbel>

		</td>
	</tr>
	<tr>
		<td>
			<?php
				echo	showTD('scroll_1', $arrOptionNoPic);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php
				echo	showTD('scroll_2', $arrOptionNoPic);
			?>
		</td>
	</tr>


	<tr>
		<td>
			<?php
				echo	showTD('side_1');
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php
				echo	showTD('side_2');
			?>
		</td>
	</tr>
	</table>
</div>

</div>

<p>
<input type="submit" value="保存" class="btn" />
</p>

</form>

