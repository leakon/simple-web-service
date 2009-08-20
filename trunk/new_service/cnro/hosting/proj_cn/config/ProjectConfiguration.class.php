<?php

require_once 'D:\Leakon\code\project\symfony\sofav_2008_2\stable\symfony-1.2.4\lib/autoload/sfCoreAutoload.class.php';
#require_once 'F:/usr/LocalUser/hgc37057/symfony-1.2.7/lib/autoload/sfCoreAutoload.class.php';
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
