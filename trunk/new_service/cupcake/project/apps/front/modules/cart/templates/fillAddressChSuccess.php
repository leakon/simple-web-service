
<script>

</script>

<form method="post" id="id_main_form" action="<?php echo url_for('cart/saveAddress') ?>">

<input type="hidden" name="lang" value="ch" />
<input type="hidden" name="order_id" value="<?php echo $strCartID ?>" />


	<div class="OrderingFolat"><img src="/images_ch/Ordering_top.png" alt="" width="413" height="43" /></div>

	<div class="OrderingContent">
	<div class="title"><img src="/images_ch/Ordering_t02.gif" alt="" width="181" height="24" />
	  <p >
输入您的相关信息。</p></div>

	<table width="100%" border="0" cellspacing="0" cellpadding="6">
	 <tr>
    <td width="12%" align="right">送达日期</td>
    <td width="88%">

		<?php

			$arrConf	= array(

						'rich'		=> true,
						'size'		=> '',
						'calendar_button_img'	=> '/images/date_control.gif'

					);

			echo	input_date_tag('receive_day', date("Y-m-d", time() + 86400), $arrConf);

		?>



        </td>
  </tr>
   <tr>
    <td width="12%" align="right">送达时间</td>
    <td width="88%"><label>
        <select name="receive_time" size="1">
        	<?php
        		echo	Table_data_cart::genDeliverTimes();
        	?>
        </select>
        </label></td>
  </tr>
  <tr>
    <td width="12%" align="right">姓名</td>
    <td width="88%">

        <input type="text" name="customer_name" />    </td>
  </tr>
  <tr>
    <td align="right">电话号码</td>
    <td><input type="text" name="mobile" maxlength="20" /></td>
  </tr>
  <tr>
    <td align="right">地址</td>
    <td><input name="address" type="text" size="40" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


	<div class="title">
        <h2>总计:<span>￥<?php echo $intTotal ?>/RMB</span></h2>
        <a href="javascript:;" onclick="SubmitOrderForm('id_main_form', CheckAddrForm);"><img src="/images_ch/Ordering_04.gif" alt="" border="0" /></a> </div>


	</div>


</form>

