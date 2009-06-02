
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

<div class="left">
	<table border="0" class="leftCol tb tb2 right_6_pic index_td">

	<tr>
		<td class="single_cell">
			<?php
				echo	showTD('image_1');
			?>
		</td>
		<td class="single_cell">
			<?php
				echo	showTD('image_2');
			?>
		</td>
		<td class="single_cell">
			<?php
				echo	showTD('image_3');
			?>
		</td>
	</tr>
	<tr>
		<td class="single_cell">
			<?php
				echo	showTD('image_4');
			?>
		</td>
		<td class="single_cell">
			<?php
				echo	showTD('image_5');
			?>
		</td>
		<td class="single_cell">
			<?php
				echo	showTD('image_6');
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

