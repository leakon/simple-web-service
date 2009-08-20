<?php

$strActionName		= $sf_context->getActionName();




$categoryId		= (int) $sf_request->getParameter('id', 0);
$categoryId		= 0;

$arrConf			= array(
					'type'		=> CnroConstant::CATEGORY_TYPE_PROD_RANGE,
					'limit'		=> 10,
				);

$arrFieldCategories		= Table_categories::getByParent($categoryId, $arrConf);

#	Debug::pr($arrFieldCategories);

$GLOBALS['arrFields']		= array(
					0	=> ''
					);
foreach ($arrFieldCategories as $key => $objCate) {
	$GLOBALS['arrFields'][ $objCate->id ]	= $objCate->name;
}

#Debug::pr($arrFields);


function showFieldRadio($index = 0) {

#	var_dump($index);

#	var_dump($GLOBALS['arrFields']);

	$arrHTML		= array();

	foreach ($GLOBALS['arrFields'] as $cateId => $cateName) {

		if (0 == $cateId) {
			continue;
		}

		$forId		= 'id_filed_cate_' . $cateId . '_' . $index;

		$checked	= $index == $cateId ? ' checked="checked" ' : '';

		$arrHTML[]	= sprintf('<input type="radio" name="field_id" value="%s" id="%s" %s /><label for="%s">%s</label>' . "\n",

				$cateId, $forId, $checked, $forId, S::E($cateName)

				);

	}

	return	implode("\n", $arrHTML);

}



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
			选择应用领域
		</td>
		<td>

		<?php

		#	$parentField	= Table_categories::getOneByField($categoryItem->field_id);
			$parentField	= new Table_categories($categoryItem->field_id);
			$grandField	= new Table_categories($parentField->field_id);
		#	Debug::pr($parentField);

		?>

                <select name="range" onchange="ThreeChangeRange(this, 'id_three_type')">
                  <option value="0">应用领域</option>
                  <?php
                  	echo	options_for_select($arrRanges, $grandField->id);
                  ?>
                </select>
                <br />
                <select name="field_id" id="id_three_type" onchange="ThreeChangeType(this, 'id_three_style')">
                  <option value="0">设备类别</option>
                  <?php
                 # 	echo	options_for_select($arrTypes);
                  ?>
                </select>

                <script>
                	ThreeChangeRange(document.getElementById('id_three_type'), 'id_three_type', <?php echo $parentField->field_id ?>, <?php echo $parentField->id ?>);
                </script>

                <?php if (0) : ?>
                <br />
                <select name="style" id="id_three_style" onchange="ThreeChangeType(this)">
                  <option value="0">设备型号</option>
                  <?php
                 # 	echo	options_for_select($arrStyle);
                  ?>
                </select>

                <?php endif ?>

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
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" id="id_form_submit" value="保存"  class="btn" /></td>
	</tr>
	</table>


</form>

<hr />

<?php endif ?>



<?php if ($isTopCategory) : ?>

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
			选择应用领域
		</td>


		<td>


                <select name="range" onchange="ThreeChangeRange(this, 'id_three_type')">
                  <option value="0">应用领域</option>
                  <?php
                  	echo	options_for_select($arrRanges);
                  ?>
                </select>
                <br />
                <select name="field_id" id="id_three_type" onchange="ThreeChangeType(this, 'id_three_style')">
                  <option value="0">设备类别</option>
                  <?php
                 # 	echo	options_for_select($arrTypes);
                  ?>
                </select>

                <?php if (0) : ?>
                <br />
                <select name="style" id="id_three_style" onchange="ThreeChangeType(this)">
                  <option value="0">设备型号</option>
                  <?php
                 # 	echo	options_for_select($arrStyle);
                  ?>
                </select>

                <?php endif ?>

		</td>
	</tr>


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
			<td>应用领域</td>
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
			<td><?php echo isset($GLOBALS['arrFields'][$oneCategory->field_id]) ? $GLOBALS['arrFields'][$oneCategory->field_id] : '' ?></td>
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

	<?php if (0) : ?>
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
	<?php endif ?>

<?php endif ?>

<form name="deleteForm" id="id_delete_form" action="<?php echo url_for('category/delete') ?>" method="post">
<input type="hidden" name="id" value="" />
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
</form>
