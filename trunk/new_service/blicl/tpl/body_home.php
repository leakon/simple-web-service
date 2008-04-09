<?php

/*

首页模板

*/

?>



	<div id="wrapper2" class="clearfix" >

		<div id="twocols" class="clearfix">

					<div id="maincol" style="width:575px;">


			<div style="clear:both;">


<table class="blog" cellpadding="0" cellspacing="0">


<tr>
<td valign="top">
	<table width="100%"  cellpadding="0" cellspacing="0">
	<tr>
	<td valign="top" width="50%" class="article_column">

		<table class="contentpaneopen">
			<tr>
				<td class="contentheading" width="100%">多金彩 乐开怀</td>
			</tr>
		</table>

		<table class="contentpaneopen">
		<tr>
			<td valign="top" colspan="2">

			<div align="center">


	<table cellpadding="0" cellspacing="0" class="floatLeft" style="width:550px;">
		<tr>
			<td valign="top">
				<img src="images/habao1.jpg" style="width:260px;" />
			</td>
			<td valign="top">
				<img src="images/habao2.jpg" style="width:260px;" />
			</td>
		</tr>
	</table>
			</div>

			</td>

		</tr>
		</table>

	</td>
	</tr>
	</table>
</td>
</tr>

</table>


</div>

</div>

</div>


<?php
BLTemplate::showTemplate('menu');
?>




	</div>

	<div id="border_bottom"></div>

	<div class="longLine">

	<table cellpadding="0" cellspacing="0" class="moduletable_menu">
		<tr>
			<th valign="top">彩票相关</th>
		</tr>
	</table>

<?php

$itemWidth	= 140;

?>

		<table border="0" cellspacing="8" cellpadding="0" width="600" class="L19 nav2">
		<tbody>
		<tr align="center">

			<td>
				<a href="#"><img src="images/CSL0001UC.jpg" border="0" alt="CSL0001UC" width="<?php echo $itemWidth ?>" /></a>
				<br />
				<strong><font color="#0088d0">激情·梦想</font></strong>
				<br />
				大奖：25万游戏币<br />每次：10个游戏币
				<br />
				<strong>[</strong>
				<a href="#"><strong>立即体验</strong></a>
				<strong>]</strong>
			</td>

			<td>
				<a href="#"><img src="images/CSL0002UC.jpg" border="0" alt="CSL0001UC" width="<?php echo $itemWidth ?>" /></a>
				<br />
				<strong><font color="#0088d0">激情·梦想</font></strong>
				<br />
				大奖：25万游戏币<br />每次：10个游戏币
				<br />
				<strong>[</strong>
				<a href="#"><strong>立即体验</strong></a>
				<strong>]</strong>
			</td>
			<td>
				<a href="#"><img src="images/CSL0003UC.jpg" border="0" alt="CSL0001UC" width="<?php echo $itemWidth ?>" /></a>
				<br />
				<strong><font color="#0088d0">激情·梦想</font></strong>
				<br />
				大奖：25万游戏币<br />每次：10个游戏币
				<br />
				<strong>[</strong>
				<a href="#"><strong>立即体验</strong></a>
				<strong>]</strong>
			</td>
			<td>
				<a href="#"><img src="images/CSL0004UC.jpg" border="0" alt="CSL0001UC" width="<?php echo $itemWidth ?>" /></a>
				<br />
				<strong><font color="#0088d0">激情·梦想</font></strong>
				<br />
				大奖：25万游戏币<br />每次：10个游戏币
				<br />
				<strong>[</strong>
				<a href="#"><strong>立即体验</strong></a>
				<strong>]</strong>
			</td>
			<td>
				<a href="#"><img src="images/CSL0005UC.jpg" border="0" alt="CSL0001UC" width="<?php echo $itemWidth ?>" /></a>
				<br />
				<strong><font color="#0088d0">激情·梦想</font></strong>
				<br />
				大奖：25万游戏币<br />每次：10个游戏币
				<br />
				<strong>[</strong>
				<a href="#"><strong>立即体验</strong></a>
				<strong>]</strong>
			</td>
				</tr>
			</tbody>
		</table>


	</div>


	<div class="longLine">

	<table cellpadding="0" cellspacing="0" class="moduletable_menu">
		<tr>
			<th valign="top">新闻</th>
		</tr>
	</table>

	<div style="clear:both; height:1px;">&nbsp;</div>

	<table cellpadding="0" cellspacing="0" class="floatLeft" style="width:240px;">
		<tr>
			<td valign="top">

				<marquee direction="up" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="2" scrolldelay="10" style="height:452px;">



				<ul>
					<?php for ($i = 0; $i < 40; $i++) : ?>
					<li><a href="news_item_1" >相关新闻标题 <?php echo $i ?></a></li>
					<?php endfor ?>

				</ul>




				</marquee>




			</td>
		</tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="floatLeft" style="width:320px;">
		<tr>
			<td valign="top">
				<img src="images/news_pic_00.jpg" style="padding:3px 9px; width:300px;" />
			</td>
		</tr>
	</table>

	<table cellpadding="0" cellspacing="0" class="floatLeft" style="width:140px;">
		<tr>
			<td valign="top">

				<ul>
					<?php for ($i = 0; $i < 20; $i++) : ?>
					<li><a href="news_item_1" >介绍文字 <?php echo $i ?></a></li>
					<?php endfor ?>

				</ul>

			</td>
		</tr>
	</table>

	<div style="clear:both; height:1px;">&nbsp;</div>



	</div>
