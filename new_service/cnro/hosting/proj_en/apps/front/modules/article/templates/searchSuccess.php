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


    <div id="content2">

      <div class="sideNav">
        <ul>
          <li class="current"><a href="javascript:;">Search “<?php echo S::E($strKW) ?>”</a></li>
        </ul>
      </div><!-- end sideNav -->



      <div class="right">


        <div class="blockB">
        <ul>


<?php if (isset($arrResult) && count($arrResult)) : ?>


           	<?php foreach ($arrResult as $key => $val) : ?>
           	<?php

           		if ($val['range_id']) {

           			$url	= url_for('article/showProduct?id=' . $val['id']);

           		} else {

           			$url	= url_for('article/show?id=' . $val['id']);

           		}

           	?>

		          <li>
		           <h3><a href="<?php echo $url ?>" target="_blank"><?php echo S::E($val['title']) ?></a></h3>
		           <span class="date"><?php echo substr($val['published_at'], 0, 10) ?></span>
		          </li>


           	<?php endforeach ?>

           </ul>

        <div class="blank20"></div>
        <div class="blank20"></div>

		<?php if (1|| $intSubCateId) : ?>

		           <div class="pageBar">
		<?php

		$uri	= $pager->getPageUri();
		$action	= $sf_context->getActionName();

		include_partial('global/pager', array('pager' => $pager, 'pageUri' => $uri));

		?>
		           </div>
		<?php endif ?>

        </div><!-- end blockB -->


<?php else : ?>


        <div class="blockB">

          	No result for “<?php echo S::E($strKW) ?>”

        </div><!-- end blockB -->

<?php endif ?>

	</div>


    </div><!-- end content -->




