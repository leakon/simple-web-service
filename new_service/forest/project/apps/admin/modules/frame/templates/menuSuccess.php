<style type="text/css">
html, body,
.container	{padding:0; height:100%; background:#EAF4FB;}
</style>

<table>
<tr>
<td valign="top" width="160" class="menutd">
<div id="leftmenu" class="menu">


<div id="leftmenu" class="menu" style="">

<h3>管理菜单</h3>


<li><a href="<?php echo url_for('portal/index') ?>" target="main">首页管理</a></li>

<li><a href="<?php echo url_for('article/new') ?>" target="main">添加新文章</a></li>

<li><a href="<?php echo url_for('article/index') ?>" target="main">文章管理</a></li>

<li><a href="<?php echo url_for('article/audit') ?>" target="main">文章审核</a></li>

<li><a href="<?php echo url_for('category/index') ?>" target="main">分类管理</a></li>

<li><a href="<?php echo url_for('portal/friend') ?>" target="main">友情链接</a></li>

<li><a href="<?php echo url_for('portal/password') ?>" target="main">修改密码</a></li>

<li><a href="<?php echo url_for('frame/signOut') ?>" target="main">退出</a></li>


</div>
</tr>
</table>
