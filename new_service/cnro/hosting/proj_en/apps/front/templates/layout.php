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
<title>Welcome to CNRO The Speciallist of Nitrogen Applications</title>
<link rel="stylesheet" type="text/css" href="/en/css/global1.3.css" />
<link rel="stylesheet" type="text/css" href="/en/css/style_en.css" />
<link rel="stylesheet" type="text/css" href="/en/css/main.css" />

	<script type="text/javascript" src="/en/js/jquery-1.3.1.min.js"></script>
	<script type="text/javascript" language="javascript" src="/en/js/jquery.dropdownPlain.js"></script>
    <script src="/en/js/jquery-1.2.6.min.js" type="text/javascript"></script>
		<script src="/en/js/jquery.easing.1.3.js" type="text/javascript"></script>
		<script src="/en/js/jquery.kwicks-1.5.1.pack.js" type="text/javascript"></script>

		<script type="text/javascript">
			$().ready(function() {
				$('.kwicks').kwicks({
					max : 600,
					spacing : 3
				});
			});
		</script>

<script type="text/javascript" src="/js/function.js?ver=20090822"></script>
</head>

<body>
  <div id="wrapper">
    <div id="header">
      <div class="func_intro" style="text-align:right;">
        <a href="http://cnrotech.com/cn" target="_blank">Chinese</a>
        <!--
        |<a href="#" target="_blank">Site map</a>
        -->
        |<a href="<?php echo url_for_2('portal/contact') ?>">Contact us</a>
      </div>

      <div class="logo">
        <a href="/" target="_blank"><img src="/en/images/logo_en.gif" width="438" height="65" alt="CNRO The Speciallist of Nitrogen Applications" /></a>
      </div>

      <div class="top_search">
        <form method="get" id="searchform" action="<?php echo url_for_2('article/search') ?>" target="_blank">
          <input name="kw" type="text" class="typeIn103" value="<?php echo S::E($sf_request->getParameter('kw', '')) ?>" /><input name="" type="submit" class="btn58" value="" />
        </form>
      </div>

    </div><!-- end header -->

    <div id="mainNav">
      <ul class="dropdown">
        <li><a href="/en/">Home</a></li>
        <li>
          <a href="#">Products &amp; Applications</a>
          <ul class="sub_menu">
            <li><a href="<?php echo url_for_2('category/product') ?>">Products</a></li>
            <li><a href="<?php echo url_for_2('category/range') ?>">Applications</a></li>
          </ul>
        </li>
        <li>

<?php
if (IS_IN_HOSTING) {
	$catId	= 23;
} else {
	$catId	= 1000237;
}

$option				= array('limit' => 4);
$option['to_array']		= true;
$arrResCategories		= Table_categories::getByParent($catId, $option);

?>

          <a href="<?php echo url_for_2('category/list?id=' . $catId) ?>">Our company</a>
          <ul class="sub_menu">

          	<!--
            <li><a href="profile.html">Profile</a></li>
            <li><a href="culture.html">Our culture</a></li>
            <li><a href="honors.html">Our honors</a></li>
            <li><a href="qualification.html">Qualification</a></li>
            	-->

            <?php foreach ($arrResCategories as $cateInfo) : ?>

            <li><a href="<?php echo url_for_2('category/list?id=' . $cateInfo['id']) ?>"><?php echo S::E($cateInfo['name']) ?></a></li>

            <?php endforeach ?>

          </ul>




        </li>
        <li>

<?php
if (IS_IN_HOSTING) {
	$catId	= 19;
} else {
	$catId	= 1000233;
}

$option				= array('limit' => 4);
$option['to_array']		= true;
$arrResCategories		= Table_categories::getByParent($catId, $option);

