<?php

/**
 * Template of [tag/listSuccess]
 *
 */

#var_dump($type);
#var_dump($strModuleName);

?>

<div class="contentBox">

	<div class="boxHeader">

		<h3>修改<?php echo $brandName ?> - <?php echo S::E($dataItem->username) ?></h3>

		<div class="">

			<form name="theForm" id="id_tag_edit" action="<?php echo url_for($strModuleName . '/saveProfile') ?>" method="post">
			<input type="hidden" name="from" value="edit" />
			<input type="hidden" name="id" value="<?php echo $dataItem->id ?>" />
			<input type="hidden" name="refer" value="<?php echo $sf_request->getUri() ?>" />

			<table>
			<tr>
				<td>姓名</td>
				<td>
					<input type="text" id="id_add_input_style" name="username" value="<?php echo S::E($dataItem->username) ?>" />
				</td>
			</tr>
			<tr>
				<td>密码</td>
				<td>
					<?php if ($sf_request->hasError('password')): ?>
					<span class="form_error"><?php echo $sf_request->getError('password') ?></span>
					<?php endif; ?>
					<input type="password" id="id_add_input_link" name="password" value="" />
				</td>
			</tr>
			<tr>
				<td>确认密码</td>
				<td>
					<?php if ($sf_request->hasError('confirm')): ?>
					<span class="form_error"><?php echo $sf_request->getError('confirm') ?></span>
					<?php endif; ?>
					<input type="password" id="id_add_input_link" name="confirm" value="" />
				</td>
			</tr>
			<tr>
				<td>问题</td>
				<td>
					<input type="text" id="id_add_input_link" name="question" value="<?php echo S::E($dataItem->question) ?>" />
				</td>
			</tr>
			<tr>
				<td>答案</td>
				<td>
					<input type="text" id="id_add_input_link" name="answer" value="<?php echo S::E($dataItem->answer) ?>" />
				</td>
			</tr>
			<tr>
				<td>出生日期</td>
				<td>
					<?php

					$date		= substr((string) $dataItem->birthday, 0, 10);
					if ('' == $date) {
						$date	= date('Y-m-d');
					}

					echo input_date_tag('birthday', $date, array('rich' => true, 'readonly' => 'readonly', 'lang' => 'zh_CN'))

					?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" id="id_form_submit" value="保存" class="btn" />

					<a href="<?php echo url_for('user/list') ?>" id="id_clear_add_input">取消</a>
				</td>
			</tr>
			</table>

			</form>

		</div>


	</div>



</div><!-- EndOf contentBox -->



<script type="text/javascript">

$('id_form_submit').disabled	= false;

/*
$('id_clear_add_input').addEvent('click', function() {
	$('id_add_input').set('value', '');
	$('id_tag_exist').set('html', '');
	var objTagError	= $('id_tag_error');
	if (objTagError) {
		objTagError.set('html', '');
	}
});
*/

var objCheckItem	= new SimpleFormCheck({
					'form_id':		'id_tag_list_box',
					'check_toggle':		'id_check_all'
				});


</script>


<?php

#	Debug::pr(SofavDB_Debug_PDO::getTimer());

