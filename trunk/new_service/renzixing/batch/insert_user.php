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




$TRUNCATE	= sprintf("TRUNCATE %s", UserPeer::TABLE_NAME);
$res		= SimpleDB::execute($TRUNCATE);



$filePath	= str_replace("\\", '/', SF_ROOT_DIR . '/doc/contact.txt');

#var_dump(file_exists($filePath));

$SQLLoad	= sprintf("LOAD DATA INFILE '%s' IGNORE INTO TABLE %s (username, role)", $filePath, UserPeer::TABLE_NAME);
$res		= SimpleDB::execute($SQLLoad);

print_r($res);


$SQLLoad	= sprintf("UPDATE %s SET password = '%s' ", UserPeer::TABLE_NAME, md5('123456'));
$res		= SimpleDB::execute($SQLLoad);

$SQLWarings	= 'SHOW WARNINGS';
$res		= SimpleDB::fetchAll($SQLWarings);

print_r($res);

