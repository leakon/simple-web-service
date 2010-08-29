
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

function convertToEntities(strChars) {

	var strRet	= '';

	for (var i = 0, len = strChars.length; i < len; i++) {

		if (strChars.charCodeAt(i) > 127) {

			strRet	+= '&#' + strChars.charCodeAt(i) + ';';

		} else {

			strRet	+= strChars.charAt(i);

		}
	}

	return	strRet;

}

function DoBatchDelete() {

	var btn		= $('id_batch_delete');

	if (btn) {

		var intChecked		= 0;

	// item_checkbox checked_folder

		var theForm		= new Element('form', {
							'method':	'post',
							'action':	'/admin/admin.php/?module=camera&action=deleteAll'

						});

		var arrList		= $$('input.item_checkbox');

	//	alert(arrList.length);

		var strValue		= '';

		for (var i = 0; i < arrList.length; i++) {

		//	alert(i);continue;

			if (arrList[i].checked) {
				intChecked++;
			} else {
				continue;
			}

			strValue	= arrList[i].value;

			var theInput	= new Element('input', {
						'type':		'hidden',
						'name':		'checked_folder['+ strValue +']',
						'value':	strValue
					});

		//	alert(theInput.name);

			theForm.adopt(theInput);

		}

		if (intChecked && window.confirm('确定要批量删除吗？')) {

			$(document.body).adopt(theForm);

			var theInput	= new Element('input', {
						'type':		'hidden',
						'name':		'refer',
						'value':	window.location
					});

			theForm.adopt(theInput);

		//	alert('ok');

			theForm.submit();

		}


	}

}


