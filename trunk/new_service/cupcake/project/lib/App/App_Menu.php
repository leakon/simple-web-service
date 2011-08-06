<?php

/**
 * @package App_Menu
 *
 * Menu 模块
 *
 */


/**
 * Menu 模块
 *
 */
class App_Menu {
	
	
	public static function getLangMenuHtml($strLang = 'en') {
		
		$arrMenus	= Table_data_menu::getList($strLang);
		
		$strHtml	= self::genMenuHtml($arrMenus);
		
		return	$strHtml;
		
	}
	
	
	public static function genMenuHtml($arrMenus) {

/*

	<p><strong>PANINI</strong>
		<br />Tomato chutney, Fresh basil, Cheese <span>￥38.00/RMB</span>
		<br />Salami, Roasted red pepper, Radicchio, Cheese <span>￥48.00/RMB</span>
		<br />Smoked chicken, Sautéed mushrooms, Cheese <span>￥48.00/RMB</span>
		<br />Sautéed beef, Red pepper, Onion, Emmental Cheese <span>￥48.00/RMB</span>
	</p>
	  

*/	
		
		$arrGroupMenus	= array();
		
		foreach ($arrMenus as $oneMenu) {
			
			$intCate	= $oneMenu['category'];
			
			$arrGroupMenus[$intCate][]	= $oneMenu;
			
		}
		
		
		$arrCategories	= Table_data_category::getList();
		
		
		$arrHtml	= array();
		
		foreach ($arrGroupMenus as $cateID => $arrCateMenu) {
			
			$arrHtml[]	= sprintf('<p><strong>%s</strong>', $arrCategories[$cateID]['title']);
			
			foreach ($arrCateMenu as $oneMenu) {
				
				$arrHtml[]	= sprintf('<br />%s <span>￥%s/RMB</span>',
				
							$oneMenu['title'],
							$oneMenu['price']
						);
				
			}
			
			
		}
		
		$strHtml	= implode("\n", $arrHtml);
		
		return	$strHtml;
		
	}


}

