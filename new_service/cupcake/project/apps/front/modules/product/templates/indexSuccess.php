

<form method="post" action="<?php echo url_for('cart/create') ?>">

<table class="product_list" border="1">

<tr>
	<td width="32">序号</td>
	<td width="160">单价/数量</td>
	<td>产品信息</td>
</tr>

<?php

foreach ($arrResult as $key => $item) :
	
	
?>


<tr>
	<td><?php echo $item['id'] ?></td>
	<td>
		<input type="checkbox" name="product_checked[<?php echo $item['id'] ?>]" value="1" class="" id="" />
		￥ <?php echo $item['price'] ?> RMB
		
		<br/>
		<input type="text" name="product_qty[<?php echo $item['id'] ?>]" value="1" class="product_qty" />
		
	</td>
	<td>
		
		<h4 class="title"><?php echo $item['name'] ?></h4>
		
		<p class="abstract">
			<?php echo $item['abstract'] ?>
		</p>
		
		
	</td>
</tr>



<?php

endforeach;

?>

</table>




<p>
	
<input type="submit" value="添加到购物车" />

</p>

</form>

