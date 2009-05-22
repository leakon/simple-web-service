
<div id="mainContent">

	<div class="logo"><img src="/matcher/images/logo.png" alt="logo" /><h2><a href="<?php echo url_for('search/index') ?>">Matcher</a></h2></div>

	<h4>选择您需要的产品</h4>


	<div class="condition">

		<form id="search_form" action="<?php echo url_for('search/result') ?>" method="get" target="_blank">
		<input type="hidden" name="from" value="result" />
		<input type="hidden" name="type" value="" />
		<input type="hidden" name="camera_id" value="" />
		<input type="hidden" name="camera_model_id" value="" />
		<input type="hidden" name="lens_id" value="" />
		<input type="hidden" name="lens_model_id" value="" />
		<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />

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
					echo	options_for_select($arrOption['price'], 1);
				?>
				</select>

				</td>
			</tr>
			</table>

		</div>



	</div>


	<div class="div_result">

<?php if (isset($arrResult)) : ?>

	<?php if (count($arrResult)) : ?>
	<table class="item_list tag_list" cellspacing="1" id="id_tag_list_box">
	<thead>
		<tr>
			<th width="100"><input type="checkbox" id="id_check_all" value="" />品牌</th>
			<th width="">图片</th>
			<th width="">型号</th>
			<th width="">标签</th>
			<th width="60">承重（Kg）</th>
			<th width="">链接</th>
			<th width="">价格区间</th>
			<th class="edit">操作</th>
		</tr>
	</thead>
	<tbody>

		<?php

		$idx	= ($pager->getPage() - 1) * $pager->getMaxPerPage() + 1 ;

		?>
		<?php foreach ($arrResult as $dataItem) : ?>
		<tr>
			<td>
<?php

	echo		sprintf('<input type="checkbox" name="checked_folder[%d]" value="%d" class="item_checkbox" />',
				$dataItem['id'], $dataItem['id']);

	echo		$arrProducts[$dataItem['product_id']];

?>
			</td>
			<td>
				<?php

					if (strlen($dataItem['pic'])) {

						echo	sprintf('<img src="%s" class="list_img" alt="" />', $webUploadDir . $dataItem['pic']);

					} else {

						echo	'&nbsp;';

					}

				?>

			</td>
			<td><?php echo S::E($dataItem['style']) ?></td>
			<td>
				<?php

					echo	MyHelp::showInlineTag($arrTags, $dataItem['id'], ', ');

				?>
				&nbsp;
			</td>
			<td><?php echo S::E($dataItem['weight']) ?></td>
			<td><a href="<?php echo S::E($dataItem['link']) ?>" target="_blank"><?php echo S::E($dataItem['link']) ?></a></td>
			<td><?php echo $arrStyles[$dataItem['price_id']] ?></td>
			<td class="edit tag_edit">
				<a href="<?php echo url_for($strModuleName . '/editModel?id=' . $dataItem['id']) ?>" class="tag_rn_btn">修改</a>
				<a href="javascript:;" onclick="FormDel('tag_delete_form', <?php echo $dataItem['id'] ?>);">删除</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
	</table>

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


</div>


<?php

	$strJSONOption	= json_encode($arrOption);
#	Debug::pr($strJSONOption);
#	Debug::pr($arrOption);
#	Debug::pr($arrOption['products']);

?>

<script type="text/javascript">

<?php
echo	sprintf("var arrOption	= %s", $strJSONOption);
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

