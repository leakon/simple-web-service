
<?php

$arrLangOptions	= array(
			'ch'		=> '中文',
			'en'		=> 'English',
		);

?>

<h1>添加 / 修改菜单 
	(<?php echo $arrLangOptions[$strLang]?>)
</h1>
<form action="<?php echo url_for('admin/saveMenu') ?>" method="post">
<input type="hidden" name="id" value="<?php echo intval($arrEdit['id']) ?>" />
<input type="hidden" name="lang" value="<?php echo $strLang ?>" />
<table class="product_list" border="1" style="width:400px;">
	<tr>
		<td width="32">排序</td>
		<td><input type="text" name="sort_id" value="<?php echo intval($arrEdit['sort_id']) ?>" /></td>
	</tr>
	
	<tr>
		<td width="32">分类</td>
		<td><select name="category">
			<?php
			
			echo	options_for_select($arrCateOptions, $arrEdit['category']);
			
			?>	
			</select>
		</td>
	</tr>
	
	<tr>
		<td width="128">名称</td>
		<td><input type="text" name="title" value="<?php echo $arrEdit['title'] ?>" /></td>
	</tr>
	<tr>
		<td width="32">价格</td>
		<td><input type="text" name="price" value="<?php echo number_format($arrEdit['price'], 2, '.', '') ?>" /></td>
	</tr>
	<tr>
		<td width="128">&nbsp;</td>
		<td><input type="submit" value="<?php echo $arrEdit['button'] ?>" /></td>
	</tr>
</table>
</form>

<p>
<a href="<?php echo url_for('admin/setMenu?lang=ch') ?>">添加 <?php echo $arrLangOptions['ch']?> 菜单</a>
<br />
<a href="<?php echo url_for('admin/setMenu?lang=en') ?>">添加 <?php echo $arrLangOptions['en']?> 菜单</a>
</p>

<hr />


<h1>菜单列表</h1>

<table class="product_list" border="1" style="width:980px;">

<tr>
	<td width="32">排序</td>
	<td width="">语言</td>
	<td width="">分类</td>
	<td width="">名称</td>
	<td width="">价格</td>
	<td width="">操作</td>
</tr>

<?php

foreach ($arrResult as $key => $item) :
	
	
?>


<tr>
	<td><?php echo $item['sort_id'] ?></td>
	<td>
		<?php echo $arrLangOptions[  $item['lang'] ] ?>
	</td>
	<td>
		<?php echo $arrCategories[ $item['category'] ]['title'] ?>
	</td>
	<td><?php echo $item['title'] ?></td>
	<td><?php echo $item['price'] ?></td>
	<td>
		<a href="<?php echo url_for('admin/setMenu?id=' . $item['id']) ?>">修改</a>
		<a href="javascript:;" onclick="FormDel('delete_menu', '<?php echo $item['id'] ?>');">删除</a>
	</td>
</tr>



<?php

endforeach;

?>

</table>


<form id="delete_menu" action="<?php echo url_for('admin/delMenu') ?>" method="post">
<input type="hidden" name="id" value="0" />
</form>

<?php

#	Debug::pr(SofavDB_Debug_PDO::getTimer());

