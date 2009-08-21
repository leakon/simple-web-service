
    <div id="content">

      <div class="left">
        <div class="blockA">
          <h2><img src="/en/images/title156x18.gif" width="156" height="18" alt="Applications and Products" /></h2>


<?php

define('RANGE_ID_DANQI',	1000202);
define('RANGE_ID_CUISHU',	1000203);
define('RANGE_ID_JIANSHEN',	1000204);

$arrIndexRange		= array();
$arrIndexRange[RANGE_ID_DANQI]		= Table_categories::getPlain(RANGE_ID_DANQI);
$arrIndexRange[RANGE_ID_CUISHU]		= Table_categories::getPlain(RANGE_ID_CUISHU);
$arrIndexRange[RANGE_ID_JIANSHEN]	= Table_categories::getPlain(RANGE_ID_JIANSHEN);


#Debug::pr($arrIndexRange);

?>


          <div class="l">
            <h3>Main Products</h3>
            <ul class="list12">
		<?php
		foreach ($arrIndexRange[RANGE_ID_DANQI] as $id => $name) {

			echo	sprintf('<li><a class="" href="%s">%s</a></li>', url_for('category/product?id='.$id), S::E($name));

		}
		?>

            </ul>
            <ul class="list12">
		<?php
		foreach ($arrIndexRange[RANGE_ID_CUISHU] as $id => $name) {

			echo	sprintf('<li><a class="" href="%s">%s</a></li>', url_for('category/product?id='.$id), S::E($name));

		}
		?>
            </ul>
            <ul class="list12">
		<?php
		foreach ($arrIndexRange[RANGE_ID_JIANSHEN] as $id => $name) {

			echo	sprintf('<li><a class="" href="%s">%s</a></li>', url_for('category/product?id='.$id), S::E($name));

		}
		?>
            </ul>

          </div>

          <div class="r">
            <h3>Use In</h3>
            <span><a href="nitrogen.html" target="_blank"><img src="/en/images/app218x70_1.jpg" width="218" height="70" alt="Nitrogen generation" /></a></span>
            <span><a href="storage.html" target="_blank"><img src="/en/images/app218x70_2.jpg" width="218" height="70" alt="Storage for fruits and vegetables" /></a></span>
            <span><a href="hypoxia.html" target="_blank"><img src="/en/images/app218x70_3.jpg" width="218" height="70" alt="Hypoxia training" /></a></span>
          </div>

        </div><!-- end applications and products-->

        <div class="blank10"></div>

        <div class="blockB">
          <div class="l"><a href="#" target="_blank"><img src="/en/images/asiaNet185x122.jpg" width="185" height="122" alt="Asia Network" /></a></div>
          <div class="r"><a href="#" target="_blank"><img src="/en/images/guide363x123.jpg" width="363" height="123" alt="A guide to CNRO" /></a></div>

        </div><!-- end asia networks and CNRO guide -->

        <div class="blank20"></div>

        <div class="blockC">
          <h2><img src="/en/images/title70x28.gif" width="78" height="20" alt="Daily News" /></h2>
          <ul class="list12">

          	<!--
            <li><a href="technology.html" target="_blank">Hitachi held the 140th Ordinary General Meeting of Shareholders ... </a><span class="time">July 28, 2009</span></li>
            	-->

		<?php

		$arrNews	= array();

		$arrNews	= Table_articles::getByCategory(1000201);

	#	Debug::pr($arrNews);

		foreach ($arrNews as $articleInfo) {

			echo	sprintf('<li><a href="%s" target="_blank">%s3333333</a><span class="time">%s</span></li>',
				url_for_2('article/show?id='.$articleInfo['id']),
				S::E($articleInfo['title']), substr($articleInfo['published_at'], 0, 10));

		}
		?>



          </ul>
        </div><!-- end daily news -->

      </div><!-- end left -->


      <div class="right">
        <div class="blockA">
          <h2><img src="/en/images/title90x18.gif" width="90" height="18" alt="about CNRO" /></h2>
          <ul class="list12">
            <li><a href="technology.html">News Release</a></li>
            <li><a href="profile.html">Vision</a></li>
            <li><a href="profile.html">Corporate Profile</a></li>
            <li><a href="profile.html">CNRO’s Activities</a></li>
          </ul>
        </div><!-- end about CNRO -->

        <div class="blockB">
          <div class="top"></div>
          <div class="searchBox">
            	<form action="<?php echo url_for_2('article/searchProduct') ?>" method="get" target="_blank">





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













                <select name="range" class="typeIn150" onchange="ThreeChangeRange(this, 'id_three_type')">
                  <option value="0">applications</option>
                  <?php
                  	echo	options_for_select($arrRanges, $grandField->id);
                  ?>
                </select>


                <select name="type" class="typeIn150" id="id_three_type" onchange="ThreeChangeType(this, 'id_three_style')">
                  <option value="0">type</option>
                  <?php
                 # 	echo	options_for_select($arrTypes);
                  ?>
                </select>


                <select name="style" id="id_three_style" class="typeIn150">
                  <option value="0">code</option>
                  <?php
                #  	echo	options_for_select($arrStyle);
                  ?>
                </select>




            <p><input name="" type="submit" class="btn60" value=""  /></p>
            </form>
          </div>
        </div><!-- end searchBox -->

        <div class="blank10"></div>

        <div class="sideAd">
         <a href="#" target="_blank"><img src="/en/images/ad188x117_2.jpg" width="188" height="116" alt="" /></a>
        </div><!-- end sideAd -->

        <div class="blank10"></div>

        <div class="sideAd">
         <a href="#" target="_blank"><img src="/en/images/ad188x117.jpg" width="188" height="117" alt="" /></a>
        </div><!-- end sideAd -->


      </div>

    </div><!-- end content -->