
<?php

$arrLangOptions	= array(
			'ch'		=> '中文',
			'en'		=> 'English',
		);

?>

<h1>添加 / 修改分类</h1>
<form action="<?php echo url_for('admin/saveCategory') ?>" method="post">
<input type="hidden" name="id" value="<?php echo intval($arrEdit['id']) ?>" />
<table class="product_list" border="1" style="width:400px;">
	<tr>
		<td width="32">排序</td>
		<td><input type="text" name="sort_id" value="<?php echo intval($arrEdit['sort_id']) ?>" /></td>
	</tr>
	<tr>
		<td width="32">语言</td>
		<td><select name="lang">
			<?php
			
			if (empty($arrEdit['lang'])) {
				$arrEdit['lang']	= 'en';
			}
			
			echo	options_for_select($arrLangOptions, $arrEdit['lang']);
			
			?>	
			</select>
		</td>
	</tr>
	<tr>
		<td width="128">名称</td>
		<td><input type="text" name="title" value="<?php echo $arrEdit['title'] ?>" /></td>
	</tr>
	<tr>
		<td width="128">&nbsp;</td>
		<td><input type="submit" value="<?php echo $arrEdit['button'] ?>" /></td>
	</tr>
</table>
</form>

<p>
<a href="<?php echo url_for('admin/setCategory') ?>">添加新分类</a>
</p>

<hr />

<h1>分类列表</h1>
<table class="product_list" border="1" style="width:500px;">

<tr>
	<td width="32">排序</td>
	<td width="32">语言</td>
	<td width="128">名称</td>
	<td width="64">操作</td>
</tr>

<?php

foreach ($arrResult as $key => $item) :
	
	
?>


<tr>
	<td>
		<?php echo $item['sort_id'] ?>
	</td>
	
	<td>
		<?php echo $arrLangOptions[  $item['lang'] ] ?>
	</td>
	
	<td>
		<?php echo $item['title'] ?>
	</td>
	
	<td>
		<a href="<?php echo url_for('admin/setCategory?id=' . $item['id']) ?>">修改</a>
		<a href="javascript:;" onclick="FormDel('delete_category', '<?php echo $item['id'] ?>');">删除</a>
	</td>
</tr>



<?php

endforeach;

?>

</table>


<form id="delete_category" action="<?php echo url_for('admin/delCategory') ?>" method="post">
<input type="hidden" name="id" value="0" />
</form>

