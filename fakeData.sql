-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2024 年 06 月 03 日 17:07
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `fakeData`
--

-- --------------------------------------------------------

--
-- 資料表結構 `cosmetic`
--

CREATE TABLE `cosmetic` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `cosmetic`
--

INSERT INTO `cosmetic` (`id`, `product_name`, `product_code`, `start_date`, `end_date`) VALUES
(1, '美白精華液', 'P001', '2023-01-01 08:00:00', '2023-06-01 18:00:00'),
(2, '保濕面霜', 'P002', '2023-02-15 09:00:00', NULL),
(3, '防曬乳液', 'P003', '2023-03-01 10:00:00', NULL),
(4, '抗皺眼霜', 'P004', '2023-04-10 11:00:00', '2023-10-10 17:00:00'),
(5, '深層潔面乳', 'P005', '2023-05-05 12:00:00', NULL),
(6, '舒緩面膜', 'P006', '2023-06-20 13:00:00', '2023-12-20 19:00:00'),
(7, '緊緻精華液', 'P007', '2023-07-01 14:00:00', NULL),
(8, '抗氧化乳液', 'P008', '2023-08-15 15:00:00', '2024-01-15 20:00:00'),
(9, '美白面膜', 'P009', '2023-09-01 16:00:00', NULL),
(10, '抗痘精華', 'P010', '2023-10-10 17:00:00', NULL),
(11, '亮膚精華', 'P011', '2023-11-01 18:00:00', '2024-05-01 21:00:00'),
(12, '深層保濕乳', 'P012', '2023-12-15 19:00:00', NULL),
(13, '緊膚面膜', 'P013', '2024-01-20 08:30:00', NULL),
(14, '眼部修護霜', 'P014', '2024-02-10 09:30:00', '2024-08-10 22:00:00'),
(15, '舒敏修護乳', 'P015', '2024-03-01 10:30:00', NULL),
(16, '提亮面霜', 'P016', '2024-04-20 11:30:00', NULL),
(17, '去角質凝膠', 'P017', '2024-05-15 12:30:00', '2024-11-15 23:00:00'),
(18, '淨膚爽膚水', 'P018', '2024-06-01 13:30:00', NULL),
(19, '舒緩精華', 'P019', '2024-07-10 14:30:00', NULL),
(20, '補水保濕噴霧', 'P020', '2024-08-05 15:30:00', NULL),
(21, '抗敏感精華', 'P021', '2024-09-01 16:30:00', NULL),
(22, '控油面霜', 'P022', '2024-10-10 17:30:00', '2025-04-10 23:30:00'),
(23, '美白保濕霜', 'P023', '2024-11-01 18:30:00', NULL),
(24, '防曬噴霧', 'P024', '2024-12-15 19:30:00', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `cosmetic_img`
--

CREATE TABLE `cosmetic_img` (
  `id` int(11) NOT NULL,
  `cosmetic_id` int(11) NOT NULL,
  `img_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `cosmetic_img`
--

INSERT INTO `cosmetic_img` (`id`, `cosmetic_id`, `img_url`) VALUES
(1, 1, 'https://images.pexels.com/photos/22475639/pexels-photo-22475639.jpeg'),
(2, 1, 'https://images.pexels.com/photos/22884570/pexels-photo-22884570.jpeg'),
(3, 2, 'https://images.pexels.com/photos/3685530/pexels-photo-3685530.jpeg'),
(4, 2, 'https://images.pexels.com/photos/3865694/pexels-photo-3865694.jpeg'),
(5, 2, 'https://images.pexels.com/photos/3865692/pexels-photo-3865692.jpeg'),
(6, 3, 'https://images.pexels.com/photos/2110489/pexels-photo-2110489.jpeg'),
(7, 3, 'https://images.pexels.com/photos/2110490/pexels-photo-2110490.jpeg'),
(8, 3, 'https://images.pexels.com/photos/2331085/pexels-photo-2331085.jpeg'),
(9, 4, 'https://images.pexels.com/photos/3993217/pexels-photo-3993217.jpeg'),
(10, 4, 'https://images.pexels.com/photos/4127627/pexels-photo-4127627.jpeg'),
(11, 5, 'https://images.pexels.com/photos/2363809/pexels-photo-2363809.jpeg'),
(12, 5, 'https://images.pexels.com/photos/2363825/pexels-photo-2363825.jpeg'),
(13, 6, 'https://images.pexels.com/photos/1082529/pexels-photo-1082529.jpeg'),
(14, 6, 'https://images.pexels.com/photos/1667506/pexels-photo-1667506.jpeg'),
(15, 6, 'https://images.pexels.com/photos/1586219/pexels-photo-1586219.jpeg'),
(16, 7, 'https://images.pexels.com/photos/2437902/pexels-photo-2437902.jpeg'),
(17, 7, 'https://images.pexels.com/photos/2437898/pexels-photo-2437898.jpeg'),
(18, 8, 'https://images.pexels.com/photos/3735288/pexels-photo-3735288.jpeg'),
(19, 8, 'https://images.pexels.com/photos/4114710/pexels-photo-4114710.jpeg'),
(20, 9, 'https://images.pexels.com/photos/2363805/pexels-photo-2363805.jpeg'),
(21, 9, 'https://images.pexels.com/photos/20463678/pexels-photo-20463678.jpeg'),
(22, 10, 'https://images.pexels.com/photos/2387949/pexels-photo-2387949.jpeg'),
(23, 10, 'https://images.pexels.com/photos/2387965/pexels-photo-2387965.jpeg'),
(24, 11, 'https://images.pexels.com/photos/14004496/pexels-photo-14004496.jpeg'),
(25, 11, 'https://images.pexels.com/photos/2645486/pexels-photo-2645486.jpeg'),
(26, 12, 'https://images.pexels.com/photos/3989869/pexels-photo-3989869.jpeg'),
(27, 12, 'https://images.pexels.com/photos/3989875/pexels-photo-3989875.jpeg'),
(28, 13, 'https://images.pexels.com/photos/4099141/pexels-photo-4099141.jpeg'),
(29, 13, 'https://images.pexels.com/photos/4099144/pexels-photo-4099144.jpeg'),
(30, 14, 'https://images.pexels.com/photos/4099153/pexels-photo-4099153.jpeg'),
(31, 14, 'https://images.pexels.com/photos/4099161/pexels-photo-4099161.jpeg'),
(32, 15, 'https://images.pexels.com/photos/3726840/pexels-photo-3726840.jpeg'),
(33, 15, 'https://images.pexels.com/photos/3735291/pexels-photo-3735291.jpeg'),
(34, 16, 'https://images.pexels.com/photos/3726842/pexels-photo-3726842.jpeg'),
(35, 16, 'https://images.pexels.com/photos/3726707/pexels-photo-3726707.jpeg'),
(36, 17, 'https://images.pexels.com/photos/3735324/pexels-photo-3735324.jpeg'),
(37, 17, 'https://images.pexels.com/photos/3726713/pexels-photo-3726713.jpeg'),
(38, 18, 'https://images.pexels.com/photos/3687510/pexels-photo-3687510.jpeg'),
(39, 18, 'https://images.pexels.com/photos/3974358/pexels-photo-3974358.jpeg'),
(40, 19, 'https://images.pexels.com/photos/20477201/pexels-photo-20477201.jpeg'),
(41, 19, 'https://images.pexels.com/photos/2801525/pexels-photo-2801525.jpeg'),
(42, 20, 'https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg'),
(43, 20, 'https://images.pexels.com/photos/7322203/pexels-photo-7322203.jpeg'),
(44, 21, 'https://images.pexels.com/photos/19793809/pexels-photo-19793809.jpeg'),
(45, 21, 'https://images.pexels.com/photos/2801529/pexels-photo-2801529.jpeg'),
(46, 22, 'https://images.pexels.com/photos/2801530/pexels-photo-2801530.jpeg'),
(47, 22, 'https://images.pexels.com/photos/7549536/pexels-photo-7549536.jpeg'),
(48, 23, 'https://images.pexels.com/photos/837306/pexels-photo-837306.jpeg'),
(49, 23, 'https://images.pexels.com/photos/845457/pexels-photo-845457.jpeg'),
(50, 24, 'https://images.pexels.com/photos/2801534/pexels-photo-2801534.jpeg'),
(51, 24, 'https://images.pexels.com/photos/2801535/pexels-photo-2801535.jpeg'),
(52, 24, 'https://images.pexels.com/photos/2801536/pexels-photo-2801536.jpeg');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `cosmetic`
--
ALTER TABLE `cosmetic`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `cosmetic_img`
--
ALTER TABLE `cosmetic_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cosmetic_id` (`cosmetic_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cosmetic`
--
ALTER TABLE `cosmetic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `cosmetic_img`
--
ALTER TABLE `cosmetic_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `cosmetic_img`
--
ALTER TABLE `cosmetic_img`
  ADD CONSTRAINT `cosmetic_img_ibfk_1` FOREIGN KEY (`cosmetic_id`) REFERENCES `cosmetic` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
