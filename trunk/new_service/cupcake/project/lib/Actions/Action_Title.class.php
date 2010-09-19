<?php

/**
 * Action_Title
 *
 * @author      Leakon <leakon@gmail.com>
 * @version     2010-01-07
 *
 * @description	沙发鱼 标题 方法
 * @notice
 */

class Action_Title extends sfFilter {

	protected static
		$arrTitles	= array();

	public function execute($filterChain) {

		// Execute this filter only once
	#	if ($this->isFirstCall()) {
	#	}


	#	$response	= $this->getContext()->getResponse();
	#	$response->addMeta('robots', 'index, follow');

		self::setTitle(0, '沙发鱼');

		// Execute next filter
		$filterChain->execute();

	}

	public static function setTitle($intLevel, $strTitle) {

	#	Debug::pr(sfContext::getInstance()->getResponse()->getMetas());

		self::$arrTitles[$intLevel]	= $strTitle;
		krsort(self::$arrTitles);
		$strTitle	= implode(' - ', self::$arrTitles);
		$response	= sfContext::getInstance()->getResponse();
		$response->addMeta('title', $strTitle);


	#	echo	"add";

	}

}

