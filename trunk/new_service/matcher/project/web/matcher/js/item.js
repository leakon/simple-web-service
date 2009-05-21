
var ItemManage	= new Class({

	_objForm:	false,
	_itemCheck:	false,
	arrTags:	[],
	arrCategories:	[],

	_msgNoneChecked:	'未选中任何会话',

	initialize:	function(formId, property) {

				this._objForm	= $(formId);

				if (!this._objForm) {
					alert('Failed to find item list form!');
				}

				$(property['btn_item']).addEvent('click', this.deleteItem.bind(this));
				$(property['btn_tag']).addEvent('click', this.editTag.bind(this));
			//	$(property['btn_category']).addEvent('click', this.editCategory.bind(this));

				this._itemCheck	= property['obj_item_checkbox'];

			},

	deleteItem:	function() {

				if (!this._itemCheck.hasCheckedItem()) {
					alert(this._msgNoneChecked);
					return;
				}

				this._objForm.action	= '/item/deleteItem';
				this.doSubmit();
			},

	editTag:	function() {

				if (!this._itemCheck.hasCheckedItem()) {
					alert(this._msgNoneChecked);
					return;
				}

				var idBox	= 'id_box_' + 'tag_check';
				var objBox	= $(idBox);

				if (objBox) {

					var oldStyle	= objBox.getStyle('display');
					objBox.setStyle('display', 'none' == oldStyle ? '' : 'none');

				} else {

					this._objForm.grab(this.drawEditList(this.arrTags, 'tag_check', 'Tag'));

				//	var myDraggable		= new Drag(idBox);

				}

			},

	editCategory:	function() {

				if (!this._itemCheck.hasCheckedItem()) {
					alert(this._msgNoneChecked);
					return;
				}

				var idBox	= 'id_box_' + 'category_check';
				var objBox	= $(idBox);

				if (objBox) {

					var oldStyle	= objBox.getStyle('display');
					objBox.setStyle('display', 'none' == oldStyle ? '' : 'none');

				} else {

					this._objForm.grab(this.drawEditList(this.arrCategories, 'category_check', 'Category'));

				//	var myDraggable		= new Drag(idBox);

				}

				return;

				this._objForm.action	= runMode + '/item/addCategory';
				this.doSubmit();
			},

	doSubmit:	function() {
				this._objForm.submit();
				this._objForm.action	= '';
			},

	drawEditList:	function(arrTagList, listType, actionName) {

				/*
				arrTagList:
					[0]:id
					[1]:total
					[2]:name
				*/

				var arrHtml	= [];
				var _id, _total, _name;

				for (var i = 0, len = arrTagList.length; i < len; i++) {

					_id	= arrTagList[i][0];
					_total	= arrTagList[i][1];
					_name	= arrTagList[i][2];

					arrHtml[i]	= '<li><span>(' + _total + ')</span>'
							+ '<input type="checkbox" name="' + listType + '[' + _id + ']" '
							+ 'value="' + _id + '" id="id_' + listType + '_' + _id + '" />'
							+ '<label for="id_' + listType + '_' + _id + '">'
							+ _name + '</label></li>';

				}

				var bodyUl	= new Element('ul', {'html':arrHtml.join('', arrHtml)});

				var newBox	= new Element('div', {
									'id':'id_box_' + listType,
									'class':'popEditList'
								});

				var headerDiv	= new Element('div', {'class':'header'});
				var footerDiv	= new Element('div', {'class':'fotter'});

				var closeButton	= new Element('a', {'html':'关闭', 'href':'javascript:;'});
				closeButton.addEvent('click', function(){newBox.setStyle('display', 'none')});

				var closeButton2	= closeButton.cloneNode(true);
				closeButton2.addEvent('click', function(){newBox.setStyle('display', 'none')});

				headerDiv.grab(closeButton);

				var addButton		= new Element('input', {'type':'button', 'value':'添加'});
				addButton.addEvent('click', function(){
								this._objForm.action	= runMode + '/item/add' + actionName;
								this.doSubmit();
							}.bind(this));

				var removeButton	= new Element('input', {'type':'button', 'value':'删除'});
				removeButton.addEvent('click', function(){
								this._objForm.action	= runMode + '/item/remove' + actionName;
								this.doSubmit();
							}.bind(this));

				footerDiv.grab(addButton);
				footerDiv.grab(removeButton);
				footerDiv.grab(closeButton2);

				newBox.grab(headerDiv);
				newBox.grab(bodyUl);
				newBox.grab(footerDiv);

				return	newBox;

			}

});


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

	hasCheckedItem:	function() {
		return	this._arrCheckBoxes.some(function(one) {return one.checked;});
	}

});



