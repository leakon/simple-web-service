<?php

class FCK {

	public static function getRequireFile() {
		$webDir			= sfConfig::get('sf_root_dir') . '/web_admin/js/';
		$editorInclude		= $webDir . "fckeditor/fckeditor.php";
		return	$editorInclude;
	}

	public static function getBasePath() {
		return	'/js/fckeditor/';
	}

}