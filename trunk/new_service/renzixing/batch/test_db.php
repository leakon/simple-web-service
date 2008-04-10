<?php

/**
 * insert_user batch script
 *
 * Here goes a brief description of the purpose of the batch script
 *
 * @package    renzixing
 * @subpackage batch
 * @version    $Id$
 */

define('SF_ROOT_DIR',    realpath(dirname(__file__).'/..'));
define('SF_APP',         'front');
define('SF_ENVIRONMENT', 'dev');
define('SF_DEBUG',       1);

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

// initialize database manager
$databaseManager = new sfDatabaseManager();
$databaseManager->initialize();

// batch process here

$dbInstance	= $databaseManager->getDatabase('propel');
$connnection	= $dbInstance->getConnection();

$query = 'SELECT * FROM %s';
$query = sprintf($query, UserPeer::TABLE_NAME);
$statement = $connnection->prepareStatement($query);
$resultset = $statement->executeQuery();


#print_r($dbInstance);
#print_r($resultset);


$TplInsert	= "INSERT INTO %s SET username = '%s', role = '%s'";
$SQLInsert	= sprintf($TplInsert, UserPeer::TABLE_NAME, "leakon?'''" . chr(hexdec('5c')) . time() . rand(1, 99999), 'ceo');


$resource	= $connnection->getResource();

#$tmp		= mysql_real_escape_string("'\\運", $resource);


$TplInsert	= "UPDATE %s SET role = '%s' WHERE username = '%s'";
$SQLUpdate	= sprintf($TplInsert, UserPeer::TABLE_NAME, "role" . time() . rand(1, 99999), 'leakon120781949877768');
$SQLUpdate	= sprintf($TplInsert, UserPeer::TABLE_NAME, "roleddd", 'leakon120781949877768');

#$res		= SimpleDB::execute($SQLUpdate);
#var_dump($res);


$TplInsert	= "SELECT * FROM %s WHERE username LIKE '%s%s%s'";
$SQLSelect	= sprintf($TplInsert, UserPeer::TABLE_NAME, '%', 'leakon1', '%');

#var_dump($SQLSelect);

$res		= SimpleDB::fetchAll($SQLSelect);
print_r($res);



#$statement	= $connnection->prepareStatement($SQLInsert);
#$resultset	= $statement->executeQuery();


