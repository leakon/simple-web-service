
<br class="clear" />

<table class="widefat">
<thead>
	<tr>
		<th scope="col" colspan="2">提交问题</th>
	</tr>
</thead>
<tbody>

<?php
$arrExtra = $issue->getExtra()->getRaw('extra');
?>

	<tr valign="top">
		<td class="formKeyColumn">联系人</td>
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
		'size' => '80x15',
		)) ?></td>

	</tr>

<?php
include_partial('issue/editUploadFiles', array('issue' => $issue));
?>

</tbody>
</table>

<?php
include_partial('issue/editSubmits', array('issue' => $issue));
?>
