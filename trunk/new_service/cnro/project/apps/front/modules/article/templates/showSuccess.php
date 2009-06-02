
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

          </div>

        </div><!-- end content944 -->





