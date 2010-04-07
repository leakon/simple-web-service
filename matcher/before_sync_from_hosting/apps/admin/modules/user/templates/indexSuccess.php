
<script>
if (top.location != window.location) {
	top.location	= window.location;
}
</script>


<form name="login_form" id="login_form" action="<?php echo url_for('user/Authorize') ?>" method="post">
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />


<div class="login">
<ul>

	<?php if ($sf_request->getParameter('msg') && 'pass_error' == ($msg = $sf_request->getParameter('msg'))): ?>
	<li class="form_error" style="color:red; text-align:left; padding-left:54px;">用户名或密码错误</li>
	<?php endif; ?>

	<li><strong>用户名：</strong><input name="username" type="text" align="absmiddle" value="<?php echo $sf_params->get('username', '') ?>" /></li>

	<li><strong>密　码：</strong><input name="password" type="password" align="absmiddle"></li>
	<li class="li"><input border="0" name="searsh" src="/matcher/admin/images/btun01.gif" type="image" width="75" height="44" class="anniu"  /><input border="0" name="searsh" src="/matcher/admin/images/btun02.gif" type="image" width="75" height="44" class="anniu" onclick="$('login_form').reset(); return false;" /></li>
</ul>
</div>

</form>

<?php if (0) : ?>

		<h3 class="login">Matcher 后台管理系统</h3>



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
<?php endif ?>
