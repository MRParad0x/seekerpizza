-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2023 at 10:32 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `Id` int(4) NOT NULL,
  `cartitemId` varchar(10) NOT NULL,
  `sessionId` varchar(50) DEFAULT NULL,
  `productId` varchar(10) NOT NULL,
  `cartitemQty` int(11) NOT NULL,
  `cartitemDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`Id`, `cartitemId`, `sessionId`, `productId`, `cartitemQty`, `cartitemDate`) VALUES
(278, 'CII-0278', '25k1aaq5aqcvq3qcfusjqatbu6', 'PR-0015', 1, '2022-12-20'),
(283, 'CII-0283', 'pidg4e1dkbocn3c3ctt7vcoata', 'PR-0011', 1, '2022-12-25'),
(288, 'CII-0288', '2gb8i6uomghhglfoeedndnguqj', 'PR-0010', 1, '2022-12-27'),
(289, 'CII-0289', '2gb8i6uomghhglfoeedndnguqj', 'PR-0021', 1, '2022-12-27'),
(290, 'CII-0290', '2gb8i6uomghhglfoeedndnguqj', 'PR-0020', 1, '2022-12-27'),
(291, 'CII-0291', '2gb8i6uomghhglfoeedndnguqj', 'PR-0022', 1, '2022-12-27'),
(308, 'CII-0308', 'fger5tk3ag1k1v3gcpr649e4tq', 'PR-0015', 2, '2022-12-28'),
(309, 'CII-0309', 'fger5tk3ag1k1v3gcpr649e4tq', 'PR-0016', 3, '2022-12-28'),
(310, 'CII-0310', 'fger5tk3ag1k1v3gcpr649e4tq', 'PR-0018', 4, '2022-12-28'),
(345, 'CII-0345', '907nkvmvnhnhilur9crcth6lmp', 'PR-0011', 1, '2023-02-01'),
(346, 'CII-0346', '907nkvmvnhnhilur9crcth6lmp', 'PR-0022', 1, '2023-02-01'),
(348, 'CII-0348', 'pb2ncgpl9hfsrloq0uvk94d8p0', 'PR-0015', 1, '2023-02-02'),
(378, 'CII-0378', 'b00pm7t75huqrf12k3f6rdigog', 'PR-0024', 1, '2023-02-03'),
(379, 'CII-0379', 'b00pm7t75huqrf12k3f6rdigog', 'PR-0016', 1, '2023-02-03'),
(382, 'CII-0382', 'o3p91vth4h440sh0v8fqjlcr2t', 'PR-0022', 1, '2023-02-04'),
(383, 'CII-0383', 'o3p91vth4h440sh0v8fqjlcr2t', 'PR-0011', 1, '2023-02-04'),
(384, 'CII-0384', 'ei5fse4v7mfcgehpd1hgcs039t', 'PR-0024', 1, '2023-02-06');

--
-- Triggers `cart_item`
--
DELIMITER $$
CREATE TRIGGER `getcartitemId` BEFORE INSERT ON `cart_item` FOR EACH ROW BEGIN
INSERT INTO id_cart_item VALUES (NULL);
SET NEW.cartitemId = CONCAT("CII-", LPAD(LAST_INSERT_ID(), 4, "0"));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(4) NOT NULL,
  `categoryId` varchar(10) NOT NULL,
  `categoryName` varchar(50) NOT NULL,
  `categoryDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryId`, `categoryName`, `categoryDate`) VALUES
(1, 'CA-0001', 'Pizza', '2022-12-24'),
(2, 'CA-0002', 'Pasta', '2022-12-24'),
(3, 'CA-0003', 'Dessert', '2022-12-24'),
(4, 'CA-0004', 'Beverage', '2022-12-24');

--
-- Triggers `category`
--
DELIMITER $$
CREATE TRIGGER `getcategoryId` BEFORE INSERT ON `category` FOR EACH ROW BEGIN
INSERT INTO id_category VALUES (NULL);
SET NEW.categoryId = CONCAT("CA-", LPAD(LAST_INSERT_ID(), 4, "0"));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(4) NOT NULL,
  `contactId` varchar(10) NOT NULL,
  `contactFName` varchar(100) NOT NULL,
  `contactSubject` varchar(100) NOT NULL,
  `contactEmail` varchar(100) NOT NULL,
  `contactMessage` longtext NOT NULL,
  `contactDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `contactId`, `contactFName`, `contactSubject`, `contactEmail`, `contactMessage`, `contactDate`) VALUES
(1, 'CU-0001', 'Amila F', 'Login page issue', 'amila@gmail.com', 'can\'t login my acount', '2022-12-27'),
(2, 'CU-0002', 'Kasuni S', 'Order issue', 'kasuni@aol.com', 'can\'t place a order', '2022-12-27'),
(3, 'CU-0003', 'Nimal S', 'Order ', 'nimal@gmail.com', ' How to place a order?', '2022-12-27');

