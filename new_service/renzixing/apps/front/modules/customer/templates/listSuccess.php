<?php
// auto-generated by sfPropelCrud
// date: 2008/04/12 09:31:45
?>

<div class="wrap">

<form id="posts-filter" action="<?php echo url_for("issue/search") ?>" method="get">
<h2>客户列表</h2>

<table class="widefat">
<thead>
<tr>

	<th scope="col">客户名称</th>
	<th scope="col">区域</th>
	<th scope="col">城市</th>
	<th scope="col">联系人</th>
	<th scope="col">地址</th>
	<th scope="col">邮编</th>
	<th scope="col">编辑</th>

</tr>
</thead>
<tbody>


<?php if ($objPager->getNbResults()) : ?>

<?php foreach ($objPager->getResults() as $customer): ?>
<tr id="post-<?php echo $customer->getId() ?>" class="alternate author-self status-publish" valign="top">

      <td><?php echo link_to($customer->getName(), 'customer/show?id=' . $customer->getId()) ?></td>
      <td><?php echo $customer->getArea() ?></td>
      <td><?php echo $customer->getCity() ?></td>

      <td>
	<table><!-- 联系人 -->
		<tr>
			<td>
				<?php echo $customer->getFirstContact() ?>
				<?php echo $customer->getFirstPhoneA() ?>
				<?php echo $customer->getFirstPhoneB() ?>
				<?php echo $customer->getFirstPhoneC() ?>

			</td>
		</tr>
		<tr>
			<td>
				<?php echo $customer->getSecondContact() ?>
				<?php echo $customer->getSecondPhoneA() ?>
				<?php echo $customer->getSecondPhoneB() ?>
				<?php echo $customer->getSecondPhoneC() ?>

			</td>
		</tr>
	</table>
      </td>


      <td><?php echo $customer->getAddress() ?></td>
      <td><?php echo $customer->getPostCode() ?></td>


      <td><?php echo link_to('编辑', 'customer/edit?id=' . $customer->getId()) ?></td>


</tr>
<?php endforeach; ?>

<?php else : ?>


<tr id="post-0" class="alternate author-self status-publish" valign="top">
	<td colspan="4">
		<span class="searchResult">没有找到匹配的项目！ </span>
	</td>
</tr>

<?php endif ?>



</tbody>
</table>

</form>

<?php

$pageUri	= sprintf("customer/list?");

#var_dump($pageUri);

echo include_partial('global/pageNavigation',
				array(
					'pageNavigation' => $objPager,
					'pageUri' => $pageUri
				)
			) ?>


</div>