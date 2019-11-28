<?php
/**
 * 钻石投票模块定义
 *
 * @author 说.图谱网
 * @url http://o2o.sctsck.com/
 */
defined('IN_IA') or exit('Access Denied');
require IA_ROOT. '/addons/tyzm_diamondvote/defines.php'; 
require TYZM_MODEL_FUNC.'/function.php';
class tyzm_diamondvoteModule extends WeModule{
    public $table_reply = 'tyzm_diamondvote_reply';
    public $table_reply_post = 'tyzm_diamondvote_reply_post';
	public $tablevoteuser = 'tyzm_diamondvote_voteuser';
	public $tablevotedata = 'tyzm_diamondvote_votedata';
	public $tablegift = 'tyzm_diamondvote_gift';	
	public $tablecount = 'tyzm_diamondvote_count';
	public $table_fans = 'tyzm_diamondvote_fansdata';
	public $tableredpack = 'tyzm_diamondvote_redpack';
	public $tablefriendship = 'tyzm_diamondvote_friendship';
	public $tablelooklist = 'tyzm_diamondvote_looklist';
	public $tableviporder = 'tyzm_diamondvote_viporder';
	public $tableblacklist = 'tyzm_diamondvote_blacklist';
	public $tabledomainlist = 'tyzm_diamondvote_domainlist';
	public $tablesetmeal = 'tyzm_diamondvote_setmeal';
	public function fieldsFormDisplay($rid = 0) {
	//要嵌入规则编辑页的自定义内容，这里 $rid 为对应的规则编号，新增时为 0
		global $_W,$_GPC;
		$details = pdo_fetch("SELECT * FROM ".tablename($this->table_reply_post)." WHERE rid = :rid ORDER BY `id` DESC", array(':rid' => $rid));
		if (!empty($details['aid'])) {
			$activit = pdo_fetch("SELECT id,rid,title FROM ".tablename($this->table_reply)." WHERE rid = :rid", array(':rid' => $details['aid']));
			$details['acttitle']=$activit['title'];
			$details['aid']=$activit['rid'];
		}
		include $this->template('reply.post');
		
	}

	public function fieldsFormValidate($rid = 0) {
		//规则编辑保存时，要进行的数据验证，返回空串表示验证无误，返回其他字符串将呈现为错误提示。这里 $rid 为对应的规则编号，新增时为 0
		return '';
	}

	public function fieldsFormSubmit($rid) {
		//规则验证无误保存入库时执行，这里应该进行自定义字段的保存。这里 $rid 为对应的规则编号
		global $_W,$_GPC;
		global $_W,$_GPC;
		$id = intval($_GPC['reply_id']);
		$insert = array(
			'rid' => $rid,
			'aid' => $_GPC['actrid'],
			'uniacid' => $_W['uniacid'],
			'title' => $_GPC['title'],
			'thumb' => $_GPC['thumb'],
			'description' => $_GPC['description'],
			'linktype'=>intval($_GPC['linktype']),
			'createtime' => time(),	
	    );
		if (empty($id)) {
			pdo_insert($this->table_reply_post, $insert);
		}else{
			unset($insert['createtime']);
			pdo_update($this->table_reply_post, $insert, array('id' => $id));
		}
        message('设置成功！');

	}

	public function ruleDeleted($rid) {
		//删除规则时调用，这里 $rid 为对应的规则编号

		pdo_delete($this->table_reply_post,array('rid' => $rid));

	}

