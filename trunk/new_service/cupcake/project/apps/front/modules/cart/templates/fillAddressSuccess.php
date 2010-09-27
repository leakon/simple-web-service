
<script>

function CheckAddrForm(objForm) {

	var boolRet	= false;

	try {

		if (objForm.customer_name.value.length < 1) {
			throw('Name is empty');
		}

		var regMobile	= /^[0-9]{11}$/;

		if (!regMobile.test(objForm.mobile.value)) {
			throw('Phone number is not valid (Example:13800138000)');
		}

		if (objForm.address.value.length < 1) {
			throw('Address is empty');
		}

		boolRet		= true;

	} catch (exception) {

		alert(exception);

	}



	return	boolRet;

}


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
    <td width="12%" align="right">Delivery Day</td>
    <td width="88%">

		<?php

			$arrConf	= array(

						'rich'		=> true,
						'size'		=> '',
						'calendar_button_img'	=> '/images/date_control.gif'

					);

			echo	input_date_tag('receive_day', date("Y-m-d"), $arrConf);

		?>



        </td>
  </tr>
   <tr>
    <td width="12%" align="right">Delivery Time</td>
    <td width="88%"><label>
        <select name="receive_time" size="1">
			<option value="10:00">10:00am</option>
			<option value="11:00">11:00am</option>
			<option value="12:00">12:00pm</option>
			<option value="13:00">13:00pm</option>
			<option value="14:00">14:00pm</option>
			<option value="15:00">15:00pm</option>
			<option value="16:00">16:00pm</option>
			<option value="17:00">17:00pm</option>
			<option value="18:00">18:00pm</option>
			<option value="19:00">19:00pm</option>
			<option value="20:00">20:00pm</option>
			<option value="21:00">21:00pm</option>
        </select>
        </label></td>
  </tr>
  <tr>
    <td width="12%" align="right">Name</td>
    <td width="88%">

        <input type="text" name="customer_name" />    </td>
  </tr>
  <tr>
    <td align="right">Phone number</td>
    <td><input type="text" name="mobile" maxlength="11" /></td>
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

