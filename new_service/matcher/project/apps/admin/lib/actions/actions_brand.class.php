<?php

class BaseBrandActions extends sfActions {

	public function preExecute() {

		$this->type		= 0;
		$this->dataClass	= 'Table_data_brand';
		$this->strModuleName	= $this->getContext()->getModuleName();

	}

	public function executeIndex(sfWebRequest $request) {

		$this->setTemplate('index', 'camera');

		$tableDataTag		= new $this->dataClass();

		$this->pager		= new SofavDB_Pager($tableDataTag);

		$where			= array('type' => $this->type);
		$order			= array('id' => 'DESC');

		$page			= (int) $request->getParameter('page', 1);
		$this->pager->init($page, sfConfig::get('app_page_size', 5), array('where' => $where, 'order' => $order));

		$this->arrResult	= $this->pager->getResults();

		$this->dataItem		= new $this->dataClass();

		$this->hasErrors	= $request->hasErrors();
		if ($this->hasErrors) {
			$arrParameters		= $request->getParameterHolder()->getAll();
			$this->dataItem->fromArray($arrParameters);
		}

	}

	public function executeAdd($request) {

	#	$arrParameters		= $request->getParameterHolder()->getAll();
	#	Debug::pre($arrParameters);

		$tagName		= $request->getParameter('name', '');
		$tagType		= (int) $request->getParameter('type', 0);
		$bool			= false;

		if (strlen($tagName)) {

			$tableTag		= new $this->dataClass();
			$tableTag->name		= $tagName;
			$tableTag->type		= $tagType;

			$bool			= $tableTag->save();

			// 保存失败，只可能是与现有的唯一索引冲突
			if (!$bool) {
				$request->setError('name', $tagName . ' 已存在');
				$from	= $request->getParameter('from', 'index');
				$this->forward($this->strModuleName, $from);
			}

		} else {

			$request->setError('name', '名称不能为空');
			$from	= $request->getParameter('from', 'index');
			$this->forward($this->strModuleName, $from);

		}

		//		'tag/list'
		$this->redirect($this->strModuleName . '/index?added=' . ($bool ? '1' : '0'));

	}

	/**
	 * 删除 tag
	 *
	 * 删除流程：
	 * 1、删除关系映射 sf_map_item_tag
	 * 2、更新缓存 sf_cache_item
	 * 3、删除数据 sf_data_tag
	 */
	public function executeDelete($request) {

		ActionsUtil::needPOST($request);		// 必须是 POST 方法

		$bool			= false;
		$tagId			= (int) $request->getParameter('id', 0);
		$_data_class		= $this->dataClass;

		if ($tagId) {

			$tagItem		= new $_data_class($tagId);

			if ($tagItem->id) {

				$bool			= $tagItem->delete();

			}

			$result			= $bool ? 'Success' : 'Failure';

			$this->redirect($this->strModuleName . '/index');
		}

	}


	public function executeEdit($request) {

		$this->setTemplate('edit', 'camera');

		$_data_class		= $this->dataClass;

		$tagId			= (int) $request->getParameter('id', 0);

		$this->dataItem		= new $_data_class($tagId);

	}


	/**
	 * 修改 tag
	 *
	 * 修改流程：
	 * 1、更新 tag，在 sf_data_tag 表
	 * 2、逐一更新映射关系中对应的 item 缓存，在 sf_map_item_tag 表
	 */
	public function executeSave($request) {

		ActionsUtil::needPOST($request);		// 必须是 POST 方法

		$bool			= false;
		$tagId			= (int) $request->getParameter('id', 0);
		$tagName		= $request->getParameter('name', '');
		$_data_class		= $this->dataClass;

		if ($tagId) {

			$tagItem		= new $_data_class($tagId);

			if ($tagItem->id) {

				$tagItem->name		= $tagName;
				$bool			= $tagItem->save();

			}

		}

		$parameters		= array();
		$parameters['saved']	= intval($bool);

		$refer			= $request->getParameter('refer');
		$refer			= false;

		return	ActionsUtil::redirect($this->strModuleName . '/index', $parameters, $refer);

	}


}
