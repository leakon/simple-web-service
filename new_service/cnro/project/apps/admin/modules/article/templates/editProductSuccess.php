
<div class="itemtitle"><h3>编辑产品</h3></div>


<?php
if ($sf_user->hasFlash('article_saved_ok')) {
	echo	$sf_user->getFlash('article_saved_ok') ? '<p>保存成功</p>' : '<p>保存失败</p>';
}
?>

<form name="theform" id="id_edit_form" method="post" action="<?php echo url_for('article/save') ?>" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?php echo $articleItem->id ?>" />
<input type="hidden" name="type" value="<?php echo $articleType ?>" />
<input type="hidden" name="range_id" value="<?php echo $articleItem->range_id ?>" />
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />



<table border="0" width="100%" class="tb tb2">

<tr>
	<td class="col_name">选择应用领域</td>
	<td class="col_category">


<?php

#Debug::pr($arrRangePath);
#Debug::pr($articleItem);

$lastCatId	= 0;
$lastCatName	= '一级领域';
$arrPath	= array();
if (count($arrRangePath)) {

	foreach ($arrRangePath as $catId => $cateInfo) {

		$arrPath[]	= sprintf('<span id="id_cate_%d">%s</span>',
						$cateInfo['id'],
						S::E($cateInfo['name'])
					);
		$lastCatId	= $cateInfo['id'];
		$lastCatName	= S::E($cateInfo['name']);

	}
}

echo	'领域路径：' . implode(' &gt; ', $arrPath);
echo	sprintf('<style>#id_cate_%d	{font-weight:bold; color:red;}</style>', $lastCatId);

?>



		<!-- 树形分类预览 Begin -->
		<div id="article_category_2" class="category_box"></div>
		<script type="text/javascript">
		var objConf		= {
						'box_id':		'article_category_2',
						'category_type':	'<?php echo CnroConstant::CATEGORY_TYPE_PROD_RANGE ?>',
						'form_id':		'id_edit_form',
						'form_field':		'range_id'
					}
		var objSelectTree_2	= new SimpleSelectTree(objConf);
		</script>
		<!-- 树形分类预览 End -->

	</td>
</tr>



<tr>
	<td class="col_name">标题</td>
	<td>
		<input type="text" class="input_text" name="title" value="<?php echo S::E($articleItem->title) ?>" />
	</td>
</tr>



<tr>
	<td class="col_name">设备领域</td>
	<td>

<?php
$option			= array('limit' => 1000);
$option['to_array']	= true;

$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_RANGE;
$res			= Table_categories::getByParent(0, $option);
$arrRanges		= Array_Util::ColToPlain($res, 'id', 'name');

$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_TYPE;
$res			= Table_categories::getByParent(0, $option);
$arrTypes		= Array_Util::ColToPlain($res, 'id', 'name');

$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_STYLE;
$res			= Table_categories::getByParent(0, $option);
$arrStyle		= Array_Util::ColToPlain($res, 'id', 'name');


$arrFieldCatetory		= Table_categories::getAllField();


$arrFieldJSON	= array();
foreach ($arrFieldCatetory as $fieldInfo) {

	$tmp		= array();

	$tmp['id']		= $fieldInfo['id'];
	$tmp['field_id']	= $fieldInfo['field_id'];
	$tmp['name']		= $fieldInfo['name'];

	$arrFieldJSON[]		= $tmp;

}

#Debug::pr($arrFieldJSON);

$strFieldJSON	= json_encode($arrFieldJSON);

?>


<script type="text/javascript">

var arrFieldObj	= <?php echo $strFieldJSON ?>;


</script>

		<?php

		#	$parentField	= Table_categories::getOneByField($categoryItem->field_id);
			$parentField	= new Table_categories($articleItem->style_id);
			$grandField	= new Table_categories($parentField->field_id);
			$topField	= new Table_categories($grandField->field_id);
		#	Debug::pr($articleItem);

		?>



                <select name="range_xxx" onchange="ThreeChangeRange(this, 'id_three_type')">
                  <option value="0">应用领域</option>
                  <?php
                  	echo	options_for_select($arrRanges, $topField->id);
                  ?>
                </select>
	</td>
</tr>
<tr>
	<td class="col_name">设备类别</td>
	<td>
		<?php if (0) : ?>
                <select name="type_id">
                  <?php
                  	echo	options_for_select($arrTypes, $articleItem->type_id);
                  ?>
                </select>
                <?php endif ?>

                <select name="type_id" id="id_three_type" onchange="ThreeChangeType(this, 'id_three_style')">
                  <option value="0">设备类别</option>
                  <?php
                 # 	echo	options_for_select($arrTypes);
                  ?>
                </select>

	</td>
