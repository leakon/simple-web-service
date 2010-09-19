
<h1>Step 3</h1>

<form method="get" action="<?php echo url_for('cart/payOrder') ?>">

<input type="hidden" name="order_id" value="<?php echo $strOrderID ?>" />

<p>
	<input type="radio" name="pay_method" value="cash" id="pay_cash" />
	<label for="pay_cash">现金支付 货到付款</label>
</p>

<p>
	<input type="radio" name="pay_method" value="alipay" id="pay_alipay" />
	<label for="pay_alipay">支付宝支付</label>
</p>

<p>
<input type="submit" value="下一步" class="" />
</p>

</form>


