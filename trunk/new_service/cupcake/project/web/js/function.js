
/*
中文
*/


window._COLIBRI		= {
				'arr_deliver_time':		[],
				'has_empty_quantites':		false,
				'has_invalid_specials':		false,
				'arr_invalid_specials':		[],
				'cake_quantity':		0
			};

function CheckCakesQuantity() {

	CalSum();

	var bool	= true;

	var arrErrors	= [];

	if (_COLIBRI['cake_quantity'] < 12) {
		bool	= false;
		arrErrors.push('The minimum quantity is 12');
	}

	if (_COLIBRI['has_empty_quantites']) {
		bool	= false;
		arrErrors.push('Please fill the quantity of your choice');
	}

	if (_COLIBRI['has_invalid_specials'] && _COLIBRI['arr_invalid_specials'].length) {
		bool	= false;
		var strTitles	= _COLIBRI['arr_invalid_specials'].join(', ');
		arrErrors.push('The specials ('+ strTitles +') is not available today, please contact us directly.');
	}

	var strDeliveryError	= CheckDeliveryDate();
	if (strDeliveryError.length) {
		bool	= false;
		arrErrors.push(strDeliveryError);
	}


	var strSpecialError	= CheckSpecialDate();
	if (strSpecialError.length) {
		bool	= false;
		arrErrors.push(strSpecialError);
	}


	if (!bool) {

		alert("Found error: \n  * " + arrErrors.join("\n  * "));

	}

	return	bool;

}





function CheckSpecialDate() {

	var strError	= '';

	try {

		var objForm		= document.getElementById('id_order_form');

		var RD			= _COLIBRI['arr_deliver_time'];
		var objDeliverDate	= new Date(RD[0], RD[1], RD[2], RD[3], RD[4], RD[5]);

		var intSpecialDay	= objDeliverDate.getDay();
	//	alert(intSpecialDay);

		var boolHasError	= false;

		jQuery('input:hidden').each(function() {

				var objTarget	= jQuery(this);

			//	alert(objTarget.attr('id'));

				var strProdID	= 'product_' + objTarget.attr('id').replace('id_spec_days_', '');

				var objCheckBox	= jQuery('#' + strProdID);


				if (objCheckBox.attr('checked') && 1) {

				//	alert(objTarget.val());
				//	alert(intSpecialDay);
				//	alert(objTarget.val().indexOf(intSpecialDay + ''));

					if (-1 === objTarget.val().indexOf(intSpecialDay + '')) {

						var strSpecName		= jQuery('#' + strProdID.replace('product', 'prod_name'));

					//	alert(strSpecName.text());

						boolHasError	= true;
						_COLIBRI['arr_invalid_specials'].push(strSpecName.text());

					}
					//	objTarget.attr('id').test(/id_spec_days_[0-9]+/)

				}

			}); // EndOf each();

		if (boolHasError) {
			_COLIBRI['has_invalid_specials']	= true;
			var strTitles	= _COLIBRI['arr_invalid_specials'].join(', ');
			strTitles	= 'The specials ('+ strTitles +') is not available for the delivery day.';
			throw(strTitles);
		}

	//	alert(_COLIBRI['arr_deliver_time']);



	} catch (exception) {

	//	alert(exception);

		strError	= exception;

	}

	return	strError;
}




function CheckDeliveryDate() {

	var strError	= '';

	try {

		var objForm	= document.getElementById('id_order_form');

		var arrDatePart		= objForm.receive_day.value.split('-');

		if (arrDatePart[0] && arrDatePart[1] && arrDatePart[2]) {

			arrDatePart[1]	= parseInt(arrDatePart[1]);
			arrDatePart[1]--;

			if (arrDatePart[1] < 10) {
				arrDatePart[1]	= '0' + arrDatePart[1];
			} else {
				arrDatePart[1]	= '' + arrDatePart[1];
			}
		} else {

			throw('Delivery Day is invalid');
		}

		var arrTimePart		= objForm.receive_time.options[objForm.receive_time.selectedIndex].value.split(':');

		if (arrTimePart[0] && arrTimePart[1]) {

		} else {

			throw('Delivery Time is invalid');
		}

		strReceiveTime		= arrDatePart.join('-');

		var objReceiveTime	= new Date(arrDatePart[0], arrDatePart[1], arrDatePart[2],
							arrTimePart[0], arrTimePart[1], '00');

		var objCurrTime		= new Date();

		var intSecond		= objReceiveTime.getTime() - objCurrTime.getTime();

		// 必须大于 24 小时才可以
		if (intSecond < 24 * 3600 * 1000) {
			throw('We need 24 hours to process your order, please choose a later time, or please call us at 64170808 to check the availability.');
		}

		_COLIBRI['arr_deliver_time']	= [arrDatePart[0], arrDatePart[1], arrDatePart[2],
							arrTimePart[0], arrTimePart[1], '00'];



	} catch (exception) {

	//	alert(exception);

		strError	= exception;

	}

	return	strError;
}



