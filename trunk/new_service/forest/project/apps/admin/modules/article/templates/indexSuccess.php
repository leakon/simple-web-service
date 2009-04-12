
<form name="theform" id="searchForm" method="get" action="<?php echo url_for('article/index') ?>">

<table>
<tr>
	<td>一级分类</td>
	<td>
		<select name="top_category" onchange="ChangeCategory(this, $('id_sub_category_select'))" id="id_top_category_select">
			<option value="0">请选择</option>
			<?php

			$arrOptions	= array();
			foreach (Table_categories::getByParent(0, 99999) as $key => $objCategory) {

				$arrOptions[$objCategory->id]	= $objCategory->name;

			}

			echo options_for_select($arrOptions, $topCateId);

			?>
		</select>
	</td>
</tr>
<tr>
	<td>二级分类</td>
	<td>
		<select name="sub_category" id="id_sub_category_select">
		</select>

		<script type="text/javascript">

			ChangeCategory($('id_top_category_select'), $('id_sub_category_select'), <?php echo $topCateId ?>, <?php echo $subCateId ?>);

		</script>

	</td>
</tr>
<tr>
	<td>查询词</td>
	<td>
		<input type="text" name="kw" value="<?php echo S::E($strKW) ?>" />
	</td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td>
		<input type="submit" value="查询" />
		<a href="<?php echo url_for('article/index') ?>">重新搜索</a>
	</td>
</tr>


</table>

</form>




<?php if (isset($arrResult)) : ?>

<table>
<tr>
	<td>序号</td>
	<td>全选</td>
	<td>信息标题</td>
	<td>一级分类</td>
	<td>二级分类</td>
	<td>添加时间</td>
	<td>浏览次数</td>
	<td>编辑</td>
	<td>删除</td>
</tr>
<?php foreach ($arrResult as $key => $val) : ?>
<tr>
<?php

$cateId		= $val['category_id'];
$parentId	= $arrAllCategories[$cateId]['parent_id'];

?>
	<td><?php echo ($pager->getPage() - 1) * $pageSize + $key + 1 ?></td>
	<td><input type="checkbox" name="checked_item[<?php echo $val['id'] ?>]" value="<?php echo $val['id'] ?>" /></td>
	<td><a href="<?php echo url_for('/article/show?id=' . $val['id']) ?>" target="_blank"><?php echo S::E($val['title']) ?></a></td>
	<td><?php echo $arrAllCategories[$parentId]['name'] ?></td>
	<td><?php echo $arrAllCategories[$cateId]['name'] ?></td>
	<td><?php echo $val['published_at'] ?></td>
	<td><?php echo $val['view_cnt'] ?></td>
	<td><a href="<?php echo url_for('article/edit?id=' . $val['id']) ?>" target="_blank">编辑</a></td>
	<td><a href="javascript:;" onclick="FormDel('id_delete_form', <?php echo $val['id'] ?>)">删除</a></td>
</tr>


<?php endforeach ?>


</table>

<?php

$uri	= $pager->getPageUri();
$action	= $sf_context->getActionName();

include_partial('global/pager', array('pager' => $pager, 'pageUri' => $uri));

?>

<?php endif ?>




<form name="deleteForm" id="id_delete_form" action="<?php echo url_for('article/delete') ?>" method="post">
<input type="hidden" name="id" value="" />
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
</form>



<?php

#Debug::pr($arrAllCategories);

