<?php

/**
 * Template of [camera/editStyleSuccess]
 *
 */

?>

<div class="contentBox">

	<div class="boxHeader">

		<h3>修改<?php echo $brandName ?> - <?php echo S::E($dataItem->name) ?></h3>

		<div class="">

			<form name="theForm" id="id_tag_edit" action="<?php echo url_for($strModuleName . '/save') ?>" method="post">
			<input type="hidden" name="from" value="style" />
			<input type="hidden" name="id" value="<?php echo $dataItem->id ?>" />
			<input type="hidden" name="type" value="<?php echo $type ?>" />
			<input type="hidden" name="refer" value="<?php echo GetRefer() ?>" />

				<?php echo $brandName ?>　　 <input type="text" id="id_add_input" name="name" value="<?php echo S::E($dataItem->name) ?>" size="10" />

				<br />

				<?php echo $brandName ?>说明 <input type="text" id="id_add_input_detail" name="detail" value="<?php echo S::E($dataItem->detail) ?>" size="10"  />

				<br />

				<input type="submit" id="id_form_submit" value="保存" />

				<a href="javascript:;" id="id_clear_add_input">取消</a>

				<a href="<?php echo url_for($strModuleName . '/style') ?>">返回列表</a>

				<span class="inline_error" id="id_tag_exist"></span>
				<?php if ($sf_request->hasError('name')): ?>
				<span class="inline_error" id="id_tag_error"><?php echo $sf_request->getError('name') ?></span>
				<?php endif; ?>

			</form>

		</div>


	</div>



</div><!-- EndOf contentBox -->



<script type="text/javascript">

$('id_form_submit').disabled	= false;

$('id_clear_add_input').addEvent('click', function() {
	$('id_add_input').set('value', '');
	$('id_tag_exist').set('html', '');
	var objTagError	= $('id_tag_error');
	if (objTagError) {
		objTagError.set('html', '');
	}
});

</script>

<?php

#	Debug::pr(SofavDB_Debug_PDO::getTimer());