function CalSum() {

//	alert(jQuery(this).attr('id'));


	var intTotal	= 0;

	// check if any checkbox has been checked but the value is empty
	var boolHasEmptyCheckeds	= false;

	var intQuantity			= 0;

	var objDate			= new Date();

	// weekday
	var strWeekDay			= objDate.getDay().toString();

	_COLIBRI['arr_invalid_specials']	= [];

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
						intQuantity	+= intCheckValue;

					} else {

						boolHasEmptyCheckeds	= true;

					}


				if (0) {

					// 判断 special

					var objSpecDays		= jQuery('#' + strProdID.replace('product', 'id_spec_days'));

					if (objSpecDays.length) {

						var strSpecDays		= objSpecDays.attr('value');

						// 没有找到当日特例
						if (-1 == strSpecDays.indexOf(strWeekDay)) {

							var strSpecName		= jQuery('#' + strProdID.replace('product', 'prod_name'));

							// 当日不是特例，就把 name 加到 arr_invalid_specials 数组
							if (strSpecName.length) {
								_COLIBRI['has_invalid_specials']	= true;
								_COLIBRI['arr_invalid_specials'].push(strSpecName.text());
							}
						}

					}

				} // EndOf if(0)


				}

			}

		});

	var intSum	= intTotal * 23;

	// 计算折扣
	intSum		= getDiscount(intSum);


	var strSum	= intSum > 0 ? intSum : '0';

	jQuery('#id_sum').html(strSum);

	_COLIBRI['has_empty_quantites']		= boolHasEmptyCheckeds;
	_COLIBRI['cake_quantity']	= intQuantity;

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


function CheckAddrForm(objForm) {

	var boolRet	= false;

	try {

	
	/*
		var arrDatePart		= objForm.receive_day.value.split('-');

		if (arrDatePart[0] && arrDatePart[1] && arrDatePart[2]) {

			arrDatePart[1]	= parseInt(arrDatePart[1]);
			arrDatePart[1]--;

			if (arrDatePart[1] < 10) {
				arrDatePart[1]	= '0' + arrDatePart[1];
			} else {
				arrDatePart[1]	= '' + arrDatePart[1];
			}
		} else {

			throw('Delivery Day is invalid');
		}

		var arrTimePart		= objForm.receive_time.options[objForm.receive_time.selectedIndex].value.split(':');

		if (arrTimePart[0] && arrTimePart[1]) {

		} else {

			throw('Delivery Time is invalid');
		}

		strReceiveTime		= arrDatePart.join('-');

		var objReceiveTime	= new Date(arrDatePart[0], arrDatePart[1], arrDatePart[2],
							arrTimePart[0], arrTimePart[1], '00');

		var objCurrTime		= new Date();

		var intSecond		= objReceiveTime.getTime() - objCurrTime.getTime();

		// 必须大于 24 小时才可以
		if (intSecond < 24 * 3600 * 1000) {
			throw('We need 24 hours to process your order, please choose a later time.');
		}
	*/
	
		// 检查姓名
		if (objForm.customer_name.value.length < 1) {
			throw('Name is empty');
		}

		// 人名的判断必须是实名，即不可以有数字
		var regexName	= new RegExp("[0-9]", 'i');
		if (regexName.test(objForm.customer_name.value)) {
			throw('Name can NOT has number');
		}

		// 电话不能少于11位。
		var regMobile	= /^[0-9]{11,}$/;

		if (!regMobile.test(objForm.mobile.value)) {
			throw('Phone number is not valid (Example:13800138000)');
		}

		if (objForm.address.value.length < 1) {
			throw('Address is empty');
		}

		// 地址判断不能是纯数字，如果超过8个以上的数字出现提示。
		var regexAddress_1	= new RegExp("^[0-9]*$", 'i');
		if (regexAddress_1.test(objForm.address.value)) {
			throw('Address is invalid [1]');
		}

		var regexAddress_2	= new RegExp("([0-9])", 'ig');

		var arrMatchesNumbers	= objForm.address.value.match(regexAddress_2);

		if (arrMatchesNumbers && arrMatchesNumbers.length > 8) {
			throw('Address is invalid  [2]');
		}


		boolRet		= true;

	} catch (exception) {

		alert(exception);

	}

	return	boolRet;

}


