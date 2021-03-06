
<div class="wrap">

<form id="posts-filter" action="<?php echo url_for("issue/search") ?>" method="get">

<p id="post-search">

	<?php if (1 && 'search' == $sf_context->getActionName() && $objPager->getNbResults()) : ?>

		<span class="searchResult">
		找到 <strong><?php echo $objPager->getNbResults() ?></strong> 条结果
		以下是第 <strong><?php echo $objPager->getCurrentStart() ?> - <?php echo $objPager->getCurrentCount() ?></strong> 项
		</span>

	<?php endif ?>

	<input type="text" id="post-search-input" name="keyword" value="<?php echo $sf_request->getParameter('keyword', '') ?>" />
	<input type="submit" value="搜索" class="button" />
</p>



			<table class="adminlist" cellspacing="1">
			<thead>
			<tr>

				<th class="title">日期</th>
				<th nowrap="nowrap">标题</th>
				<th nowrap="nowrap">提交人</th>
				<th nowrap="nowrap">优先级</th>
				<th nowrap="nowrap">状态</th>
				<th nowrap="nowrap">操作</th>

			</tr>
			</thead>
			<tfoot>
			<tr>
				<td colspan="12">



<?php

$action		= $sf_context->getActionName();

// 如果是 search ，并且是有效的关键词
$isValidSearch	= 'search' == $action && strlen($keyword = $sf_request->getParameter('keyword', ''));

#var_dump($isValidSearch);

$pageUri	= sprintf(  "issue/%s?%s", $action, ($isValidSearch ? 'keyword=' . urlencode($keyword) . '&' : '')  );

#var_dump($pageUri);

echo include_partial('global/pageNavigationJoomla',
				array(
					'pageNavigation' => $objPager,
					'pageUri' => $pageUri
				)
			) ?>


				</td>
			</tr>
			</tfoot>
			<tbody>



<?php if ($objPager->getNbResults()) : ?>

<?php


$myUserId		= $sf_user->getId();

?>



<?php $idx = 0 ?>
<?php foreach ($objPager->getResults() as $issue): ?>
<tr class="row<?php echo $idx = abs($idx--) ?>">


	<td><?php echo substr($issue['created_at'], 0, 10) ?></td>
	<td><strong>
	<a class="row-title" href="<?php echo url_for('issue/show?id=' . $issue['id']) ?>" title="<?php echo $issue['title'] ?>"><?php echo mb_strimwidth($issue['title'], 0, sfConfig::get('app_issue_list_title_length'), '...', 'UTF-8') ?></a>
	</strong></td>
	<td><a href="#" <?php if ($issue['user_id'] == $myUserId): ?>class="mySelf"<?php endif ?>><?php echo $issue['username'] ?></a></td>


	<td>
		<?php echo IssuePeer::getPriorityString($issue['priority']) ?> &nbsp;
	</td>
	<td>
		<?php echo $issue['progress'] ?> &nbsp;
	</td>
	<td>
		<?php

			$arrAction	= array(
				'show'		=> sprintf('<a href="%s">查看</a>', url_for('issue/show?id=' . $issue['id'])),
				'edit'		=> sprintf('<a href="%s" class="myInvolved">编辑</a>', url_for('issue/edit?id=' . $issue['id'])),
				'deal'		=> sprintf('<a href="%s" class="dealIssue">处理</a>', url_for('issue/deal?id=' . $issue['id'])),
					);

			$operation	= '';

			foreach (IssuePeer::getAllowedAction($issue) as $action => $intAllowed) {

				if ($intAllowed) {
					$operation	= $arrAction[$action];
				}

			}

			echo	$operation;

		?>&nbsp;

	</td>


</tr>
<?php endforeach; ?>

<?php else : ?>


<tr id="post-0" class="alternate author-self status-publish" valign="top">
	<td colspan="4">
		<span class="searchResult">没有找到匹配的项目！ </span>
	</td>
</tr>

<?php endif ?>



							</tbody>
			</table>


</form>

</div>