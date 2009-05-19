var runMode;
runMode	= '/front_dev.php';
runMode	= '';

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

var FormCheckAll	= new Class({

	_checkState:	true,
	_checkForm:	false,
	_checkButton:	false,

	initialize:	function(formId, checkboxId, checkClass) {

				if ($defined(formId)) {
					this._checkForm		= $(formId);
				}

				if ($defined(checkboxId)) {
					this._checkButton	= $(checkboxId);
				}

				if (this._checkForm && this._checkButton) {

					if (!$defined(checkClass)) {
						checkClass	= '';
					}

					var arrCheckBoxes	= this._checkForm.getElements('input' + checkClass);

					var __this__		= this;

					this._checkButton.addEvent('click', function(event) {


									this.checked		= __this__._checkState;

									for (var i = 0, len = arrCheckBoxes.length; i < len; i++) {
										arrCheckBoxes[i].checked	= __this__._checkState;
									}

									__this__._checkState	= !__this__._checkState;


								//	alert('ffff223');return;
								});

				}

			}

})


var TagEditForm	= new Class({

	_objForm:		null,
	_formValid:		false,
	_existDivId:		'id_tag_exist',
	_checkUrl:		'/tag/check',
	_nameString:		'标签',

	initialize:	function() {
				this._objForm	= $('id_tag_edit');
				this._objForm.addEvent('submit', this.submit.bind(this));
			},

	submit:		function(e) {

				if (this._formValid) {
				//	return	true;
				}

				var intId	= this._objForm.id.value;
				var strName	= this._objForm.name.value.trim();

			//	alert(strName);
			//	return;


				if (!strName.length) {
					$(this._existDivId).set('html', this._nameString + '不能为空');
					e = new Event(e).stop();
					return false;
				}


				var myRequest	= new Request({
							method:		'post',
							url:		runMode + this._checkUrl,
							data:		{'id':intId, 'name':strName},
							onSuccess:	this.checkReturn.bind(this)
						});

				myRequest.send();

				var objSubmitButton		= $('id_form_submit');
			//	objSubmitButton.value		= '保存中...';
				objSubmitButton.value		+= '中...';
				objSubmitButton.disabled	= true;

				$(this._existDivId).setStyle('display', 'none');

				return	false;

			},

	checkReturn:	function(responseText) {

				var objResponse	= JSON.decode(responseText);

				var foundExist	= false;

				if (objResponse && $defined(objResponse.result)) {
					foundExist	= 'exist' == objResponse.result;
				}

				// 找到已经存在的项目
				if (foundExist) {

				//	alert('exist');

					this.renderExistItem(objResponse);

					var objSubmitButton		= $('id_form_submit');
				//	objSubmitButton.value		= '保存';
					objSubmitButton.value		= objSubmitButton.value.replace('中...', '');
					objSubmitButton.disabled	= false;

				} else {

					this._formValid	= true;

					if (this._objForm) {
						this._objForm.submit();
					}

				}

			},

	renderExistItem:	function(objResult) {

					var objExistError	= $(this._existDivId);

					objExistError.set('html', this._objForm.name.value + ' 已存在');

					$(this._existDivId).setStyle('display', '');

				}

});


var CategoryEditForm	= new Class({
	Extends: TagEditForm,
	_checkUrl:		'/category/check'
});

var TabEditForm	= new Class({
	Extends: TagEditForm,
	_checkUrl:		'/tab/check',
	_nameString:		'导航'
});

var FolderEditForm	= new Class({
	Extends: TagEditForm,
	_checkUrl:		'/folder/check',
	_nameString:		'书架'
});


var ItemEditForm	= new Class({

	_objForm:		null,
	_formValid:		false,
	_existDivId:		'id_div_exist',
	_existFormId:		'id_form_exist_item',


	initialize:	function() {

				this._objForm	= $('id_form_edit_item');

				this._objForm.addEvent('submit', this.submit.bind(this));

			},

	submit:		function() {

			//	return	true;

				if (this._formValid) {
					return	true;
				}

				var strUrl	= this._objForm.url.value;
				var intId	= this._objForm.id.value;

				var myRequest	= new Request({
							method:		'post',
							url:		runMode + '/item/check',
						//	url:		'/front_dev.php/item/check',
							data:		{'url':strUrl, 'id':intId},
							onSuccess:	this.checkReturn.bind(this)
						});

				myRequest.send();

				var objSubmitButton		= $('id_form_submit');
				objSubmitButton.value		= '保存中...';
				objSubmitButton.disabled	= true;

				$(this._existDivId).setStyle('display', 'none');

				return	false;

			},

	checkReturn:	function(responseText) {

				var objResponse	= JSON.decode(responseText);

				var foundExist	= false;

				if (objResponse && $defined(objResponse.result)) {
					foundExist	= 'exist' == objResponse.result;
				}

				// 找到已经存在的项目
				if (foundExist) {

				//	alert('exist');
					this.renderExistItem(objResponse);

					var objSubmitButton		= $('id_form_submit');
					objSubmitButton.value		= '保存';
					objSubmitButton.disabled	= false;

				} else {

					this._formValid	= true;

					if (this._objForm) {
						this._objForm.submit();
					}

				}

			},

	renderExistItem:	function(objResult) {

					var objForm	= $(this._existFormId);

				//	var arrFields	= ['title', 'url', 'tag', 'category', 'detail'];
					var arrFields	= ['title', 'url', 'tag', 'detail'];

					arrFields.each(function(form_key) {

								objForm[form_key].value		= objResult[form_key];

							});

					var arrPrivate	= objForm.getElements('div.private');
					arrPrivate.each(function(objDiv) {objDiv.setStyle('display', 'none')});

					var thisPrivateId	= 'id_exist_private_' + objResult['is_private'];
					$(thisPrivateId).setStyle('display', '');


					$(this._existDivId).setStyle('display', '');

				}

});

