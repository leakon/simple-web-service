
        <?php

		$strSideBarNavTitle	= '';

        	$arrNavHtml	= array();

        	foreach ($arrNavPath as $obj) {

			if ($obj->id) {
				$url		= url_for('category/range?id=' . $obj->id);
			} else {
				$url		= url_for('category/range');
			}

        		$arrNavHtml[]	= sprintf('<a href="%s">%s</a>', $url, $obj->name);

			if ('' === $strSideBarNavTitle) {
				$strSideBarNavTitle	= $obj->name;

			}

        	}

        	$count			= count($arrNavPath);

        ?>

    <div id="content2">


      <div class="sideNav">
        <ul>
          <li class="current"><a href="<?php echo url_for_2('category/range') ?>"><?php echo S::E($strSideBarNavTitle) ?></a></li>


		<?php

		$arrSubCateTitle	= array();

		$cateId		= (int) $sf_request->getParameter('id', 0);
	#	Debug::pr($arrRanges);

		foreach ($arrSubCategories as $id => $name) {

          		echo	sprintf('<li><a href="%s" %s>%s</a></li>',
          					url_for('category/range?id=' . $id),
          					$cateId == $id ? 'class="now"' : '',
          					$name
          				);

          		$arrSubCateTitle[$id]	= $name;

		}

		?>


        </ul>

      </div><!-- end sideNav -->


      <div class="right">


<?php

if ($isFinalCategory) {
#	Debug::pr($isFinalCategory);


#	$objRange	= $arrSubArticles[$cateId];
#	Debug::pr($arrFinalCategory);

}



?>


<?php if ($isFinalCategory) : ?>
<?php

// 最终的领域

?>


<?php

$defaultPic	= '/en/images/banner590x180_ng.jpg';

if ($arrFinalCategory['banner_pic']) {
	$defaultPic	= $arrFinalCategory['banner_pic'];
}

?>

       <div class="banner590"><img src="<?php echo $defaultPic ?>" width="591" xheight="180" /></div>
        <div class="blank20"></div>

        <div class="blockC">

          <h3><?php echo S::E($arrFinalCategory['name']) ?></h3>

          <p><?php echo S::E($arrFinalCategory['description']) ?></p>

          <p class="txt_r"><a href="<?php echo url_for_2('category/product?id=' . $arrFinalCategory['id']) ?>"><img src="/en/images/btn190x25.jpg" width="190" height="25" alt="see more products"/></a></p>


        </div><!-- end blockA -->

<?php else : ?>

<?php

// 分类列表

?>

<?php if (isset($arrObjSubCate)) : ?>
      <div class="banner590"><img src="/en/images/banner590x180_products.jpg" width="591" height="180" /></div>
        <div class="blank20"></div>

        <div class="blockE">

<?php foreach ($arrObjSubCate as $categoryInfo) : ?>
          <h3><a href="<?php echo url_for_2('category/range?id=' . $categoryInfo['id']) ?>"><?php echo S::E($categoryInfo['name']) ?></a></h3>

          <p><?php echo S::E($categoryInfo['description']) ?></p>

<?php endforeach ?>

        </div><!-- end blockE -->
      </div><!-- end right -->



<?php endif ?>


<?php endif ?>


    </div><!-- end content -->


<?php

#	Debug::pr(SofavDB_Debug_PDO::getTimer());

