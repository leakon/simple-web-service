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


<del class="container">

<div class="pagination">
<?php

	$strLink	= '';

	// previous
	if ($pageNavigation->getPage() > 1) {
		$strLink	.= sprintf('<div class="button2-right off"><div class="prev"><a href="%s">Prev</a></div></div>',
						url_for($pageUri.'page='.$pageNavigation->getPreviousPage()) );
	}
	// first
	if ($pageNavigation->getPage() > $firstPosition && $pageToken) {
		$strLink	.= link_to('1', $pageUri.'page=1');
	}

	$strLink	.= '<div class="button2-left"><div class="page">';

	foreach ($pageNavigation->getLinks($navLength) as $page):

	if ($page == $pageNavigation->getPage()) {
		$strLink	.= "<span>$page</span>";
	} else {
		$strLink	.= link_to($page, $pageUri.'page='.$page);
	}

	 endforeach;

	 $strLink	.= '</div></div>';



	// last
	if ($pageNavigation->getPage() <= ($pageNavigation->getLastPage() - $lastPosition) && $pageToken) {
		$strLink	.= link_to($pageNavigation->getLastPage(), $pageUri.'page='.$pageNavigation->getLastPage());
	}

	// next
	if ($pageNavigation->getPage() < $pageNavigation->getLastPage()) {
		$strLink	.= sprintf('<div class="button2-left"><div class="next"><a href="%s">Next</a></div></div>',
						url_for($pageUri.'page='.$pageNavigation->getNextPage()) );
	}

	echo	$strLink;

?>

</div>
</del>
<?php endif; ?>





