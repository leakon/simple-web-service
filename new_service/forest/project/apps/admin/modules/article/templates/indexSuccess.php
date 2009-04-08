
<script type="text/javascript">

<?php

$tableCategory		= new Table_categories();
$criteria		= new SofavDB_Criteria();
$resAll			= SofavDB_Record::findAll($tableCategory, $criteria);

$arrCategories		= array();
foreach ($resAll as $objCategory) {
	$arrCategories[]	= sprintf('[%d,%d,"%s"]', $objCategory->id, $objCategory->parent_id, S::E($objCategory->name));
}

#	Debug::pr($arrCategories);

echo	sprintf('var arrAllCategories	= [%s];', implode(',', $arrCategories));

?>

function onChangeTopCategory(objSelect, topCatId, subCatId) {

	var objSubSelect	= document.getElementById('id_sub_category_select');

	if (objSubSelect) {
		objSubSelect.innerHTML	= '';
	} else {
		return;
	}


	var intIndex, parentId;
	intIndex	= objSelect.selectedIndex;

	if ('undefined' == typeof topCatId) {

		if (intIndex == 0) {
			return;
		}

		parentId	= objSelect.options[intIndex].value;

	} else {

		if (topCatId == 0) {
			return;
		}

		parentId	= topCatId;

	}

//	alert(parentId);
//	alert(objSelect.options[intIndex].value);

	var i, len;
	var categoryItem;
	var arrSubCategories	= [];
	for (i = 0, len = arrAllCategories.length; i < len; i++) {

		categoryItem		= arrAllCategories[i];

		if (parentId == categoryItem[1]) {
			arrSubCategories.push(categoryItem);
		}

	}

	var arrHtml		= [];
	var issetSubCatId	= false;

	if ('undefined' != typeof subCatId) {
		issetSubCatId	= true;
	}

	var strSelected		= '';
	var boolSelected	= false;
	var objOption		= {};

	for (i = 0, len = arrSubCategories.length; i < len; i++) {

		if (issetSubCatId && subCatId == arrSubCategories[i][0]) {
			strSelected	= ' selected="selected"';
			boolSelected	= true;
		} else {
			strSelected	= '';
			boolSelected	= false;
		}

	//	arrHtml.push('<option value="'+ arrSubCategories[i][0] + '" '+ strSelected +'>'+ arrSubCategories[i][2] +'</option>');

		objOption		= document.createElement('option');
		objOption.value		= arrSubCategories[i][0];
		objOption.innerHTML	= arrSubCategories[i][2];
		objOption.selected	= boolSelected;

		arrHtml.push(objOption);

	}

	setTimeout(function() {
		for (i = 0, len = arrHtml.length; i < len; i++) {
			objSubSelect.appendChild(arrHtml[i]);
		}
	//	objSubSelect.innerHTML	= arrHtml.join('');
	}, 10);


}

</script>



<form name="theform" id="searchForm" method="get" action="<?php echo url_for('article/index') ?>">

<table>
<tr>
	<td>一级分类</td>
	<td>
		<select name="top_category" onchange="onChangeTopCategory(this)" id="id_top_category_select">
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

			onChangeTopCategory(document.getElementById('id_top_category_select'), <?php echo $topCateId ?>, <?php echo $subCateId ?>);

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
	<td><?php echo $arrAllCategories[$cateId]['name'] ?></td>
	<td><?php echo $arrAllCategories[$parentId]['name'] ?></td>
	<td><?php echo $val['created_at'] ?></td>
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

