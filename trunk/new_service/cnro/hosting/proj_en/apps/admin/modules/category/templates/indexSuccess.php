<?php

$strActionName		= $sf_context->getActionName();

?>

<div class="itemtitle"><h3>管理<?php echo $strType ?></h3></div>

<?php

#Debug::pr($arrCategoryPath);

$lastCatId	= 0;
$lastCatName	= '一级' . $strType;
$arrPath	= array();
$arrPath[]	= sprintf('<a href="%s" id="id_cate_0">一级%s</a>', url_for('category/' . $strActionName), $strType);
if (count($arrCategoryPath)) {

	foreach ($arrCategoryPath as $catId => $cateInfo) {

		$arrPath[]	= sprintf('<a href="%s" id="id_cate_%d">%s</a>',
						url_for('category/'. $strActionName .'?id=' . $cateInfo['id']),
						$cateInfo['id'],
						S::E($cateInfo['name'])
					);
		$lastCatId	= $cateInfo['id'];
		$lastCatName	= S::E($cateInfo['name']);

	}
}

echo	$strType . '路径：' . implode(' &gt; ', $arrPath);
echo	sprintf('<style>#id_cate_%d	{font-weight:bold; color:red;}</style>', $lastCatId);

?>


<?php if (!$isTopCategory) : ?>

<h2>修改<?php echo $strType ?>属性</h2>
<form name="cate_edit" id="id_category_edit" action="<?php echo url_for('category/save') ?>" method="post">
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
<input type="hidden" name="type" value="<?php echo $categoryItem->type ?>" />
<input type="hidden" name="id" value="<?php echo $categoryItem->id ?>" />

	<table>
	<tr>
		<td>
			<?php if ($sf_request->hasError('name')): ?>
			<span class="form_error"><?php echo $sf_request->getError('name') ?></span>
			<?php endif; ?>
			<?php echo $strType ?>名称
		</td>
		<td>
			<input type="text" name="name" value="<?php echo S::E($categoryItem->name) ?>" />
		</td>
	</tr>
	<tr>
		<td>
			banner图片
		</td>
		<td>
			<input type="text" name="banner_pic" value="<?php echo $categoryItem->banner_pic ?>" />
		</td>
	</tr>
	<tr>
		<td>
			示例图片
		</td>
		<td>
			<input type="text" name="pic" value="<?php echo $categoryItem->pic ?>" />
		</td>
	</tr>
	<tr>
		<td>
			排列顺序
		</td>
		<td>
			<input type="text" name="order_num" value="<?php echo $categoryItem->order_num ?>" />
		</td>
	</tr>
	<?php if (1 || CnroConstant::CATEGORY_TYPE_PROD_RANGE == $intCategoryType) : ?>

	<tr>
		<td>
			分类描述
		</td>
		<td>
		<?php

		$webDir			= sfConfig::get('sf_web_dir') . '_admin/';
		$editorInclude		= $webDir . "fckeditor/fckeditor.php";
		require_once($editorInclude);

		$oFCKeditor		= new FCKeditor('description') ;
		$oFCKeditor->BasePath	= '/admin/fckeditor/' ;
		$oFCKeditor->Width	= '700px';
		$oFCKeditor->Height	= '300px';
		$oFCKeditor->Value	= $categoryItem->description;
		$oFCKeditor->Config	= array(
						'AutoDetectLanguage'	=> false,
						'DefaultLanguage'	=> 'zh-cn'
					);
		$oFCKeditor->Create() ;

		?>
		</td>
	</tr>
	<?php endif ?>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" id="id_form_submit" value="保存"  class="btn" /></td>
	</tr>
	</table>


</form>

<hr />

<?php endif ?>


<?php

$listUrl	= url_for('category/' . $strActionName);

?>

<h2>在 <?php echo $lastCatName ?> 下添加新<?php echo $strType ?></h2>


