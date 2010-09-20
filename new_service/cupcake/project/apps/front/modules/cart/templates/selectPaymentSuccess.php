

<form method="get" id="id_main_form" action="<?php echo url_for('cart/payOrder') ?>">

<input type="hidden" name="order_id" value="<?php echo $strOrderID ?>" />


	<div class="OrderingFolat"><img src="/images/Ordering_top.png" alt="" width="413" height="43" /></div>

	<div class="OrderingContent">
	<div class="title"><img src="/images/Ordering_t03.gif" alt="" width="181" height="24" />
	  <p>
Select your payment method</p></div>

	<div class="bank">

	<input type="radio" name="pay_method" value="cash" id="pay_cash" />

	<label for="pay_cash">
	<a href="#" target="_self"><img src="/images/Ordering_step3_01.gif" alt="" width="142" height="42" border="0" align="absmiddle" /></a><br />
	</label>

    </div>



	<div class="bank">

	<input type="radio" name="pay_method" value="alipay" id="pay_alipay" />
	<label for="pay_alipay">
	<a href="#" target="_self"><img src="/images/Ordering_step3_02.gif" alt="" width="142" height="42" border="0" align="absmiddle" /></a><br />
	</label>


    </div>



<div class="bank">

	<input type="radio" name="pay_method" value="paypal" id="pay_paypal" />
	<label for="pay_paypal">
	<a href="#" target="_self"><img src="/images/Ordering_step3_03.gif" alt="" width="142" height="42" border="0" align="absmiddle" /></a><br />
	</label>

    </div>



	<div class="title">
        <h2>Total:<span>￥220/RMB</span></h2>
        <a href="javascript:;" onclick="SubmitOrderForm('id_main_form');"><img src="/images/Ordering_04.gif" alt="" border="0" align="absmiddle" /></a> <span>When you click next, the payment page will popup</span></div>


	</div>


</form>


