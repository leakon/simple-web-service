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




$TRUNCATE	= sprintf("TRUNCATE %s", IssuePeer::TABLE_NAME);
$res		= SimpleDB::execute($TRUNCATE);


for ($i = 0; $i < 100; $i++) {

	$SQLInsert	= sprintf("INSERT INTO %s (title, user_id) VALUES ('%s', '%s')",
					IssuePeer::TABLE_NAME,
					str_repeat(rand(100, 999), rand(40, 80)),
					rand(1, 200)
				);

	$res		= SimpleDB::execute($SQLInsert);

}

