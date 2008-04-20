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


$TRUNCATE	= sprintf("TRUNCATE %s", ProductPeer::TABLE_NAME);
$res		= SimpleDB::execute($TRUNCATE);

$filePath	= str_replace("\\", '/', SF_ROOT_DIR . '/doc/product.txt');

$SQLLoad	= sprintf("LOAD DATA INFILE '%s' IGNORE INTO TABLE %s IGNORE 1 LINES (created_at,ordered_at,installed_at,completed_at,warranty_begin,warranty_end,sale_contact,sale_phone,name,customer_id,user_id,style,use_type,amount,install_detail)", $filePath, ProductPeer::TABLE_NAME);
$res		= SimpleDB::execute($SQLLoad);

print_r($res);


