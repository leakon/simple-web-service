<?php if ($pageNavigation->haveToPaginate()): ?>
<?php
	$navLength = 9;
	$firstPosition = ceil(($navLength + 1) * 0.5);
//	$lastPosition = floor(($navLength - 1) * 0.5) + 1;
	$lastPosition = $navLength + 1 - $firstPosition;
	$pageToken = $pageNavigation->getLastPage() > $navLength;	// 总页数是否大于分页条的长度？

	// Output escaping settings
	$pageUri = $sf_data->getRaw('pageUri');
#	var_dump($pageUri);

?>

<div class="tablenav">
	<div class='tablenav-pages'>
<?php

	$strLink	= '';

	// previous
	if ($pageNavigation->getPage() > 1) {
		$strLink	.= link_to('&laquo; 上一页', $pageUri.'page='.$pageNavigation->getPreviousPage(), array('class' => 'prev page-numbers'));
	}
	// first
	if ($pageNavigation->getPage() > $firstPosition && $pageToken) {
		$strLink	.= link_to('1', $pageUri.'page=1', array('class' => 'page-numbers'));
	}

	foreach ($pageNavigation->getLinks($navLength) as $page):

	if ($page == $pageNavigation->getPage()) {
		$strLink	.= "<span class='page-numbers current'>$page</span>";
	} else {
		$strLink	.= link_to($page, $pageUri.'page='.$page, array('class' => 'page-numbers'));
	}

	 endforeach;


	// last
	if ($pageNavigation->getPage() <= ($pageNavigation->getLastPage() - $lastPosition) && $pageToken) {
		$strLink	.= link_to($pageNavigation->getLastPage(), $pageUri.'page='.$pageNavigation->getLastPage(), array('class' => 'page-numbers'));
	}

	// next
	if ($pageNavigation->getPage() < $pageNavigation->getLastPage()) {
		$strLink	.= link_to('下一页 &raquo;', $pageUri.'page='.$pageNavigation->getNextPage(), array('class' => 'next page-numbers'));
	}

	echo	$strLink;

?>
	<br class="clear" />
	</div>
<br class="clear" />
</div>
<?php endif; ?>