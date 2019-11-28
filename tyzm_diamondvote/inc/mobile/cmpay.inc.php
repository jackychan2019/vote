<?php
define('IN_MOBILE', true);
global $_W,$_GPC;


is_weixin();
$op = !empty($_GPC['op']) ? $_GPC['op'] : 'display';
if($op == 'creatc'){
	
//https://weili.nowbeta.com/app/index.php?i=1&c=entry&rid=173&isopenlink=first&do=cmpay&m=tyzm_diamondvote&wxref=mp.weixin.qq.com
$ID = '832FB8D44A6F3F33C64A9D3F4D58239A';
$Key = 'a9bc0c5bfa58e8e081a15c9cadcb4510';
$Key = 'a9bc0c5bfa58e8e081a15c9cadcb4510';
$sign = strtoupper(md5('money=0.01&orderId=20180708114025789456&shopId=b0fecf75457279d78ea39e030ec214f6&key=a9bc0c5bfa58e8e081a15c9cadcb4510'));
$money = sprintf("%.2f",$gift['giftprice']*$count);
print_r($sign);
$params = array(
		'shopId' => 'b0fecf75457279d78ea39e030ec214f6',
		'money' => '0.01',
		'orderId' => '20180708114025789456',
		'type' => 'weixin',
		'goodsMsg' => '123456',
		'sign' => $sign,
		'redirectUrl' => 'https://weili.nowbeta.com/app/index.php?i=1&c=entry&rid=173&isopenlink=first&do=cmpay&m=tyzm_diamondvote&op=creatcredirect',
		'redirectNumber' => 6
	);
	load()->func('communication');
	$response = ihttp_post('http://pay.congmingpay.com/pay/buypay.do', $params);
	print_r($response);
	if (is_error($response)) {
		exit(json_encode(array('error' => '1', 'msg' => "订单生成失败")));
	}
	$jyresult = json_decode($response['content'],true);
}

if($op == 'redirect'){
	print_r('2222');
}