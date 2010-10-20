
/*
中文
*/



jQuery(function() {
	
//	CalSum();	
	
	jQuery('input:checkbox').each(function() {
				
				jQuery(this).bind('click', CalSum);
		
		});
		
	jQuery('input:text').each(function() {
		
				jQuery(this).bind('blur', CalSum);
		
		});
	
});
	

