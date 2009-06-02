
<div class="itemtitle"><h3>过滤关键字维护</h3></div>

<?php


?>

<style>
table.words td	{vertical-align:top; }
</style>

<div id="contentBox">

<div class="left">


	<table border="0" class="words">

	<tr>
		<td width="80">
			关键字
		</td>
		<td>

			<form method="post" action="<?php echo url_for('portal/saveFilter') ?>">
			<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />

				<input type="text" name="add_words[0]" value="" />&nbsp;<br />
				<input type="text" name="add_words[1]" value="" />&nbsp;<br />
				<input type="text" name="add_words[2]" value="" />&nbsp;<br />
				<input type="submit" value="添加" class="btn" /><br />
				说明：一次最多添加 3 个关键词
			</form>

		</td>
	</tr>
	<tr>
		<td>
			当前关键字
		</td>
		<td>
			<form method="post" action="<?php echo url_for('portal/saveFilter') ?>">
			<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />
			<select name="delete_words[]" style="width:200px; height:200px;" multiple="multiple">
			<?php
				foreach ($arrConf_Filter as $word) {

					echo	sprintf('<option value="%s">%s</option>', S::E($word), S::E($word));

				}

			?>
			</select><br />
				<input type="submit" value="删除" class="btn" /><br />
				说明：按Ctrl或Shift键可选中多个关键词
			</form>
		</td>
	</tr>

	</table>

</div>




</div>


