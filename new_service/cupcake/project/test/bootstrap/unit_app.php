<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */



define('PARAM_ARGV_1',		isset($argv[1]) ? $argv[1] : '');
define('PARAM_ARGV_2',		isset($argv[2]) ? $argv[2] : '');
define('PARAM_ARGV_3',		isset($argv[3]) ? $argv[3] : '');
define('PARAM_ARGV_4',		isset($argv[4]) ? $argv[4] : '');
define('PARAM_ARGV_5',		isset($argv[5]) ? $argv[5] : '');
define('PARAM_ARGV_6',		isset($argv[6]) ? $argv[6] : '');
define('PARAM_ARGV_7',		isset($argv[7]) ? $argv[7] : '');
define('PARAM_ARGV_8',		isset($argv[8]) ? $argv[8] : '');


define('ENTRANCE_DIR',		realpath('./') . '/');

$_test_dir = realpath(dirname(__FILE__).'/..');

require_once(dirname(__FILE__).'/../../config/ProjectConfiguration.class.php');
$configuration = new ProjectConfiguration(realpath($_test_dir.'/..'));
include($configuration->getSymfonyLibDir().'/vendor/lime/lime.php');

$clearCache	= isset($clearCache) ? $clearCache : true;
$app		= isset($app) ? $app : 'front';
$env		= isset($env) ? $env : 'test';
$debug		= isset($debug) ? $debug : true;

// -------------------------------------------------------------------------------------------------------- //

$configuration = ProjectConfiguration::getApplicationConfiguration($app, $env, $debug);
sfContext::createInstance($configuration);

if ($clearCache) {
	// remove all cache
	sfToolkit::clearDirectory(sfConfig::get('sf_app_cache_dir'));
}



// guess current application
if (!isset($app))
{
  $traces = debug_backtrace();
  $caller = $traces[0];

  $dirPieces = explode(DIRECTORY_SEPARATOR, dirname($caller['file']));
  $app = array_pop($dirPieces);
}

set_time_limit(0);
