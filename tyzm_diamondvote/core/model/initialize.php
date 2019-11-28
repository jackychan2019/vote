<?php
if (!defined('IN_IA')) {
	exit('Access Denied');
} 
class Tyzm_initialize{
	public function __construct() {
		//global $_W;
	}
	public $tablereply = 'tyzm_diamondvote_reply';
	public $tablevoteuser = 'tyzm_diamondvote_voteuser';
	public $tablevotedata = 'tyzm_diamondvote_votedata';
	public $tablegift = 'tyzm_diamondvote_gift';	
	public $tablecount = 'tyzm_diamondvote_count';
	public function get_activity($rid,$ty=0){
		global $_W;
		$uniacid = intval($_W['uniacid']);
		$reply = pdo_fetch("SELECT * FROM " . tablename($this->tablereply) . " WHERE rid = :rid AND uniacid=:uniacid ORDER BY `id` DESC", array(':rid' => $rid,':uniacid' => $uniacid));
		
		if(empty($reply)){
			return 0;
		}
		
		$reply['style']=@unserialize($reply['style']);
		$reply=@array_merge($reply,unserialize($reply['config']));unset($reply['config']);
		$addata=@unserialize($reply['addata']);	
		$jointotal = pdo_fetchcolumn('SELECT COUNT(id) FROM ' . tablename($this->tablevoteuser) . " WHERE   rid = :rid  ".$condition , array(':rid' => $rid));
		$votetotal=pdo_fetchcolumn("SELECT sum(votenum) FROM ".tablename($this->tablevoteuser)." WHERE rid = :rid ", array(':rid' => $rid));
		$votetotal=!empty($votetotal)?$votetotal:0;
		$vheat=pdo_fetchcolumn("SELECT sum(vheat) FROM ".tablename($this->tablevoteuser)." WHERE rid = :rid ", array(':rid' => $rid));
		$pvtotal=pdo_fetchcolumn("SELECT sum(pv_total) FROM ".tablename($this->tablecount)." WHERE rid = :rid ", array(':rid' => $rid));
		$pvtotal=$pvtotal+$reply['virtualpv']+$vheat;
		$voteuser = pdo_fetch("SELECT id FROM " . tablename($this->tablevoteuser) . " WHERE rid = :rid AND  openid = :openid ORDER BY `id` DESC", array(':rid' => $rid,':openid' => $_W['openid']));
		if(!empty($voteuser)){//是否参加
			$myvoteid=$voteuser['id'];
		}else{
			$myvoteid=0;
		}
		if($reply['apstarttime']> time() && $reply['apendtime']<time()){
			$signup=1;//可以报名
		}else{
			$signup=0;//可以报名
		}
		$data=array(
			'activity'=>array(//活动信息
				'rid'=>$reply['rid'],
				'title'=>$reply['title'],
				'topimg'=>tomedia($reply['topimg']),
				'endtime'=>$reply['endtime'],
				'status'=>$reply['status'],
				'eventrule'=>$reply['eventrule'],
				'prizemsg'=>$reply['prizemsg'], 
				'jointotal'=>$jointotal,
				'votetotal'=>$votetotal,
				'pvtotal'=>$pvtotal,
				'isgift'=>empty($reply['diamondmodel'])?1:0,
				'signup'=>$signup, //1为开启报名通道
				'notice'=>$reply['notice'], 
				'apstarttime'=>$reply['apstarttime'],
				'apendtime'=>$reply['apendtime'],
				'applydata'=>$reply['applydata'], 
				
			),
			'addata'=>$addata,
			'user'=>array(
				'myvoteid'=>$myvoteid,//已报名，则返回用户投票id
			),
			'page'=>array(
				'indexsound'=>!empty($reply['indexsound'])?tomedia($reply['indexsound']):'',
				'sharetitle'=>!empty($reply['sharetitle'])?$reply['sharetitle']:$reply['title'],
				'shareimg'=>!empty($reply['shareimg'])?tomedia($reply['shareimg']):tomedia($reply['thumb']),
				'sharedesc'=>!empty($reply['sharedesc'])?$reply['sharedesc']:$reply['description'],
			)
		);
		if($ty==1){
				$data['activity']=@array_merge($reply,$data['activity']);
			}
		return $data;
		
		
	}
	
}