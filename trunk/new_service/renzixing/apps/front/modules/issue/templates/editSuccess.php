<?php
// auto-generated by sfPropelCrud
// date: 2008/04/12 09:31:45
?>
<?php use_helper('Object') ?>

<?php echo form_tag('issue/update', 'id=the_form') ?>

<?php echo object_input_hidden_tag($issue, 'getId') ?>

<table>
<tbody>
<tr>
  <th>Type*:</th>
  <td><?php echo object_input_tag($issue, 'getType', array (
  'size' => 7,
)) ?></td>
</tr>
<tr>
  <th>优先级*:</th>
  <td>

  	<?php  object_input_tag($issue, 'getPriority', array (
  'size' => 7,
)) ?>

<?php

#		options_for_select(IssuePeer::listAllPriority())
/*
echo
	object_select_tag($issue, 'getPriority',

		array(
			'related_class'	=> 'Issue',
		#	'peer_method'	=> 'listAllPriority',
			'text_method'	=> 'listAllPriority',

		)



	);
*/

	echo	select_tag('priority', options_for_select(IssuePeer::listAllPriority()), $issue->getPriority());

?>



</td>
</tr>
<tr>
  <th>Title*:</th>
  <td><?php echo object_input_tag($issue, 'getTitle', array (
  'size' => 80,
)) ?></td>
</tr>
<tr>
  <th>Description*:</th>
  <td><?php echo object_textarea_tag($issue, 'getDescription', array (
  'size' => '30x3',
)) ?></td>
</tr>
<tr>
  <th>Solution*:</th>
  <td><?php echo object_textarea_tag($issue, 'getSolution', array (
  'size' => '30x3',
)) ?></td>
</tr>
<tr>
  <th>Reference*:</th>
  <td><?php echo object_textarea_tag($issue, 'getReference', array (
  'size' => '30x3',
)) ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo submit_tag('save') ?>



<script type="text/javascript">

var objTheForm = $('the_form');

function DoSaveSubmit(t, msg) {

	objTheForm.save_type.value = t;


	var c = typeof msg == 'undefined' || window.confirm(msg);

	if (c) {
		objTheForm.submit();
	}

}

</script>

<input type="button" onclick="DoSaveSubmit('submitted', '提交上级后，就不可以再修改了，确定吗？');" value="提交上级" />

<input type="button" onclick="DoSaveSubmit('terminated', '终止流程后，就不可以再修改了，确定吗？');" value="终止流程" />

<input type="button" onclick="DoSaveSubmit('rejectted');" value="驳回" />

<input type="hidden" name="save_type" value="default" />

<?php if ($issue->getId()): ?>
  &nbsp;<?php echo link_to('delete', 'issue/delete?id='.$issue->getId(), 'post=true&confirm=Are you sure?') ?>
  &nbsp;<?php echo link_to('cancel', 'issue/show?id='.$issue->getId()) ?>
<?php else: ?>
  &nbsp;<?php echo link_to('cancel', 'issue/list') ?>
<?php endif; ?>
</form>
