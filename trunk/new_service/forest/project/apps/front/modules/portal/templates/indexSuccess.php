
<?php

	Custom_Homepage::setDataConf($arrDataConf);

#	Debug::pr($arrDataConf);

#	$res		= Table_articles::getByCategory(1000016);

#	Debug::pr(SofavDB_Debug_PDO::getTimer());



#	Debug::pr($res);

	$arrPartial	= array(
				'conf'			=> $arrDataConf,
				'data'			=> $arrDataRes,
				'default'		=> $defaultCategoryId,
				'from'			=> '',
			);

	$conf		=& $arrDataConf;
	$data		=& $arrDataRes;
	$default	=& $defaultCategoryId;


?>


  <div id="sandwich">

    <div class="container">
      <div class="blank10"></div>
      <div id="left660">

        <div id="focusBox">
          <div class="l"></div>
          <div class="m">
            <div id="fb">

<?php

		// -----------------------------------
		$from			= 'focus';

		$categoryId		= isset($conf['block']['cate_' . $from]['sub']) ?
						$conf['block']['cate_' . $from]['sub'] : $default;

		$picUrl			= isset($conf['block']['cate_' . $from]['pic']) ?
						$conf['block']['cate_' . $from]['pic'] : '';

		$categoryItem		= new Table_categories($categoryId);

		$arrArticles		= $data[$categoryId];

		$parentCategory		= new Table_categories($categoryItem->parent_id);

		$arrTitle		= array();
		$arrUrl			= array();
		$arrPic			= array();

		foreach ($arrArticles as $key => $val) {

			$title		= S::E($val['title']);
			$url		= url_for('article/show?id=' . $val['id']);
			$pic		= strlen($val['pic']) ? $val['pic'] : '/images/05.jpg';


			$arrTitle[$key]		= $title;
			$arrUrl[$key]		= $url;
			$arrPic[$key]		= $pic;

		}

		$strTitle		= implode('|', $arrTitle);
		$strUrl			= implode('|', $arrUrl);
		$strPic			= implode('|', $arrPic);


		/*
		$arrFiles		= array();

		for ($i = 1; $i <= 5; $i++) {
			$arrFiles[$i]	= '/images/0' . $i . '.jpg';
		}

		$arrFiles[2]		= '/images/fb310x180.jpg';
		$arrFiles[1]		= '/images/pic98x98.jpg';
		*/


?>




              <script type=text/javascript>
var swf_width=290
var swf_height=160
var config='5|0xffffff|0x0099ff|50|0xffffff|0x0099ff|0x000000'
// config 设置分别为: 自动播放时间(秒)|文字颜色|文字背景色|文字背景透明度|按键数字色|当前按键色|普通按键色

var files='<?php echo $strPic ?>';
var links='<?php echo $strUrl ?>';
var texts='<?php echo $strTitle ?>';


document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ swf_width +'" height="'+ swf_height +'">');
document.write('<param name="movie" value="/flash/focus_2.swf" />');
document.write('<param name="quality" value="high" />');
document.write('<param name="menu" value="false" />');
document.write('<param name=wmode value="opaque" />');
document.write('<param name="FlashVars" value="config='+config+'&bcastr_flie='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'" />');
document.write('<embed src="/flash/focus_2.swf" wmode="opaque" FlashVars="config='+config+'&bcastr_flie='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'& menu="false" quality="high" width="'+ swf_width +'" height="'+ swf_height +'" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />');
document.write('</object>');
</script>

            </div>




<?php

		// -----------------------------------
		$from			= 'head';

		$categoryId		= isset($conf['block']['cate_' . $from]['sub']) ?
						$conf['block']['cate_' . $from]['sub'] : $default;

		$picUrl			= isset($conf['block']['cate_' . $from]['pic']) ?
						$conf['block']['cate_' . $from]['pic'] : '';

		$categoryItem		= new Table_categories($categoryId);

		$arrArticles		= $data[$categoryId];

		$parentCategory		= new Table_categories($categoryItem->parent_id);


#	Debug::pr(SofavDB_Debug_PDO::getTimer());

