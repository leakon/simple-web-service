<?php

/**
 * Template of [camera/styleSuccess]
 *
 */

?>

<div class="contentBox">

	<div class="boxHeader">

		<h3>修改<?php echo $brandName ?></h3>

		<div class="">

			<form name="theForm" id="id_tag_edit" action="<?php echo url_for($strModuleName . '/save') ?>" method="post">
			<input type="hidden" name="from" value="model" />
			<input type="hidden" name="id" value="<?php echo $dataItem->id ?>" />
			<input type="hidden" name="type" value="<?php echo $type ?>" />
			<input type="hidden" name="refer" value="<?php echo GetRefer() ?>" />


			<table>
			<tr>
				<td>选择品牌</td>
				<td>
					<select name="product_id">
					<?php
						echo	options_for_select($arrProducts, $dataItem->product_id);
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>选择类型</td>
				<td>
					<select name="style_id">
					<?php
						echo	options_for_select($arrStyles, $dataItem->style_id);
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>型号</td>
				<td>
					<input type="text" id="id_add_input_style" name="style" value="<?php echo S::E($dataItem->style) ?>" />
				</td>
			</tr>
			<tr>
				<td>重量</td>
				<td>
					<input type="text" id="id_add_input_weight" name="weight" value="<?php echo S::E($dataItem->weight) ?>" size="10" /> Kg
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" id="id_form_submit" value="保存" />

					<a href="javascript:;" id="id_clear_add_input">取消</a>

					<a href="<?php echo url_for($strModuleName . '/model') ?>">返回列表</a>
				</td>
			</tr>
			</table>

			</form>

		</div>


	</div>



</div><!-- EndOf contentBox -->



<script type="text/javascript">

$('id_form_submit').disabled	= false;

$('id_clear_add_input').addEvent('click', function() {
	$('id_add_input_style').set('value', '');
	$('id_add_input_weight').set('value', '');
	$('id_tag_exist').set('html', '');
	var objTagError	= $('id_tag_error');
	if (objTagError) {
		objTagError.set('html', '');
	}
});


</script>

<?php

#	Debug::pr(SofavDB_Debug_PDO::getTimer());

