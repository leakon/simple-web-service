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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />

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

  <div id="header">
    <div class="container">
      <div id="top189">
        <div id="topbar">
          <div class="timebar"><?php echo date('Y年n月j日') ?></div>
          <div class="funcLink"><?php if ($sf_user->getId()) {echo $sf_user->getUsername() . ' | <a href="'. url_for('account/signOut') .'">退出</a> | ';} ?><a href="#" onclick="SetHome(this)">设为首页</a> | <a href="#" onclick="AddFavorite()">加入收藏</a><?php if (0) : ?> | <a href="#">中英</a> - <a href="#">English</a><?php endif ?></div>
        </div>
        <div id="infoBlock"></div>

        	<?php include_partial('global/topNav', array('cateId' => $cateId)) ?>


      </div>
      <!-- end top189 -->
    </div>
    <!-- end container -->
  </div><!-- end header -->





    <?php echo $sf_content ?>





<?php if (isset($arrConf_HELP) && count($arrConf_HELP)): ?>
  <div class="container">
      <div class="ft_l"></div>
        <div class="ft_m">
         <p>
         	<?php

         	foreach ($arrConf_HELP['friend_text'] as $key => $val) {

			$link		= $arrConf_HELP['friend_link'][$key];

         		if (isset($val) && strlen($val) && isset($link) && strlen($link)) {
         			echo	sprintf('<a href="%s" target="_blank">%s</a>', $arrConf_HELP['friend_link'][$key], S::E($val));
         		}

         	}

         	?>
         </p>
        </div>
        <div class="ft_r"></div>
    </div>
  <div class="blank10"></div>
<?php endif ?>




  <div id="footer">
    <div class="container">
      <p><span>主办单位：国家林业局林木生物质能源领导小组办公室</span><span>工作信箱:<a href="mailto:sfaeo@sina.com">sfaeo@sina.com</a></span><span> 技术支持: <a href="mailto:webmaster@fbioenergy.gov.cn">webmaster@fbioenergy.gov.cn</a></span></p>
      <div class="blank10"></div>
      <p> 京ICP备06065631号 </p>
    </div>
  </div>
  <!-- end footer -->


</div><!-- end wrapper -->




  </body>
</html>
