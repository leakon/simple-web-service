<?php

/*

中文

*/

?>
	<div class="menuFolat" style="height:50px;"><img src="/images/Menu_top.png" alt="" width="202" height="43" /></div>
	<div class="menutContentLeft">
	<dl>
	<dt><img src="/images/Menu_.gif" alt="" /></dt>
	<dd><a href="<?php echo url_for('en/cupcakes') ?>"><img src="/images/Menu_01.gif" alt="" border="0" /></a></dd>
	<dd><img src="/images/Menu_08_1.gif" alt="" width="146" height="23" /></dd>


	</dl>


	</div>
	<div class="menuContentRight">
	<div style="height:330px; overflow-y:scroll">

<?php if (1) : ?>

	<?php

	echo	App_Menu::getLangMenuHtml('en');

	?>

<?php else : ?>

	<p><strong>PANINI</strong>
		<br />Tomato chutney, Fresh basil, Cheese <span>￥38.00/RMB</span>
		<br />Smoked chicken, Sautéed mushrooms, Cheese <span>￥48.00/RMB</span>
		<br />Sautéed beef, Red pepper, Onion, Emmental Cheese <span>￥48.00/RMB</span>
	</p>


	<p><strong>BAGEL</strong>
		<br />Bacon, Egg mayo, Tomato, Butter Lettuce <span>￥38.00/RMB</span>
		<br />Smoked salmon, Lemon Cream cheese,   Spring onion, Cucumber, Rocket <span>￥58.00/RMB</span>
		<br />Roasted chicken leg, Tomato, Butter Lettuce <span>￥48.00/RMB</span>
	</p>


	<p><strong>WRAP</strong>
		<br />Ham, Hoi Sin Sauce, Bell Peper, Onion, Cucumber, Romaine Lettuce <span>￥48.00/RMB</span>
		<br />Peking  duck,  Hoi Sin sauce,  Pesto,  Cucumber,  Spring  onion,   Prawn  cracker,   Buttercup lettuce  <span>￥48.00/RMB</span>
		<br />Tuna salad, Emmental Cheese, Cesar dressing <span>￥48.00/RMB</span>
	</p>


	<p><strong>BAGUETTE</strong>
		<br />Smoked chicken, Avocado, Crab meat, Tomatoes, Lime mayonnaise,  Romaine lettuce <span>￥48.00/RMB</span>
	</p>


	<p><strong>SALAD</strong>
		<br />Tuna Niçoise <span>￥48.00/RMB</span>
		<br />Roasted cauliflower, Radicchio, Feta, Bacon, Crouton,  Quail egg,  Red grapes,  Red wine dressing <span>￥48.00/RMB</span>
		<br />Warm Mushroom and Bacon Salad <span>￥48.00/RMB</span>
	</p>

	<p><strong>SOUP</strong>
		<br />Pumpkin soup <span>￥28.00/RMB</span>
		<br />Asparagus soup <span>￥28.00/RMB</span>
		<br />Creamy Mushroom Soup <span>￥28.00/RMB</span>
		<br />Potato Leek Soup <span>￥28.00/RMB</span>
	</p>

	<!--
	<p><strong>Others</strong>
		<br />Baked Potato, Coleslaw, Side Salad <span>￥38.00/RMB</span>
			With Tuna <span>￥48.00/RMB</span>
		<br />Baked Potato, baked beans with cheese, Side Salad <span>￥38.00/RMB</span>
		<br />Pita bread with bacon, mixed mushroom, rocket lettuce, Side Salad <span>￥48.00/RMB</span>
	</p>
	-->

	<p><strong>QUICHE</strong>
		<br />Bacon and spinach Quiche <span>￥48.00/RMB</span>
		<br />Mushroom and tomato Quiche <span>￥38.00/RMB</span>
	</p>

	<p><strong>SIDE DISH</strong>
		<br />Nature Yoghurt with Fruit Salsa <span>￥39.00/RMB</span>
	</p>

<?php endif ?>


	</div>
	</div>