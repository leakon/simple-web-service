
<br class="clear" />

<table class="widefat">
<thead>
<tr>

	<th scope="col" colspan="2">客服中心</th>

</tr>
</thead>
<tbody>

	<?php

		$arrExtra	= $issue->getExtra()->getRaw('extra');

	?>

	<tr valign="top">
		<td class="formKeyColumn">审核结果</td>
		<td>
			<?php echo HelperView::getArray($arrExtra, 'verify_result') ?>
		</td>
	</tr>

	<tr valign="top">
		<td>审核日期</td>
		<td><?php echo HelperView::getArray($arrExtra, 'verify_date') ?></td>
	</tr>

	<tr valign="top">
		<td>审核说明</td>
		<td><?php echo HelperView::getTextArea($issue->getDescription()) ?></td>

	</tr>

	<tr valign="top">
		<td>客服中心处理过程</td>
		<td><?php echo HelperView::getTextArea($issue->getSolution()) ?></td>

	</tr>


</tbody>
</table>
