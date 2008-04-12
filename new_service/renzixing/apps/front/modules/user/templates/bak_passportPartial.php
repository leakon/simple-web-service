
<p>

<?php if ($sf_user->getId()) : ?>
<?php echo $sf_user->getUsername() ?> | <?php echo link_to('Manage', 'user/manage') ?> | <?php echo link_to('Logout', 'user/logout') ?>
<?php else : ?>
Guest | <?php echo link_to('Login', 'user/login') ?> | <?php echo link_to('SignUp', 'user/create') ?>
<?php endif ?>
 | <?php echo link_to('Secure', 'user/secure') ?> | <?php echo $GLOBALS['status_codes_glb'] ?>

</p>



<div id="user_info"><p>ฤ๚บร, <a href="profile.php"><?php echo link_to($sf_user->getUsername(), 'user/manage') ?></a>! | <a href="#" title="Log Out">Log Out</a> | <a href="#">Help</a> | <a href="#">Forums</a></p></div>