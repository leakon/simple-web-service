
        <div class="breadCrumb">
            <a href="<?php echo url_for('@homepage') ?>">首页</a> > <a href="<?php echo url_for('portal/partner') ?>">商务合作</a> > <a href="<?php echo url_for('portal/partner') ?>">合作伙伴</a>
          </div><!-- end breadCrumb -->

        <div class="content944">
          <div class="sideNav">
            <h3>商务合作</h3>
            <ul>
              <li><a href="<?php echo url_for('portal/partner') ?>">合作伙伴</a></li>
              <li class="current"><a href="<?php echo url_for('portal/contact') ?>">联系我们</a></li>

            </ul>
          </div><!-- end sideNav -->


          <div class="rightC">

            <div class="l495">


              <form action="<?php echo url_for('portal/saveMessage') ?>" method="post">

		<?php if ($strResult = $sf_request->getParameter('result', '')) : ?>

              <dl>
                <dt>&nbsp;</dt>
                <dd style="color:red">

                	<?php

                	if ('success' == $strResult) {
                		echo	'留言成功';
                	}
                	if ('code_error' == $strResult) {
                		echo	'请输入正确的验证码';
                	}

                	?>

                </dd>
              </dl>

		<?php endif ?>



              <dl>
                <dt>姓 名：</dt>
                <dd>
                  <input name="name" type="text" />
                  <select name="gender">
                    <option value="0">先生</option>
                    <option value="1">小姐</option>
                  </select>
                </dd>
              </dl>
              <dl>
                <dt>所在地区：</dt>
                <dd>
                  <input name="location" type="text" />

                </dd>
              </dl>
              <dl>
                <dt>电子邮件：</dt>
                <dd>
                  <input name="mail" type="text" />

                </dd>
              </dl>
              <dl>
                <dt>联系电话：</dt>
                <dd>
                  <input name="phone" type="text" />

                </dd>
              </dl>
              <dl>
                <dt>留言主题：</dt>
                <dd>
                  <input name="title" type="text" />

                </dd>
              </dl>
              <dl>
                <dt>您的留言：</dt>
                <dd>
                 <textarea name="message" cols="" rows=""></textarea>
                </dd>
              </dl>
              <dl>
                <dt>验证码：</dt>
                <dd>
                 <input name="verify_code" type="text" class="verify" /><span class="verify_pic"><img src="" id="id_verify_code" style="border:1px solid black;" /></span>
                 <script>
                 	var img_src	= '/verification_code/show_verification_code.php?r=' + Math.random();
                 	document.getElementById('id_verify_code').src	= img_src;
                 	</script>
                </dd>
              </dl>

              <span><input type="submit" value="" class="btn55"/></span>
              </form>

            </div>

            <div class="r240">
              <h3>天津市森罗科技发展有限责任公司</h3>
              <p>地址：天津市北辰区津围公路东.<br />
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    北辰科技园内 高新大道66号</p>
              <p>电话：022-86996101 86996102</p>
              <p>传真：022-86996100</p>
              <p>E-mail: <a href="#" target="_blank" >contactus@cnrotech.com</a></p>
            </div>





          </div>

        </div><!-- end content944 -->




