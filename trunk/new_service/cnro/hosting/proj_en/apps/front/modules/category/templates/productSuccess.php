
        <?php

		$strSideBarNavTitle	= '';

        	$arrNavHtml	= array();

        	foreach ($arrNavPath as $obj) {

			if ($obj->id) {
				$url		= url_for('category/product?id=' . $obj->id);
			} else {
				$url		= url_for('category/product');
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
          <li class="current"><a href="<?php echo url_for_2('category/product') ?>"><?php echo S::E($strSideBarNavTitle) ?></a></li>


		<?php

		$arrSubCateTitle	= array();

		$cateId		= (int) $sf_request->getParameter('id', 0);
	#	Debug::pr($arrRanges);

		foreach ($arrSubCategories as $id => $name) {

          		echo	sprintf('<li><a href="%s" %s>%s</a></li>',
          					url_for('category/product?id=' . $id),
          					$cateId == $id ? 'class="now"' : '',
          					$name
          				);

          		$arrSubCateTitle[$id]	= $name;

		}

		?>


        </ul>

      </div><!-- end sideNav -->


      <div class="right">


<?php if ($isFinalCategory) : ?>
<?php

	// 产品列表
#	Debug::pr($arrSubArticles);

	$arrResult	= $arrSubArticles[$cateId]->getResults();
#	Debug::pr($arrResult);

#	Debug::pr($arrFinalCategory);

?>


        <div class="intro590">
          <ul class="pt">
            <li>

              <h3><?php echo $arrFinalCategory['name'] ?></h3>
              <p><?php echo S::E($arrFinalCategory['description']) ?></p>
            </li>
          </ul>

        </div>
        <div class="blank20"></div>

        <div class="blockF">

          <ul class="pt">

<?php foreach ($arrResult as $key => $val) : ?>

            <li>
            	<?php if (strlen($val['large_pic']))  : ?>
              <div><a href="<?php echo url_for_2('article/showProduct?id=' . $val['id']) ?>"><img src="<?php echo $val['large_pic'] ?>" width="113" xheight="113" /></a></div>
              	<?php endif ?>
              <h4><a href="<?php echo url_for_2('article/showProduct?id=' . $val['id']) ?>"><?php echo S::E($val['title']) ?></a></h4>
             <!-- <p><?php echo S::TK(strip_tags($val['detail']), 200) ?></p> -->
            </li>

<?php endforeach ?>


          </ul><!-- end pt -->

<!--
          <div class="manu">
            <span class="disabled">
            <  Prev</span>
            <span class="current">1</span>
            <a href="#?page=2">2</a>
            <a href="#?page=3">3</a>
            <a href="#?page=4">4</a>
            <a href="#?page=5">5</a>
            <a href="#?page=6">6</a>
            <a href="#?page=7">7</a>...<a href="#?page=199">199</a>
            <a href="#?page=200">200</a>
            <a href="#?page=2">Next  > </a>
          </div>
-->




        </div><!-- end blockF -->




<?php else : ?>
<?php

// 分类列表

?>

<?php if (isset($arrObjSubCate)) : ?>


<?php

$defaultPic	= '/en/images/banner590x180_products.jpg';

#	Debug::pr($arrFinalCategory);

if ($arrFinalCategory['banner_pic']) {
	$defaultPic	= $arrFinalCategory['banner_pic'];
}

?>

      <div class="banner590"><img src="<?php echo $defaultPic ?>" width="591" xheight="180" /></div>
        <div class="blank20"></div>

        <div class="blockE">

<?php foreach ($arrObjSubCate as $categoryInfo) : ?>
          <h3><a href="<?php echo url_for_2('category/product?id=' . $categoryInfo['id']) ?>"><?php echo S::E($categoryInfo['name']) ?></a></h3>

          <p><?php echo S::E($categoryInfo['description']) ?></p>

<?php endforeach ?>

        </div><!-- end blockE -->
      </div><!-- end right -->




<?php endif ?>

<?php endif ?>


    </div><!-- end content -->


<?php

#	Debug::pr(SofavDB_Debug_PDO::getTimer());

