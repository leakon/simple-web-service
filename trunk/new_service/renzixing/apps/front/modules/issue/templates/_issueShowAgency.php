
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

	?>

	<tr valign="top">
		<td class="formKeyColumn">联系人</td>
		<td>
			<?php echo HelperView::getArray($arrExtra, 'contact_name') ?>
		</td>
	</tr>

	<tr valign="top">
		<td>联系方式</td>
		<td><?php echo HelperView::getArray($arrExtra, 'contact_value') ?></td>
	</tr>

	<tr valign="top">
		<td>服务优先级</td>
		<td><?php echo IssuePeer::getPriorityString( $issue->getPriority() ) ?></td>
	</tr>

	<tr valign="top">
		<td>问题摘要</td>
		<td><?php echo $issue->getTitle() ?></td>
	</tr>

	<tr valign="top">
		<td>请求详细描述</td>
		<td><?php echo HelperView::getTextArea($issue->getDescription()) ?></td>

	</tr>

	<tr valign="top">
		<td>最后更新</td>
		<td><?php echo $userName ?> at <?php echo $issue->getUpdatedAt() ?></td>
	</tr>

<?php
include_partial('issue/editUploadFiles', array('issue' => $issue));
?>

</tbody>
</table>
