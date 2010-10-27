
<style>
table.detail		{margin:8px 0; background:gray; }	
table.detail td		{padding:4px 8px; background:white; font-size:14px;}
</style>

<h1>订单信息</h1>

<table class="product_list detail" border="0" cellspacing="1" cellpadding="1">

<?php


$arrMethodMap	= array(

	Table_data_order::PAY_METHOD_CASH	=> '现金',		// 
	Table_data_order::PAY_METHOD_ALIPAY	=> '支付宝',		// 
	Table_data_order::PAY_METHOD_PAYPAL	=> 'Paypal',		// 

);


$arrStatusMap	= array(

	'empty'					=> '',		// 
	0					=> '未付款',		// 
	Table_data_order::STATUS_PAYED_SUCCESS	=> '已付款',		// 

);

$arrResult	= array();
$arrResult[0]	= $arrOrderDetail;

foreach ($arrResult as $key => $item) :
	
	
?>

<tr>
	<td width="120">订单</td>
	<td width="360"><?php echo $item['order_id'] ?></td>
</tr>

<tr>
	<td width="">总价</td>
	<td><?php echo $item['total'] ?></td>
</tr>

<tr>
	<td width="">付款方式</td>
	<td>
		<?php echo $arrMethodMap[  $item['pay_method'] ] ?>
	</td>
</tr>

<tr>
	<td width="">状态</td>
	<td>
		<?php echo $arrStatusMap[ $item['status'] ] ?>&nbsp;
	</td>
</tr>

<tr>
	<td width="">客户姓名</td>
	<td><?php echo $item['customer_name'] ?>&nbsp;</td>
</tr>

<tr>
	<td width="">客户手机</td>
	<td><?php echo $item['customer_mobile'] ?></td>
</tr>

<tr>
	<td width="">客户地址</td>
	<td><?php echo $item['customer_address'] ?></td>
</tr>

<tr>
	<td width="">送货时间</td>
	<td><?php echo $item['receive_time'] ?></td>
</tr>

<tr>
	<td width="">创建时间</td>
	<td><?php echo $item['created_at'] ?></td>
</tr>


<?php

endforeach;

?>

</table>


<?php

#	Debug::pr($arrOrderDetail['detail']);

?>

<br />


<h1>订单详情</h1>


<table class="product_list detail"  border="0" cellspacing="1" cellpadding="1">

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
	<td><img src="<?php echo 'http://' . SYMFONY_SERVER_HOST . $item['pic'] ?>" /></td>
	<td><?php echo $item['product_name'] ?></td>
	<td><?php echo $item['category'] ?></td>
	<td><?php echo $item['price'] ?></td>
	<td><?php echo $item['quantity'] ?></td>
</tr>





<?php

endforeach;

?>

</table>




