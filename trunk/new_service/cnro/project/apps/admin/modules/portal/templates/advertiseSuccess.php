
<?php


	$GLOBALS['global_data']		= $arrDataConf;

	function showADBanner($name, $option = array()) {

		$arrDataConf		= $GLOBALS['global_data'];

	#	var_dump($arrDataConf);

		if (!isset($option['has_pic'])) {
			$option['has_pic']	= true;
		}

		$str	= '';

		$str	.= '<h3>' . $name . '</h3>';


		$str	.= sprintf('链接：<input type="text" name="%s" class="admin_pic_url" value="%s" /> <br />'
					. '地址：<input type="text" name="%s" class="admin_pic_url" value="%s" /> 留空则不显示，后缀为swf则显示FLASH',
					$name . '_link',
					isset($arrDataConf['block'][$name]) ? S::E($arrDataConf['block'][$name . '_link']) : '#',
					$name,
					isset($arrDataConf['block'][$name]) ? S::E($arrDataConf['block'][$name]) : ''
				);

		if ($option['has_pic'] && isset($arrDataConf['block'][$name])) {

			$imgLink	= isset($arrDataConf['block'][$name . '_link']) ? $arrDataConf['block'][$name . '_link'] : '#';

			$imgSrc		= $arrDataConf['block'][$name];

			$tmp		= explode('.', $imgSrc);
			$ext		= array_pop($tmp);
		#	var_dump($ext);


			if ('swf' == $ext) {
				$str	.= sprintf('<p><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="220" height="180"><param name="movie" value="%s"><param name="quality" value="high"><param name="menu" value="false"><param name="wmode" value="opaque"><param name="FlashVars" value=""><embed src="%s" wmode="opaque" flashvars="" false="" quality="high" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" width="220" height="180"></object></p>', $imgSrc, $imgSrc);
			} else {
				$str	.= sprintf('<p><a href="%s" target="_blank"><img src="%s" width="220" height="180" /></a></p>', $imgLink, $imgSrc);
			}

		}

		return	$str;

	}

?>


<form method="post" action="<?php echo url_for('portal/saveAdvertise') ?>">

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
		</td>
		<td>
			<?php
				echo	showADBanner('article_ad_1');
			?>
		</td>
	</tr>
	<tr>
		</td>
		<td>
			<?php
				echo	showADBanner('article_ad_2');
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

