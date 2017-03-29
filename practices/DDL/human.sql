-- phpMyAdmin SQL Dump
-- version 4.0.1
-- http://www.phpmyadmin.net
--
-- ホスト: 175.184.33.60
-- 生成日時: 2013 年 10 月 10 日 17:57
-- サーバのバージョン: 5.5.18-log
-- PHP のバージョン: 5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `cp9h7pt_ate`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `human`
--

CREATE TABLE IF NOT EXISTS `human` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'IDです。',
  `name` varchar(32) NOT NULL COMMENT '氏名です。',
  `sex` tinyint(1) NOT NULL COMMENT '性別です。trueを男性、falseを女性とします。',
  `birthday` date NOT NULL COMMENT '生年月日です。',
  `height` decimal(4,1) NOT NULL COMMENT '身長です。',
  `weight` decimal(4,1) NOT NULL COMMENT '体重です。',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='人の情報を管理します。' AUTO_INCREMENT=22 ;
