
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

				<?php

					echo	MyHelp::showBagVolume($dataItem);


				?>
	</li>
	</ul>

		<?php endforeach ?>


