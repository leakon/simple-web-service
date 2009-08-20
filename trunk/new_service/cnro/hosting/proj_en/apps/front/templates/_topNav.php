<?php

$objConf	= new Custom_Conf();
$arrDataConf	= $objConf->getConf();

#var_dump($arrDataConf['block']['nav_num']);

		$option			= array('limit' => 1000);
		$option['to_array']	= true;
		$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_RANGE;
		$res			= Table_categories::getByParent(0, $option);
		$arrRanges		= Array_Util::ColToPlain($res, 'id', 'name');

	#	Debug::pr($arrRanges);

		$strActName		= $sf_context->getActionName();

		if ('showProduct' == $strActName) {
			$strActName	= 'product';
		}

		$arrNavSpecial		= array(

						'product'	=> '产品中心',
						'range'		=> '应用领域',

					);



		$arrSpecial		= array();

		foreach ($arrNavSpecial as $type => $cnType) {

			$arrLi		= array();

			foreach ($arrRanges as $id => $name) {

	          		$arrLi[]	= sprintf('<li><a href="%s">%s</a></li>',
	          					url_for('category/'.$type.'?id=' . $id),
	          					$name
	          				);

	          	}

          		if (count($arrLi)) {
          			$strHtml	= '<ul>' . implode('', $arrLi) . '</ul>';
          		}

			/*
          		$arrSpecial[$type]	= sprintf('<li class="%s"><a href="%s">%s</a>%s</li>',
	          					S::curr($type == $strActName, 'current'),
	          					url_for('category/' . $type),
	          					$cnType, $strHtml
	          				);
	          	*/


          		$arrSpecial[$type]	= sprintf('<li class="%s"><a href="javascript:;">%s</a>%s</li>',
	          					S::curr($type == $strActName, 'current'),
	          				#	url_for('category/' . $type),
	          					$cnType, $strHtml
	          				);




	          	if ($type == $strActName) {
	          		$cateId		= (int) $sf_request->getParameter('id', -1982);
	          	}

		}


	#	Debug::pre($arrSpecial);


?>

<ul id="nav" >

		<li class="<?php echo S::curr(0 == $cateId, 'current') ?>"><a href="<?php echo url_for('@homepage') ?>">首页</a></li>
          	<?php

		$conf	= array(
				'type'	=> CnroConstant::CATEGORY_TYPE_NEWS,
				'limit'	=> intval($arrDataConf['block']['nav_num'])
			);

		$arrTopNavCategories		= Table_categories::getByParent(0, $conf);

		$index		= 1;

          	foreach ($arrTopNavCategories as $key => $objCategory) {

          		if (isset($arrDataConf['block']['product_pos']) && $arrDataConf['block']['product_pos'] == $index) {
				echo	$arrSpecial['product'];
				$index++;
          		}
          		if (isset($arrDataConf['block']['range_pos']) && $arrDataConf['block']['range_pos'] == $index) {
				echo	$arrSpecial['range'];
				$index++;
          		}

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

			/*
          		echo	sprintf('<li class="%s"><a href="%s">%s</a>%s</li>',
          					S::curr($objCategory->id == $cateId, 'current'),
          					url_for('category/list?id=' . $objCategory->id),
          					$objCategory->name, $strHtml
          				);
          		*/

          		echo	sprintf('<li class="%s"><a href="javascript:;">%s</a>%s</li>',
          					S::curr($objCategory->id == $cateId, 'current'),
          				#	url_for('category/list?id=' . $objCategory->id),
          					$objCategory->name, $strHtml
          				);

          		$index++;

          	}





          	?>


<?php

$class			= '';

$override_category_id	= sfConfig::get('override_category_id', false);

if (-1 == $override_category_id) {
	$class		= 'class="current"';
}



?>

<!--
  <li <?php echo $class ?>><a href="<?php echo url_for('portal/partner') ?>" >商务合作</a>
-->
  <li <?php echo $class ?>><a href="javascript:;" >商务合作</a>
    <ul>
      <li><a href="<?php echo url_for('portal/partner') ?>">合作伙伴</a></li>
      <li><a href="<?php echo url_for('portal/contact') ?>">联系我们</a></li>

    </ul>
  </li>




        </ul>
