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

		objForm.submit();

	}

}

</script>

</head>
<body>
<?php

?>
<div id="main">
<div id="footer"><span><a href="<?php echo url_for('ch/policy') ?>">隐私条款</a></span><span><a href="<?php echo url_for('ch/findUs') ?>">联系我们</a></span><span>&copy;Copyright Colibri.</span> <a href="#" target="_self"><img src="/images/icon01.gif" alt="" border="0" align="absmiddle" /></a><a href="#" target="_self"><img src="/images/icon02.gif" alt="" border="0" align="absmiddle" /></a><a href="#" target="_self"><img src="/images/icon03.gif" alt="" border="0" align="absmiddle" /></a><a href="#" target="_self"><img src="/images/icon04.gif" alt="" border="0" align="absmiddle" /></a></div>
  <div id="top">
  <div class="logo"><a href="<?php echo url_for('ch/index') ?>"><img src="/images/logo.png" alt="" border="0" /></a></div>

  <div class="nav"><img src="/images/bot03.gif" alt="" /><img src="/images/bot04.gif" alt="" /><br />
    蜂鸟<span>/</span><a href="<?php echo url_for('ch/menu') ?>">菜单</a><span>/</span><a href="<?php echo url_for('product/indexCh') ?>">订餐</a><span>/</span><a href="<?php echo url_for('ch/faq') ?>">问答</a></div>
	</div>
	<div class="clear"></div>


	<div id="content">


    <?php echo $sf_content ?>


	</div>


</div>
</body>
</html>

