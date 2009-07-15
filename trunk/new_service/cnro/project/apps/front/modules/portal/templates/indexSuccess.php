
<?php

/*
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

	$GLOBALS['global_data']		=& $arrDataConf;
*/


?>


        <div class="content944">

<?php if (0) : ?>
          <div class="left">
            <div class="col200">
              <div class="col_pic"><a href="<?php echo $arrDataConf_Block['block_1']['link'] ?>" target="_blank"></a></div>
              <p>
			<?php echo $arrDataConf_Block['block_1']['desc'] ?>
	      </p>
              <span><a href="<?php echo $arrDataConf_Block['block_1']['link'] ?>" target="_blank"><img src="/images/moreBtn65x30.png" width="65" height="30" alt="more" /></a></span>
            </div>

            <div class="col200_2">
              <div class="col_pic"><a href="<?php echo $arrDataConf_Block['block_2']['link'] ?>" target="_blank"></a></div>
              <p>
			<?php echo $arrDataConf_Block['block_2']['desc'] ?>
	      </p>
              <span><a href="<?php echo $arrDataConf_Block['block_2']['link'] ?>" target="_blank"><img src="/images/moreBtn65x30.png" width="65" height="30" alt="more" /></a></span>
            </div>

            <div class="col200_3">
              <div class="col_pic"><a href="<?php echo $arrDataConf_Block['block_3']['link'] ?>" target="_blank"></a></div>
              <p>
			<?php echo $arrDataConf_Block['block_3']['desc'] ?>
	      </p>
              <span><a href="<?php echo $arrDataConf_Block['block_3']['link'] ?>" target="_blank"><img src="/images/moreBtn65x30.png" width="65" height="30" alt="more" /></a></span>
            </div>

          </div>
<?php endif ?>


          <div class="left">

<?php

define('RANGE_ID_DANQI',	1000053);
define('RANGE_ID_CUISHU',	1000054);
define('RANGE_ID_JIANSHEN',	1000049);

$arrIndexRange		= array();
$arrIndexRange[RANGE_ID_DANQI]		= Table_categories::getPlain(RANGE_ID_DANQI);
$arrIndexRange[RANGE_ID_CUISHU]		= Table_categories::getPlain(RANGE_ID_CUISHU);
$arrIndexRange[RANGE_ID_JIANSHEN]	= Table_categories::getPlain(RANGE_ID_JIANSHEN);


#Debug::pr($arrIndexRange);

?>
            <div class="col200">
              <div class="col_pic"><a href="/cn/index.php/category/range/id/1000053" target="_blank"></a></div>

		<ul class="sf-menu sf-vertical sf-js-enabled sf-shadow">
		<?php
		$arrSubDiv	= array();
		foreach ($arrIndexRange[RANGE_ID_DANQI] as $id => $name) {

			$arrSubDiv		= array();

			$arrSubRange		= Table_categories::getPlain($id);

			$arrTmp			= array();
			$arrTmp[]		= sprintf('<ul style="display: none; visibility: hidden;">');
			foreach ($arrSubRange as $subId => $subName) {

				$arrTmp[]	= sprintf('<li><a href="%s">%s</a></li>', url_for('category/range?id='.$subId), S::E($subName));

			}
			$arrTmp[]		= '</ul>';

			$arrSubDiv[$id]		= implode("\n", $arrTmp);

			echo	sprintf('<li><a class="sf-with-ul" href="%s">%s</a>%s</li>', url_for('category/range?id='.$id), S::E($name), implode("", $arrSubDiv));

		}
		?>
		</ul>



            </div>

            <div class="col200_2">
              <div class="col_pic"><a href="/cn/index.php/category/range/id/1000054" target="_blank"></a></div>

		<ul class="sf-menu sf-vertical sf-js-enabled sf-shadow">
		<?php
		$arrSubDiv	= array();
		foreach ($arrIndexRange[RANGE_ID_CUISHU] as $id => $name) {

			$arrSubDiv		= array();

			$arrSubRange		= Table_categories::getPlain($id);

			$arrTmp			= array();
			$arrTmp[]		= sprintf('<ul style="display: none; visibility: hidden;">');
			foreach ($arrSubRange as $subId => $subName) {

				$arrTmp[]	= sprintf('<li><a href="%s">%s</a></li>', url_for('category/range?id='.$subId), S::E($subName));

			}
			$arrTmp[]		= '</ul>';

			$arrSubDiv[$id]		= implode("\n", $arrTmp);

			echo	sprintf('<li><a class="sf-with-ul" href="%s">%s</a>%s</li>', url_for('category/range?id='.$id), S::E($name), implode("", $arrSubDiv));

		}
		?>
		</ul>

            </div>

            <div class="col200_3">
              <div class="col_pic"><a href="/cn/index.php/category/range/id/1000049" target="_blank"></a></div>



		<ul class="sf-menu sf-vertical sf-js-enabled sf-shadow">
		<?php
		$arrSubDiv	= array();
		foreach ($arrIndexRange[RANGE_ID_JIANSHEN] as $id => $name) {

			$arrSubDiv		= array();

			$arrSubRange		= Table_categories::getPlain($id);

			$arrTmp			= array();
			$arrTmp[]		= sprintf('<ul style="display: none; visibility: hidden;">');
			foreach ($arrSubRange as $subId => $subName) {

				$arrTmp[]	= sprintf('<li><a href="%s">%s</a></li>', url_for('category/range?id='.$subId), S::E($subName));

			}
			$arrTmp[]		= '</ul>';

			$arrSubDiv[$id]		= implode("\n", $arrTmp);

			echo	sprintf('<li><a class="sf-with-ul" href="%s">%s</a>%s</li>', url_for('category/range?id='.$id), S::E($name), implode("", $arrSubDiv));

		}
		?>
		</ul>

            </div>





          </div>




          <div class="right">

            <div class="blockA">
              <h3>产品与服务</h3>
              <ul class="pp">

              	<?php

              	for ($i = 1; $i < 7; $i++) {

              		echo	sprintf('<li><a href="%s" target="_blank"><img src="%s" width="70" height="70" /></a></li>',
	              			$arrDataConf_Block['image_' . $i]['link'],
	              			$arrDataConf_Block['image_' . $i]['pic']
	              			);

              	}

              	?>
              </ul>
            </div><!-- end blockA -->

            <div class="blockB">

            	<form action="<?php echo url_for('article/searchProduct') ?>" method="get" target="_blank">
              <h3>产品检索</h3>
              <div class="l">
                <select name="range">
                  <option value="0">应用领域</option>
                  <?php
                  	echo	options_for_select($arrRanges);
                  ?>
                </select>
                <select name="type">
                  <option value="0">设备类别</option>
                  <?php
                  	echo	options_for_select($arrTypes);
                  ?>
                </select>
                <select name="style">
                  <option value="0">设备型号</option>
                  <?php
                  	echo	options_for_select($arrStyle);
                  ?>
                </select>

              </div>
              <div class="r">
                <input name="" type="submit" class="btn70" value="" />
              </div>

      		</form>
            </div><!-- end blockB -->




          </div><!-- end right -->
        </div>
            	<?php


		#	Debug::pr($arrTypes);


            	?>