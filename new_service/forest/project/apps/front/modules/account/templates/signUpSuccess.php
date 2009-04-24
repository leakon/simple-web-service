<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户注册 中国林业生物质能源网</title>


<style type="text/css">
* { margin: 0; padding: 0; }
body{font:12px "Lucida Grande", Verdana, Arial, "Bitstream Vera Sans", sans-serif; background:#f9f9f9;}
#login{width:100%; height:auto; overflow:hidden; text-align:center;}
#login .topbar{font-size:12px; height:33px; margin:0 0 40px 0; background:url(/images/bg33.png) repeat-x; text-align:left; padding:0 0 0 30px; line-height:33px;}
#login .topbar a{color:#fff; text-decoration:none; font-weight:normal; }
#login h2{width:330px; height:61px; background:url(/images/pic330.png) no-repeat; text-indent:-9999px; margin:0 auto 20px auto;}
#loginform{width:290px; height:170px; background:url(/images/loginBg330x210.png) no-repeat; padding:20px; margin:0 auto;}
#loginform p{margin-bottom:10px; line-height:25px; text-align:left;}
#loginform p label{font-size:14px; color:#5cac25;}
#loginform p label .input{width:270px; height:24px; border:1px solid #ccc; padding:6px 3px 0 3px; }
#loginform p.forgetmenot{display:block; float:left;}
#loginform p.submit{display:block; float:right; width:65px; height:24px;}
#loginform p.submit input{width:65px; height:24px; background:url(/images/loginBtn65x24.gif) no-repeat; border:none; font-size:14px; color:#fff;}

#loginform h3		{font-size:18px; font-weight:bold;}

#loginform span.form_error	{font-size:12px; color:red;}

</style>
</head>

<body>

<div id="login">

    <div class="topbar"><a href="/" title="返回首页">&lt;&lt; 返回首页</a></div>

    <h2></h2>

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



</div><!-- end login -->




</body>

</html>
