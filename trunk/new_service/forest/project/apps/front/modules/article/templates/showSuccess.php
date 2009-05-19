
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

	#	$cateId		= (int) $sf_request->getParameter('id', 0);
		$cateId		= $intSubCateId;

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
          <div class="textBlock">

            <h3><?php echo S::E($articleItem->title) ?></h3>

            <div class="subInfo"> <span>浏览次数：<?php echo $articleItem->view_cnt ?></span> <span>发布日期：<?php echo substr($articleItem->published_at, 0, 10); ?></span> </div>


	<?php if ($articleItem->pic) : ?>
	<div>
		<img src="<?php echo $articleItem->pic ?>" />
	</div>
	<?php endif ?>


	<div>

		<?php echo $articleItem->detail ?>

	</div>




            <div class="goTop"><span><a href="#"><img src="/images/topBtn.png" border="0" /></a></span>
                <p></p>
            </div>
          </div>
          <!-- end textBlock -->
          <div class="bot"></div>
        </div>





    </div><!-- end container -->
    <div class="blank10"></div>



  </div><!-- end sandwich -->

