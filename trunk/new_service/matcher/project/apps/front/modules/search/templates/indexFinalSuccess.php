<style>

select.se_selector	{width:190px; border:0; height:160px; *height:166px; overflow:auto;}
div.content ul.ul li.li2 		{overflow:hidden; xheight:278px;}
li.li3 p		{color:black;}

</style>


<form id="search_form" action="<?php echo url_for('search/result') ?>" method="get">
<input type="hidden" name="from" value="result" />
<input type="hidden" name="type" value="<?php echo $sf_request->getParameter('type', '') ?>" />
<input type="hidden" name="camera_id" value="<?php echo $sf_request->getParameter('camera_id', '') ?>" />
<input type="hidden" name="camera_model_id" value="<?php echo $sf_request->getParameter('camera_model_id', '') ?>" />
<input type="hidden" name="lens_id" value="<?php echo $sf_request->getParameter('lens_id', '') ?>" />
<input type="hidden" name="lens_model_id" value="<?php echo $sf_request->getParameter('lens_model_id', '') ?>" />



<!--选择产品开始-->
<div class="content">











<!--滑动开始-->
<div class="movoewer fun">
<ul class="tab">
<li class="txt">请选择您需要的影像产品</li>
<li class="btu_on" id="id_tab_bag" onMouseOverx="tabit('tab1',0,4)" style="cursor:pointer"><a href="#" title="摄影包">摄影包</a></li>
<li class="btu_off" id="id_tab_stand" onMouseOverx="tabit('tab1',1,4)" style="cursor:pointer"><a href="#" title="脚  架">脚  架</a></li>
<li class="btu_off" id="id_tab_holder" onMouseOverx="tabit('tab1',2,4)" style="cursor:pointer"><a href="#" title="云  台">云  台</a></li>
<li class="btu_off" id="id_tab_filter" onMouseOverx="tabit('tab1',3,4)" style="cursor:pointer"><a href="#" title="滤  镜">滤  镜</a></li>
</ul>





















<!--滑动第一个开始-->
<div class="clear" id=id_product_1 style="DISPLAY:">
		<ul class="ul">
		<li class="li1">选择您的相机品牌</li>
		<li class="li2" id="select_2_1"></li>
		</ul>

		<ul class="ul">
		<li class="li1">选择您的相机型号</li>
		<li class="li2" id="select_2_2"></li>
		</ul>
</div>




	<!--滑动第2个开始-->
	<div class="clear" id=id_product_2 style="display:none">
		<ul class="ul">
		<li class="li1">选择您的相机品牌</li>
		<li class="li2" id="select_4_1"></li>
		</ul>

		<ul class="ul">
		<li class="li1">选择您的相机型号</li>
		<li class="li2" id="select_4_2"></li>
		</ul>

		<ul class="ul">
		<li class="li1">选择您的镜头品牌</li>
		<li class="li2" id="select_4_3"></li>
		</ul>

		<ul class="ul">
		<li class="li1">选择您的镜头型号</li>
		<li class="li2" id="select_4_4"></li>
		</ul>
	</div>

	<!--滑动第3个开始-->
	<div class="clear" id=id_product_3 style="display:none">
		<ul class="ul">
		<li class="li1">选择您的镜头品牌</li>
		<li class="li2" id="select_2_1_lens"></li>
		</ul>

		<ul class="ul">
		<li class="li1">选择您的镜头型号</li>
		<li class="li2" id="select_2_2_lens"></li>
		</ul>
	</div>
















</div>
<!--滑动结束-->



























<!--查询按钮开始-->
<div class="search"><a href="javascript:;"><img src="/matcher/images/v2/search.gif" onclick="setTimeout(function() {$('search_form').submit(); }, 10);"></a></div>
<!--查询按钮结束-->

<!--选择产品结束-->



<div class="search_y">
<ul class="select">
<li><span>品牌:</span>
	<span id="cont_product_box"></span>

</li>

<li style="display:none;" id="list_bag_class"><span>级别:</span>
	<span id="cont_bag_class_box"></span>

</li>

<li><span>标签:</span>

	<span id="cont_tag_box"></span>

</li>
<li><span>价格区间:</span>
	<span>
				<select name="price_id">
				<?php
					echo	options_for_select($arrOption['price'], $sf_request->getParameter('price_id', 0));
				?>
				</select>
	</span>

</li>
</ul>














<div class="lines"></div>




<div class="bor">


	<?php if ($showResult) : ?>


<?php if (isset($arrResult)) : ?>

	<?php if (count($arrResult)) : ?>


		<?php

			$name				= $partialName . 'Result';
			$arrRefer			= array();
			$arrRefer['arrResult']		= $arrResult;
			$arrRefer['arrOption']		= $arrOption;
			$arrRefer['webUploadDir']	= $webUploadDir;
			$arrRefer['partial_name']	= $partialName;

			if ($name == 'holderResult') {
				$name = 'standResult';
			}


			include_partial($name, $arrRefer);

		?>


	<?php else : ?>

	<div style="xcolor:#000; xborder:1px solid gray; padding:28px 12px; font-size:22px;">
		对不起，没有找到符合条件的产品。
	</div>

	<?php endif ?>

<?php endif ?>

<?php endif ?>

<?php

$uri	= $pager->getPageUri();
$action	= $sf_context->getActionName();

include_partial('global/pager', array('pager' => $pager, 'pageUri' => url_for($strModuleName . '/' . $action) . $uri));
?>







</div>
</div>
</div>






<?php

	$strJSONOption	= json_encode($arrOption);
#	Debug::pr($strJSONOption);
#	Debug::pr($arrOption);
#	Debug::pr($arrOption['products']);

?>


<script type="text/javascript">

<?php
echo	sprintf("var arrOption	= %s;", $strJSONOption);

echo	sprintf("var glbFormProduct	= %d;", $sf_request->getParameter('product', 0));

echo	sprintf("var glbFormClasses	= ',%s,';", implode(',', $sf_request->getParameter('classes', array())));

echo	sprintf("var glbFormTags	= %s", json_encode((array) $sf_request->getParameter('checked_product', array())));
?>

var objForm		= $('search_form');
var cfgOption;

cfgOption		= {
				'data':		arrOption,
				'form':		objForm
			};
var objColumn_1		= new MatcherTab(cfgOption);

///////////////////////////////////////////////////////

cfgOption		= {
				'data':		arrOption,
				'form':		objForm,
				'td_from':	'select_2_1',
				'td_to':	'select_2_2',
				'key_from':	'camera',
				'key_to':	'camera_model'
			};
var objColumn_2		= new MatcherSelect(cfgOption);

cfgOption		= {
				'data':		arrOption,
				'form':		objForm,
				'td_from':	'select_2_1_lens',
				'td_to':	'select_2_2_lens',
				'key_from':	'lens',
				'key_to':	'lens_model'
			};
var objColumn_2_b		= new MatcherSelect(cfgOption);

///////////////////////////////////////////////////////

cfgOption		= {
				'data':		arrOption,
				'form':		objForm,
				'td_from':	'select_4_1',
				'td_to':	'select_4_2',
				'key_from':	'camera',
				'key_to':	'camera_model'
			};
var objColumn_4_1		= new MatcherSelect(cfgOption);

cfgOption		= {
				'data':		arrOption,
				'form':		objForm,
				'td_from':	'select_4_3',
				'td_to':	'select_4_4',
				'key_from':	'lens',
				'key_to':	'lens_model'
			};
var objColumn_4_2		= new MatcherSelect(cfgOption);


</script>


</form>


<?php
#	Debug::pr(SofavDB_Debug_PDO::getTimer());
