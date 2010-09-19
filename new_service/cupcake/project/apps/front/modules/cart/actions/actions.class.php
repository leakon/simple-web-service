<?php

/**
 * cart actions.
 *
 * @package    cupcake
 * @subpackage cart
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class cartActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  
  




	public function executeCreate($request) {
		
	#	$this->pager		= $this->getListPager($request);
		
	#	$this->arrResult	= $this->pager->getResults();
		
		$arrParameters		= $request->getParameterHolder()->getAll();
		
	#	Debug::pr($arrParameters);
		
		foreach ((array) $request->getParameter('product_checked', array()) as $intProdID => $null) {
			
			if ($intProdID > 0 && isset($arrParameters['product_qty'][$intProdID]) 
				&& $arrParameters['product_qty'][$intProdID] > 0) {
					
				$arrProductIDs[$intProdID]	= (int) $arrParameters['product_qty'][$intProdID];
				
			}
			
		}
		
		
		$modelMapFolderTag	= new Model_Map_Base('Table_data_cart', $this->property['id'], 'tag_id', 'folder_id');
		
		
		
		if (count($arrProductIDs) > 0) {
			
			$arrProdIDs	= array_keys($arrProductIDs);
			
			$criteria	= new SofavDB_Criteria(sprintf('WHERE id IN (%s) ', implode(',', $arrProdIDs)));
			
		} else {
			
			$criteria	= new SofavDB_Criteria();
			
		}
		
		$this->arrResult	= SofavDB_Record_SE::findAll('Table_data_product', $criteria, false);
		
		$this->arrProducts	= $arrProductIDs;
		
	#	Debug::pr($arrProductIDs);
		
	#	Debug::pr($this->arrResult);
		
	#	return	sfView::NONE;
		
	}


}
