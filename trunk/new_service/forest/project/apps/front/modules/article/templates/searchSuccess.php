<?php

#Debug::pr($arrResult);

#Debug::pr(SofavDB_Debug_PDO::getTimer());

?>
  <div id="sandwich">

    <div class="container">
      <div id="breadCrumb">
        <div class="bcL"></div>

        <?php

        ?>

	<div class="bcM"><a href="/">首页</a> &gt; 搜过关键词 “<?php echo S::E($strKW) ?>” </div>
        <div class="bcR"></div>
      </div><!-- end breadCrumb -->
    </div>




    <div class="container">

        <div class="left">
          <div class="sideAd"><a href="#" target="_blank"><img src="/images/ad220x180.png" width="220" height="180" /></a></div>
          <div class="blank10"></div>
          <div class="sideAd"><a href="#" target="_blank"><img src="/images/ad220x180.png" width="220" height="180" /></a></div>
        </div>

        <div class="right search">

          <div class="top"></div>


<?php if (isset($arrResult) && count($arrResult)) : ?>

          <div class="textBlock">
            <div class="titlebar">搜索关键词 “<?php echo S::E($strKW) ?>”</div>
            <div class="blank10"></div>
            <div class="blank10"></div>

           <ul class="list14">
           	<?php foreach ($arrResult as $key => $val) : ?>
             		<li><a href="<?php echo url_for('article/show?id=' . $val['id']) ?>" target="_blank"><?php echo S::E($val['title']) ?></a></li>
           	<?php endforeach ?>
           </ul>

           <div class="blank10"></div>
           <div class="blank10"></div>

		<?php

		$uri	= $pager->getPageUri();
		$action	= $sf_context->getActionName();

		include_partial('global/pager', array('pager' => $pager, 'pageUri' => $uri));

		?>

          </div>
          <!-- end textBlock -->

<?php else : ?>


          <div class="textBlock">

          	没有与关键词 “<?php echo S::E($strKW) ?>” 有关的搜索结果。

          </div>
          <!-- end textBlock -->

<?php endif ?>







          <div class="bot"></div>
        </div>





    </div><!-- end container -->
    <div class="blank10"></div>





  </div><!-- end sandwich -->