
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

		$arr	= Custom_Homepage::genIndexBlock($name);

		$str	= '';

		$str	.= '<h3>' . $name . '</h3>';

		$str	.= '' . $arr['link'] . '<br />';
		$str	.= '' . $arr['desc'] . '';

		if ($option['has_pic'] && isset($arr['pic'])) {
			$str	.= '<p>' . $arr['pic'] . '</p>';
		}

		return	$str;

	}



#	Debug::pr($GLOBALS['global_data']);


?>
<div class="itemtitle"><h3>首页设置</h3></div>

<?php if (0) : ?>

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
//	var objSelectTree	= new SimpleSelectTree(objConf);
</script>
<!-- 树形分类预览 End -->

<?php endif ?>

<form method="post" action="<?php echo url_for('portal/save') ?>">

<p>
<input type="submit" value="保存" class="btn" />
</p>

<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />


<div id="contentBox">

<?php if (0) : ?>
<div class="left">
	<table border="0" class="leftCol tb tb2 index_conf index_td">

	<tr>
		<td>
			<?php
				echo	showTD('block_1');
			?>
		</td>
	</tr>
	<tr>
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
	</tr>


	</table>

</div>
<?php endif ?>

<?php
function showPics($idx) {

#	global $arrDataConf;

	$arrDataConf	= $GLOBALS['global_data'];

	$format	=
	'

				图片[%d]<input type="text" name="nav_pic_src[%d]" value="%s" size="48" />
				<br />
				连接[%d]<input type="text" name="nav_pic_link[%d]" value="%s" size="48" />
	';

	return	sprintf($format,

			$idx, $idx,
			(isset($arrDataConf['block']['nav_pic_src'][$idx]) ? $arrDataConf['block']['nav_pic_src'][$idx] : ''),

			$idx, $idx,
			(isset($arrDataConf['block']['nav_pic_link'][$idx]) ? $arrDataConf['block']['nav_pic_link'][$idx] : '')

			);

}

?>


<div >
	<h2>轮播图</h2>
	<table border="0" class="leftCol tb tb2 right_6_pic index_td">
	<tr>
		<td class="single_cell">
			<?php

			echo	showPics(1);

			?>
		</td>
	</tr>
	<tr>
		<td class="single_cell">
			<?php

			echo	showPics(2);

			?>
		</td>
	</tr>
	<tr>
		<td class="single_cell">
			<?php

			echo	showPics(3);

			?>
		</td>
	</tr>
	<tr>
		<td class="single_cell">
			<?php

			echo	showPics(4);

			?>
		</td>
	</tr>
	</table>

</div>



<div class="left">
	<table border="0" class="leftCol tb tb2 right_6_pic index_td">

	<tr>
		<td class="single_cell">
			<?php
				echo	showTD('image_nitrogen');
			?>
		</td>
		<td class="single_cell">
			<?php
				echo	showTD('image_vegetables');
			?>
		</td>
		<td class="single_cell">
			<?php
				echo	showTD('image_hypoxic');
			?>
		</td>
	</tr>
	</table>



	<table border="0" class="leftCol tb tb2 right_6_pic index_td">
	<tr>
		<td class="single_cell">
			<?php
				echo	showTD('middle_left');
			?>
		</td>
		<td class="single_cell">
			<?php
				echo	showTD('middle_right');
			?>
		</td>
	</tr>
	</table>


	<table border="0" class="leftCol tb tb2 right_6_pic index_td">
	<tr>
		<td class="single_cell">
			<?php
				echo	showTD('right_1');
			?>
		</td>
		<td class="single_cell">
			<?php
				echo	showTD('right_2');
			?>
		</td>
	</tr>
	</table>

</div>


<div style="clear:both"></div>



<div >
	<table border="0" class="leftCol tb tb2 right_6_pic index_td">
	<tr>
		<td class="single_cell">
			导航数量
			<input type="text" name="nav_num" value="<?php echo isset($arrDataConf['block']['nav_num']) ? $arrDataConf['block']['nav_num'] : '' ?>" />
		</td>
	</tr>
	<tr>
		<td class="single_cell">
			产品位置
			<input type="text" name="product_pos" value="<?php echo isset($arrDataConf['block']['product_pos']) ? $arrDataConf['block']['product_pos'] : '' ?>" />
		</td>
	</tr>
	<tr>
		<td class="single_cell">
			领域位置
			<input type="text" name="range_pos" value="<?php echo isset($arrDataConf['block']['range_pos']) ? $arrDataConf['block']['range_pos'] : '' ?>" />
		</td>
	</tr>
	</table>

</div>








<h4>联系信息</h4>

<div style="height:300px;">

	<?php

	$arrInfoFck		= CnroConstant::getFckEdtor();
	require_once($arrInfoFck['include_dir']);

	$oFCKeditor		= new FCKeditor('contacts') ;
	$oFCKeditor->BasePath	= $arrInfoFck['base_path'];

	$oFCKeditor->Width	= '100%';
	$oFCKeditor->Height	= '100%';
	$oFCKeditor->Value	= isset($arrDataConf['block']['contacts']) ? $arrDataConf['block']['contacts'] : '';
	$oFCKeditor->Config	= array(
					'AutoDetectLanguage'	=> false,
					'DefaultLanguage'	=> 'zh-cn'
				);
	$oFCKeditor->Create() ;

	?>
</div>


<h4>商务合作-合作伙伴</h4>

<div style="height:300px;">

	<?php

	$arrInfoFck		= CnroConstant::getFckEdtor();
	require_once($arrInfoFck['include_dir']);

	$oFCKeditor		= new FCKeditor('cooperate') ;
	$oFCKeditor->BasePath	= $arrInfoFck['base_path'];


	$oFCKeditor->Width	= '100%';
	$oFCKeditor->Height	= '100%';
	$oFCKeditor->Value	= isset($arrDataConf['block']['cooperate']) ? $arrDataConf['block']['cooperate'] : '';
	$oFCKeditor->Config	= array(
					'AutoDetectLanguage'	=> false,
					'DefaultLanguage'	=> 'zh-cn'
				);
	$oFCKeditor->Create() ;

	?>
</div>


</div>

<p>
<input type="submit" value="保存" class="btn" />
</p>

</form>

