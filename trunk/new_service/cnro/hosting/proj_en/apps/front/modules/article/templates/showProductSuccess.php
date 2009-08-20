
        <div class="breadCrumb">

        <?php

        	$arrNavHtml	= array();

        	foreach ($arrNavPath as $obj) {

			if ($obj->id) {
				$url		= url_for('category/product?id=' . $obj->id);
			} else {
				$url		= url_for('category/product');
			}

        		$arrNavHtml[]	= sprintf('<a href="%s">%s</a>', $url, $obj->name);

        	}

        	$count			= count($arrNavPath);

		$strSideBarNavTitle	= $arrNavPath[$count - 1]->name;

        ?>

            <a href="/">首页</a> &gt; <?php echo implode(' &gt; ', $arrNavHtml) ?>
          </div><!-- end breadCrumb -->

        <div class="content944">
          <div class="sideNav">
            <h3><?php echo S::E($strSideBarNavTitle) ?></h3>
            <ul class="">
		<?php

		$arrSubCateTitle	= array();

	#	$cateId		= (int) $sf_request->getParameter('id', 0);
		$cateId		= (int) $articleItem->range_id;
	#	Debug::pr($arrRanges);

		foreach ($arrSubCategories as $id => $name) {

          		echo	sprintf('<li class="%s"><a href="%s">%s</a></li>',
          					S::curr($id == $cateId, 'current'),
          					url_for('category/product?id=' . $id),
          					$name
          				);

          		$arrSubCateTitle[$id]	= $name;

		}

		?>
            </ul>
          </div><!-- end sideNav -->


          <div class="rightD">

            <div class="title">气调保鲜设备</div>

            <div class="product_f">

              <div class="pc"><img src="<?php echo $articleItem->large_pic ?>" width="212" /></div>

              <div class="pi">
                <?php echo $articleItem->detail ?>
              </div>


              <div class="pd">
              	<table id="product_detail_button">
              	<tr>
              		<td id="btn_contact" class="current"><h3>联系信息</h3></td>
              		<td id="btn_param"><h3>产品规格和型号</h3></td>
              		<td id="btn_download"><h3>文档下载</h3></td>
              	</tr>
              	</table>

              	<div id="cnt_contact" style="display:">
              		<?php
              		echo	isset($arrDataConf['block']['contacts']) ? $arrDataConf['block']['contacts'] : '';
              		?>

              	</div>
              	<div id="cnt_param" style="display:none">
              		<?php

              		echo	$articleItem->params;


              		?>
              	</div>
              	<div id="cnt_download" style="display:none">

			<a href="<?php echo $articleItem->pdf ?>"><?php echo $articleItem->pdf ?></a>
              	</div>



              </div>

              <script>

			var objConf	= {'map':{
							'btn_contact':'cnt_contact',
							'btn_param':'cnt_param',
							'btn_download':'cnt_download'
						}
					};

				function InitToggle(conf) {


					for (var strKey in objConf.map) {

						$('#' + strKey).removeClass('current');
						$('#' + objConf.map[strKey]).css({"display":"none"});
					}


				}

				function doClick(event) {
					InitToggle(objConf);
				//	alert(event.data.cont);
					$('#'+event.data.cont).css({"display":""});
					$('#'+event.data.strKey).addClass('current');
				//	alert($(this).tagName);
				}

				for (var strKey in objConf.map) {

					/*
					$('#' + strKey).bind('click', function() {
							InitToggle(objConf);
						//	alert($(this).text());
							$(this).css({"display":""});
						});
					*/


					$('#' + strKey).bind('click', {'strKey':strKey, 'cont':objConf.map[strKey]}, doClick);

				}


		//	var toggleBtns	= new SimpleToggle(objConf);


              	</script>

<style>

#wrapper .container .mainBody .content944 .rightD .product_f .pd td.current h3	{color:red;}
#product_detail_button td	{cursor:pointer;}

</style>


            </div><!-- end product_f -->




          </div>


        </div><!-- end content944 -->


<?php

#	Debug::pr(SofavDB_Debug_PDO::getTimer());

