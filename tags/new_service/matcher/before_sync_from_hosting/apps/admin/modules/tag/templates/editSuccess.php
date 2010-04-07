<?php

/**
 * Template of [tag/listSuccess]
 *
 */

#var_dump($type);
#var_dump($strModuleName);

?>

<div class="contentBox">

	<div class="boxHeader">

		<h3>修改<?php echo $brandName ?> - <?php echo S::E($dataItem->name) ?></h3>

		<div class="">

			<form name="theForm" id="id_tag_edit" action="<?php echo url_for($strModuleName . '/save') ?>" method="post">
			<input type="hidden" name="from" value="index" />
			<input type="hidden" name="id" value="<?php echo $dataItem->id ?>" />
			<input type="hidden" name="type" value="<?php echo $type ?>" />
			<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />

			<table>
			<tr>
				<td>商品类型</td>
				<td>
					<select name="product_id">
					<?php
						echo	options_for_select($arrProducts, $dataItem->product_id);
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>标签</td>
				<td>
					<input type="text" id="id_add_input" name="name" value="<?php echo S::E($dataItem->name) ?>" />
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" id="id_form_submit" value="保存" />

					<a href="<?php echo url_for($strModuleName . '/index') ?>" id="id_clear_add_input">取消</a>
				</td>
			</tr>
			</table>

			</form>

		</div>


	</div>



</div><!-- EndOf contentBox -->



<script type="text/javascript">

$('id_form_submit').disabled	= false;

</script>


<?php

#	Debug::pr(SofavDB_Debug_PDO::getTimer());

