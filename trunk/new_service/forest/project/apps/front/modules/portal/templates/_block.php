<?php

$categoryId		= isset($conf['block']['cate_' . $from]['sub']) ?
				$conf['block']['cate_' . $from]['sub'] : $default;

$picUrl			= isset($conf['block']['cate_' . $from]['pic']) ?
				$conf['block']['cate_' . $from]['pic'] : '';

$categoryItem		= new Table_categories($categoryId);

$arrArticles		= $data[$categoryId];

$boxClass		= $pos == 'left' ? 'box320' : 'box330';

?>


          <div class="<?php echo $boxClass ?>">
            <h3><?php echo S::E($categoryItem->name) ?><span class="more"><a href="<?php echo url_for('category/list?id=' . $categoryId) ?>" target="_blank">更多&gt;&gt;</a></span></h3>

	<?php if ($picUrl) : ?>


            <div class="pt">
              <div class="l_pic">
                <a href="<?php echo url_for('category/list?id=' . $categoryId) ?>" target="_blank"><img src="<?php echo $picUrl ?>" width="98" height="98" /></a>
              </div>
              <ul>
                <?php

                	foreach ($arrArticles as $key => $val) {

	                	echo	sprintf(
	                			'<li><a href="%s" target="_blank">%s</a></li>' . "\n",

						url_for('article/show?id=' . $val['id']),
						S::TK($val['title'], 26)

	                			);

	                }
                ?>
              </ul>
            </div>


	<?php else : ?>


            <div class="list12">
              <ul>
                <?php

                	foreach ($arrArticles as $key => $val) {

	                	echo	sprintf(
	                			'<li><a href="%s" target="_blank">%s</a></li>' . "\n",

						url_for('article/show?id=' . $val['id']),
						S::TK($val['title'], 42)

	                			);

	                }
                ?>
              </ul>
            </div>


	<?php endif ?>






          </div><!-- end box320 -->