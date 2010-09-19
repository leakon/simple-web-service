<?php

/**
 * SingletonProcess
 *
 * @package     SingletonProcess
 * @link        www.leakon.com
 * @version     2009-06-23
 * @author      Leakon <leakon@gmail.com>
 *
 * Prevent multiple instance running in same time
 * Usage: call the breakIfRunning method at the head of the script file, the topper the better:
 	//
	$single	= new SingletonProcess(__FILE__, 10);
	$skip	= $single->breakIfRunning();
 *
 * @notice	isModified add a parameter to tell whether the specific column is modified.
 */

class SingletonProcess {

	const
		CONF_PID		= 0,
		CONF_TIME		= 1,

		CASE_DEFAULT		= 0,
		CASE_CREATED		= 100,		// 创建进程，生成 LOCK 文件
		CASE_IS_RUNNING		= 200,		// 程序正在正常运行
		CASE_EXCEED_LIVE_TIME	= 300,		// 到达超时时间，结束进程
		CASE_EXCEPTIONAL_EXIT	= 400,		// 程序异常退出，遗留 LOCK 文件

		VER			= '';


	private
		$processFile	= '',
		$processStatus	= 0,
		$processPid	= 0,
		$timeToLive	= 0,
		$lockFile	= '';

	public function __construct($strProcessFile, $intTimeToLive) {

		$this->processPid	= getmypid();

		$this->processFile	= $strProcessFile;
		$this->lockFile		= dirname($strProcessFile) . '/' . basename($strProcessFile) . '.lock';

		$this->timeToLive	= $intTimeToLive;

		$this->makeStatus();

	}

	public function __destruct() {
		$this->clearLock();
	}

	public function extendLife() {
		$arrConf	= $this->getLock();
		if (isset($arrConf[self::CONF_TIME]) && $arrConf[self::CONF_TIME]) {
			$arrConf[self::CONF_TIME]	= time();
			$this->setLock($arrConf);
		}
	}

	// breakIfRunning
	public function breakIfRunning() {

		if (self::CASE_IS_RUNNING === $this->processStatus) {
			exit;
		}

	}

	public function getStatus() {
		return	$this->processStatus;
	}

	private function makeStatus() {

		if (file_exists($this->lockFile)) {

			// lock file exists
			$arrLock		= $this->getLock();
			$intPid			= $arrLock[self::CONF_PID];
			$intCreateTime		= $arrLock[self::CONF_TIME];

			if ($intPid > 0 && self::isProcessRunning($intPid)) {
				// process is running

				// check period time
				$periodTime	= time() - $intCreateTime;

				if ($periodTime > $this->timeToLive) {

					// 到达超时时间，结束进程
					$this->processStatus	= self::CASE_EXCEED_LIVE_TIME;

					// NOTICE: Kill command can NOT run successfully in WINNT
					// because $intPid is WINPID, the pid should be killed is PID:
					//	PID     PPID    PGID     WINPID  TTY  UID    STIME COMMAND
					//	5116    5072    5116       2800  con 1006 14:09:17 /cygdrive/d/Leakon/xampp/php/php
					//	$intPid is 2800, should kill 5116

					// exceed life time, kill it anyway
					$cmd	= sprintf("kill -9 %d", $intPid);

					exec($cmd, $arrOutput);

					$this->clearLock();

					$this->log('Exceed life time, process killed');

				} else {

					// 程序正在正常运行
					$this->processStatus	= self::CASE_IS_RUNNING;

					$this->log('Process is running as expect');

				}

			} else {

				// 程序异常退出，遗留 LOCK 文件
				$this->processStatus	= self::CASE_EXCEPTIONAL_EXIT;
				$this->clearLock();

				$this->log('Process exit exceptionally');

			}

		} else {

			// 创建进程，生成 LOCK 文件
			$this->processStatus	= self::CASE_CREATED;

		}

		if (self::CASE_IS_RUNNING === $this->processStatus) {

		} else {

			$arrConf	= array(
				self::CONF_PID		=> $this->processPid,
				self::CONF_TIME		=> time(),
			);

			$this->setLock($arrConf);

			$this->log('Created lock file');
		}

		return	$this->processStatus;

	}

	private static function isProcessRunning($pid) {

		$arrOutput	= array();

		if (false !== strpos(strtoupper(PHP_OS), 'WINNT')) {
			// windows cygwin
			$cmd	= sprintf("ps ax | grep 'php' | grep -v 'grep' | grep '%d' ", $pid);
		} else {
			// linux
			$cmd	= sprintf("ps ax | grep 'php' | grep -v 'grep' | grep '%d' | awk '{print \$1}'", $pid);
		}

		exec($cmd, $arrOutput);

		$arrTest	= $arrOutput;
		$arrTest['pid']	= $pid;

		return	1 == count($arrOutput);
	}

	private function setLock($arrConfig) {
		return	file_put_contents($this->lockFile, implode("\n", $arrConfig));
	}

	private function getLock() {
		$arrRet		= array();
		if (file_exists($this->lockFile)) {
			$arrExplode			= explode("\n", file_get_contents($this->lockFile));
			$arrRet[self::CONF_PID]		= isset($arrExplode[0]) ? $arrExplode[0] : 0;
			$arrRet[self::CONF_TIME]	= isset($arrExplode[1]) ? $arrExplode[1] : 0;
		}
		return	$arrRet;
	}

	private function clearLock() {

		$ret	= false;
		if (file_exists($this->lockFile)) {
			$arrConf	= $this->getLock();

			// check process pid before unlink lock file
			// prevent conflicting process commit the unlink operation
			if (isset($arrConf[self::CONF_PID]) && $arrConf[self::CONF_PID] == $this->processPid) {
				$ret	= unlink($this->lockFile);
			}
		}

		return	$ret;
	}

	private function log($message) {
		$str	= sprintf("[%d][%s] %s", $this->processPid, $message, $this->processFile);
		MyLog::doLog($str, 'Singleton', 'singleton');
	}

}
