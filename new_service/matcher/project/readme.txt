������������죺

CheckPoint

*** Apache ֧�� ReWrite


*** Apache ������ .htaccess �ļ���֧��


*** project/web/admin -> project/web/matcher_admin


*** .htaccess �ļ��У� RewriteBase /admin/


*** ��̨��ҳӦ�� /admin/index.php


*** �����Ӱ���ͺŵ�ʱ�򣬲���Ҫ�޸� MatcherConstant::getVolumeType() ����Ҫ�޸� data_model �����ֶ�

<1>
ALTER TABLE  `data_model` ADD  `ext_vol_danfan` INT( 11 ) NOT NULL DEFAULT  '0' AFTER  `ext_vol_stand` ,
ADD  `ext_vol_wybj` INT( 11 ) NOT NULL DEFAULT  '0' AFTER  `ext_vol_danfan`;

<2> ��Ҫ�޸� sf_table_data_model.class.php
