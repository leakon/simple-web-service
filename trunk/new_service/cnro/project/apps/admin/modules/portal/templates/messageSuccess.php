
<div class="itemtitle"><h3>留言板审核设置</h3></div>

<?php


?>

<style>
table.words td	{vertical-align:top; }
</style>

<div id="contentBox">

<div class="left">


<form method="post" action="<?php echo url_for('portal/saveMessage') ?>">
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
<input type="hidden" name="is_open" value="<?php echo	(isset($arrConf_Message) && '1' == $arrConf_Message) ? '1' : '0' ?>" />

	<table border="0" class="words" width="240">

	<tr>
		<td width="80">
			留言板名称
		</td>
		<td width="80">
			开关状态
		</td>
		<td width="80">
			操作
		</td>
	</tr>
	<tr>
		<td width="">
			顾客留言
		</td>
		<td width="">

			<?php

				echo	(isset($arrConf_Message) && '1' == $arrConf_Message) ? '开启' : '关闭';

			?>

		</td>
		<td>
			<input type="submit" value="<?php echo	(isset($arrConf_Message) && '1' == $arrConf_Message) ? '关闭' : '开启' ?>" class="btn" />
		</td>
	</tr>

	</table>

</form>


</div>




</div>


