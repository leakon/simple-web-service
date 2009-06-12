
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
            <div class="col200">

              <div class="col_pic"><a href="#" target="_blank"></a></div>

              <p><a href="#mydiv2" rel="facebox">船用氮气</a></p>
              <p><a href="#mydiv3" rel="facebox">石油天然气</a></p>
              <p><a href="#mydiv4" rel="facebox">航空航天</a></p>
              <p><a href="#mydiv5" rel="facebox">消防用氮气</a></p>



              <div id="mydiv2" style="display:none">
                <a href="#">货油舱的惰化</a>
                <a href="#">船用保鲜</a>
              </div>

              <div id="mydiv3" style="display:none">
                <a href="#">油气管道吹扫</a>
                <a href="#">油气管道的打压检漏</a>
                <a href="#">氮气封舱</a>
                <a href="#">油气田的三次开采</a>

              </div>

              <div id="mydiv4" style="display:none">
                <a href="#">红外节流制冷用气</a>
                <a href="#">机场用气（氮气和氧气）</a>
                <a href="#">露点测量</a>


              </div>


              <div id="mydiv5" style="display:none">
                <a href="#">船用制氮系统</a>
                <a href="#">车载制氮系统</a>
                <a href="#">箱式制氮系统</a>
                <a href="#">船用保鲜系统</a>
                <a href="#">露点测试仪</a>
                <a href="#">氧气测试仪</a>

              </div>






            </div>

            <div class="col200_2">

              <div class="col_pic"><a href="#" target="_blank"></a></div>

              <p><a href="#mydiv" rel="facebox">气调保鲜系统</a></p>
              <p>气调试验设备</p>
              <p>船用气调保鲜设备</p>
              <p>粮食贮藏系统</p>
              <p>催熟设备</p>


              <div id="mydiv" style="display:none">
                    adsfasdfasdfas
              </div>



            </div>

            <div class="col200_3">
              <div class="col_pic"><a href="#" target="_blank"></a></div>


              <p><a href="" >低氧减肥、健身</a></p>
              <p><a href="" >登山、登高原适应训练</a></p>
              <p><a href="" >生理机能调节</p>
              <p><a href="" >专业运动训练</p>






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