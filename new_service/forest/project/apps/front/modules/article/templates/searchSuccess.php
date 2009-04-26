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
  <div id="sandwich">

    <div class="container">
      <div id="breadCrumb">
        <div class="bcL"></div>

        <?php

        ?>

	<div class="bcM"><a href="/">首页</a> &gt; 搜过关键词 “<?php echo S::E($strKW) ?>” </div>
        <div class="bcR"></div>
      </div><!-- end breadCrumb -->
    </div>




    <div class="container">

        <div class="left">

        <?php if (0) : ?>
          <div class="sideAd"><a href="#" target="_blank"><img src="/images/ad220x180.png" width="220" height="180" /></a></div>
          <div class="blank10"></div>
          <div class="sideAd"><a href="#" target="_blank"><img src="/images/ad220x180.png" width="220" height="180" /></a></div>
	<?php endif ?>

	<?php

	echo showADBanner('article_ad_1');
	echo showADBanner('article_ad_2');

	?>

        </div>

        <div class="right search">

          <div class="top"></div>


<?php if (isset($arrResult) && count($arrResult)) : ?>

          <div class="textBlock">
            <div class="titlebar">搜索关键词 “<?php echo S::E($strKW) ?>”</div>
            <div class="blank10"></div>
            <div class="blank10"></div>

           <ul class="list14">
           	<?php foreach ($arrResult as $key => $val) : ?>
             		<li><a href="<?php echo url_for('article/show?id=' . $val['id']) ?>" target="_blank"><?php echo S::E($val['title']) ?></a></li>
           	<?php endforeach ?>
           </ul>

           <div class="blank10"></div>
           <div class="blank10"></div>

		<?php

		$uri	= $pager->getPageUri();
		$action	= $sf_context->getActionName();

		include_partial('global/pager', array('pager' => $pager, 'pageUri' => $uri));

		?>

          </div>
          <!-- end textBlock -->

<?php else : ?>


          <div class="textBlock">

          	没有与关键词 “<?php echo S::E($strKW) ?>” 有关的搜索结果。

          </div>
          <!-- end textBlock -->

<?php endif ?>







          <div class="bot"></div>
        </div>





    </div><!-- end container -->
    <div class="blank10"></div>





  </div><!-- end sandwich -->


<?php

#	Debug::pr(SofavDB_Debug_PDO::getTimer());

