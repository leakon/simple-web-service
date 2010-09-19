<?php

$strServerFile		= '/home/work/lib/symfony-1.2-latest/lib/autoload/sfCoreAutoload.class.php';
if (file_exists($strServerFile)){
	require_once($strServerFile);
} else {
	require_once 'D:/Leakon/code/project/sofav/sofav_2009/stable/symfony-1.2.10/lib/autoload/sfCoreAutoload.class.php';
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
		USER_SESSION_NAME	= 'ccake_sess',			// ”√ªß session name
		USER_COOKIE_DOMAIN	= '.baolaa.com',
		VERSION			= 1;
	
}
