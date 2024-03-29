<?php
/**
 * 钻石投票模块处理程序
 *
 * @author 省码生活
 * @url http://o2o.sctsck.com
 */
defined('IN_IA') or exit('Access Denied');
require IA_ROOT. '/addons/tyzm_diamondvote/defines.php'; 
require TYZM_MODEL_FUNC.'/function.php';
class tyzm_diamondvoteModuleProcessor extends WeModuleProcessor {
	public $tablevoteuser = 'tyzm_diamondvote_voteuser';
	public $table_reply_post = 'tyzm_diamondvote_reply_post';
	public function respond() {
		global $_W,$_GPC;
		//这里定义此模块进行消息处理时的具体过程, 请查看微擎文档来编写你的代码
		$message = $this->message;
		$openid= $message['from'];
		$rid = $this->rule;
		$voteid=$this->number($message['content']);

		$activit = pdo_fetch("SELECT * FROM ".tablename($this->table_reply_post)." WHERE rid = :rid", array(':rid' => $rid));

		if($activit){
			$rid=$activit['aid'];
			switch ($activit['linktype']) {
				case '1':
					$index='join';
					break;
				case '2':
					$index='ranking';
					break;
				default:
					$index='index';
					break;
			}

		}else{
			$index='index';
		}

		if($voteid!=0){
            load()->model('mc');
			$fans = mc_fansinfo($openid);
			$voteuser = pdo_fetch("SELECT id,noid FROM " . tablename($this->tablevoteuser) . " WHERE noid = :noid AND rid = :rid  ", array(':noid' => $voteid,':rid' => $rid));
			
			if(empty($voteuser)){
				//return $this->respText("没有该编号用户，请检查后再输入！"); 
			}
			$userinfo=array();
			$userinfo['nickname']=$fans['tag']['nickname'];
			$userinfo['openid']=$fans['openid'];
			$userinfo['avatar']=$fans['tag']['avatar'];
			$userinfo['oauth_openid']=$fans['openid'];
			$userinfo['unionid']=$fans['unionid'];
			$userinfo['follow']=$fans['follow'];

			$votere=m('vote')->setvote($userinfo,$rid,$voteuser['id'],0,0,1);
			return $this->respText($votere['msg']);
		}
		$sql = "SELECT title,description,thumb,status,starttime FROM " . tablename('tyzm_diamondvote_reply') . " WHERE `rid`=:rid LIMIT 1";
		$row = pdo_fetch($sql, array(':rid' => $rid));

		if ($row == false) {
			return $this->respText("活动已取消...");
		}

		if ($row['isshow'] == 1){
			return $this->respText("活动暂停，请稍后...");
		}

		if ($row['starttime'] > time()) {
			return $this->respText("活动未开始，请等待...");
		}



		return $this->respNews(array(
			'Title' => $activit?$activit['title']:$row['title'],
			'Description' => $activit?$activit['description']:$row['description'],
			'PicUrl' => toimage($activit?$activit['thumb']:$row['thumb']),
			'Url' => $this->createMobileUrl($index, array('rid' => $rid)),
		));
		
	}
	public function number($str)
	{
	    return preg_replace('/\D/s', '', $str);
	}
}

