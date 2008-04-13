
<br class="clear" />

<table class="widefat">
<thead>
<tr>

	<th scope="col" colspan="2">提交问题</th>

</tr>
</thead>
<tbody>

	<?php

		$arrExtra	= $issue->getExtra()->getRaw('extra');

	#	var_dump($arrExtra['contact_name']);

	?>

	<tr valign="top">
		<td>联系人</td>
		<td>
			<input type="text" name="contact_name" value="<?php echo HelperView::getArray($arrExtra, 'contact_name') ?>" />
		</td>
	</tr>

	<tr valign="top">
		<td>联系方式</td>
		<td><input type="text" name="contact_value" value="<?php echo HelperView::getArray($arrExtra, 'contact_value') ?>" /></td>
	</tr>

	<tr valign="top">
		<td>服务优先级</td>
		<td>
			<?php
				echo select_tag('priority', options_for_select(IssuePeer::listAllPriority(), $issue->getPriority()));
			?>
		</td>
	</tr>

	<tr valign="top">
		<td>问题摘要</td>
		<td><?php echo object_input_tag($issue, 'getTitle', array (
		'size' => 80,
		)) ?></td>

	</tr>

	<tr valign="top">
		<td>请求详细描述</td>
		<td><?php echo object_textarea_tag($issue, 'getDescription', array (
		'size' => '30x3',
		)) ?></td>

	</tr>

</tbody>
</table>

<?php echo object_input_hidden_tag($issue, 'getId') ?>

<hr />
<?php echo submit_tag('保存') ?>

<input type="button" onclick="DoSaveSubmit('submitted', '提交上级后，就不可以再修改了，确定吗？');" value="提交上级" />

<input type="button" onclick="DoSaveSubmit('terminated', '终止流程后，就不可以再修改了，确定吗？');" value="终止流程" />

<?php if (1) : ?>

<input type="button" onclick="DoSaveSubmit('rejectted');" value="驳回" />
<?php endif ?>

<input type="hidden" name="save_type" value="default" />

<?php if ($issue->getId()): ?>
  &nbsp;<?php
  		if (0) {
  			echo link_to('delete', 'issue/delete?id='.$issue->getId(), 'post=true&confirm=Are you sure?');
  		}
  	?>
  &nbsp;<?php echo link_to('cancel', 'issue/show?id='.$issue->getId()) ?>
<?php else: ?>
  &nbsp;<?php echo link_to('cancel', 'issue/list') ?>
<?php endif; ?>



<script type="text/javascript">

var objTheForm = $('the_form');

function DoSaveSubmit(t, msg) {

	objTheForm.save_type.value = t;


	var c = typeof msg == 'undefined' || window.confirm(msg);

	if (c) {
		objTheForm.submit();
	}

}

</script>
