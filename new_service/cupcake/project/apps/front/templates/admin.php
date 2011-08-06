<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<link rel="shortcut icon" href="/favicon.ico" />

<link href="/css/admin_global.css" type="text/css" rel="stylesheet" />

</head>
<body>
	
<?php
$intUserId	= $sf_user->getId();

if ($intUserId > 0) :
?>

<div>
	
<table class="product_list" border="1" style="width:auto;">
	<tr>
		<td width="100"><a href="<?php echo url_for('admin/listOrder') ?>">订单列表</a></td>
		<td width="100"><a href="<?php echo url_for('admin/setMenu') ?>">设置菜单</a></td>
		<td width="100"><a href="<?php echo url_for('admin/setCategory') ?>">设置分类</a></td>
		<td width="100"><a href="<?php echo url_for('admin/signOut') ?>">退出</a></td>
	</tr>
</table>
	

</div>

<hr style="margin:24px 0;" />

<?php endif ?>

    <?php echo $sf_content ?>


</body>
</html>

