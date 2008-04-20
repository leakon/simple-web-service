<?php use_helper('Object') ?>

<?php echo form_tag('maintance/update') ?>
<?php

$m = $maintance->getMaintanceDetail()->getRaw('detail');

#var_dump($arrMaintance);

?>
<?php echo object_input_hidden_tag($maintance, 'getId') ?>

<table border="1">
<tbody>


<tr>
	<th>服务器厂商及型号</th>
	<td><input type="text" name="m[server_info]" value="<?php echo HelperView::getArray($m, 'server_info') ?>" /></td>

	<th>客服电话</th>
	<td><input type="text" name="m[support_phone]" value="<?php echo HelperView::getArray($m, 'support_phone') ?>" /></td>
</tr>


<tr>
	<th>主板类型</th>
	<td><input type="text" name="m[main_board_info]" value="<?php echo HelperView::getArray($m, 'main_board_info') ?>" /></td>

	<th>支持CPU个数</th>
	<td><input type="text" name="m[support_cpu_amount]" value="<?php echo HelperView::getArray($m, 'support_cpu_amount') ?>" /></td>
</tr>

<tr>
	<th>内存个数</th>
	<td><input type="text" name="m[memory_amount]" value="<?php echo HelperView::getArray($m, 'memory_amount') ?>" /></td>

	<th>内存大小</th>
	<td><input type="text" name="m[memory_size]" value="<?php echo HelperView::getArray($m, 'memory_size') ?>" /></td>
</tr>


<tr>
	<th>CPU个数</th>
	<td><input type="text" name="m[cpu_quantity]" value="<?php echo HelperView::getArray($m, 'cpu_quantity') ?>" /></td>

	<th>CPU型号</th>
	<td><input type="text" name="m[cpu_style]" value="<?php echo HelperView::getArray($m, 'cpu_style') ?>" /></td>
</tr>
<tr>
	<th>CPU频率</th>
	<td><input type="text" name="m[cpu_frequncy]" value="<?php echo HelperView::getArray($m, 'cpu_frequncy') ?>" /></td>

	<th>CPU核心类型</th>
	<td><input type="text" name="m[cpu_core]" value="<?php echo HelperView::getArray($m, 'cpu_core') ?>" /></td>
</tr>

<tr>
	<th>硬盘类型</th>
	<td><input type="text" name="m[hd_style]" value="<?php echo HelperView::getArray($m, 'hd_style') ?>" /></td>

	<th>硬盘数量</th>
	<td><input type="text" name="m[hd_quantiry]" value="<?php echo HelperView::getArray($m, 'hd_quantiry') ?>" /></td>
</tr>
<tr>
	<th>硬盘容量</th>
	<td><input type="text" name="m[hd_size]" value="<?php echo HelperView::getArray($m, 'hd_size') ?>" /></td>

	<th>RAID</th>
	<td><input type="text" name="m[hd_raid]" value="<?php echo HelperView::getArray($m, 'hd_raid') ?>" /></td>
</tr>

<tr>
	<th>硬盘备注</th>
	<td colspan="3"><input type="text" name="m[hd_comment]" value="<?php echo HelperView::getArray($m, 'hd_comment') ?>" /></td>
</tr>




<tr>
	<th>网卡数量</th>
	<td><input type="text" name="m[net_card_quantity]" value="<?php echo HelperView::getArray($m, 'net_card_quantity') ?>" /></td>

	<th>网卡传输</th>
	<td></td>
</tr>


<tr>
	<th>光驱接口</th>
	<td colspan="3"></td>
</tr>


<tr>
	<th>操作系统</th>
	<td colspan="3"></td>
</tr>
<tr>
	<th>特殊功能</th>
	<td colspan="3"></td>
</tr>
<tr>
	<th>维护建议</th>
	<td colspan="3"></td>
</tr>



</tbody>
</table>
<hr />
<?php echo submit_tag('save') ?>
<?php if ($maintance->getId()): ?>
  &nbsp;<?php echo link_to('delete', 'maintance/delete?id='.$maintance->getId(), 'post=true&confirm=Are you sure?') ?>
  &nbsp;<?php echo link_to('cancel', 'maintance/show?id='.$maintance->getId()) ?>
<?php else: ?>
  &nbsp;<?php echo link_to('cancel', 'maintance/list') ?>
<?php endif; ?>
</form>
