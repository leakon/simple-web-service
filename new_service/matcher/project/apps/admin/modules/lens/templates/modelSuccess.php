<?php

/**
 * Template of [lens/modelSuccess]
 *
 */

?>

<div class="contentBox">

	<div class="boxHeader">

		<h3><?php echo $brandName ?>管理</h3>

		<div class="">

			<form name="theForm" id="id_tag_edit" action="<?php echo url_for($strModuleName . '/save') ?>" method="post">
			<input type="hidden" name="from" value="model" />
			<input type="hidden" name="type" value="<?php echo $type ?>" />
			<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />


			添加新<?php echo $brandName ?>

			<table>
			<tr>
				<td>选择品牌</td>
				<td>
					<select name="product_id">
					<?php
						echo	options_for_select($arrProducts, 1);
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>选择口径</td>
				<td>
					<select name="caliber_id">
					<?php
						echo	options_for_select($arrStyles, 1);
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
					<input type="submit" id="id_form_submit" value="添加" />

					<a href="javascript:;" id="id_clear_add_input">取消</a>
				</td>
			</tr>
			</table>

			</form>

		</div>


	</div>


	<div class="boxBody">

<?php if (isset($arrResult)) : ?>

	<?php if (count($arrResult)) : ?>
	<table class="item_list tag_list" cellspacing="1" id="id_tag_list_box">
	<thead>
		<tr>
			<th width="150"><input type="checkbox" id="id_check_all" value="" />品牌</th>
			<th width="">口径</th>
			<th width="">型号</th>
			<th width="60">重量</th>
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

	echo		$arrProducts[$dataItem['product_id']];

?>
			</td>
			<td><?php echo		$arrStyles[$dataItem['caliber_id']] ?></td>
			<td><?php echo S::E($dataItem['style']) ?></td>
			<td><?php echo S::E($dataItem['weight']) ?></td>
			<td class="edit tag_edit">
				<a href="<?php echo url_for($strModuleName . '/editModel?id=' . $dataItem['id']) ?>" class="tag_rn_btn">修改</a>
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


//var tagRename		= new SofavTagRename({'form_id':'id_tag_list_box'});



//var formItem		= new TagEditForm();

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

