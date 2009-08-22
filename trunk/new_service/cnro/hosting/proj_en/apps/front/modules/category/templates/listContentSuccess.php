

    <div id="content2">

        <?php

		$strSideBarNavTitle	= '';
		$reqCategoryId		= (int) $sf_request->getParameter('id', 0);

	#	var_dump($arrNavPath);

        	$arrNavHtml	= array();

        	foreach ($arrNavPath as $obj) {

        		$arrNavHtml[]	= sprintf('<a href="%s">%s</a>', url_for('category/list?id=' . $obj->id), $obj->name);

			/*
			if ($reqCategoryId == $obj->id) {
				$strSideBarNavTitle	= $obj->name;
			}
			*/


			if ('' === $strSideBarNavTitle) {
				$strSideBarNavTitle	= $obj->name;
			}


        	}





        ?>
      <div class="sideNav">
        <ul>
          <li class="current"><a href="<?php echo url_for_2('category/list?id=' . $reqCategoryId) ?>"><?php echo S::E($strSideBarNavTitle) ?></a></li>

		<?php

		$arrSubCateTitle	= array();

	#	$cateId		= (int) $sf_request->getParameter('id', 0);
		$cateId		= $intSubCateId;

		foreach ($arrSubCategories as $key => $objSubCategory) {

          		echo	sprintf('<li><a class="%s" href="%s">%s</a></li>',
          					S::curr($objSubCategory->id == $cateId, 'now'),
          					url_for('category/list?id=' . $objSubCategory->id),
          					$objSubCategory->name
          				);

          		$arrSubCateTitle[$objSubCategory->id]	= $objSubCategory->name;

		}

		?>
        </ul>

      </div><!-- end sideNav -->







      <div class="right">



<?php

$defaultPic	= '/en/images/banner590x180_news.jpg';

if ($categoryItem->banner_pic) {
	$defaultPic	= $categoryItem->banner_pic;
}

?>

        <div class="banner590"><img src="<?php echo $defaultPic ?>" width="590" xheight="180" alt="news" /></div>
        <div class="blank20"></div>




        <div class="blockB">

          	<?php

          #	Debug::pr($categoryItem);

          	echo	$categoryItem->description;

          	?>

        </div><!-- end blockB -->


      </div><!-- end right -->



    </div><!-- end content -->




























