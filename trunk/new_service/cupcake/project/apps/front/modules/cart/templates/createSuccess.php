

<form method="post" action="<?php echo url_for('cart/create') ?>">

<table class="cart_list" border="1">

<tr>
	<td width="96">商品</td>
	<td width="">名称</td>
	<td width="72">单价</td>
	<td width="72">数量</td>
	<td width="72">小记</td>
	<td width="72">操作</td>
</tr>

<?php

$fltTotal	= 0.00;

foreach ($arrResult as $key => $item) :
	
	
?>


<tr>
	<td><?php echo $item['pic'] ?> &nbsp;</td>
	<td>
		
		<h4 class="title"><?php echo $item['name'] ?></h4>
		
		<p class="abstract">
			<?php echo $item['abstract'] ?>
		</p>
		
		
	</td>
	
	<td>
	  
	<?php echo '￥ ' . $item['price'] ?>
	</td>
	
	<td>
	<input type="text" name="product_qty[<?php echo $item['id'] ?>]" value="<?php echo $arrProducts[ $item['id'] ] ?>" class="product_qty" />
	</td>
	
	<?php
		$fltTotal	+= $item['price'] * $arrProducts[ $item['id'] ];
	?>
	
	<td><?php echo '￥ ' . ($item['price'] * $arrProducts[ $item['id'] ]) ?></td>
	
	
	<td>
		<a href="javascript:;" onclick="">删除</a>
	</td>
	
</tr>



<?php

endforeach;

?>

</table>


<p>
	
总价：￥ <?php echo $fltTotal ?> 

</p>


<p>
	
<input type="submit" value="结算" />

</p>

</form>

