
<div id="mainContent">

	<div class="logo"><img src="/matcher/images/logo.png" alt="logo" /><h2><a href="<?php echo url_for('search/index') ?>">Matcher</a></h2></div>

	<h4>选择您需要的产品</h4>


	<div class="condition">

		<form id="search_form" action="<?php echo url_for('search/result') ?>" method="get">
		<input type="hidden" name="from" value="result" />
		<input type="hidden" name="type" value="<?php echo $sf_request->getParameter('type', '') ?>" />
		<input type="hidden" name="camera_id" value="<?php echo $sf_request->getParameter('camera_id', '') ?>" />
		<input type="hidden" name="camera_model_id" value="<?php echo $sf_request->getParameter('camera_model_id', '') ?>" />
		<input type="hidden" name="lens_id" value="<?php echo $sf_request->getParameter('lens_id', '') ?>" />
		<input type="hidden" name="lens_model_id" value="<?php echo $sf_request->getParameter('lens_model_id', '') ?>" />

		<div class="product">
			<table>
			<tr>
				<td><a href="javascript:;" id="id_tab_bag">摄影包</a></td>
				<td><a href="javascript:;" id="id_tab_stand">脚架</a></td>
				<td><a href="javascript:;" id="id_tab_holder">云台</a></td>
				<td><a href="javascript:;" id="id_tab_filter">滤镜</a></td>
			</tr>
			</table>
		</div>

		<div class="div_selector">

			<div id="id_product_1" style="display:none">
				<table class="tbl_selector col_2">
				<tr>
					<td width="50%">1. 选择您的相机品牌</td>
					<td width="50%">2. 选择您的相机型号</td>
				</tr>
				<tr>
					<td id="select_2_1"></td>
					<td id="select_2_2"></td>
				</tr>
				</table>
			</div>

			<div id="id_product_2" style="display:none">
				<table class="tbl_selector col_4">
				<tr>
					<td width="25%">1. 选择您的相机品牌</td>
					<td width="25%">2. 选择您的相机型号</td>
					<td width="25%">3. 选择您的镜头品牌</td>
					<td width="25%">4. 选择您的镜头型号</td>
				</tr>
				<tr>
					<td id="select_4_1"></td>
					<td id="select_4_2"></td>
					<td id="select_4_3"></td>
					<td id="select_4_4"></td>
				</tr>
				</table>
			</div>

			<div id="id_product_3" style="display:none">
				<table class="tbl_selector col_2">
				<tr>
					<td width="50%">1. 选择您的镜头品牌</td>
					<td width="50%">2. 选择您的镜头型号</td>
				</tr>
				<tr>
					<td id="select_2_1_lens"></td>
					<td id="select_2_2_lens"></td>
				</tr>
				</table>
			</div>


		</div>

		<div class="div_button">

			<input type="submit" value="查找" />

		</div>


		<div class="div_filter">

			<table>
			<tr>
				<td>品牌</td>
				<td id="cont_product_box"></td>
			</tr>
			<tr>
				<td>标签</td>
				<td id="cont_tag_box"></td>
			</tr>
			<tr>
				<td>价格区间</td>
				<td>
				<select name="price_id">
				<?php
					echo	options_for_select($arrOption['price'], $sf_request->getParameter('price_id', 0));
				?>
				</select>

				</td>
			</tr>
			</table>

		</div>



	</div>


	<?php if ($showResult) : ?>



	<div class="div_result">

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

	对不起，没有找到符合条件的产品。

	<?php endif ?>

<?php endif ?>


<?php

$uri	= $pager->getPageUri();
$action	= $sf_context->getActionName();

include_partial('global/pager', array('pager' => $pager, 'pageUri' => url_for($strModuleName . '/' . $action) . $uri));
?>

	</div><!-- EndOf div.div_result -->

	<?php endif ?>


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

<script type="text/javascript">


</script>


<?php

#	Debug::pr(SofavDB_Debug_PDO::getTimer());


