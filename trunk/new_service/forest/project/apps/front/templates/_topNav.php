
<ul id="nav" >
        	<?php if (0) : ?>
          <li class="current"><a href="#" target="_blank">首页</a></li>
          	<?php endif ?>

		<li class="<?php echo S::curr(0 == $cateId, 'current') ?>"><a href="/">首页</a></li>
          	<?php

          	foreach (Table_categories::getByParent(0, 8) as $key => $objCategory) {

          		echo	sprintf('<li class="%s"><a href="%s">%s</a></li>',
          					S::curr($objCategory->id == $cateId, 'current'),
          					url_for('category/list?id=' . $objCategory->id),
          					$objCategory->name
          				);

          	}

          	?>
        </ul>
