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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
  </head>
  <body>

<div id="wrapper">

  <div id="header">
    <div class="container">
      <div id="top189">
        <div id="topbar">
          <div class="timebar"><?php echo date('Y年n月j日') ?></div>
          <div class="funcLink"><a href="#">设为首页</a> | <a href="#">加入收藏</a> | <a href="#">中英</a> - <a href="#">English</a></div>
        </div>
        <div id="infoBlock"></div>

        	<?php include_partial('global/topNav', array('cateId' => $cateId)) ?>


      </div>
      <!-- end top189 -->
    </div>
    <!-- end container -->
  </div><!-- end header -->





    <?php echo $sf_content ?>






  <div class="container">
      <div class="ft_l"></div>
        <div class="ft_m">
         <p><a href="right">中国林业教育学会</a><a href="#">中国水土保持学会</a><a href="#">中国竹子网</a><a href="#">森林资产评估网</a><a href="#">北京林业大学</a><a href="#">东北林业大学</a><a href="#">南京林业大学</a><a href="#">中林绿化网</a><a href="#">华南农业大学林学院</a><a href="#">西北农林科技大学</a><a href="#">甘肃农业大学林学院</a><a href="#">浙江林学院</a></p>
        </div>
        <div class="ft_r"></div>
    </div>



  <div class="blank10"></div>
  <div id="footer">
    <div class="container">
      <p><span>主办单位：国家林业局林木生物质能源领导小组办公室</span><span>工作信箱:<a href="mailto:sfaeo@sina.com">sfaeo@sina.com</a></span><span> 技术支持: <a href="mailto:webmaster@fbioenergy.gov.cn">webmaster@fbioenergy.gov.cn</a></span></p>
      <div class="blank10"></div>
      <p> 京ICP证号 </p>
    </div>
  </div>
  <!-- end footer -->


</div><!-- end wrapper -->




  </body>
</html>
