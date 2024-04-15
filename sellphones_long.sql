-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 22, 2023 lúc 05:10 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `sellphones`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute`
--

CREATE TABLE `attribute` (
  `aid` int(11) NOT NULL,
  `pid` int(11) DEFAULT NULL,
  `aname` varchar(20) NOT NULL,
  `avalue` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `attribute`
--

INSERT INTO `attribute` (`aid`, `pid`, `aname`, `avalue`) VALUES
(1, 1, 'Màn hình', 'OLED, 5.8\", Super Retina'),
(2, 1, 'Hệ điều hành', 'iOS 11'),
(3, 1, 'Camera sau', '2 camera 12 MP'),
(4, 1, 'Camera trước', '7 MP'),
(5, 1, 'CPU', 'Apple A11 Bionic 6 nhân'),
(6, 1, 'RAM', '3 GB'),
(7, 1, 'Bộ nhớ trong', '256 GB'),
(8, 1, 'Thẻ nhớ', 'Không'),
(9, 1, 'Dung lượng pin', '2716 mAh, có sạc nhanh'),
(10, 2, 'Màn hình', 'OLED, 6.1\", Super Retina XDR'),
(11, 2, 'Hệ điều hành', 'iOS 15'),
(12, 2, 'Camera sau', '12 MP (Wide), 12 MP (Ultrawide), 12 MP (Telephoto)'),
(13, 2, 'Camera trước', '12 MP'),
(14, 2, 'CPU', 'Apple A15 Bionic 6-core'),
(15, 2, 'RAM', '4 GB'),
(16, 2, 'Bộ nhớ trong', '128 GB'),
(17, 2, 'Thẻ nhớ', 'Không'),
(18, 2, 'Dung lượng pin', '3210 mAh, có sạc nhanh'),
(19, 3, 'Màn hình', 'AMOLED, 6.4\", 90Hz'),
(20, 3, 'Hệ điều hành', 'ColorOS 12 (Android 12)'),
(21, 3, 'Camera sau', '64 MP (Wide), 8 MP (Ultrawide), 2 MP (Macro)'),
(22, 3, 'Camera trước', '32 MP'),
(23, 3, 'CPU', 'Qualcomm Snapdragon 778G'),
(24, 3, 'RAM', '6 GB'),
(25, 3, 'Bộ nhớ trong', '128 GB'),
(26, 3, 'Thẻ nhớ', 'MicroSD, lên đến 1 TB'),
(27, 3, 'Dung lượng pin', '4500 mAh, có sạc nhanh'),
(28, 4, 'Màn hình', 'IPS LCD, 6.5\", 120Hz'),
(29, 4, 'Hệ điều hành', 'MIUI 13 (Android 12)'),
(30, 4, 'Camera sau', '108 MP (Wide), 8 MP (Ultrawide), 2 MP (Depth)'),
(31, 4, 'Camera trước', '16 MP'),
(32, 4, 'CPU', 'Qualcomm Snapdragon 750G'),
(33, 4, 'RAM', '6 GB'),
(34, 4, 'Bộ nhớ trong', '128 GB'),
(35, 4, 'Thẻ nhớ', 'MicroSD, lên đến 512 GB'),
(36, 4, 'Dung lượng pin', '5000 mAh, có sạc nhanh'),
(37, 5, 'Màn hình', 'OLED, 6.7\", 120Hz'),
(38, 5, 'Hệ điều hành', 'EMUI 12 (Android 13)'),
(39, 5, 'Camera sau', '50 MP (Wide), 40 MP (Ultrawide), 12 MP (Periscope)'),
(40, 5, 'Camera trước', '32 MP'),
(41, 5, 'CPU', 'Huawei Kirin 9000'),
(42, 5, 'RAM', '8 GB'),
(43, 5, 'Bộ nhớ trong', '256 GB'),
(44, 5, 'Thẻ nhớ', 'Nano Memory, lên đến 256 GB'),
(45, 5, 'Dung lượng pin', '4500 mAh, có sạc nhanh'),
(46, 6, 'Màn hình', 'AMOLED, 6.5\", 90Hz'),
(47, 6, 'Hệ điều hành', 'Funtouch OS 12 (Android 13)'),
(48, 6, 'Camera sau', '64 MP (Wide), 8 MP (Ultrawide), 5 MP (Depth)'),
(49, 6, 'Camera trước', '44 MP'),
(50, 6, 'CPU', 'Qualcomm Snapdragon 888'),
(51, 6, 'RAM', '12 GB'),
(52, 6, 'Bộ nhớ trong', '256 GB'),
(53, 6, 'Thẻ nhớ', 'Không'),
(54, 6, 'Dung lượng pin', '4000 mAh, có sạc nhanh'),
(55, 7, 'Màn hình', 'Super AMOLED, 6.43\", 120Hz'),
(56, 7, 'Hệ điều hành', 'Realme UI 3.0 (Android 13)'),
(57, 7, 'Camera sau', '108 MP (Wide), 8 MP (Ultrawide), 2 MP (Macro)'),
(58, 7, 'Camera trước', '16 MP'),
(59, 7, 'CPU', 'Qualcomm Snapdragon 870'),
(60, 7, 'RAM', '8 GB'),
(61, 7, 'Bộ nhớ trong', '128 GB'),
(62, 7, 'Thẻ nhớ', 'MicroSD, lên đến 1 TB'),
(63, 7, 'Dung lượng pin', '4500 mAh, có sạc nhanh'),
(64, 8, 'Màn hình', 'Fluid AMOLED, 6.7\", 120Hz'),
(65, 8, 'Hệ điều hành', 'OxygenOS 12 (Android 13)'),
(66, 8, 'Camera sau', '48 MP (Wide), 50 MP (Ultrawide), 8 MP (Telephoto)'),
(67, 8, 'Camera trước', '16 MP'),
(68, 8, 'CPU', 'Qualcomm Snapdragon 888'),
(69, 8, 'RAM', '12 GB'),
(70, 8, 'Bộ nhớ trong', '256 GB'),
(71, 8, 'Thẻ nhớ', 'Không'),
(72, 8, 'Dung lượng pin', '4500 mAh, có sạc nhanh'),
(73, 9, 'Màn hình', 'OLED, 6.5\", 120Hz'),
(74, 9, 'Hệ điều hành', 'Android 14'),
(75, 9, 'Camera sau', 'Triple 12 MP (Wide), 12 MP (Telephoto), 12 MP (Ult'),
(76, 9, 'Camera trước', '8 MP'),
(77, 9, 'CPU', 'Apple A15 Bionic'),
(78, 9, 'RAM', '4 GB'),
(79, 9, 'Bộ nhớ trong', '64 GB'),
(80, 9, 'Thẻ nhớ', 'Không'),
(81, 9, 'Dung lượng pin', '3000 mAh, có sạc nhanh'),
(82, 10, 'Màn hình', 'IPS LCD, 6.8\"'),
(83, 10, 'Hệ điều hành', 'Android 13'),
(84, 10, 'Camera sau', 'Quad 64 MP (Wide), 8 MP (Ultrawide), 2 MP (Macro),'),
(85, 10, 'Camera trước', '16 MP'),
(86, 10, 'CPU', 'Qualcomm Snapdragon 690'),
(87, 10, 'RAM', '6 GB'),
(88, 10, 'Bộ nhớ trong', '128 GB'),
(89, 10, 'Thẻ nhớ', 'MicroSD, lên đến 512 GB'),
(90, 10, 'Dung lượng pin', '5000 mAh, có sạc nhanh'),
(91, 11, 'Màn hình', 'Super AMOLED, 6.1\", 60Hz'),
(92, 11, 'Hệ điều hành', 'iOS 16'),
(93, 11, 'Camera sau', 'Dual 12 MP (Wide), 12 MP (Ultrawide)'),
(94, 11, 'Camera trước', '7 MP'),
(95, 11, 'CPU', 'Apple A15 Bionic'),
(96, 11, 'RAM', '4 GB'),
(97, 11, 'Bộ nhớ trong', '64 GB'),
(98, 11, 'Thẻ nhớ', 'Không'),
(99, 11, 'Dung lượng pin', '2942 mAh, có sạc nhanh'),
(100, 12, 'Màn hình', 'AMOLED, 6.5\", 90Hz'),
(101, 12, 'Hệ điều hành', 'Android 14'),
(102, 12, 'Camera sau', 'Quad 64 MP (Wide), 8 MP (Ultrawide), 2 MP (Depth),'),
(103, 12, 'Camera trước', '16 MP'),
(104, 12, 'CPU', 'MediaTek Dimensity 900'),
(105, 12, 'RAM', '6 GB'),
(106, 12, 'Bộ nhớ trong', '128 GB'),
(107, 12, 'Thẻ nhớ', 'MicroSD, lên đến 512 GB'),
(108, 12, 'Dung lượng pin', '5000 mAh, có sạc nhanh'),
(109, 13, 'Màn hình', 'Super AMOLED, 6.9\", 120Hz'),
(110, 13, 'Hệ điều hành', 'Android 15'),
(111, 13, 'Camera sau', 'Triple 108 MP (Wide), 12 MP (Periscope Telephoto),'),
(112, 13, 'Camera trước', '40 MP'),
(113, 13, 'CPU', 'Exynos 2200'),
(114, 13, 'RAM', '12 GB'),
(115, 13, 'Bộ nhớ trong', '512 GB'),
(116, 13, 'Thẻ nhớ', 'MicroSD, lên đến 1 TB'),
(117, 13, 'Dung lượng pin', '5000 mAh, có sạc nhanh'),
(118, 14, 'Màn hình', 'Super AMOLED, 6.5\", 120Hz'),
(119, 14, 'Hệ điều hành', 'Android 14'),
(120, 14, 'Camera sau', 'Quad 108 MP (Wide), 16 MP (Ultrawide), 5 MP (Depth'),
(121, 14, 'Camera trước', '32 MP'),
(122, 14, 'CPU', 'Snapdragon 888+'),
(123, 14, 'RAM', '8 GB'),
(124, 14, 'Bộ nhớ trong', '256 GB'),
(125, 14, 'Thẻ nhớ', 'MicroSD, lên đến 512 GB'),
(126, 14, 'Dung lượng pin', '4500 mAh, có sạc nhanh'),
(127, 15, 'Màn hình', 'Super Retina XDR OLED, 6.7\", 120Hz'),
(128, 15, 'Hệ điều hành', 'iOS 16'),
(129, 15, 'Camera sau', 'Triple 12 MP (Wide), 12 MP (Telephoto), 12 MP (Ult'),
(130, 15, 'Camera trước', '12 MP'),
(131, 15, 'CPU', 'Apple A15 Bionic'),
(132, 15, 'RAM', '6 GB'),
(133, 15, 'Bộ nhớ trong', '128 GB'),
(134, 15, 'Thẻ nhớ', 'Không'),
(135, 15, 'Dung lượng pin', '4352 mAh, có sạc nhanh'),
(136, 16, 'Màn hình', 'AMOLED, 6.9\", 120Hz'),
(137, 16, 'Hệ điều hành', 'Android 15'),
(138, 16, 'Camera sau', 'Triple 64 MP (Wide), 12 MP (Periscope Telephoto), '),
(139, 16, 'Camera trước', '40 MP'),
(140, 16, 'CPU', 'Exynos 990'),
(141, 16, 'RAM', '12 GB'),
(142, 16, 'Bộ nhớ trong', '256 GB'),
(143, 16, 'Thẻ nhớ', 'MicroSD, lên đến 1 TB'),
(144, 16, 'Dung lượng pin', '5000 mAh, có sạc nhanh'),
(145, 17, 'Màn hình', 'Super AMOLED, 6.6\", 90Hz'),
(146, 17, 'Hệ điều hành', 'Android 14'),
(147, 17, 'Camera sau', 'Quad 108 MP (Wide), 8 MP (Periscope Telephoto), 12'),
(148, 17, 'Camera trước', '32 MP'),
(149, 17, 'CPU', 'Snapdragon 888'),
(150, 17, 'RAM', '8 GB'),
(151, 17, 'Bộ nhớ trong', '128 GB'),
(152, 17, 'Thẻ nhớ', 'MicroSD, lên đến 512 GB'),
(153, 17, 'Dung lượng pin', '4500 mAh, có sạc nhanh'),
(154, 18, 'Màn hình', 'Super AMOLED, 6.7\", 120Hz'),
(155, 18, 'Hệ điều hành', 'Android 13'),
(156, 18, 'Camera sau', 'Triple 48 MP (Wide), 8 MP (Telephoto), 16 MP (Ultr'),
(157, 18, 'Camera trước', '32 MP'),
(158, 18, 'CPU', 'Snapdragon 870'),
(159, 18, 'RAM', '6 GB'),
(160, 18, 'Bộ nhớ trong', '128 GB'),
(161, 18, 'Thẻ nhớ', 'MicroSD, lên đến 512 GB'),
(162, 18, 'Dung lượng pin', '4000 mAh, có sạc nhanh'),
(163, 19, 'Màn hình', 'LCD, 6.4\", 90Hz'),
(164, 19, 'Hệ điều hành', 'Android 12'),
(165, 19, 'Camera sau', 'Dual 64 MP (Wide), 8 MP (Ultrawide)'),
(166, 19, 'Camera trước', '32 MP'),
(167, 19, 'CPU', 'MediaTek Helio G90T'),
(168, 19, 'RAM', '8 GB'),
(169, 19, 'Bộ nhớ trong', '64 GB'),
(170, 19, 'Thẻ nhớ', 'MicroSD, lên đến 256 GB'),
(171, 19, 'Dung lượng pin', '5000 mAh, có sạc nhanh'),
(172, 20, 'Màn hình', 'AMOLED, 6.5\", 144Hz'),
(173, 20, 'Hệ điều hành', 'Android 11'),
(174, 20, 'Camera sau', 'Quad 108 MP (Wide), 12 MP (Periscope Telephoto), 2'),
(175, 20, 'Camera trước', '64 MP'),
(176, 20, 'CPU', 'Exynos 2200'),
(177, 20, 'RAM', '16 GB'),
(178, 20, 'Bộ nhớ trong', '512 GB'),
(179, 20, 'Thẻ nhớ', 'Không hỗ trợ'),
(180, 20, 'Dung lượng pin', '6000 mAh, có sạc nhanh'),
(181, 21, 'Màn hình', 'Super AMOLED, 6.8\", 120Hz'),
(182, 21, 'Hệ điều hành', 'Android 12'),
(183, 21, 'Camera sau', 'Quad 108 MP (Wide), 10 MP (Telephoto), 20 MP (Ultr'),
(184, 21, 'Camera trước', '32 MP'),
(185, 21, 'CPU', 'Snapdragon 888'),
(186, 21, 'RAM', '8 GB'),
(187, 21, 'Bộ nhớ trong', '256 GB'),
(188, 21, 'Thẻ nhớ', 'MicroSD, lên đến 1 TB'),
(189, 21, 'Dung lượng pin', '4800 mAh, có sạc nhanh'),
(190, 22, 'Màn hình', 'IPS LCD, 6.6\", 90Hz'),
(191, 22, 'Hệ điều hành', 'Android 11'),
(192, 22, 'Camera sau', 'Triple 64 MP (Wide), 8 MP (Ultrawide), 5 MP (Depth'),
(193, 22, 'Camera trước', '24 MP'),
(194, 22, 'CPU', 'MediaTek Dimensity 1200'),
(195, 22, 'RAM', '12 GB'),
(196, 22, 'Bộ nhớ trong', '128 GB'),
(197, 22, 'Thẻ nhớ', 'MicroSD, lên đến 512 GB'),
(198, 22, 'Dung lượng pin', '5000 mAh, có sạc nhanh'),
(199, 23, 'Màn hình', 'OLED, 6.5\", 120Hz'),
(200, 23, 'Hệ điều hành', 'Android 11'),
(201, 23, 'Camera sau', 'Triple 50 MP (Wide), 8 MP (Telephoto), 12 MP (Ultr'),
(202, 23, 'Camera trước', '32 MP'),
(203, 23, 'CPU', 'Snapdragon 870'),
(204, 23, 'RAM', '8 GB'),
(205, 23, 'Bộ nhớ trong', '256 GB'),
(206, 23, 'Thẻ nhớ', 'Không hỗ trợ'),
(207, 23, 'Dung lượng pin', '4500 mAh, có sạc nhanh'),
(208, 24, 'Màn hình', 'Super AMOLED, 6.8\", 120Hz'),
(209, 24, 'Hệ điều hành', 'Android 12'),
(210, 24, 'Camera sau', 'Quad 108 MP (Wide), 10 MP (Telephoto), 20 MP (Ultr'),
(211, 24, 'Camera trước', '32 MP'),
(212, 24, 'CPU', 'Snapdragon 888'),
(213, 24, 'RAM', '8 GB'),
(214, 24, 'Bộ nhớ trong', '256 GB'),
(215, 24, 'Thẻ nhớ', 'MicroSD, lên đến 1 TB'),
(216, 24, 'Dung lượng pin', '4800 mAh, có sạc nhanh'),
(217, 25, 'Màn hình', 'OLED, 6.5\", 120Hz'),
(218, 25, 'Hệ điều hành', 'Android 11'),
(219, 25, 'Camera sau', 'Triple 50 MP (Wide), 8 MP (Telephoto), 12 MP (Ultr'),
(220, 25, 'Camera trước', '32 MP'),
(221, 25, 'CPU', 'Snapdragon 870'),
(222, 25, 'RAM', '8 GB'),
(223, 25, 'Bộ nhớ trong', '256 GB'),
(224, 25, 'Thẻ nhớ', 'Không hỗ trợ'),
(225, 25, 'Dung lượng pin', '4500 mAh, có sạc nhanh'),
(226, 26, 'Màn hình', 'IPS LCD, 6.6\", 90Hz'),
(227, 26, 'Hệ điều hành', 'Android 11'),
(228, 26, 'Camera sau', 'Triple 64 MP (Wide), 8 MP (Ultrawide), 5 MP (Depth'),
(229, 26, 'Camera trước', '24 MP'),
(230, 26, 'CPU', 'MediaTek Dimensity 1200'),
(231, 26, 'RAM', '12 GB'),
(232, 26, 'Bộ nhớ trong', '128 GB'),
(233, 26, 'Thẻ nhớ', 'MicroSD, lên đến 512 GB'),
(234, 26, 'Dung lượng pin', '5000 mAh, có sạc nhanh'),
(235, 27, 'Màn hình', 'IPS LCD, 6.5\", 90Hz'),
(236, 27, 'Hệ điều hành', 'Android 11'),
(237, 27, 'Camera sau', 'Triple 64 MP (Wide), 8 MP (Ultrawide), 5 MP (Depth'),
(238, 27, 'Camera trước', '24 MP'),
(239, 27, 'CPU', 'MediaTek Dimensity 1200'),
(240, 27, 'RAM', '12 GB'),
(241, 27, 'Bộ nhớ trong', '128 GB'),
(242, 27, 'Thẻ nhớ', 'MicroSD, lên đến 512 GB'),
(243, 27, 'Dung lượng pin', '5000 mAh, có sạc nhanh'),
(244, 28, 'Màn hình', 'OLED, 6.3\", 120Hz'),
(245, 28, 'Hệ điều hành', 'Android 12'),
(246, 28, 'Camera sau', 'Quad 108 MP (Wide), 10 MP (Telephoto), 20 MP (Ultr'),
(247, 28, 'Camera trước', '32 MP'),
(248, 28, 'CPU', 'Snapdragon 888'),
(249, 28, 'RAM', '8 GB'),
(250, 28, 'Bộ nhớ trong', '256 GB'),
(251, 28, 'Thẻ nhớ', 'MicroSD, lên đến 1 TB'),
(252, 28, 'Dung lượng pin', '4800 mAh, có sạc nhanh'),
(253, 29, 'Màn hình', 'Super AMOLED, 6.7\", 120Hz'),
(254, 29, 'Hệ điều hành', 'Android 12'),
(255, 29, 'Camera sau', 'Triple 108 MP (Wide), 12 MP (Telephoto), 16 MP (Ul'),
(256, 29, 'Camera trước', '40 MP'),
(257, 29, 'CPU', 'Exynos 2200'),
(258, 29, 'RAM', '12 GB'),
(259, 29, 'Bộ nhớ trong', '512 GB'),
(260, 29, 'Thẻ nhớ', 'Không hỗ trợ'),
(261, 29, 'Dung lượng pin', '5000 mAh, có sạc nhanh'),
(262, 30, 'Màn hình', 'AMOLED, 6.5\", 90Hz'),
(263, 30, 'Hệ điều hành', 'Android 11'),
(264, 30, 'Camera sau', 'Dual 48 MP (Wide), 8 MP (Ultrawide)'),
(265, 30, 'Camera trước', '20 MP'),
(266, 30, 'CPU', 'Snapdragon 778G'),
(267, 30, 'RAM', '8 GB'),
(268, 30, 'Bộ nhớ trong', '256 GB'),
(269, 30, 'Thẻ nhớ', 'MicroSD, lên đến 1 TB'),
(270, 30, 'Dung lượng pin', '4500 mAh, có sạc nhanh'),
(271, 31, 'Màn hình', 'AMOLED, 6.8\", 120Hz'),
(272, 31, 'Hệ điều hành', 'Android 12'),
(273, 31, 'Camera sau', 'Quad 50 MP (Wide), 12 MP (Telephoto), 20 MP (Ultra'),
(274, 31, 'Camera trước', '32 MP'),
(275, 31, 'CPU', 'Snapdragon 888'),
(276, 31, 'RAM', '12 GB'),
(277, 31, 'Bộ nhớ trong', '256 GB'),
(278, 31, 'Thẻ nhớ', 'MicroSD, lên đến 1 TB'),
(279, 31, 'Dung lượng pin', '5000 mAh, có sạc nhanh'),
(280, 32, 'Màn hình', 'OLED, 6.4\", 90Hz'),
(281, 32, 'Hệ điều hành', 'Android 11'),
(282, 32, 'Camera sau', 'Triple 64 MP (Wide), 12 MP (Ultrawide), 5 MP (Dept'),
(283, 32, 'Camera trước', '32 MP'),
(284, 32, 'CPU', 'MediaTek Dimensity 1200'),
(285, 32, 'RAM', '8 GB'),
(286, 32, 'Bộ nhớ trong', '128 GB'),
(287, 32, 'Thẻ nhớ', 'MicroSD, lên đến 512 GB'),
(288, 32, 'Dung lượng pin', '4500 mAh, có sạc nhanh'),
(289, 33, 'Màn hình', 'Super Retina XDR, 6.9\", 120Hz'),
(290, 33, 'Hệ điều hành', 'iOS 16'),
(291, 33, 'Camera sau', 'Triple 12 MP (Wide), 12 MP (Telephoto), 12 MP (Ult'),
(292, 33, 'Camera trước', '12 MP'),
(293, 33, 'CPU', 'Apple A16 Bionic'),
(294, 33, 'RAM', '6 GB'),
(295, 33, 'Bộ nhớ trong', '256 GB'),
(296, 33, 'Thẻ nhớ', 'Không hỗ trợ'),
(297, 33, 'Dung lượng pin', '4500 mAh, có sạc nhanh'),
(298, 34, 'Màn hình', 'Super Retina XDR, 6.1\", 120Hz'),
(299, 34, 'Hệ điều hành', 'iOS 16'),
(300, 34, 'Camera sau', 'Dual 12 MP (Wide), 12 MP (Ultrawide)'),
(301, 34, 'Camera trước', '12 MP'),
(302, 34, 'CPU', 'Apple A16 Bionic'),
(303, 34, 'RAM', '6 GB'),
(304, 34, 'Bộ nhớ trong', '128 GB'),
(305, 34, 'Thẻ nhớ', 'Không hỗ trợ'),
(306, 34, 'Dung lượng pin', '4000 mAh, có sạc nhanh'),
(307, 35, 'Màn hình', 'Super Retina XDR, 5.4\", 60Hz'),
(308, 35, 'Hệ điều hành', 'iOS 16'),
(309, 35, 'Camera sau', 'Dual 12 MP (Wide), 12 MP (Ultrawide)'),
(310, 35, 'Camera trước', '12 MP'),
(311, 35, 'CPU', 'Apple A16 Bionic'),
(312, 35, 'RAM', '4 GB'),
(313, 35, 'Bộ nhớ trong', '64 GB'),
(314, 35, 'Thẻ nhớ', 'Không hỗ trợ'),
(315, 35, 'Dung lượng pin', '3000 mAh, có sạc nhanh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cartid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `pname` varchar(150) NOT NULL,
  `pnewprice` decimal(10,2) NOT NULL,
  `poldprice` decimal(10,2) NOT NULL,
  `pimage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cartid`, `mid`, `code`, `pname`, `pnewprice`, `poldprice`, `pimage`) VALUES
(1, 0, '1', 'iPhone 12 Pro', 18000000.00, 20000000.00, 'iphone-12-pro.jpg'),
(2, 0, '2', 'Samsung Galaxy Note 20 Ultra', 20000000.00, 20000000.00, 'samsung-galaxy-note-20-ultra.jpg'),
(3, 1, '3', 'Samsung Galaxy S21', 13500000.00, 15000000.00, 'samsungs21.jpg'),
(4, 2, '4', 'iPhone 12 Pro', 18000000.00, 20000000.00, 'iphone-12-pro.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `cid` int(11) NOT NULL,
  `cname` varchar(50) NOT NULL,
  `cstatus` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`cid`, `cname`, `cstatus`) VALUES
(1, 'Samsung', 1),
(2, 'Iphone', 1),
(3, 'Oppo', 1),
(4, 'Xiaomi', 1),
(5, 'Huawei', 1),
(6, 'Vivo', 1),
(7, 'Realme', 1),
(8, 'OnePlus', 1),
(9, 'Sony', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `comid` int(11) NOT NULL,
  `mid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `comdate` datetime NOT NULL DEFAULT current_timestamp(),
  `comstatus` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`comid`, `mid`, `pid`, `content`, `comdate`, `comstatus`) VALUES
