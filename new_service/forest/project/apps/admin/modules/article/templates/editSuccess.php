
<form name="theform" id="searchForm" method="post" action="<?php echo url_for('article/save') ?>" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?php echo $articleItem->id ?>" />
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />

<table border="1" width="100%">
<tr>
	<td class="col_name">一级分类</td>
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
	<td class="col_name">二级分类</td>
	<td>
		<select name="sub_category" id="id_sub_category_select">
		</select>

		<script type="text/javascript">

			ChangeCategory($('id_top_category_select'), $('id_sub_category_select'), <?php echo $topCateId ?>, <?php echo $subCateId ?>);

		</script>

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
	<td class="col_name">第期数</td>
	<td>
		<input type="text" class="input_text" name="vol_num" value="<?php echo S::E($articleItem->vol_num) ?>" />
	</td>
</tr>
<tr>
	<td class="col_name">总第期数</td>
	<td>
		<input type="text" class="input_text" name="vol_num_all" value="<?php echo S::E($articleItem->vol_num_all) ?>" />
	</td>
</tr>
<tr>
	<td class="col_name">时间</td>
	<td>
		<input type="text" class="input_text" name="published_at" value="<?php echo S::E($articleItem->published_at) ?>" />
	</td>
</tr>
<tr>
	<td class="col_name">关键字</td>
	<td>
		<input type="text" class="input_text" name="keyword" value="<?php echo S::E($articleItem->keyword) ?>" />
	</td>
</tr>

<tr>
	<td class="col_name">信息内容</td>
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
	<td class="col_name">&nbsp;</td>
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