?>

          <a href="<?php echo url_for_2('category/list?id=' . $catId) ?>">News</a>


          <ul class="sub_menu">

          	<!--
            <li><a href="technology.html">Technology</a></li>
            <li><a href="reports.html">Reports</a></li>
            <li><a href="equipment.html">Equipment</a></li>
            	-->

            <?php foreach ($arrResCategories as $cateInfo) : ?>

            <li><a href="<?php echo url_for_2('category/list?id=' . $cateInfo['id']) ?>"><?php echo S::E($cateInfo['name']) ?></a></li>

            <?php endforeach ?>


          </ul>
        </li>
        <li>
          <a href="javascript:;">Customers</a>
          <ul class="sub_menu">
            <li><a href="<?php echo url_for_2('portal/contact') ?>">Contact us</a></li>
          </ul>
        </li>
        <li>



<?php
if (IS_IN_HOSTING) {
	$catId	= 28;
} else {
	$catId	= 1000242;
}

$option				= array('limit' => 4);
$option['to_array']		= true;
$arrResCategories		= Table_categories::getByParent($catId, $option);

?>

          <a href="<?php echo url_for_2('category/list?id=' . $catId) ?>">Careers</a>

          <ul class="sub_menu">

            <?php foreach ($arrResCategories as $cateInfo) : ?>

            <li><a href="<?php echo url_for_2('category/list?id=' . $cateInfo['id']) ?>"><?php echo S::E($cateInfo['name']) ?></a></li>

            <?php endforeach ?>

          </ul>
        </li>
      </ul><!-- end dropdown -->
    </div><!-- end mainNav -->



<?php

$strModuleName	= $sf_context->getModuleName();
$strActionName	= $sf_context->getActionName();

$strRouting	= $strModuleName . '/' . $strActionName;

if ('portal/index' == $strRouting) :

?>

    <div id="focusBox">

        <ul class="kwicks horizontal" >

        	<!--
			<li id="kwick_1"><a href="#"><img src="/en/images/banner782.jpg" width="600" height="250" /></a></li>
			<li id="kwick_2"><a href="#"><img src="/en/images/banner782_2.jpg" width="600" height="250" /></a></li>
			<li id="kwick_3"><a href="#"><img src="/en/images/banner782_3.jpg" width="600" height="250" /></a></li>
			<li id="kwick_4"><a href="#"><img src="/en/images/banner782_4.jpg" width="600" height="250" /></a></li>
		-->

    	<?php


		$arrBlock	= $objConf->getConf('block');

    		$arrPics	= array(

    				1	=> '/en/images/banner782.jpg',
    				2	=> '/en/images/banner782_2.jpg',
    				3	=> '/en/images/banner782_3.jpg',
    				4	=> '/en/images/banner782_4.jpg',

    				);

    		$arrIndexPics	= array();

    		foreach ($arrPics as $index => $defaultSrc) {

			$arrIndexPics[$index]	= array(
				'src'	=> isset($arrBlock['nav_pic_src'][$index]) ? $arrBlock['nav_pic_src'][$index] : $defaultSrc,
				'link'	=> isset($arrBlock['nav_pic_link'][$index]) ? $arrBlock['nav_pic_link'][$index] : 'javascript:;',
			);

    		}

    		function showPic($idx, $arrIndexPics) {

			return	sprintf('<li id="kwick_%d"><a href="%s"><img src="%s" width="600" height="250" /></a></li>',
					$idx,
					$arrIndexPics[$idx]['link'],
					$arrIndexPics[$idx]['src']

				);

    		}

        	echo	showPic(1, $arrIndexPics);
        	echo	showPic(2, $arrIndexPics);
        	echo	showPic(3, $arrIndexPics);
        	echo	showPic(4, $arrIndexPics);

        ?>






		</ul>

    </div><!-- end focusBox -->

<?php endif ?>

   		 <?php echo $sf_content ?>




    <div class="blank20"></div>

  </div><!-- end wrapper -->
  <div id="footer">
     <p><a href="#">Contact Information</a>|<a href="#">Newsfeeds</a>|<a href="#">Site Map</a>|<a href="#">Privacy</a>|<a href="#">Accessibility</a>|<a href="#">Terms</a>© 2009 CNRO  Company</p>
  </div><!-- end footer -->
</body>
</html>
