<?php

/**
 * Sofav 工具箱
 *
 * @version	2009-11-10
 * @notice
 */


class SofavUtil {

	public static function md5($strInput) {
		return	md5(SofavConf::MD5_PREFIX_SECRET . $strInput);
	}

}

