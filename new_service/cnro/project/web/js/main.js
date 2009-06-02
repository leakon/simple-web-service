function $XXX(s) {
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


};


var ItemFormCheck	= new Class({

	_checkForm:	false,
	_arrCheckBoxes:	[],

	initialize:	function(formId, property) {

				var __THIS__	= this;

				if ($defined(formId)) {
					this._checkForm		= $(formId);
				} else {
					return;
				}

				__THIS__._arrCheckBoxes	= this._checkForm.getElements('input.item_checkbox');

			//	return;

			//	alert(__THIS__._arrCheckBoxes);


				var btnCheckAll		= $(property['btn_all']);
				var btnClearAll		= $(property['btn_clear']);


				// check all
				btnCheckAll.addEvent('click', function() {
								__THIS__._arrCheckBoxes.each(function(one) {one.checked = true;});
							});

				// clear
				btnClearAll.addEvent('click', function(event) {
								__THIS__._arrCheckBoxes.each(function(one) {one.checked = false;});
							});


			},

	hasCheckedOnes:	function() {
		return	this._arrCheckBoxes.some(function(one) {return one.checked;});
	}

});



function ItemPublish(p) {

	var objForm		= $('id_item_form');

	objForm.action		= '/admin/article/publish';

	objForm.publish.value	= p;

	objForm.submit();


}

function ItemPrivate(p) {

	var objForm		= $('id_item_form');

	objForm.action		= '/admin/article/private';

	objForm.is_private.value	= p;

	objForm.submit();


}



var SimpleSelectTree	= new Class({

	_categoryType:		0,
	_objBox:		null,
	_objCache:		{},
	_objLastHighlight:	null,
	_objFormField:		null,

	initialize:	function(property) {

				var __THIS__		= this;

				this._categoryType	= property['category_type'];
				this._objBox		= $(property['box_id']);

				if ($defined(property['form_id']) && $defined(property['form_field'])) {

					var objForm		= $(property['form_id']);
					this._objFormField	= objForm[property['form_field']];
				}

				this.show(0);

			},

	show:		function(intCategoryId) {

				if ($defined(this._objCache[intCategoryId])) {

					var objTargetBox	= $('id_cate_list_' + intCategoryId) || this._objBox;

					var objOldBox		= objTargetBox.getElement('ul');

					if (objOldBox) {

						objOldBox.destroy();

					} else {

						var newUList		= this.genUL(this._objCache[intCategoryId]);
						objTargetBox.grab(newUList);

					}

					return;

				}

				var __THIS__		= this;

				var arrParam		= [];
				arrParam.push('type=' + this._categoryType);
				arrParam.push('id=' + intCategoryId);

				var myRequest		= new Request({
						method:		'get',
						url:		'/cn/category/json?' + arrParam.join('&'),
						data:		{},
						onSuccess:	function(responseText) {
									var objResponse	= JSON.decode(responseText);
									__THIS__._objCache[intCategoryId]	= objResponse;
									__THIS__.show(intCategoryId);
								}
				});

				myRequest.send();

	},

	genUL:		function(arrObj) {

		var __THIS__		= this;

		var objUL		= new Element('ul', {
							'class':	'category_list'
						});

		for (var strKey in arrObj) {

			if (!$defined(arrObj[strKey]['id'])) {
				break;
			}

			var objLink	= new Element('a', {
							'href':		'javascript:;',
							'id':		'id_cate_link_' + arrObj[strKey]['id'],
							'html':		arrObj[strKey]['name']
						//	'html':		arrObj[strKey]['name'] + ' '+ arrObj[strKey]['id']
						});

			objLink.addEvent('click', function() {

							if (__THIS__._objLastHighlight) {
								__THIS__._objLastHighlight.removeClass('selected_category');
							}

							this.addClass('selected_category');
							var intId	= this.id.match(/(\d+)/g);
							__THIS__.show(intId);
							__THIS__._objLastHighlight	= this;

							if (__THIS__._objFormField) {
								__THIS__._objFormField.value	= intId;
							}

						});

			var objLi	= new Element('li', {
							'id':		'id_cate_list_' + arrObj[strKey]['id']
						});

			objLi.grab(objLink);
			objUL.grab(objLi);

		}

		return	objUL;

	},

	hasCheckedOnes:	function() {
		return	this._arrCheckBoxes.some(function(one) {return one.checked;});
	}

});



var SimpleFormCheck	= new Class({

	_objForm:			null,
	_strCheckClass:			'',

	_objCheckAll:			null,
	_objCheckNone:			null,
	_objCheckToggle:		null,
	_objCheckReverse:		null,

	_boolToggle:			true,

	_arrCheckBoxes:			[],

	initialize:	function(property) {

				if ($defined(property['form_id'])) {
					this._objForm		= $(property['form_id']);
				} else {
					return;
				}

				if (!this._objForm) {
					return;
				}

				var __THIS__	= this;

				// 初始化样式表
				__THIS__._strCheckClass		= $defined(property['check_class']) ?
									property['check_class'] : 'item_checkbox';

				var arrBindList			= [	['check_all', '_objCheckAll'],
									['check_none', '_objCheckNone'],
									['check_toggle', '_objCheckToggle'],
									['check_reverse', '_objCheckReverse']
								];

				arrBindList.each(function(obj) {

					if ($defined(property[obj[0]])) {

						__THIS__[obj[1]]	= $(property[obj[0]]);

					}

				});	// end of each


				__THIS__._arrCheckBoxes		= this._objForm.getElements('input.' + __THIS__._strCheckClass);

				if (__THIS__._objCheckAll) {
					__THIS__._objCheckAll.addEvent('click', function() {
								__THIS__._arrCheckBoxes.each(function(one) {one.checked = true;});
							});
				};

				if (__THIS__._objCheckNone) {
					__THIS__._objCheckNone.addEvent('click', function() {
								__THIS__._arrCheckBoxes.each(function(one) {one.checked = false;});
							});
				};

				if (__THIS__._objCheckToggle) {
					__THIS__._objCheckToggle.addEvent('click', function() {
								var newThis		= __THIS__;
								__THIS__._arrCheckBoxes.each(function(one) {one.checked = newThis._boolToggle;});
								__THIS__._boolToggle	= !__THIS__._boolToggle;
							});
				};

				if (__THIS__._objCheckReverse) {
					__THIS__._objCheckReverse.addEvent('click', function() {
								__THIS__._arrCheckBoxes.each(function(one) {one.checked = !one.checked;});
							});
				};


			},

	// 检查是否有选中的 item
	hasCheckedItem:	function() {
		return	this._arrCheckBoxes.some(function(one) {return one.checked;});
	},

	// 计算选中的 item 的数量
	getCheckedItemCount:	function() {
		var intTotal	= 0;
		this._arrCheckBoxes.some(function(one) {
						intTotal	+= one.checked ? 1 : 0;
					});
		return	intTotal;
	}

});

