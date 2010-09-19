<?php

require_once(dirname(__FILE__) . '/require.inc.php');

$option		= array();

$option['output_dir']	= dirname(__FILE__) . '/tools_tables';

#	$dsn		= 'Table: mysql://root:123456@localhost:3306/sofav_2008?encoding=utf8&persistent=off';
	$dsn		= PROJ_DB_DSN;

	SofavDB_Tools::buildTableClass($dsn, $option);


