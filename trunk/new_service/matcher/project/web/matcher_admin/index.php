<?php

#	$dirBase	= '/admin/admin.php/?';
#	$dirBase	= '/matcher/admin/admin_dev.php/';
	$dirBase	= '/admin/';

function index_url_for($uri) {

	return	'/admin/' . $uri;

}

?><!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html><head><title>网站后台管理</title>
<meta http-equiv=content-type content="text/html; charset=utf-8">
<meta http-equiv=pragma content=no-cach>
<meta content="mshtml 6.00.6000.16825" name=generator></head>
<frameset rows="127,*,32" frameborder="no" border="0" framespacing="0">
<frame src="<?php echo index_url_for('user/frameTop') ?>" name="topframe" scrolling="no" noresize >
<frameset border=0 framespacing=0 frameborder=0 cols=180,*>
<frame id=fleft style="overflow-x:hidden" name=fleft src="<?php echo index_url_for('user/frameLeft') ?>" noresize scrolling=yes>
<frame id=fright style="overflow-x:hidden" border=0 name=fright src="<?php echo index_url_for('camera/index') ?>" frameborder=0 noresize scrolling=auto>
</frameset><noframes></noframes>
<frame src="<?php echo index_url_for('user/frameFoot') ?>" name="bottomframe" scrolling="no" noresize>
</frameset>
</html>