	public function settingsDisplay($settings) {
		global $_W, $_GPC;
		load()->model('attachment');
		//点击模块设置时将调用此方法呈现模块设置页面，$settings 为模块设置参数, 结构为数组。这个参数系统针对不同公众账号独立保存。
		//在此呈现页面中自行处理post请求并保存设置参数（通过使用$this->saveSettings()来实现）
		
		
		if(checksubmit()) {
			//字段验证, 并获得正确的数据$dat
			load()->func('file');
            
			$certroot=MODULE_ROOT.'/template/certdata/'.$_W['uniacid'].'/'.$_GPC['certkey'];
			if($this->module['config']['certkey']!=$_GPC['certkey'] && !empty($this->module['config']['certkey'])){
				$oldcertroot=MODULE_ROOT.'/template/certdata/'.$_W['uniacid'].'/'.$this->module['config']['certkey'];
				rename($oldcertroot,$certroot);
			}
            $r = mkdirs($certroot);
			if(!empty($_GPC['apiclient_cert'])) {
                $ret = file_put_contents($certroot.'/apiclient_cert.pem', trim($_GPC['apiclient_cert']));
                $r = $r && $ret;
            }
            if(!empty($_GPC['apiclient_key'])) {
                $ret = file_put_contents($certroot.'/apiclient_key.pem', trim($_GPC['apiclient_key']));
                $r = $r && $ret;
            }
			if(!$r) {
                message('证书保存失败, 请保证 /addons/tyzm_voicekey/template/certdata/ 目录可写');
            }
			
			//配置远程附件
			$remote = array(
			'type' => intval($_GPC['type']),
			'ftp' => array(
				'ssl' => intval($_GPC['ftp']['ssl']),
				'host' => $_GPC['ftp']['host'],
				'port' => $_GPC['ftp']['port'],
				'username' => $_GPC['ftp']['username'],
				'password' => strexists($_GPC['ftp']['password'], '*') ? $_W['setting']['remote']['ftp']['password'] : $_GPC['ftp']['password'],
				'pasv' => intval($_GPC['ftp']['pasv']),
				'dir' => $_GPC['ftp']['dir'],
				'url' => $_GPC['ftp']['url'],
				'overtime' => intval($_GPC['ftp']['overtime']),
			),
			'alioss' => array(
				'key' => $_GPC['alioss']['key'],
				'secret' => strexists($_GPC['alioss']['secret'], '*') ? $_W['setting']['remote']['alioss']['secret'] : $_GPC['alioss']['secret'],
				'bucket' => $_GPC['alioss']['bucket'],
			),
			'qiniu' => array(
				'accesskey' => trim($_GPC['qiniu']['accesskey']),
				'secretkey' => strexists($_GPC['qiniu']['secretkey'], '*') ? $_W['setting']['remote']['qiniu']['secretkey'] : trim($_GPC['qiniu']['secretkey']),
				'bucket' => trim($_GPC['qiniu']['bucket']),
				'district' => intval($_GPC['qiniu']['district']),
				'url' => trim($_GPC['qiniu']['url'])
			),
			'cos' => array(
				'appid' => trim($_GPC['cos']['appid']),
				'secretid' => trim($_GPC['cos']['secretid']),
				'secretkey' => strexists(trim($_GPC['cos']['secretkey']), '*') ? $_W['setting']['remote']['cos']['secretkey'] : trim($_GPC['cos']['secretkey']),
				'bucket' => trim($_GPC['cos']['bucket']),
				'url' => trim($_GPC['cos']['url']),
				'local' => trim($_GPC['cos']['local']),

			)
		);
		if ($remote['type'] == ATTACH_OSS) {
			if (trim($remote['alioss']['key']) == '') {
				message('阿里云OSS-Access Key ID不能为空');
			}
			if (trim($remote['alioss']['secret']) == '') {
				message('阿里云OSS-Access Key Secret不能为空');
			}
			$buckets = attachment_alioss_buctkets($remote['alioss']['key'], $remote['alioss']['secret']);
			if (is_error($buckets)) {
				message('OSS-Access Key ID 或 OSS-Access Key Secret错误，请重新填写');
			}
			list($remote['alioss']['bucket'], $remote['alioss']['url']) = explode('@@', $_GPC['alioss']['bucket']);
			if (empty($buckets[$remote['alioss']['bucket']])) {
				message('Bucket不存在或是已经被删除');
			}
			$remote['alioss']['url'] = 'http://'.$remote['alioss']['bucket'].'.'.$buckets[$remote['alioss']['bucket']]['location'].'.aliyuncs.com';
			$remote['alioss']['ossurl'] = $buckets[$remote['alioss']['bucket']]['location'].'.aliyuncs.com';
			if(!empty($_GPC['custom']['url'])) {
				$url = trim($_GPC['custom']['url'],'/');
				if (!strexists($url, 'http://') && !strexists($url, 'https://')) {
					$url = 'http://'.$url;
				}
				$remote['alioss']['url'] = $url;
			}
		} elseif ($remote['type'] == ATTACH_FTP) {
			if (empty($remote['ftp']['host'])) {
				message('FTP服务器地址为必填项.');
			}
			if (empty($remote['ftp']['username'])) {
				message('FTP帐号为必填项.');
			}
			if (empty($remote['ftp']['password'])) {
				message('FTP密码为必填项.');
			}
		} elseif ($remote['type'] == ATTACH_QINIU) {
			if (empty($remote['qiniu']['accesskey'])) {
				message('请填写Accesskey', referer(), 'info');
			}
			if (empty($remote['qiniu']['secretkey'])) {
				message('secretkey', referer(), 'info');
			}
			if (empty($remote['qiniu']['bucket'])) {
				message('请填写bucket', referer(), 'info');
			}
			if (empty($remote['qiniu']['url'])) {
				message('请填写url', referer(), 'info');
			} else {
				$remote['qiniu']['url'] = strexists($remote['qiniu']['url'], 'http') ? trim($remote['qiniu']['url'], '/') : 'http://'. trim($remote['qiniu']['url'], '/');
			}
			$auth = attachment_qiniu_auth($remote['qiniu']['accesskey'], $remote['qiniu']['secretkey'], $remote['qiniu']['bucket'], $remote['qiniu']['district']);
			if (is_error($auth)) {
				$message = $auth['message']['error'] == 'bad token' ? 'Accesskey或Secretkey填写错误， 请检查后重新提交' : 'bucket填写错误或是bucket所对应的存储区域选择错误，请检查后重新提交';
				message($message, referer(), 'info');
			}
		} elseif ($remote['type'] == ATTACH_COS) {
			if (empty($remote['cos']['appid'])) {
				message('请填写APPID', referer(), 'info');
			}
			if (empty($remote['cos']['secretid'])) {
				message('请填写SECRETID', referer(), 'info');
			}
			if (empty($remote['cos']['secretkey'])) {
				message('请填写SECRETKEY', referer(), 'info');
			}
			if (empty($remote['cos']['bucket'])) {
				message('请填写BUCKET', referer(), 'info');
			}
			if (empty($remote['cos']['url'])) {
				$remote['cos']['url'] = 'http://'.$remote['cos']['bucket'].'-'.$remote['cos']['appid'].'.cos.myqcloud.com';
			} else {
				if (strexists($remote['cos']['url'], '.cos.myqcloud.com') && !strexists($url, '//'.$remote['cos']['bucket'].'-')) {
					$remote['cos']['url'] = 'http://'.$remote['cos']['bucket'].'-'.$remote['cos']['appid'].'.cos.myqcloud.com';
				}
				$remote['cos']['url'] = strexists($remote['cos']['url'], 'http') ? trim($remote['cos']['url'], '/') : 'http://'. trim($remote['cos']['url'], '/');
			}
			//$auth = attachment_cos_auth($remote['cos']['bucket'], $remote['cos']['appid'], $remote['cos']['secretid'], $remote['cos']['secretkey']);
			$auth = attachment_cos_auth($remote['cos']['bucket'], $remote['cos']['appid'], $remote['cos']['secretid'], $remote['cos']['secretkey'], $remote['cos']['local']);
			if (is_error($auth)) {
				message($auth['message'], referer(), 'info');
			}
		} 
		
			//
			$dat = array( 
				'certkey' => $_GPC['certkey'],
				'isopenweixin' => $_GPC['isopenweixin'],
				'key' => $_GPC['key'],
				'agentkey' => $_GPC['agentkey'],
				'mchid' => $_GPC['mchid'],
				'apikey' => $_GPC['apikey'],
				'remote'=>$remote,
				'iswxappexamine'=>$_GPC['iswxappexamine'],
				'examinecontent'=>$_GPC['examinecontent'],
			);
			$this->saveSettings($dat);
			message('保存成功', 'refresh');
		}
		$remote = $settings['remote'];
		if (!empty($remote['alioss']['key']) && !empty($remote['alioss']['secret'])) {
			$buckets = attachment_alioss_buctkets($remote['alioss']['key'], $remote['alioss']['secret']);
		}
		//数据统计
			
			


	if (!empty($_GPC['datelimit'])) {
		$starttime = strtotime($_GPC['datelimit']['start']);
		$endtime = strtotime($_GPC['datelimit']['end']) + 86399;
		$dailytimes .= " AND createtime > ".$starttime." AND createtime < ".$endtime;
	}else{
            $dailystarttime=mktime(0,0,0);//当天：00：00：00
			$dailyendtime = mktime(23,59,59);//当天：23：59：59
			$dailytimes = '';
			$dailytimes .= ' AND createtime >=' .$dailystarttime;
			$dailytimes .= ' AND createtime <=' .$dailyendtime;

	}
			
		$item['dailyjointotal'] = pdo_fetchcolumn('SELECT COUNT(id) FROM ' . tablename($this->tablevoteuser) . " WHERE   uniacid = :uniacid  ".$dailytimes, array(':uniacid' => $_W['uniacid']));
		$item['dailyvotetotal'] = pdo_fetchcolumn('SELECT COUNT(id) FROM ' . tablename($this->tablevotedata) . " WHERE   uniacid = :uniacid AND votetype=0 ".$dailytimes, array(':uniacid' => $_W['uniacid']));
		$item['dailygiftcount'] = pdo_fetchcolumn('SELECT sum(fee) FROM ' . tablename($this->tablegift) . " WHERE   uniacid = :uniacid AND ispay=1 AND gifttype=0 ".$dailytimes, array(':uniacid' => $_W['uniacid']));
		$item['dailygiftnum'] = pdo_fetchcolumn('SELECT COUNT(id) FROM ' . tablename($this->tablegift) . " WHERE   uniacid = :uniacid AND ispay=1 AND gifttype=0 ".$dailytimes, array(':uniacid' => $_W['uniacid']));
		$item['dailygiftcount']=!empty($item['dailygiftcount'])?$item['dailygiftcount']:0;



		
		
		$item['jointotal'] = pdo_fetchcolumn('SELECT COUNT(id) FROM ' . tablename($this->tablevoteuser) . " WHERE   uniacid = :uniacid  ", array(':uniacid' => $_W['uniacid']));
		$item['votetotal'] = pdo_fetchcolumn('SELECT COUNT(id) FROM ' . tablename($this->tablevotedata) . " WHERE   uniacid = :uniacid AND votetype=0 ", array(':uniacid' => $_W['uniacid']));
		$item['giftcount'] = pdo_fetchcolumn('SELECT sum(fee) FROM ' . tablename($this->tablegift) . " WHERE   uniacid = :uniacid AND ispay=1 AND gifttype=0 ", array(':uniacid' => $_W['uniacid']));
		$item['pvtotal']=pdo_fetchcolumn("SELECT sum(pv_total) FROM ".tablename($this->tablecount)." WHERE uniacid = :uniacid ", array(':uniacid' => $_W['uniacid']));
		$item['giftcount']=!empty($item['giftcount'])?$item['giftcount']:0;
		//
		
		
		if (IMS_VERSION>=0.8){
	        $bucket_datacenter = attachment_alioss_datacenters();
		}
		//这里来展示设置项表单
		include $this->template('setting');
	}