--
-- Triggers `contact`
--
DELIMITER $$
CREATE TRIGGER `getcontactId` BEFORE INSERT ON `contact` FOR EACH ROW BEGIN
INSERT INTO id_contact VALUES (NULL);
SET NEW.contactId = CONCAT("CU-", LPAD(LAST_INSERT_ID(), 4, "0"));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(4) NOT NULL,
  `couponId` varchar(10) NOT NULL,
  `couponCode` varchar(100) NOT NULL,
  `couponDiscount` double NOT NULL,
  `couponDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `couponId`, `couponCode`, `couponDiscount`, `couponDate`) VALUES
(1, 'CO-0001', 'none', 0, '2022-12-24'),
(2, 'CO-0002', 'flash35', 0.35, '2022-12-24'),
(3, 'CO-0003', 'flash15', 0.15, '2022-12-24'),
(4, 'CO-0004', 'flash20', 0.2, '2022-12-24'),
(5, 'CO-0005', 'flash25', 0.25, '2022-12-24');

--
-- Triggers `coupon`
--
DELIMITER $$
CREATE TRIGGER `getcouponId` BEFORE INSERT ON `coupon` FOR EACH ROW BEGIN
INSERT INTO id_coupon VALUES (NULL);
SET NEW.couponId = CONCAT("CO-", LPAD(LAST_INSERT_ID(), 4, "0"));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(4) NOT NULL,
  `feedbackId` varchar(10) NOT NULL,
  `feedbackFName` varchar(100) NOT NULL,
  `feedbackEmail` varchar(50) NOT NULL,
  `feedbackMessage` longtext NOT NULL,
  `feedbackDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `feedbackId`, `feedbackFName`, `feedbackEmail`, `feedbackMessage`, `feedbackDate`) VALUES
(1, 'FE-0001', 'Amila L', 'amila@gmail.com', 'Delicious foods.. Great!!', '2022-12-26'),
(2, 'FE-0002', 'Sanjaya', 'sanjaya@gmail.com', 'Yummy Foods!', '2022-12-27'),
(3, 'FE-0003', 'Nirmal K', 'nirmal@yahoo.com', 'Best food ever!', '2022-12-27'),
(4, 'FE-0004', 'Dasun K', 'dasun@gmail.com', 'nice clean fresh food!', '2022-12-27'),
(5, 'FE-0005', 'Kelum H', 'kemlum@aol.com', 'Great pizza!', '2022-12-27'),
(6, 'FE-0006', 'Nimali H', 'nimali@yandex.com', 'fresh & clean foods!', '2022-12-27'),
(7, 'FE-0007', 'Bimali K', 'bimali@gmail.com', 'Great yummy meals!', '2022-12-27');

