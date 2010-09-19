<?php

/**
 * 日志记录
 *
 *
 */

class MyLog {

	private static		$logConfig	= array();
	protected static	$arrPrConf	= array();

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



	/**
	 * 把变量用 print_r 输出到文件中，避免干扰到页面正常输出
	 *
	 *
	 */
	public static function pr($var, $title = '', $nameSpace = 'default') {

		ob_start();

		echo	sprintf("\n======== %s ========\n", $title);

		print_r($var);

		echo	sprintf("-------- -------- -------- --------\n");

		$content	= ob_get_contents();

		ob_end_clean();

		$int	= 0;

		if (strlen($content)) {

			$conf		= self::getConfig('pr.' . $nameSpace);

			$strFileName	= $conf['log_file'];

			if (isset(self::$arrPrConf['pr_init'])) {

				$int	= file_put_contents($strFileName, $content, FILE_APPEND);

			} else {

				self::$arrPrConf['pr_init']	= 1;

				$int	= file_put_contents($strFileName, $content);

			}

		}

		return	$int;

	}



}