var MatcherTab		= new Class({

	_objForm:		null,
	_data:			{},

	initialize:	function(objConfig) {

				var __THIS__	= this;

				this._data	= objConfig['data'];
				this._objForm	= objConfig['form'];

				var objBag	= $('id_tab_bag');
				objBag.addEvent('click', function() {
							__THIS__.clearCont(this);
							__THIS__.setCont_2('bag');

							__THIS__.clearPrice('bag');
						});

				var objStand	= $('id_tab_stand');
				objStand.addEvent('click', function() {
							__THIS__.clearCont(this);
							__THIS__.setCont_4('stand');

							__THIS__.clearPrice('stand');
						});
				var objHolder	= $('id_tab_holder');
				objHolder.addEvent('click', function() {
							__THIS__.clearCont(this);
							__THIS__.setCont_4('holder');

							__THIS__.clearPrice('holder');
						});
				var objFilter	= $('id_tab_filter');
				objFilter.addEvent('click', function() {
							__THIS__.clearCont(this);
						//	__THIS__.setCont_2('filter');
							__THIS__.setCont_2_b('filter');

							__THIS__.clearPrice('filter');
						});

				var selectType	= 'bag';
				var selectLink	= objBag;

				var valueOfForm	= this._objForm['type'].value;

				if (valueOfForm) {
					selectType	= valueOfForm;
					selectLink	= $('id_tab_' + valueOfForm);
				}

				// default
				__THIS__.clearCont(selectLink);
				__THIS__._objForm.type.value	= selectType;
				if ('bag' == selectType) {
					__THIS__.setCont_2(selectType);
				} else if ('filter' == selectType) {
					__THIS__.setCont_2_b(selectType);
				} else {
					__THIS__.setCont_4(selectType);
				}

			},

        clearPrice:     function(strType) {

                                var strHtml     = objPrices[strType];

                                var objPriceSel = $('id_price_id');
                                if (objPriceSel) {
                                        objPriceSel.set({'html': '<option value="">全部</option>' + strHtml});
                                }

        },

	clearCont:	function(objLink) {
				$('id_product_1').setStyle('display', 'none');
				$('id_product_2').setStyle('display', 'none');
				$('id_product_3').setStyle('display', 'none');

				var arr	= ['bag', 'stand', 'holder', 'filter'];
				var sid	= '';
				for (var i = 0; i < arr.length; i++) {
					sid	= 'id_tab_' + arr[i];
					$(sid).removeClass('btu_on');
					$(sid).addClass('btu_off');
				}
				objLink.removeClass('btu_off');
				objLink.addClass('btu_on');


			},

	setCont_2:	function(tt) {
				var obj		= $('id_product_1');
				obj.setStyle('display', '');
				this.showLink(tt);
				this.showTags(tt);
				this._objForm.type.value	= tt;

			},

	setCont_4:	function(tt) {
				var obj		= $('id_product_2');
				obj.setStyle('display', '');
				this.showLink(tt);
				this.showTags(tt);
				this._objForm.type.value	= tt;

			},

	setCont_2_b:	function(tt) {
				var obj		= $('id_product_3');
				obj.setStyle('display', '');
				this.showLink(tt);
				this.showTags(tt);
				this._objForm.type.value	= tt;

			},

	showLink:	function(strType) {


				$('list_bag_class').style.display	= 'none';


				// 生成摄影包专用的级别选项
				if ('bag' == strType && $defined(this._data['bag_classes'])) {

					var objDiv	= new Element('div', {});
					var objInput, objLabel;

					var arrData	= {};

					for (var strKey in this._data['bag_classes']) {
						arrData[strKey]		= this._data['bag_classes'][strKey];
					}

					for (var strKey in arrData) {

						objInput	= new Element('input', {
										'type':		'checkbox',
										'name':		'classes[' + strKey + ']',		// 级别
										'value':	strKey,
										'id':		'id_classes_' + strKey,
										'checked':	glbFormClasses.indexOf(','+strKey+',') != -1
									});

						objLabel	= new Element('label', {
										'html':		arrData[strKey],
										'for':		'id_classes_' + strKey
									});

						objDiv.adopt(objInput);
						objDiv.adopt(objLabel);

					}

					$('list_bag_class').style.display	= '';

					var objBox	= $('cont_bag_class_box');

					objBox.empty();

					objBox.adopt(objDiv);

				}


				if ($defined(this._data['products'][strType])) {

					var objDiv	= new Element('div', {});
					var objInput, objLabel;

				//	var arrData	= this._data['products'][strType];
					var arrData	= {'0':'全部'};

					for (var strKey in this._data['products'][strType]) {
						arrData[strKey]		= this._data['products'][strType][strKey];
					}

					for (var strKey in arrData) {

						objInput	= new Element('input', {
										'type':		'radio',
										'name':		'product',
										'value':	strKey,
										'id':		'id_product_' + strKey,
										'checked':	glbFormProduct == strKey
									});

						objLabel	= new Element('label', {
										'html':		arrData[strKey],
										'for':		'id_product_' + strKey
									});

						objDiv.adopt(objInput);
						objDiv.adopt(objLabel);

					}

					var objBox	= $('cont_product_box');
					objBox.empty();

					objBox.adopt(objDiv);

				}


			},

	showTags:	function(strType) {

				if ($defined(this._data['tags'][strType])) {

					var objDiv	= new Element('div', {});
					var objInput, objLabel;

					for (var strKey in this._data['tags'][strType]) {

						objInput	= new Element('input', {
										'type':		'checkbox',
										'name':		'checked_product['+strKey+']',
										'value':	strKey,
										'id':		'id_tag_' + strKey,
										'checked':	$defined(glbFormTags[strKey])
									});

						objLabel	= new Element('label', {
										'html':		this._data['tags'][strType][strKey],
										'for':		'id_tag_' + strKey
									});

						objDiv.adopt(objInput);
						objDiv.adopt(objLabel);

					}

					var objBox	= $('cont_tag_box');
					objBox.empty();

					objBox.adopt(objDiv);

				}

			}


});


