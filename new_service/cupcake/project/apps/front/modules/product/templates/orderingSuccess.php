
<script>

</script>

<form method="post" id="id_order_form" action="<?php echo url_for('cart/create') ?>">

    <div class="OrderingFolat"><img src="/images/Ordering_top.png" alt="" width="413" height="43" /></div>
    <div class="OrderingContent">
      <div class="title"><img src="/images/Ordering_t01.gif" alt="" /><p style="padding-top:5px; margin-bottom:-10px;">Please allow a day notice so we can bake them fresh for you.</p></div>

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

			echo	input_date_tag('receive_day', date("Y-m-d", time() + 86400), $arrConf);

		?>



        </td>
  </tr>
   <tr>
    <td width="12%" align="right">Delivery Time</td>
    <td width="88%"><label>
        <select name="receive_time" size="1">

        	<?php
        		echo	Table_data_cart::genDeliverTimes();
        	?>

        </select>
        </label></td>
  </tr>
</table>


	  <div style="height:330px; overflow-y:scroll">


<?php
foreach ($arrResult_Common as $key => $item) :
?>


      <div class="list">
        <table width="296" height="110" border="0" cellspacing="0">
          <tr>
            <td width="20" align="center"><input type="checkbox" name="product_checked[<?php echo $item['id'] ?>]" value="1" class="" id="product_<?php echo $item['id'] ?>" />
            </td>
            <td width="57" align="center"><img src="<?php echo $item['pic'] ?>" width="53" height="63" alt="" /></td>
            <td width="197"><h2><?php echo $item['name'] ?></h2>

		<?php echo $item['detail'] ?>

              <h3>￥<?php echo (int) $item['price'] ?>/RMB</h3></td>
            <td width="28"><input type="text" name="product_qty[<?php echo $item['id'] ?>]" value="0" style="width:16px;" class="product_qty" id="qty_<?php echo $item['id'] ?>" />
            </td>
          </tr>
        </table>
      </div>


<?php
endforeach;
?>





      <div class="title"><img src="/images/Ordering_t02.png" alt="" width="931" height="40" /></div>


<?php
foreach ($arrResult_Special as $key => $item) :
?>


      <div class="list">
        <table width="296" height="135" border="0" cellspacing="0">
          <tr>
            <td width="20" align="center"><input type="checkbox" name="product_checked[<?php echo $item['id'] ?>]" value="1" class="" id="product_<?php echo $item['id'] ?>" />
            </td>
            <td width="57" align="center"><img src="<?php echo $item['pic'] ?>" width="53" height="63" alt="" /></td>
            <td width="197">
			<h1><?php echo $item['special'] ?></h1>
			<h2 id="prod_name_<?php echo $item['id'] ?>"><?php echo $item['name'] ?></h2>
			<input type="hidden" name="spec_days[<?php echo $item['id'] ?>]" value="<?php echo $item['spec_days'] ?>" id="id_spec_days_<?php echo $item['id'] ?>" />

              <?php echo $item['detail'] ?>

               <h3>￥<?php echo (int) $item['price'] ?>/RMB</h3>
            </td>
            <td width="28"><input type="text" name="product_qty[<?php echo $item['id'] ?>]" value="0" style="width:16px;" class="product_qty" id="qty_<?php echo $item['id'] ?>" />
            </td>
          </tr>
        </table>
      </div>


<?php
endforeach;
?>

	  </div>





	  <div class="clear"></div>

      <div class="title" style="padding-top:15px;">
        <h2>Total:<span>￥<span id="id_sum">0</span>/RMB</span></h2>
        <a href="javascript:;" onclick="SubmitOrderForm('id_order_form', CheckCakesQuantity);"><img src="/images/Ordering_04.gif" alt="" border="0" /></a> </div>
    </div>



</form>

