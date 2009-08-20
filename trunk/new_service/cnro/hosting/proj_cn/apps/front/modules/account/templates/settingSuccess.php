

<form name="loginform" id="loginform" action="<?php echo url_for('account/savePassword') ?>" method="post">
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />


	<h3>修改密码</h3>

		<?php if ('savePassOK' == $sf_request->getParameter('msg', '')): ?>
		<span class="form_error">密码保存成功</span>
		<?php endif; ?>


	<p>
		<label>旧密码<br />
		<?php if ($sf_request->hasError('old_pass')): ?>
		<span class="form_error"><?php echo $sf_request->getError('old_pass') ?></span>
		<?php endif; ?>
		<input type="password" name="old_pass" id="old_pass" class="input" value="<?php echo $sf_request->getParameter('old_pass', '') ?>" size="20" tabindex="10" /></label>
	</p>
	<p>
		<label>新密码<br />
		<?php if ($sf_request->hasError('password')): ?>
		<span class="form_error"><?php echo $sf_request->getError('password') ?></span>
		<?php endif; ?>
		<input type="password" name="password" id="password" class="input" value="" size="20" tabindex="20" /></label>

	</p>
	<p>
		<label>确认密码<br />
		<?php if ($sf_request->hasError('confirm')): ?>
		<span class="form_error"><?php echo $sf_request->getError('confirm') ?></span>
		<?php endif; ?>
		<input type="password" name="confirm" id="confirm" class="input" value="" size="20" tabindex="20" /></label>

	</p>

	<p class="forgetmenot"></p>

	<p class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" value="保 存" tabindex="100" />

	</p>
</form>

