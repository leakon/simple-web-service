
/*
中文
*/


function CalSum() {
	
//	alert(jQuery(this).attr('id'));
	
	
	var intTotal	= 0;
	
	// check if any checkbox has been checked but the value is empty
	var boolHasEmptyCheckeds	= false;
	
	jQuery('input:checkbox').each(function() {
				
				
			var objTarget	= jQuery(this);
			
			var strProdID	= '';
			var strQtyID	= '';
			
			var objQty	= null;
			
			if (objTarget.attr('checked') === true) {
				
			//	alert(objTarget.attr('id'));
				
				strProdID	= objTarget.attr('id');
				
				strQtyID	= strProdID.replace('product', 'qty');
				
				objQty		= jQuery('#' + strQtyID);
				
				if (objQty.length) {
					
					var intCheckValue	= parseInt(objQty.attr('value'));
					
					if (intCheckValue > 0) {
						intTotal	+= intCheckValue;
					} else {
						boolHasEmptyCheckeds	= true;
					}
					
				}
				
			}
			
		});
	
	var intSum	= intTotal * 23;
	
	// 计算折扣
	intSum		= getDiscount(intSum);
	
	if (boolHasEmptyCheckeds) {
		alert('Please fill the quantity of your choice');
	}
	
	var strSum	= intSum > 0 ? intSum : '0';
	
	jQuery('#id_sum').html(strSum);
	
	
}

// 计算折扣
function getDiscount(intTotal) {
	
	if (intTotal >= 220) {
		
		var intDivide	= Math.floor(intTotal / 220);
		
		intTotal	-= intDivide * 56;
		
	} else if (intTotal >= 138) {
		
		intTotal	-= 23;
		
	}
	
	return	intTotal;
	
}


