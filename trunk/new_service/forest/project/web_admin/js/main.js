function $(s) {
	return	document.getElementById(s) || null;
}

function SubmitForm(formId) {
	var objForm	= $(formId);
	if (objForm) {
		objForm.submit();
	}
}

function SubmitConfirmForm(formId) {
	var objForm	= $(formId);
	if (objForm && window.confirm('确定要删除吗？')) {
		objForm.submit();
	}
}

function FormDel(formId, intId) {
	var objForm	= $(formId);
	if (objForm) {

		if (window.confirm('确定要删除吗？')) {
		} else {
			return;
		}
		objForm.id.value = intId;
		objForm.submit();
	}
}




function ChangeCategory(objTopSelect, objSubSelect, topCatId, subCatId) {

	if (objTopSelect && objSubSelect) {
		objSubSelect.innerHTML	= '';
	} else {
		return;
	}

	var intIndex, parentId;
	intIndex	= objTopSelect.selectedIndex;

	if ('undefined' == typeof topCatId) {

		if (intIndex == 0) {
			return;
		}

		parentId	= objTopSelect.options[intIndex].value;

	} else {

		if (topCatId == 0) {
			return;
		}

		parentId	= topCatId;

	}

	var i, len;
	var categoryItem;
	var arrSubCategories	= [];
	for (i = 0, len = arrAllCategories.length; i < len; i++) {

		categoryItem		= arrAllCategories[i];

		if (parentId == categoryItem[1]) {
			arrSubCategories.push(categoryItem);
		}

	}

	var arrHtml		= [];
	var issetSubCatId	= false;

	if ('undefined' != typeof subCatId) {
		issetSubCatId	= true;
	}

	var strSelected		= '';
	var boolSelected	= false;
	var objOption		= {};

	for (i = 0, len = arrSubCategories.length; i < len; i++) {

		if (issetSubCatId && subCatId == arrSubCategories[i][0]) {
			strSelected	= ' selected="selected"';
			boolSelected	= true;
		} else {
			strSelected	= '';
			boolSelected	= false;
		}

	//	arrHtml.push('<option value="'+ arrSubCategories[i][0] + '" '+ strSelected +'>'+ arrSubCategories[i][2] +'</option>');

		objOption		= document.createElement('option');
		objOption.value		= arrSubCategories[i][0];
		objOption.innerHTML	= arrSubCategories[i][2];
		objOption.selected	= boolSelected;

		arrHtml.push(objOption);

	}

	setTimeout(function() {
		for (i = 0, len = arrHtml.length; i < len; i++) {
			objSubSelect.appendChild(arrHtml[i]);
		}
	//	objSubSelect.innerHTML	= arrHtml.join('');
	}, 10);


}





