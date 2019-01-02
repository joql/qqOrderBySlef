DROP TABLE IF EXISTS `shua_config`;
create table `shua_config` (
`k` varchar(32) NOT NULL,
`v` text NULL,
PRIMARY KEY  (`k`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `shua_config` VALUES ('cache', '');
INSERT INTO `shua_config` VALUES ('version', '1001');
INSERT INTO `shua_config` VALUES ('admin_user', 'admin');
INSERT INTO `shua_config` VALUES ('admin_pwd', '123456');
INSERT INTO `shua_config` VALUES ('alipay_api', '2');
INSERT INTO `shua_config` VALUES ('tenpay_api', '2');
INSERT INTO `shua_config` VALUES ('qqpay_api', '2');
INSERT INTO `shua_config` VALUES ('wxpay_api', '2');
INSERT INTO `shua_config` VALUES ('style', '1');
INSERT INTO `shua_config` VALUES ('sitename', 'QQ空间业务自助下单平台');
INSERT INTO `shua_config` VALUES ('keywords', 'QQ空间业务自助下单平台');
INSERT INTO `shua_config` VALUES ('description', 'QQ空间业务自助下单平台');
INSERT INTO `shua_config` VALUES ('kfqq', '123456789');
INSERT INTO `shua_config` VALUES ('anounce', '<h4>下单注意事项</h4><font color=blue>请勿重复下单，之前的单子刷完才能继续下单，重复下单是不会刷的！<br/>21点前添加当天开刷，21点之后添加次日开刷，每天只能提交一次。<br/>本站代挂业务所有都会完成，由于限制时间会比较慢，不过都会刷完，最终解释权归本站所有。</font>');
INSERT INTO `shua_config` VALUES ('kaurl', 'http://917ka.com/2Evou.html');
INSERT INTO `shua_config` VALUES ('modal', '欢迎使用QQ空间业务自助下单平台');

DROP TABLE IF EXISTS `shua_tools`;
CREATE TABLE `shua_tools` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) NOT NULL DEFAULT '10',
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `active` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_orders`;
CREATE TABLE `shua_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `zid` int(11) NOT NULL DEFAULT '0',
  `qq` varchar(20) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `url` varchar(32) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_kms`;
CREATE TABLE `shua_kms` (
  `kid` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `km` varchar(255) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `addtime` timestamp NULL DEFAULT NULL,
  `user` varchar(20) NOT NULL DEFAULT '0',
  `usetime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `shua_pay`;
CREATE TABLE `shua_pay` (
  `trade_no` varchar(64) NOT NULL,
  `type` varchar(20) NULL,
  `tid` int(11) NOT NULL,
  `qq` varchar(20) NOT NULL,
  `addtime` datetime NULL,
  `endtime` datetime NULL,
  `name` varchar(64) NULL,
  `money` varchar(32) NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`trade_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;