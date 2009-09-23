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

<li class="sep"></li>

<li><a href="<?php echo url_for('article/new') ?>" target="main">添加文章</a></li>
<li><a href="<?php echo url_for('article/index') ?>" target="main">管理文章</a></li>

<li class="sep"></li>

<li><a href="<?php echo url_for('article/newProduct') ?>" target="main">添加产品信息</a></li>
<li><a href="<?php echo url_for('article/listProduct') ?>" target="main">管理产品信息</a></li>


<!--
<li class="sep"></li>

<li><a href="<?php echo url_for('article/newRange') ?>" target="main">添加领域信息</a></li>
<li><a href="<?php echo url_for('article/listRange') ?>" target="main">管理领域信息</a></li>
-->

<li class="sep"></li>

<!--
<li><a href="<?php echo url_for('article/audit') ?>" target="main">文章审核</a></li>

<li class="sep"></li>
-->


<li><a href="<?php echo url_for('category/index') ?>" target="main">管理文章分类</a></li>
<li><a href="<?php echo url_for('category/range') ?>" target="main">管理产品应用领域</a></li>

<li class="sep"></li>
<li><a href="<?php echo url_for('category/type') ?>" target="main">设备类别</a></li>
<li><a href="<?php echo url_for('category/style') ?>" target="main">设备型号</a></li>

<li class="sep"></li>

<li><a href="<?php echo url_for('portal/friend') ?>" target="main">友情链接</a></li>

<!--
<li><a href="<?php echo url_for('portal/password') ?>" target="main">修改密码</a></li>
-->

<li><a href="<?php echo url_for('portal/advertise') ?>" target="main">广告管理</a></li>
<li><a href="<?php echo url_for('portal/filter') ?>" target="main">过滤关键字维护</a></li>
<li><a href="<?php echo url_for('portal/message') ?>" target="main">留言板管理</a></li>


<li class="sep"></li>

<li><a href="<?php echo url_for('user/index') ?>" target="main">管理员列表</a></li>

<li><a href="<?php echo url_for('frame/signOut') ?>" target="main">退出</a></li>


</div>
</tr>
</table>
