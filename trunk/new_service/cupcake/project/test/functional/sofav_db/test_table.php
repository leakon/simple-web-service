<?php

require_once(dirname(__FILE__) . '/require.inc.php');


/*
// FIND
$id		= 8;
$tableGmail	= new GMail($id);
Debug::pr($tableGmail);
*/



/*
// INSERT
$tableGmail		= new GMail();

$tableGmail->user_id	= rand(2000, 4999);
$tableGmail->title	= 'Title_"_' . rand(1000, 9999);
$tableGmail->body	= 'Body_\'_' . rand(1000, 9999);
$tableGmail->address	= 'Address_\\_' . rand(1000, 9999);

$tableGmail->save();

Debug::pr($tableGmail);
*/

// UPDATE
$tableGmail		= new GMail(7);
$tableGmail->title	= 'NewTitle';
$tableGmail->save();
Debug::pr($tableGmail);


/*
// DELETE
$id		= 8;
$tableGmail	= new GMail($id);
$tableGmail->delete();

Debug::pr($tableGmail);

$tableGmail->title	= 'Title_"_' . rand(1000, 9999);
Debug::pr($tableGmail);
$tableGmail->save();
Debug::pr($tableGmail);
*/

