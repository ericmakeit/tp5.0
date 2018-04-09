-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2018-04-09 08:44:01
-- 服务器版本： 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zk_sysdata`
--

-- --------------------------------------------------------

--
-- 表的结构 `zk_kaidanren`
--

DROP TABLE IF EXISTS `zk_kaidanren`;
CREATE TABLE IF NOT EXISTS `zk_kaidanren` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `z_name` varchar(10) COLLATE utf8_bin NOT NULL,
  `z_sex` char(4) COLLATE utf8_bin NOT NULL,
  `z_age` tinyint(3) NOT NULL,
  `z_sid` int(18) NOT NULL,
  `z_pic` varchar(50) COLLATE utf8_bin NOT NULL,
  `z_kdrq` datetime NOT NULL,
  `z_kdfj` varchar(100) COLLATE utf8_bin NOT NULL,
  `z_note` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 表的结构 `zk_user`
--

DROP TABLE IF EXISTS `zk_user`;
CREATE TABLE IF NOT EXISTS `zk_user` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `tel` varchar(20) COLLATE utf8_bin NOT NULL,
  `qq` varchar(10) COLLATE utf8_bin NOT NULL,
  `department` varchar(200) COLLATE utf8_bin NOT NULL,
  `pic` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `address` varchar(50) COLLATE utf8_bin NOT NULL,
  `note` text COLLATE utf8_bin NOT NULL,
  `delete_time` datetime(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `zk_user`
--

INSERT INTO `zk_user` (`id`, `name`, `password`, `email`, `tel`, `qq`, `department`, `pic`, `address`, `note`, `delete_time`) VALUES
(1, 'administrator', '9580ab5d9db022c73d6678b07c86c9db', '4251289@qq.com', '', '23245', '昆明筑科', '', '大商汇84－604', '大商汇', '0000-00-00 00:00:00.000000'),
(2, 'user2', '01cfcd4f6b8770febfb40cb906715822', 'user2@123.com', '', '34324325', '昆明中油', '', '昆明中油', '昆明中油', '0000-00-00 00:00:00.000000'),
(3, 'user1', '827ccb0eea8a706c4c34a16891f84e7b', 'user1@123.com', '', '344366546', '昆明中油', '', '昆明中油', '昆明中油', '0000-00-00 00:00:00.000000'),
(4, 'user3', 'e10adc3949ba59abbe56e057f20f883e', 'user3@qq.com', '', '677465336', '昆明中油', '', '昆明中油', '昆明中油', '0000-00-00 00:00:00.000000'),
(5, 'user47', 'fcea920f7412b5da7be0cf42b8c93759', 'user5@qq.com', '', '8788645', '昆明中油', '20180403/55d8fe38b984e1e30c19323be4c7cd36.jpg', '昆明中油', '昆明中油', '0000-00-00 00:00:00.000000'),
(6, 'user44', 'fcea920f7412b5da7be0cf42b8c93759', 'user5@qq.com', '', '34215513', '昆明中油', '0', '昆明中油', '昆明中油', '0000-00-00 00:00:00.000000'),
(7, 'YY113345', 'e10adc3949ba59abbe56e057f20f883e', '111@222.com', '13577889909', '1224143324', '昆明中油公司', '', '昆明中油公司', '昆明中油公司', '0000-00-00 00:00:00.000000'),
(8, 'A34566767', 'e10adc3949ba59abbe56e057f20f883e', '111@222.com', '13577889909', '1224143324', '云南省中油公司', '', '云南省中油公司', '云南省中油公司', '0000-00-00 00:00:00.000000'),
(9, 'B88700', 'e10adc3949ba59abbe56e057f20f883e', '111@222.com', '13366788889', '1224143324', '云南省中油公司', '', '云南省中油公司', '云南省中油公司', '0000-00-00 00:00:00.000000'),
(10, 'B88700', 'e10adc3949ba59abbe56e057f20f883e', '111@222.com', '13366788889', '1224143324', '云南省中油公司', '', '云南省中油公司', '云南省中油公司', '0000-00-00 00:00:00.000000'),
(11, 'C222339', 'e10adc3949ba59abbe56e057f20f883e', '111@222.com', '13577889909', '23132132', '云南省中油公司', '', '云南省中油公司', '云南省中油公司', '0000-00-00 00:00:00.000000'),
(12, 'Y33569', 'f0898af949a373e72a4f6a34b4de9090', '111@222.com', '13366788889', '1224143324', '云南中油公司', '', '云南中油公司', '云南中油公司', '0000-00-00 00:00:00.000000'),
(13, 'Y11453TT', 'f0898af949a373e72a4f6a34b4de9090', '111@222.com', '13577889909', '1224143324', '云南省中油公司', '$fname', '云南省中油公司', '云南省中油公司', '0000-00-00 00:00:00.000000'),
(14, 'T332211', 'e10adc3949ba59abbe56e057f20f883e', '111@222.com', '13577889909', '1224143324', '云南省中油公司', NULL, '云南省中油公司', '云南省中油公司', '0000-00-00 00:00:00.000000'),
(15, 'T22443311', 'e10adc3949ba59abbe56e057f20f883e', '122@234.com', '13577889909', '1224143324', '云南省中油公司', '', '云南省中油公司', '云南省中油公司', '0000-00-00 00:00:00.000000'),
(16, 'T554433', 'e10adc3949ba59abbe56e057f20f883e', '111@222.com', '13577889909', '1224143324', '云南省中油公司', '', '云南省中油公司', '云南省中油公司', '0000-00-00 00:00:00.000000'),
(17, 'T665544', 'e10adc3949ba59abbe56e057f20f883e', '111@222.com', '13577889909', '1224143324', '云南省中油公司', NULL, '云南省中油公司', '云南省中油公司', '0000-00-00 00:00:00.000000'),
(18, 'T665511', 'e10adc3949ba59abbe56e057f20f883e', '111@222.com', '13577889909', '1224143324', '云南省中油公司', '20180328/457cfb04cfe7550ce21a5862d3ad9e02.jpg', '云南省中油公司', '云南省中油公司', '0000-00-00 00:00:00.000000'),
(19, 'T6543311', 'e10adc3949ba59abbe56e057f20f883e', '111@222.com', '13577889909', '1224143324', '云南省中油公司', NULL, '云南省中油公司', '云南省中油公司', '0000-00-00 00:00:00.000000'),
(20, 'T6543311', 'e10adc3949ba59abbe56e057f20f883e', '111@222.com', '13577889909', '1224143324', '云南省中油公司', '0', '云南省中油公司', '云南省中油公司', '0000-00-00 00:00:00.000000'),
(21, 'T6543311', 'e10adc3949ba59abbe56e057f20f883e', '111@222.com', '13577889909', '1224143324', '云南省中油公司', NULL, '云南省中油公司', '云南省中油公司', '0000-00-00 00:00:00.000000'),
(22, 'T1234455', 'e10adc3949ba59abbe56e057f20f883e', '111@222.com', '13577889909', '1224143324', '云南省中油公司', '0', '云南省中油公司', '云南省中油公司', '2018-04-04 11:41:32.000000'),
(23, 'T19901234', 'e10adc3949ba59abbe56e057f20f883e', '111@222.com', '13577889909', '1224143324', '云南省中油公司', '20180404/1c983e35e1b662438fac2a9da74f7d70.jpg', '云南省中油公司', '云南省中油公司', '2018-04-04 11:40:22.000000');

-- --------------------------------------------------------

--
-- 表的结构 `zk_webinfo`
--

DROP TABLE IF EXISTS `zk_webinfo`;
CREATE TABLE IF NOT EXISTS `zk_webinfo` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `s_maintitle` varchar(50) COLLATE utf8_bin NOT NULL,
  `s_logo` varchar(50) COLLATE utf8_bin NOT NULL,
  `s_url` varchar(20) COLLATE utf8_bin NOT NULL,
  `s_subtitle` varchar(50) COLLATE utf8_bin NOT NULL,
  `s_keywords` varchar(50) COLLATE utf8_bin NOT NULL,
  `s_description` varchar(100) COLLATE utf8_bin NOT NULL,
  `s_name` varchar(50) COLLATE utf8_bin NOT NULL,
  `s_phone` varchar(15) COLLATE utf8_bin NOT NULL,
  `s_tel` varchar(15) COLLATE utf8_bin NOT NULL,
  `s_400` varchar(15) COLLATE utf8_bin NOT NULL,
  `s_fax` varchar(20) COLLATE utf8_bin NOT NULL,
  `s_qq` varchar(20) COLLATE utf8_bin NOT NULL,
  `s_qqu` varchar(20) COLLATE utf8_bin NOT NULL,
  `s_email` varchar(25) COLLATE utf8_bin NOT NULL,
  `s_address` varchar(50) COLLATE utf8_bin NOT NULL,
  `s_copyright` varchar(100) COLLATE utf8_bin NOT NULL,
  UNIQUE KEY `ID_Index` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `zk_webinfo`
--

INSERT INTO `zk_webinfo` (`id`, `s_maintitle`, `s_logo`, `s_url`, `s_subtitle`, `s_keywords`, `s_description`, `s_name`, `s_phone`, `s_tel`, `s_400`, `s_fax`, `s_qq`, `s_qqu`, `s_email`, `s_address`, `s_copyright`) VALUES
(1, '油库发油承运人信息管理系统', '', '192.168.0.100', '油库发油承运人信息管理系统', '油库发油承运人信息管理系统', '油库发油承运人信息管理系统', '昆明油库', '1223457675', '0871-64669063', '4009906543', '0871-64669063', '1122313', '2323244543', '111@222.com', '昆明油库', '中国石油昆明销售分公司');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
