

<form name="loginform" id="loginform" action="<?php echo url_for('account/create') ?>" method="post">
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />


	<h3>用户注册</h3>

	<p>
		<label>用户名<br />
		<?php if (($msg = $sf_request->getParameter('msg', '')) == 'exist') : ?>
		<span class="form_error">用户名已存在，请选择其他名字</span>
		<?php endif ?>
		<?php if ($sf_request->hasError('username')): ?>
		<span class="form_error"><?php echo $sf_request->getError('username') ?></span>
		<?php endif; ?>
		<input type="text" name="username" id="username" class="input" value="<?php echo $sf_request->getParameter('username', '') ?>" size="20" tabindex="10" /></label>
	</p>
	<p>
		<label>密码<br />
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
	<p>
		<label>注册邮箱<br />
		<?php if ($sf_request->hasError('mail')): ?>
		<span class="form_error"><?php echo $sf_request->getError('mail') ?></span>
		<?php endif; ?>
		<input type="text" name="mail" id="mail" class="input" value="<?php echo $sf_request->getParameter('mail', '') ?>" size="20" tabindex="20" /></label>

	</p>

	<p class="forgetmenot"></p>

	<p class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" value="注 册" tabindex="100" />

	</p>
</form>
