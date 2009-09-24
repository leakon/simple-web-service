
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


			$subULHtml		= '';
			if (count($arrTmp) > 2) {
				$subULHtml	= implode("\n", $arrTmp);
			}
			$arrSubDiv[$id]		= $subULHtml;


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

			$subULHtml		= '';
			if (count($arrTmp) > 2) {
				$subULHtml	= implode("\n", $arrTmp);
			}
			$arrSubDiv[$id]		= $subULHtml;

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

			$subULHtml		= '';
			if (count($arrTmp) > 2) {
				$subULHtml	= implode("\n", $arrTmp);
			}
			$arrSubDiv[$id]		= $subULHtml;

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

              		echo	sprintf('<li><a href="%s" title="%s" target="_blank"><img src="%s" width="70" height="70" alt="%s" /></a></li>',

	              			$arrDataConf_Block['image_' . $i]['link'],
	              			$arrDataConf_Block['image_' . $i]['desc'],
	              			$arrDataConf_Block['image_' . $i]['pic'],
	              			$arrDataConf_Block['image_' . $i]['desc']
	              			);

              	}

              	?>
              </ul>
            </div><!-- end blockA -->

            <div class="blockB">

<?php
$option			= array('limit' => 1000);
$option['to_array']	= true;

$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_RANGE;
$res			= Table_categories::getByParent(0, $option);
$arrRanges		= Array_Util::ColToPlain($res, 'id', 'name');

$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_TYPE;
$res			= Table_categories::getByParent(0, $option);
$arrTypes		= Array_Util::ColToPlain($res, 'id', 'name');

$option['type']		= CnroConstant::CATEGORY_TYPE_PROD_STYLE;
$res			= Table_categories::getByParent(0, $option);
$arrStyle		= Array_Util::ColToPlain($res, 'id', 'name');


$arrFieldCatetory		= Table_categories::getAllField();


$arrFieldJSON	= array();
foreach ($arrFieldCatetory as $fieldInfo) {

	$tmp		= array();

	$tmp['id']		= $fieldInfo['id'];
	$tmp['field_id']	= $fieldInfo['field_id'];
	$tmp['name']		= $fieldInfo['name'];

	$arrFieldJSON[]		= $tmp;

}

#Debug::pr($arrFieldJSON);

$strFieldJSON	= json_encode($arrFieldJSON);

?>


<script type="text/javascript">

var arrFieldObj	= <?php echo $strFieldJSON ?>;


</script>

            	<form action="<?php echo url_for('article/searchProduct') ?>" method="get" target="_blank">
              <h3>产品检索</h3>
              <div class="l">


                <select name="range" onchange="ThreeChangeRange(this, 'id_three_type')">
                  <option value="0">应用领域</option>
                  <?php
                  	echo	options_for_select($arrRanges, $grandField->id);
                  ?>
                </select>
                <br />
                <select name="type" id="id_three_type" onchange="ThreeChangeType(this, 'id_three_style')">
                  <option value="0">设备类别</option>
                  <?php
                 # 	echo	options_for_select($arrTypes);
                  ?>
                </select>



<!--
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

-->

                <select name="style" id="id_three_style">
                  <option value="0">设备型号</option>
                  <?php
                #  	echo	options_for_select($arrStyle);
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