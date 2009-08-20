
        <div class="breadCrumb">

        <?php

		$strSideBarNavTitle	= '';
		$reqCategoryId		= (int) $sf_request->getParameter('id', 0);

        	$arrNavHtml	= array();

        	foreach ($arrNavPath as $obj) {

        		$arrNavHtml[]	= sprintf('<a href="%s">%s</a>', url_for('category/list?id=' . $obj->id), $obj->name);

			if ($reqCategoryId == $obj->id) {
				$strSideBarNavTitle	= $obj->name;
			}


        	}


        ?>

            <a href="/">首页</a> &gt; <?php echo implode(' &gt; ', $arrNavHtml) ?>
          </div><!-- end breadCrumb -->

        <div class="content944">
          <div class="sideNav">
            <h3><?php echo S::E($strSideBarNavTitle) ?></h3>
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



<?php if (isset($categoryItem)) : ?>


          <div class="textBlock">

          	<?php

          #	Debug::pr($categoryItem);

          	echo	$categoryItem->description;

          	?>



          </div>
          <!-- end textBlock -->
<?php endif ?>


          </div>

        </div><!-- end content944 -->





