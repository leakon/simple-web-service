
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
              <h3>产品检索</h3>
              <div class="l">
                <select name="">
                  <option>应用领域</option>
                </select>
                <select name="">
                  <option>设备类别</option>
                </select>
                <select name="">
                  <option>设备型号</option>
                </select>

              </div>
              <div class="r">
                <input name="" type="button" class="btn70" value="" />
              </div>
            </div><!-- end blockB -->




          </div><!-- end right -->
        </div>