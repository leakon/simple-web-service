
<div class="top">
<div class="logo"><a><img src="/admin/images/admin-logo.gif"></a></div>
<div class="topmenu">
<ul><li><a>Hello, <?php echo $sf_user->getUsername() ?></a></li><li class="li"><img src="/admin/images/homeadmin.gif" align="absmiddle"><a href="/matcher" target="fright">浏览首页</a><img src="/admin/images/suo.gif" align="absmiddle"><a href="<?php echo url_for_2('user/logout') ?>" target="fright">安全退出</a></li></ul>
</div>
</div>
