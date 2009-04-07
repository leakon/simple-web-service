

<h2>修改二级分类属性</h2>



<form name="cate_edit" id="id_category_edit" action="<?php echo url_for('category/save') ?>" method="post">
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
<input type="hidden" name="id" value="<?php echo $categoryItem->id ?>" />
<input type="hidden" name="parent_id" value="<?php echo $categoryItem->parent_id ?>" />

	<?php if ($sf_request->hasError('name')): ?>
	<span class="form_error"><?php echo $sf_request->getError('name') ?></span>
	<?php endif; ?>
	分类名称：<input type="text" name="name" value="<?php echo S::E($categoryItem->name) ?>" />
	<br />

	排列顺序：<input type="text" name="order_num" value="<?php echo $categoryItem->order_num ?>" />
	<br />

	<input type="submit" id="id_form_submit" value="保存" />

	<?php

		echo	'<a href="' . url_for('category/index') . '?id=' . $categoryItem->parent_id . '">返回二级分类列表</a>';

	?>

</form>

<form name="deleteForm" id="id_delete_form" action="<?php echo url_for('category/delete') ?>" method="post">
<input type="hidden" name="id" value="" />
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
</form>
