
    <div id="content2">



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




      <div class="sideNav">
        <ul>
          <li class="current"><a href="javascript:;"><?php echo S::E($strSideBarNavTitle) ?></a></li>

		<?php

		$arrSubCateTitle	= array();

	#	$cateId		= (int) $sf_request->getParameter('id', 0);
		$cateId		= (int) $articleItem->range_id;
	#	Debug::pr($arrRanges);

		foreach ($arrSubCategories as $id => $name) {

          		echo	sprintf('<li><a class="%s" href="%s">%s</a></li>',
          					S::curr($id == $cateId, 'now'),
          					url_for('category/product?id=' . $id),
          					$name
          				);

          		$arrSubCateTitle[$id]	= $name;

		}

		?>

        </ul>
      </div><!-- end sideNav -->




      <div class="right">


        <div class="blockC">

            <div class="product_f">

            	<h3><?php echo S::E($articleItem->title) ?></h3>

              <div class="pc"><img src="<?php echo $articleItem->large_pic ?>" width="212" /></div>

              <div class="pi">
                <?php echo $articleItem->detail ?>
              </div>


<style>

#wrapper .container .mainBody .content944 .rightD .product_f .pd{width:665px; overflow:hidden; clear:both; }
#product_detail_button{width:665px; height:auto; overflow:hidden; position:relative; }
#product_detail_button span{ display:block; float:left; height:25px; padding:0 20px 0 0;  margin:0 6px 0 0; line-height:25px;font-size:12px; color:#fff; background:#c6d6e8; border:1px solid #1c74bb;  cursor:pointer; text-align:left;  }
#product_detail_button .current{display:block; float:left; height:30px; padding:0 20px 0 0; margin:0 6px 0 0; line-height:30px;font-size:12px; border:1px solid #1c74bb; border-bottom:none; background:#fff; cursor:pointer; text-align:left;}

#wrapper .container .mainBody .content944 .rightD .product_f .pd .pd_bg{width:615px; height:auto; overflow:hidden; padding:20px 20px; border:1px solid #1c74bb; margin:-1px 0 0 0; }
#wrapper .container .mainBody .content944 .rightD .product_f .pd .pd_bg .innerPd h3{ font-size:14px; color:#1c74bb; margin:15px 0; }
#wrapper .container .mainBody .content944 .rightD .product_f .pd .pd_bg .innerPd p{line-height:25px; }
#wrapper .container .mainBody .content944 .rightD .product_f .pd .pd_bg .innerPd p a{color:#1c74bb;}

</style>


<?php if (1) : ?>
              <div class="pd">

              	<div id="product_detail_button">
                    <span id="btn_param"  class="current"><h3>Parameters</h3></span>
              		<span id="btn_download"><h3>Documents</h3></span>
              		<span id="btn_contact"><h3>Contact us</h3></span>


              	</div><!-- end product_detail_button -->

              	<div id="cnt_param" style="display:" class="pd_bg">
              		<?php

              		echo	$articleItem->params;


              		?>
              	</div>
              	<div id="cnt_download" style="display:none" class="pd_bg">

			<a href="<?php echo $articleItem->pdf ?>"><?php echo $articleItem->pdf ?></a>
              	</div>

              	<div id="cnt_contact" style="display:none" class="pd_bg">
              		<?php
              		echo	isset($arrDataConf['block']['contacts']) ? $arrDataConf['block']['contacts'] : '';
              		?>

              	</div>


              </div>
<?php endif ?>




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

  </div>


        </div><!-- end content944 -->


<?php

#	Debug::pr(SofavDB_Debug_PDO::getTimer());

