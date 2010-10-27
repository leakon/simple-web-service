<?php

class Alipay {

	public static function genPayUrl($arrOrderInfo) {
		
		$subject	= mb_convert_encoding($arrOrderInfo['subject'], 'GBK', 'UTF-8');
		$body		= mb_convert_encoding($arrOrderInfo['body'], 'GBK', 'UTF-8');

		$parameter	= array(
		
				"service"         => "create_direct_pay_by_user",		//交易类型
				"_input_charset"  => 'GBK',					//字符集，默认为GBK
				"payment_type"    => "1",					//默认为1,不需要修改
				
				"seller_email"    => AlipayConf::SELLER_MAIL,			//卖家邮箱，必填
				"partner"         => AlipayConf::PARTNER_ID,			//合作商户号
				"return_url"      => AlipayConf::RETURN_URL,			//同步返回
				"notify_url"      => AlipayConf::NOTIFY_URL,			//异步返回
				
				"subject"         => $subject,					//商品名称，必填
				"body"            => $body,					//商品描述，必填
				"out_trade_no"    => $arrOrderInfo['out_trade_no'], 		//商品外部交易号，必填（保证唯一性）
				"total_fee"       => $arrOrderInfo['total_fee'],		//商品单价，必填（价格不能为0）
				"show_url"        => $arrOrderInfo['show_url'],			//商品相关网站
				
				);


		$alipay		= new alipay_service($parameter, AlipayConf::SECRET_KEY, 'MD5');

		return	$alipay->create_url();

	}

	public static function verifyNotification($arrRequest) {
		
		$result		= array();
		
		$alipay		= new alipay_notify(
							AlipayConf::PARTNER_ID,
							AlipayConf::SECRET_KEY,
							'MD5',
							'GBK',
							'http',		// 万网主机 socket 方式不支持 https
							$arrRequest
						);
		
		$bool		= false;
		
		try {
			
			$strOrderID		= isset($arrRequest['out_trade_no']) ? $arrRequest['out_trade_no'] : '';
			$verify_result		= $alipay->notify_verify();
		
			if (!$verify_result) {
				throw new Exception('Alipay notify verify failed', 1000);
			}
			
			// ---------------- //
			
			
			// 查询订单
			$objOrder		= new Table_data_order();
	
			$objOrder->order_id	= $strOrderID;
			$objOrder->pay_method	= Table_data_order::PAY_METHOD_ALIPAY;
	
			$objMatchOrder		= SofavDB_Record::match($objOrder);
			
			if (empty($objMatchOrder->id)) {
				throw new Exception('Order not found', 2000);
			}
			
			// ---------------- //
			
			// 标记付款成功
			$objMatchOrder->status		= Table_data_order::STATUS_PAYED_SUCCESS;
			$objMatchOrder->save();
				
			// 成功
			$bool	= true;
			
			// 付款成功后再发邮件
			Table_data_order::sendOrderDetailMail($strOrderID);
		
			
			$arrData	= array(
						
						'category'	=> 'alipay_notify_success',
						'object_id'	=> $strOrderID,
						'content'	=> $arrRequest,
						
					);
			
			Table_debug_log::record($arrData);
			
		} catch (Exception $exp) {
			
			$arrContent	= array(
						'error_code'		=> $exp->getCode(),
						'error_message'		=> $exp->getMessage(),
						'alipay_request'	=> $arrRequest,
					);
			
			$arrData	= array(
						
						'category'	=> 'alipay_notify_failed',
						'object_id'	=> $strOrderID,
						'content'	=> $arrContent,
						
					);
			
			Table_debug_log::record($arrData);
			
		}
		
		return	$bool;
		
	}

}

