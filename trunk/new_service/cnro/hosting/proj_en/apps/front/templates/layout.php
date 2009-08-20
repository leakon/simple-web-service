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

$override_category_id	= sfConfig::get('override_category_id', false);

if (false !== $override_category_id) {
	$cateId		= $override_category_id;
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
<script src="/js/jquery-1.2.2.pack.js" type="text/javascript"></script>
<link href="/css/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="/js/facebox.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox()
    })
</script>


<script language="javascript" src="/js/jquery.js"></script>
<script language="javascript" src="/js/index_ad.js"></script>

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
          <a href="#" target="_blank">English</a>  |  <a href="#" target="_blank">SiteMap</a>  |  <a href="#" target="_blank">Contact</a>
        </div>

      </div>

      <div class="header">
        <h1><a href="<?php echo url_for('/') ?>"><img src="/images/logo_ch.png" width="385" height="60" alt="CNRO 森罗-氮气应用专家" /></a></h1>
        <div class="searchBar">






          	<form method="get" id="searchform" action="<?php echo url_for('article/search') ?>" target="_blank">

          		<input name="kw" value="<?php echo S::E($sf_request->getParameter('kw', '')) ?>" type="text" class="in195" /><input type="submit" value="" class="btn75" />


		</form>











        </div>

      </div>

      <div class="mainBody">

	<?php

	$strModuleName	= $sf_context->getModuleName();
	$strActionName	= $sf_context->getActionName();


	?>

	<?php if ($strModuleName == 'portal' && $strActionName == 'index') : ?>


    <div id="td_index_bigad">

    	<?php


		$arrBlock	= $objConf->getConf('block');
    	#	$arrBlock	= isset($objConf['block']) ? $objConf['block'] : array();

    		$arrPics	= array(

    				1	=> '/images/flash944x300.jpg',
    				2	=> '/images/bigpic.jpg',
    				3	=> '/images/bigpic2.jpg',
    				4	=> '/images/bigpic4.jpg',

    				);

    		$arrIndexPics	= array();

    		foreach ($arrPics as $index => $defaultSrc) {

			$arrIndexPics[$index]	= array(
				'src'	=> isset($arrBlock['nav_pic_src'][$index]) ? $arrBlock['nav_pic_src'][$index] : $defaultSrc,
				'link'	=> isset($arrBlock['nav_pic_link'][$index]) ? $arrBlock['nav_pic_link'][$index] : 'javascript:;',
			);

    		}

    	#	Debug::pr($arrIndexPics);


    		function showPic($idx, $arrIndexPics) {

    		#	$arrIndexPics = $GLOBALS['arrIndexPics'];

			return	sprintf('<div id="big_ad%d" class="big_ad" style="%s"><a href="%s"><img src="%s" border="0"></a></div>',
					$idx,
					($idx > 1 ? 'display:none;' : ''),
					$arrIndexPics[$idx]['link'],
					$arrIndexPics[$idx]['src']

				);

    		}
#



    	?>

	<!--
        <div id="big_ad1" class="big_ad" style=""><a href="http://www.leakon.com/?1"><img src="/images/flash944x300.jpg"border="0"></a></div>
        -->


        <?php

        	echo	showPic(1, $arrIndexPics);
        	echo	showPic(2, $arrIndexPics);
        	echo	showPic(3, $arrIndexPics);
        	echo	showPic(4, $arrIndexPics);

        ?>

        <!--
        <div id="big_ad2" class="big_ad" style="display:none;"><a href="javascript:;"><img src="/images/bigpic.jpg" border="0"></a></div>
        <div id="big_ad3" class="big_ad" style="display: none;"><a href="javascript:;"><img src="/images/bigpic2.jpg" border="0"></a></div>
        <div id="big_ad4" class="big_ad" style="display: none;"><a href="javascript:;"><img src="/images/bigpic4.jpg" border="0"></a></div>

        -->



        <div id="btn_showad1" class="btn_show_ad"><img src="/images/btn_bigad_num1.gif" border="0" /></div>
        <div id="btn_showad2" class="btn_show_ad"><img src="/images/btn_bigad_num2.gif" border="0" /></div>
        <div id="btn_showad3" class="btn_show_ad"><img src="/images/btn_bigad_num3.gif" border="0" /></div>
        <div id="btn_showad4" class="btn_show_ad"><img src="/images/btn_bigad_num4.gif" border="0" /></div>

    </div>

        <?php else : ?>


        <div class="banner137"><img src="/images/banner942x137.jpg" width="942" height="137" /></div>


	<?php endif ?>


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
