
function getByField(fieldId) {

	var arrRet	= [];
	for (var i = 0; i < arrFieldObj.length; i++) {

		if (arrFieldObj[i]['field_id'] == fieldId) {
			arrRet.push(arrFieldObj[i]);
		}
	}
	return	arrRet;
}

function ThreeChangeRange(objSelect, subSelectId, setValue, highLightId) {

	var fieldId	= setValue || objSelect.options[objSelect.selectedIndex].value;

	highLightId	= highLightId || '0';
//	alert(fieldId);

	var subOptions	= getByField(fieldId);

//	alert(subOptions.length);

	var objSubSelect	= document.getElementById(subSelectId);

	if (objSubSelect) {

		var i;

		for (i = objSubSelect.childNodes.length - 1; i > 0; i--) {
			objSubSelect.childNodes[i].parentNode.removeChild(objSubSelect.childNodes[i]);
		}

		var tagOption;

		tagOption		= document.createElement('option');
		tagOption.value		= '0';
		tagOption.innerHTML	= '设备类别';
		objSubSelect.appendChild(tagOption);


		for (var i = 0; i < subOptions.length; i++) {

			tagOption		= document.createElement('option');
			tagOption.value		= subOptions[i]['id'];
			tagOption.innerHTML	= subOptions[i]['name'];

			if (highLightId == subOptions[i]['id']) {
				tagOption.selected	= true;
			}

			objSubSelect.appendChild(tagOption);

		}

	}

}

function ThreeChangeType(objSelect, subSelectId) {

	var fieldId	= objSelect.options[objSelect.selectedIndex].value;

	var subOptions	= getByField(fieldId);

//	alert(subOptions.length);

	var objSubSelect	= document.getElementById(subSelectId);

	if (objSubSelect) {

		var i;

		for (i = objSubSelect.childNodes.length - 1; i > 0; i--) {
			objSubSelect.childNodes[i].parentNode.removeChild(objSubSelect.childNodes[i]);
		}

		var tagOption;

		tagOption		= document.createElement('option');
		tagOption.value		= '0';
		tagOption.innerHTML	= '设备型号';
		objSubSelect.appendChild(tagOption);


		for (var i = 0; i < subOptions.length; i++) {

			tagOption		= document.createElement('option');
			tagOption.value		= subOptions[i]['id'];
			tagOption.innerHTML	= subOptions[i]['name'];

			objSubSelect.appendChild(tagOption);

		}

	}


}


