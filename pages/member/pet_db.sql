-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.10-MariaDB
-- PHP 版本： 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `pet_db`
--

-- --------------------------------------------------------

--
-- 資料表結構 `class`
--

CREATE TABLE `class` (
  `cId` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '類別編號',
  `cName` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '類別名稱',
  `cParrentId` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '上層編號',
  `create_at` datetime DEFAULT current_timestamp() COMMENT '新增時間',
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `class`
--

INSERT INTO `class` (`cId`, `cName`, `cParrentId`, `create_at`, `update_at`) VALUES
('c001', '食品', '0', '2020-01-07 10:08:00', '2020-01-07 10:08:00'),
('c002', '用品', '0', '2020-01-07 10:08:00', '2020-01-07 10:08:00'),
('c003', '外出用品', '0', '2020-01-07 10:08:00', '2020-01-07 10:08:00'),
('c004', '清潔用品', '0', '2020-01-07 10:08:00', '2020-01-07 10:08:00'),
('c005', '罐頭', 'c001', '2020-01-07 10:08:00', '2020-01-07 10:08:00');

-- --------------------------------------------------------

--
-- 資料表結構 `dog`
--

CREATE TABLE `dog` (
  `dId` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dName` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mId` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dGender` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dAge` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dWeight` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dInfo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `dog`
--

INSERT INTO `dog` (`dId`, `dName`, `mId`, `dGender`, `dAge`, `dWeight`, `dInfo`, `create_at`, `update_at`) VALUES
('d001', 'Sunny', 'm001', 'female', '11y', '8', '喜樂蒂 活潑好動愛吃', '2020-01-07 09:59:36', '2020-01-07 09:59:36');

-- --------------------------------------------------------

--
-- 資料表結構 `marketing`
--

CREATE TABLE `marketing` (
  `mkId` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '行銷編號',
  `mkName` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '行銷名稱',
  `mkType` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '行銷種類',
  `pClass` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '折扣商品類別',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `marketing`
--

INSERT INTO `marketing` (`mkId`, `mkName`, `mkType`, `pClass`, `created_at`, `updated_at`) VALUES
('mk001', '周年慶', 'mt001', 'all', '2020-01-07 10:18:08', '2020-01-07 10:23:22'),
('mk002', '推車折扣券', 'mk002', 'c005', '2020-01-07 10:24:18', '2020-01-07 10:24:18');

-- --------------------------------------------------------

--
-- 資料表結構 `marketing_type`
--

CREATE TABLE `marketing_type` (
  `mtId` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '類別編號',
  `mtName` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '種類名稱',
  `mtDiscount%` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '折扣%數',
  `mtDiscount` varchar(7) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '折扣金額',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `marketing_type`
--

INSERT INTO `marketing_type` (`mtId`, `mtName`, `mtDiscount%`, `mtDiscount`, `created_at`, `updated_at`) VALUES
('mt001', '全面折扣', '70', NULL, '2020-01-07 10:20:13', '2020-01-07 10:20:13'),
('mt002', '優惠券10%', '90', NULL, '2020-01-07 10:21:03', '2020-01-07 10:21:03'),
('mt003', '優惠券折100', '', '100', '2020-01-07 10:21:34', '2020-01-07 10:22:57');

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `mId` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '會員編號',
  `mName` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '會員姓名',
  `mAccount` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '會員帳號',
  `mPassword` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '會員密碼',
  `mGender` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '會員性別',
  `mBday` date DEFAULT NULL COMMENT '會員生日',
  `mPhone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '會員電話',
  `mEmail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '會員信箱',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`mId`, `mName`, `mAccount`, `mPassword`, `mGender`, `mBday`, `mPhone`, `mEmail`, `created_at`, `updated_at`) VALUES
('m001', '王大明', 'wang19881221', 'wang19881221', 'male', '1988-12-21', '0919881221', '19881221@gmail.com', '2020-01-07 10:10:46', '2020-01-07 10:10:46');

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE `product` (
  `pId` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品編號',
  `pName` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品名稱',
  `pClass` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品類別',
  `pPrice` int(6) NOT NULL COMMENT '商品價格',
  `pDiscount` int(3) DEFAULT NULL COMMENT '商品折扣',
  `pImg` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品圖片',
  `pInfo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品描述',
  `pQuantity` int(3) NOT NULL COMMENT '商品數量',
  `pShelvesTime` datetime NOT NULL COMMENT '上架時間',
  `pUnshelvesTime` datetime NOT NULL COMMENT '下架時間',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `product`
--

INSERT INTO `product` (`pId`, `pName`, `pClass`, `pPrice`, `pDiscount`, `pImg`, `pInfo`, `pQuantity`, `pShelvesTime`, `pUnshelvesTime`, `created_at`, `updated_at`) VALUES
('p001', '推車', 'c005', 7900, NULL, 'p001', '無敵推車', 100, '2020-01-10 00:00:00', '2021-01-05 00:00:00', '2020-01-07 10:12:09', '2020-01-07 10:12:09');

-- --------------------------------------------------------

--
-- 資料表結構 `service`
--

CREATE TABLE `service` (
  `sId` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '業者編號',
  `sName` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '業者姓名',
  `sAccount` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '業者帳號',
  `sPassword` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '業者密碼',
  `sType` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '業者類型',
  `sPhone` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '業者電話',
  `sEmail` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '業者信箱',
  `created_at` datetime DEFAULT current_timestamp() COMMENT '新增時間',
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `service`
--

INSERT INTO `service` (`sId`, `sName`, `sAccount`, `sPassword`, `sType`, `sPhone`, `sEmail`, `created_at`, `updated_at`) VALUES
('s001', 'Peter', 'peter19921111', 'peter19921111', '保母', '0919921111', '0919921111@gmail.com', '2020-01-07 10:14:36', '2020-01-07 10:14:36');

-- --------------------------------------------------------

--
-- 資料表結構 `vendor`
--

CREATE TABLE `vendor` (
  `vId` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '廠商編號',
  `vName` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '廠商名稱',
  `vAccount` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '廠商帳號',
  `vPassword` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '廠商密碼',
  `vPhone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '廠商電話',
  `vAddress` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '廠商地址',
  `vWeb` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '廠商官網',
  `vEmail` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '廠商信箱',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT '新增時間',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `vendor`
--

INSERT INTO `vendor` (`vId`, `vName`, `vAccount`, `vPassword`, `vPhone`, `vAddress`, `vWeb`, `vEmail`, `created_at`, `updated_at`) VALUES
('v001', 'ibiyaya', 'ibiyaya1001', 'ibiyaya1001', '0910100110', NULL, NULL, 'ibiyaya1001@gmail.com', '2020-01-07 10:17:15', '2020-01-07 10:17:15');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`cId`);

--
-- 資料表索引 `dog`
--
ALTER TABLE `dog`
  ADD PRIMARY KEY (`dId`);

--
-- 資料表索引 `marketing`
--
ALTER TABLE `marketing`
  ADD PRIMARY KEY (`mkId`);

--
-- 資料表索引 `marketing_type`
--
ALTER TABLE `marketing_type`
  ADD PRIMARY KEY (`mtId`);

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`mId`,`mAccount`,`mEmail`);

--
-- 資料表索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pId`);

--
-- 資料表索引 `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`sId`,`sAccount`);

--
-- 資料表索引 `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
