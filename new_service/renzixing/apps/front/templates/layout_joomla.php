<?php

$theFilePathCSS		= '/joomla/css/';
$theFilePathJS		= '/joomla/js/';
$theFilePathImage	= '/joomla/images/';

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" id="minwidth" >
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>


  <title>Leakon - Administration</title>
  <script type="text/javascript" src="<?php echo $theFilePathJS ?>joomla.javascript.js"></script>
  <script type="text/javascript" src="<?php echo $theFilePathJS ?>mootools.js"></script>
  <script type="text/javascript">
		window.addEvent('domready', function(){ var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false}); });
  </script>


<link rel="stylesheet" href="<?php echo $theFilePathCSS ?>system.css" type="text/css" />
<link href="<?php echo $theFilePathCSS ?>template.css" rel="stylesheet" type="text/css" />


<!--[if IE 7]>
<link href="<?php echo $theFilePathCSS ?>ie7.css" rel="stylesheet" type="text/css" />
<![endif]-->

<!--[if lte IE 6]>
<link href="<?php echo $theFilePathCSS ?>ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo $theFilePathCSS ?>rounded.css" />

<script type="text/javascript" src="<?php echo $theFilePathJS ?>menu.js"></script>
<script type="text/javascript" src="<?php echo $theFilePathJS ?>index.js"></script>



<link rel="stylesheet" type="text/css" href="<?php echo $theFilePathCSS ?>leakon.css" />

</head>
<body id="minwidth">
	<div id="border-top" class="h_teal">
		<div>
			<div>
				<span class="title">任子行客服系统</span>
			</div>
		</div>
	</div>
	<div id="header-box">
		<div id="module-status">

	<?php include_partial('user/passportPartial') ?>


			</div>
		<div id="module-menu">
			<ul id="menu" >

	<li class="node"><a>流程管理</a>
	<ul>
		<li><a class="icon-16-info" href="<?php echo url_for('issue/create') ?>">创建</a></li>
		<li><a class="icon-16-info" href="<?php echo url_for('issue/list') ?>">列表</a></li>
		<li><a class="icon-16-info" href="<?php echo url_for('issue/involved') ?>">我的流程</a></li>
	</ul>
	</li>

	<li class="node"><a>客户管理</a>
	<ul>
		<li><a class="icon-16-info" href="<?php echo url_for('customer/create') ?>">创建</a></li>
		<li><a class="icon-16-info" href="<?php echo url_for('customer/list') ?>">列表</a></li>
	</ul>
	</li>


	<li class="node"><a>产品管理</a>
	<ul>
		<li><a class="icon-16-info" href="<?php echo url_for('product/create') ?>">创建</a></li>
		<li><a class="icon-16-info" href="<?php echo url_for('product/list') ?>">列表</a></li>
	</ul>
	</li>



	<li class="node"><a>维护信息</a>
	<ul>
		<li><a class="icon-16-info" href="<?php echo url_for('maintance/create') ?>">创建</a></li>
		<li><a class="icon-16-info" href="<?php echo url_for('maintance/list') ?>">列表</a></li>
	</ul>
	</li>



	<li class="node"><a>帐户管理</a>
	<ul>
		<li><a class="icon-16-info" href="<?php echo url_for('user/manage') ?>">管理</a></li>
		<li><a class="icon-16-info" href="<?php echo url_for('user/list') ?>">列表</a></li>
	</ul>
	</li>
</ul>

		</div>
		<div class="clr"></div>
	</div>







	<div id="content-box">




		<div class="border">
			<div class="padding">






		<div id="element-box">
			<div class="t">
		 		<div class="t">
					<div class="t"></div>
		 		</div>
			</div>


			<div class="m">


<?php if (0) : ?>
			<table>
			<tr>
				<td align="left" width="100%">
					Filter:
					<input type="text" name="search" id="search" value="" class="text_area" />
					<button>Go</button>
					<button>Reset</button>
				</td>
				<td nowrap="nowrap">
					</td>
			</tr>
			</table>

<?php endif ?>

<?php echo $sf_data->getRaw('sf_content') ?>


				<div class="clr"></div>
			</div>
			<div class="b">
				<div class="b">
					<div class="b"></div>
				</div>
			</div>
   		</div>




		<noscript>
			Warning! JavaScript must be enabled for proper operation of the Administrator Back-end		</noscript>
		<div class="clr"></div>
	</div>
	<div class="clr"></div>
</div>
</div>
	<div id="border-bottom"><div><div></div></div></div>
	<div id="footer">
		<p class="copyright">
			<a href="http://www.leakon.com/" target="_blank">Leakon</a> 2008 [<?php echo $GLOBALS['simple_user_status'] ?>]</p>
	</div>
</body>
</html>
