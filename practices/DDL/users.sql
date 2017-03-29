-- phpMyAdmin SQL Dump
-- version 4.0.1
-- http://www.phpmyadmin.net
--
-- ホスト: 175.184.33.60
-- 生成日時: 2013 年 10 月 10 日 17:56
-- サーバのバージョン: 5.5.18-log
-- PHP のバージョン: 5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `cp9h7pt_ate`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(64) NOT NULL COMMENT 'IDです。',
  `name` varchar(128) NOT NULL COMMENT '氏名です。',
  `password` varchar(64) NOT NULL COMMENT 'パスワードです。',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ユーザーを管理します。';

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
('admin', 'セントラルソフトサービス', 'c7a628cba22e28eb17b5f5c6ae2a266a'),
('matsui', '松井沙織', 'ddb9f30836544288e9b45d114206be9a'),
('ogiso', '小木曽優希', '0c9203efb4353f549398102abaffc67a');