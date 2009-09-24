
        <div class="breadCrumb">

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

		$strSideBarNavTitle	= $arrNavPath[$count - 1]->name;


        	#	var_dump($strSideBarNavTitle);

        ?>

            <a href="<?php echo url_for('@homepage') ?>">首页</a> &gt; <?php echo implode(' &gt; ', $arrNavHtml) ?>
          </div><!-- end breadCrumb -->

        <div class="content944">
          <div class="sideNav">

          	<?php

          		if ('产品中心' == $strSideBarNavTitle) {


          		} else {

          		//	$strSideBarNavTitle	.= '设备';

          		}

          	?>
            <h3><?php echo S::E($strSideBarNavTitle) ?></h3>
            <ul class="">
		<?php

		$arrSubCateTitle	= array();

		$cateId		= (int) $sf_request->getParameter('id', 0);
	#	Debug::pr($arrRanges);

		foreach ($arrSubCategories as $id => $name) {

          		echo	sprintf('<li class="%s"><a href="%s">%s</a></li>',
          					S::curr($id == $cateId, 'current'),
          					url_for('category/product?id=' . $id),
          					$name
          				);

          		$arrSubCateTitle[$id]	= $name;

		}

		?>
            </ul>
          </div><!-- end sideNav -->




	<div class="rightD">

<?php if (isset($arrRealSubCategoryList)) : ?>
<table width="0" border="0" cellspacing="0" cellpadding="0" class="productTab">
  <tr>

<?php
	$idx	= 0;
#	foreach ($arrSubArticles as $catId => $articlePager) :
	foreach ($arrRealSubCategoryList as $catId => $oneResult) :

		if ($oneResult['type'] == 400) {
		} else {
			continue;
		}

$oneResult['description'] 	= strip_tags($oneResult['description']);
#Debug::pr($oneResult);

?>

	<?php

	if ($idx && $idx % 2 == 0) {
		echo	'</tr><tr>';
	}

#	$result		= $articlePager->getResults();

	if (!isset($oneResult['id'])) {
		echo	'<td>&nbsp;</td>';
    		$idx++;
		continue;
	}

#	$oneResult	= $result[0];

#	Debug::pr($oneResult);

	?>

    <td  class="" style="vertical-align:top;">
      <div class="cate">
        <div class="pic">

        	<?php if (trim($oneResult['pic'])) : ?>
        	<a href="<?php echo url_for('category/product?id=' . $oneResult['id']) ?>"><img src="<?php echo $oneResult['pic'] ?>" width="146" /></a>
        	<?php endif ?>
        	</div>
        <div class="info">
          <h3><a href="<?php echo url_for('category/product?id=' . $oneResult['id']) ?>"><?php echo S::E($oneResult['name']) ?></a></h3>

          <div>
          	<?php echo (S::TK($oneResult['description'], 100)) ?>
        </div>

          <!--
          <span class="more"><a href="<?php echo url_for('category/product?id=' . $oneResult['id']) ?>" >了解更多内容</a></span>
          -->
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

<?php endif ?>

	</div>


        </div><!-- end content944 -->


<?php

#	Debug::pr(SofavDB_Debug_PDO::getTimer());

