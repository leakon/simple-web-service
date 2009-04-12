
<?php

	Custom_Homepage::setDataConf($arrDataConf);

#	Debug::pr($arrDataConf);

#	$res		= Table_articles::getByCategory(1000016);

#	Debug::pr(SofavDB_Debug_PDO::getTimer());



#	Debug::pr($res);

	$arrPartial	= array(
				'conf'			=> $arrDataConf,
				'data'			=> $arrDataRes,
				'default'		=> $defaultCategoryId,
				'from'			=> '',
			);


?>


  <div id="sandwich">

    <div class="container">
      <div class="blank10"></div>
      <div id="left660">

        <div id="focusBox">
          <div class="l"></div>
          <div class="m">
            <div id="fb">
              <script type=text/javascript>
var pic_width=290; //图片宽度
var pic_height=160; //图片高度
var button_pos=4; //按扭位置 1左 2右 3上 4下
var stop_time=3000; //图片停留时间(1000为1秒钟)
var show_text=0; //是否显示文字标签 1显示 0不显示
var txtcolor="000000"; //文字色
var bgcolor="DDDDDD"; //背景色
var imag=new Array();
var link=new Array();
var text=new Array();
imag[1]="/images/01.jpg";
link[1]="http://www.zcool.com.cn/";
text[1]="标题 1";
imag[2]="/images/02.jpg";
link[2]="http://www.zcool.com.cn/";
text[2]="标题 2";
imag[3]="/images/03.jpg";
link[3]="http://www.zcool.com.cn/";
text[3]="标题 3";
imag[4]="/images/04.jpg";
link[4]="http://www.zcool.com.cn/";
text[4]="标题 4";
imag[5]="/images/05.jpg";
link[2]="http://www.zcool.com.cn/";
text[5]="标题 5";
//可编辑内容结束
var swf_height=show_text==1?pic_height+20:pic_height;
var pics="", links="", texts="";
for(var i=1; i<imag.length; i++){
	pics=pics+("|"+imag[i]);
	links=links+("|"+link[i]);
	texts=texts+("|"+text[i]);
}
pics=pics.substring(1);
links=links.substring(1);
texts=texts.substring(1);
document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cabversion=6,0,0,0" width="'+ pic_width +'" height="'+ swf_height +'">');
document.write('<param name="movie" value="/flash/focus.swf">');
document.write('<param name="quality" value="high"><param name="wmode" value="opaque">');
document.write('<param name="FlashVars" value="pics='+pics+'&links='+links+'&texts='+texts+'&pic_width='+pic_width+'&pic_height='+pic_height+'&show_text='+show_text+'&txtcolor='+txtcolor+'&bgcolor='+bgcolor+'&button_pos='+button_pos+'&stop_time='+stop_time+'">');
document.write('<embed src="/flash/focus.swf" FlashVars="pics='+pics+'&links='+links+'&texts='+texts+'&pic_width='+pic_width+'&pic_height='+pic_height+'&show_text='+show_text+'&txtcolor='+txtcolor+'&bgcolor='+bgcolor+'&button_pos='+button_pos+'&stop_time='+stop_time+'" quality="high" width="'+ pic_width +'" height="'+ swf_height +'" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />');
document.write('</object>');
</script>
            </div>

            <div id="fb_l">
              <h3>资讯动态</h3>
              <div class="blank10"></div>
              <ul class="list12">
                <li><a href="#" target="_blank">陈义龙代表：加快发展可再生生物质能源机不可失</a></li>
                <li><a href="#" target="_blank">陈义龙代表：加快发展可再生生物质能源机不可失</a></li>
                <li><a href="#" target="_blank">陈义龙代表：加快发展可再生生物质能源机不可失</a></li>
                <li><a href="#" target="_blank">陈义龙代表：加快发展可再生生物质能源机不可失</a></li>
                <li><a href="#" target="_blank">陈义龙代表：加快发展可再生生物质能源机不可失</a></li>
                <li><a href="#" target="_blank">陈义龙代表：加快发展可再生生物质能源机不可失</a></li>
                <li><a href="#" target="_blank">陈义龙代表：加快发展可再生生物质能源机不可失</a></li>
              </ul>
            </div>

          </div>

          <div class="r"></div>

        </div><!-- end focusBox -->



        <div class="blank10"></div>

        <div class="blockA">

          <h3 id="title660">产业动态<span class="more"><a href="#" target="_blank">更多&gt;&gt;</a></span></h3>

          <div id="box660">

            <div class="pt">
              <div class="l_pic">
                <a href="#" target="_blank"><img src="/images/pic55.png" width="55" height="55" /></a>
                <span>生物柴油</span>
              </div>

              <ul>
                <li><a href="#">“微藻生物柴油成套技术柴油成套....</a></li>
                <li><a href="#">“微藻生物柴油成套技术柴油成套....</a></li>
                <li><a href="#">“微藻生物柴油成套技术柴油成套....</a></li>
                <li><a href="#">“微藻生物柴油成套技术柴油成套....</a></li>
                <li><a href="#">“微藻生物柴油成套技术柴油成套....</a></li>
              </ul>

            </div><!-- end pt -->


            <div class="pt">
              <div class="l_pic">
                <a href="#" target="_blank"><img src="/images/pic55_right.png" width="55" height="55" /></a>
                <span>生物质发电</span>
              </div>

              <ul>
                <li><a href="#">“微藻生物柴油成套技术柴油成套....</a></li>
                <li><a href="#">“微藻生物柴油成套技术柴油成套....</a></li>
                <li><a href="#">“微藻生物柴油成套技术柴油成套....</a></li>
                <li><a href="#">“微藻生物柴油成套技术柴油成套....</a></li>
                <li><a href="#">“微藻生物柴油成套技术柴油成套....</a></li>
              </ul>

            </div><!-- end pt -->

          </div><!-- end box660 -->


        </div><!-- end blockA -->

        <div class="blank10"></div>





        <div class="blockA">

		<?php

			$arrPartial['from']		= 'block_1';
			$arrPartial['pos']		= 'left';
			include_partial('block', $arrPartial);

		?>


		<?php

			$arrPartial['from']		= 'block_2';
			$arrPartial['pos']		= 'right';
			include_partial('block', $arrPartial);

		?>

        </div>

        <div class="blank10"></div>



        <div class="blockA">

		<?php

			$arrPartial['from']		= 'block_3';
			$arrPartial['pos']		= 'left';
			include_partial('block', $arrPartial);

		?>


		<?php

			$arrPartial['from']		= 'block_4';
			$arrPartial['pos']		= 'right';
			include_partial('block', $arrPartial);

		?>

        </div>

        <div class="blank10"></div>



        <div class="blockA">

		<?php

			$arrPartial['from']		= 'block_5';
			$arrPartial['pos']		= 'left';
			include_partial('block', $arrPartial);

		?>


		<?php

			$arrPartial['from']		= 'block_6';
			$arrPartial['pos']		= 'right';
			include_partial('block', $arrPartial);

		?>

        </div>

        <div class="blank10"></div>






      </div><!-- end left660 -->


      <div id="right240">
        <input name="" type="button" class="loginBtn" value="" />

        <div class="blank5"></div>

        <fieldset>
            <legend>搜索本站</legend>
		    <form method="get" id="searchform" action="">
	          <p>
                <label for="s">
                  <input name="s" id="s" size="20" value="" class="input-style" type="text">
                  <input value="" class="submit-style" type="submit">
                </label>
              </p>
            </form>

		</fieldset>



        <div class="block240">
          <h3>能源简报<span class="more"><a href="#" target="_blank">更多&gt;&gt;</a></span></h3>
          <div class="list12" >
          <marquee direction="up" scrollamount="1"  scrolldelay="30" onMouseOver="stop()" onMouseOut="start()" style="height:110px; overflow:hidden;">

              <li><a href="#" target="_blank">能源工作简报(2008)7期 </a></li>
              <li><a href="#" target="_blank">能源工作简报(2008)7期 </a></li>
              <li><a href="#" target="_blank">能源工作简报(2008)7期 </a></li>
              <li><a href="#" target="_blank">能源工作简报(2008)7期 </a></li>
              <li><a href="#" target="_blank">能源工作简报(2008)7期 </a></li>
              <li><a href="#" target="_blank">能源工作简报(2008)7期 </a></li>
              <li><a href="#" target="_blank">能源工作简报(2008)7期 </a></li>
              <li><a href="#" target="_blank">能源工作简报(2008)7期 </a></li>
              <li><a href="#" target="_blank">能源工作简报(2008)7期 </a></li>
              <li><a href="#" target="_blank">能源工作简报(2008)7期 </a></li>

           </marquee>
          </div>
          <div class="bot"></div>
        </div><!-- end block240 -->

        <div class="blank10"></div>

        <div class="block240">
          <h3>企业名录<span class="more"><a href="#" target="_blank">更多&gt;&gt;</a></span></h3>
          <div class="list12">
          <marquee direction="up" scrollamount="1"  scrolldelay="30" onMouseOver="stop()" onMouseOut="start()" style="height:110px; overflow:hidden; text-align:left;">

              <li><a href="#" target="_blank">重庆浩林生物质能有限公司</a></li>
              <li><a href="#" target="_blank">重庆浩林生物质能有限公司</a></li>
              <li><a href="#" target="_blank">重庆浩林生物质能有限公司</a></li>
              <li><a href="#" target="_blank">重庆浩林生物质能有限公司</a></li>
              <li><a href="#" target="_blank">重庆浩林生物质能有限公司</a></li>

          </marquee>
          </div>
          <div class="bot"></div>
        </div><!-- end block240 -->

        <div class="blank10"></div>

        <div class="block240_blue">
          <h3>重点企业</h3>
          <div class="pt">
            <div class="pic"><a href="#" target="_blank"><img src="/images/pic203x70.jpg" width="203" height="70" /></a></div>

            <ul>
              <li><a href="#" target="_blank">重庆浩林生物质能有限公司</a></li>
              <li><a href="#" target="_blank">重庆浩林生物质能有限公司</a></li>
              <li><a href="#" target="_blank">重庆浩林生物质能有限公司</a></li>
              <li><a href="#" target="_blank">重庆浩林生物质能有限公司</a></li>
              <li><a href="#" target="_blank">重庆浩林生物质能有限公司</a></li>
            </ul>
          </div>
        </div>

        <div class="blank10"></div>

        <div class="block240_blue">
          <h3>重要会议</h3>
          <div class="pt">
            <div class="pic"><a href="#" target="_blank"><img src="/images/pic203x70_2.jpg" width="203" height="70" /></a></div>

            <ul>
              <li><a href="#" target="_blank">重庆浩林生物质能有限公司</a></li>
              <li><a href="#" target="_blank">重庆浩林生物质能有限公司</a></li>
              <li><a href="#" target="_blank">重庆浩林生物质能有限公司</a></li>
              <li><a href="#" target="_blank">重庆浩林生物质能有限公司</a></li>
              <li><a href="#" target="_blank">重庆浩林生物质能有限公司</a></li>
            </ul>
          </div>
        </div>

        <div class="blank10"></div>




      </div><!-- end right240 -->


    </div><!-- end container -->












  </div><!-- end sandwich -->