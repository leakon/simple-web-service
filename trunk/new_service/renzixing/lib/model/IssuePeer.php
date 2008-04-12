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
	public static function listAllStatus() {

		$arrStatus	= array(

			'default'	=> 0,		// 默认，作者可以编辑
			'rejectted'	=> 0,		// 由上级驳回
			'submitted'	=> 10,		// 已提交上级
			'locked'	=> 20,		// 锁定，原作者不能再编辑
			'terminated'	=> 80,		// 问题终止，任何人不能再编辑

		);

		return	$arrStatus;

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

	public static function priorityToString($index) {

		static	$staticArrPriorities = null;

		if (empty($staticArrPriorities)) {
			$staticArrPriorities = self::listAllPriority();
		}

		return	isset($staticArrPriorities[$index]) ? $staticArrPriorities[$index] : '';

	}


	public static function listIssues($page) {

		$pager = new SimplePager('IssuePeer', 3);

		$pager->setPage($page);
		$pager->setPeerMethod('doListLeftJoinUser');
		$pager->setPeerCountMethod('doListCount');
		$pager->init();

		return $pager;

	}


	public static function doListLeftJoinUser($Criteria) {

		$SQL	= sprintf(	"SELECT * FROM %s AS l LEFT JOIN %s AS r "
					. " ON l.user_id = r.id "
					. " ORDER BY l.id DESC LIMIT %d, %d",

					self::TABLE_NAME,
					UserPeer::TABLE_NAME,
					$Criteria[0],
					$Criteria[1]
				);

		return	SimpleDB::fetchAll($SQL);

	}

	public static function doListCount() {

		$SQL	= sprintf("SELECT COUNT(*) AS total FROM %s", self::TABLE_NAME);

		$res	= SimpleDB::fetchAll($SQL);

		return	isset($res[0]['total']) ? $res[0]['total'] : 0;
	}

}
