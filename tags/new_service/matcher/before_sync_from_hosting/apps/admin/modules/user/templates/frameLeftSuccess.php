
<div class="left" id="leftMenu">

<h1 onclick="menu_set('menu_01')"><a>相机管理</a></h1>
<ul id="menu_01">
<li><a target="fright" href="<?php echo url_for('camera/index') ?>">品牌管理</a></li>
<li><a target="fright" href="<?php echo url_for('camera/style') ?>">类型管理</a></li>
<li><a target="fright" href="<?php echo url_for('camera/model') ?>">型号管理</a></li>
</ul>

<h1 onclick="menu_set('menu_02')"><a>镜头管理</a></h1>
<ul id="menu_02">
<li><a target="fright" href="<?php echo url_for('lens/index') ?>">品牌管理</a></li>
<li><a target="fright" href="<?php echo url_for('caliber/index') ?>">口径管理</a></li>
<li><a target="fright" href="<?php echo url_for('lens/model') ?>">型号管理</a></li>
</ul>

<h1 onclick="menu_set('menu_03')"><a>脚架管理</a></h1>
<ul id="menu_03">
<li><a target="fright" href="<?php echo url_for('stand/index') ?>">品牌管理</a></li>
<li><a target="fright" href="<?php echo url_for('stand/model') ?>">型号管理</a></li>
</ul>

<h1 onclick="menu_set('menu_04')"><a>摄影包管理</a></h1>
<ul id="menu_04">
<li><a target="fright" href="<?php echo url_for('bag/index') ?>">品牌管理</a></li>
<li><a target="fright" href="<?php echo url_for('bag/model') ?>">型号管理</a></li>
</ul>


<h1 onclick="menu_set('menu_05')"><a>滤镜管理</a></h1>
<ul id="menu_05">
<li><a target="fright" href="<?php echo url_for('filter/index') ?>">品牌管理</a></li>
<li><a target="fright" href="<?php echo url_for('filter/model') ?>">型号管理</a></li>
</ul>

<h1 onclick="menu_set('menu_06')"><a>云台管理</a></h1>
<ul id="menu_06">
<li><a target="fright" href="<?php echo url_for('holder/index') ?>">品牌管理</a></li>
<li><a target="fright" href="<?php echo url_for('holder/model') ?>">型号管理</a></li>
</ul>

<h1 onclick="menu_set('menu_07')" class="h1"><a>系统管理</a></h1>
<ul id="menu_07">
<li><a target="fright" href="<?php echo url_for('tag/index') ?>">标签管理</a></li>
<li><a target="fright" href="<?php echo url_for('price/index') ?>">价格区间</a></li>
<li><a target="fright" href="<?php echo url_for('user/list') ?>">用户管理</a></li>
<?php if (0) : ?>
<li><a target="fright" href="<?php echo url_for('user/password') ?>">修改用户密码</a></li>
<?php endif ?>
</ul>

</div>
<SCRIPT LANGUAGE="javascript">
<!-- Hide
function killErrors() {
return true;
}
window.onerror = killErrors;
// -->
function menu_set(nid)
{
	if($(nid).style.display == "none")
	{
		$(nid).style.display = "";
	}
	else
	{
		$(nid).style.display = "none";
	}
}

function $(id)
{
	return document.getElementById(id);
}

//if(qgIE == "FF")
//{
//	$("xupfiles_qgchk").style.display = "none";
//}
</SCRIPT>