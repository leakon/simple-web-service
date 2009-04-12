
<?php


#$res	= $sf_user->isAuthenticated();
#$res	= $sf_user->hasCredential('admin');

#var_dump($res);
#var_dump($sf_user->authStatus);

?>


<script>
if (top.location != window.location) {
	top.location	= window.location;
}
</script>


<form method="post" action="<?php echo url_for('frame/doLogin') ?>">


<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />

<div class="loginForm">


<?php
if ($sf_user->hasFlash('loginSuccess')) {
	echo	$sf_user->getFlash('loginSuccess') ? '<p>登录成功</p>' : '<p>登录失败</p>';
}
?>


	<table border="1" class="leftCol">

	<tr>
		<td>用户名
		</td>
		<td>
			<input type="text" name="username" value="<?php echo $sf_request->getParameter('username', '') ?>" />
		</td>
	</tr>

	<tr>
		<td>密码
		</td>
		<td>
			<input type="password" name="password" value="" />
		</td>
	</tr>


	<tr>
		<td>&nbsp;
		</td>
		<td>
			<input type="submit" value="登录" />
		</td>
	</tr>

</table>

</div>

</form>