--
-- Triggers `feedback`
--
DELIMITER $$
CREATE TRIGGER `getfeedbackId` BEFORE INSERT ON `feedback` FOR EACH ROW BEGIN
INSERT INTO id_feedback VALUES (NULL);
SET NEW.feedbackId = CONCAT("FE-", LPAD(LAST_INSERT_ID(), 4, "0"));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `guestId` int(11) NOT NULL,
  `guestNIC` varchar(30) NOT NULL,
  `guestEmail` varchar(30) NOT NULL,
  `guestFName` varchar(30) NOT NULL,
  `guestLName` varchar(30) NOT NULL,
  `guestAddress` varchar(100) NOT NULL,
  `guestCity` varchar(20) NOT NULL,
  `guestPostalCode` int(11) NOT NULL,
  `guestNumber` int(10) NOT NULL,
  `guestDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`guestId`, `guestNIC`, `guestEmail`, `guestFName`, `guestLName`, `guestAddress`, `guestCity`, `guestPostalCode`, `guestNumber`, `guestDate`) VALUES
(6, 'GID-04e3e2ce', 'test@gmail.com', 'test', 'name', 'test', 'test', 10640, 771233243, '2022-12-24'),
(7, 'GID-d87c4af8', 'guest12@gmail.com', 'Guest', 'H', '11B', 'Moratuwa', 10560, 771233345, '2023-02-03'),
(8, 'GID-b40961a8', 'gust32@gmail.com', 'Guest', 'Sanath', 'e33', 'Kaduwela', 11560, 771233345, '2023-02-03'),
(9, 'GID-baca508d', 'guest20@gmail.com', 'Guest', 'Kemal', 't55', 'Kandy', 9908, 771233243, '2023-02-03'),
(10, 'GID-cfc8c496', 'guest33@gmail.com', 'Guest', 'Udara', 'T67', 'Galle', 8932, 771233377, '2023-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `id_cart_item`
--

CREATE TABLE `id_cart_item` (
  `Id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_cart_item`
--

INSERT INTO `id_cart_item` (`Id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(17),
(18),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(45),
(46),
(47),
(48),
(49),
(50),
(51),
(52),
(53),
(54),
(55),
(56),
(57),
(58),
(59),
(60),
(61),
(62),
(63),
(64),
(65),
(66),
(67),
(68),
(69),
(70),
(71),
(72),
(73),
(74),
(75),
(76),
(77),
(78),
(79),
(80),
(81),
(82),
(83),
(84),
(85),
(86),
(87),
(88),
(89),
(90),
(91),
(92),
(93),
(94),
(95),
(96),
(97),
(98),
(99),
(100),
(101),
(102),
(103),
(104),
(105),
(106),
(107),
(108),
(109),
(110),
(111),
(112),
(113),
(114),
(115),
(116),
(117),
(118),
(119),
(120),
(121),
(122),
(123),
(124),
(125),
(126),
(127),
(128),
(129),
(130),
(131),
(132),
(133),
(134),
(135),
(136),
(137),
(138),
(139),
(140),
(141),
(142),
(143),
(144),
(145),
(146),
(147),
(148),
(149),
(150),
(151),
(152),
(153),
(154),
(155),
(156),
(157),
(158),
(159),
(160),
(161),
(162),
(163),
(164),
(165),
(166),
(167),
(168),
(169),
(170),
(171),
(172),
(173),
(174),
(175),
(176),
(177),
(178),
(179),
(180),
(181),
(182),
(183),
(184),
(185),
(186),
(187),
(188),
(189),
(190),
(191),
(192),
(193),
(194),
(195),
(196),
(197),
(198),
(199),
(200),
(201),
(202),
(203),
(204),
(205),
(206),
(207),
(208),
(209),
(210),
(211),
(212),
(213),
(214),
(215),
(216),
(217),
(218),
(219),
(220),
(221),
(222),
(223),
(224),
(225),
(226),
(227),
(228),
(229),
(230),
(231),
(232),
(233),
(234),
(235),
(236),
(237),
(238),
(239),
(240),
(241),
(242),
(243),
(244),
(245),
(246),
(247),
(248),
(249),
(250),
(251),
(252),
(253),
(254),
(255),
(256),
(257),
(258),
(259),
(260),
(261),
(262),
(263),
(264),
(265),
(266),
(267),
(268),
(269),
(270),
(271),
(272),
(273),
(274),
(275),
(276),
(277),
(278),
(279),
(280),
(281),
(282),
(283),
(284),
(285),
(286),
(287),
(288),
(289),
(290),
(291),
(292),
(293),
(294),
(295),
(296),
(297),
(298),
(299),
(300),
(301),
(302),
(303),
(304),
(305),
(306),
(307),
(308),
(309),
(310),
(311),
(312),
(313),
(314),
(315),
(316),
(317),
(318),
(319),
(320),
(321),
(322),
(323),
(324),
(325),
(326),
(327),
(328),
(329),
(330),
(331),
(332),
(333),
(334),
(335),
(336),
(337),
(338),
(339),
(340),
(341),
(342),
(343),
(344),
(345),
(346),
(347),
(348),
(349),
(350),
(351),
(352),
(353),
(354),
(355),
(356),
(357),
(358),
(359),
(360),
(361),
(362),
(363),
(364),
(365),
(366),
(367),
(368),
(369),
(370),
(371),
(372),
(373),
(374),
(375),
(376),
(377),
(378),
(379),
(380),
(381),
(382),
(383),
(384);

-- --------------------------------------------------------

--
-- Table structure for table `id_category`
--

