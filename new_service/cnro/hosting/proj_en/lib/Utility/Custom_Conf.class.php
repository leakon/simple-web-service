<?php

class Custom_Conf {

	protected
		$dataFile		= '';

	public function __construct() {

		$this->dataFile		= sfConfig::get('sf_data_dir') . '/homepage_data_en.txt';

		if (!file_exists($this->dataFile)) {
			file_put_contents($this->dataFile, '');
		}


	}

	public function getConf($key = false) {

		$arr		= unserialize(file_get_contents($this->dataFile));

		if ($key) {

			return		isset($arr[$key]) ? $arr[$key] : array();

		} else {

			return		(array) $arr;

		}

	}

	public function setConf($key, $val) {

		$arr		= unserialize(file_get_contents($this->dataFile));

		$arr[$key]	= $val;

		return		file_put_contents($this->dataFile, serialize($arr));

	}

}
