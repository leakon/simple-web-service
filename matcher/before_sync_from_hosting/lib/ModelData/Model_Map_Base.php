<?php

/**
 * Model_Map_Base
 *
 * @package     Model
 * @subpackage  Map_Base
 * @link        www.leakon.com
 * @version     2009-05-4
 * @author      Leakon <leakon@gmail.com>
 * @description	关系映射模型，主要用来处理 “一对多” 关系表的 增、删、改、同步 等操作
 *
 * @notice	add getMatchedRecord(), remove static method which have nothing to do with this class
 */
class Model_Map_Base {

	protected
		$tableClass	= '',
		$oneId		= 0,
		$arrColumns	= array(),
		$property	= array();

	/**
	 * @param 1	map 表操作类名
	 * @param 2	“一” 对应的值（整数）
	 * @param 3	“一” 对应的字段名
	 * @param 4	“多” 对应的字段名
	 */
	public function __construct($classOfMapTable, $oneId, $colOne, $colMany) {

		$this->tableClass	= $classOfMapTable;
		$this->oneId		= $oneId;
		$this->arrColumns	= array(
						'one'	=> $colOne,
						'many'	=> $colMany
					);

	}

	/**
	 * 根据 one 字段的值返回所有匹配的记录
	 */
	public function getMap($useObj = false) {

		$_className		= $this->tableClass;
		$_colOne		= $this->arrColumns['one'];

		$mapTable		= new $_className;
		$mapTable->$_colOne	= $this->oneId;

		return		SofavDB_Record::matchAll($mapTable, $useObj);
	}


	/**
	 * 过滤 $arrManyIds，逐一比较 $arrManyIds 中的每一个 id 与 oneId 是否在 map 表中有映射关系
	 * 通常用于安全检查和所有权检查
	 * 比如，在做 folder 与 tag 之间的关系绑定时，用户从自己的 tag 列表中选取部分 tag，为了验证用户提交的 tag 是否属于当前用户，
	 	需要在 sf_data_tag 表中进行检查，利用 (user_id, id) 这样的唯一索引，可以快速判定 tag 是否合法
	 * 通过利用 SQL_Util::sliceArray，把 $arrManyIds 拆分成多个子数组，可大大减少查询次数
	 *
	 */
	public function getMatchedRecord($oneId, $arrManyIds, $needFlip = true) {

		Array_Util::valueToKey($arrManyIds, $needFlip);

		$_className		= $this->tableClass;
		$_colOne		= $this->arrColumns['one'];
		$_colMany		= $this->arrColumns['many'];

		$conn			= SofavDB_Manager::getConnection();

		$tableOfMap		= new $_className();

		$arrSubIds		= SQL_Util::sliceArray($arrManyIds, SofavConstant::MYSQL_IN_LENGTH);

		$arrOutput		= array();

		foreach ($arrSubIds as $arrIdList) {

			$templateWhere		= 'SELECT * '
						. 'FROM %s '
						. 'WHERE %s = %d '
						. "AND %s IN (%s) "
						. '';

			$SQL			= sprintf($templateWhere, $tableOfMap->getTableName(),
								$_colOne, $oneId,
								$_colMany, implode(',', $arrIdList)
							);

			$statement		= $conn->prepare($SQL);
			$statement->execute();
			$arrResult		= $statement->fetchAll(PDO::FETCH_ASSOC);

			// 找到所有匹配的 record，用 many 字段去查询 $arrManyIds，如果存在，则插入最终输出的数组
			foreach ($arrResult as $record) {

				$search		= $record[$_colMany];

				if (isset($arrManyIds[$search])) {
					$arrOutput[$arrManyIds[$search]]	= $arrManyIds[$search];
				}

			}

		}

		return	$arrOutput;

	}


	public function add($arrManyIds, $needFlip = true) {

		$arrAddedMap		= array();
		$arrExtraMap		= array();	// 存放 map 表中存在，但在 $arrManyIds 中不存在的映射关系，用于删除操作

		Array_Util::valueToKey($arrManyIds, $needFlip);

		$_className		= $this->tableClass;
		$_colOne		= $this->arrColumns['one'];
		$_colMany		= $this->arrColumns['many'];

		// find all existing mapping
		// 找到现有的关系映射
		$mapTable		= new $_className;
		$arrExisting		= $this->getMap();

		foreach ($arrExisting as $record) {

			$manyId		= $record[$_colMany];

			if (isset($arrManyIds[$manyId])) {
				unset($arrManyIds[$manyId]);
			} else {
				$arrExtraMap[$manyId]	= $manyId;
			}

		}

		$mapTable		= new $_className;
		$mapTable->$_colOne	= $this->oneId;

		foreach ($arrManyIds as $manyId => $null) {

			$clonedTable		= clone $mapTable;
			$clonedTable->$_colMany	= $manyId;
			$clonedTable->save();

			if ($clonedTable->id) {
				$arrAddedMap[$manyId]	= $clonedTable->id;
			}

		}

		$arrRet			= array();
		$arrRet['added']	=& $arrAddedMap;
		$arrRet['extra']	=& $arrExtraMap;

		return	$arrRet;
	}

