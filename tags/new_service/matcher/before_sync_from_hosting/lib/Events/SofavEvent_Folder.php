<?php


class SofavEvent_Folder extends SofavEvent_Base {

	// [insert, save]: sf_map_folder_item, sf_map_folder_tag, sf_map_tab_folder (3)
	protected function saveFolder($property) {

		$arrRes		= array();
		$bool		= false;

		$this->property['id']		= isset($property['id']) ? intval($property['id']) : 0;
		$this->property['user_id']	= isset($property['user_id']) ? intval($property['user_id']) : 0;


		if ($this->property['id'] && $this->property['user_id']) {

			// 保存 tag 映射
			if (isset($property['tags'])) {

				// data_tag
				$modelDataTag		= new Model_Map_Base('Sofav_Data_Tag',
									$this->property['id'], 'user_id', 'id');

				$arrValidUserTagIds	= $modelDataTag->getMatchedRecord($this->property['user_id'],
									$property['tags'], false);

			#	Debug::pre($arrValidUserTagIds);

				// map_folder_tag
				$modelMapFolderTag			= new Model_Map_Base('Sofav_Map_Folder_Tag',
										$this->property['id'], 'folder_id', 'tag_id');
				$arrRes['map_folder_tag']['res']	= $modelMapFolderTag->update($arrValidUserTagIds, false);

			}


			// 保存 item 映射
			if (isset($property['item_added']) && isset($property['item_removed'])) {

				$modelMapFolderItem			= new Model_Map_Base('Sofav_Map_Folder_Item',
										$this->property['id'], 'folder_id', 'item_id');
				$arrRes['map_folder_item']['removed']	= $modelMapFolderItem->remove($property['item_removed'], false);
				$arrRes['map_folder_item']['added']	= $modelMapFolderItem->add($property['item_added'], false);

			}

		}

	#	Debug::pre($arrRes);

		return	$arrRes;
	}

	// [delete]: map_folder_tag, map_folder_item, map_tab_folder (3)
	protected function deleteFolder($property) {

		$arrRes		= array();
		$bool		= false;

		$this->property['id']	= isset($property['id']) ? intval($property['id']) : 0;

		if ($this->property['id']) {

			// map_folder_tag
			$modelMapFolderTag			= new Model_Map_Base('Sofav_Map_Folder_Tag',
									$this->property['id'], 'folder_id', 'tag_id');
			$arrRes['map_folder_tag']['res']	= $modelMapFolderTag->clear();

			// map_folder_item
			$modelMapFolderItem			= new Model_Map_Base('Sofav_Map_Folder_Item',
									$this->property['id'], 'folder_id', 'item_id');
			$arrRes['map_folder_item']['res']	= $modelMapFolderItem->clear();

			// map_tab_folder
			$modelMapTabFolder			= new Model_Map_Base('Sofav_Map_Tab_Folder',
									$this->property['id'], 'folder_id', 'tab_id');
			$arrRes['map_tab_folder']['res']	= $modelMapTabFolder->clear();
		}

		return	$arrRes;
	}

}

