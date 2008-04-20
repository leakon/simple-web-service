<?php use_helper('Object') ?>

<div class="wrap">

<h2>客户信息</h2>

<br class="clear" />

<table class="widefat">
<thead>
	<tr>
		<th scope="col" colspan="2">基本信息</th>
	</tr>
</thead>
<tbody>



	<tr valign="top">
		<td class="formKeyColumn">客户名称</td>
		<td><?php echo $customer->getName() ?></td>
	</tr>

	<tr valign="top">
		<td>区域</td>
		<td><?php echo $customer->getArea() ?></td>
	</tr>

	<tr valign="top">
		<td>城市</td>
		<td><?php echo $customer->getCity() ?></td>
	</tr>

	<tr valign="top">
		<td>联系人一</td>
		<td>
				<?php echo $customer->getFirstContact() ?>
				<?php echo $customer->getFirstPhoneA() ?>
				<?php echo $customer->getFirstPhoneB() ?>
				<?php echo $customer->getFirstPhoneC() ?>
		</td>
	</tr>

	<tr valign="top">
		<td>联系人二</td>
		<td>

			<?php echo $customer->getSecondContact() ?>
			<?php echo $customer->getSecondPhoneA() ?>
			<?php echo $customer->getSecondPhoneB() ?>
			<?php echo $customer->getSecondPhoneC() ?>
		</td>

	</tr>

	<tr valign="top">
		<td>客户地址</td>
		<td><?php echo $customer->getAddress() ?></td>
	</tr>

	<tr valign="top">
		<td>邮政编码</td>
		<td><?php echo $customer->getPostCode() ?></td>
	</tr>
</tbody>
</table>

<br class="clear" />

<?php echo link_to('添加新产品', 'product/create?id='.$customer->getId(), 'target=_blank') ?>
&nbsp;
<?php echo link_to('添加维护信息', 'maintance/create?id='.$customer->getId(), 'target=_blank') ?>

<hr />

<br class="clear" />


<h2>产品信息</h2>

<br class="clear" />


<?php if (!empty($arrProducts) && count($arrProducts)) : ?>

<table class="widefat">
<thead>
	<tr>
		<th scope="col">品名</th>
		<th scope="col">规格</th>
		<th scope="col">数量</th>
		<th scope="col">订货日期</th>
		<th scope="col">安装日期</th>
		<th scope="col">完工日期</th>
		<th scope="col">使用类型</th>
	</tr>

</thead>
<tbody>

<?php foreach ($arrProducts as $product) : ?>

	<tr valign="top">
		<td><?php echo $product->getName() ?></td>
		<td><?php echo $product->getStyle() ?></td>
		<td><?php echo $product->getAmount() ?></td>
		<td><?php echo substr($product->getOrderedAt(), 0, 10) ?></td>
		<td><?php echo substr($product->getOrderedAt(), 0, 10) ?></td>
		<td><?php echo substr($product->getOrderedAt(), 0, 10) ?></td>
		<td><?php echo $product->getUseType() ?></td>
	</tr>

<?php endforeach ?>


</tbody>
</table>

<?php endif ?>






<br class="clear" />


<h2>维护信息</h2>

<br class="clear" />


<?php if (!empty($arrProducts) && count($arrProducts)) : ?>

<table class="widefat">
<thead>
	<tr>
		<th scope="col">品名</th>
		<th scope="col">规格</th>
		<th scope="col">数量</th>
		<th scope="col">订货日期</th>
		<th scope="col">安装日期</th>
		<th scope="col">完工日期</th>
		<th scope="col">使用类型</th>
	</tr>

</thead>
<tbody>

<?php foreach ($arrProducts as $product) : ?>

	<tr valign="top">
		<td><?php echo $product->getName() ?></td>
		<td><?php echo $product->getStyle() ?></td>
		<td><?php echo $product->getAmount() ?></td>
		<td><?php echo substr($product->getOrderedAt(), 0, 10) ?></td>
		<td><?php echo substr($product->getOrderedAt(), 0, 10) ?></td>
		<td><?php echo substr($product->getOrderedAt(), 0, 10) ?></td>
		<td><?php echo $product->getUseType() ?></td>
	</tr>

<?php endforeach ?>


</tbody>
</table>

<?php endif ?>


</div>