	public function remove($arrManyIds, $needFlip = true) {

		$arrRemovedMap		= array();

		Array_Util::valueToKey($arrManyIds, $needFlip);

		$_className		= $this->tableClass;
		$_colOne		= $this->arrColumns['one'];
		$_colMany		= $this->arrColumns['many'];

		// find all existing mapping
		// 找到现有的关系映射
		$arrExisting		= $this->getMap(true);

		foreach ($arrExisting as $record) {

			$manyId		= $record->$_colMany;

			if (isset($arrManyIds[$manyId])) {
				$record->delete();
				$arrRemovedMap[$manyId]	= $manyId;
			}

		}

		$arrRet			= array();
		$arrRet['removed']	=& $arrRemovedMap;

		return	$arrRet;
	}

	public function update($arrManyIds, $needFlip = true) {

		Array_Util::valueToKey($arrManyIds, $needFlip);

		$arrAdded	= $this->add($arrManyIds, false);

		$arrRemoved	= $this->remove($arrAdded['extra'], false);

		$arrRet			= $arrAdded;
		$arrRet['removed']	=& $arrRemoved['removed'];

		return	$arrRet;
	}

	/**
	 * 根据 data 表同步 map 表
	 * 对 data 和 map 表做 JOIN 查询，把 map 表中不存在的映射删除
	 */
	public function sync($strClassOfMany) {

		$_className	= $this->tableClass;
		$_colOne	= $this->arrColumns['one'];
		$_colMany	= $this->arrColumns['many'];

		$conn		= SofavDB_Manager::getConnection();

		$tableOfMap	= new $_className();
		$tableOfMany	= new $strClassOfMany();

		$sqlTemplate	= 'SELECT t_map.*, t_data.id AS data_id, COUNT(t_data.id) AS total '
				. 'FROM %s AS t_map LEFT JOIN %s AS t_data '
				. 'ON t_map.%s = t_data.id '
				. 'WHERE t_map.%s = %d '
				. 'GROUP BY t_map.id HAVING total = 0 ';

		$SQL		= sprintf($sqlTemplate,
						$tableOfMap->getTableName(),
						$tableOfMany->getTableName(),
						$_colMany,
						$_colOne,
						$this->oneId
					);

		$result		= $conn->query($SQL);

		$arrRecords	= array();

		if ($result) {
			$arrRecords	= $result->fetchAll(PDO::FETCH_ASSOC);
		}

		################################
		## Delete broken maps
		################################

		$loop		= 0;
		$limit		= 100;
		$total		= count($arrRecords);
		$arrUnlinked	= array();

		while ($loop < $total) {

			$arrIds		= array();

			for ($i = 0; $i < $limit; $i++) {

				$idx	= $loop + $i;
				if (isset($arrRecords[$idx])) {
					$arrIds[]	= $arrRecords[$idx]['id'];
				}
			}

			if (count($arrIds)) {
				$SQL	= sprintf('DELETE FROM %s WHERE id IN (%s)', $tableOfMap->getTableName(), implode(',', $arrIds));
				$res	= $conn->exec($SQL);
			}

			$arrUnlinked	= array_merge($arrUnlinked, $arrIds);

			$loop	+= $limit;
		}

		$arrRet			= array();
		$arrRet['unlinked']	=& $arrUnlinked;

		return	$arrRet;
	}

	/**
	 * 删除 map 表中与 OneId 对应的全部映射
	 */
	public function clear() {

		$_className	= $this->tableClass;
		$_colOne	= $this->arrColumns['one'];

		$conn		= SofavDB_Manager::getConnection();

		$tableOfMap	= new $_className();

		$SQL		= sprintf('DELETE FROM %s WHERE %s = %d ', $tableOfMap->getTableName(), $_colOne, $this->oneId);

		return		$conn->exec($SQL);
	}

}

