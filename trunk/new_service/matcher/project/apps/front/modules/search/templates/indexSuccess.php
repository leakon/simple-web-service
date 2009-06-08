
<form id="search_form" action="<?php echo url_for('search/result') ?>" method="get">
<input type="hidden" name="from" value="result" />
<input type="hidden" name="type" value="<?php echo $sf_request->getParameter('type', '') ?>" />
<input type="hidden" name="camera_id" value="<?php echo $sf_request->getParameter('camera_id', '') ?>" />
<input type="hidden" name="camera_model_id" value="<?php echo $sf_request->getParameter('camera_model_id', '') ?>" />
<input type="hidden" name="lens_id" value="<?php echo $sf_request->getParameter('lens_id', '') ?>" />
<input type="hidden" name="lens_model_id" value="<?php echo $sf_request->getParameter('lens_model_id', '') ?>" />


<h2>请选择您所需要的产</h2>
<!--滑动开始-->
<div class="movoewer fun">
<ul>
<li class="btu_off"><a href="javascript:;" id="id_tab_bag"><span>摄影包</span></a></li>
<li class="btu_off"><a href="javascript:;" id="id_tab_stand"><span>脚架</span></a></li>
<li class="btu_off"><a href="javascript:;" id="id_tab_holder"><span>云台</span></a></li>
<li class="btu_off"><a href="javascript:;" id="id_tab_filter"><span>滤镜</span></a></li>
</ul>

	<!--滑动第1个开始-->
	<div class="clear" id=id_product_1 style="display:none">
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

<!--查询按钮开始-->
<div class="search"><a href="javascript:;" onclick="$('search_form').submit()"><img src="/matcher/images_tpl/search.gif"></a></div>
<!--查询按钮结束-->




<div class="search_y">
<div class="lines2"></div>
<p><span>品牌:</span>
	<span id="cont_product_box"></span>
</p>

<p>
<span>标签:</span>
	<span id="cont_tag_box"></span>
</p>

<p>
<span>价格区间:</span>
	<span>
				<select name="price_id">
				<?php
					echo	options_for_select($arrOption['price'], $sf_request->getParameter('price_id', 0));
				?>
				</select>
	</span>
</p>

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

<?php if (0) : ?>
	<ul>
	<li class="li1"><a href=""><img src="/matcher/images_tpl/photo.gif" alt="100X100px"></a></li>
	<li class="li2">国家地理 W8120 单肩摄影包</li>
	<li class="li3"><a href=""><img src="/matcher/images_tpl/smalphoto.gif" alt="背包图片"></a>
	<a href=""><img src="/matcher/images_tpl/smalphoto.gif" alt="背包图片"></a>
	<a href=""><img src="/matcher/images_tpl/smalphoto.gif" alt="背包图片"></a>
	<a href=""><img src="/matcher/images_tpl/smalphoto.gif" alt="背包图片"></a>
	<a href=""><img src="/matcher/images_tpl/smalphoto.gif" alt="背包图片"></a>
	<a href=""><img src="/matcher/images_tpl/smalphoto.gif" alt="背包图片"></a>
	<a href=""><img src="/matcher/images_tpl/smalphoto.gif" alt="背包图片"></a>
	<a href=""><img src="/matcher/images_tpl/smalphoto.gif" alt="背包图片"></a>
	<a href=""><img src="/matcher/images_tpl/smalphoto.gif" alt="背包图片"></a>
	<a href=""><img src="/matcher/images_tpl/smalphoto.gif" alt="背包图片"></a>
	<a href=""><img src="/matcher/images_tpl/smalphoto.gif" alt="背包图片"></a>
	<a href=""><img src="/matcher/images_tpl/smalphoto.gif" alt="背包图片"></a>
	<a href=""><img src="/matcher/images_tpl/smalphoto.gif" alt="背包图片"></a>
	<a href=""><img src="/matcher/images_tpl/smalphoto.gif" alt="背包图片"></a>
	<a href=""><img src="/matcher/images_tpl/smalphoto.gif" alt="背包图片"></a>
	<a href=""><img src="/matcher/images_tpl/smalphoto.gif" alt="背包图片"></a>
	</li>
	</ul>
<?php endif ?>

<?php

$uri	= $pager->getPageUri();
$action	= $sf_context->getActionName();

include_partial('global/pager', array('pager' => $pager, 'pageUri' => url_for($strModuleName . '/' . $action) . $uri));
?>

<div class="lines"></div>





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

echo	sprintf("var glbFormTags	= %s", json_encode((array) $sf_request->getParameter('checked_product', array())));
?>

var objForm		= $('search_form');
var cfgOption;

cfgOption		= {
				'data':		arrOption,
				'form':		objForm
			};
var objColumn_2		= new MatcherTab(cfgOption);

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


