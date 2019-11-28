<?php

/**

 * 钻石投票模块-后台管理-编辑

 *

 * @author 省码生活

 * @url http://o2o.sctsck.com

 */



defined('IN_IA') or exit('Access Denied');



load()->func('file');

load()->func('tpl');

global $_W,$_GPC;

$uniacid = intval($_W['uniacid']);


$rid=intval($_GPC['rid']);



//要嵌入规则编辑页的自定义内容，这里 $rid 为对应的规则编号，新增时为 0
if ($rid) {
	$reply = pdo_fetch("SELECT * FROM ".tablename($this->tablereply)." WHERE rid = :rid AND uniacid=:uniacid ORDER BY `id` DESC", array(':rid' => $rid,'uniacid' => $_W['uniacid']));

	if (!$reply) {
		message('参数错误！'); 
	}

}
	
	$template=m('tpl')->tplmobile();
	$AdPiece=cache_load('AdPiece');
	//$adrefreshtime=$AdPiece['refreshtime'];
	$creditnames = uni_setting($_W['uniacid'], array('creditnames'));
	if($creditnames) {
		foreach($creditnames['creditnames'] as $index=>$creditname) {
			if($creditname['enabled'] == 0){
				unset($creditnames['creditnames'][$index]);
			}
		} 
		if (is_array($creditnames['creditnames'])) {
			$scredit = implode(', ', array_keys($creditnames['creditnames']));
		}else{
			$scredit = '';
		}
		
	} else {
		$scredit = '';
	}	
	
	
	if ($_W['ispost']) {
		
		$id = intval($_GPC['reply_id']);
		
		if(empty($rid)){

			$lastrid = pdo_getall($this->tablereply, array('rid !=' => 0), array('rid') , '' , 'rid DESC' , array(1));
			$rid=$lastrid[0]['rid']+1;
		}

		if($_W['isfounder']==1){
			//print_r($_GPC);exit;
		}
		//print_r($_GPC);exit;
		/*
		`isfollow`  '是否需要关注，0不关注，1参加关注，2投票参加关注',
		`unsubscribe` '取消订阅减票',
		`diamondmodel` '是否钻石模式',
		diamondvalue  钻石价值
		`exchange` '一颗砖石兑换几票',
		`rankingnum`'显示多少排行榜',
		`everyoneuser`每人每用户最多投多少',
		`dailyvote`'每日每人最多投票',
		`everyonevote`总共能投票次数',
		`ischecked`是否需要审核',
		voteadimg 弹出广告图片
		voteadurl 弹出广告链接
		voteadtext 弹出广告文字
		isvotemsg  是否发送投票信息
		isoneself  是否能给自己投票
		everyonediamond  每人最多送礼物数量
		virtualpv  虚拟浏览量了
		isdiamondnone  匿名钻石
		divideinto  分成百分百
		followguide 关注引导文字
		notice    首页公告
		indexorder  首页排序
		minnumpeople  最小人数
		minupimg 最少上传图片
		maxupimg 最多上传图片
		perminute每分钟最大投票数量
		perminutevote  每分钟最大投票数量
		lockminutes  锁定多少分钟
        votegive_type  投票赠送类型
		votegive_num   投票赠送数量
		joingive_type  参加赠送类型
		joingive_num   参加赠送数量
		
		isshowgift      是否显示礼物详情
		giftgive_type  送礼物赠送类型
		giftgive_num   送礼物赠送数量
		
		awardgive_type  收礼物赠送类型
		awardgive_num   收礼物赠送数量		
		
		weixinopen  是否绑定微信开发者账号
		isposter 是否开启海报
		posterkey 海报关键字
		bill_bg 海报背景
		bill_hint 海报提示
		isredpack 开始红包抽奖
		act_name 活动名称
		send_name  商户名称
		wishing  红包祝福语
		remark  红包备注
		redpackettotal 总数
		lotterychance 弹出概率
		probability  红包概率
		ipplace 每个IP红包数量
		redpackarea 红包地区
		redpacketnum  每日红包量
		everyonenum   每个人最多能获得红包
		limitstart  最小红包
		limitend    最大红包
		defaultpay  支付方式
		usepwd   核销密码
		
		giftscale 礼物比例
		giftunit  礼物单位
		isgiftad  是否开启投票弹出礼物广告
		isfriendship 交友信息配置
		
		locationtype
		followvote   关注多投票

		payment 收银方式
		upimgtype 图片上传方式
		upvideotype 是否开启视频上传
		musicshare 音乐分享
		verifycode 投票验证码
		indexsound 首页音乐
		isindexslide 首页幻灯片
		
		-----开屏广告------
		islinkpage 开屏广告
		linkpagetime 开屏广告持续时间
		
		-----报名红包------
		isredpackjoin是否开启
		remarkjoin备注
		wishingjoin红包祝福语
		send_namejoin商户名称
		act_namejoin活动名称
		limitstartjoin最小红包
		limitendjoin最大红包
		probabilityjoin红包概率
		redpacketnumjoin每日红包个数
		redpackettotaljoin红包总数
		-----------
		*/
		$config=@iserializer(array('jumpdomain'=>$_GPC['jumpdomain'],'bottomstyle'=>$_GPC['bottomstyle'],'isfollow'=>$_GPC['isfollow'],'followvote'=>$_GPC['followvote'],'indexorder'=>$_GPC['indexorder'],'infoorder'=>$_GPC['infoorder'],'unsubscribe'=>$_GPC['unsubscribe'],'diamondvalue'=>$_GPC['diamondvalue'],'diamondmodel'=>$_GPC['diamondmodel'],'exchange'=>$_GPC['exchange'],'jdexchange'=>$_GPC['jdexchange'],'rankingnum'=>$_GPC['rankingnum'],'divideinto'=>$_GPC['divideinto'],'followguide'=>$_GPC['followguide'],'notice'=>$_GPC['notice'],'everyoneuser'=>$_GPC['everyoneuser'],'dailyvote'=>$_GPC['dailyvote'],'everyonevote'=>$_GPC['everyonevote'],'isoneself'=>$_GPC['isoneself'],'ischecked'=>$_GPC['ischecked'],'voteadimg'=>$_GPC['voteadimg'],'voteadtext'=>$_GPC['voteadtext'],'voteadurl'=>$_GPC['voteadurl'],'everyonediamond'=>$_GPC['everyonediamond'],'isvotemsg'=>$_GPC['isvotemsg'],'virtualpv'=>intval($_GPC['virtualpv']),'iseggnone'=>$_GPC['iseggnone'],'locationtype'=>$_GPC['locationtype'],'isdiamondnone'=>$_GPC['isdiamondnone'],'minnumpeople'=>intval($_GPC['minnumpeople']),'minupimg'=>intval($_GPC['minupimg']),'maxupimg'=>intval($_GPC['maxupimg']),'perminute'=>intval($_GPC['perminute']),'perminutevote'=>intval($_GPC['perminutevote']),'lockminutes'=>intval($_GPC['lockminutes']),'votegive_type'=>$_GPC['votegive_type'],'votegive_num'=>$_GPC['votegive_num'],'joingive_type'=>$_GPC['joingive_type'],'joingive_num'=>$_GPC['joingive_num'],'giftgive_type'=>$_GPC['giftgive_type'],'giftgive_num'=>$_GPC['giftgive_num'],'awardgive_type'=>$_GPC['awardgive_type'],'awardgive_num'=>$_GPC['awardgive_num'],'isshowgift'=>$_GPC['isshowgift'],'weixinopen'=>$_GPC['weixinopen'],'isredpack'=>$_GPC ['isredpack'],'act_name'=>$_GPC ['act_name'],'send_name'=>$_GPC ['send_name'],'wishing'=>$_GPC ['wishing'],'remark'=>$_GPC['remark'],'redpackettotal'=>$_GPC ['redpackettotal'],'lotterychance'=>$_GPC ['lotterychance'],'probability'=>$_GPC ['probability'],'ipplace'=>$_GPC['ipplace'],'redpackarea'=>$_GPC ['redpackarea'],'redpacketnum'=>$_GPC['redpacketnum'],'everyonenum'=>$_GPC['everyonenum'],'limitstart'=>$_GPC['limitstart'],'limitend'=>$_GPC['limitend'],'isposter'=>$_GPC['isposter'],'posterkey'=>$_GPC['posterkey'],'bill_bg'=>$_GPC['bill_bg'],'bill_hint'=>$_GPC['bill_hint'],'defaultpay'=>$_GPC['defaultpay'],'usepwd'=>$_GPC['usepwd'],'giftscale'=>$_GPC['giftscale'],'giftunit'=>$_GPC['giftunit'],'isgiftad'=>$_GPC['isgiftad'],'upimgtype'=>$_GPC['upimgtype'],'upvideotype'=>$_GPC['upvideotype'],'musicshare'=>$_GPC['musicshare'],'verifycode'=>$_GPC['verifycode'],'isindexslide'=>$_GPC['isindexslide'],'islinkpage'=>$_GPC['islinkpage'],'linkpagetime'=>$_GPC['linkpagetime'],'indexsound'=>$_GPC['indexsound'],'index_ad'=>$_GPC['index_ad'],'prize_ad'=>$_GPC['prize_ad'],'rank_ad'=>$_GPC['rank_ad'],'view_ad'=>$_GPC['view_ad'],'gift_ad'=>$_GPC['gift_ad'],'isredpackjoin'=>$_GPC['isredpackjoin'],'remarkjoin'=>$_GPC['remarkjoin'],'wishingjoin'=>$_GPC['wishingjoin'],'send_namejoin'=>$_GPC['send_namejoin'],'act_namejoin'=>$_GPC['act_namejoin'],'limitstartjoin'=>$_GPC['limitstartjoin'],'limitendjoin'=>$_GPC['limitendjoin'],'probabilityjoin'=>$_GPC['probabilityjoin'],'redpacketnumjoin'=>$_GPC['redpacketnumjoin'],'redpackettotaljoin'=>$_GPC['redpackettotaljoin'],'indexnum'=>$_GPC['indexnum'],'isreport'=>$_GPC['isreport'],'votecname'=>$_GPC['votecname'],'votecnameunit'=>$_GPC['votecnameunit'],'isdetails'=>$_GPC['isdetails'],'votesucceed'=>$_GPC['votesucceed'])); 

		

		
		//exit($_GPC['bill_bg']);
		//print_r($_GPC['adshow']);exit;
		
        for ($k = 0; $k < count($_GPC['adtitle']); $k++) {
			$addata[$k] = array(
			    "type" => 1,
				"adtitle" => $_GPC['adtitle'][$k],
				"adimg" => $_GPC['adimg'][$k],
				"adurl" => $_GPC['adurl'][$k],
				"adshow" => $_GPC['adshow'][$k],
			);
		}
		$addata=@iserializer($addata);
		for ($k = 0; $k < count($_GPC['gifttitle']); $k++){
			$giftdata[$k] = array(
				"gifticon" => $_GPC['gifticon'][$k],
				"gifttitle" => $_GPC['gifttitle'][$k],
				"giftprice" => $_GPC['giftprice'][$k],
				"giftvote" => $_GPC['giftvote'][$k],
			);
		}
		
		$style=@iserializer(array('template'=>$_GPC['template'],'setstyle'=>$_GPC['setstyle']));
		
		$giftdata=@iserializer($giftdata);
		
		//报名字段
		for ($k = 0; $k < count($_GPC['infoname']); $k++){
			$applydata[$k] = array(
				"infoname" => $_GPC['infoname'][$k],
				"infotype" => $_GPC['infotype'][$k],
				"notnull" => $_GPC['notnull'][$k],
				"isshow" => $_GPC['isshow'][$k],
			);
		}
		$applydata=@iserializer($applydata);



		$insert = array(
			'rid' => $rid,
			'uniacid' => $_W['uniacid'],
			'title' => $_GPC['title'],
			'thumb' => $_GPC['thumb'],
			'description' => $_GPC['description'],
			'starttime' => strtotime($_GPC['time']['start']),
			'endtime' => strtotime($_GPC['time']['end']),
			'apstarttime' => strtotime($_GPC['aptime']['start']),
			'apendtime' => strtotime($_GPC['aptime']['end']),
			'votestarttime' => strtotime($_GPC['votetime']['start']),
			'voteendtime' => strtotime($_GPC['votetime']['end']),
			'topimg' => $_GPC['topimg'],
			'bgcolor' => $_GPC['bgcolor'],
			'style'=>$style,
			'eventrule' => htmlspecialchars_decode($_GPC['eventrule']),
			'prizemsg' => htmlspecialchars_decode($_GPC['prizemsg']),
			'config'=>$config,
			'addata' => $addata,
			'giftdata' =>$giftdata,
			'bill_data' => htmlspecialchars_decode($_GPC['bill_data']),
			'applydata' =>$applydata,
			'area' => $_GPC['area'],
			'sharetitle' => $_GPC['sharetitle'],
			'shareimg' => $_GPC['shareimg'],
			'sharedesc' => $_GPC['sharedesc'],
			'status' => $_GPC['status'],
			'createtime' => time(),	
	    );
		if (empty($id)) {
			//$insert['uid']=$_W['uid'];
			pdo_insert($this->tablereply, $insert);
			//pdo_update('tyzm_diamondvote_walletaccount', array('number -=' =>1), array('uniacid' => $_W['uniacid']));
		}else{
			unset($insert['createtime']);
			pdo_update($this->tablereply, $insert, array('id' => $id));
		}
        //message('设置成功！', $this->createWebUrl('manage'), 'success');
        itoast('设置成功！', $this->createWebUrl('manage'), 'success');
		
		 
	}
	
	
		$ipcity=$retData['retData']['city'];
		if(empty($rid)){
			if(empty($_GPC['copyid'])){
				$reply = array(
					'title'=> '年度投票，震惊联合国，男神女神，萌宝帅宠，你也来一发！',
					'thumb' => "../addons/tyzm_diamondvote/template/static/images/topimg.jpg",
					'description' => "全民投票的时代，你怎么能错过，邀请好友一起来帮你吧。",
					'starttime' => mktime(0,0,0) + 86400 + 3600*9,
					'endtime' => mktime(0,0,0) + 6*86400 + 3600*22,
					'apstarttime' => mktime(0,0,0) + 86400 + 3600*9,
					'apendtime' => mktime(0,0,0) + 6*86400 + 3600*22,
					'votestarttime' => mktime(0,0,0) + 86400 + 3600*9,
					'voteendtime' => mktime(0,0,0) + 6*86400 + 3600*22,
					'topimg' => "../addons/tyzm_diamondvote/template/static/images/topimg.jpg",
					'bgcolor' => "#fff",
					'eventrule'=>'请设置活动规则内容，支持多媒体HTML！',
					'prizemsg'=>'请设置活动奖品内容，支持多媒体HTML！',
					'area' => "",
					'ischecked'=>1,
					'followguide'=>"关注公众号后，点击菜单或回复投票关键字即可参加投票。",
					'diamondvalue'=>1,
					'votecredit1'=>0,
					'votecredit2'=>0,
					'gvotecredit1'=>0,
					'gvotecredit2'=>0,
					'joincredit1'=>0,
					'joincredit2'=>0,
					'minupimg'=>1,
					'maxupimg'=>5,
					'posterkey'=>'',
					'exchange'=>3,
					'jdexchange'=>3,
					'diamondmodel'=>$_W['account']['level']<3?1:0,
					'rankingnum'=>20,
					'followvote'=>0,
					'everyoneuser'=>2,
					'dailyvote'=>6,
					'everyonevote'=>50,
	                'everyonediamond'=>0,
					'giftscale'=>1,
					'giftunit'=>"点",
	                'virtualpv'=>0,
					'voteadimg'=>"",
	                'minnumpeople'=>0,	
					'bill_hint'=>"邀请方法：1、长按图片保存；2、发送给好友或朋友圈；3、好友帮忙投票，获取红包抽奖机会！",
					'bill_bg'=>$_W['siteroot']."/addons/tyzm_diamondvote/template/static/images/posterbg.jpg",
	                'act_name'=>"投票奖励红包",
					'send_name'=>"钻石投票",
					'wishing'=>"恭喜发财，大吉大利！",
					'remark'=>"玩越多得越多，奖励越多！",
					'act_namejoin'=>"投票奖励红包",
					'send_namejoin'=>"钻石投票",
					'wishingjoin'=>"恭喜发财，大吉大利！",
					'remarkjoin'=>"玩越多得越多，奖励越多！",
					'isredpack'=>0,				
					'isredpackjoin'=>0,				
					'status' => 1,
				);
				$giftdata=Array(
					'0' => Array        (
							'gifticon' => $_W['siteroot']."/addons/tyzm_diamondvote/template/static/images/diamond.png",
							'gifttitle' => '钻石',
							'giftprice' => 1,
							'giftvote' => 3
					),
					'1' => Array        (
							'gifticon' => $_W['siteroot']."/addons/tyzm_diamondvote/template/static/images/smiley_angry.png",
							'gifttitle' => '生气',
							'giftprice' => 1,
							'giftvote' => '-2'
					),

	            );
				$applydata=array( 
				   '0'=>array(
					   'infoname'=>'手机',
					   'infotype'=>'mobile',
					   'notnull'=>'1',
					),
				);
                $tpl_setinput=m('tpl')->tpl_setinput($applydata);
			}else{
				$reply = pdo_fetch("SELECT * FROM ".tablename($this->tablereply)." WHERE rid = :rid AND uniacid=:uniacid ORDER BY `id` DESC", array(':rid' => $_GPC['copyid'],'uniacid' => $_W['uniacid']));
				$reply['title']=$reply['title']."复制".random(5, true);
				$reply=@array_merge ($reply,@unserialize($reply['config']));
				$reply['style']=@unserialize($reply['style']);
				$addata=@unserialize($reply['addata']);
				$giftdata=@unserialize($reply['giftdata']);	
				$applydata=@unserialize($reply['applydata']);	
				$bill_data = json_decode(str_replace('&quot;', "'", $reply['bill_data']), true);
				$tpl_setinput=m('tpl')->tpl_setinput($applydata);
				
				unset($reply['id'],$reply['voteadurl']);
			}
		}else{	
			$reply=@array_merge ($reply,@unserialize($reply['config']));
			$reply['style']=@unserialize($reply['style']);

			if(empty($reply['style']['template'])){
				$reply['style']['template']="default";
				$reply['style']['setstyle']="default_index";
			}

			$addata=@unserialize($reply['addata']);
			
			$giftdata=@unserialize($reply['giftdata']);	
			$applydata=@unserialize($reply['applydata']);	
			$bill_data = json_decode(str_replace('&quot;', "'", $reply['bill_data']), true);
			$tpl_setinput=m('tpl')->tpl_setinput($applydata);
		}
		
		if(!file_exists(MODULE_ROOT ."/lib/font/font.ttf")){
		   $nofont=1;
	    }


		include $this->template('activity');