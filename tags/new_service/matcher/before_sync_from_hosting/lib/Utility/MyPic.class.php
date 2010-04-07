<?php

class MyPic {

	public static function formatPicFileName($strFileName) {

		$part		= pathinfo($strFileName);

		$ext		= isset($part['extension']) ? ('.' . strtolower($part['extension'])) : '';

		$filename	= date('Ymd-His') . '-' . rand(1000, 9999) . $ext;

		return		$filename;

	}

}
