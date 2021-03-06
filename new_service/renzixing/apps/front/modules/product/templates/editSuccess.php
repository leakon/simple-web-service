<?php
// auto-generated by sfPropelCrud
// date: 2008/04/20 13:42:54
?>
<?php use_helper('Object') ?>

<?php echo form_tag('product/update') ?>

<?php echo object_input_hidden_tag($product, 'getId') ?>

<input type="hidden" name="customer_id" value="<?php echo $sf_request->getParameter('customer_id', 0) ?>" />

<table>
<tbody>
<tr>
  <th>Ordered at*:</th>
  <td><?php echo object_input_date_tag($product, 'getOrderedAt', array (
  'rich' => true,
  'withtime' => true,
)) ?></td>
</tr>
<tr>
  <th>Installed at*:</th>
  <td><?php echo object_input_date_tag($product, 'getInstalledAt', array (
  'rich' => true,
  'withtime' => true,
)) ?></td>
</tr>
<tr>
  <th>Completed at*:</th>
  <td><?php echo object_input_date_tag($product, 'getCompletedAt', array (
  'rich' => true,
  'withtime' => true,
)) ?></td>
</tr>
<tr>
  <th>Warranty begin*:</th>
  <td><?php echo object_input_date_tag($product, 'getWarrantyBegin', array (
  'rich' => true,
  'withtime' => true,
)) ?></td>
</tr>
<tr>
  <th>Warranty end*:</th>
  <td><?php echo object_input_date_tag($product, 'getWarrantyEnd', array (
  'rich' => true,
  'withtime' => true,
)) ?></td>
</tr>
<tr>
  <th>Sale contact*:</th>
  <td><?php echo object_input_tag($product, 'getSaleContact', array (
  'size' => 80,
)) ?></td>
</tr>
<tr>
  <th>Sale phone*:</th>
  <td><?php echo object_input_tag($product, 'getSalePhone', array (
  'size' => 80,
)) ?></td>
</tr>
<tr>
  <th>Name*:</th>
  <td><?php echo object_input_tag($product, 'getName', array (
  'size' => 80,
)) ?></td>
</tr>
<tr>
  <th>Style*:</th>
  <td><?php echo object_input_tag($product, 'getStyle', array (
  'size' => 80,
)) ?></td>
</tr>
<tr>
  <th>Use type*:</th>
  <td><?php echo object_input_tag($product, 'getUseType', array (
  'size' => 80,
)) ?></td>
</tr>
<tr>
  <th>Amount*:</th>
  <td><?php echo object_input_tag($product, 'getAmount', array (
  'size' => 7,
)) ?></td>
</tr>
<tr>
  <th>Install detail*:</th>
  <td><?php echo object_textarea_tag($product, 'getInstallDetail', array (
  'size' => '30x3',
)) ?></td>
</tr>
</tbody>
</table>
<hr />
<?php echo submit_tag('save') ?>
<?php if ($product->getId()): ?>
  &nbsp;<?php echo link_to('delete', 'product/delete?id='.$product->getId(), 'post=true&confirm=Are you sure?') ?>
  &nbsp;<?php echo link_to('cancel', 'product/show?id='.$product->getId()) ?>
<?php else: ?>
  &nbsp;<?php echo link_to('cancel', 'product/list') ?>
<?php endif; ?>
</form>
