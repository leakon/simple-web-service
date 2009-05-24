
		<h3 class="login">Matcher 后台管理系统</h3>

		<form name="login_form" id="login_form" action="<?php echo url_for('user/Authorize') ?>" method="post">
		<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />


	  	<table border="0" cellspacing="1" class="login">
	  	<tbody>
	  		<tr>
	  			<td class="menu">

	  				用户名

	  			</td>
	  			<td class="content">
	  				<input type="text" name="username" value="" />
	  			</td>
	  			<td>
	  				&nbsp;
	  			</td>
	  		</tr>
	  		<tr>
	  			<td class="menu">

	  				密码

	  			</td>
	  			<td class="content">

					<?php if ($sf_request->getParameter('msg') && 'pass_error' == ($msg = $sf_request->getParameter('msg'))): ?>
					<span class="form_error">密码错误</span>
					<?php endif; ?>

	  				<input type="password" name="password" value="" />
	  			</td>
	  			<td>
	  				<input type="submit" value="登录" />
	  			</td>
	  		</tr>
		</tbody>
	  	</table>
	  	</form>