	public function tpl_setinput($arrayvalue = array()) {
		if(is_array($arrayvalue)){

		
		foreach (@$arrayvalue as $row) {
				$html .= '
					<div  style="margin-left:-15px;">
					  <div class="col-sm-10" style="margin-bottom:10px">
						<div class="input-group">
						  <input type="text" class="form-control" name="infoname[]" value="'.$row['infoname'].'" placeholder="请输入表单名称">
						  <span class="input-group-addon"></span>
						  <select  class="form-control" name="infotype[]">
							<option value="">请选择输入类型</option>
							<option value="realname"' . (($row['infotype'] == "realname") ? 'selected ="selected"' : '') . '  >真实姓名</option>
							<option value="mobile" ' . (($row['infotype'] == "mobile") ? 'selected ="selected"' : '') . ' >手机号码</option>
							<option value="email" ' . (($row['infotype'] == "email") ? 'selected ="selected"' : '') . ' >电子邮箱</option>
							<option value="sex" ' . (($row['infotype'] == "sex") ? 'selected ="selected"' : '') . ' >性别</option>
							<option value="qq" >QQ号</option>
							<option value="birthyear" >出生生日</option>
							<option value="telephone"' . (($row['infotype'] == "telephone") ? 'selected ="selected"' : '') . ' >固定电话</option>
							<option value="idcard" ' . (($row['infotype'] == "idcard") ? 'selected ="selected"' : '') . '>证件号码</option>
							<option value="address" ' . (($row['infotype'] == "address") ? 'selected ="selected"' : '') . '>邮寄地址</option>
							<option value="zipcode"' . (($row['infotype'] == "zipcode") ? 'selected ="selected"' : '') . ' >邮编</option>
							<option value="nationality" ' . (($row['infotype'] == "nationality") ? 'selected ="selected"' : '') . '>国籍</option>
							<option value="resideprovince"' . (($row['infotype'] == "resideprovince") ? 'selected ="selected"' : '') . ' >居住地址</option>
							<option value="graduateschool" ' . (($row['infotype'] == "graduateschool") ? 'selected ="selected"' : '') . '>毕业学校</option>
							<option value="company"' . (($row['infotype'] == "company") ? 'selected ="selected"' : '') . ' >公司</option>
							<option value="education" ' . (($row['infotype'] == "education") ? 'selected ="selected"' : '') . '>学历</option>
							<option value="occupation" ' . (($row['infotype'] == "occupation") ? 'selected ="selected"' : '') . '>职业</option>
							<option value="position" ' . (($row['infotype'] == "position") ? 'selected ="selected"' : '') . '>职位</option>
							<option value="revenue" ' . (($row['infotype'] == "revenue") ? 'selected ="selected"' : '') . '>年收入</option>
							<option value="affectivestatus" ' . (($row['infotype'] == "affectivestatus") ? 'selected ="selected"' : '') . '>情感状态</option>
							<option value="lookingfor"' . (($row['infotype'] == "lookingfor") ? 'selected ="selected"' : '') . ' > 交友目的</option>
							<option value="bloodtype"' . (($row['infotype'] == "bloodtype") ? 'selected ="selected"' : '') . ' >血型</option>
							<option value="height"' . (($row['infotype'] == "height") ? 'selected ="selected"' : '') . ' >身高</option>
							<option value="weight" ' . (($row['infotype'] == "weight") ? 'selected ="selected"' : '') . '>体重</option>
							<option value="alipay" ' . (($row['infotype'] == "alipay") ? 'selected ="selected"' : '') . '>支付宝帐号</option>
							<option value="taobao"' . (($row['infotype'] == "taobao") ? 'selected ="selected"' : '') . ' >阿里旺旺</option>
							<option value="vqqcom"' . (($row['infotype'] == "vqqcom") ? 'selected ="selected"' : '') . ' >腾讯视频</option>
							<option value="site"' . (($row['infotype'] == "site") ? 'selected ="selected"' : '') . ' >主页</option>
							<option value="bio" ' . (($row['infotype'] == "bio") ? 'selected ="selected"' : '') . '>自我介绍</option>
							<option value="interest" ' . (($row['infotype'] == "interest") ? 'selected ="selected"' : '') . '>兴趣爱好</option>

						  </select>
							 <div class="input-group-btn" style="width:95px">
								<select  class="form-control" name="notnull[]">
												<option value="1" ' . (($row['notnull'] == "1") ? 'selected ="selected"' : '') . ' >必填</option>
												<option value="0" ' . (($row['notnull'] == "0") ? 'selected ="selected"' : '') . ' >非必填</option>
								</select>
							 </div>
							 <div class="input-group-btn" style="width:130px">
								<select  class="form-control" name="isshow[]">
												<option value="0" ' . (($row['isshow'] == "0") ? 'selected ="selected"' : '') . ' >前台不显示</option>
												<option value="1" ' . (($row['isshow'] == "1") ? 'selected ="selected"' : '') . ' >前台显示</option>
								</select>
							 </div>
						</div>
					  </div>
					  <div class="col-sm-1 del_box" style="margin-top:5px" ><a href="javascript:;" ><i class="fa fa-times-circle"></i></a></div>
					</div>				
				';
		}
		}
		return $html;
		
	}
	
