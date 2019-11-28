<?php
$sql="
CREATE TABLE IF NOT EXISTS `ims_tyzm_diamondvote_blacklist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `type` varchar(1) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  `content` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `createtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_uniacid` (`uniacid`),
  KEY `content` (`content`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_tyzm_diamondvote_count` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `rid` int(10) unsigned NOT NULL,
  `tid` int(10) unsigned NOT NULL,
  `pv_total` int(1) NOT NULL,
  `share_total` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_tyzm_diamondvote_domainlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uniacid` int(11) DEFAULT NULL,
  `rid` int(11) DEFAULT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `domain` varchar(50) DEFAULT NULL,
  `extensive` tinyint(1) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `createtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `content` (`domain`),
  KEY `indx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_tyzm_diamondvote_gift` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(10) unsigned NOT NULL,
  `ptid` varchar(128) NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `uniontid` varchar(30) NOT NULL,
  `paytype` varchar(20) NOT NULL,
  `oauth_openid` varchar(50) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `user_ip` varchar(15) NOT NULL,
  `gifttitle` varchar(8) DEFAULT NULL,
  `giftcount` int(10) NOT NULL,
  `gifticon` varchar(255) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `giftvote` varchar(50) NOT NULL,
  `ispay` int(1) NOT NULL,
  `isdeal` tinyint(1) NOT NULL,
  `gifttype` tinyint(1) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `createtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_tid` (`tid`),
  KEY `indx_rid` (`rid`),
  KEY `indx_ptid` (`ptid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_tyzm_diamondvote_gift1` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(10) unsigned NOT NULL,
  `ptid` varchar(128) NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `uniontid` varchar(30) NOT NULL,
  `paytype` varchar(20) NOT NULL,
  `oauth_openid` varchar(50) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `user_ip` varchar(15) NOT NULL,
  `gifttitle` varchar(8) DEFAULT NULL,
  `giftcount` int(10) NOT NULL,
  `gifticon` varchar(255) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `giftvote` varchar(50) NOT NULL,
  `ispay` int(1) NOT NULL,
  `isdeal` tinyint(1) NOT NULL,
  `gifttype` tinyint(1) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `createtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_tid` (`tid`),
  KEY `indx_rid` (`rid`),
  KEY `indx_ptid` (`ptid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_tyzm_diamondvote_redpack` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `unionid` varchar(50) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `user_ip` varchar(15) NOT NULL,
  `mch_billno` varchar(28) DEFAULT NULL,
  `total_amount` int(10) DEFAULT NULL,
  `total_num` int(3) NOT NULL,
  `client_ip` varchar(15) NOT NULL,
  `send_time` varchar(14) DEFAULT NULL,
  `send_listid` varchar(32) DEFAULT NULL,
  `return_data` text,
  `return_code` varchar(16) NOT NULL,
  `return_msg` varchar(256) NOT NULL,
  `result_code` varchar(16) NOT NULL,
  `err_code` varchar(32) NOT NULL,
  `err_code_des` varchar(128) NOT NULL,
  `rewards` varchar(20) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `type` tinyint(1) DEFAULT NULL,
  `createtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_tyzm_diamondvote_reply` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `starttime` int(10) DEFAULT NULL,
  `endtime` int(10) DEFAULT NULL,
  `apstarttime` int(10) DEFAULT NULL,
  `apendtime` int(10) DEFAULT NULL,
  `votestarttime` int(10) DEFAULT NULL,
  `voteendtime` int(10) DEFAULT NULL,
  `topimg` varchar(255) DEFAULT NULL,
  `bgcolor` varchar(255) DEFAULT NULL,
  `style` varchar(255) DEFAULT NULL,
  `infomsg` mediumtext,
  `eventrule` mediumtext,
  `prizemsg` mediumtext,
  `endintro` mediumtext,
  `config` mediumtext,
  `addata` mediumtext,
  `giftdata` mediumtext NOT NULL,
  `bill_data` mediumtext NOT NULL,
  `applydata` mediumtext NOT NULL,
  `area` varchar(100) DEFAULT NULL,
  `shareimg` varchar(255) DEFAULT NULL,
  `sharetitle` varchar(100) DEFAULT NULL,
  `sharedesc` varchar(300) DEFAULT NULL,
  `uid` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `createtime` int(10) DEFAULT NULL,
  `linkdata` mediumtext,
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_tyzm_diamondvote_reply_post` (
  `id` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `aid` int(10) unsigned NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `linktype` int(1) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `createtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_aid` (`aid`),
  KEY `indx_uniacid` (`uniacid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;


CREATE TABLE IF NOT EXISTS `ims_tyzm_diamondvote_votedata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `oauth_openid` varchar(50) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `user_ip` varchar(15) NOT NULL,
  `votetype` tinyint(1) DEFAULT NULL,
  `reward` tinyint(1) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `createtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_tid` (`tid`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `ims_tyzm_diamondvote_voteuser` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `noid` int(10) unsigned NOT NULL,
  `rid` int(10) unsigned NOT NULL,
  `uniacid` int(11) DEFAULT NULL,
  `oauth_openid` varchar(50) NOT NULL,
  `openid` varchar(50) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `user_ip` varchar(15) NOT NULL,
  `name` varchar(30) NOT NULL,
  `introduction` varchar(255) DEFAULT NULL,
  `img1` varchar(255) DEFAULT NULL,
  `img2` varchar(255) DEFAULT NULL,
  `img3` varchar(255) DEFAULT NULL,
  `img4` varchar(255) DEFAULT NULL,
  `img5` varchar(255) DEFAULT NULL,
  `details` mediumtext,
  `joindata` mediumtext NOT NULL,
  `formatdata` mediumtext,
  `votenum` int(255) NOT NULL,
  `giftcount` decimal(10,2) NOT NULL,
  `vheat` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `locktime` int(10) DEFAULT NULL,
  `attestation` tinyint(1) DEFAULT NULL,
  `atmsg` varchar(255) NOT NULL,
  `lastvotetime` int(10) NOT NULL,
  `createtime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `indx_rid` (`rid`),
  KEY `indx_uniacid` (`uniacid`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

";
pdo_run($sql);
if(!pdo_fieldexists("tyzm_diamondvote_blacklist", "id")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_blacklist")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("tyzm_diamondvote_blacklist", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_blacklist")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("tyzm_diamondvote_blacklist", "type")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_blacklist")." ADD `type` varchar(1);");
}
if(!pdo_fieldexists("tyzm_diamondvote_blacklist", "value")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_blacklist")." ADD `value` varchar(50);");
}
if(!pdo_fieldexists("tyzm_diamondvote_blacklist", "content")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_blacklist")." ADD `content` varchar(50);");
}
if(!pdo_fieldexists("tyzm_diamondvote_blacklist", "status")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_blacklist")." ADD `status` tinyint(1);");
}
if(!pdo_fieldexists("tyzm_diamondvote_blacklist", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_blacklist")." ADD `createtime` int(10);");
}
if(!pdo_fieldexists("tyzm_diamondvote_count", "id")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_count")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("tyzm_diamondvote_count", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_count")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("tyzm_diamondvote_count", "rid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_count")." ADD `rid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_count", "tid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_count")." ADD `tid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_count", "pv_total")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_count")." ADD `pv_total` int(1) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_count", "share_total")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_count")." ADD `share_total` int(1) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_domainlist", "id")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_domainlist")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("tyzm_diamondvote_domainlist", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_domainlist")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("tyzm_diamondvote_domainlist", "rid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_domainlist")." ADD `rid` int(11);");
}
if(!pdo_fieldexists("tyzm_diamondvote_domainlist", "type")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_domainlist")." ADD `type` tinyint(1);");
}
if(!pdo_fieldexists("tyzm_diamondvote_domainlist", "domain")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_domainlist")." ADD `domain` varchar(50);");
}
if(!pdo_fieldexists("tyzm_diamondvote_domainlist", "extensive")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_domainlist")." ADD `extensive` tinyint(1);");
}
if(!pdo_fieldexists("tyzm_diamondvote_domainlist", "description")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_domainlist")." ADD `description` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_domainlist", "status")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_domainlist")." ADD `status` tinyint(1);");
}
if(!pdo_fieldexists("tyzm_diamondvote_domainlist", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_domainlist")." ADD `createtime` int(10);");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "id")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "tid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `tid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "ptid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `ptid` varchar(128) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "rid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `rid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "uniontid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `uniontid` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "paytype")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `paytype` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "oauth_openid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `oauth_openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "openid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "avatar")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `avatar` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `nickname` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "user_ip")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `user_ip` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "gifttitle")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `gifttitle` varchar(8);");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "giftcount")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `giftcount` int(10) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "gifticon")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `gifticon` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "fee")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `fee` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "giftvote")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `giftvote` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "ispay")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `ispay` int(1) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "isdeal")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `isdeal` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "gifttype")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `gifttype` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "status")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `status` tinyint(1);");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift")." ADD `createtime` int(10);");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "id")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "tid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `tid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "ptid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `ptid` varchar(128) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "rid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `rid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "uniontid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `uniontid` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "paytype")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `paytype` varchar(20) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "oauth_openid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `oauth_openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "openid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "avatar")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `avatar` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `nickname` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "user_ip")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `user_ip` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "gifttitle")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `gifttitle` varchar(8);");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "giftcount")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `giftcount` int(10) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "gifticon")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `gifticon` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "fee")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `fee` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "giftvote")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `giftvote` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "ispay")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `ispay` int(1) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "isdeal")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `isdeal` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "gifttype")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `gifttype` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "status")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `status` tinyint(1);");
}
if(!pdo_fieldexists("tyzm_diamondvote_gift1", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_gift1")." ADD `createtime` int(10);");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "id")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "tid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `tid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "rid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `rid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "unionid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `unionid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "openid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "avatar")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `avatar` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `nickname` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "user_ip")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `user_ip` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "mch_billno")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `mch_billno` varchar(28);");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "total_amount")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `total_amount` int(10);");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "total_num")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `total_num` int(3) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "client_ip")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `client_ip` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "send_time")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `send_time` varchar(14);");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "send_listid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `send_listid` varchar(32);");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "return_data")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `return_data` text;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "return_code")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `return_code` varchar(16) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "return_msg")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `return_msg` varchar(256) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "result_code")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `result_code` varchar(16) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "err_code")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `err_code` varchar(32) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "err_code_des")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `err_code_des` varchar(128) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "rewards")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `rewards` varchar(20);");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "status")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `status` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "type")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `type` tinyint(1);");
}
if(!pdo_fieldexists("tyzm_diamondvote_redpack", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_redpack")." ADD `createtime` int(10);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "id")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "rid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `rid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "title")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `title` varchar(100);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "thumb")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `thumb` varchar(255);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "description")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `description` varchar(255);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "starttime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `starttime` int(10);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "endtime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `endtime` int(10);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "apstarttime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `apstarttime` int(10);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "apendtime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `apendtime` int(10);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "votestarttime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `votestarttime` int(10);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "voteendtime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `voteendtime` int(10);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "topimg")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `topimg` varchar(255);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "bgcolor")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `bgcolor` varchar(255);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "style")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `style` varchar(255);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "infomsg")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `infomsg` mediumtext;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "eventrule")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `eventrule` mediumtext;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "prizemsg")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `prizemsg` mediumtext;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "endintro")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `endintro` mediumtext;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "config")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `config` mediumtext;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "addata")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `addata` mediumtext;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "giftdata")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `giftdata` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "bill_data")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `bill_data` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "applydata")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `applydata` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "area")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `area` varchar(100);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "shareimg")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `shareimg` varchar(255);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "sharetitle")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `sharetitle` varchar(100);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "sharedesc")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `sharedesc` varchar(300);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "uid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `uid` int(11) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "status")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `status` tinyint(1);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `createtime` int(10);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply", "linkdata")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply")." ADD `linkdata` mediumtext;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply_post", "id")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply_post")." ADD `id` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply_post", "rid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply_post")." ADD `rid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply_post", "aid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply_post")." ADD `aid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply_post", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply_post")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply_post", "title")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply_post")." ADD `title` varchar(100);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply_post", "thumb")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply_post")." ADD `thumb` varchar(255);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply_post", "description")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply_post")." ADD `description` varchar(255);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply_post", "linktype")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply_post")." ADD `linktype` int(1) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply_post", "status")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply_post")." ADD `status` tinyint(1);");
}
if(!pdo_fieldexists("tyzm_diamondvote_reply_post", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_reply_post")." ADD `createtime` int(10);");
}
if(!pdo_fieldexists("tyzm_diamondvote_votedata", "id")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_votedata")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("tyzm_diamondvote_votedata", "tid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_votedata")." ADD `tid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_votedata", "rid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_votedata")." ADD `rid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_votedata", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_votedata")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("tyzm_diamondvote_votedata", "oauth_openid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_votedata")." ADD `oauth_openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_votedata", "openid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_votedata")." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_votedata", "avatar")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_votedata")." ADD `avatar` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_votedata", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_votedata")." ADD `nickname` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_votedata", "user_ip")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_votedata")." ADD `user_ip` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_votedata", "votetype")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_votedata")." ADD `votetype` tinyint(1);");
}
if(!pdo_fieldexists("tyzm_diamondvote_votedata", "reward")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_votedata")." ADD `reward` tinyint(1) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_votedata", "status")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_votedata")." ADD `status` tinyint(1);");
}
if(!pdo_fieldexists("tyzm_diamondvote_votedata", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_votedata")." ADD `createtime` int(10);");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "id")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `id` int(10) unsigned NOT NULL AUTO_INCREMENT;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "noid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `noid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "rid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `rid` int(10) unsigned NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "uniacid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `uniacid` int(11);");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "oauth_openid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `oauth_openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "openid")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `openid` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "avatar")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `avatar` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "video")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `video` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "nickname")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `nickname` varchar(50) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "user_ip")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `user_ip` varchar(15) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "name")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `name` varchar(30) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "introduction")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `introduction` varchar(255);");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "img1")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `img1` varchar(255);");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "img2")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `img2` varchar(255);");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "img3")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `img3` varchar(255);");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "img4")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `img4` varchar(255);");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "img5")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `img5` varchar(255);");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "details")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `details` mediumtext;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "joindata")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `joindata` mediumtext NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "formatdata")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `formatdata` mediumtext;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "votenum")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `votenum` int(255) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "giftcount")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `giftcount` decimal(10,2) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "vheat")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `vheat` int(11) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "status")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `status` tinyint(1);");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "locktime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `locktime` int(10);");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "attestation")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `attestation` tinyint(1);");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "atmsg")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `atmsg` varchar(255) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "lastvotetime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `lastvotetime` int(10) NOT NULL;");
}
if(!pdo_fieldexists("tyzm_diamondvote_voteuser", "createtime")) {
 pdo_query("ALTER TABLE ".tablename("tyzm_diamondvote_voteuser")." ADD `createtime` int(10);");
}
