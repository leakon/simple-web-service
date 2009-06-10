<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
</head>
<body>
<div class="top">
<div class="logo"><a><img src="/matcher/admin/images/admin-logo.gif"></a></div>
<div class="topmenu">
<ul><li><a>Hello, <?php echo $sf_user->getUsername() ?></a></li><li class="li"><img src="/matcher/admin/images/homeadmin.gif" align="absmiddle"><a href="/matcher" target="fright">浏览首页</a><img src="/matcher/admin/images/suo.gif" align="absmiddle"><a href="<?php echo url_for('user/logout') ?>" target="fright">安全退出</a></li></ul>
</div>
</div>
</body>
</html>
