<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />

<script type="text/javascript" src="/matcher/js/mootools-1.2.1-core-nc.js"></script>
<script type="text/javascript" src="/matcher/js/main.js"></script>
<script type="text/javascript" src="/matcher/js/item.js"></script>

<link rel="stylesheet" type="text/css" media="screen" href="/matcher/css/main.css" />


</head>
<body>

	<div id="header">

		<div>

		</div>

		<div>
			<h3><a href="/matcher/admin/">PPT Matcher</a></h3>
		</div>


	</div>


	<div id="mainBody">
	  	<table id="mainTable" cellspacing="1">
	  	<tbody>
	  		<tr>
	  			<td class="menu">
	  				<ul>
	  					<li><a href="<?php echo url_for('camera/index') ?>">相机</a></li>
	  					<li><a href="<?php echo url_for('lens/index') ?>">镜头</a></li>
	  					<li><a href="<?php echo url_for('stand/index') ?>">脚架</a></li>
	  					<li><a href="<?php echo url_for('bag/index') ?>">摄影包</a></li>
	  					<li><a href="<?php echo url_for('filter/index') ?>">滤镜</a></li>
	  					<li><a href="<?php echo url_for('holder/index') ?>">云台</a></li>


	  				</ul>
	  			</td>
	  			<td class="content">
	    				<?php echo $sf_content ?>
	  			</td>
	  		</tr>
		</tbody>
	  	</table>
	</div>


</body>
</html>