<?php if ('joomla') : ?>
您好 <a href="profile.php"><?php echo link_to($sf_user->getUsername(), 'user/manage') ?></a> | <?php echo link_to('设置', 'user/manage') ?> | <?php echo link_to('退出', 'user/logout') ?>
<?php else : ?>
<div id="user_info"><p>您好 <a href="profile.php"><?php echo link_to($sf_user->getUsername(), 'user/manage') ?></a> | <?php echo link_to('设置', 'user/manage') ?> | <?php echo link_to('退出', 'user/logout') ?></p></div>
<?php endif ?>