
<div class="contentBox">

	<div class="boxHeader">
		<h3>登录</h3>
	</div>

	<div class="boxBody">

<?php if ($sf_user->getId()) : ?>

	您已登录

	<p>
		<a href="<?php echo url_for('@homepage') ?>">返回首页</a>
	</p>

<?php else : ?>



<form action="<?php echo url_for('admin/authorize') ?>" method="post">
<input type="hidden" name="last_url" value="<?php echo $sf_request->getParameter('last_url', $last_url) ?>" />

<table class="login_form" cellspacing="0">

<?php if ($sf_request->hasError('has_error') && true == $sf_request->getError('has_error')) : ?>


<tr>
<th>&nbsp;</th>
<td>
	<div class="form_error">
	<?php
	foreach (array(1010, 1020, 1030) as $key) {
		if ($sf_request->hasError($key)) {
			echo	sprintf('<p>%s</p>', $sf_request->getError($key, ''));
		}
	}
	?>
	</div>
</td>
</tr>
<?php endif ?>
<tr>
<th>用户名</th>
<td>
<?php
#	$mail	= $sf_request->getCookie('mail', '');
	$mail	= '';
?>
	<input type="text" name="username" value="<?php echo S::E($mail) ?>" class="input_text w200" />
</td>
</tr>
<tr>
<th>密码</th>
<td>
	<input type="password" name="password" value="" class="input_text w200" />
</td>
</tr>
<tr>
<th></th>
<td>
	<input type="submit" value="登录" class="btn" />
</td>
</tr>
</table>

</form>

<?php endif ?>


	</div>

</div>

<?php

#	Debug::pr($_REQUEST);
