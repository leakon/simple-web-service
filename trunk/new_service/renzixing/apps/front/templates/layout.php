<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/global.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/wp-admin.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/colors-fresh.css" />

<link rel="stylesheet" type="text/css" media="screen" href="/css/main.css" />

<!--[if gte IE 6]>
<link rel="stylesheet" href="/css/ie.css" type="text/css" />
<![endif]-->

<style type="text/css">* html { overflow-x: hidden; }</style>
<style type="text/css" media="all">
	@import "/css/thickbox.css";
	div#TB_title {
		background-color: #222222;
		color: #cfcfcf;
	}
	div#TB_title a, div#TB_title a:visited {
		color: #cfcfcf;
	}
</style>

</head>

<body class="wp-admin ">

<div id="wpwrap">

	<div id="wpcontent">

		<div id="wphead">&nbsp;</div>

	<?php include_partial('user/passportPartial') ?>

		<!-- Nav Menu Begin -->
			<ul id="dashmenu">
			<li><strong><a href="#">任子行客服系统</a></strong></li></ul>
			<?php echo include_partial('global/siteNavigation') ?>
		<!-- Nav Menu End -->

		<div id="wpbody">
			<?php echo $sf_data->getRaw('sf_content') ?>
		</div><!-- wpbody -->

	</div><!-- wpcontent -->

</div><!-- wpwrap -->


<div id="footer">
	<p><a href="http://www.leakon.com/">Lakon</a> 2008 [<?php echo $GLOBALS['simple_user_status'] ?>]</p>
</div>
</body>
</html>
