
<br class="clear" />

<table class="widefat">
<thead>
	<tr>
		<th scope="col" colspan="2">客服中心</th>
	</tr>
</thead>
<tbody>

<?php
$arrExtra = $issue->getExtra()->getRaw('extra');
?>

	<tr valign="top">
		<td class="formKeyColumn">审核结果</td>
		<td>
			<input type="text" name="verify_result" value="<?php echo HelperView::getArray($arrExtra, 'verify_result') ?>" />
		</td>
	</tr>

	<tr valign="top">
		<td>审核日期</td>
		<td><input type="text" name="verify_date" value="<?php echo HelperView::getArray($arrExtra, 'verify_date') ?>" /></td>
	</tr>

	<tr valign="top">
		<td>审核说明</td>
		<td><?php echo object_textarea_tag($issue, 'getDescription', array (
		'size' => '80x6',
		)) ?></td>

	</tr>

	<tr valign="top">
		<td>客服中心处理过程</td>
		<td><?php echo object_textarea_tag($issue, 'getSolution', array (
		'size' => '80x6',
		)) ?></td>

	</tr>

</tbody>
</table>

<?php
include_partial('issue/editSubmits', array('issue' => $issue));
?>
