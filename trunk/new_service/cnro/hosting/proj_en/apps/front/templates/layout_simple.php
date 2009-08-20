<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include_title() ?>
<style type="text/css">
* { margin: 0; padding: 0; }
body{font:12px "Lucida Grande", Verdana, Arial, "Bitstream Vera Sans", sans-serif; background:#f9f9f9;}
#login{width:100%; height:auto; overflow:hidden; text-align:center;}
#login .topbar{font-size:12px; height:33px; margin:0 0 40px 0; background:url(/images/bg33.png) repeat-x; text-align:left; padding:0 0 0 30px; line-height:33px;}
#login .topbar a{color:#fff; text-decoration:none; font-weight:normal; }
#login h2{width:330px; height:61px; background:url(/images/pic330.png) no-repeat; text-indent:-9999px; margin:0 auto 20px auto;}
#loginform{width:290px; height:170px; background:url(/images/loginBg330x210.png) no-repeat; padding:20px; margin:0 auto;}
#loginform p{margin-bottom:10px; line-height:25px; text-align:left;}
#loginform p label{font-size:14px; color:#5cac25;}
#loginform p label .input{width:270px; height:24px; border:1px solid #ccc; padding:6px 3px 0 3px; }
#loginform p.forgetmenot{display:block; float:left;}
#loginform p.submit{display:block; float:right; width:65px; height:24px;}
#loginform p.submit input{width:65px; height:24px; background:url(/images/loginBtn65x24.gif) no-repeat; border:none; font-size:14px; color:#fff;}

#loginform h3		{font-size:18px; font-weight:bold;}

#loginform span.form_error	{font-size:12px; color:red;}

</style>
</head>

<body>

<div id="login">

    <div class="topbar"><a href="/" title="返回首页">&lt;&lt; 返回首页</a></div>

    <h2></h2>



    <?php echo $sf_content ?>



</div><!-- end login -->




</body>

</html>
