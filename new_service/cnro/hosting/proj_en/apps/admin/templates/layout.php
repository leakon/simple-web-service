<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>

    <script src="/js/mootools-1.2.1-core-nc.js" type="text/javascript"></script>
    <script src="/js/main.js?ver=20090821.1" type="text/javascript"></script>
    <link rel="stylesheet" href="/admin/css/admincp.css" type="text/css" media="all" />
    <link rel="stylesheet" href="/css/main.css" type="text/css" media="all" />

<script src="/js/function.js?ver=20090715" type="text/javascript"></script>

    <link rel="shortcut icon" href="/favicon.ico" />



<script type="text/javascript">

<?php

$tableCategory		= new Table_categories();
$criteria		= new SofavDB_Criteria();
$resAll			= SofavDB_Record::findAll($tableCategory, $criteria);

$arrCategories		= array();
foreach ($resAll as $objCategory) {
	$arrCategories[]	= sprintf('[%d,%d,"%s"]', $objCategory->id, $objCategory->parent_id, S::E($objCategory->name));
}

#	Debug::pr($arrCategories);

echo	sprintf('var arrAllCategories	= [%s];', implode(',', $arrCategories));

?>

</script>



</head>
<body>


	<div class="container" id="cpcontainer">

	<?php echo $sf_content ?>


	</div>


</body>
</html>
