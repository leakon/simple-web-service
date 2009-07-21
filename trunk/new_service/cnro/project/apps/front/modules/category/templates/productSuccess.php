
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

	#	$strSideBarNavTitle	= $arrNavPath[$count - 1]->name;


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



<?php
#########################################################
if (!$reqId) :
#########################################################
?>

	<div class="rightD">

<?php if (isset($arrSubArticles)) : ?>
<table width="0" border="0" cellspacing="0" cellpadding="0" class="productTab">
  <tr>

<?php
	$idx	= 0;
	foreach ($arrSubArticles as $catId => $articlePager) : ?>

	<?php

	if ($idx && $idx % 2 == 0) {
		echo	'</tr><tr>';
	}

	$result		= $articlePager->getResults();

	if (!isset($result[0])) {
		echo	'<td>&nbsp;</td>';
    		$idx++;
		continue;
	}

	$oneResult	= $result[0];

#	Debug::pr($oneResult);

	?>

    <td  class="" style="vertical-align:top;">
      <div class="cate">
        <div class="pic"><img src="<?php echo $oneResult['large_pic'] ?>" width="146" /></div>
        <div class="info">
          <h3><?php echo S::E($oneResult['title']) ?></h3>
          <ul class="list12" style="xbackground:red; clear:both;">
          	<?php foreach ($arrSubRange[$catId] as $id => $name) : ?>
            <li><a href="<?php echo url_for('category/product?id=' . $id) ?>"><?php echo $name ?></a></li>
            	<?php endforeach ?>
          </ul>
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

<?php
#########################################################
else :
#########################################################
?>
          <div class="rightD">

<?php

#	Debug::pr($arrSubCategories);

?>


<?php if (isset($arrSubArticles)) : ?>
<?php foreach ($arrSubArticles as $catId => $articlePager) : ?>

            <div class="title"><?php echo $strSideBarNavTitle ?></div>

            <ul class="product_list">
           	<?php foreach ($articlePager->getResults() as $key => $val) : ?>
              <li>
                <span class="tit"><?php echo S::E($val['title']) ?></span>
                <div><a href="<?php echo url_for('article/showProduct?id=' . $val['id']) ?>" target="_blank"><img src="<?php echo $val['large_pic'] ?>" width="102"  /></a></div>
                <p>
                <?php


          	$desc	= strip_tags($val['detail']);
          	echo	S::TK($desc, 64);

                ?></p>

                <!--
                <span class="more"><a href="<?php echo url_for('article/showProduct?id=' . $val['id']) ?>" target="_blank">更多内容&gt;&gt;</a></span>
                -->

              </li>
           	<?php endforeach ?>
            </ul>

		<?php if ($reqId) : ?>
          		  <div class="pagebar">
		<?php

		$uri	= $articlePager->getPageUri();
		$action	= $sf_context->getActionName();

		include_partial('global/pager', array('pager' => $articlePager, 'pageUri' => $uri));

		?>
		           </div>
		<?php endif ?>

          <!-- end textBlock -->
<?php endforeach ?>
<?php endif ?>


          </div>


<?php
#########################################################
endif
#########################################################
?>

        </div><!-- end content944 -->


<?php

#	Debug::pr(SofavDB_Debug_PDO::getTimer());

