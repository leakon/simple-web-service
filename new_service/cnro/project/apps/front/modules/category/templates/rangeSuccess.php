
        <div class="breadCrumb">

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

	#	$strSideBarNavTitle	= $arrNavPath[$count - 1]->name;

        ?>

            <a href="<?php echo url_for('@homepage') ?>">首页</a> &gt; <?php echo implode(' &gt; ', $arrNavHtml) ?>
          </div><!-- end breadCrumb -->

        <div class="content944">
          <div class="sideNav">
            <h3><?php echo S::E($strSideBarNavTitle) ?></h3>
            <ul class="">
		<?php

		$arrSubCateTitle	= array();

		$cateId		= (int) $sf_request->getParameter('id', 0);
	#	Debug::pr($arrRanges);

		foreach ($arrSubCategories as $id => $name) {

          		echo	sprintf('<li class="%s"><a href="%s">%s</a></li>',
          					S::curr($id == $cateId, 'current'),
          					url_for('category/range?id=' . $id),
          					$name
          				);

          		$arrSubCateTitle[$id]	= $name;

		}

		?>
            </ul>
          </div><!-- end sideNav -->



	<?php if ($reqId == 0 && isset($arrObjSubCate)) : ?>

          <div class="rightD">
<table width="0" border="0" cellspacing="0" cellpadding="0" class="productTab">

<tr>
	<?php
		$idx	= 0;
		foreach ($arrObjSubCate as $obj) : ?>

	<?php

		if ($idx && $idx % 2 == 0) {
			echo	'</tr><tr>';
		}

	?>

    <td class="" style="vertical-align:top;">
      <div class="cate">
        <div class="pic"><img src="<?php echo $obj['pic'] ?>" width="150" alt="<?php echo S::E($obj['name']) ?>" /></div>
        <div class="info2">
          <h3><?php echo S::E($obj['name']) ?></h3>
          <p><?php

          #	echo $obj['description'];

          	$desc	= strip_tags($obj['description']);

          	echo	S::TK($desc, 128);


          	?></p>
          <span class="more"><a href="<?php echo url_for('category/range?id=' . $obj['id']) ?>" >了解更多内容</a></span>
        </div>
      </div>
    </td>

    	<?php
    	$idx++;
    	?>

	<?php endforeach ?>

	<?php

	if ($idx % 2 == 1) {
		echo	'<td>&nbsp;</td>';
	}

	?>

</tr>

</table>


          </div>


	<?php else : ?>


		<?php if ($reqId && isset($arrObjSubCate) && count($arrObjSubCate)) : ?>

	          <div class="rightC">

	        <?php
	        	if ($objCategory->id) {
	        		echo	$objCategory->description;
	        	}
          	?>


		<?php if ($objCategory->show_relate) : ?>


	            <h3><?php echo sprintf('<a href="%s">%s</a>', url_for('category/product?id=' . $objCategory->id), S::E($objCategory->show_relate)) ?></h3>

	            <ul class="list14">
			<?php foreach ($arrObjSubCate as $obj) : ?>
	              <li><a href="<?php echo url_for('category/product?id=' . $obj['id']) ?>"><?php echo $obj['name'] ?></a></li>
	              	<?php endforeach ?>

	            </ul>

	        <?php endif ?>



	          </div>
	        <?php endif ?>

	<?php endif ?>


        </div><!-- end content944 -->