</tr>
<tr>
	<td class="col_name">设备型号</td>
	<td>
		<?php if (0) : ?>
                <select name="style_id">
                  <?php
                  	echo	options_for_select($arrStyle, $articleItem->style_id);
                  ?>
                </select>

                <?php endif ?>

                <select name="style_id" id="id_three_style">
                  <option value="0">设备型号</option>
                  <?php
                #  	echo	options_for_select($arrStyle);
                  ?>
                </select>
                <script>
                	ThreeChangeRange(document.getElementById('id_three_type'), 'id_three_type', <?php echo (int) $grandField->field_id ?>, <?php echo (int)  $grandField->id ?>);
                	ThreeChangeRange(document.getElementById('id_three_style'), 'id_three_style', <?php echo (int) $parentField->field_id ?>, <?php echo (int) $parentField->id ?>);
                </script>

	</td>
</tr>


<tr>
	<td class="col_name">小图片</td>
	<td>
		<?php if ($articleItem->pic) : ?>
		<p class="article_image">
			<img src="<?php echo $articleItem->pic ?>" />
		</p>
		<?php endif ?>

		<input type="text" class="input_text" name="pic" value="<?php echo S::E($articleItem->pic) ?>" />

		<p>
		<input type="file" name="upload_pic" />
		</p>

	</td>
</tr>
<tr>
	<td class="col_name">小图片说明</td>
	<td>
		<input type="text" class="input_text" name="pic_desc" value="<?php echo S::E($articleItem->pic_desc) ?>" />
	</td>
</tr>

<tr>
	<td class="col_name">大图片</td>
	<td>
		<?php if ($articleItem->large_pic) : ?>
		<p class="article_image">
			<img src="<?php echo $articleItem->large_pic ?>" />
		</p>
		<?php endif ?>

		<input type="text" class="input_text" name="large_pic" value="<?php echo S::E($articleItem->large_pic) ?>" />

		<p>
		<input type="file" name="upload_large_pic" />
		</p>

	</td>
</tr>
<tr>
	<td class="col_name">大图片说明</td>
	<td>
		<input type="text" class="input_text" name="large_pic_desc" value="<?php echo S::E($articleItem->large_pic_desc) ?>" />
	</td>
</tr>

<tr>
	<td class="col_name">说明文档</td>
	<td>
		<?php if ($articleItem->pdf) : ?>
		<p>
			<a href="<?php echo $articleItem->pdf ?>" target="_blank"><?php echo $articleItem->pdf ?></a>
		</p>
		<?php endif ?>

		<input type="text" class="input_text" name="pdf" value="<?php echo S::E($articleItem->pdf) ?>" />

		<p>
		<input type="file" name="upload_pdf" />
		</p>

	</td>
</tr>







<tr>
	<td class="col_name">时间</td>
	<td>
		<?php

		$date		= substr((string) $articleItem->published_at, 0, 10);
		if ('' == $date) {
			$date	= date('Y-m-d');
		}

		echo input_date_tag('published_at', $date, array('rich' => true, 'readonly' => 'readonly', 'lang' => 'zh_CN'))

		?>

	</td>
</tr>
<tr>
	<td class="col_name">公开属性</td>
	<td>
		<label>
		<?php
			echo radiobutton_tag('is_private', 0, 0 == $articleItem->is_private);
		?>
		公开</label>

		<label>
		<?php
			echo radiobutton_tag('is_private', 1, 1 == $articleItem->is_private);
		?>
		私有</label>

	</td>
</tr>
<?php if (0) : ?>
<tr>
	<td class="col_name">首页显示</td>
	<td>
		<input type="checkbox" name="index_show" value="1" <?php echo Fm::checked($articleItem->index_show) ?> id="id_index_show" />
		<label for="id_index_show">在首页显示</label>
	</td>
</tr>
<?php endif ?>
<tr>
	<td class="col_name">关键字</td>
	<td>
		<input type="text" class="input_text" name="keyword" value="<?php echo S::E($articleItem->keyword) ?>" />
	</td>
</tr>

<tr>
	<td class="col_name">产品描述</td>
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
	<td class="col_name">产品参数</td>
	<td height="500">

		<?php

		$webDir			= sfConfig::get('sf_web_dir') . '_admin/';
		$editorInclude		= $webDir . "fckeditor/fckeditor.php";
		require_once($editorInclude);

		$oFCKeditor		= new FCKeditor('params') ;
		$oFCKeditor->BasePath	= '/admin/fckeditor/' ;
		$oFCKeditor->Width	= '100%';
		$oFCKeditor->Height	= '100%';
		$oFCKeditor->Value	= $articleItem->params;
		$oFCKeditor->Config	= array(
						'AutoDetectLanguage'	=> false,
						'DefaultLanguage'	=> 'zh-cn'
					);
		$oFCKeditor->Create() ;

		?>

	</td>
</tr>



<tr>
	<td class="col_name">&nbsp;</td>
	<td>
		<input type="submit" value="保存" class="btn" />
		<a href="<?php echo url_for('article/index') ?>?category_id=<?php echo $articleItem->category_id ?>">取消</a>
		<!-- <a href="/article/show/id/<?php echo (int) $articleItem->id ?>" target="_blank">预览</a> -->
	</td>
</tr>


</table>

</form>




<form name="deleteForm" id="id_delete_form" action="<?php echo url_for('article/delete') ?>" method="post">
<input type="hidden" name="id" value="" />
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
</form>



<?php


#	Debug::pr($articleItem);
