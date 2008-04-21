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










<?php if (0) : ?>







			<table class="adminlist" cellspacing="1">
			<thead>
			<tr>
				<th width="20">
					#				</th>
				<th width="20">
					<input type="checkbox" name="toggle" value="" />
				</th>
				<th class="title">
					<a href="#">Module Name</a>				</th>
				<th nowrap="nowrap" width="7%">
					<a href="#">Enabled</a>				</th>
				<th width="80" nowrap="nowrap">
					<a href="#">Order</a>				</th>
				<th width="1%">
					<a href="#"></a>				</th>
									<th nowrap="nowrap" width="7%">
						<a href="#">Access Level</a>					</th>
									<th nowrap="nowrap" width="7%">
					<a href="#">Position				</th>
				<th nowrap="nowrap" width="5%">
					<a href="#">Pages</a>				</th>
				<th nowrap="nowrap" width="10%"  class="title">
					<a href="#">Type</a>				</th>
				<th nowrap="nowrap" width="1%">
					<a href="#">ID</a>				</th>
			</tr>
			</thead>
			<tfoot>
			<tr>
				<td colspan="12">
					<del class="container"><div class="pagination">

<div class="limit"></div><div class="button2-right off"><div class="start"><span>Start</span></div></div><div class="button2-right off"><div class="prev"><span>Prev</span></div></div>
<div class="button2-left"><div class="page"><span>1</span><a href="#">2</a>
</div></div><div class="button2-left"><div class="next"><a href="#">Next</a></div></div><div class="button2-left"><div class="end"><a href="#">End</a></div></div>
<div class="limit">Page 1 of 2</div>
<input type="hidden" name="limitstart" value="0" />
</div></del>				</td>
			</tr>
			</tfoot>
			<tbody>
							<tr class="row0">
					<td align="right">
						1					</td>
					<td width="20">
						<input type="checkbox" id="cb0" name="cid[]" value="35" />					</td>
					<td>
											<span class="editlinktip hasTip">
						<a href="#">
							Breadcrumbs</a>
						</span>
											</td>
					<td align="center">

		<a href="#">
		<img src="<?php echo $theFilePathImage ?>tick.png" border="0" alt="Enabled" /></a>					</td>
					<td class="order" colspan="2">
						<span>&nbsp;</span>
						<span>&nbsp;</span>
												<input type="text" name="order[]" size="5" value="1"  class="text_area" style="text-align: center" />
					</td>
											<td align="center">

			<a href="#" style="color: green;">
			Public</a>						</td>
											<td align="center">
						breadcrumb					</td>
					<td align="center">
						All					</td>
					<td>
						mod_breadcrumbs					</td>
					<td>
						35					</td>
				</tr>
								<tr class="row1">
					<td align="right">
						2					</td>
					<td width="20">
						<input type="checkbox" id="cb1" name="cid[]" value="30" />					</td>
					<td>
											<span class="editlinktip hasTip">
						<a href="#">
							Banners</a>
						</span>
											</td>
					<td align="center">

		<a href="#">
		<img src="<?php echo $theFilePathImage ?>tick.png" border="0" alt="Enabled" /></a>					</td>
					<td class="order" colspan="2">
						<span>&nbsp;</span>
						<span><a href="#">  <img src="<?php echo $theFilePathImage ?>downarrow.png" width="16" height="16" border="0" alt="Move Down" /></a></span>
												<input type="text" name="order[]" size="5" value="1"  class="text_area" style="text-align: center" />
					</td>
											<td align="center">

			<a href="#" style="color: green;">
			Public</a>						</td>
											<td align="center">
						footer					</td>
					<td align="center">
						All					</td>
					<td>
						mod_banners					</td>
					<td>
						30					</td>
				</tr>

							</tbody>
			</table>


<?php endif ?>

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
