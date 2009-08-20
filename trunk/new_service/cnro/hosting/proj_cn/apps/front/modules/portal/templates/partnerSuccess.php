
        <div class="breadCrumb">
            <a href="<?php echo url_for('@homepage') ?>">首页</a> > <a href="<?php echo url_for('portal/partner') ?>">商务合作</a> > <a href="<?php echo url_for('portal/partner') ?>">合作伙伴</a>
          </div><!-- end breadCrumb -->

        <div class="content944">
          <div class="sideNav">
            <h3>商务合作</h3>
            <ul>
              <li class="current"><a href="<?php echo url_for('portal/partner') ?>">合作伙伴</a></li>
              <li><a href="<?php echo url_for('portal/contact') ?>">联系我们</a></li>

            </ul>
          </div><!-- end sideNav -->


          <div class="rightC">
<?php


$objConf	= new Custom_Conf();

$arrConf_Block	= $objConf->getConf('block');

#Debug::pr($arrConf_Block);

echo	isset($arrConf_Block['cooperate']) ? $arrConf_Block['cooperate'] : '';


?>

          </div>

        </div><!-- end content944 -->