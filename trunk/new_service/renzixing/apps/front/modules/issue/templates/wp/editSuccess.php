<?php use_helper('Validation') ?>
<?php use_helper('Object') ?>

<?php echo form_tag('issue/update', array('id' => 'the_form', 'multipart' => true)) ?>

<div class="wrap">

<h2>详细信息</h2>


<?php

$userId		= $sf_user->getId();

$actionName	= $sf_context->getActionName();

if ('create' == $actionName) {

	include_partial('issue/issueEditAgency', array('issue' => $issue));

} else {

	// 编辑当前进度时，跳过后面的上级进度
	$needBreak	= false;

	foreach (IssuePeer::listAllTypes() as $intType => $strType) {

		if ($allIssues->offsetExists($strType)) {

			$issue	= $allIssues->getRaw($strType);

			if ($issue->isEditable() && $userId == $issue->getUserId()) {

				$partialMethod	= 'Edit';
				$needBreak	= true;

			#	echo	sprintf('<input type="hidden" name="type" value="%s" />', $issue->getType());

			} else {

				$partialMethod	= 'Show';
			}

			$partialName	= sprintf("issue/issue%s%s", $partialMethod, $strType);

			include_partial($partialName, array('issue' => $issue, 'userName' => $allUsers[$issue->getUserId()]));

			if ($needBreak) {
			#	echo	33;
				break;
			}

		} else {
			// 当前级别不存在，则后续级别就不再显示
			break;
		}


	}


}




?>

</div>

</form>
