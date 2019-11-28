<?php
/**
 * 钻石投票模块微站定义
 *
 * @author 省码生活
 * @url http://o2o.sctsck.com
 */
defined('IN_IA') or exit('Access Denied');
require IA_ROOT. '/addons/tyzm_diamondvote/defines.php'; 
require TYZM_MODEL_FUNC.'/function.php';
class tyzm_diamondvoteModuleSite extends WeModuleSite {
	
	

    public $tablereply = 'tyzm_diamondvote_reply';
	public $tablevoteuser = 'tyzm_diamondvote_voteuser';
	public $tablevotedata = 'tyzm_diamondvote_votedata';
	public $tablegift = 'tyzm_diamondvote_gift';	
	public $tablecount = 'tyzm_diamondvote_count';
	public $table_fans = 'tyzm_diamondvote_fansdata';
	public $tableredpack = 'tyzm_diamondvote_redpack';
	public $tablelooklist = 'tyzm_diamondvote_looklist';
	public $tableviporder = 'tyzm_diamondvote_viporder';
	public $tableblacklist = 'tyzm_diamondvote_blacklist';
	public $tabledomainlist = 'tyzm_diamondvote_domainlist';
	public $tablesetmeal = 'tyzm_diamondvote_setmeal';
	public function __construct() {
		global $_GPC;
		$useragent = addslashes($_SERVER['HTTP_USER_AGENT']);
        if(strpos($useragent, 'MicroMessenger') === false && strpos($useragent, 'Windows Phone') === false ){
           	//非微信
        }else{
			$oauthuser = m('user') -> Get_checkoauth();
		    $this->oauthuser=$oauthuser;
		}
		
	}
	
	public function payResult($params){
	global $_W,$_GPC;
	//一些业务代码
	//根据参数params中的result来判断支付是否成功
	if ($params['result'] == 'success' && $params['from'] == 'notify') {
		//此处会处理一些支付成功的业务代码
        //file_put_contents(MODULE_ROOT."/".time()."--data1.txt",json_encode($params));
		$tycode= substr($params['tid'], 0, 4);
		if($tycode=='8888'){//送礼物订单
		    $viporder=pdo_fetch("SELECT * FROM " . tablename($this->tableviporder) . " WHERE ptid = :ptid", array(':ptid' => $params['tid']));
		    if($params['fee'] == $viporder['fee'] && $viporder['ispay']==0){
		       $reviporder=pdo_update($this->tableviporder, array('ispay' =>'1','paytype'=>$params['type'],'uniontid'=>$params['uniontid']), array('ptid' => $params['tid']));
		    }
			exit;
		}
		
		$order=pdo_fetch("SELECT * FROM " . tablename($this->tablegift) . " WHERE ptid = :ptid", array(':ptid' => $params['tid']));
		
		if ($params['fee'] == $order['fee'] && $order['ispay']==0){
			$reupvote=pdo_update($this->tablegift, array('ispay' =>'1','isdeal' =>'1','paytype'=>$params['type'],'uniontid'=>$params['uniontid']), array('ptid' => $params['tid'],'oauth_openid' => $params['user']));
			if(!empty($reupvote)){
				//处理记录 
				
				$setvotesql = 'update ' . tablename($this->tablevoteuser) . ' set votenum=votenum+'.$order['giftvote'].',giftcount=giftcount+'.$order['fee'].',lastvotetime='.time().'  where id = '.$order['tid'];
				$resetvote=pdo_query($setvotesql);
				if(empty($resetvote)){
			        pdo_update($this->$tablegift, array('isdeal' =>0), array('ptid' => $params['tid']));
		        }else{
					$reply=pdo_fetch("SELECT config FROM " . tablename($this->tablereply) . " WHERE rid = :rid ", array(':rid' => $order['rid']));
				    $reply=@array_merge ($reply,unserialize($reply['config']));unset($reply['config']);
					
					if(empty($reply['isvotemsg']) || !empty($reply['awardgive_num'])){
						$votedata=pdo_fetch("SELECT * FROM " . tablename($this->tablevoteuser) . " WHERE id = :id ", array(':id' => $order['tid']));
					}
					//奖励用户
					if(!empty($reply['giftgive_num'])){
						m('present')->upcredit($order['openid'],$reply['giftgive_type'],$reply['giftgive_num']*$params['fee'],'tyzm_diamondvote');
					}
					//奖励end
					//奖励选手
					if(!empty($reply['awardgive_num'])){
						m('present')->upcredit($votedata['openid'],$reply['awardgive_type'],$reply['awardgive_num']*$params['fee'],'tyzm_diamondvote');
					}
					//奖励end										
					if(empty($reply['isvotemsg'])){ //提示
						$uservoteurl=$_W['siteroot']."app/".$this->createMobileUrl('view', array('rid' => $order['rid'],'id' => $votedata['id']));
						$content='您的好友【'.$order['nickname'].'】给你'.$votedata['noid'].'号【'.$votedata['name'].'】送【'.$order['gifttitle'].'】作为礼物！目前礼物共￥'.$votedata['giftcount'].'，目前共'.$votedata['votenum'].'票。<a href=\"'.$uservoteurl.'\">点击查看详情<\/a>';
						m('user') -> sendkfinfo($votedata['openid'],$content);
					}
				}
			}
		}else{
			exit('用户支付的金额与订单金额不符合或已修改状态。');
		}
	}
	//因为支付完成通知有两种方式 notify，return,notify为后台通知,return为前台通知，需要给用户展示提示信息
	//return做为通知是不稳定的，用户很可能直接关闭页面，所以状态变更以notify为准
	//如果消息是用户直接返回（非通知），则提示一个付款成功
	    
		if ($params['from'] == 'return') {
			if ($params['result'] == 'success') {
				$tycode= substr($params['tid'], 0, 4);
				if($tycode=='8888'){
					$order=pdo_fetch("SELECT rid,tid,uniacid FROM " . tablename($this->tableviporder) . " WHERE ptid = :ptid", array(':ptid' => $params['tid']));
					$url = murl('entry/module/payresult',array('m' => 'tyzm_diamondvote','ty'=>'user','rid'=>$order['rid'],'id' => $order['tid'],'i' => $order['uniacid']));
				}else{
					$order=pdo_fetch("SELECT id,tid,rid,uniacid FROM " . tablename($this->tablegift) . " WHERE  ptid = :ptid ", array(':ptid' => $params['tid']));
					$url = murl('entry/module/payresult',array('m' => 'tyzm_diamondvote','rid'=>$order['rid'],'id' => $order['tid'],'i' => $order['uniacid']));
				}
				header("location: ".$_W['siteroot'] . 'app/' . $url);
			}else{
				message("抱歉，支付失败，请刷新后再试！",'referer','error');
			}
		}
    } 

 
	
