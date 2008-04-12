<?php if (0) : ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>


</head>
<body>

<?php include_partial('user/passportPartial') ?>

<?php echo $sf_data->getRaw('sf_content') ?>

</body>
</html>


<?php endif ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>

<link rel="shortcut icon" href="/favicon.ico" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/global.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/wp-admin.css" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/colors-fresh.css" />

<link rel="stylesheet" type="text/css" media="screen" href="/css/main.css" />

<!--[if gte IE 6]>
<link rel="stylesheet" href="/css/ie.css" type="text/css" />
<![endif]-->
<script type="text/javascript">
//<![CDATA[
addLoadEvent = function(func) {if (typeof jQuery != "undefined") jQuery(document).ready(func); else if (typeof wpOnload!='function'){wpOnload=func;} else {var oldonload=wpOnload; wpOnload=function(){oldonload();func();}}};
//]]>
</script>
<style type="text/css">* html { overflow-x: hidden; }</style>
<style type='text/css' media='all'>
	@import '/css/thickbox.css?1';
	div#TB_title {
		background-color: #222222;
		color: #cfcfcf;
	}
	div#TB_title a, div#TB_title a:visited {
		color: #cfcfcf;
	}
</style>

</head>
<body class="wp-admin ">



<?php /* echo $sf_data->getRaw('sf_content') */ ?>


<div id="wpwrap">
<div id="wpcontent">
	<div id="wphead">&nbsp;</div>

<?php include_partial('user/passportPartial') ?>


<ul id="dashmenu">

	<li><strong><a href="#">任子行客服系统</a></strong></li></ul>

<ul id="adminmenu">
	<li><a href='edit.php'>Manage</a></li>
	<li><a href='edit-comments.php' class="current">Comments <span id='awaiting-mod' class='count-0'><span class='comment-count'>0</span></span></a></li></ul>

<?php if (0) : ?>
<ul id="sidemenu">

	<li><a href='options-general.php'>Settings</a> </li>
	<li><a href='plugins.php'>Plugins</a> </li>
	<li><a href='users.php'>Users</a></li></ul>
<?php endif ?>


<ul id="submenu">

	<li><a href='edit-comments.php' class="current">Comments</a></li>
</ul>




<div id="wpbody">


<?php if (0) : ?>


<div class="wrap">
<form id="posts-filter" action="" method="get">
<h2>Manage Comments</h2>

<ul class="subsubsub">
<li><a href="edit-comments.php" class="current">Show All Comments</a> | </li><li><a href="edit-comments.php?comment_status=moderated">Awaiting Moderation (<span class='comment-count'>0</span>)</a> | </li><li><a href="edit-comments.php?comment_status=approved">Approved</a></li></ul>

<p id="post-search">
	<input type="text" id="post-search-input" name="s" value="" />
	<input type="submit" value="Search Comments" class="button" />
</p>

<input type="hidden" name="mode" value="detail" />
<input type="hidden" name="comment_status" value="" />
</form>

<ul class="view-switch">
	<li class='current'><a href="/wp-admin/edit-comments.php?mode=detail">Detail View</a></li>
	<li ><a href="/wp-admin/edit-comments.php?mode=list">List View</a></li>

</ul>


<form id="comments-form" action="" method="post">

<div class="tablenav">


<div class="alignleft">
<input type="submit" value="Approve" name="approveit" class="button-secondary" />
<input type="submit" value="Mark as Spam" name="spamit" class="button-secondary" />
<input type="submit" value="Unapprove" name="unapproveit" class="button-secondary" />
<input type="submit" value="Delete" name="deleteit" class="button-secondary delete" />
<input type="hidden" id="_wpnonce" name="_wpnonce" value="c9b01359b9" /><input type="hidden" name="_wp_http_referer" value="/wp-admin/edit-comments.php" /></div>

<br class="clear" />

</div>

<br class="clear" />
<table class="widefat">
<thead>
  <tr>
    <th scope="col" class="check-column"><input type="checkbox" onclick="checkAll(document.getElementById('comments-form'));" /></th>
    <th scope="col">Comment</th>
    <th scope="col">Date</th>
    <th scope="col" class="action-links">Actions</th>

  </tr>
</thead>
<tbody id="the-comment-list" class="list:comment">
  <tr id="comment-1" class=''>
    <td class="check-column"><input type="checkbox" name="delete_comments[]" value="1" /></td>
    <td class="comment">
    <p class="comment-author"><strong><a class='row-title' href='comment.php?action=editcomment&amp;c=1' title='Edit comment'> Mr WordPress</a></strong><br />
        <a href="http://wordpress.org/">http://wordpress.org/</a> |
                <a href="edit-comments.php?s=&amp;mode=detail"></a>


    </p>
   	<p>Hi, this is a comment.<br />To delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.</p>
   	<p>From <a href='http://wp25.leakon.com/?p=1#comment-1'>Hello world!</a>, 2008/03/31 at 4:43 PM</p>
    </td>
    <td>2008/03/31</td>

    <td class="action-links">
<span class='approve'><a href='comment.php?action=approvecomment&#038;p=1&#038;c=1&#038;_wpnonce=669e5674ee' class='dim:the-comment-list:comment-1:unapproved:e7e7d3:e7e7d3' title='Approve this comment'>Approve</a> | </span><span class='unapprove'><a href='comment.php?action=unapprovecomment&#038;p=1&#038;c=1&#038;_wpnonce=aec3a18f05' class='dim:the-comment-list:comment-1:unapproved:e7e7d3:e7e7d3' title='Unapprove this comment'>Unapprove</a> | </span><span class='spam'><a href='comment.php?action=deletecomment&#038;dt=spam&#038;p=1&#038;c=1&#038;_wpnonce=54a28936fa' class='delete:the-comment-list:comment-1::spam=1' title='Mark this comment as spam'>Spam</a> | </span><span class='delete'><a href='comment.php?action=deletecomment&#038;p=1&#038;c=1&#038;_wpnonce=54a28936fa' class='delete:the-comment-list:comment-1 delete'>Delete</a></span>	</td>
  </tr>
	</tbody>

<tbody id="the-extra-comment-list" class="list:comment" style="display: none;">
</tbody>
</table>

</form>

<form id="get-extra-comments" method="post" action="" class="add:the-extra-comment-list:" style="display: none;">
	<input type="hidden" name="s" value="" />
	<input type="hidden" name="mode" value="detail" />
	<input type="hidden" name="comment_status" value="" />
	<input type="hidden" name="page" value="1" />
	<input type="hidden" id="_ajax_nonce" name="_ajax_nonce" value="7298cd8bc9" /></form>

<div id="ajax-response"></div>
<div class="tablenav">
<br class="clear" />
</div>

</div>

<?php endif ?>

<?php echo $sf_data->getRaw('sf_content') ?>


</div><!-- wpbody -->
</div><!-- wpcontent -->
</div><!-- wpwrap -->
<div id="footer">
<p>Thank you for creating with <a href="http://wordpress.org/">WordPress</a> | <a href="http://codex.wordpress.org/">Documentation</a> | <a href="http://wordpress.org/support/forum/4">Feedback</a> | Version 2.5</p>

</div>
<script type="text/javascript">if(typeof wpOnload=='function')wpOnload();</script>
</body>
</html>
