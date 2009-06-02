<?php


	Custom_Homepage::setDataConf($arrDataConf);

#Debug::pr($arrResult);

#Debug::pr(SofavDB_Debug_PDO::getTimer());


	$GLOBALS['global_data']		=& $arrDataConf;

	function showADBanner($name, $option = array()) {

		$arrDataConf		= $GLOBALS['global_data'];

	#	var_dump($arrDataConf);

		if (!isset($option['has_pic'])) {
			$option['has_pic']	= true;
		}

		$str	= '';

		if ($option['has_pic'] && isset($arrDataConf['block'][$name]) && strlen($arrDataConf['block'][$name])) {

			$imgLink	= isset($arrDataConf['block'][$name . '_link']) ? $arrDataConf['block'][$name . '_link'] : '#';

			$imgSrc		= $arrDataConf['block'][$name];

			$tmp		= explode('.', $imgSrc);
			$ext		= array_pop($tmp);
		#	var_dump($ext);


			if ('swf' == $ext) {
				$str	.= sprintf('<div class="sideAd"><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="220" height="180"><param name="movie" value="%s"><param name="quality" value="high"><param name="menu" value="false"><param name="wmode" value="opaque"><param name="FlashVars" value=""><embed src="%s" wmode="opaque" flashvars="" false="" quality="high" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" width="220" height="180"></object></div><div class="blank10"></div>', $imgSrc, $imgSrc);
			} else {
				$str	.= sprintf('<div class="sideAd"><a href="%s" target="_blank"><img src="%s" width="220" height="180" /></a></div><div class="blank10"></div>', $imgLink, $imgSrc);
			}

		}

		return	$str;

	}


?>



        <div class="breadCrumb">

        <?php

        	$arrNavHtml	= array();

        	foreach ($arrNavPath as $obj) {

        		$arrNavHtml[]	= sprintf('<a href="%s">%s</a>', url_for('category/list?id=' . $obj->id), $obj->name);

        	}


        ?>

            <a href="/">首页</a> &gt; 搜过关键词 “<?php echo S::E($strKW) ?>”
          </div><!-- end breadCrumb -->

        <div class="content944">
          <div class="sideNav">
	<?php

	echo showADBanner('article_ad_1');
	echo showADBanner('article_ad_2');

	?>

          </div><!-- end sideNav -->


          <div class="rightC">

<?php if (isset($arrResult) && count($arrResult)) : ?>


          <div class="textBlock">
            <div class="titlebar"><h3>搜索关键词 “<?php echo S::E($strKW) ?>”</h3></div>
            <ul class="newsList">
           	<?php foreach ($arrResult as $key => $val) : ?>
             		<li><span class="date"><?php echo substr($val['published_at'], 0, 10) ?></span><a href="<?php echo url_for('article/show?id=' . $val['id']) ?>" target="_blank"><?php echo S::E($val['title']) ?></a></li>
           	<?php endforeach ?>

           </ul>

           <div class="blank10"></div>
           <div class="blank10"></div>

		<?php if ($intSubCateId) : ?>

		           <div class="pageBar">
		<?php

		$uri	= $articlePager->getPageUri();
		$action	= $sf_context->getActionName();

		include_partial('global/pager', array('pager' => $articlePager, 'pageUri' => $uri));

		?>
		           </div>
		<?php endif ?>

          </div>
          <!-- end textBlock -->


<?php else : ?>


          <div class="textBlock">

          	没有与关键词 “<?php echo S::E($strKW) ?>” 有关的搜索结果。

          </div>
          <!-- end textBlock -->

<?php endif ?>




          </div>

        </div><!-- end content944 -->




