
<div class="itemtitle"><h3>管理友情链接</h3></div>

<?php


?>


<form method="post" action="<?php echo url_for('portal/saveFriend') ?>">

<p>
<input type="submit" value="保存" class="btn" />
</p>

<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />


<div id="contentBox">

<div class="left">


	<table border="0" >

	<tr>
		<td>
			<?php

			$friend_total	= isset($arrConf_HELP['friend_total']) ?
						$arrConf_HELP['friend_total'] : 10;

			?>
			<label for="id_friend_total">友情链接总数</labbel>
			<input type="text" name="friend_total" value="<?php echo $friend_total ?>" id="id_friend_total" />

		</td>
	</tr>

	<?php for ($i = 0; $i < $friend_total; $i++) : ?>
	<?php
		$strTitle	= isset($arrConf_HELP['friend_text'][$i]) ?
						$arrConf_HELP['friend_text'][$i] : '';

		$strUrl		= isset($arrConf_HELP['friend_link'][$i]) ?
						$arrConf_HELP['friend_link'][$i] : '';

	?>
	<tr>
		<td>
			编号：<?php echo $i + 1 ?>
			<br />
			标题：<input type="text" name="friend_text[<?php echo $i ?>]" value="<?php echo $strTitle ?>" size="40" />
			<br />
			链接：<input type="text" name="friend_link[<?php echo $i ?>]" value="<?php echo $strUrl ?>" size="40" />
		</td>
	</tr>
	<?php endfor ?>

	</table>

</div>




</div>

<p>
<input type="submit" value="保存" class="btn" />
</p>

</form>

