<?php use_helper('Validation') ?>
<?php use_helper('Object') ?>

<?php if (0) : ?>
<?php echo form_tag('user/manage') ?>

<?php echo input_hidden_tag('refer', HelperView::getRefer()) ?>

<ul>

<li>
	OldPassword:
	<?php echo input_password_tag('oldpass', $sf_params->get('oldpass')) ?>
	<?php echo form_error('oldpass') ?>
</li>

<li>
	Password:
	<?php echo input_password_tag('password', $sf_params->get('password')) ?>
	<?php echo form_error('password') ?>
</li>

<li>
	Confirm:
	<?php echo input_password_tag('confirm', $sf_params->get('confirm')) ?>
	<?php echo form_error('confirm') ?>
</li>


<li>
	EMail:
	<?php /* echo input_tag('email', $sf_params->get('email')) */ ?>
	<?php echo object_input_tag($objUser, 'getEmail', array(), $sf_params->get('email')) ?>
	<?php echo form_error('email') ?>
</li>


<li>
	<input type="submit" value="Update" />
</li>

</form>


<?php endif ?>

<div class="wrap" id="profile-page">
<h2>修改个人信息</h2>

<?php echo form_tag('user/manage') ?>


<h3>修改密码</h3>

<table class="form-table">
<tr>
	<th><label for="oldpass">当前密码</label></th>
	<td>

	<?php echo input_password_tag('oldpass', $sf_params->get('oldpass')) ?>
	<?php echo form_error('oldpass') ?>
		</td>
</tr>

<tr>
	<th><label for="password">新密码</label></th>
	<td>
		<?php echo input_password_tag('password', $sf_params->get('password')) ?>
	<?php echo form_error('password') ?>
	</td>
</tr>

<tr>
	<th><label for="confirm">密码确认</label></th>
	<td>
		<?php echo input_password_tag('confirm', $sf_params->get('confirm')) ?>
	<?php echo form_error('confirm') ?>
	</td>
</tr>
</table>

<h3>联系信息</h3>

<table class="form-table">
<tr>
	<th><label for="email">E-mail</label></th>

	<td>
		<?php echo object_input_tag($objUser, 'getEmail', array(), $sf_params->get('email')) ?>
	<?php echo form_error('email') ?>
		</td>
</tr>

</table>


<p class="submit">
	<input type="submit" value="保存" />
 </p>
</form>
</div>