/**
initialize:	{
	'form_id':		'',	required	表单 ID
	'check_class':		'',	required	复选框样式表	default: item_checkbox

	'check_all':		'',			选择全部
	'check_none':		'',			清除全部
	'check_toggle':		'',			单键切换
	'check_reverse':	'',			全部反选
}
*/
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


function GetTagFromList(strListId) {

	var objList	= $(strListId);
	var arrTagLinks	= [];
	if (objList) {
		arrTagLinks	= objList.getElements('a');
	}

	var arrTotalTag	= [];
	var arrTmp	= [];
	arrTagLinks.each(function(oneLink) {

			arrTmp		= [];
			arrTmp[0]	= oneLink.id.match(/tag_id_(\d+)/)[1];
			arrTmp[1]	= oneLink.rel.match(/tag_qty_(\d+)/)[1];
			arrTmp[2]	= oneLink.get('html');

			arrTotalTag.push(arrTmp);

		});

	return	arrTotalTag;

};


/* 管理 item_list 页面的 “更改标签” */
var SimpleManageTag	= new Class({

	_objManageBtn:			null,
	_objItemForm:			null,
	_objFormCheck:			null,
	_strTagHtml:			'',
	_boolTagHtmlLoaded:		false,
	_msgNoneChecked:		'请先选择书签',

	initialize:	function(property) {

		if ($defined(property['manage_tag_button'])) {
			this._objManageBtn	= $(property['manage_tag_button']);
		}

		if (this._objManageBtn) {
			this._objManageBtn.addEvent('click', this.fireManageButton.bind(this));
		}

		if ($defined(property['obj_form_check'])) {
			this._objFormCheck	= property['obj_form_check'];
		}

		if ($defined(property['str_form_id'])) {
			this._objItemForm	= $(property['str_form_id']);
		}

	},

	fireManageButton:	function() {

		if (!this._objFormCheck.hasCheckedItem()) {
			alert(this._msgNoneChecked);
			return;
		}

		if (this._boolTagHtmlLoaded) {

			this.showPopupBox();

		} else {

			var __THIS__	= this;

			var myRequest	= new Request({

				method:		'get',
				url:		'/tag/htmlList',
				data:		{},
				onSuccess:	function(responseText) {

							SqueezeBox.initialize();

							__THIS__._boolTagHtmlLoaded	= true;
							__THIS__._strTagHtml		= responseText;
							__THIS__.showPopupBox();

						}
			});

			myRequest.send();

		}

	},


	attachToForm:	function(objForm, objTagList) {

		if (Browser.Engine.trident4) {
			// This is for Fucking IE6
			// IE6 不能直接把包含复选框的节点直接追加到form节点中

			objTagList.getElements('input').each(function(objOne) {

				if ('checkbox' == objOne.type && objOne.checked) {

					var inputHidden	= new Element('input', {
								'type':		'hidden',
								'name':		'checked_tags['+ objOne.value +']',
								'value':	objOne.value
							});

					objForm.adopt(inputHidden);

				}

			});	// EndOf each

		} else {

			var objClone	= objTagList.clone()
			objClone.setStyle('display', 'none');
			objForm.adopt(objClone);

		}

	},


	showPopupBox:	function() {

		var intChecked		= this._objFormCheck.getCheckedItemCount();

		var objBtnAdd		= new Element('input', {
						'type':		'button',
						'value':	'添加这些标签'
					});
		var objBtnRemove	= new Element('input', {
						'type':		'button',
						'value':	'删除这些标签'
					});
		var objButtons		= new Element('div', {
						'class':	'item_manage_tag_button',
						'html':		'对刚才选中的 '+ intChecked +' 个书签应用的动作：'
					});

		var objTagList		= new Element('div', {
						'class':	'item_tag_list',
						'html':		this._strTagHtml
					});


		if (this._objItemForm) {

			var __THIS__	= this;

			objBtnAdd.addEvent('click', function() {

						__THIS__.attachToForm(__THIS__._objItemForm, objTagList);
						__THIS__._objItemForm.action	= runMode + '/item/addTag';
						__THIS__._objItemForm.submit();
						this.disabled			= true;
					});

			objBtnRemove.addEvent('click', function() {

						__THIS__.attachToForm(__THIS__._objItemForm, objTagList);
						__THIS__._objItemForm.action	= runMode + '/item/removeTag';
						__THIS__._objItemForm.submit();
						this.disabled			= true;
					});
		}

		objButtons.adopt(objBtnAdd);
		objButtons.adopt(objBtnRemove);
		objTagList.adopt(objButtons);

		SqueezeBox.open(objTagList, {
			handler: 'adopt',
			size: {x: 940, y: 360}
		});
	}

});


