<?php


/**
 * Subclass for performing query and update operations on the 'sf_issue ' table.
 *
 *
 *
 * @package lib.model
 */



class IssuePeer extends BaseIssuePeer {

	const

		STATUS_DEFAULT		= 0,
		STATUS_REJECTTED	= 10,
		STATUS_SUBMITTED	= 20,
		STATUS_TERMINATED	= 80,

		TYPE_AGENCY		= 10,		// 办事处
		TYPE_SUPPORT		= 20,		// 客服中心
		TYPE_DIVISION		= 30,		// 事业部

		VERSION			= '1';

	public static function listAllStatus() {

		$arrStatus	= array(
			self::STATUS_DEFAULT,		// 默认，作者可以编辑
			self::STATUS_REJECTTED,		// 由上级驳回
			self::STATUS_SUBMITTED,		// 已提交上级
			self::STATUS_TERMINATED,	// 问题终止，任何人不能再编辑
		);

		return	$arrStatus;

	}

	public static function getStatusString($intStatus) {

		static	$staticArrStatus = null;

		if (empty($staticArrStatus)) {

			$staticArrStatus	= array(
				self::STATUS_DEFAULT	=> 'default',		// 默认，作者可以编辑
				self::STATUS_REJECTTED	=> 'rejectted',		// 由上级驳回
				self::STATUS_SUBMITTED	=> 'submitted',		// 已提交上级
				self::STATUS_TERMINATED	=> 'terminated',	// 问题终止，任何人不能再编辑
			);
		}

		return	$staticArrStatus[$intStatus];
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

				self::TYPE_AGENCY	=> array(
						'prev'	=> self::TYPE_AGENCY,
						'next'	=> self::TYPE_SUPPORT,
					),
				self::TYPE_SUPPORT	=> array(
						'prev'	=> self::TYPE_AGENCY,
						'next'	=> self::TYPE_DIVISION,
					),
				self::TYPE_DIVISION	=> array(
						'prev'	=> self::TYPE_SUPPORT,
						'next'	=> self::TYPE_DIVISION,
					),

		);

		return	$arrMap[$type];

	}


	/**
		字段复用对应关系

		updated_at			处理时间

		TYPE_AGENCY
	 		title			问题摘要
	 		description		请求详细描述
	 		solution		办事处处理过程
	 		extra			联系人，联系方式	(serial)

	 	TYPE_SUPPORT
	 		title			审核结果
	 		description		审核说明
	 		solution		客服中心处理过程

	 	TYPE_DIVISION
	 		description		问题产生原因分析
	 		solution		处理结果具体内容
	 		reference		相关知识点
	 		extra			处理状态、预计完成时间、项目负责人、实际完成时间


	 */
	// 列出所有类型
	public static function listAllTypes() {
		$arrTypes	= array(
			self::TYPE_AGENCY	=> 'Agency',		// 问题提交（办事处处理）
			self::TYPE_SUPPORT	=> 'Support',		// 客服中心处理（问题审核）
			self::TYPE_DIVISION	=> 'Division',		// 事业部回复
		);
		return	$arrTypes;
	}

	public static function getTypeString($index, $style = 1) {
		static	$staticArrTypes = null;
		if (empty($staticArrTypes)) {
			$staticArrTypes[1]	= array(
				self::TYPE_AGENCY	=> '办事处',		// 问题提交（办事处处理）
				self::TYPE_SUPPORT	=> '客服中心',		// 客服中心处理（问题审核）
				self::TYPE_DIVISION	=> '事业部',		// 事业部回复
			);
			$staticArrTypes[2]	= array(
				self::TYPE_AGENCY	=> 'Agency',		// 问题提交（办事处处理）
				self::TYPE_SUPPORT	=> 'Support',		// 客服中心处理（问题审核）
				self::TYPE_DIVISION	=> 'Division',		// 事业部回复
			);
		}
		return	isset($staticArrTypes[$style][$index]) ? $staticArrTypes[$style][$index] : '';
	}


	// 只有是 default 或 rejected 状态，才是编辑模式
	public static function inEditMode($status) {
		return	$status < self::STATUS_SUBMITTED;
	}

	///////////////////////////////////////////////
	// Group
	public static function getGroupedIssue($baseId) {

		static	$staticIssueGroup = null;

		if (empty($staticIssueGroup[$baseId])) {

			$c	= new Criteria();

			$cton1 = $c->getNewCriterion(self::ID, $baseId);		// Or，或条件 1
			$cton2 = $c->getNewCriterion(self::PARENT_ID, $baseId);		// Or，或条件 2
			$cton1->addOr($cton2);
			$c->add($cton1);

			$c->addAscendingOrderByColumn(self::TYPE);	// 结束时间倒序排列
			$res	= self::doSelect($c);

			foreach ($res as $issue) {
				$arrIssues[ $issue->getTypeString() ]	= $issue;
			}

			$staticIssueGroup[$baseId]	= $arrIssues;

		}

		return	$staticIssueGroup[$baseId];


/*
		$c	= new Criteria();

		$cton1 = $c->getNewCriterion(self::ID, $baseId);		// Or，或条件 1
		$cton2 = $c->getNewCriterion(self::PARENT_ID, $baseId);		// Or，或条件 2
		$cton1->addOr($cton2);
		$c->add($cton1);

		$c->addAscendingOrderByColumn(self::TYPE);	// 结束时间倒序排列
		$res	= self::doSelect($c);

		foreach ($res as $issue) {
			$arrIssues[ $issue->getTypeString() ]	= $issue;
		}

		return	$arrIssues;
*/

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
					. " WHERE l.parent_id = 0 "
					. " ORDER BY l.id DESC LIMIT %d, %d",

					self::TABLE_NAME,
					UserPeer::TABLE_NAME,
					$parameterHolder->get('start', 0),
					$parameterHolder->get('count', 10)
				);

		return	SimpleDB::fetchAll($SQL);
	}

	public static function doListCount($parameterHolder) {

		$SQL	= sprintf("SELECT COUNT(*) AS total FROM %s WHERE parent_id = 0 ", self::TABLE_NAME);
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
					. " WHERE l.parent_id = 0 AND l.title like '%s%s%s' "
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

		$SQL	= sprintf("SELECT COUNT(*) AS total FROM %s WHERE parent_id = 0 AND title like '%s%s%s'",

					self::TABLE_NAME,
					'%',
					SimpleDB::escape(  $parameterHolder->get('keyword', 'NotFound')  ),
					'%'
				);
		$res	= SimpleDB::fetchAll($SQL);
		return	isset($res[0]['total']) ? $res[0]['total'] : 0;
	}


}
