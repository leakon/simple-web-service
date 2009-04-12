
  <div id="sandwich">

    <div class="container">
      <div id="breadCrumb">
        <div class="bcL"></div>

        <?php

        	$arrNavHtml	= array();

        	foreach ($arrNavPath as $obj) {

        		$arrNavHtml[]	= sprintf('<a href="%s">%s</a>', url_for('category/list?id=' . $obj->id), $obj->name);

        	}


        ?>
	<div class="bcM"><a href="/">首页</a> &gt; <?php echo implode(' &gt; ', $arrNavHtml) ?> </div>
        <div class="bcR"></div>
      </div><!-- end breadCrumb -->
    </div>




    <div class="container">

        <div class="left">
          <div class="sidebar">
            <div class="top"></div>
            <ul class="subNav">
		<?php

		$arrSubCateTitle	= array();

		$cateId		= (int) $sf_request->getParameter('id', 0);

		foreach ($arrSubCategories as $key => $objSubCategory) {

          		echo	sprintf('<li class="%s"><a href="%s">%s</a></li>',
          					S::curr($objSubCategory->id == $cateId, 'current'),
          					url_for('category/list?id=' . $objSubCategory->id),
          					$objSubCategory->name
          				);

          		$arrSubCateTitle[$objSubCategory->id]	= $objSubCategory->name;

		}

		?>
            </ul>
            <div class="bot"></div>
          </div>
          <!-- end sidebar -->
        </div>
        <!-- end left -->


        <div class="right">
          <div class="top"></div>


<?php if (0) : ?>
          <div class="textBlock">
            <div class="titlebar">科技支撑</div>
            <div class="blank10"></div>
            <div class="blank10"></div>

           <ul class="list14">
             <li><a href="#" target="_blank">马来西亚生物柴油年产能在90.2万吨(产业动态-生物柴油)</a></li>
             <li><a href="#" target="_blank">马来西亚生物柴油年产能在90.2万吨(产业动态-生物柴油)</a></li>
             <li><a href="#" target="_blank">马来西亚生物柴油年产能在90.2万吨(产业动态-生物柴油)</a></li>
             <li><a href="#" target="_blank">马来西亚生物柴油年产能在90.2万吨(产业动态-生物柴油)</a></li>
             <li><a href="#" target="_blank">马来西亚生物柴油年产能在90.2万吨(产业动态-生物柴油)</a></li>
           </ul>

           <div class="blank10"></div>
           <div class="blank10"></div>

           <div class="pageBar">
             <a href="#" class="current">[1]</a> <a href="#">[2]</a> <a href="#">[3]</a> <a href="#">[4]</a>  <a href="#">第1页</a>  <a href="#">共4页</a>
           </div>

          </div>
          <!-- end textBlock -->
<?php endif ?>


<?php if (isset($arrSubArticles)) : ?>
<?php foreach ($arrSubArticles as $catId => $articlePager) : ?>


          <div class="textBlock">
            <div class="titlebar"><?php echo $arrSubCateTitle[$catId] ?></div>
            <div class="blank10"></div>
            <div class="blank10"></div>

           <ul class="list14">
           	<?php foreach ($articlePager->getResults() as $key => $val) : ?>

             		<li><a href="<?php echo url_for('article/show?id=' . $val['id']) ?>" target="_blank"><?php echo S::E($val['title']) ?></a></li>

           	<?php endforeach ?>

           </ul>

           <div class="blank10"></div>
           <div class="blank10"></div>

<!--
           <div class="pageBar">
             <a href="#" class="current">[1]</a> <a href="#">[2]</a> <a href="#">[3]</a> <a href="#">[4]</a>  <a href="#">第1页</a>  <a href="#">共4页</a>
           </div>
-->

		<?php if ($intSubCateId) : ?>

		           <div class="pageBar">
		<?php

		$uri	= $articlePager->getPageUri();
		$action	= $sf_context->getActionName();

		include_partial('global/pager', array('pager' => $articlePager, 'pageUri' => $uri));

		?>
		           </div>
		<?php endif ?>

          </div>
          <!-- end textBlock -->
<?php endforeach ?>
<?php endif ?>







          <div class="bot"></div>
        </div>





    </div><!-- end container -->
    <div class="blank10"></div>





  </div><!-- end sandwich -->