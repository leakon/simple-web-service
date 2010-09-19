<?php

class Alipay {

	public static function genPayUrl($arrOrderInfo) {

		$parameter = $this->getParameterArray($subject, $body, $show_url, $out_trade_no, $total_fee);




		$parameter	= array();
		$subject	= mb_convert_encoding($subject, 'GBK', 'UTF-8');
		$body		= mb_convert_encoding($body, 'GBK', 'UTF-8');

		$parameter	= array(
					"service"         => "create_direct_pay_by_user",  //交易类型
					"partner"         => 0,          		   //合作商户号
					"return_url"      => $this->return_url,            //同步返回
					"notify_url"      => $this->notify_url,            //异步返回
					"_input_charset"  => $this->_input_charset,        //字符集，默认为GBK
					"subject"         => $subject,               	   //商品名称，必填
					"body"            => $body,                        //商品描述，必填
					"out_trade_no"    => $out_trade_no,                //商品外部交易号，必填（保证唯一性）
					"total_fee"       => $total_fee,                   //商品单价，必填（价格不能为0）
					"payment_type"    => "1",                          //默认为1,不需要修改
					"show_url"        => $show_url,            	  //商品相关网站
					"seller_email"    => ''          //卖家邮箱，必填
				);


		$alipay = new alipay_service($parameter, '', 'MD5');

		return	$alipay->create_url();


	}

}

