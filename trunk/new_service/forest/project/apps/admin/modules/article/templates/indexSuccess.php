
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

function onChangeTopCategory(objSelect) {

	var intIndex	= objSelect.selectedIndex;

	if (intIndex == 0) {
		return;
	}
//	alert(objSelect.options[intIndex].value);

	var parentId	= objSelect.options[intIndex].value;

	var i, len;
	var categoryItem;
	var arrSubCategories	= [];
	for (i = 0, len = arrAllCategories.length; i < len; i++) {

		categoryItem		= arrAllCategories[i];

		if (parentId == categoryItem[1]) {
			arrSubCategories.push(categoryItem);
		}


	}

	var objSubSelect	= document.getElementById('id_sub_category_select');

	if (objSubSelect) {

		objSubSelect.innerHTML	= '';

		var arrHtml	= [];

		for (i = 0, len = arrSubCategories.length; i < len; i++) {

			arrHtml.push('<option value="'+ arrSubCategories[i][0] +'">'+ arrSubCategories[i][2] +'</option>');

		}


		objSubSelect.innerHTML	= arrHtml.join('');

	}

}

</script>



<form>

<table>
<tr>
	<td>一级分类</td>
	<td>
		<select name="top_category" onchange="onChangeTopCategory(this)">
			<option value="0">请选择</option>
			<?php foreach (Table_categories::getByParent(0, 99999) as $key => $objCategory) : ?>
			<option value="<?php echo $objCategory->id ?>"><?php echo S::E($objCategory->name) ?></option>
			<?php endforeach ?>
		</select>
	</td>
</tr>
<tr>
	<td>二级分类</td>
	<td>
		<select name="sub_category" id="id_sub_category_select">
			<option value=""></option>
		</select>
	</td>
</tr>
<tr>
	<td>查询词</td>
	<td>
		<input type="text" name="kw" value="" />
	</td>
</tr>

<tr>
	<td>&nbsp;</td>
	<td>
		<input type="submit" value="查询" />
	</td>
</tr>


</table>

</form>