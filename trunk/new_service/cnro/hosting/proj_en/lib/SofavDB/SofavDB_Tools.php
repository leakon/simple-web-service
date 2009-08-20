<?php

/**
 * Tools
 *
 * @package     SofavDB
 * @subpackage  Tools
 * @link        www.leakon.com
 * @version     2008-12-16
 * @author      Leakon <leakon@gmail.com>
 */
class SofavDB_Tools {

	public static function buildTableClass($strDSN, $option = array()) {

		date_default_timezone_set('PRC');

		$outputDir		= isset($option['output_dir']) ? $option['output_dir'] : (dirname(__FILE__) . '/');

		$arrIgnoreFields	= array(
						'id'		=> 1,
					#	'create_time'	=> 1,
					#	'created_at'	=> 1,
					#	'update_time'	=> 1,
					#	'updated_at'	=> 1,
					);

		SofavDB_Manager::addDataSource($strDSN);

		$conn		= SofavDB_Manager::getConnection();
		$sql		= "SHOW TABLES";
		$statement	= $conn->prepare($sql);
		$statement->execute();

		// find all tables
		$res		= $statement->fetchAll(PDO::FETCH_ASSOC);

		$arrTables	= array();

		if (isset($res)) {

			foreach ($res as $record) {

				$tableName		= current($record);

				// it is a valid table name
				if ($tableName) {

					$sql		= "DESC $tableName";
					$statement	= $conn->prepare($sql);
					$statement->execute();
					// find all Fields
					$arrDesc	= $statement->fetchAll(PDO::FETCH_ASSOC);

					$arrField	= array();

					foreach ($arrDesc as $fieldItem) {

						$fieldName	= $fieldItem['Field'];

						// match ignore field, skip
						if (isset($arrIgnoreFields[$fieldName])) {
							continue;
						}

						$arrField[]	= $fieldItem['Field'];

					}

					$arrTables[$tableName]	= $arrField;


				}

			}
		}

	#	print_r($arrTables);

		$arrRet		= array();

		foreach ($arrTables as $tableName => $tableColumns) {

			$strCode	= self::generateClassCode($tableName, $tableColumns);

			if (strlen($strCode)) {

				$fileName	= sprintf('%s/sf_table_%s.class.php', $outputDir, $tableName);

				$size		= file_put_contents($fileName, $strCode);

				$arrRet[]	= sprintf("Result	table[%s]	size[%d]	[%s]", $tableName, $size, $fileName);

			}

		}

		print_r($arrRet);

		return		$arrRet;

	}


	protected static function generateClassCode($strTableName, $arrTableFields) {

		if (!is_array($arrTableFields)) {
			$arrTableFields		= array();
		}

		$arrCodes	= array();
		$arrCodes[]	= "\t\t\t\$arrColumns	= array(";
		foreach ($arrTableFields as $column) {
			$arrCodes[]	= sprintf("\t\t\t\t\t\t'%s',", $column);
		}
		$arrCodes[]	= "\t\t\t\t\t);";

		$codeOfColumn	=  implode("\n", $arrCodes);

		$arrLines	= array();
		$arrLines[]	= '<?php';
		$arrLines[]	= '';
		$arrLines[]	= '/**';
		$arrLines[]	= ' * SofavDB_Table class: ' . $strTableName;
		$arrLines[]	= ' * auto generated at ' . date('Y-m-d H:i:s');
		$arrLines[]	= ' */';
		$arrLines[]	= '';
		$arrLines[]	= 'class Table_'. $strTableName .' extends SofavDB_Table {';
		$arrLines[]	= '';
		$arrLines[]	= '	public function initialize() {';
		$arrLines[]	= '';
		$arrLines[]	= '		$this->setTableName("' . $strTableName . '");';
		$arrLines[]	= '';
		$arrLines[]	= $codeOfColumn;
		$arrLines[]	= '';
		$arrLines[]	= '		$this->hasColumns($arrColumns);';
		$arrLines[]	= '';
		$arrLines[]	= '	}';	// end of public
		$arrLines[]	= '';
		$arrLines[]	= '}';		// end of class
		$arrLines[]	= '';

		$strCode	= implode("\n", $arrLines);

	#	print_r($strCode);
	#	exit;

		return	$strCode;

	}


}