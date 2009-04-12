
<?php

	Custom_Homepage::setDataConf($arrDataConf);

#	Debug::pr($arrDataConf);


	function showTD($name) {

		$arr	= Custom_Homepage::genCategorySelect($name);

		$str	= '';

		$str	.= '<h3>' . $name . '</h3>';

		$str	.= '<p>' . $arr['top'] . '</p>';
		$str	.= '<p>' . $arr['sub'] . '</p>';

		if (isset($arr['pic'])) {
			$str	.= '<p>' . $arr['pic'] . '</p>';
		}

		return	$str;

	}

?>

<form method="post" action="<?php echo url_for('portal/save') ?>">
<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />


<div id="contentBox">

	<table border="1" class="left">
	<tr>
		<td>
			<?php
				echo	showTD('block_1');
			?>
		</td>
		<td>
			<?php
				echo	showTD('block_2');
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php
				echo	showTD('block_3');
			?>
		</td>
		<td>
			<?php
				echo	showTD('block_4');
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php
				echo	showTD('block_5');
			?>
		</td>
		<td>
			<?php
				echo	showTD('block_6');
			?>
		</td>
	</tr>

	<tr>
		<td>
			<input type="submit" value="保存" />
		</td>
		<td>&nbsp;</td>
	</tr>

	</table>








	<table border="1" class="right">
	<tr>
		<td>3</td>
	</tr>
	</table>
</div>

</form>

