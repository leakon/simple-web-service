
<div class="itemtitle"><h3>编辑文章</h3></div>


<?php
if ($sf_user->hasFlash('article_saved_ok')) {
	echo	$sf_user->getFlash('article_saved_ok') ? '<p>保存成功</p>' : '<p>保存失败</p>';
}
?>

<form name="theform" id="searchForm" method="post" action="<?php echo url_for('article/save') ?>" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?php echo $articleItem->id ?>" />
<input type="hidden" name="type" value="<?php echo CnroConstant::CATEGORY_TYPE_NEWS ?>" />
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
<input type="hidden" name="category_id" value="<?php echo $articleItem->category_id ?>" />



<table border="0" width="100%" class="tb tb2">
<tr>
	<td class="col_name">选择分类</td>
	<td class="col_category">


<?php

#Debug::pr($arrCategoryPath);

$lastCatId	= 0;
$lastCatName	= '一级分类';
$arrPath	= array();
if (count($arrCategoryPath)) {

	foreach ($arrCategoryPath as $catId => $cateInfo) {

		$arrPath[]	= sprintf('<span id="id_cate_%d">%s</span>',
						$cateInfo['id'],
						S::E($cateInfo['name'])
					);
		$lastCatId	= $cateInfo['id'];
		$lastCatName	= S::E($cateInfo['name']);

	}
}

echo	'分类路径：' . implode(' &gt; ', $arrPath);
echo	sprintf('<style>#id_cate_%d	{font-weight:bold; color:red;}</style>', $lastCatId);

?>



		<!-- 树形分类预览 Begin -->
		<div id="article_category" class="category_box"></div>
		<script type="text/javascript">
		var objConf		= {
						'box_id':		'article_category',
						'category_type':	'<?php echo CnroConstant::CATEGORY_TYPE_NEWS ?>',
						'form_id':		'searchForm',
						'form_field':		'category_id'
					}
		var objSelectTree	= new SimpleSelectTree(objConf);
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
	<td class="col_name">图片</td>
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
	<td class="col_name">图片说明</td>
	<td>
		<input type="text" class="input_text" name="pic_desc" value="<?php echo S::E($articleItem->pic_desc) ?>" />
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
<tr>
	<td class="col_name">首页显示</td>
	<td>
		<input type="checkbox" name="index_show" value="1" <?php echo Fm::checked($articleItem->index_show) ?> id="id_index_show" />
		<label for="id_index_show">在首页显示</label>
	</td>
</tr>
<tr>
	<td class="col_name">关键字</td>
	<td>
		<input type="text" class="input_text" name="keyword" value="<?php echo S::E($articleItem->keyword) ?>" />
	</td>
</tr>

<tr>
	<td class="col_name">文章内容</td>
	<td height="500">

		<?php

		$arrInfoFck		= CnroConstant::getFckEdtor();
		require_once($arrInfoFck['include_dir']);

		$oFCKeditor		= new FCKeditor('detail') ;
		$oFCKeditor->BasePath	= $arrInfoFck['base_path'];
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
	<td class="col_name">&nbsp;</td>
	<td>
		<input type="submit" value="保存" class="btn" />
		<a href="<?php echo url_for('article/index') ?>?category_id=<?php echo $articleItem->category_id ?>">取消</a>
	<!--	<a href="/article/show/id/<?php echo (int) $articleItem->id ?>" target="_blank">预览</a>	-->
	</td>
</tr>


</table>

</form>




<form name="deleteForm" id="id_delete_form" action="<?php echo url_for('article/delete') ?>" method="post">
<input type="hidden" name="id" value="" />
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
</form>



<?php


