<?php

require_once(dirname(__FILE__) . '/require.inc.php');


/*
// FETCH ALL
$tableGmail	= new GMail();
$criteria	= new SofavDB_Criteria();
$resAll		= SofavDB_Record::findAll($tableGmail, $criteria);

$arrWhere	= array(
			'title'	=> 'Title_"_5338',
			'body'	=> "Body_'_6474",
		);
$criteria->reset()->bind($arrWhere);
$resAll		= SofavDB_Record::findAll($tableGmail, $criteria);
$resOne		= SofavDB_Record::find($tableGmail, $criteria);
Debug::pr($resAll);
Debug::pr($resOne);
exit;
*/


#var_dump($criteria->getStatement());


#var_dump($res);


/*
// FETCH ONE
$dataCategory	= new Sofav_Data_Category();

$criteria	= new SofavDB_Criteria('ORDER BY id DESC');

#var_dump($criteria->getStatement());

$res		= SofavDB_Record::find($dataCategory, $criteria, false);

#var_dump($res);
Debug::pr($res);
*/


// MATCH ALL
$tableGmail		= new GMail();

$tableGmail->body	= "Body_'_6474";

$resAll			= SofavDB_Record::matchAll($tableGmail);
$resOne			= SofavDB_Record::match($tableGmail);

Debug::pr($resAll);
Debug::pr($resOne);
exit;


$arrGmail		= $tableGmail->toArray();

#var_dump($arrGmail);
foreach ($arrGmail as $key => $val) {
#	var_dump(isset($val));
}

Debug::pre($arrGmail);




// INSERT
$tableGmail	= new GMail();

$criteria	= new SofavDB_Criteria('@set');
$arrSetting	= array(
			'user_id'	=> rand(10, 99),
			'title'		=> 'Title_"_' . rand(1000, 9999),
			'body'		=> 'Body_\'_' . rand(1000, 9999),
			'address'	=> 'Address_\\_' . rand(1000, 9999),
			);
$criteria->bind($arrSetting, ',', '@set');

#$res		= SofavDB_Record::doInsert($tableGmail, $criteria);
#var_dump($res);
#Debug::pr($res);




// UPDATE
$tableGmail	= new GMail();

$criteria	= new SofavDB_Criteria('SET @set WHERE @where');
$arrSetting	= array(
			'user_id'	=> rand(100, 999),
			'title'		=> 'Updated_Title_"_' . rand(1000, 9999),
			'body'		=> 'Updated_Body_\'_' . rand(1000, 9999),
			'address'	=> 'Updated_Address_\\_' . rand(1000, 9999),
			);
$arrWhere	= array(
			'id'		=> 2,
		);
$criteria->bind($arrSetting, ',', '@set')->bind($arrWhere, ',', '@where');

$res		= SofavDB_Record::doUpdate($tableGmail, $criteria);
var_dump($res);
#Debug::pr($res);




// DELETE
$tableGmail	= new GMail();

$criteria	= new SofavDB_Criteria();
$arrWhere	= array(
			'id'		=> 4,
		);
$criteria->bind($arrWhere);

$res		= SofavDB_Record::doDelete($tableGmail, $criteria);
var_dump($res);
#Debug::pr($res);