var ToggleOne	= new Class({

	_arrButton:		[],
	_arrContent:		[],

	initialize:	function() {

			},

	bind:	function(arrBtn) {

		var __THIS__	= this;

	//	alert(arrBtn);

		// Each
		arrBtn.each(function(obj) {

			/*
				obj['clk']:	id of element which to be clicked
				obj['cnt']:	id of content
			*/

			var btn		= $(obj['clk']);

			if (btn) {

				__THIS__._arrButton.push(obj);

				// bind func
				btn.addEvent('click', function() {

					var contentId	= obj.cnt;

					// each Click
					__THIS__._arrButton.each(function(btnObj) {

							var contentObj	= $(btnObj.cnt);

							if (contentObj) {

								if (contentId == btnObj.cnt) {

									contentObj.setStyle('display', '');

								} else {

									contentObj.setStyle('display', 'none');
								}

							}



						});	// end of Click



				});	// end of bind func
			}

		});	// end of Each

	}	// end of method

});



var SofavTagRename	= new Class({

	_objForm:			null,
	_strButtonClass:		'',
	_arrButtons:			[],

	initialize:	function(property) {

				if ($defined(property['form_id'])) {
					this._objForm		= $(property['form_id']);
				} else {
					return;
				}

				var __THIS__	= this;

				// 初始化样式表
				__THIS__._strButtonClass		= $defined(property['btn_class']) ?
										property['btn_class'] : 'tag_rn_btn';

				__THIS__._arrButtons			= this._objForm.getElements('a.' + __THIS__._strButtonClass);

				__THIS__._arrButtons.each(function(one) {

					one.addEvent('click', function() {

						var objTR		= this.getParent().getParent();

						var objTagLink		= objTR.getElement('a');

						var intTagId		= objTagLink.id.match(/(\d+)/)[1];
						var strTagName		= objTagLink.innerHTML;

						objTagLink.getParent().grab(__THIS__.getRenameForm(intTagId, strTagName, objTagLink));


					});

				});



			},

	getRenameForm:	function(intTagId, strTagName, objLink) {

		$$('div.tag_rename_box').each(function(one) {
			one.destroy();
		});

		var elText		= new Element('input', {
								'type':		'text',
								'value':	strTagName
							});

		var elButton		= new Element('input', {
								'type':		'button',
								'value':	'保存'
							});

		var elCancel		= new Element('a', {
								'href':		'javascript:;',
								'html':		'取消'
							});

		var elMsg		= new Element('span', {
								'class':	'inline_error'
							});

		var elBox		= new Element('div', {
								'class':	'tag_rename_box'
							});


		elBox.grab(elText);
		elBox.grab(elButton);
		elBox.grab(elCancel);
		elBox.grab(elMsg);

		elCancel.addEvent('click', function() {
				elBox.destroy();
			});

		elButton.addEvent('click', function() {

				elMsg.set('html', '');

				var strName	= elText.value.trim();

				if (!strName.length) {
					elMsg.set('html', '标签不能为空');
					return false;
				}

				elButton.set('value', '保存中...');
				elButton.disabled	= true;

				var myRequest	= new Request({
							method:		'post',
							url:		runMode + '/tag/rename',
							data:		{'id':intTagId, 'name':strName},
							onSuccess:	function(responseText) {

								//	alert(responseText);
								//	return;

									var objResponse	= JSON.decode(responseText);

									if (objResponse && $defined(objResponse.result)
											&& 'rename_success' == objResponse.result) {

										elMsg.set('html', '保存成功');
										objLink.set('html', strName);

										(function() {
											elBox.destroy();
										}).delay(2000);

									} else {

										elMsg.set('html', '保存失败');
										elButton.set('value', '保存');
										elButton.disabled	= false;

									}



								}.bind(this)
						});

				myRequest.send();

			});

		return	elBox;

	},

	hasCheckedItem:	function() {
		return	this._arrButtons.some(function(one) {return one.checked;});
	}

});





