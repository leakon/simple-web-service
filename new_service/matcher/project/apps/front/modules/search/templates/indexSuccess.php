
<div id="mainContent">

<?php

#	Debug::pr($arrOption);
	$strJSONOption	= json_encode($arrOption);
#	Debug::pr($strJSONOption);

?>

<script type="text/javascript">

<?php
echo	sprintf("var arrOption	= '%s'", $strJSONOption);
?>

</script>



	<div class="logo"><img src="/matcher/images/logo.png" alt="logo" /><h2>Matcher</h2></div>

	<h4>选择您需要的产品</h4>


	<div class="condition">

		<form id="search_form" action="<?php echo url_for('search/result') ?>" method="get">
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
				<td><a href="javascript:;" id="">摄影包</a></td>
				<td><a href="javascript:;" id="">脚架</a></td>
				<td><a href="javascript:;" id="">云台</a></td>
				<td><a href="javascript:;" id="">滤镜</a></td>
			</tr>
			</table>
		</div>

		<div class="div_selector">

			<div id="id_product_1">

				<table class="tbl_selector">
				<tr>
					<td>1. 选择您的相机品牌</td>
					<td>2. 选择您的相机型号</td>
				</tr>
				<tr>
					<td>
						<select size="2" class="se_selector">
							<option value="canon">canon</option>
							<option value="nikon">nikon</option>
							<option value="ricon">ricon</option>
							<option value="sony">sony</option>
							<option value="kodak">kodak</option>
							<option value="olympus">olympus</option>
						</select>

					</td>
					<td>

					</td>
				</tr>
				</table>
			</div>


		</div>

		<div class="div_button">

			<input type="submit" value="查找" />

		</div>


		<div class="div_filter">

		</div>



		</div>


	</div>


	<div class="div_result">

	</div>


</div>



<script type="text/javascript">


</script>

