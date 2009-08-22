
    <div id="content2">


        <?php

        	$arrNavHtml	= array();

        	foreach ($arrNavPath as $obj) {

        		$arrNavHtml[]	= sprintf('<a href="%s">%s</a>', url_for('category/list?id=' . $obj->id), $obj->name);

        	}


        ?>

      <div class="sideNav">
        <ul>
          <li class="current"><a href="javascript:;"><?php echo S::E($strSideBarNavTitle) ?></a></li>
		<?php

		$arrSubCateTitle	= array();

	#	$cateId		= (int) $sf_request->getParameter('id', 0);
		$cateId		= $intSubCateId;

		foreach ($arrSubCategories as $key => $objSubCategory) {

          		echo	sprintf('<li><a  class="%s" href="%s">%s</a></li>',
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


        <div class="blockC">

		<h3><?php echo S::E($articleItem->title) ?></h3>

		<div class="subInfo"> <span>views：<?php echo $articleItem->view_cnt ?></span> <span>published at：<?php echo substr($articleItem->published_at, 0, 10); ?></span> </div>

		<?php if ($articleItem->pic) : ?>
		<div style="margin:4px auto; widht:200px;">
			<img src="<?php echo $articleItem->pic ?>" />
		</div>
		<?php endif ?>


		<div style="margin:18px 0;">
			<?php echo $articleItem->detail ?>

		</div>

          </div>

  </div>


        </div><!-- end content944 -->





