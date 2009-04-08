
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



<form name="theform" id="searchForm" method="get" action="<?php echo url_for('article/save') ?>">

<input type="hidden" name="id" value="<?php echo $articleItem->id ?>" />
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />

<table border="1" width="100%">
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
	<td>标题</td>
	<td>
		<input type="text" name="title" value="<?php echo S::E($articleItem->title) ?>" />
	</td>
</tr>
<tr>
	<td>图片</td>
	<td>
		<input type="text" name="pic" value="<?php echo S::E($articleItem->pic) ?>" />

		<input type="file" name="upload_pic" />
	</td>
</tr>
<tr>
	<td>时间</td>
	<td>
		<input type="text" name="created_at" value="<?php echo S::E($articleItem->created_at) ?>" />
	</td>
</tr>
<tr>
	<td>关键字</td>
	<td>
		<input type="text" name="keyword" value="<?php echo S::E($articleItem->keyword) ?>" />
	</td>
</tr>

<tr>
	<td>信息内容</td>
	<td height="500">

		<?php

		$webDir			= sfConfig::get('sf_web_dir') . '_admin/';
		$editorInclude		= $webDir . "fckeditor/fckeditor.php";
		require_once($editorInclude);

		$oFCKeditor		= new FCKeditor('detail') ;
		$oFCKeditor->BasePath	= '/admin/fckeditor/' ;
		$oFCKeditor->Width	= '100%';
		$oFCKeditor->Height	= '100%';
		$oFCKeditor->Value	= $articleItem->detail;
		$oFCKeditor->Config	= array(
						'AutoDetectLanguage'	=> false,
						'DefaultLanguage'	=> 'zh-cn'
					);
		$oFCKeditor->Create() ;

		?>

		<?php if (0) : ?>
		<textarea name="detail"><?php echo S::E($articleItem->detail) ?>"</textarea>
		<?php endif ?>

	</td>
</tr>




<tr>
	<td>&nbsp;</td>
	<td>
		<input type="submit" value="保存" />
		<a href="<?php echo url_for('article/index') ?>?top_category=<?php echo $topCateId ?>&sub_category=<?php echo $subCateId ?>&kw=">取消</a>
	</td>
</tr>


</table>

</form>




<form name="deleteForm" id="id_delete_form" action="<?php echo url_for('article/delete') ?>" method="post">
<input type="hidden" name="id" value="" />
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
</form>



<?php

#Debug::pr($arrAllCategories);

