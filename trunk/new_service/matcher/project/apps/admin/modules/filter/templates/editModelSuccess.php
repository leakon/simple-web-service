<?php

/**
 * Template of [stand/modelSuccess]
 *
 */

?>

<div class="contentBox">

	<div class="boxHeader">

		<h3>修改<?php echo $brandName ?></h3>

		<div class="">

			<form name="theForm" id="id_tag_edit" action="<?php echo url_for($strModuleName . '/saveCom') ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" name="from" value="model" />
			<input type="hidden" name="id" value="<?php echo $dataItem->id ?>" />
			<input type="hidden" name="type" value="<?php echo $type ?>" />
			<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />

			<table>
			<tr>
				<td>品牌</td>
				<td>
					<select name="product_id">
					<?php
						echo	options_for_select($arrProducts, $dataItem->id);
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
				<td>链接</td>
				<td>
					<input type="text" id="id_add_input_link" name="link" value="<?php echo S::E($dataItem->link) ?>" />
				</td>
			</tr>
			<tr>
				<td>图片</td>
				<td>
					<input type="file" id="id_add_input_pic" name="pic" value="<?php echo S::E($dataItem->pic) ?>" />

					<?php

						if (strlen($dataItem->pic)) {

							echo	sprintf('<p><img src="%s" class="list_img" alt="" /></p>',
									$webUploadDir . $dataItem->pic,
									$webUploadDir . $dataItem->pic
									);

							echo	sprintf('%s<input type="text" id="id_add_input_pic_save" name="pic_save" value="%s" size="36" />',
									$webUploadDir, S::E($dataItem->pic)
									);


						}

					?>
				</td>
			</tr>
			<tr>
				<td>标签</td>
				<td>
					<?php

					#	Debug::pr($arrTags);

						echo	MyHelp::showTagInput($arrTags, $dataItem->id);

					?>

				</td>
			</tr>
			<tr>
				<td>口径</td>
				<td>
					<input type="text" id="id_add_input_caliber" name="caliber" value="<?php echo S::E($dataItem->caliber) ?>" size="10" /> mm
				</td>
			</tr>
			<tr>
				<td>价格区间</td>
				<td>
					<select name="price_id">
					<?php
						echo	options_for_select($arrStyles, $dataItem->price_id);
					?>
					</select>
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

