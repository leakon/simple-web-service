
<div class="itemtitle"><h3>留言板审核设置</h3></div>

<?php


?>

<style>
table.words td	{vertical-align:top; }
</style>

<div id="contentBox">

<div class="left">


<form method="post" action="<?php echo url_for('portal/saveMessage') ?>">
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
<input type="hidden" name="is_open" value="<?php echo	(isset($arrConf_Message) && '1' == $arrConf_Message) ? '1' : '0' ?>" />

	<table border="0" class="words" width="240">

	<tr>
		<td width="80">
			留言板名称
		</td>
		<td width="80">
			开关状态
		</td>
		<td width="80">
			操作
		</td>
	</tr>
	<tr>
		<td width="">
			顾客留言
		</td>
		<td width="">

			<?php

				echo	(isset($arrConf_Message) && '1' == $arrConf_Message) ? '开启' : '关闭';

			?>

		</td>
		<td>
			<input type="submit" value="<?php echo	(isset($arrConf_Message) && '1' == $arrConf_Message) ? '关闭' : '开启' ?>" class="btn" />
		</td>
	</tr>

	</table>

</form>




<?php if (isset($arrResult)) : ?>

<table border="1" style="margin-left:10px;">
<tr>
	<td>序号</td>
	<td>标题</td>
	<td>留言</td>
	<td>姓名</td>
	<td>性别</td>
	<td>邮件</td>
	<td>电话</td>
	<td>提交时间</td>
	<td>编辑</td>
</tr>
<?php foreach ($arrResult as $key => $val) : ?>
<tr>
<?php


?>
<!--	<td><?php echo ($pager->getPage() - 1) * $pageSize + $key + 1 ?></td>	-->
	<td><?php echo $val['id'] ?></td>
	<td><?php echo S::E($val['title']) ?></td>
	<td><?php echo S::E($val['message']) ?></td>
	<td><?php echo S::E($val['name']) ?></td>
	<td><?php echo $val['gender'] ? '女' : '男' ?></td>
	<td><?php echo S::E($val['mail']) ?></td>
	<td><?php echo S::E($val['phone']) ?></td>
	<td><?php echo $val['created_at'] ?></td>
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





</div>




</div>


<form name="deleteForm" id="id_delete_form" action="<?php echo url_for('portal/deleteMessage') ?>" method="post">
<input type="hidden" name="id" value="" />
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
</form>
