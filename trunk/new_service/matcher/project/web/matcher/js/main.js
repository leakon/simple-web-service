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



var MatcherSelect	= new Class({

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














