
<h1>Step 2</h1>

<form method="post" action="<?php echo url_for('cart/saveAddress') ?>">

<input type="hidden" name="order_id" value="<?php echo $strCartID ?>" />

<table class="cart_list" border="1">

<tr>
	<td width="100">姓名</td>
	<td width="">
		<input type="text" name="name" value="" class="customer_name" />
	</td>
</tr>

<tr>
	<td width="">手机</td>
	<td width="">
		<input type="text" name="mobile" value="" class="customer_mobile" />
	</td>
</tr>

<tr>
	<td width="">地址</td>
	<td width="">
		<input type="text" name="address" value="" class="customer_addr" />
	</td>
</tr>

<tr>
	<td width="">送货日期</td>
	<td width="">
		<input type="text" name="receive_time" value="" class="" />
	</td>
</tr>

<tr>
	<td width="">&nbsp;</td>
	<td width="">
		<input type="submit" value="下一步" class="" />
	</td>
</tr>


</table>

</form>


