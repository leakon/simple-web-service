
<br class="clear" />

<table class="widefat">
<thead>
	<tr>
		<th scope="col" colspan="2">事业部</th>
	</tr>
</thead>
<tbody>

<?php
$arrExtra = $issue->getExtra()->getRaw('extra');
?>

	<tr valign="top">
		<td class="formKeyColumn">处理状态</td>
		<td>
			<input type="text" name="solution_status" value="<?php echo HelperView::getArray($arrExtra, 'solution_status') ?>" />
		</td>
	</tr>

	<tr valign="top">
		<td>预计完成时间</td>
		<td><input type="text" name="solution_deadline" value="<?php echo HelperView::getArray($arrExtra, 'solution_deadline') ?>" /></td>
	</tr>

	<tr valign="top">
		<td>问题产生原因分析</td>
		<td><?php echo object_textarea_tag($issue, 'getDescription', array (
		'size' => '80x6',
		)) ?></td>

	</tr>

	<tr valign="top">
		<td>处理结果具体内容</td>
		<td><?php echo object_textarea_tag($issue, 'getSolution', array (
		'size' => '80x6',
		)) ?></td>

	</tr>

	<tr valign="top">
		<td>相关知识点</td>
		<td><?php echo object_textarea_tag($issue, 'getReference', array (
		'size' => '80x6',
		)) ?></td>

	</tr>
</tbody>
</table>

<?php
include_partial('issue/editSubmits', array('issue' => $issue));
?>
