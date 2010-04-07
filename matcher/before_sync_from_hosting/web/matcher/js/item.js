
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


