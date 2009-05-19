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

		<h3><?php echo $brandName ?>品牌管理 - 修改名称</h3>

		<div class="float formAddTag">

			<form name="theForm" id="id_tag_edit" action="<?php echo url_for($strModuleName . '/save') ?>" method="post">
			<input type="hidden" name="from" value="edit" />
			<input type="hidden" name="id" value="<?php echo $dataItem->id ?>" />
			<input type="hidden" name="type" value="<?php echo $type ?>" />
			<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />

				名称品牌 <input type="text" id="id_add_input" name="name" value="<?php echo S::E($dataItem->name) ?>" />

				<input type="submit" id="id_form_submit" value="保存" />

				<a href="javascript:;" id="id_clear_add_input">取消</a>

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


var objCheckItem	= new SimpleFormCheck({
					'form_id':		'id_tag_list_box',
					'check_toggle':		'id_check_all'
				});


</script>


<?php

#	Debug::pr(SofavDB_Debug_PDO::getTimer());