<form name="cate_new" id="id_category_new" action="<?php echo url_for('category/save') ?>" method="post">
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
<input type="hidden" name="type" value="<?php echo $intCategoryType ?>" />
<input type="hidden" name="parent_id" value="<?php echo $categoryItem->id ?>" />


	<table>
	<tr>
		<td>

			<?php if ($sf_request->hasError('name')): ?>
			<span class="form_error"><?php echo $sf_request->getError('name') ?></span>
			<?php endif; ?>
			<?php echo $strType ?>名称
		</td>
		<td>
			<input type="text" name="name" value="" />
		</td>
	</tr>
	<tr>
		<td>
			banner图片
		</td>
		<td>
			<input type="text" name="banner_pic" value="" />
		</td>
	</tr>
	<tr>
		<td>
			示例图片
		</td>
		<td>
			<input type="text" name="pic" value="" />
		</td>
	</tr>

	<?php if (1 || CnroConstant::CATEGORY_TYPE_PROD_RANGE == $intCategoryType) : ?>

	<tr>
		<td>
			分类描述
		</td>
		<td>
		<?php

		$webDir			= sfConfig::get('sf_web_dir') . '_admin/';
		$editorInclude		= $webDir . "fckeditor/fckeditor.php";
		require_once($editorInclude);

		$oFCKeditor		= new FCKeditor('description_new') ;
		$oFCKeditor->BasePath	= '/admin/fckeditor/' ;
		$oFCKeditor->Width	= '700px';
		$oFCKeditor->Height	= '300px';
		$oFCKeditor->Value	= '';
		$oFCKeditor->Config	= array(
						'AutoDetectLanguage'	=> false,
						'DefaultLanguage'	=> 'zh-cn'
					);
		$oFCKeditor->Create() ;

		?>
		</td>
	</tr>
	<?php endif ?>

	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" id="id_form_submit" value="添加"  class="btn" /></td>
	</tr>
	</table>


</form>

<hr />


<h2>在 <?php echo $lastCatName ?> 下的<?php echo $strType ?>列表</h2>


<form name="theForm" id="id_category_edit" action="<?php echo url_for('category/saveOrder') ?>" method="post">
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
<table border="0" class="">
		<tr>
			<td><?php echo $strType ?>名称</td>
			<td>子<?php echo $strType ?>数量</td>
			<td>排序</td>
			<td>操作</td>
		</tr>

	<?php foreach ($arrCategories as $key => $oneCategory) : ?>

		<tr>
			<!--
			<td><?php echo $key + 1 ?></td>
			-->

			<td>
				<a href="<?php echo $listUrl . '?id=' . $oneCategory->id ?>"><?php echo $oneCategory->name ?></a>
			</td>
			<td><?php echo $arrCategoryChildQty[$key] ?></td>
			<td><input type="text" name="order_num[<?php echo $oneCategory->id ?>]" value="<?php echo $oneCategory->order_num ?>" /></td>

			<!--
			<td><a href="<?php echo $listUrl . '?id=' . $oneCategory->id ?>">修改</a></td>
			-->

			<td><a href="javascript:;" onclick="FormDel('id_delete_form', <?php echo $oneCategory->id ?>)">删除</a></td>
		</tr>

	<?php endforeach ?>

</table>
<p>
	<input type="submit" value="保存排列顺序" class="btn" />
</p>
</form>


<h2>预览<?php echo $strType ?>列表</h2>

<!-- 树形分类预览 Begin -->
<div id="article_category" class="category_box"></div>
<script type="text/javascript">
var objConf		= {
				'box_id':		'article_category',
				'category_type':	'<?php echo $intCategoryType ?>'
			}
var objSelectTree	= new SimpleSelectTree(objConf);
</script>
<!-- 树形分类预览 End -->


<form name="deleteForm" id="id_delete_form" action="<?php echo url_for('category/delete') ?>" method="post">
<input type="hidden" name="id" value="" />
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
</form>
