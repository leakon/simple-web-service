
<div id="left">

	<div id="leftInner">

	<table cellpadding="0" cellspacing="0" class="moduletable_menu">
		<tr>
			<th valign="top"><a href="home">首页</a></th>
		</tr>
		<tr>
			<th valign="top"><a href="introduction">公司简介</a></th>
		</tr>
		<tr>
			<th valign="top"><a href="lottery">彩票相关</a></th>
		</tr>
		<?php if ('lottery' == substr(BLUrl::getController(), 0, 7)) : ?>
		<tr>
		<td>
			<ul class="menu">
				<li class="item1"><a href="lottery_1">玩法介绍</a></li>
				<li class="item1"><a href="lottery_2">玩法介绍 2</a></li>
			</ul>
		</td>
		</tr>
		<?php endif ?>
		<tr>
			<th valign="top"><a href="recruiting">招聘信息</a></th>
		</tr>

		<?php if ('recruiting' == substr(BLUrl::getController(), 0, 10)) : ?>
		<tr>
		<td>
			<ul class="menu">
				<li class="item1"><a href="recruiting_gansu">甘肃省招聘信息</a></li>
			</ul>
		</td>
		</tr>
		<?php endif ?>

		<tr>
			<th valign="top"><a href="news">新闻</a></th>
		</tr>
	</table>

	</div>

	<div style="height:10px;"></div>

</div>
