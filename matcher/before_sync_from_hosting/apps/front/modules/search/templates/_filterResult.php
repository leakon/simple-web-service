<?php foreach ($arrResult as $dataItem) : ?>
	<ul>
	<li class="li1">
				<?php

					if (strlen($dataItem['pic'])) {

						echo	sprintf('<img src="%s" class="list_img" alt="" />', $webUploadDir . $dataItem['pic']);

					} else {

						echo	'&nbsp;';

					}

				?>

		</li>
	<li class="li2"><?php echo S::E($dataItem['style']) ?></li>
	<li class="li3">
		<p><?php echo S::E($dataItem['detail'], 1) ?></p>
		<a href="<?php echo S::E($dataItem['link']) ?>" target="_blank"><?php echo S::E($dataItem['link']) ?></a>
	</li>
	</ul>

		<?php endforeach ?>



<?php if (0) : ?>
	<table class="item_list tag_list result" cellspacing="1" id="id_list_result_box">
	<thead>
		<tr>
			<th width="">品牌</th>
			<th width="">型号</th>
			<th width="">图片</th>
			<th width="">标签</th>
			<th width="">链接</th>
			<th width="">价格区间</th>
		</tr>
	</thead>
	<tbody>

		<?php foreach ($arrResult as $dataItem) : ?>
		<tr>
			<td><?php echo S::E($arrOption['products'][$partial_name][$dataItem['product_id']]) ?></td>
			<td><?php echo S::E($dataItem['style']) ?></td>
			<td>
				<?php

					if (strlen($dataItem['pic'])) {

						echo	sprintf('<img src="%s" class="list_img" alt="" />', $webUploadDir . $dataItem['pic']);

					} else {

						echo	'&nbsp;';

					}

				?>

			</td>
			<td>
				<?php

					echo	MyHelp::showInlineTag($arrOption['tags'][$partial_name], $dataItem['id'], ', ');

				?>
				&nbsp;
			</td>
			<td><a href="<?php echo S::E($dataItem['link']) ?>" target="_blank"><?php echo S::E($dataItem['link']) ?></a></td>
			<td><?php echo $arrOption['price'][$dataItem['price_id']] ?></td>
		</tr>
		<?php endforeach ?>
	</tbody>
	</table>

<?php endif ?>
