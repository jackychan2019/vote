<?php


/**
 * 钻石投票-投诉
 *
 * @author 省码生活
 * @url http://o2o.sctsck.com
 */

defined('IN_IA') or exit('Access Denied');
global $_W,$_GPC;
is_weixin();

if($_W['ispost']){
	message('投诉提交成功，工作人员会尽快处理您的投诉信息！', "", 'success');
}

include $this->template("report");