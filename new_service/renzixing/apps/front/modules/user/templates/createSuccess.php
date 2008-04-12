<?php use_helper('Validation') ?>

<?php if ($sf_user->getId()) : ?>

	您已经登录了

<?php else : ?>


<?php echo form_tag('user/create') ?>

<?php echo input_hidden_tag('refer', $sf_request->getReferer()) ?>

<ul>

<li>
	UserName:
	<?php echo input_tag('username', $sf_params->get('username')) ?>
	<?php echo form_error('username') ?>
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
	<input type="submit" value="SignUp" />
</li>

</form>

<?php endif ?>