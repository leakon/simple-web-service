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

		<h3><?php echo $brandName ?>管理</h3>



		<div class="">

			<form name="theForm" id="id_tag_edit" action="<?php echo url_for($strModuleName . '/save') ?>" method="post">
			<input type="hidden" name="from" value="index" />
			<input type="hidden" name="type" value="<?php echo $type ?>" />
			<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />

				添加新<?php echo $brandName ?>

			<table>
			<tr>
				<td>商品类型</td>
				<td>
					<select name="product_id">
					<?php
						echo	options_for_select($arrProducts, 1);
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>新标签</td>
				<td>
					<input type="text" id="id_add_input" name="name" value="<?php echo S::E($dataItem->name) ?>" />

					<span class="inline_error" id="id_tag_exist"></span>
					<?php if ($sf_request->hasError('name')): ?>
					<span class="inline_error" id="id_tag_error"><?php echo $sf_request->getError('name') ?></span>
					<?php endif; ?>

				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" id="id_form_submit" value="添加" />

					<a href="javascript:;" id="id_clear_add_input">取消</a>
				</td>
			</tr>
			</table>

			</form>

		</div>


	</div>

		<div class="floatxx">
			<form name="theSearchForm" id="id_tag_search" action="<?php echo url_for($strModuleName . '/search') ?>" method="get">

				<input type="text" id="id_search_input" name="word" value="<?php echo S::E($sf_request->getParameter('word', '')) ?>" />

				<input type="submit" id="id_search_form_submit" value="搜索" />
				<a href="<?php echo url_for($strModuleName . '/index') ?>">取消</a>
			</form>
		</div>

	<div class="boxBody">


		<div class="floatXX">
			<input type="button" id="id_batch_delete" value="批量删除" onclick="DoBatchDelete()" />
		</div>


<?php if (isset($arrResult)) : ?>

	<?php if (count($arrResult)) : ?>
	<table class="item_list tag_list" cellspacing="1" id="id_tag_list_box">
	<thead>
		<tr>
			<th class="num"><input type="checkbox" id="id_check_all" value="" />序列</th>
			<th class="brand w200">商品类型</th>
			<th class="brand"><?php echo $strCName ?></th>
			<th class="edit">操作</th>
		</tr>
	</thead>
	<tbody>

		<?php

		$idx	= ($pager->getPage() - 1) * $pager->getMaxPerPage() + 1 ;

		?>
		<?php foreach ($arrResult as $dataItem) : ?>
		<tr>
			<td>
<?php

	echo		sprintf('<input type="checkbox" name="checked_folder[%d]" value="%d" class="item_checkbox" /> %d',
				$dataItem['id'], $dataItem['id'], $idx++);

?>
			</td>
			<td>
				<?php

					$productId	= $dataItem['product_id'];
					if (isset($arrProducts[$productId])) {
						echo $arrProducts[$productId];
					} else {
						echo	'&nbsp;';
					}

				?>
			</td>

			<td><?php echo S::E($dataItem['name']) ?></td>
			<td class="edit tag_edit">
				<a href="<?php echo url_for($strModuleName . '/edit?id=' . $dataItem['id']) ?>" class="tag_rn_btn">修改</a>
				<a href="javascript:;" onclick="FormDel('tag_delete_form', <?php echo $dataItem['id'] ?>);">删除</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
	</table>

	<?php else : ?>

	对不起，没有找到符合条件的<?php echo $brandName ?>。

	<?php endif ?>

<?php endif ?>


<?php

$uri	= $pager->getPageUri();
$action	= $sf_context->getActionName();

include_partial('global/pager', array('pager' => $pager, 'pageUri' => url_for($strModuleName . '/' . $action) . $uri));
?>


	</div><!-- EndOf boxBody -->

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

<form id="tag_delete_form" action="<?php echo url_for($strModuleName . '/delete') ?>" method="post">
	<input type="hidden" name="id" value="" />
	<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
</form>

<?php

#	Debug::pr(SofavDB_Debug_PDO::getTimer());

