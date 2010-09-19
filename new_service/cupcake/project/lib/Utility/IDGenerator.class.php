<?php

class IDGenerator {

	const
		TABLE_NAME	= 'data_id_generator';

	public static function getFixedID($strName) {

		return	date('Ymd') . sprintf('%06d', self::generate($strName));

	}


	public static function generate($strName) {

		$arrParam	= array(
					'name'	=> $strName
				);

		$SQL		= sprintf('UPDATE %s SET uniq_id = LAST_INSERT_ID(uniq_id + 1) WHERE name = :name', self::TABLE_NAME);

		$res		= SofavDB_SQL::execute($SQL, $arrParam);

		$SQL		= sprintf('SELECT LAST_INSERT_ID() AS uniq_id');

		$result		= SofavDB_SQL::fetch($SQL);

	#	print_r($result);

	#	var_dump($result);


		$intUniqID	= isset($result['result']['uniq_id']) ? intval($result['result']['uniq_id']) : 0;

		return	$intUniqID;

	}


}