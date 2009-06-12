

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

