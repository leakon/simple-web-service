
<ul id="nav" >
        	<?php if (0) : ?>
          <li class="current"><a href="#" target="_blank">首页</a></li>
          	<?php endif ?>

		<li class="<?php echo S::curr(0 == $cateId, 'current') ?>"><a href="/">首页</a></li>
          	<?php

		$conf	= array(
				'type'	=> CnroConstant::CATEGORY_TYPE_NEWS,
				'limit'	=> 9
			);

          	foreach (Table_categories::getByParent(0, $conf) as $key => $objCategory) {

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
        </ul>
