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


		$pindex = max(1, intval($_GPC['page']));
        $psize = 20;
		if (!empty($_GPC['keyword'])) {
			$keyword=$_GPC['keyword'];
			$condition .= " AND CONCAT(`title`) LIKE '%{$keyword}%'";
		}
		$list = pdo_fetchall("SELECT * FROM ".tablename($this->tablereply)." WHERE uniacid = '{$_W['uniacid']} ' $condition  ORDER BY status DESC,createtime DESC LIMIT ".($pindex - 1) * $psize.",{$psize}");
		if (!empty($list)) {
             $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename($this->tablereply) . " WHERE uniacid = '{$_W['uniacid']}' $condition");
             $pager = pagination($total, $pindex, $psize); 


			
         }

    	include $this->template('activit.query');
    
