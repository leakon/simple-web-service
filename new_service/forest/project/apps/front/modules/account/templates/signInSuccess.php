
<form name="loginform" id="loginform" action="<?php echo url_for('account/authorize') ?>" method="post">
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />

	<h3>用户登录</h3>

<?php

$username	= '';
if ($sf_user->hasFlash('sign_in_username')) {
	$username	= $sf_user->getFlash('sign_in_username');
}
?>


	<p>
		<label>用户名<br />
		<input type="text" name="username" id="user_login" class="input" value="<?php echo $username ?>" size="20" tabindex="10" /></label>
	</p>
	<p>
		<label>密码<br />
		<?php if (($msg = $sf_request->getParameter('msg', '')) == 'pass_error') : ?>
		<span class="form_error">密码错误</span>
		<?php endif ?>
		<input type="password" name="password" id="user_pass" class="input" value="" size="20" tabindex="20" /></label>

	</p>

	<p class="forgetmenot"><label><input name="remember_me" type="checkbox" id="rememberme" value="forever" tabindex="90" /> 记住我</label></p>

	<p class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" value="登 录" tabindex="100" />

	</p>
</form>
