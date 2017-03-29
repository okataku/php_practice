-- phpMyAdmin SQL Dump
-- version 4.0.1
-- http://www.phpmyadmin.net
--
-- ホスト: 175.184.33.60
-- 生成日時: 2013 年 10 月 10 日 17:58
-- サーバのバージョン: 5.5.18-log
-- PHP のバージョン: 5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `cp9h7pt_ate`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `entries`
--

CREATE TABLE IF NOT EXISTS `entries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(64) NOT NULL,
  `message` text,
  `image` varchar(256) NOT NULL,
  `thumbnail` varchar(256) NOT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;
