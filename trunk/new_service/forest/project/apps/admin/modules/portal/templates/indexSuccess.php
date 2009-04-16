
<?php

$arrOptionNoPic	= array(
			'has_pic'	=> false
		);


	Custom_Homepage::setDataConf($arrDataConf);

#	Debug::pr($arrDataConf);


	function showTD($name, $option = array()) {

		if (!isset($option['has_pic'])) {
			$option['has_pic']	= true;
		}

		$arr	= Custom_Homepage::genCategorySelect($name);

		$str	= '';

		$str	.= '<h3>' . $name . '</h3>';

	#	$str	.= '<p>' . $arr['top'] . '</p>';
	#	$str	.= '<p>' . $arr['sub'] . '</p>';

		$str	.= '分类：' . $arr['top'] . '';
		$str	.= ' &nbsp; ';
		$str	.= '' . $arr['sub'] . '';

		if ($option['has_pic'] && isset($arr['pic'])) {
			$str	.= '<p>' . $arr['pic'] . '</p>';
		}

		return	$str;

	}

?>
<div class="itemtitle"><h3>首页设置</h3></div>

<form method="post" action="<?php echo url_for('portal/save') ?>">

<p>
<input type="submit" value="保存" class="btn" />
</p>

<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />


<div id="contentBox">

<div class="left">
	<table border="0" class="leftCol tb tb2">

	<tr>
		<td>
			<?php
				echo	showTD('focus', $arrOptionNoPic);
			?>
		</td>
		<td>
			<?php
				echo	showTD('head', $arrOptionNoPic);
			?>
		</td>
	</tr>

	<tr>
		<td>
			<?php
				echo	showTD('news_1');
			?>
		</td>
		<td>
			<?php
				echo	showTD('news_2');
			?>
		</td>
	</tr>



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


	</table>

</div>




<?php


#	Debug::pr($arrDataConf);

?>

<div class="right">
	<table border="0" class="tb tb2">
	<tr>
		<td>
			<?php echo checkbox_tag( 'use_user', 1, isset($arrDataConf['block']['use_user'] ), array('id' => 'id_use_user')) ?>
			<label for="id_use_user">开启用户注册/登录</labbel>

		</td>
	</tr>
	<tr>
		<td>
			<?php
				echo	showTD('scroll_1', $arrOptionNoPic);
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php
				echo	showTD('scroll_2', $arrOptionNoPic);
			?>
		</td>
	</tr>


	<tr>
		<td>
			<?php
				echo	showTD('side_1');
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php
				echo	showTD('side_2');
			?>
		</td>
	</tr>
	</table>
</div>

</div>

<p>
<input type="submit" value="保存" class="btn" />
</p>

</form>

