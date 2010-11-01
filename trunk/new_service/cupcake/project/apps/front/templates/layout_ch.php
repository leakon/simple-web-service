<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<link rel="shortcut icon" href="/favicon.ico" />

<link href="/css/global.css" type="text/css" rel="stylesheet" />
<link href="/css/main_ch.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script src="/js/PNG.js" language="javascript" type="text/javascript"></script>
<![ENDif]-->

<?php if (0) : ?>
<script src="/js/home.ok.js" language="javascript" type="text/javascript"></script>
<?php endif ?>


<script>

function SubmitOrderForm(strFormID, CheckFormFunc) {
	
	
	var objForm	= document.getElementById(strFormID);

	if (objForm) {
		
		if ('undefined' != typeof CheckFormFunc && true != CheckFormFunc(objForm)) {
			return;
		}
		
		setTimeout(function() {
			objForm.submit();
		}, 10);

	}

}

</script>

</head>
<body>
<?php

$arrNav		= array(
			0	=> array('蜂鸟', url_for('ch/index'), array(
										'ch/index'	=> 1,
										)
					),
			
			1	=> array('菜单', url_for('ch/menu'), array(
										'ch/menu'	=> 1,
										'ch/cupcakes'	=> 1,
										'ch/panini'	=> 1,
										)
					),
					
			2	=> array('订餐', url_for('product/indexCh'), array(
										'product/indexCh'		=> 1,
										'cart/fillAddress'	=> 1,
										'cart/selectPayment'	=> 1,
										)
					),
					
			3	=> array('问答', url_for('ch/faq'), array(
										'ch/faq'	=> 1,
										)
					),
					
		);

$module		= $sf_context->getModuleName();
$action		= $sf_context->getActionName();

function showNav($arrNav, $module, $action) {
	
	$route		= $module . '/' . $action;
	
	$arrHtmls	= array();
	
	foreach ($arrNav as $val) {
		
		if (isset($val[2][$route])) {
			// highlight
			
			$arrHtmls[]	= $val[0];
			
		} else {
			
			$arrHtmls[]	= sprintf('<a href="%s">%s</a>', $val[1], $val[0]);
		}
		
	}
	
	return	implode('<span>/</span>', $arrHtmls);
	
}

?>
<div id="main">
<div id="footer"><span><a href="<?php echo url_for('ch/policy') ?>">隐私条款</a></span><span><a href="<?php echo url_for('ch/findUs') ?>">联系我们</a></span><span>&copy;Copyright Colibri.</span> <span><a href="http://china.smart.com/" target="_blank"><img src="/images/smartlogo.gif" alt="" border="0" align="absmiddle" /></a></span> <a href="#" target="_self"><img src="/images/icon01.gif" alt="" border="0" align="absmiddle" /></a><a href="#" target="_self"><img src="/images/icon02.gif" alt="" border="0" align="absmiddle" /></a><a href="#" target="_self"><img src="/images/icon03.gif" alt="" border="0" align="absmiddle" /></a><a href="#" target="_self"><img src="/images/icon04.gif" alt="" border="0" align="absmiddle" /></a></div>
  <div id="top">
  <div class="logo"><a href="<?php echo url_for('ch/index') ?>"><img src="/images/logo.png" alt="" border="0" /></a></div>

  <div class="nav"><img src="/images_ch/bot0.gif" alt="" /><a href="<?php echo url_for('en/index') ?>"><img src="/images_ch/bot03en.gif" alt="" /></a><br />
    <?php echo showNav($arrNav, $module, $action) ?></div>
	</div>
	<div class="clear"></div>


	<div id="content">


    <?php echo $sf_content ?>


	</div>


</div>
</body>
</html>

