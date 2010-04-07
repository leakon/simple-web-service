<?php

/**
 * Template of [tag/listSuccess]
 *
 */

#var_dump($type);
#var_dump($strModuleName);

?>

<div class="contentBox">

	<div class="boxHeader">

		<h3>修改<?php echo $brandName ?></h3>

		<div class="">

			<form name="theForm" id="id_tag_edit" action="<?php echo url_for($strModuleName . '/save') ?>" method="post">
			<input type="hidden" name="from" value="index" />
			<input type="hidden" name="id" value="<?php echo $dataItem->id ?>" />
			<input type="hidden" name="type" value="<?php echo $type ?>" />
			<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />

			<input type="text" id="id_add_input_min" name="min" value="<?php echo $dataItem->min ?>" size="5" />

			至

			<input type="text" id="id_add_input_max" name="max" value="<?php echo $dataItem->max ?>" size="5" />

			<input type="submit" id="id_form_submit" value="保存" />

			<a href="javascript:;" id="id_clear_add_input">取消</a>

			<a href="<?php echo url_for($strModuleName . '/index') ?>">返回列表</a>

			</form>

		</div>


	</div>



</div><!-- EndOf contentBox -->



<script type="text/javascript">

$('id_form_submit').disabled	= false;

$('id_clear_add_input').addEvent('click', function() {
	$('id_add_input_min').set('value', '');
	$('id_add_input_max').set('value', '');
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

