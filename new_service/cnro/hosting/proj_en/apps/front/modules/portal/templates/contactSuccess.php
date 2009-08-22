


    <div id="content2">



      <div class="sideNav">
        <ul>
          <li class="current"><a href="<?php echo url_for_2('portal/contact') ?>">Contact us</a></li>

        </ul>

      </div><!-- end sideNav -->

      <div class="right">
        <div class="banner590"><img src="/en/images/banner590x180_contact.jpg" width="590" height="180" alt="contact us" /></div>
        <div class="blank20"></div>

        <div class="blockD">
          <h3>Contact us</h3>
          <p>

<?php


	$objConf		= new Custom_Conf();

	$arrConf_PASS		= $objConf->getConf('password');
	if (!isset($arrConf_PASS['password'])) {
		$objConf->setConf('password', array('password' => 'admin'));
	}


	$arrDataConf		= $objConf->getConf();

	echo	isset($arrDataConf['block']['contacts']) ? $arrDataConf['block']['contacts'] : '';
?>
          </p>




          <span class="mailto"><img src="images/envolope.gif" width="13" height="9" alt="email us" /> <a href="mailto:">E-mail us</a></span>

          <h4>We appreciate your comments and questions.</h4>

		<?php if ($strResult = $sf_request->getParameter('result', '')) : ?>
                <div style="color:red">

                	<?php

                	if ('success' == $strResult) {
                		echo	'Submit success!';
                	}
                	if ('code_error' == $strResult) {
                		echo	'Please enter correct verify code!';
                	}

                	?>

                </div>
		<?php endif ?>

<style>
.text_input	{border:1px solid #BFBFBF; height:18px; width:225px;}
</style>

<form action="<?php echo url_for_2('portal/saveMessage') ?>" method="post">

          <ul>
		<li>
			<label id="contact_subject_label" for="contact_subject">Subject</label>
			<input id="contact_subject" name="title" type="text" class="text_input" />
		</li>

		<li>
			<label for="contact_email" id="email_label">Email</label>
			<input name="mail" id="contact_email" value="" type="text" />
		</li>

		<li>
			<label for="contact_gender" id="gender_label">Gender</label>
			<select name="gender">
				<option value="0">Mr.</option>
				<option value="1">Ms.</option>
			</select>
		</li>

		<li>
			<label for="contact_location" id="location_label">Location</label>
			<input id="contact_location" name="location" type="text" class="text_input" />
		</li>

		<li>
			<label for="contact_phone" id="phone_label">Phone</label>
			<input id="contact_phone" name="phone" type="text" class="text_input" />
		</li>

		<li>
			<label id="contact_comments_label" for="contact_comments">Comments or Questions</label>
			<textarea id="contact_comments" name="message"></textarea>
		</li>

		<li>
			<label for="contact_veryfy" id="veryfy_label">Verify code</label>
			<input name="verify_code" type="text" class="verify" style="vertical-align:middle;" />

			<span class="verify_pic"><img src="" id="id_verify_code" style="border:1px solid black; vertical-align:middle" /></span>
				<script>
				var img_src	= '/verification_code/show_verification_code.php?r=' + Math.random();
				document.getElementById('id_verify_code').src	= img_src;
				</script>
		</li>

		<li><input type="submit" class="btn59" value=""></li>

          </ul>

</form>

        </div><!-- end blockD -->


      </div><!-- end right -->





    </div><!-- end content -->




