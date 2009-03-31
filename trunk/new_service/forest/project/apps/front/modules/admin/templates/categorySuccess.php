
<?php if (!$isTopCategory) : ?>
<h2>修改一级分类属性</h2>
<form name="cate_edit" id="id_category_edit" action="<?php echo url_for('admin/saveCategory') ?>" method="post">
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
<input type="hidden" name="id" value="<?php echo $categoryItem->id ?>" />

	<?php if ($sf_request->hasError('name')): ?>
	<span class="form_error"><?php echo $sf_request->getError('name') ?></span>
	<?php endif; ?>
	分类名称：<input type="text" name="name" value="<?php echo S::E($categoryItem->name) ?>" />
	<br />

	排列顺序：<input type="text" name="order_num" value="<?php echo $categoryItem->order_num ?>" />
	<br />

	<input type="submit" id="id_form_submit" value="保存" />

</form>

<hr />
<?php endif ?>




<?php

if ($isTopCategory) {

	echo		'<h2>管理一级分类</h2>';
	$listUrl	= url_for('admin/category');

} else {

	echo		'<h2>管理二级分类</h2>';
	echo		'<a href="' . url_for('admin/category') . '">返回一级分类列表</a>';
	$listUrl	= url_for('admin/editCategory');


}

?>


<form name="cate_new" id="id_category_new" action="<?php echo url_for('admin/saveCategory') ?>" method="post">
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
<input type="hidden" name="parent_id" value="<?php echo $categoryItem->id ?>" />

	<?php if ($sf_request->hasError('name')): ?>
	<span class="form_error"><?php echo $sf_request->getError('name') ?></span>
	<?php endif; ?>
	分类名称：<input type="text" name="name" value="" />

	<input type="submit" id="id_form_submit" value="添加" />

</form>







<form name="theForm" id="id_category_edit" action="<?php echo url_for('admin/saveCategoryOrder') ?>" method="post">
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
<table>

	<?php foreach ($arrCategories as $key => $oneCategory) : ?>

		<tr>
			<td><?php echo $key + 1 ?></td>
			<td>
				<a href="<?php echo $listUrl . '?id=' . $oneCategory->id ?>"><?php echo $oneCategory->name ?></a>

			</td>
			<td><input type="text" name="order_num[<?php echo $oneCategory->id ?>]" value="<?php echo $oneCategory->order_num ?>" /></td>
			<td><a href="<?php echo $listUrl . '?id=' . $oneCategory->id ?>">修改</a></td>
			<td><a href="javascript:;" onclick="FormDel('id_delete_form', <?php echo $oneCategory->id ?>)">删除</a></td>
		</tr>

	<?php endforeach ?>

</table>
<p><input type="submit" value="保存排列顺序" /></p>
</form>

<form name="deleteForm" id="id_delete_form" action="<?php echo url_for('admin/deleteCategory') ?>" method="post">
<input type="hidden" name="id" value="" />
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
</form>
