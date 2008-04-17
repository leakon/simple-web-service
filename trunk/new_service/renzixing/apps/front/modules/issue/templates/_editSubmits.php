
<?php echo object_input_hidden_tag($issue, 'getId') ?>

<hr />
<?php echo submit_tag('保存') ?>

<input type="button" onclick="DoSaveSubmit(<?php echo IssuePeer::STATUS_SUBMITTED ?>, '提交后，就不可以再修改了，确定吗？');" value="提交" />
<input type="button" onclick="DoSaveSubmit(<?php echo IssuePeer::STATUS_REJECTTED ?>, '驳回将清除您填写的所有内容，确定吗？');" value="驳回" />
<input type="button" onclick="DoSaveSubmit(<?php echo IssuePeer::STATUS_TERMINATED ?>, '终止后，就不可以再修改了，确定吗？');" value="终止" />
<input type="hidden" name="status" value="<?php echo IssuePeer::STATUS_DEFAULT ?>" />

<input type="hidden" name="type" value="<?php echo $issue->getType() ?>" />

<?php if ($issue->getId()): ?>
  &nbsp;<?php
  		if (0) {
  			echo link_to('delete', 'issue/delete?id='.$issue->getId(), 'post=true&confirm=Are you sure?');
  		}
  	?>
  &nbsp;<?php echo link_to('cancel', 'issue/show?id='.$issue->getId()) ?>
<?php else: ?>
  &nbsp;<?php echo link_to('cancel', 'issue/list') ?>
<?php endif; ?>



<script type="text/javascript">

var objTheForm = $('the_form');

function DoSaveSubmit(t, msg) {

	objTheForm.status.value = t;


	var c = typeof msg == 'undefined' || window.confirm(msg);

	if (c) {
		objTheForm.submit();
	}

}

</script>