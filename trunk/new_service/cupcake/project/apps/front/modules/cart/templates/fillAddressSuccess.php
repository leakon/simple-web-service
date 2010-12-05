
<script>

</script>

<form method="post" id="id_main_form" action="<?php echo url_for('cart/saveAddress') ?>">

<input type="hidden" name="order_id" value="<?php echo $strCartID ?>" />


	<div class="OrderingFolat"><img src="/images/Ordering_top.png" alt="" width="413" height="43" /></div>

	<div class="OrderingContent">
	<div class="title"><img src="/images/Ordering_t02.gif" alt="" width="181" height="24" />
	  <p >
Input your delivery infomation</p></div>

<table width="100%" border="0" cellspacing="0" cellpadding="6">
  <tr>
    <td width="12%" align="right">Name</td>
    <td width="88%">

        <input type="text" name="customer_name" />    </td>
  </tr>
  <tr>
    <td align="right">Phone number</td>
    <td><input type="text" name="mobile" maxlength="20" /></td>
  </tr>
  <tr>
    <td align="right">Address</td>
    <td><input name="address" type="text" size="40" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


	<div class="title">
        <h2>Total:<span>￥<?php echo $intTotal ?>/RMB</span></h2>
        <a href="javascript:;" onclick="SubmitOrderForm('id_main_form', CheckAddrForm);"><img src="/images/Ordering_04.gif" alt="" border="0" /></a> </div>


	</div>


</form>

