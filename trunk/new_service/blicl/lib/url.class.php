<?php

class BLUrl {

	static	$urlData;

	public static function getReggedURLs() {

		static $blURLReggedArray = null;

		if (empty($blURLReggedArray)) {

			$blURLReggedArray	= array(

				'home'		=> true,
				'introduction'	=> true,
				'lottery'	=> true,
				'recruiting'	=> true,
				'news'		=> true,

			);

		}

		return	$blURLReggedArray;

	}



	public static function getController() {

		$req	= $_GET['req'];

		$arr	= self::getReggedURLs();

		return	isset($arr[$req]) ? $req : 'home';

	}



	public static function makeUrl($routeName) {



	}

	public static function renderTemplate($tplName) {

		$strCont	= '';

		$fileName	= sprintf("%stpl/all_%s.php", PROJECT_ROOT_DIR, $tplName);

		if (file_exists($fileName)) {

			ob_start();

			include($fileName);

			$strCont	= ob_get_contents();

			ob_end_clean();

		}

		return	$strCont;

	}

	public static function showTemplate($tplName) {

		echo	self::renderTemplate($tplName);

	}


}