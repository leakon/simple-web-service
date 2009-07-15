<?php

	$evn_dev	= '';
#	$evn_dev	= 'admin_dev.php/';

?>
<html>
<head>
<title>森罗管理后台</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>
<frameset name="fset" id="fset" cols="160px,*" border=0 >
	<frame name="menu" id="menu" src="/admin/<?php echo $evn_dev ?>frame/menu" scrolling="no" noresize="true">
	<frame name="main" id="main" src="/admin/<?php echo $evn_dev ?>frame/main" scrolling="yes">
</frameset>
</html>