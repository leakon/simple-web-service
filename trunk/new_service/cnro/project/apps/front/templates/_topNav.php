

<ul id="nav" >

		<li class="<?php echo S::curr(0 == $cateId, 'current') ?>"><a href="<?php echo url_for('@homepage') ?>">首页</a></li>
          	<?php

		$conf	= array(
				'type'	=> CnroConstant::CATEGORY_TYPE_NEWS,
				'limit'	=> 5
			);

		$arrTopNavCategories		= Table_categories::getByParent(0, $conf);

          	foreach ($arrTopNavCategories as $key => $objCategory) {

          		$child		= Table_categories::getByParent($objCategory->id, $conf);

          		$strHtml	= '';
          		$arrLi		= array();
          		foreach ($child as $childKey => $childCate) {

	          		$arrLi[]	= sprintf('<li><a href="%s">%s</a></li>',
	          					url_for('category/list?id=' . $childCate->id),
	          					$childCate->name
	          				);

          		}

          		if (count($arrLi)) {
          			$strHtml	= '<ul>' . implode('', $arrLi) . '</ul>';
          		}

          		echo	sprintf('<li class="%s"><a href="%s">%s</a>%s</li>',
          					S::curr($objCategory->id == $cateId, 'current'),
          					url_for('category/list?id=' . $objCategory->id),
          					$objCategory->name, $strHtml
          				);

          	}





          	?>


<?php

$class			= '';

$override_category_id	= sfConfig::get('override_category_id', false);

if (-1 == $override_category_id) {
	$class		= 'class="current"';
}



?>

  <li <?php echo $class ?>><a href="<?php echo url_for('portal/partner') ?>" >商务合作</a>
    <ul>
      <li><a href="<?php echo url_for('portal/partner') ?>">合作伙伴</a></li>
      <li><a href="<?php echo url_for('portal/contact') ?>">联系我们</a></li>

    </ul>
  </li>

  <li><a href="#" >加入我们</a>
    <ul>
      <li><a href="#">招聘信息</a></li>
      <li><a href="#">人才理念</a></li>
      <li><a href="#">酬薪福利</a></li>
    </ul>
  </li>




        </ul>
