<?php

require_once(dirname(__FILE__) . '/require.inc.php');

$conn		= SofavDB_Manager::getConnection();
$sql		= sprintf('SELECT * FROM sf_cache_item WHERE user_id = 2 ORDER BY id DESC LIMIT %d, 10', rand(0, 99));
$statement	= $conn->prepare($sql);
$statement->execute();

$res		= $statement->fetch(PDO::FETCH_LAZY);

print_r($res);


var_dump(PDO::FETCH_ASSOC);
var_dump(PDO::FETCH_LAZY);
var_dump(PDO::FETCH_BOTH);
var_dump(PDO::FETCH_NUM);


