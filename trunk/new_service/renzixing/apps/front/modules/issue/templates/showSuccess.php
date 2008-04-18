<?php use_helper('Object') ?>

<div class="wrap">

<h2>详细信息</h2>

<?php


foreach (IssuePeer::listAllTypes() as $intType => $strType) {

	if ($allIssues->offsetExists($strType)) {

		$issue	= $allIssues->getRaw($strType);

		if ($issue->isShowable()) {

			$partialName	= sprintf("issue/issueShow%s", $strType);

			include_partial($partialName, array('issue' => $issue, 'userName' => $allUsers[$issue->getUserId()]));

		} else {

			break;
		}

	} else {
		// 当前级别不存在，则后续级别就不再显示
		break;
	}
}


?>
</div>