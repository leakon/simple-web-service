

<form method="get" id="id_main_form" action="<?php echo url_for('cart/payOrder') ?>">

<input type="hidden" name="lang" value="ch" />
<input type="hidden" name="order_id" value="<?php echo $strOrderID ?>" />


	<div class="OrderingFolat"><img src="/images_ch/Ordering_top.png" alt="" width="413" height="43" /></div>

	<div class="OrderingContent">
	<div class="title"><img src="/images_ch/Ordering_t03.gif" alt="" width="181" height="24" />
	  <p>
选择您的付款方式。</p></div>

	<div class="bank">

	<input type="radio" name="pay_method" value="cash" id="pay_cash" />

	<label for="pay_cash">
	<a href="javascript:;" target="_self" onclick="return true;"><img src="/images_ch/Ordering_step3_01.gif" alt="" width="142" height="42" border="0" align="absmiddle" /></a><br />
	</label>

    </div>



	<div class="bank">

	<input type="radio" name="pay_method" value="alipay" id="pay_alipay" />
	<label for="pay_alipay">
	<a href="javascript:;" target="_self" onclick="return true;"><img src="/images_ch/Ordering_step3_02.gif" alt="" width="142" height="42" border="0" align="absmiddle" /></a><br />
	</label>


    </div>



<div class="bank">

	<input type="radio" name="pay_method" value="paypal" id="pay_paypal" />
	<label for="pay_paypal">
	<a href="javascript:;" target="_self" onclick="return true;"><img src="/images_ch/Ordering_step3_03.gif" alt="" width="142" height="42" border="0" align="absmiddle" /></a><br />
	</label>

    </div>



	<div class="title">
        <h2>总计:<span>￥<?php echo $intTotal ?>/RMB</span></h2>
        <a href="javascript:;" onclick="SubmitOrderForm('id_main_form');"><img src="/images_ch/Ordering_04.gif" alt="" border="0" align="absmiddle" /></a> <span>单击下一步，将弹出付款页面。</span></div>


	</div>


</form>