CREATE TABLE `id_category` (
  `id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_category`
--

INSERT INTO `id_category` (`id`) VALUES
(1),
(2),
(3),
(4),
(5);

-- --------------------------------------------------------

--
-- Table structure for table `id_contact`
--

CREATE TABLE `id_contact` (
  `id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_contact`
--

INSERT INTO `id_contact` (`id`) VALUES
(1),
(2),
(3);

-- --------------------------------------------------------

--
-- Table structure for table `id_coupon`
--

CREATE TABLE `id_coupon` (
  `id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_coupon`
--

INSERT INTO `id_coupon` (`id`) VALUES
(1),
(2),
(3),
(4),
(5);

-- --------------------------------------------------------

--
-- Table structure for table `id_feedback`
--

CREATE TABLE `id_feedback` (
  `id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_feedback`
--

INSERT INTO `id_feedback` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7);

-- --------------------------------------------------------

--
-- Table structure for table `id_order`
--

CREATE TABLE `id_order` (
  `Id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_order`
--

INSERT INTO `id_order` (`Id`) VALUES
(1),
(2),
(3),
(4),
(5);

-- --------------------------------------------------------

--
-- Table structure for table `id_order_items`
--

CREATE TABLE `id_order_items` (
  `id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_order_items`
--

INSERT INTO `id_order_items` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45),
(46),
(47),
(48),
(49),
(50),
(51),
(52),
(53),
(54),
(55),
(56),
(57),
(58),
(59),
(60),
(61),
(62),
(63),
(64),
(65),
(66),
(67),
(68),
(69),
(70),
(71),
(72),
(73),
(74),
(75),
(76),
(77),
(78),
(79),
(80),
(81),
(82),
(83),
(84),
(85),
(86),
(87),
(88),
(89),
(90),
(91),
(92),
(93),
(94),
(95),
(96),
(97),
(103),
(104),
(105),
(106),
(107),
(108),
(112),
(113),
(114),
(115),
(116),
(117),
(118),
(119),
(120),
(121),
(122),
(123),
(124),
(125),
(126),
(127),
(128),
(129),
(130),
(131),
(132),
(133),
(134),
(135),
(136),
(137),
(138),
(139),
(140),
(141),
(142),
(143),
(144),
(145),
(146),
(147),
(148),
(149),
(150),
(151),
(152),
(153),
(154),
(155),
(156),
(157),
(158),
(159),
(160),
(161),
(162);

-- --------------------------------------------------------

--
-- Table structure for table `id_product`
--

CREATE TABLE `id_product` (
  `id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_product`
--

INSERT INTO `id_product` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(10),
(11),
(14),
(15),
(16),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25);

-- --------------------------------------------------------

--
-- Table structure for table `id_role`
--

CREATE TABLE `id_role` (
  `id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_role`
--

INSERT INTO `id_role` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6);

-- --------------------------------------------------------

--
-- Table structure for table `id_shopping_session`
--

CREATE TABLE `id_shopping_session` (
  `Id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_shopping_session`
--

INSERT INTO `id_shopping_session` (`Id`) VALUES
(1),
(3),
(7),
(9),
(11),
(13);

-- --------------------------------------------------------

--
-- Table structure for table `id_subscriber`
--

CREATE TABLE `id_subscriber` (
  `id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `id_subscriber`
--

INSERT INTO `id_subscriber` (`id`) VALUES
(1),
(2),
(3),
(4),
(5);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `Id` int(4) NOT NULL,
  `orderitemsId` varchar(10) NOT NULL,
  `orderId` varchar(20) NOT NULL,
  `productId` varchar(10) NOT NULL,
  `orderitemsQty` int(11) NOT NULL,
  `orderitemsTotal` int(11) NOT NULL,
  `orderitemsDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`Id`, `orderitemsId`, `orderId`, `productId`, `orderitemsQty`, `orderitemsTotal`, `orderitemsDate`) VALUES
(111, 'OII-0113', 'OID-bb1ebc88', 'PR-0020', 1, 1500, '2022-12-19'),
(112, 'OII-0114', 'OID-a026acb8', 'PR-0015', 1, 1300, '2022-12-22'),
(113, 'OII-0115', 'OID-3d0dc956', 'PR-0015', 1, 1300, '2022-12-24'),
(114, 'OII-0116', 'OID-3d0dc956', 'PR-0021', 1, 500, '2022-12-24'),
(115, 'OII-0117', 'OID-3d0dc956', 'PR-0022', 1, 500, '2022-12-24'),
(116, 'OII-0118', 'OID-5d08eef8', 'PR-0016', 2, 3000, '2022-12-27'),
(117, 'OII-0119', 'OID-5d08eef8', 'PR-0018', 3, 3000, '2022-12-27'),
(118, 'OII-0120', 'OID-1fd8b348', 'PR-0011', 1, 3000, '2022-12-28'),
(119, 'OII-0121', 'OID-1fd8b348', 'PR-0020', 1, 1500, '2022-12-28'),
(120, 'OII-0122', 'OID-1fd8b348', 'PR-0022', 1, 500, '2022-12-28'),
(121, 'OII-0123', 'OID-1fd8b348', 'PR-0021', 1, 500, '2022-12-28'),
(122, 'OII-0124', 'OID-60487a98', 'PR-0011', 1, 3000, '2022-12-28'),
(123, 'OII-0125', 'OID-60487a98', 'PR-0024', 1, 2000, '2022-12-28'),
(124, 'OII-0126', 'OID-60487a98', 'PR-0021', 1, 500, '2022-12-28'),
(125, 'OII-0127', 'OID-60487a98', 'PR-0020', 1, 1500, '2022-12-28'),
(126, 'OII-0128', 'OID-60487a98', 'PR-0022', 1, 500, '2022-12-28'),
(127, 'OII-0129', 'OID-56789161', 'PR-0025', 1, 3000, '2022-12-28'),
(128, 'OII-0130', 'OID-56789161', 'PR-0015', 1, 1300, '2022-12-28'),
(129, 'OII-0131', 'OID-1b179dd8', 'PR-0024', 1, 2000, '2023-02-02'),
(130, 'OII-0132', 'OID-a198a46c', 'PR-0010', 1, 2000, '2023-02-03'),
(131, 'OII-0133', 'OID-a198a46c', 'PR-0020', 1, 1500, '2023-02-03'),
(132, 'OII-0134', 'OID-a198a46c', 'PR-0022', 1, 500, '2023-02-03'),
(133, 'OII-0135', 'OID-a198a46c', 'PR-0021', 1, 500, '2023-02-03'),
(134, 'OII-0136', 'OID-a588b368', 'PR-0011', 1, 3000, '2023-02-03'),
(135, 'OII-0137', 'OID-a588b368', 'PR-0024', 1, 2000, '2023-02-03'),
(136, 'OII-0138', 'OID-a588b368', 'PR-0021', 1, 500, '2023-02-03'),
(137, 'OII-0139', 'OID-a588b368', 'PR-0022', 1, 500, '2023-02-03'),
(138, 'OII-0140', 'OID-00c87c54', 'PR-0024', 1, 2000, '2023-02-03'),
(139, 'OII-0141', 'OID-7478554a', 'PR-0015', 1, 1300, '2023-02-03'),
(140, 'OII-0142', 'OID-7478554a', 'PR-0024', 1, 2000, '2023-02-03'),
(141, 'OII-0143', 'OID-7478554a', 'PR-0019', 1, 2000, '2023-02-03'),
(142, 'OII-0144', 'OID-7478554a', 'PR-0021', 1, 500, '2023-02-03'),
(143, 'OII-0145', 'OID-7478554a', 'PR-0022', 1, 500, '2023-02-03'),
(144, 'OII-0146', 'OID-7478554a', 'PR-0018', 1, 1000, '2023-02-03'),
(145, 'OII-0147', 'OID-86688398', 'PR-0024', 2, 4000, '2023-02-03'),
(146, 'OII-0148', 'OID-86688398', 'PR-0023', 3, 3900, '2023-02-03'),
(147, 'OII-0149', 'OID-e9be6418', 'PR-0015', 2, 2600, '2023-02-03'),
(148, 'OII-0150', 'OID-a9be9aa9', 'PR-0015', 2, 2600, '2023-02-03'),
(149, 'OII-0151', 'OID-a9be9aa9', 'PR-0024', 2, 4000, '2023-02-03'),
(150, 'OII-0152', 'OID-a9be9aa9', 'PR-0023', 1, 1300, '2023-02-03'),
(151, 'OII-0153', 'OID-a9be9aa9', 'PR-0020', 2, 3000, '2023-02-03'),
(152, 'OII-0154', 'OID-a9be9aa9', 'PR-0021', 1, 500, '2023-02-03'),
(153, 'OII-0155', 'OID-a9be9aa9', 'PR-0022', 1, 500, '2023-02-03'),
(154, 'OII-0156', 'OID-0aff8898', 'PR-0015', 2, 2600, '2023-02-03'),
(155, 'OII-0157', 'OID-5248acc8', 'PR-0015', 1, 1300, '2023-02-03'),
(156, 'OII-0158', 'OID-03b86ec2', 'PR-0025', 2, 6000, '2023-02-03'),
(157, 'OII-0159', 'OID-84081288', 'PR-0011', 1, 3000, '2023-02-03'),
(158, 'OII-0160', 'OID-84081288', 'PR-0024', 1, 2000, '2023-02-03'),
(159, 'OII-0161', 'OID-6125fc97', 'PR-0015', 1, 1300, '2023-02-04'),
(160, 'OII-0162', 'OID-6125fc97', 'PR-0011', 1, 3000, '2023-02-04');

--
-- Triggers `order_items`
--
DELIMITER $$
CREATE TRIGGER `getorderitemId` BEFORE INSERT ON `order_items` FOR EACH ROW BEGIN
INSERT INTO id_order_items VALUES (NULL);
SET NEW.orderitemsId = CONCAT("OII-", LPAD(LAST_INSERT_ID(), 4, "0"));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Id` int(4) NOT NULL,
  `productId` varchar(10) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productPrice` int(10) NOT NULL,
  `productDescription` text DEFAULT NULL,
  `productImage` varchar(100) NOT NULL,
  `categoryId` varchar(10) NOT NULL,
  `couponId` varchar(10) NOT NULL,
  `productDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `productId`, `productName`, `productPrice`, `productDescription`, `productImage`, `categoryId`, `couponId`, `productDate`) VALUES
(10, 'PR-0010', 'Chicken Pizza', 2000, 'Chicken Pizza\", \"tomato sauce, mozzarella cheese, cocktail, shrimps salmon, mussels, lemon, parsley', 'pizza11.png', 'CA-0001', 'CO-0004', '2022-12-24'),
(11, 'PR-0011', 'Seafood Pizza', 3000, 'Chicken Pizza\", \"tomato sauce, mozzarella cheese, cocktail, shrimps salmon, mussels, lemon, parsley', 'pizza06.png', 'CA-0001', 'CO-0002', '2022-12-24'),
(15, 'PR-0015', 'Cheese Pizza', 1300, 'Chicken Pizza\", \"tomato sauce, mozzarella cheese, cocktail, shrimps salmon, mussels, lemon, parsley', 'pizza09.png', 'CA-0001', 'CO-0001', '2022-12-24'),
(16, 'PR-0016', 'Sausage Pizza', 1500, 'Chicken Pizza\", \"tomato sauce, mozzarella cheese, cocktail, shrimps salmon, mussels, lemon, parsley 	\r\n', 'pizza08.png', 'CA-0001', 'CO-0001', '2022-12-24'),
(18, 'PR-0018', 'Vegetable Pizza', 1000, 'Chicken Pizza\", \"tomato sauce, mozzarella cheese, cocktail, shrimps salmon, mussels, lemon, parsley 	\r\n', 'pizza12.png', 'CA-0001', 'CO-0005', '2022-12-24'),
(19, 'PR-0019', 'Chicken Pasta', 2000, 'Chicken Pizza\", \"tomato sauce, mozzarella cheese, cocktail, shrimps salmon, mussels, lemon, parsley 	\r\n', 'pasta01.png', 'CA-0002', 'CO-0001', '2022-12-24'),
(20, 'PR-0020', 'Cheese Pasta', 1500, 'Chicken Pizza\", \"tomato sauce, mozzarella cheese, cocktail, shrimps salmon, mussels, lemon, parsley 	\r\n', 'pasta02.png', 'CA-0002', 'CO-0001', '2022-12-24'),
(21, 'PR-0021', 'Mix Ice Cream', 500, 'Chicken Pizza\", \"tomato sauce, mozzarella cheese, cocktail, shrimps salmon, mussels, lemon, parsley 	\r\n', 'des02.png', 'CA-0003', 'CO-0001', '2022-12-24'),
(22, 'PR-0022', 'Banana Juice', 500, 'Chicken Pizza\", \"tomato sauce, mozzarella cheese, cocktail, shrimps salmon, mussels, lemon, parsley 	\r\n', 'bev04.png', 'CA-0004', 'CO-0001', '2022-12-24'),
(23, 'PR-0023', 'Sausages', 1300, 'Chicken Pizza\", \"tomato sauce, mozzarella cheese, cocktail, shrimps salmon, mussels, lemon, parsley ', 'pizza03.png', 'CA-0001', 'CO-0001', '2022-12-27'),
(24, 'PR-0024', 'Double Chicken', 2000, 'Chicken Pizza\", \"tomato sauce, mozzarella cheese, cocktail, shrimps salmon, mussels, lemon, parsley ', 'pizza05.png', 'CA-0001', 'CO-0001', '2022-12-27'),
(25, 'PR-0025', 'Chrismas Pizza', 3000, 'Chicken Pizza\", \"tomato sauce, mozzarella cheese, cocktail, shrimps salmon, mussels, lemon, parsley ', 'pizza07.png', 'CA-0001', 'CO-0001', '2022-12-27');

--
-- Triggers `products`
--
DELIMITER $$
CREATE TRIGGER `getproductId` BEFORE INSERT ON `products` FOR EACH ROW BEGIN
INSERT INTO id_product VALUES (NULL);
SET NEW.productId = CONCAT("PR-", LPAD(LAST_INSERT_ID(), 4, "0"));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(4) NOT NULL,
  `roleId` varchar(10) NOT NULL,
  `roleType` varchar(20) NOT NULL,
  `roleDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `roleId`, `roleType`, `roleDate`) VALUES
(1, 'RO-0001', 'Admin', '2022-12-24'),
(2, 'RO-0002', 'Manager', '2022-12-24'),
(3, 'RO-0003', 'Cashier', '2022-12-24'),
(4, 'RO-0004', 'Customer', '2022-12-24'),
(5, 'RO-0005', 'test1', '2022-12-24');

--
-- Triggers `role`
--
DELIMITER $$
CREATE TRIGGER `getroleId` BEFORE INSERT ON `role` FOR EACH ROW BEGIN
INSERT INTO id_role VALUES (NULL);
SET NEW.roleId = CONCAT("RO-", LPAD(LAST_INSERT_ID(), 4, "0"));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_session`
--

CREATE TABLE `shopping_session` (
  `ssId` varchar(50) NOT NULL,
  `userNIC` varchar(50) DEFAULT NULL,
  `ssDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopping_session`
--

INSERT INTO `shopping_session` (`ssId`, `userNIC`, `ssDate`) VALUES
('25k1aaq5aqcvq3qcfusjqatbu6', NULL, '2022-12-19'),
('2gb8i6uomghhglfoeedndnguqj', NULL, '2022-12-27'),
('907nkvmvnhnhilur9crcth6lmp', NULL, '2023-02-01'),
('b00pm7t75huqrf12k3f6rdigog', NULL, '2023-02-03'),
('ei5fse4v7mfcgehpd1hgcs039t', NULL, '2023-02-06'),
('fger5tk3ag1k1v3gcpr649e4tq', NULL, '2022-12-28'),
('o3p91vth4h440sh0v8fqjlcr2t', NULL, '2023-02-04'),
('pb2ncgpl9hfsrloq0uvk94d8p0', NULL, '2023-02-02'),
('pidg4e1dkbocn3c3ctt7vcoata', NULL, '2022-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `sp_order`
--

CREATE TABLE `sp_order` (
  `orderId` varchar(20) NOT NULL,
  `userNIC` varchar(50) DEFAULT NULL,
  `guestNIC` varchar(30) DEFAULT NULL,
  `orderDiscount` double DEFAULT NULL,
  `orderTotal` double NOT NULL,
  `orderStatus` varchar(50) NOT NULL,
  `orderDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sp_order`
--

INSERT INTO `sp_order` (`orderId`, `userNIC`, `guestNIC`, `orderDiscount`, `orderTotal`, `orderStatus`, `orderDate`) VALUES
('OID-00c87c54', '202525238V', NULL, 400, 1600, 'Processing', '2023-02-03'),
('OID-03b86ec2', NULL, 'GID-baca508d', 1200, 4800, 'Processing', '2023-02-03'),
('OID-0aff8898', NULL, 'GID-d87c4af8', 0, 2600, 'Processing', '2023-02-03'),
('OID-1b179dd8', '202525238V', NULL, 0, 2000, 'Processing', '2023-02-02'),
('OID-1fd8b348', '202525238V', NULL, 0, 4125, 'Completed', '2022-12-28'),
('OID-3d0dc956', '202525238V', NULL, 0, 1840, 'Cancelled', '2022-12-24'),
('OID-5248acc8', NULL, 'GID-b40961a8', 0, 1040, 'Processing', '2023-02-03'),
('OID-56789161', '202516238V', NULL, 0, 4300, 'Refunded', '2022-12-28'),
('OID-5d08eef8', '202525238V', NULL, 0, 6000, 'Processing', '2022-12-27'),
('OID-60487a98', '202516238V', NULL, 0, 6000, 'Preparing', '2022-12-28'),
('OID-6125fc97', '202525238V', NULL, 0, 4300, 'Processing', '2023-02-04'),
('OID-7478554a', '202525238V', NULL, 1460, 5840, 'Processing', '2023-02-03'),
('OID-84081288', NULL, 'GID-cfc8c496', 1000, 4000, 'Processing', '2023-02-03'),
('OID-86688398', '202525238V', NULL, 0, 7900, 'Processing', '2023-02-03'),
('OID-a026acb8', '202525238V', NULL, 0, 1040, 'Completed', '2022-12-22'),
('OID-a198a46c', '202525238V', NULL, 0, 3600, 'Processing', '2023-02-03'),
('OID-a588b368', '202525238V', NULL, 0, 4500, 'Processing', '2023-02-03'),
('OID-a9be9aa9', '202525238V', NULL, 2380, 9520, 'Processing', '2023-02-03'),
('OID-bb1ebc88', NULL, 'GID-04e3e2ce', 0, 1500, 'Processing', '2022-12-19'),
('OID-e9be6418', '202525238V', NULL, 520, 2080, 'Processing', '2023-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(4) NOT NULL,
  `subscriberId` varchar(10) NOT NULL,
  `subscriberName` varchar(50) NOT NULL,
  `subscriberEmail` varchar(100) NOT NULL,
  `subscriberDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `subscriberId`, `subscriberName`, `subscriberEmail`, `subscriberDate`) VALUES
(1, 'SU-0001', 'nimal', 'nimal@gmail.com', '2022-12-24'),
(2, 'SU-0002', 'amal', 'amal@gmail.com', '2022-12-24'),
(3, 'SU-0003', 'Nisha A', 'nish@gg.cc', '2023-02-01'),
(4, 'SU-0004', 'Vishwa A', 'vish@gg.cc', '2023-02-01'),
(5, 'SU-0005', 'Tesla F', 'tesla@gg.cc', '2023-02-01');

--
-- Triggers `subscriber`
--
DELIMITER $$
CREATE TRIGGER `getsubscriberId` BEFORE INSERT ON `subscriber` FOR EACH ROW BEGIN
INSERT INTO id_subscriber VALUES (NULL);
SET NEW.subscriberId = CONCAT("SU-", LPAD(LAST_INSERT_ID(), 4, "0"));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userNIC` varchar(50) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `userPassword` varchar(20) NOT NULL,
  `userFName` varchar(50) NOT NULL,
  `userLName` varchar(50) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userNumber` int(10) NOT NULL,
  `userAddress` varchar(100) NOT NULL,
  `userCity` varchar(20) NOT NULL,
  `userPostalCode` int(10) NOT NULL,
  `roleId` varchar(10) NOT NULL,
  `userDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userNIC`, `userName`, `userPassword`, `userFName`, `userLName`, `userEmail`, `userNumber`, `userAddress`, `userCity`, `userPostalCode`, `roleId`, `userDate`) VALUES
('202225225V', 'yudee', '12345678', 'Yudee', 'Perera', 'yudee@gmail.com', 778956324, '10D, gemunupura 1st lane, Maharagama', '', 0, 'RO-0002', '2022-12-24'),
('202225298V', 'vimal', '12345678', 'Vimal', 'Perera', 'vimal@gmail.com', 778956324, 'Moratuwa', '', 0, 'RO-0004', '2022-12-24'),
('202256238V', 'kamal', '12345678', 'Kamal', 'Perera', 'kamal@gmail.com', 778956321, 'Moratuwa', '', 0, 'RO-0004', '2022-12-24'),
('202256268V', 'manoj', '12345678', 'Manoj', 'Prasanna', 'manoj@gmail.com', 785263256, 'Badulla', '', 0, 'RO-0004', '2022-12-24'),
('202256278V', 'nethmi', '12345678', 'Nethmi', 'de silva', 'nethmi@gmail.com', 778523651, 'Dehiwala', '', 0, 'RO-0002', '2022-12-24'),
('202516238V', 'customer', '12345678', 'Amal', 'Perera', 'customer@gmail.com', 775236982, 'Kaduwela', 'Kaduwela', 10640, 'RO-0004', '2022-12-24'),
('202522238V', 'manager', '12345678', 'Thushan', 'Pereraa', 'manager@gmail.com', 772563489, 'Colombo 04', '', 0, 'RO-0002', '2022-12-24'),
('202525238V', 'admin', '19930908', 'Lahiru', 'Chinthana', 'lahiru@gmail.com', 785295963, '11/2, Pittugala road', 'Malabe', 10640, 'RO-0001', '2022-12-24'),
('202525244V', 'saman', '12345678', 'Saman', 'K', 'saman@gmail.com', 778956390, 'Kaluthara', '', 0, 'RO-0004', '2023-02-02'),
('9311314V', 'wafwaf', '12345678', 'awfwaf', 'awfwa', 'wafwa@gmail.com', 785263256, 'fgawfwaf', '', 0, 'RO-0004', '2022-12-24'),
('982545632V', 'cashier', '12345678', 'Super', 'Man', 'cashier@gmail.com', 778526325, 'Galle', '', 0, 'RO-0003', '2022-12-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `cartitemId` (`cartitemId`,`productId`),
  ADD KEY `session` (`sessionId`),
  ADD KEY `product` (`productId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categoryId` (`categoryId`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `couponId` (`couponId`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`guestId`),
  ADD UNIQUE KEY `guestNIC` (`guestNIC`);

--
-- Indexes for table `id_cart_item`
--
ALTER TABLE `id_cart_item`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `id_category`
--
ALTER TABLE `id_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_contact`
--
ALTER TABLE `id_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_coupon`
--
ALTER TABLE `id_coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_feedback`
--
ALTER TABLE `id_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_order`
--
ALTER TABLE `id_order`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `id_order_items`
--
ALTER TABLE `id_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_product`
--
ALTER TABLE `id_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_role`
--
ALTER TABLE `id_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id_shopping_session`
--
ALTER TABLE `id_shopping_session`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `id_subscriber`
--
ALTER TABLE `id_subscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `orderitemsId` (`orderitemsId`,`productId`),
  ADD KEY `oiproducts` (`productId`),
  ADD KEY `oiorder` (`orderId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `productId` (`productId`),
  ADD KEY `category` (`categoryId`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roleId` (`roleId`);

--
-- Indexes for table `shopping_session`
--
ALTER TABLE `shopping_session`
  ADD PRIMARY KEY (`ssId`),
  ADD UNIQUE KEY `userNIC` (`userNIC`);

--
-- Indexes for table `sp_order`
--
ALTER TABLE `sp_order`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `usernic` (`userNIC`),
  ADD KEY `guestnic` (`guestNIC`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriberId` (`subscriberId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userNIC`),
  ADD UNIQUE KEY `UNIQUE` (`userEmail`),
  ADD UNIQUE KEY `userEmail` (`userEmail`),
  ADD UNIQUE KEY `userEmail_2` (`userEmail`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD KEY `role` (`roleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `guestId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `id_cart_item`
--
ALTER TABLE `id_cart_item`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT for table `id_category`
--
ALTER TABLE `id_category`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `id_contact`
--
ALTER TABLE `id_contact`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `id_coupon`
--
ALTER TABLE `id_coupon`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `id_feedback`
--
ALTER TABLE `id_feedback`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `id_order`
--
ALTER TABLE `id_order`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `id_order_items`
--
ALTER TABLE `id_order_items`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `id_product`
--
ALTER TABLE `id_product`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `id_role`
--
ALTER TABLE `id_role`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `id_shopping_session`
--
ALTER TABLE `id_shopping_session`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `id_subscriber`
--
ALTER TABLE `id_subscriber`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `product` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `session` FOREIGN KEY (`sessionId`) REFERENCES `shopping_session` (`ssId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `oiorder` FOREIGN KEY (`orderId`) REFERENCES `sp_order` (`orderId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `oiproducts` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `category` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shopping_session`
--
ALTER TABLE `shopping_session`
  ADD CONSTRAINT `ssuser` FOREIGN KEY (`userNIC`) REFERENCES `user` (`userNIC`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sp_order`
--
ALTER TABLE `sp_order`
  ADD CONSTRAINT `guestnic` FOREIGN KEY (`guestNIC`) REFERENCES `guest` (`guestNIC`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usernic` FOREIGN KEY (`userNIC`) REFERENCES `user` (`userNIC`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `role` FOREIGN KEY (`roleId`) REFERENCES `role` (`roleId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