?>




            <div id="fb_l">
              <h3><?php echo S::E($categoryItem->name) ?></h3>
              <div class="blank10"></div>
              <ul class="list12">
                <?php

                	foreach ($arrArticles as $key => $val) {


	                	echo	sprintf(
	                			'<li><a href="%s" target="_blank">%s</a></li>' . "\n",

						url_for('article/show?id=' . $val['id']),
						S::TK($val['title'], 43)

	                			);

	                }
                ?>
              </ul>
            </div>

          </div>

          <div class="r"></div>

        </div><!-- end focusBox -->



        <div class="blank10"></div>

        <div class="blockA">
	<?php

		// -----------------------------------
		$from			= 'news_1';

		$categoryId		= isset($conf['block']['cate_' . $from]['sub']) ?
						$conf['block']['cate_' . $from]['sub'] : $default;

		$picUrl			= isset($conf['block']['cate_' . $from]['pic']) ?
						$conf['block']['cate_' . $from]['pic'] : '';

		$categoryItem		= new Table_categories($categoryId);

		$arrArticles		= $data[$categoryId];

		$parentCategory		= new Table_categories($categoryItem->parent_id);

	#	Debug::pr($categoryItem);
	#	Debug::pr($arrArticles);


		// -----------------------------------
		$from			= 'news_2';

		$categoryId_2		= isset($conf['block']['cate_' . $from]['sub']) ?
						$conf['block']['cate_' . $from]['sub'] : $default;

		$picUrl_2		= isset($conf['block']['cate_' . $from]['pic']) ?
						$conf['block']['cate_' . $from]['pic'] : '';

		$categoryItem_2		= new Table_categories($categoryId_2);

		$arrArticles_2		= $data[$categoryId_2];

	?>




          <h3 id="title660"><?php echo S::E($parentCategory->name) ?><span class="more"><a href="<?php echo url_for('category/list?id=' . $parentCategory->id) ?>" target="_blank">更多&gt;&gt;</a></span></h3>

          <div id="box660">

            <div class="pt">
              <div class="l_pic">
                <a href="<?php echo url_for('category/list?id=' . $categoryId) ?>" target="_blank"><img src="<?php echo $picUrl ?>" width="55" height="55" /></a>
                <span><?php echo S::E($categoryItem->name) ?></span>
              </div>

              <ul>
                <?php

                	foreach ($arrArticles as $key => $val) {


	                	echo	sprintf(
	                			'<li><a href="%s" target="_blank">%s</a></li>' . "\n",

						url_for('article/show?id=' . $val['id']),
						S::TK($val['title'], 33)

	                			);

	                }
                ?>
              </ul>

            </div><!-- end pt -->


            <div class="pt">
              <div class="l_pic">
                <a href="<?php echo url_for('category/list?id=' . $categoryId_2) ?>" target="_blank"><img src="<?php echo $picUrl_2 ?>" width="55" height="55" /></a>
                <span><?php echo S::E($categoryItem_2->name) ?></span>
              </div>

              <ul>
                <?php

                	foreach ($arrArticles_2 as $key => $val) {


	                	echo	sprintf(
	                			'<li><a href="%s" target="_blank">%s</a></li>' . "\n",

						url_for('article/show?id=' . $val['id']),
						S::TK($val['title'], 33)

	                			);

	                }
                ?>
              </ul>

            </div><!-- end pt -->

          </div><!-- end box660 -->


        </div><!-- end blockA -->

        <div class="blank10"></div>





        <div class="blockA">

		<?php

			$arrPartial['from']		= 'block_1';
			$arrPartial['pos']		= 'left';
			include_partial('block', $arrPartial);

		?>


		<?php

			$arrPartial['from']		= 'block_2';
			$arrPartial['pos']		= 'right';
			include_partial('block', $arrPartial);

		?>

        </div>

        <div class="blank10"></div>



        <div class="blockA">

		<?php

			$arrPartial['from']		= 'block_3';
			$arrPartial['pos']		= 'left';
			include_partial('block', $arrPartial);

		?>


		<?php

			$arrPartial['from']		= 'block_4';
			$arrPartial['pos']		= 'right';
			include_partial('block', $arrPartial);

		?>

        </div>

        <div class="blank10"></div>



        <div class="blockA">

		<?php

			$arrPartial['from']		= 'block_5';
			$arrPartial['pos']		= 'left';
			include_partial('block', $arrPartial);

		?>


		<?php

			$arrPartial['from']		= 'block_6';
			$arrPartial['pos']		= 'right';
			include_partial('block', $arrPartial);

		?>

        </div>

        <div class="blank10"></div>






      </div><!-- end left660 -->


      <div id="right240">

      	<?php if (isset($arrDataConf['block']['use_user'])) : ?>

        <input name="" type="button" class="loginBtn" value="" onclick="window.location='<?php echo url_for('account/signIn') ?>'" />

        <div class="blank5"></div>

        <?php endif ?>

        <fieldset>
            <legend>搜索本站</legend>
		    <form method="get" id="searchform" action="<?php echo url_for('article/search') ?>" target="_blank">
	          <p>
                <label for="s">
                  <input name="kw" id="s" size="20" value="" class="input-style" type="text">
                  <input value="" class="submit-style" type="submit">
                </label>
              </p>
            </form>

		</fieldset>




	<?php

		// -----------------------------------
		$from			= 'scroll_1';

		$categoryId		= isset($conf['block']['cate_' . $from]['sub']) ?
						$conf['block']['cate_' . $from]['sub'] : $default;

		$categoryItem		= new Table_categories($categoryId);

		$arrArticles		= $data[$categoryId];


		// -----------------------------------
		$from			= 'scroll_2';

		$categoryId_2		= isset($conf['block']['cate_' . $from]['sub']) ?
						$conf['block']['cate_' . $from]['sub'] : $default;

		$categoryItem_2		= new Table_categories($categoryId_2);

		$arrArticles_2		= $data[$categoryId_2];

	?>



        <div class="block240">
          <h3><?php echo S::E($categoryItem->name) ?><span class="more"><a href="<?php echo url_for('category/list?id=' . $categoryItem->id) ?>" target="_blank">更多&gt;&gt;</a></span></h3>
          <div class="list12" >
          <marquee direction="up" scrollamount="1"  scrolldelay="30" onMouseOver="stop()" onMouseOut="start()" style="height:110px; overflow:hidden;">

                <?php

                	foreach ($arrArticles as $key => $val) {


	                	echo	sprintf(
	                			'<li><a href="%s" target="_blank">%s</a></li>' . "\n",

						url_for('article/show?id=' . $val['id']),
						S::TK($val['title'], 30)

	                			);

	                }
                ?>

           </marquee>
          </div>
          <div class="bot"></div>
        </div><!-- end block240 -->

        <div class="blank10"></div>

        <div class="block240">
          <h3><?php echo S::E($categoryItem_2->name) ?><span class="more"><a href="<?php echo url_for('category/list?id=' . $categoryItem_2->id) ?>" target="_blank">更多&gt;&gt;</a></span></h3>
          <div class="list12" >
          <marquee direction="up" scrollamount="1"  scrolldelay="30" onMouseOver="stop()" onMouseOut="start()" style="height:110px; overflow:hidden;">

                <?php

                	foreach ($arrArticles_2 as $key => $val) {


	                	echo	sprintf(
	                			'<li><a href="%s" target="_blank">%s</a></li>' . "\n",

						url_for('article/show?id=' . $val['id']),
						S::TK($val['title'], 30)

	                			);

	                }
                ?>

           </marquee>
          </div>
          <div class="bot"></div>
        </div><!-- end block240 -->

        <div class="blank10"></div>
























	<?php

		// -----------------------------------
		$from			= 'side_1';

		$categoryId		= isset($conf['block']['cate_' . $from]['sub']) ?
						$conf['block']['cate_' . $from]['sub'] : $default;

		$picUrl			= isset($conf['block']['cate_' . $from]['pic']) ?
						$conf['block']['cate_' . $from]['pic'] : '';

		$categoryItem		= new Table_categories($categoryId);

		$arrArticles		= $data[$categoryId];


		// -----------------------------------
		$from			= 'side_2';

		$categoryId_2		= isset($conf['block']['cate_' . $from]['sub']) ?
						$conf['block']['cate_' . $from]['sub'] : $default;

		$picUrl_2			= isset($conf['block']['cate_' . $from]['pic']) ?
						$conf['block']['cate_' . $from]['pic'] : '';

		$categoryItem_2		= new Table_categories($categoryId_2);

		$arrArticles_2		= $data[$categoryId_2];

	?>



        <div class="block240_blue">
          <h3><?php echo S::E($categoryItem->name) ?></h3>
          <div class="pt">
            <div class="pic"><a href="<?php echo url_for('category/list?id=' . $categoryItem->id) ?>" target="_blank"><img src="<?php echo $picUrl ?>" width="203" height="70" /></a></div>

            <ul>
                <?php

                	foreach ($arrArticles as $key => $val) {


	                	echo	sprintf(
	                			'<li><a href="%s" target="_blank">%s</a></li>' . "\n",

						url_for('article/show?id=' . $val['id']),
						S::TK($val['title'], 30)

	                			);

	                }
                ?>
            </ul>
          </div>
        </div>

        <div class="blank10"></div>

        <div class="block240_blue">
          <h3><?php echo S::E($categoryItem_2->name) ?></h3>
          <div class="pt">
            <div class="pic"><a href="<?php echo url_for('category/list?id=' . $categoryItem_2->id) ?>" target="_blank"><img src="<?php echo $picUrl_2 ?>" width="203" height="70" /></a></div>

            <ul>
                <?php

                	foreach ($arrArticles_2 as $key => $val) {


	                	echo	sprintf(
	                			'<li><a href="%s" target="_blank">%s</a></li>' . "\n",

						url_for('article/show?id=' . $val['id']),
						S::TK($val['title'], 30)

	                			);

	                }
                ?>
            </ul>
          </div>
        </div>

        <div class="blank10"></div>




      </div><!-- end right240 -->


    </div><!-- end container -->












  </div><!-- end sandwich -->