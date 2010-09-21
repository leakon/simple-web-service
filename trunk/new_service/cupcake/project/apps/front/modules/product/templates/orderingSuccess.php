
<script>
	
function CalSum() {
	
//	alert(jQuery(this).attr('id'));
	
	
	var intTotal	= 0;
	
	jQuery('input:checkbox').each(function() {
				
				
			var objTarget	= jQuery(this);
			
			var strProdID	= '';
			var strQtyID	= '';
			
			var objQty	= null;
			
			if (objTarget.attr('checked') === true) {
				
			//	alert(objTarget.attr('id'));
				
				strProdID	= objTarget.attr('id');
				
				strQtyID	= strProdID.replace('product', 'qty');
				
				objQty		= jQuery('#' + strQtyID);
				
				if (objQty.length) {
					
					intTotal	+= parseInt(objQty.attr('value'));
				}
				
			}
			
		});
	
	var intSum	= intTotal * 23;
	
	// 计算折扣
	
	var strSum	= intSum > 0 ? intSum : '0';
	
	jQuery('#id_sum').html(strSum);
	
	
}

jQuery(function() {
	
//	CalSum();	
	
	jQuery('input:checkbox').each(function() {
				
				jQuery(this).bind('click', CalSum);
		
		});
		
	jQuery('input:text').each(function() {
		
				jQuery(this).bind('blur', CalSum);
		
		});
	
});
	
</script>

<form method="post" id="id_order_form" action="<?php echo url_for('cart/create') ?>">

    <div class="OrderingFolat"><img src="/images/Ordering_top.png" alt="" width="413" height="43" /></div>
    <div class="OrderingContent">
      <div class="title"><img src="/images/Ordering_t01.gif" alt="" /><p style="padding-top:5px; margin-bottom:-10px;">Please allow a day notice so we can bake them fresh for you.</p></div>

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
            <td width="28"><input type="text" name="product_qty[<?php echo $item['id'] ?>]" value="1" style="width:16px;" class="product_qty" id="qty_<?php echo $item['id'] ?>" />
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
			<h2><?php echo $item['name'] ?></h2>

              <?php echo $item['detail'] ?>

               <h3>￥<?php echo (int) $item['price'] ?>/RMB</h3>
            </td>
            <td width="28"><input type="text" name="product_qty[<?php echo $item['id'] ?>]" value="1" style="width:16px;" class="product_qty" id="qty_<?php echo $item['id'] ?>" />
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
        <a href="javascript:;" onclick="SubmitOrderForm('id_order_form');"><img src="/images/Ordering_04.gif" alt="" border="0" /></a> </div>
    </div>



</form>

