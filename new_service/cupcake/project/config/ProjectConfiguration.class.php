<?php

$host	= '';
$port	= 80;
if (isset($_SERVER['HTTP_HOST'])) {
	$host	= $_SERVER['HTTP_HOST'];
	preg_match('/.*?:(\d+)$/', $host, $match);
	if (isset($match[1])) {
		$port	= $match[1];
	}
}
define('SYMFONY_SERVER_HOST',	$host);
define('SYMFONY_SERVER_PORT',	$port);
define('IS_WINNT_OS',		false !== strpos(strtoupper(PHP_OS), 'WINNT'));
define('SERVER_HTTP_REFERER',	isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');



$strServerFile		= '/home/work/lib/symfony-1.2-latest/lib/autoload/sfCoreAutoload.class.php';
if (file_exists($strServerFile)){
	require_once($strServerFile);
} else {
	require_once 'D:/Leakon/code/sofav/sofav_2009/stable/symfony-1.2.10/lib/autoload/sfCoreAutoload.class.php';
}

sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    // for compatibility / remove and enable only the plugins you want
#    $this->enableAllPluginsExcept(array('sfDoctrinePlugin', 'sfCompat10Plugin'));
    $this->enableAllPluginsExcept(array('sfDoctrinePlugin', 'sfPropelPlugin'));
  }
}


class ProjConf {

	const
		USER_SESSION_NAME	= 'ccake_sess',			// �û� session name
		USER_COOKIE_DOMAIN	= '.colibricupcakes.com',
		VERSION			= 1;

}