(1, 1, 1, 'đẹp xịn', '2023-12-22 22:10:20', 1),
(2, 1, 1, 'ngầu đét', '2023-12-22 22:23:10', 1),
(3, 2, 4, 'đep', '2023-12-22 22:27:12', 1),
(4, 2, 1, 'ngol', '2023-12-22 22:27:38', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `member`
--

CREATE TABLE `member` (
  `mid` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `mname` varchar(30) NOT NULL,
  `mphone` varchar(20) NOT NULL,
  `madd` varchar(150) NOT NULL,
  `memail` varchar(30) NOT NULL,
  `mstatus` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `member`
--

INSERT INTO `member` (`mid`, `username`, `password`, `mname`, `mphone`, `madd`, `memail`, `mstatus`) VALUES
(1, 'vinh', '123', 'an vinh', '1231231232', '13123', 'anvinh54@gmail.com', 1),
(2, 'tu', '123', 'N a t', '1231231232', '13123', 'anvinh54@gmail.com', 1),
(3, 'tutu', '123', ' n a t', '1231231232', '13123', 'anvinh54@gmail.com', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `oid` int(11) NOT NULL,
  `odate` datetime NOT NULL DEFAULT current_timestamp(),
  `ototal` decimal(15,2) NOT NULL,
  `ostatus` varchar(50) NOT NULL DEFAULT '0',
  `mid` int(11) DEFAULT NULL,
  `pid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `paymentmethod` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`oid`, `odate`, `ototal`, `ostatus`, `mid`, `pid`, `quantity`, `paymentmethod`) VALUES
(1, '2023-12-22 16:10:30', 13500000.00, 'đã hủy', 1, 1, 1, NULL),
(2, '2023-12-22 16:13:28', 13500000.00, 'đã hủy', 1, 1, 1, 'Thanh toán khi nhận hàng'),
(3, '2023-12-22 16:14:41', 18000000.00, 'đã xác nhận', 2, 2, 1, 'Chuyển khoản'),
(4, '2023-12-22 16:23:23', 13500000.00, 'chờ xác nhận', 1, 1, 1, 'Chuyển khoản'),
(5, '2023-12-22 16:47:16', 18000000.00, 'đã xác nhận', 2, 2, 1, 'Thanh toán khi nhận hàng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `pid` int(11) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `sid` int(11) DEFAULT NULL,
  `pname` varchar(150) NOT NULL,
  `pdesc` text NOT NULL,
  `pinsertdate` datetime NOT NULL,
  `pupdatedate` datetime NOT NULL,
  `pprice` decimal(10,2) NOT NULL,
  `pquantity` int(11) NOT NULL,
  `pstatus` tinyint(4) NOT NULL DEFAULT 1,
  `pimage` varchar(255) DEFAULT NULL,
  `phot` int(11) DEFAULT NULL,
  `psold` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`pid`, `cid`, `sid`, `pname`, `pdesc`, `pinsertdate`, `pupdatedate`, `pprice`, `pquantity`, `pstatus`, `pimage`, `phot`, `psold`) VALUES
(1, 1, 1, 'Samsung Galaxy S21', 'Điện thoại Samsung Galaxy S21 mới nhất', '2023-10-25 00:00:00', '2023-11-25 21:01:59', 15000000.00, 50, 1, 'samsungs21.jpg', 1, 100),
(2, 2, 2, 'iPhone 12 Pro', 'Điện thoại iPhone 12 Pro cao cấp', '2023-09-15 00:00:00', '2023-11-25 21:01:59', 20000000.00, 30, 1, 'iphone-12-pro.jpg', 1, 150),
(3, 3, 3, 'Oppo Reno 6', 'Điện thoại Oppo Reno 6 mới ra mắt', '2023-08-05 00:00:00', '2023-11-25 21:01:59', 12000000.00, 40, 1, 'oppo-reno-6.jpg', 2, 80),
(4, 4, 2, 'Xiaomi Redmi Note 10', 'Điện thoại Xiaomi Redmi Note 10', '2023-11-10 00:00:00', '2023-11-25 21:01:59', 7000000.00, 60, 1, 'xiaomi-redmi-note-10.jpg', 3, 120),
(5, 5, 2, 'Huawei P40 Pro', 'Điện thoại Huawei P40 Pro cao cấp', '2023-10-18 00:00:00', '2023-11-25 21:01:59', 18000000.00, 40, 1, 'huawei-p40-pro.jpg', 1, 90),
(6, 6, 3, 'Vivo V21', 'Điện thoại Vivo V21 với camera selfie độc đáo', '2023-09-22 00:00:00', '2023-11-25 21:01:59', 13000000.00, 35, 1, 'vivo-v21.jpg', 2, 60),
(7, 7, 3, 'Realme GT Neo 2', 'Điện thoại Realme GT Neo 2 với hiệu năng mạnh mẽ', '2023-08-30 00:00:00', '2023-11-25 21:01:59', 14000000.00, 50, 1, 'realme-gt-neo-2.jpg', 1, 75),
(8, 8, 1, 'OnePlus 9 Pro', 'Điện thoại OnePlus 9 Pro với cấu hình cao cấp', '2023-07-25 00:00:00', '2023-11-25 21:01:59', 22000000.00, 25, 1, 'oneplus-9-pro.jpg', 4, 45),
(9, 9, 1, 'Sony Xperia 5 III', 'Điện thoại Sony Xperia 5 III với thiết kế sang trọng', '2023-06-14 00:00:00', '2023-11-25 21:01:59', 19000000.00, 30, 1, 'sony-xperia-5-iii.jpg', 1, 70),
(10, 1, 1, 'Samsung Galaxy A52', 'Điện thoại Samsung Galaxy A52 mới', '2023-11-20 00:00:00', '2023-11-25 21:04:01', 12000000.00, 40, 1, 'samsung-galaxy-a52.jpg', 1, 60),
(11, 2, 2, 'iPhone SE 2020', 'Điện thoại iPhone SE thế hệ 2020', '2023-11-18 00:00:00', '2023-11-25 21:04:01', 10000000.00, 35, 1, 'iphone-se-2020.jpg', 3, 45),
(12, 3, 3, 'Oppo A74', 'Điện thoại Oppo A74 với camera chất lượng', '2023-11-15 00:00:00', '2023-11-25 21:04:01', 8000000.00, 50, 1, 'oppo-a74.jpg', 1, 55),
(13, 1, 1, 'Samsung Galaxy Note 20 Ultra', 'Điện thoại Samsung Galaxy Note 20 Ultra mạnh mẽ', '2023-11-12 00:00:00', '2023-11-25 21:04:37', 20000000.00, 30, 1, 'samsung-galaxy-note-20-ultra.jpg', 1, 25),
(14, 1, 1, 'Samsung Galaxy A72', 'Điện thoại Samsung Galaxy A72 với camera đỉnh cao', '2023-11-10 00:00:00', '2023-11-25 21:04:37', 15000000.00, 25, 1, 'samsung-galaxy-a72.jpg', 1, 20),
(15, 1, 1, 'Samsung Galaxy M52 5G', 'Điện thoại Samsung Galaxy M52 5G mới', '2023-11-08 00:00:00', '2023-11-25 21:04:37', 18000000.00, 20, 1, 'samsung-galaxy-m52-5g.jpg', 4, 15),
(16, 2, 2, 'iPhone 13 Pro Max', 'Điện thoại iPhone 13 Pro Max mới', '2023-11-20 00:00:00', '2023-11-25 21:05:14', 25000000.00, 40, 1, 'iphone-13-pro-max.jpg', 2, 35),
(17, 2, 2, 'iPhone 13', 'Điện thoại iPhone 13 với nhiều tính năng mới', '2023-11-18 00:00:00', '2023-11-25 21:05:14', 20000000.00, 35, 1, 'iphone-13.jpg', 2, 30),
(18, 2, 2, 'iPhone SE Plus', 'Điện thoại iPhone SE Plus dòng mới', '2023-11-15 00:00:00', '2023-11-25 21:05:14', 15000000.00, 50, 1, 'iphone-se-plus.jpg', 1, 45),
(19, 3, 3, 'Oppo Reno6 Pro', 'Điện thoại Oppo Reno6 Pro với thiết kế đẹp', '2023-11-12 00:00:00', '2023-11-25 21:05:34', 17000000.00, 30, 1, 'oppo-reno6-pro.jpg', 3, 25),
(20, 3, 3, 'Oppo A95', 'Điện thoại Oppo A95 với camera sắc nét', '2023-11-10 00:00:00', '2023-11-25 21:05:34', 12000000.00, 25, 1, 'oppo-a95.jpg', 1, 20),
(21, 4, 4, 'Xiaomi Redmi Note 11 Pro', 'Điện thoại Xiaomi Redmi Note 11 Pro mới', '2023-11-08 00:00:00', '2023-11-25 21:05:34', 16000000.00, 20, 1, 'xiaomi-redmi-note-11-pro.jpg', 2, 15),
(22, 4, 4, 'Xiaomi Mi 11 Lite', 'Điện thoại Xiaomi Mi 11 Lite với thiết kế gọn nhẹ', '2023-11-05 00:00:00', '2023-11-25 21:05:34', 13000000.00, 35, 1, 'xiaomi-mi-11-lite.jpg', 1, 30),
(23, 5, 3, 'Huawei P50 Pro', 'Điện thoại Huawei P50 Pro với camera đỉnh cao', '2023-11-20 00:00:00', '2023-11-25 21:08:57', 19000000.00, 40, 1, 'huawei-p50-pro.jpg', 5, 35),
(24, 5, 2, 'Huawei Nova 9', 'Điện thoại Huawei Nova 9 với thiết kế sang trọng', '2023-11-18 00:00:00', '2023-11-25 21:08:57', 15000000.00, 35, 1, 'huawei-nova-9.jpg', 1, 30),
(25, 6, 3, 'Vivo V23 Pro', 'Điện thoại Vivo V23 Pro với hiệu năng ổn định', '2023-11-15 00:00:00', '2023-11-25 21:08:57', 16000000.00, 50, 1, 'vivo-v23-pro.jpg', 5, 45),
(26, 6, 1, 'Vivo Y74', 'Điện thoại Vivo Y74 với pin lâu và camera sắc nét', '2023-11-12 00:00:00', '2023-11-25 21:08:57', 12000000.00, 40, 1, 'vivo-y74.jpg', 1, 35),
(27, 7, 1, 'Realme GT Master Edition', 'Điện thoại Realme GT Master Edition mới', '2023-11-10 00:00:00', '2023-11-25 21:08:57', 17000000.00, 45, 1, 'realme-gt-master-edition.jpg', 1, 40),
(28, 7, 4, 'Realme Narzo 50A', 'Điện thoại Realme Narzo 50A với giá hấp dẫn', '2023-11-08 00:00:00', '2023-11-25 21:08:57', 11000000.00, 55, 1, 'realme-narzo-50a.jpg', 1, 50),
(29, 8, 4, 'OnePlus 9 Pro', 'Điện thoại OnePlus 9 Pro với màn hình chất lượng', '2023-11-05 00:00:00', '2023-11-25 21:08:57', 22000000.00, 30, 1, 'oneplus-9-pro.jpg', 1, 25),
(30, 8, 2, 'OnePlus Nord 2', 'Điện thoại OnePlus Nord 2 mới ra mắt', '2023-11-02 00:00:00', '2023-11-25 21:08:57', 18000000.00, 35, 1, 'oneplus-nord-2.jpg', 1, 30),
(31, 9, 3, 'Sony Xperia 1 III', 'Điện thoại Sony Xperia 1 III với chất lượng âm thanh tốt', '2023-10-30 00:00:00', '2023-11-25 21:08:57', 23000000.00, 25, 1, 'sony-xperia-1-iii.jpg', 1, 20),
(32, 9, 1, 'Sony Xperia 5 III', 'Điện thoại Sony Xperia 5 III với hiệu năng mạnh mẽ', '2023-10-28 00:00:00', '2023-11-25 21:08:57', 19000000.00, 30, 1, 'sony-xperia-5-iii.jpg', 1, 25),
(33, 2, 2, 'iPhone 15 Pro Max', 'Điện thoại iPhone 15 Pro Max mới', '2023-11-20 00:00:00', '2023-11-25 22:37:21', 25000000.00, 40, 1, 'iphone-13-pro-max.jpg', 1, 35),
(34, 2, 2, 'iPhone 15', 'Điện thoại iPhone 15 với nhiều tính năng mới', '2023-11-18 00:00:00', '2023-11-25 22:37:21', 20000000.00, 35, 1, 'iphone-13.jpg', 1, 30),
(35, 2, 2, 'iPhone SE ', 'Điện thoại iPhone SE dòng mới', '2023-11-15 00:00:00', '2023-11-25 22:37:21', 15000000.00, 50, 1, 'iphone-se-plus.jpg', 1, 45);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sale`
--

CREATE TABLE `sale` (
  `saleid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `seasonid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sale`
--

INSERT INTO `sale` (`saleid`, `pid`, `seasonid`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `season`
--

CREATE TABLE `season` (
  `seasonid` int(11) NOT NULL,
  `seasonstart` datetime NOT NULL,
  `seasonend` datetime NOT NULL,
  `discount_percentage` decimal(5,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `season`
--

INSERT INTO `season` (`seasonid`, `seasonstart`, `seasonend`, `discount_percentage`) VALUES
(1, '2023-12-17 12:40:44', '2023-12-27 12:40:44', 10.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `supplier`
--

CREATE TABLE `supplier` (
  `sid` int(11) NOT NULL,
  `sname` varchar(20) NOT NULL,
  `sphone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `supplier`
--

INSERT INTO `supplier` (`sid`, `sname`, `sphone`) VALUES
(1, 'Viettel Store', '123456789'),
(2, 'Mobile World', '987654321'),
(3, 'FPT Shop', '456123789'),
(4, 'CellphoneS', '789456123');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`aid`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cid`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comid`);

--
-- Chỉ mục cho bảng `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`mid`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oid`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Chỉ mục cho bảng `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`saleid`);

--
-- Chỉ mục cho bảng `season`
--
ALTER TABLE `season`
  ADD PRIMARY KEY (`seasonid`);

--
-- Chỉ mục cho bảng `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`sid`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attribute`
--
ALTER TABLE `attribute`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `comid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `member`
--
ALTER TABLE `member`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `sale`
--
ALTER TABLE `sale`
  MODIFY `saleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `season`
--
ALTER TABLE `season`
  MODIFY `seasonid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `supplier`
--
ALTER TABLE `supplier`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
