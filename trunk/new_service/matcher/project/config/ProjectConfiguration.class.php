<?php

require_once 'D:/Leakon/code/project/sofav/sofav_2009/stable/symfony-1.2.10/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    // for compatibility / remove and enable only the plugins you want
#    $this->enableAllPluginsExcept(array('sfDoctrinePlugin', 'sfCompat10Plugin'));
    $this->enableAllPluginsExcept(array('sfDoctrinePlugin', 'sfPropelPlugin'));
  }



	public static function getUploadDir() {

		$webDir		= sfConfig::get('sf_web_dir');

		$uploadDir	= $webDir . '/matcher/uploads/';

		return		$uploadDir;


	}

	public static function getWebUploadDir() {

		return		'/matcher/uploads/';

	}


}


function url_for_2($uri) {

	$arrRet		= array();

	$arrExplode	= explode('/', $uri);

	if (isset($arrExplode[0])) {
		$arrRet[]	= 'module=' . $arrExplode[0];
	}
	if (isset($arrExplode[1])) {
		$arrRet[]	= 'action=' . $arrExplode[1];
	}

	return	'/admin/admin.php/?' . implode('&', $arrRet);

}


function GetRefer() {

	$request	= sfContext::getInstance()->getRequest();

	return	$request->getReferer();

#	return	$request->getUri()();

}
