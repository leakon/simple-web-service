<?php

class EventTab {

	public static function saveCategoryProperty($tabId) {

		$tableCacheTab		= new Sofav_Cache_Tab();
		$tableCacheTab->tab_id	= $tabId;

		$tabCache		= SofavDB_Record::match($tableCacheTab);

		if ($tabCache->id) {
			$tabCache->clearCache();
			$tabCache->save();
		}

	}

}

