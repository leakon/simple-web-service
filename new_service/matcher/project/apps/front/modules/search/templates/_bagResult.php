
		<?php foreach ($arrResult as $dataItem) : ?>
	<ul>
	<li class="li1">

				<?php

					if (strlen($dataItem['pic'])) {

						echo	sprintf('<a href="%s" target="_blank"><img src="%s" class="list_img" alt="" border="0" /></a>',
								$dataItem['link'],
								$webUploadDir . $dataItem['pic']
								);

					} else {

						echo	'&nbsp;';

					}

				?>

		</li>
	<li class="li2">
		<?php

		#	echo S::E($dataItem['style']);

			echo	sprintf('<a href="%s" target="_blank">%s</a>', $dataItem['link'], S::E($dataItem['style']));

		?>

	</li>
	<li class="li3">

				<?php

					echo	MyHelp::showBagVolume($dataItem);


				?>
	</li>
	</ul>

		<?php endforeach ?>

<?php

#	Debug::pr($arrResult);


