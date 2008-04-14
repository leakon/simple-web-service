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


$filePath	= str_replace("\\", '/', SF_ROOT_DIR . '/doc/issue.txt');

$TRUNCATE	= sprintf("TRUNCATE %s", IssuePeer::TABLE_NAME);
$res		= SimpleDB::execute($TRUNCATE);

$SQLLoad	= sprintf("LOAD DATA INFILE '%s' IGNORE INTO TABLE %s IGNORE 1 LINES (id,title,user_id,parent_id,type,created_at)",
			$filePath, IssuePeer::TABLE_NAME);
$res		= SimpleDB::execute($SQLLoad);

exit;



$arrLoadLines	= array();

for ($i = 0; $i < 5000; $i++) {

	$arrLoadLines[]	= sprintf("%s\t%s\t%s",
					rand(1, 240),		// user_id
					date(  'Y-m-d H:i:s', ($_SERVER['REQUEST_TIME'] - rand(0, 500) * 86400 )     ),	// created_at
					SimpleDB::escape(  GenLetter(rand(20, 80))  )			// title
				);

}

$filePath	= str_replace("\\", '/', SF_ROOT_DIR . '/data/load_issue.txt');

file_put_contents($filePath, implode("\n", $arrLoadLines));


$TRUNCATE	= sprintf("TRUNCATE %s", IssuePeer::TABLE_NAME);
$res		= SimpleDB::execute($TRUNCATE);

$SQLLoad	= sprintf("LOAD DATA INFILE '%s' IGNORE INTO TABLE %s (user_id, created_at, title)", $filePath, IssuePeer::TABLE_NAME);
$res		= SimpleDB::execute($SQLLoad);


function GenLetter($len) {

	$arrString	= array();

	for ($i = 0; $i < $len; $i++) {

		$asciiDec	= rand(48, 122);

		$arrString[]	= chr($asciiDec);

	}

	return	implode('', $arrString);

}