	public function authorization(){
	// 	global $_GPC,$_W;$module="tyzm_diamondvote";load()->model('setting');$sat=md5($_W['uniaccount']['token']);$COPY=md5($_SERVER['HTTP_HOST'].$module.$sat);
	// 	$auth=cache_load($module);if(empty($auth) || $auth[1]!=$COPY || ($auth[2]+1800)< time()){
	// 		load()->func('communication');
	// 		$url="http://weili.nowbeta.com/app/index.php?i=1&c=entry&do=index&m=tyzm_authorization&module=".$module."&domain=".$_SERVER['HTTP_HOST'];			$a = ihttp_get($url); 			$b=json_decode($a['content'],true); 			if($b['status']==1){				cache_write($module, array($module,$COPY,time()));
	// 		}else{				echo("<p style='text-align: center;background: #FFE9BC;border: 1px solid #fa0;padding: 10px;color: #F90000;position: fixed;width: 100%;z-index: 99999;'>".$b['msg']."</p>");
	// 			exit;			}
	// }	 
	
	} 
	public function doMobileQrcodeurl(){
        global $_W, $_GPC;
        $url = $_GPC['url'];
        require (IA_ROOT . '/framework/library/qrcode/phpqrcode.php');
        $errorCorrectionLevel = "L";
        $matrixPointSize = "6";
        QRcode::png($url, false, $errorCorrectionLevel, $matrixPointSize);
        exit();
    }
	
   	public function  template_footer($name){
		
	}
	
	public function oauth_uniacid(){
		global $_W,$_GPC;
		//借权uniacid start
		if($_W['account']['level']==4){
			$uniacid=$_W['uniacid'];
		}elseif($_W['oauth_account']['level']==4){
			$oauth_acid=$_W['oauth_account']['acid'];
			$account_wechats = pdo_fetch("SELECT uniacid FROM " . tablename('account_wechats') . " WHERE acid = :acid ", array(':acid' => $oauth_acid));
			$uniacid=$account_wechats['uniacid'];
		}else{
			$uniacid=$_W['uniacid'];
		}
		//借权end
        return $uniacid;
	}
	public function get_resource($pic_path){
	        $pathInfo = pathinfo($pic_path);
			switch (strtolower($pathInfo['extension'])) {
				case 'jpg':
				    $imagecreatefromjpeg = 'imagecreatefromjpeg';
					break;
				case 'jpeg':
					$imagecreatefromjpeg = 'imagecreatefromjpeg';
					break;
				case 'png':
					$imagecreatefromjpeg = 'imagecreatefrompng';
					break;
				case 'gif':
				default:
					$imagecreatefromjpeg = 'imagecreatefromstring';
					$pic_path            = file_get_contents($pic_path);
					break;
			}
			//$resource =getimagesize($posterBgImage);
			$resource = $imagecreatefromjpeg($pic_path);
			return $resource;
   }
   	public function  json_exit($status,$msg){
		exit(json_encode(array('status' => $status, 'msg' => $msg)));
		
	}
}

?>