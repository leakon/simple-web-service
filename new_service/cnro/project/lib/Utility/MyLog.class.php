<?php

class MyLog {

	private static		$logConfig	= array();

	private static function getConfig($nameSpace) {

		if (empty(self::$logConfig[$nameSpace])) {
			$strLogDir				= sfConfig::get('sf_log_dir');
			$logConfig[$nameSpace]['log_date']	= date('Ymd');
			$logConfig[$nameSpace]['log_file']	= sprintf('%s/%s.%s.log', $strLogDir, $nameSpace, $logConfig[$nameSpace]['log_date']);
		}

		return	$logConfig[$nameSpace];
	}

	public static function doLog($string, $level = 'info', $nameSpace = 'default') {

		$conf		= self::getConfig($nameSpace);
		$log		= sprintf("%s %s [%s]	%s\n", $conf['log_date'], date('H:i:s'), $level, $string);
		return		error_log($log, 3, $conf['log_file']);
	}

}
