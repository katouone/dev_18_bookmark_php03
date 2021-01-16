-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2021 年 1 月 16 日 00:53
-- サーバのバージョン： 5.7.30
-- PHP のバージョン: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `php03_kadai`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `php03_needs_table`
--

CREATE TABLE `php03_needs_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `country` varchar(64) NOT NULL,
  `scene` text NOT NULL,
  `type` varchar(64) NOT NULL,
  `content` text NOT NULL,
  `url` text NOT NULL,
  `indate` datetime NOT NULL,
  `lat` text NOT NULL,
  `lng` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `php03_needs_table`
--

INSERT INTO `php03_needs_table` (`id`, `name`, `country`, `scene`, `type`, `content`, `url`, `indate`, `lat`, `lng`) VALUES
(1, 'AAA', 'マラウィ', '医療', '困りごと', '病院内にどのような部署があるのかわからない', 'https://world-diary.jica.go.jp/sunadasachie/activity/post_1.php', '2021-01-09 06:29:07', '', ''),
(2, 'AAA', 'マラウィ', '医療', '驚いたこと', '病棟は部門によってはかなり近代的で、冷蔵庫が設置されている病棟も少なくない。透析室もあり、癌化学療法も行われている。', 'https://world-diary.jica.go.jp/sunadasachie/activity/post_1.php', '2021-01-09 06:59:56', '', ''),
(3, 'BBB', 'マラウィ', '医療', '困りごと', 'ベッドも日本のように決まっておらず、小児病棟では1つのベッドに赤ちゃんが3人寝ていることは普通', 'https://world-diary.jica.go.jp/sunadasachie/activity/post_1.php', '2021-01-09 07:21:23', '', ''),
(4, 'CCC', 'ガーナ', '街中', '驚いたこと', '近代的なスーパーマーケットがあった\r\n大きかった', '', '2021-01-16 04:05:20', '', ''),
(6, 'DDD', 'ガーナ', '街中', '驚いたこと', '広い道路がたくさんあって、渋滞中に行商がいろいろ売りに来る', '', '2021-01-16 09:01:37', '38.9422695', '-77.0681745'),
(7, 'EEE', 'ブダペスト', '街中', '驚いたこと', '温泉がある', '', '2021-01-16 09:09:00', '47.5003838', '19.0529735');

-- --------------------------------------------------------

--
-- テーブルの構造 `php03_user_table`
--

CREATE TABLE `php03_user_table` (
  `id` int(12) NOT NULL,
  `name` varchar(64) NOT NULL,
  `lid` varchar(128) NOT NULL,
  `lpw` varchar(64) NOT NULL,
  `kanri_flg` int(1) NOT NULL,
  `life_flg` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `php03_user_table`
--

INSERT INTO `php03_user_table` (`id`, `name`, `lid`, `lpw`, `kanri_flg`, `life_flg`) VALUES
(1, 'AAA', 'AA', '1234', 0, 1),
(2, 'bbb', 'B', 'abcd', 0, 0),
(3, 'A', 'A', 'A', 1, 1),
(4, 'A', 'A', '1234', 1, 1),
(6, 'A', 'A', '1234', 0, 1);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `php03_needs_table`
--
ALTER TABLE `php03_needs_table`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `php03_user_table`
--
ALTER TABLE `php03_user_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `php03_needs_table`
--
ALTER TABLE `php03_needs_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- テーブルのAUTO_INCREMENT `php03_user_table`
--
ALTER TABLE `php03_user_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
