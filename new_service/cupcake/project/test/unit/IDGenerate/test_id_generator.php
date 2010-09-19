<?php

$app		= 'front';
$clearCache	= false;
require_once(dirname(__FILE__) . '/../../bootstrap/unit_app.php');


/*


*/


for ($i = 0; $i < 10; $i++) {

#	$intUniqID	= IDGenerator::generate('order_id');
#	echo	sprintf("Order ID: %d \n", $intUniqID);

	$strFixedID	= IDGenerator::getFixedID('order_id');
	echo	sprintf("Fixed Order ID: %s \n", $strFixedID);

}

