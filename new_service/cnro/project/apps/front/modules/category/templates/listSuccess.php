
        <div class="breadCrumb">

        <?php

        	$arrNavHtml	= array();

        	foreach ($arrNavPath as $obj) {

        		$arrNavHtml[]	= sprintf('<a href="%s">%s</a>', url_for('category/list?id=' . $obj->id), $obj->name);

        	}


        ?>

            <a href="/">首页</a> &gt; <?php echo implode(' &gt; ', $arrNavHtml) ?>
          </div><!-- end breadCrumb -->

        <div class="content944">
          <div class="sideNav">
            <ul class="">
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
          </div><!-- end sideNav -->


          <div class="rightC">



<?php if (isset($arrSubArticles)) : ?>
<?php foreach ($arrSubArticles as $catId => $articlePager) : ?>


          <div class="textBlock">
            <div class="titlebar"><h3><?php echo $arrSubCateTitle[$catId] ?></h3></div>

            <ul class="newsList">
           	<?php foreach ($articlePager->getResults() as $key => $val) : ?>

             		<li><span class="date"><?php echo substr($val['published_at'], 0, 10) ?></span><a href="<?php echo url_for('article/show?id=' . $val['id']) ?>" target="_blank"><?php echo S::E($val['title']) ?></a></li>

           	<?php endforeach ?>

           </ul>

           <div class="blank10"></div>
           <div class="blank10"></div>

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


          </div>

        </div><!-- end content944 -->





