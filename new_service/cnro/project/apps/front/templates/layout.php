<?php

$cateId			= 0;

$reqCategoryId		= (int) $sf_request->getParameter('id', 0);

$arrSubCategories	= array();

if ($reqCategoryId) {

	$categoryItem		= new Table_categories($reqCategoryId);

	$cateId			= $categoryItem->parent_id;

	if ($cateId) {


	} else {
		// 如果 parent_id 为 0，则 category 是一级分类

		$cateId		= $reqCategoryId;

	}

}


$objConf	= new Custom_Conf();
$arrConf_HELP	= $objConf->getConf('help');

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CNRO - Welcome to CNRO 天津市森罗科技发展有限责任公司</title>
<link href="/css/style.css" type="text/css" rel="stylesheet" />
<link href="/css/global1.3.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="/css/superfish.css" media="screen">
		<script type="text/javascript" src="/js/jquery-1.2.6.min.js"></script>
		<script type="text/javascript" src="/js/hoverIntent.js"></script>
		<script type="text/javascript" src="/js/superfish.js"></script>
		<script type="text/javascript">

		// initialise plugins
		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});

		</script>

<SCRIPT LANGUAGE="JavaScript">
<!--
function AddFavorite() {
	var sURL = location.href;
	var sTitle = document.title;

	try {
		window.external.AddFavorite(sURL, sTitle);
	} catch (e) {
		try {
			window.sidebar.addPanel(sTitle, sURL, "");
		} catch (e) {
			//	alert("加入收藏失败，请使用Ctrl+D进行添加");
		}
	}
}

function SetHome(obj){

	var vrl = window.location;

	try {
		obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl);
	} catch(e) {
		if(window.netscape) {
			try {
				netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
			} catch (e) {
				alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将 [signed.applets.codebase_principal_support]的值设置为'true',双击即可。");
			}

			var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
			prefs.setCharPref('browser.startup.homepage',vrl);
		}
	}
}


//-->
</SCRIPT>


</head>

<body>
  <div id="wrapper">
    <div class="container">

      <div class="topbar">
        <div class="topNav">
          <a href="#" target="_blank">英文版</a>  |  <a href="#" target="_blank">网站地图</a>  |  <a href="#" target="_blank">联系我们</a>
        </div>

      </div>

      <div class="header">
        <h1><a href="/cn"><img src="/images/logo_ch.png" width="385" height="60" alt="CNRO 森罗-氮气应用专家" /></a></h1>
        <div class="searchBar">






          	<form method="get" id="searchform" action="<?php echo url_for('article/search') ?>" target="_blank">

          		<input name="kw" value="<?php echo S::E($sf_request->getParameter('kw', '')) ?>" type="text" class="in195" /><input type="submit" value="" class="btn75" />


		</form>











        </div>

      </div>

      <div class="mainBody">

        <div class="banner137"><img src="/images/banner942x137.jpg" width="942" height="137" /></div>

  <div class="mainNav">
  <ul class="sf-menu">

        	<?php include_partial('global/topNav', array('cateId' => $cateId)) ?>

</ul>
</div>

   		 <?php echo $sf_content ?>

      </div>
      <div class="footer">
        <a href="#" target="_blank">英文版</a>   |   <a href="#" target="_blank">网站地图</a>   |   <a href="#" target="_blank">联系我们</a>   |   <a href="#" target="_blank">&copy; 2009 Tianjin CNRO  Company</a>
      </div>
    </div>
  </div>

</body>
</html>
