<?php


/**
 * Subclass for performing query and update operations on the 'sf_issue ' table.
 *
 *
 *
 * @package lib.model
 */



class IssuePeer extends BaseIssuePeer
{

	const

		STATUS_DEFAULT		= 0,
		STATUS_REJECTTED	= 10,
		STATUS_SUBMITTED	= 20,
		STATUS_TERMINATED	= 80,

		VERSION			= '1';

	public static function listAllStatus() {

		$arrStatus	= array(

			'default'	=> self::STATUS_DEFAULT,		// 默认，作者可以编辑
			'rejectted'	=> self::STATUS_REJECTTED,		// 由上级驳回
			'submitted'	=> self::STATUS_SUBMITTED,		// 已提交上级
			'terminated'	=> self::STATUS_TERMINATED,		// 问题终止，任何人不能再编辑

		);

		return	$arrStatus;

	}

	public static function getStatusString($intStatus) {

		static	$staticArrStatus = null;

		if (empty($staticArrStatus)) {
			$staticArrStatus = array_flip(self::listAllStatus());
		}

		return	$staticArrStatus[$intStatus];
	}



	public static function getStatusBySaveType($reqSaveType) {

		$arrFind	= self::listAllStatus();

		return	isset($arrFind[$reqSaveType]) ? $arrFind[$reqSaveType] : 0;

	}

	public static function listAllPriority() {

		$arrPriorities	= array(

			10	=> '立即',
			20	=> '特急（12小时内解决）',
			30	=> '急（24小时内解决）',
			40	=> '一周内解决',
			50	=> '一月内解决',
			60	=> '其他',
		);

		return	$arrPriorities;
	}

	public static function getPriorityString($index) {

		static	$staticArrPriorities = null;

		if (empty($staticArrPriorities)) {
			$staticArrPriorities = self::listAllPriority();
		}

		return	isset($staticArrPriorities[$index]) ? $staticArrPriorities[$index] : '';

	}

	public static function getLevelMap($type) {

		$arrMap		= array(

				10	=> array(
						'prev'	=> 10,
						'next'	=> 20,
					),
				20	=> array(
						'prev'	=> 10,
						'next'	=> 30,
					),
				30	=> array(
						'prev'	=> 20,
						'next'	=> 30,
					),

		);

		return	$arrMap[$type];

	}

	// 列出所有类型
	public static function listAllTypes() {

		$arrTypes	= array(
			10	=> '办事处',		// 问题提交（办事处处理）
			20	=> '客服中心',		// 客服中心处理（问题审核）
			30	=> '事业部',		// 事业部回复
		);

		return	$arrTypes;


/**
	字段复用对应关系

	updated_at			处理时间

	10
 		title			问题摘要
 		description		请求详细描述
 		solution		办事处处理过程
 		extra			联系人，联系方式	(serial)

 	20
 		title			审核结果
 		description		审核说明
 		solution		客服中心处理过程

 	30
 		title			处理状态
 		description		问题产生原因分析
 		solution		处理结果具体内容
 		reference		相关知识点
 		extra			预计完成时间、项目负责人、实际完成时间


 */

	}

	public static function getTypeString($index) {

		static	$staticArrTypes = null;

		if (empty($staticArrTypes)) {
			$staticArrTypes = self::listAllTypes();
		}

		return	isset($staticArrTypes[$index]) ? $staticArrTypes[$index] : '';

	}






	///////////////////////////////////////////////
	// List
	public static function listIssues($page) {

		$pager = new SimplePager('IssuePeer', sfConfig::get('app_pager_issue_list_size'));
		$pager->setPage($page);
		$pager->setPeerMethod('doListLeftJoinUser');
		$pager->setPeerCountMethod('doListCount');
		$pager->init();
		return $pager;
	}


	public static function doListLeftJoinUser($parameterHolder) {

		$SQL	= sprintf(	"SELECT l.*, r.username AS username FROM %s AS l LEFT JOIN %s AS r "
					. " ON l.user_id = r.id "
					. " ORDER BY l.id DESC LIMIT %d, %d",

					self::TABLE_NAME,
					UserPeer::TABLE_NAME,
					$parameterHolder->get('start', 0),
					$parameterHolder->get('count', 10)
				);

		return	SimpleDB::fetchAll($SQL);
	}

	public static function doListCount($parameterHolder) {

		$SQL	= sprintf("SELECT COUNT(*) AS total FROM %s", self::TABLE_NAME);
		$res	= SimpleDB::fetchAll($SQL);
		return	isset($res[0]['total']) ? $res[0]['total'] : 0;
	}


	///////////////////////////////////////////////
	// Search
	public static function searchIssues($page) {

		$pager = new SimplePager('IssuePeer', sfConfig::get('app_pager_issue_list_size'));

		$keyWord = sfContext::getInstance()->getRequest()->getParameter('keyword', '');
		$keyWord = str_replace("%", "", $keyWord);
		$keyWord = SimpleDB::escape($keyWord);

		$pager->setParameter('keyword', $keyWord);

		$pager->setPage($page);
		$pager->setPeerMethod('doSearchLeftJoinUser');
		$pager->setPeerCountMethod('doSearchCount');
		$pager->init();
		return $pager;
	}


	public static function doSearchLeftJoinUser($parameterHolder) {

		$SQL	= sprintf(	"SELECT l.*, r.username AS username FROM %s AS l LEFT JOIN %s AS r "
					. " ON l.user_id = r.id "
					. " WHERE l.title like '%s%s%s' "
					. " ORDER BY l.id DESC LIMIT %d, %d",

					self::TABLE_NAME,
					UserPeer::TABLE_NAME,
					'%',
					SimpleDB::escape(  $parameterHolder->get('keyword', 'NotFound')  ),
					'%',
					$parameterHolder->get('start', 0),
					$parameterHolder->get('count', 10)
				);

		return	SimpleDB::fetchAll($SQL);
	}

	public static function doSearchCount($parameterHolder) {

		$SQL	= sprintf("SELECT COUNT(*) AS total FROM %s WHERE title like '%s%s%s'",

					self::TABLE_NAME,
					'%',
					SimpleDB::escape(  $parameterHolder->get('keyword', 'NotFound')  ),
					'%'
				);
		$res	= SimpleDB::fetchAll($SQL);
		return	isset($res[0]['total']) ? $res[0]['total'] : 0;
	}


}
