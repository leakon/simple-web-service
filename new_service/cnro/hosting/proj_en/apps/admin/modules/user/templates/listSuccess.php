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
			<input type="hidden" name="from" value="list" />
			<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />

			添加新<?php echo $brandName ?>

			<table>
			<tr>
				<td>姓名</td>
				<td>
					<input type="text" id="id_add_input_style" name="username" value="<?php echo S::E($dataItem->username) ?>" />
				</td>
			</tr>
			<tr>
				<td>密码</td>
				<td>
					<?php if ($sf_request->hasError('password')): ?>
					<span class="form_error"><?php echo $sf_request->getError('password') ?></span>
					<?php endif; ?>
					<input type="password" id="id_add_input_link" name="password" value="<?php echo S::E($dataItem->password) ?>" />
				</td>
			</tr>
			<tr>
				<td>确认密码</td>
				<td>
					<?php if ($sf_request->hasError('confirm')): ?>
					<span class="form_error"><?php echo $sf_request->getError('confirm') ?></span>
					<?php endif; ?>
					<input type="password" id="id_add_input_link" name="confirm" value="" />
				</td>
			</tr>
			<tr>
				<td>问题</td>
				<td>
					<input type="text" id="id_add_input_link" name="question" value="<?php echo S::E($dataItem->question) ?>" />
				</td>
			</tr>
			<tr>
				<td>答案</td>
				<td>
					<input type="text" id="id_add_input_link" name="answer" value="<?php echo S::E($dataItem->answer) ?>" />
				</td>
			</tr>
			<tr>
				<td>出生日期</td>
				<td>

					<?php

					$date		= substr((string) $dataItem->birthday, 0, 10);
					if ('' == $date) {
						$date	= date('Y-m-d');
					}

					echo input_date_tag('birthday', $date, array('rich' => true, 'readonly' => 'readonly', 'lang' => 'zh_CN'))

					?>

				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" id="id_form_submit" value="添加" class="btn" />

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
	<table class="tables" cellspacing="1" id="id_tag_list_box" border="1">
	<thead>
		<tr>
			<th class=""><input type="checkbox" id="id_check_all" value="" /></th>
			<th class="">姓名</th>
			<th class="">操作</th>
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

	echo		sprintf('<input type="checkbox" name="checked_folder[%d]" value="%d" class="item_checkbox" />',
				$dataItem['id'], $dataItem['id']);

?>
			</td>
			<td><?php echo S::E($dataItem['username']) ?></td>
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

