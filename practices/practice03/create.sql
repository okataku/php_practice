--
-- テーブルの構造 `human`
--

DROP TABLE IF EXISTS `human`;
CREATE TABLE IF NOT EXISTS `human` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'IDです。',
  `name` varchar(32) NOT NULL COMMENT '氏名です。',
  `sex` tinyint(1) NOT NULL COMMENT '性別です。trueを男性、falseを女性とします。',
  `birthday` date NOT NULL COMMENT '生年月日です。',
  `height` decimal(3,1) NOT NULL COMMENT '身長です。',
  `weight` decimal(3,1) NOT NULL COMMENT '体重です。',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='人の情報を管理します。' AUTO_INCREMENT=1 ;
