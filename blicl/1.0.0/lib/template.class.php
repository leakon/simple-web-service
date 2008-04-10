<?php

class BLTemplate {

	static	$tplData;

	public static function renderTemplate($tplName, $type = 'all') {

		$strCont	= '';

		$fileName	= sprintf("%stpl/%s_%s.php", PROJECT_ROOT_DIR, $type, $tplName);

	#	var_dump($fileName);

		if (file_exists($fileName)) {

			ob_start();

			include($fileName);

			$strCont	= ob_get_contents();

			ob_end_clean();

		} else {

		#	var_dump($fileName);

		}

		return	$strCont;

	}

	public static function showTemplate($tplName, $type = 'all') {

		echo	self::renderTemplate($tplName, $type);

	}


}