	public function welcomeDisplay()
	{
		ob_end_clean();
		@header('Location: ' . $this->createWebUrl('manage'));
		exit();
	}
	public function createRandomStr($length){
		$str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';//62个字符
		$strlen = 26;
		while($length > $strlen){
			$str .= $str;
			$strlen += 26;
		}
		$str = str_shuffle($str);
		return substr($str,0,$length);
	}
/* 	public function tplmobile() {
		global $_W;
		$path = IA_ROOT . '/addons/tyzm_diamondvote/template/mobile/';
		if(is_dir($path)) {
			if ($handle = opendir($path)) {
				while (false !== ($templatepath = readdir($handle))) {
					if ($templatepath != '.' && $templatepath != '..') {
						if(is_dir($path.$templatepath)){
							$template[] = $templatepath;
						}
					}
				}
			}
		}
        $template[]="default";
		return $template;
	}  */
	public function tplmobile() {
		global $_W;
		$template=array(
		    "default_new"=>array(
			    "title"=>"默认模板",
				"icon"=>"icon.jpg",
				"style"=>array(
				    'default'=>array("css"=>"index","color"=>"#ccc"),
					'yellow'=>array("css"=>"default_yellow","color"=>"#fff900"),
					'blue'=>array("css"=>"default_blue","color"=>"#04b0f5"),
					'purple'=>array("css"=>"default_purple","color"=>"#c400d0"),
				)
			),
		);
		return $template;
	} 

}

