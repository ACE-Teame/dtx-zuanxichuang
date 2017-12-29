/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : dtx-zuanxichuang

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-12-29 17:22:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `common`
-- ----------------------------
DROP TABLE IF EXISTS `common`;
CREATE TABLE `common` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` int(3) NOT NULL,
  `val` varchar(36) NOT NULL,
  `type` varchar(8) NOT NULL,
  `order` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of common
-- ----------------------------
INSERT INTO `common` VALUES ('1', '1', '建设银行', 'bank', '1');
INSERT INTO `common` VALUES ('2', '2', '农业银行', 'bank', '1');
INSERT INTO `common` VALUES ('3', '3', '中国银行', 'bank', '1');
INSERT INTO `common` VALUES ('4', '4', '工商银行', 'bank', '3');
INSERT INTO `common` VALUES ('5', '5', '交通银行', 'bank', '2');
INSERT INTO `common` VALUES ('6', '5', '5万', 'quato', '5');
INSERT INTO `common` VALUES ('7', '10', '10万', 'quato', '10');
INSERT INTO `common` VALUES ('8', '15', '15万', 'quato', '15');
INSERT INTO `common` VALUES ('9', '20', '20万', 'quato', '20');
INSERT INTO `common` VALUES ('10', '6', '邮政银行', 'bank', '1');
INSERT INTO `common` VALUES ('11', '7', '- 选择银行 -', 'test', '3');
INSERT INTO `common` VALUES ('12', '8', '平安银行', 'bank', '1');
INSERT INTO `common` VALUES ('13', '9', '光大银行', 'bank', '1');
INSERT INTO `common` VALUES ('14', '10', '浦发银行', 'bank', '1');
INSERT INTO `common` VALUES ('15', '11', '中兴银行', 'test', '1');
INSERT INTO `common` VALUES ('16', '12', '华夏银行', 'bank', '1');
INSERT INTO `common` VALUES ('17', '13', '兴业银行', 'bank', '1');
INSERT INTO `common` VALUES ('18', '14', '招商银行', 'bank', '2');
INSERT INTO `common` VALUES ('19', '25', '25万', 'quato', '25');
INSERT INTO `common` VALUES ('20', '30', '30万', 'quato', '30');
INSERT INTO `common` VALUES ('21', '35', '35万', 'quato', '35');
INSERT INTO `common` VALUES ('22', '40', '40万', 'quato', '40');
INSERT INTO `common` VALUES ('23', '45', '45万', 'quato', '45');
INSERT INTO `common` VALUES ('24', '50', '50万', 'quato', '50');
INSERT INTO `common` VALUES ('25', '6', '6万', 'quato', '6');
INSERT INTO `common` VALUES ('26', '3', '3万', 'quato', '3');
INSERT INTO `common` VALUES ('27', '7', '7万', 'quato', '7');
INSERT INTO `common` VALUES ('28', '8', '8万', 'quato', '8');
INSERT INTO `common` VALUES ('29', '9', '9万', 'quato', '9');
INSERT INTO `common` VALUES ('30', '0', '广州银行', 'bank', '0');

-- ----------------------------
-- Table structure for `order`
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(36) DEFAULT NULL,
  `phone` varchar(24) DEFAULT NULL,
  `cardid` varchar(36) DEFAULT NULL,
  `address` varchar(64) DEFAULT NULL,
  `occupation` varchar(64) DEFAULT NULL COMMENT '职业',
  `social_security` tinyint(1) NOT NULL DEFAULT '0' COMMENT '社保',
  `quato` tinyint(1) NOT NULL COMMENT '额度',
  `time` int(10) NOT NULL,
  `ip` varchar(16) DEFAULT NULL,
  `c` varchar(48) DEFAULT NULL,
  `accumulation_fund` tinyint(1) NOT NULL DEFAULT '0' COMMENT '公积金',
  `degree` tinyint(1) NOT NULL DEFAULT '3' COMMENT '信用程度',
  `loan_term` tinyint(1) NOT NULL DEFAULT '1' COMMENT '贷款期限',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------
INSERT INTO `order` VALUES ('1', '沉陷', '18336545124', '410182199306203714', '广州市', '在职', '1', '3', '1514535596', '127.0.0.1', '', '1', '1', '3');
INSERT INTO `order` VALUES ('2', '车那', '18336344622', '410182199306203714', '广州市', '个体户', '0', '8', '1514535731', '127.0.0.1', '', '0', '2', '6');
INSERT INTO `order` VALUES ('3', '沉先', '18336322451', '410182199306203714', '广州市', '无业人士', '1', '20', '1514538827', '127.0.0.1', 'test', '0', '3', '12');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(128) NOT NULL,
  `create_time` int(10) NOT NULL,
  `update_time` int(10) DEFAULT NULL,
  `login_time` int(10) DEFAULT NULL,
  `ip` varchar(48) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '$2y$10$BMX/JDTSpXLSHZ/kjUjSmu3JyepTKS4UrTQIGD8NG0Qur.MaZQakC', '1509690166', '1510730719', '1514536609', '127.0.0.1', '1');
