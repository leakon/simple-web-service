<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<link rel="shortcut icon" href="/favicon.ico" />

<link href="/css/global.css" type="text/css" rel="stylesheet" />
<link href="/css/main.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script src="/js/PNG.js" language="javascript" type="text/javascript"></script>
<![ENDif]-->

<script>

function SubmitOrderForm(strFormID) {

	var objForm	= document.getElementById(strFormID);

	if (objForm) {

		objForm.submit();

	}

}

</script>

</head>
<body>
<?php

?>
<div id="main">
<div id="footer"><span><a href="<?php echo url_for('en/policy') ?>">Privacy Policy</a></span><span><a href="<?php echo url_for('en/findUs') ?>">Find us</a></span><span>&copy;Copyright Colibri.</span> <a href="#" target="_self"><img src="/images/icon01.gif" alt="" border="0" align="absmiddle" /></a><a href="#" target="_self"><img src="/images/icon02.gif" alt="" border="0" align="absmiddle" /></a><a href="#" target="_self"><img src="/images/icon03.gif" alt="" border="0" align="absmiddle" /></a><a href="#" target="_self"><img src="/images/icon04.gif" alt="" border="0" align="absmiddle" /></a></div>
  <div id="top">
  <div class="logo"><a href="<?php echo url_for('en/index') ?>"><img src="/images/logo.png" alt="" border="0" /></a></div>

  <div class="nav"><img src="/images/bot03.gif" alt="" /><img src="/images/bot04.gif" alt="" /><br />
    COLIBRI<span>/</span><a href="<?php echo url_for('en/menu') ?>">MENU</a><span>/</span><a href="<?php echo url_for('product/index') ?>">ORDERING</a><span>/</span><a href="<?php echo url_for('en/faq') ?>">FAQ</a></div>
	</div>
	<div class="clear"></div>


	<div id="content">


    <?php echo $sf_content ?>


	</div>


</div>
</body>
</html>

