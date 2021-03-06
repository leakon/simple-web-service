<?php
// auto-generated by sfPropelCrud
// date: 2008/04/12 06:55:09
?>
<?php use_helper('Object') ?>

<?php echo form_tag('user/update') ?>

<?php echo object_input_hidden_tag($user, 'getId') ?>

<table>
<tbody>
<tr>
  <th>Role*:</th>
  <td><?php echo object_input_tag($user, 'getRole', array (
  'size' => 30,
)) ?></td>
</tr>
<tr>
  <th>Username*:</th>
  <td><?php echo object_input_tag($user, 'getUsername', array (
  'size' => 30,
)) ?></td>
</tr>
<tr>
  <th>Password*:</th>
  <td><?php echo object_input_tag($user, 'getPassword', array (
  'size' => 32,
  'value' => '',
)) ?> 输入密码明文，会自动加密保存</td>
</tr>
<tr>
  <th>Email*:</th>
  <td><?php echo object_input_tag($user, 'getEmail', array (
  'size' => 80,
)) ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo submit_tag('save') ?>
<?php if ($user->getId()): ?>
  &nbsp;<?php echo link_to('delete', 'user/delete?id='.$user->getId(), 'post=true&confirm=Are you sure?') ?>
  &nbsp;<?php echo link_to('cancel', 'user/show?id='.$user->getId()) ?>
<?php else: ?>
  &nbsp;<?php echo link_to('cancel', 'user/list') ?>
<?php endif; ?>
</form>
