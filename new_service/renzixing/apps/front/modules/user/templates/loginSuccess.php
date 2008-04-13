<?php use_helper('Validation') ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="stylesheet" href="/css/login.css" type="text/css" />
<link rel="stylesheet" href="/css/colors-fresh.css" type="text/css" />

	<script type="text/javascript">
		function focusit() {
			document.getElementById('user_login').focus();
		}
		window.onload = focusit;
	</script>
</head>
<body class="login">

<div id="login"><h1>登陆系统</h1>

<?php echo form_tag('user/login') ?>

<?php echo input_hidden_tag('refer', $sf_request->getReferer()) ?>
	<p>
		<label>Username<br />

		<?php echo input_tag('username', $sf_params->get('username'), array(
										'class' => 'input',
										'size' => '20',
										'tabindex' => '10',
										'id' => 'user_login',

										)) ?>
	<?php echo form_error('username') ?>

		</label>
	</p>
	<p>
		<label>Password<br />
		<?php echo input_password_tag('password', $sf_params->get('password'), array(
										'class' => 'input',
										'size' => '20',
										'tabindex' => '20',
										'id' => 'user_pass',

										)) ?>
	<?php echo form_error('password') ?>

		</label>
	</p>


	<p class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" value="登陆" tabindex="100" />
	</p>
</form>

</div>


</body>
</html>
