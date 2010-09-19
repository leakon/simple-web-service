<?php

require_once(dirname(__FILE__) . '/require.inc.php');


$conn	= SofavDB_Manager::getConnection();

$count	= 500;

$res = $res_2 = array();

// SIMPLE
if (1) {
	$timer_2			= new sfTimer('timer_SofavDB_2');

	$sql_count			= 'SELECT COUNT(*) FROM sf_data_item ';
	$sql				= 'SELECT * FROM sf_data_item ORDER BY id LIMIT 0, 5';

	for ($i = 0; $i < $count; $i++) {
		$conn			= SofavDB_Manager::getConnection();
		$statement		= $conn->query($sql_count);
		$res_2			= $statement->fetchAll(PDO::FETCH_ASSOC);

		$statement		= $conn->query($sql);
		$res_2			= $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	$elapsedTime_Simple	= $timer_2->getElapsedTime();
}







// SOFAVDB
if (1) {
	$timer				= new sfTimer('timer_SofavDB');

		$tableCache		= new Sofav_Cache_Item();
	#	$tableCache		= new Sofav_Data_Tag();
		$criteria		= new SofavDB_Criteria();

	for ($i = 0; $i < $count; $i++) {
		$res			= SofavDB_Record::findAll($tableCache, $criteria, true);
	}

	$elapsedTime_SofavDB	= $timer->getElapsedTime();
}



if (0) {

	$timer			= new sfTimer('timer_SofavDB');

	#	$page			= (int) $request->getParameter('page', 1);
		$page			= 1;

	#	$tableCache		= new Sofav_Cache_Item();
		$tableCache		= new Sofav_Data_Tag();

		$pager			= new SofavDB_Pager($tableCache);

		$where			= array(
						'user_id' => 1
					);
		$order			= array(
						'item_id' => 'DESC',
						'id' => 'DESC',
					);

	for ($i = 0; $i < $count; $i++) {

		$pager->init($page, 1, array('where' => $where, 'order' => $order));

	}

	$elapsedTime_SofavDB	= $timer->getElapsedTime();
}


print_r('Simpler: ' . $elapsedTime_Simple . "\n");
print_r('SofavDB: ' . $elapsedTime_SofavDB . "\n");


