
<?php


?>


<form method="post" action="<?php echo url_for('portal/savePass') ?>">

<p>
<input type="submit" value="保存" class="btn" />
</p>

<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />


<div id="contentBox">

<div class="left">


<?php
if ($sf_user->hasFlash('newPasswordOK')) {
	echo	$sf_user->getFlash('newPasswordOK') ? '<p>保存成功</p>' : '<p>保存失败</p>';
}
?>

	<table border="0">

	<tr>
		<td width="60">旧密码
		</td>
		<td>
			<input type="password" name="old_pass" value=""  />
		</td>
	</tr>
	<tr>
		<td>新密码
		</td>
		<td>
			<input type="password" name="password" value=""  />
		</td>
	</tr>
	<tr>
		<td>确认
		</td>
		<td>
			<input type="password" name="confirm" value=""  />
		</td>
	</tr>

	</table>

</div>




</div>

<p>
<input type="submit" value="保存" class="btn" />
</p>

</form>

