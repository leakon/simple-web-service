
<h1>请点击付款按钮</h1>

<?php
if (0) :
?>

<script>
	
var strPayUrl	= '<?php echo $strPayUrl ?>';
	
function AlipayPayOrder() {

	window.open(strPayUrl);	
	
}
	
</script>
	
	
<p>
<input type="button" value="通过支付宝付款" class="" onclick="AlipayPayOrder()" />
</p>
	
	
<?php endif ?>

<form method="post" target="_blank" action="<?php echo $strPayUrl ?>" >

<p>
<input type="submit" value="通过支付宝付款" class="" />
</p>
	
	
</form>