var MatcherSelect	= new Class({

	_objForm:		null,
	_tdFrom:		null,
	_tdTo:			null,
	_keyFrom:		'',
	_keyTo:			'',
	_data:			{},


	sortData:	function(objData) {

				var strKey;

				var objSearch	= {};
				var arrList	= [];
				var arrSorted	= [];

				for (strKey in objData) {

					objSearch['__s__' + objData[strKey]]	= strKey;

					arrList.push(objData[strKey]);

				}

				arrSorted	= arrList.sort();

			//	alert(arrSorted);

				var objSorted	= {};
				var strSearchKey, strOriKey;

				for (var i = 0; i < arrSorted.length; i++) {

					strKey		= arrSorted[i];

					strSearchKey	= '__s__' + strKey;

					strOriKey	= objSearch[strSearchKey];


					objSorted[strOriKey]	= objData[strOriKey];

				}

				return	objSorted;

			},

	sortData_2:	function(objData, column) {

				var strKey;

				var objSearch	= {};
				var arrList	= [];
				var arrSorted	= [];

				for (strKey in objData) {

					objSearch['__s__' + objData[strKey][column]]	= strKey;

					arrList.push(objData[strKey][column]);

				}

				arrSorted	= arrList.sort();

			//	alert(arrSorted);

				var objSorted	= {};
				var strSearchKey, strOriKey;

				for (var i = 0; i < arrSorted.length; i++) {

					strKey		= arrSorted[i];

					strSearchKey	= '__s__' + strKey;

					strOriKey	= objSearch[strSearchKey];


					objSorted[strOriKey]	= objData[strOriKey];

				}

				return	objSorted;

			},

	initialize:	function(objConfig) {

				var __THIS__	= this;

				this._objForm	= objConfig['form'];

				this._tdFrom	= $(objConfig['td_from']);
				this._tdTo	= $(objConfig['td_to']);
				this._data	= objConfig['data'];

				var selectFrom	= this.getSelect();

				this._keyFrom	= objConfig['key_from'];
				this._keyTo	= objConfig['key_to'];

				if ($defined(this._data[this._keyFrom]) && $defined(this._data[this._keyTo])) {

					var strField	= this._keyFrom + '_id';
					var valueOfForm	= this._objForm[strField].value;

					if (valueOfForm) {
						this.showToSelect(valueOfForm);
					}

					var strKey, objEl;

					var objForeach;
				//	objForeach	= this._data[this._keyFrom];
					objForeach	= this.sortData(this._data[this._keyFrom]);

					for (strKey in objForeach) {

						objEl	= new Element('option', {
											'value':	strKey,
											'html':		objForeach[strKey],
											'selected':	valueOfForm == strKey
										});

						selectFrom.adopt(objEl);

					}

					selectFrom.addEvent('change', function() {

							var productId	= this.options[this.selectedIndex].value;

							__THIS__.showToSelect(productId);

							// __THIS__._keyFrom = [camera, lens]
							var formField	= __THIS__._keyFrom + '_id';
							__THIS__._objForm[formField].value	= productId;

						//	alert(productId);
						//	alert(formField);

							var formModelField	= __THIS__._keyFrom + '_model_id';
							if (__THIS__._objForm[formModelField]) {
								__THIS__._objForm[formModelField].value	= '';
							}

						});

					this._tdFrom.adopt(selectFrom);

					// highlight

				}

			},

	showToSelect:	function(intProductId) {

				var __THIS__	= this;

				var selectTo	= this.getSelect();

				var strKey, objEl;
				var eachProdId;

				var subSelectValue	= false;

				var strField		= this._keyTo + '_id';
				var valueOfForm		= this._objForm[strField].value;
				if (valueOfForm) {
					subSelectValue	= valueOfForm;
				}


				var objForeach;
			//	objForeach	= this._data[this._keyTo];
				objForeach	= this.sortData_2(this._data[this._keyTo], 'style');

				for (strKey in objForeach) {

					if ($defined(objForeach[strKey]['product_id'])) {


						eachProdId	= objForeach[strKey]['product_id'];

						if (eachProdId == intProductId) {

							objEl	= new Element('option', {
												'value':	strKey,
												'html':		objForeach[strKey]['style'],
												'selected':	valueOfForm == strKey
											});

							// IE6, 不能正常选择下级关联菜单，默认选择第一个
							if (false === subSelectValue) {
							//	subSelectValue		= strKey;
							}

							selectTo.adopt(objEl);

						}

					}

				}

				// IE6, 不能正常选择下级关联菜单，默认选择第一个
				// Browser.Engine.trident4  == true (IE6)
				if (false !== subSelectValue) {
					var formField	= __THIS__._keyFrom + '_model_id';
					__THIS__._objForm[formField].value	= subSelectValue;
				//	alert(subSelectValue);
				}

				selectTo.addEvent('change', function() {

						var subProductId	= this.options[this.selectedIndex].value;

						// __THIS__._keyFrom = [camera, lens]
						var formField	= __THIS__._keyFrom + '_model_id';

						__THIS__._objForm[formField].value	= subProductId;

					});

				this._tdTo.empty();

				this._tdTo.adopt(selectTo);

			},

	getSelect:	function() {

				var elSelect	= new Element('select', {
								'size':		'2',
								'class':	'se_selector'
							});

				return	elSelect.clone();

			}


});














