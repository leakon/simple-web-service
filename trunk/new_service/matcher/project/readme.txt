服务器部署差异：

CheckPoint

*** Apache 支持 ReWrite


*** Apache 开启对 .htaccess 文件的支持


*** project/web/admin -> project/web/matcher_admin


*** .htaccess 文件中： RewriteBase /admin/


*** 后台首页应打开 /admin/index.php


*** 添加摄影包型号的时候，不仅要修改 MatcherConstant::getVolumeType() ，还要修改 data_model 增加字段

<1>
ALTER TABLE  `data_model` ADD  `ext_vol_danfan` INT( 11 ) NOT NULL DEFAULT  '0' AFTER  `ext_vol_stand` ,
ADD  `ext_vol_wybj` INT( 11 ) NOT NULL DEFAULT  '0' AFTER  `ext_vol_danfan`;

<2> 还要修改 sf_table_data_model.class.php
