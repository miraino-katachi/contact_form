--
-- テーブルの構造 `postal_code`
--

CREATE TABLE `postal_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key COMMENT 'ID',
  `postal_code` char(7) NOT NULL COMMENT '郵便番号',
  `prefecture` varchar(10) NOT NULL COMMENT '都道府県名',
  `address1` varchar(100) NOT NULL COMMENT '住所1（市区町村）',
  `address2` varchar(100) NOT NULL COMMENT '住所2（町名・番地等）'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='郵便番号';
