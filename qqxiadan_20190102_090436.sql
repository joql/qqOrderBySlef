-- MySQL dump 10.13  Distrib 5.5.61, for Linux (i686)
--
-- Host: localhost    Database: qqxiadan
-- ------------------------------------------------------
-- Server version	5.5.61-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `shua_config`
--

DROP TABLE IF EXISTS `shua_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shua_config` (
  `k` varchar(32) NOT NULL,
  `v` text,
  PRIMARY KEY (`k`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shua_config`
--

LOCK TABLES `shua_config` WRITE;
/*!40000 ALTER TABLE `shua_config` DISABLE KEYS */;
INSERT INTO `shua_config` VALUES ('cache','a:16:{s:7:\"version\";s:4:\"1001\";s:10:\"admin_user\";s:5:\"admin\";s:9:\"admin_pwd\";s:6:\"123456\";s:10:\"alipay_api\";s:1:\"2\";s:10:\"tenpay_api\";s:1:\"2\";s:9:\"qqpay_api\";s:1:\"2\";s:9:\"wxpay_api\";s:1:\"2\";s:5:\"style\";s:1:\"1\";s:8:\"sitename\";s:35:\"潜龙24小时全自助管理平台\";s:8:\"keywords\";s:35:\"潜龙24小时全自助管理平台\";s:11:\"description\";s:35:\"潜龙24小时全自助管理平台\";s:4:\"kfqq\";s:10:\"1009164180\";s:7:\"anounce\";s:149:\"<h4>下单注意事项</h4><font color=blue>请勿重复下单，之前的单子刷完才能继续下单，重复下单是不会刷的！<br/></font>\";s:5:\"kaurl\";s:0:\"\";s:5:\"modal\";s:47:\"欢迎使用潜龙24小时全自助管理平台\";s:5:\"title\";s:0:\"\";}'),('version','1001'),('admin_user','admin'),('admin_pwd','123456'),('alipay_api','2'),('tenpay_api','2'),('qqpay_api','2'),('wxpay_api','2'),('style','1'),('sitename','潜龙24小时全自助管理平台'),('keywords','潜龙24小时全自助管理平台'),('description','潜龙24小时全自助管理平台'),('kfqq','1009164180'),('anounce','<h4>下单注意事项</h4><font color=blue>请勿重复下单，之前的单子刷完才能继续下单，重复下单是不会刷的！<br/></font>'),('kaurl',''),('modal','欢迎使用潜龙24小时全自助管理平台'),('title','');
/*!40000 ALTER TABLE `shua_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shua_kms`
--

DROP TABLE IF EXISTS `shua_kms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shua_kms` (
  `kid` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `km` varchar(255) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `addtime` timestamp NULL DEFAULT NULL,
  `user` varchar(20) NOT NULL DEFAULT '0',
  `usetime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shua_kms`
--

LOCK TABLES `shua_kms` WRITE;
/*!40000 ALTER TABLE `shua_kms` DISABLE KEYS */;
INSERT INTO `shua_kms` VALUES (1,3,'gfnSk6RwEA8HqCo3HM',1000,'2018-12-31 01:46:17','0',NULL),(2,4,'1OjtWDVbXql8T3syHV',1000,'2018-12-31 03:20:06','1','2018-12-31 03:23:59'),(3,4,'BFO7ECSMBSij1H5us0',1000,'2018-12-31 06:40:22','2','2018-12-31 06:46:53');
/*!40000 ALTER TABLE `shua_kms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shua_orders`
--

DROP TABLE IF EXISTS `shua_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shua_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `kid` int(11) DEFAULT '0',
  `zid` int(11) NOT NULL DEFAULT '0',
  `tel` varchar(11) DEFAULT NULL,
  `qq` varchar(20) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `url` varchar(32) DEFAULT NULL,
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shua_orders`
--

LOCK TABLES `shua_orders` WRITE;
/*!40000 ALTER TABLE `shua_orders` DISABLE KEYS */;
INSERT INTO `shua_orders` VALUES (1,4,2,0,'17711644013','17711644013',1,1,NULL,'2018-12-31 11:23:59',NULL),(2,4,3,0,'13575149418','13575149418',1,1,NULL,'2018-12-31 14:46:53',NULL);
/*!40000 ALTER TABLE `shua_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shua_pay`
--

DROP TABLE IF EXISTS `shua_pay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shua_pay` (
  `trade_no` varchar(64) NOT NULL,
  `type` varchar(20) DEFAULT NULL,
  `tid` int(11) NOT NULL,
  `qq` varchar(20) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `money` varchar(32) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`trade_no`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shua_pay`
--

LOCK TABLES `shua_pay` WRITE;
/*!40000 ALTER TABLE `shua_pay` DISABLE KEYS */;
INSERT INTO `shua_pay` VALUES ('20181231062204872',NULL,1,'43535345','2018-12-31 06:22:03',NULL,'qq会员','1.77',0);
/*!40000 ALTER TABLE `shua_pay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shua_tools`
--

DROP TABLE IF EXISTS `shua_tools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shua_tools` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `sort` int(11) NOT NULL DEFAULT '10',
  `name` varchar(255) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `active` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tid`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shua_tools`
--

LOCK TABLES `shua_tools` WRITE;
/*!40000 ALTER TABLE `shua_tools` DISABLE KEYS */;
INSERT INTO `shua_tools` VALUES (4,2,'爱奇艺视频会员',0,111.00,0.00,1),(3,1,'腾讯视频',0,111.00,0.00,1),(5,3,'优酷黄金会员',0,111.00,0.00,1);
/*!40000 ALTER TABLE `shua_tools` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-01-02  9:04:36
