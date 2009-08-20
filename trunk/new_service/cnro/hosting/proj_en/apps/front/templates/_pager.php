


<?php if ($pager->haveToPaginate()): ?>
<?php
	$navLength = 10;
	$firstPosition = ceil(($navLength + 1) * 0.5);
//	$lastPosition = floor(($navLength - 1) * 0.5) + 1;
	$lastPosition = $navLength + 1 - $firstPosition;
//	$pageToken = $pager->getLastPage() > $navLength;	// 总页数是否大于分页条的长度？
	$pageToken = 1;
?>


<div class="pageBar">


	<div id="pagerLink" >

  <?php
  	// first
  	if ($pager->getPage() > $firstPosition && $pageToken) {
  		echo	sprintf('<a href="%s%s">第一页</a>', $pageUri, 'page=1');
  	}
  ?>

  <?php
  	// previous
  	if ($pager->getPage() > 1) {
  		echo	sprintf('<a href="%s%s">上一页</a>', $pageUri,'page=' . $pager->getPreviousPage());

  	}
  ?>

  <?php foreach ($pager->getLinks($navLength) as $page): ?>
    <?php
    	if ($page == $pager->getPage()) {
    		echo	sprintf('<a href="%s%s" class="current">[%s]</a>', $pageUri, 'page=' . $page, $page);
    	} else {
    		echo	sprintf('<a href="%s%s">[%s]</a>', $pageUri, 'page=' . $page, $page);
    	}
    ?>
  <?php endforeach; ?>

  <?php
  	// next
  	if ($pager->getPage() < $pager->getLastPage()) {
  		echo	sprintf('<a href="%s%s">下一页</a>', $pageUri, 'page=' . $pager->getNextPage());
  	}
  ?>

  <?php
  	// last
  	if ($pager->getPage() <= ($pager->getLastPage() - $lastPosition) && $pageToken) {
  		echo	sprintf('<a href="%s%s">最后一页</a>', $pageUri, 'page=' . $pager->getLastPage());
  	}
  ?>

	</div>


</div>

<?php endif ?>
