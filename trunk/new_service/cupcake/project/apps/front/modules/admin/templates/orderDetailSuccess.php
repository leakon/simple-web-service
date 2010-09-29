
<h1>Order Info</h1>

<table class="product_list" border="1" style="width:900px;">

<tr>
	<td width="32">订单</td>
	<td width="">总价</td>
	<td width="">付款方式</td>
	<td width="">状态</td>
	<td width="">客户姓名</td>
	<td width="">客户手机</td>
	<td width="">客户地址</td>
	<td width="">送货时间</td>
	<td width="">创建时间</td>
</tr>

<?php

$arrMethodMap	= array(

	Table_data_order::PAY_METHOD_CASH	=> '现金',		// 
	Table_data_order::PAY_METHOD_ALIPAY	=> '支付宝',		// 
	Table_data_order::PAY_METHOD_PAYPAL	=> 'Paypal',		// 

);


$arrStatusMap	= array(

	0					=> '未付款',		// 
	Table_data_order::STATUS_PAYED_SUCCESS	=> '已付款',		// 

);

$arrResult	= array();
$arrResult[0]	= $arrOrderDetail;

foreach ($arrResult as $key => $item) :
	
	
?>


<tr>
	<td><?php echo $item['order_id'] ?></td>
	<td><?php echo $item['total'] ?></td>
	<td>
		<?php echo $arrMethodMap[  $item['pay_method'] ] ?>
	</td>
	<td>
		<?php echo $arrStatusMap[ $item['status'] ] ?>
	</td>
	<td><?php echo $item['customer_name'] ?>&nbsp;</td>
	<td><?php echo $item['customer_mobile'] ?></td>
	<td><?php echo $item['customer_address'] ?></td>
	<td><?php echo $item['receive_time'] ?></td>
	<td><?php echo $item['created_at'] ?></td>
</tr>



<?php

endforeach;

?>

</table>


<?php

#	Debug::pr($arrOrderDetail['detail']);

?>


<h1>Order Detail</h1>


<table class="product_list" border="1" style="width:900px;">

<tr>
	<td width="120">图片</td>
	<td width="">产品名称</td>
	<td width="120">类型</td>
	<td width="120">单价</td>
	<td width="120">数量</td>
</tr>

<?php

foreach ($arrOrderDetail['detail'] as $key => $item) :

?>

<tr>
	<td><img src="<?php echo $item['pic'] ?>" /></td>
	<td><?php echo $item['product_name'] ?></td>
	<td><?php echo $item['category'] ?></td>
	<td><?php echo $item['price'] ?></td>
	<td><?php echo $item['quantity'] ?></td>
</tr>





<?php

endforeach;

?>

</table>




