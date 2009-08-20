<?php

class adminConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {

  	$sf_root_dir	= sfConfig::get('sf_root_dir');
  	$host_root	= realpath($sf_root_dir . '/../');
  	sfConfig::set('sf_host_dir', $host_root . '/');

  }
}


function url_for_2($uri) {

	$url	= url_for($uri);

	$url	= preg_replace("#/admin_(cn|en)/admin.php/#i", '', $url);

	return	'/en/index.php/' . $url;

}