

<div class="itemtitle"><h3>审核文章</h3></div>

<form id="id_item_form" action="<?php echo url_for('article/publish') ?>" name="item_publish_form" method="post">

<input type="hidden" name="publish" value="-1" />
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />

<?php if (isset($arrResult)) : ?>

<table>
<tr>
	<td colspan="10">
		<input type="button" value="审核通过" class="btn" onclick="ItemPublish(1);" />
		<input type="button" value="取消审核" class="btn" onclick="ItemPublish(0);" />
	</td>
</tr>
<tr>
	<td>序号</td>
	<td><a href="javascript:;" id="id_check_all">全选</a>/<a href="javascript:;" id="id_clear_all">取消</a></td>
	<td>信息标题</td>
	<td>审核状态</td>
	<td>分类</td>
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
	<td><input type="checkbox" name="checked_item[<?php echo $val['id'] ?>]" value="<?php echo $val['id'] ?>" class="item_checkbox" /></td>
	<td><a href="<?php echo url_for('/article/show?id=' . $val['id']) ?>" target="_blank"><?php echo S::E($val['title']) ?></a></td>
	<td><?php echo $val['published'] ? '审核通过' : '未审核' ?></td>
	<td><?php echo $arrAllCategories[$cateId]['name'] ?></td>
	<td><?php echo $val['published_at'] ?></td>
	<td><?php echo $val['view_cnt'] ?></td>
	<td><a href="<?php echo url_for('article/edit?id=' . $val['id']) ?>">编辑</a></td>
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

</form>




<form name="deleteForm" id="id_delete_form" action="<?php echo url_for('article/delete') ?>" method="post">
<input type="hidden" name="id" value="" />
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
</form>


<script type="text/javascript">

var objCheck		= new ItemFormCheck('id_item_form', {
					'btn_all':		'id_check_all',
					'btn_clear':		'id_clear_all'
				});


</script>

<?php

#Debug::pr($arrAllCategories);

