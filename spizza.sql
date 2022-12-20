-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 05:33 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
  `sessionId` varchar(10) NOT NULL,
  `productId` varchar(10) NOT NULL,
  `cartitemQty` int(11) NOT NULL,
  `cartitemDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `categoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryId`, `categoryName`) VALUES
(1, 'CA-0001', 'Pizza'),
(2, 'CA-0002', 'Pasta'),
(3, 'CA-0003', 'Dessert'),
(4, 'CA-0004', 'Beverage');

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
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(4) NOT NULL,
  `couponId` varchar(10) NOT NULL,
  `couponCode` varchar(100) NOT NULL,
  `couponDiscount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `couponId`, `couponCode`, `couponDiscount`) VALUES
(1, 'CO-0001', 'none', 0),
(2, 'CO-0002', 'flash35', 0.35),
(3, 'CO-0003', 'flash15', 0.15);

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
-- Table structure for table `id_cart_item`
--

CREATE TABLE `id_cart_item` (
  `Id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `id_category`
--

CREATE TABLE `id_category` (
  `id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `id_category`
--

INSERT INTO `id_category` (`id`) VALUES
(1),
(2),
(3),
(4);

-- --------------------------------------------------------

--
-- Table structure for table `id_coupon`
--

CREATE TABLE `id_coupon` (
  `id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `id_coupon`
--

INSERT INTO `id_coupon` (`id`) VALUES
(1),
(2),
(3);

-- --------------------------------------------------------

--
-- Table structure for table `id_order`
--

CREATE TABLE `id_order` (
  `Id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `id_order`
--

INSERT INTO `id_order` (`Id`) VALUES
(1),
(2),
(3),
(4);

-- --------------------------------------------------------

--
-- Table structure for table `id_order_items`
--

CREATE TABLE `id_order_items` (
  `id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `id_order_items`
--

INSERT INTO `id_order_items` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6);

-- --------------------------------------------------------

--
-- Table structure for table `id_product`
--

CREATE TABLE `id_product` (
  `id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(11);

-- --------------------------------------------------------

--
-- Table structure for table `id_role`
--

CREATE TABLE `id_role` (
  `id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `id_role`
--

INSERT INTO `id_role` (`id`) VALUES
(1),
(2),
(3),
(4),
(5);

-- --------------------------------------------------------

--
-- Table structure for table `id_shopping_session`
--

CREATE TABLE `id_shopping_session` (
  `Id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `id_subscriber`
--

CREATE TABLE `id_subscriber` (
  `id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `id_subscriber`
--

INSERT INTO `id_subscriber` (`id`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `Id` int(4) NOT NULL,
  `orderitemsId` varchar(10) NOT NULL,
  `orderId` varchar(10) NOT NULL,
  `productId` varchar(10) NOT NULL,
  `orderitemsQty` int(11) NOT NULL,
  `orderitemsTotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`Id`, `orderitemsId`, `orderId`, `productId`, `orderitemsQty`, `orderitemsTotal`) VALUES
(1, 'OII-0001', 'OI-0004', 'PR-0010', 2, 4000),
(2, 'OII-0002', 'OI-0004', 'PR-0011', 1, 3000),
(3, 'OII-0003', 'OI-0004', 'PR-0010', 1, 2000),
(4, 'OII-0004', 'OI-0004', 'PR-0011', 1, 3000),
(5, 'OII-0005', 'OI-0004', 'PR-0010', 2, 2000),
(6, 'OII-0006', 'OI-0004', 'PR-0011', 3, 3000);

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
  `couponId` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Id`, `productId`, `productName`, `productPrice`, `productDescription`, `productImage`, `categoryId`, `couponId`) VALUES
(10, 'PR-0010', 'Chicken Pizza', 2000, 'Chicken Pizza\", \"tomato sauce, mozzarella cheese, cocktail, shrimps salmon, mussels, lemon, parsley', 'pizza11.png', 'CA-0001', 'CO-0002'),
(11, 'PR-0011', 'Seafood Pizza', 3000, 'Chicken Pizza\", \"tomato sauce, mozzarella cheese, cocktail, shrimps salmon, mussels, lemon, parsley', 'pizza06.png', 'CA-0001', 'CO-0001');

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
  `roleType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `roleId`, `roleType`) VALUES
(1, 'RO-0001', 'Admin'),
(2, 'RO-0002', 'Manager'),
(3, 'RO-0003', 'Cashier'),
(4, 'RO-0004', 'Customer'),
(5, 'RO-0005', 'test');

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
  `Id` int(4) NOT NULL,
  `ssId` varchar(10) NOT NULL,
  `userNIC` varchar(15) NOT NULL,
  `ssTotal` double NOT NULL,
  `ssDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `shopping_session`
--
DELIMITER $$
CREATE TRIGGER `getshoppingsessionId` BEFORE INSERT ON `shopping_session` FOR EACH ROW BEGIN
INSERT INTO id_shopping_session VALUES (NULL);
SET NEW.ssId = CONCAT("SSI-", LPAD(LAST_INSERT_ID(), 4, "0"));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sp_order`
--

CREATE TABLE `sp_order` (
  `Id` int(4) NOT NULL,
  `orderId` varchar(10) NOT NULL,
  `userNIC` varchar(15) NOT NULL,
  `orderDate` date NOT NULL,
  `orderTotal` double NOT NULL,
  `orderStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sp_order`
--

INSERT INTO `sp_order` (`Id`, `orderId`, `userNIC`, `orderDate`, `orderTotal`, `orderStatus`) VALUES
(2, 'OI-0004', '202225225V', '2022-11-09', 7000, 'Completed');

--
-- Triggers `sp_order`
--
DELIMITER $$
CREATE TRIGGER `getorderId` BEFORE INSERT ON `sp_order` FOR EACH ROW BEGIN
INSERT INTO id_order VALUES (NULL);
SET NEW.orderId = CONCAT("OI-", LPAD(LAST_INSERT_ID(), 4, "0"));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `id` int(4) NOT NULL,
  `subscriberId` varchar(10) NOT NULL,
  `subscriberName` varchar(50) NOT NULL,
  `subscriberEmail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`id`, `subscriberId`, `subscriberName`, `subscriberEmail`) VALUES
(1, 'SU-0001', 'nimal', 'nimal@gmail.com'),
(2, 'SU-0002', 'amal', 'amal@gmail.com');

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
  `userNIC` varchar(15) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `userPassword` varchar(20) NOT NULL,
  `userFName` varchar(50) NOT NULL,
  `userLName` varchar(50) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userNumber` int(10) NOT NULL,
  `userAddress` varchar(100) NOT NULL,
  `roleId` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userNIC`, `userName`, `userPassword`, `userFName`, `userLName`, `userEmail`, `userNumber`, `userAddress`, `roleId`) VALUES
('202225225V', 'yudee', '12345678', 'Yudee', 'Perera', 'yudee@gmail.com', 778956324, '10D, gemunupura 1st lane, Maharagama', 'RO-0002'),
('202225298V', 'vimal', '12345678', 'Vimal', 'Perera', 'vimal@gmail.com', 778956324, 'Moratuwa', 'RO-0004'),
('202256238V', 'kamal', '12345678', 'Kamal', 'Perera', 'kamal@gmail.com', 778956321, 'Moratuwa', 'RO-0004'),
('202256268V', 'manoj', '12345678', 'Manoj', 'Prasanna', 'manoj@gmail.com', 785263256, 'Badulla', 'RO-0004'),
('202256278V', 'nethmi', '12345678', 'Nethmi', 'de silva', 'nethmi@gmail.com', 778523651, 'Dehiwala', 'RO-0002'),
('202516238V', 'customer', '12345678', 'Amal', 'Perera', 'customer@gmail.com', 775236982, 'Kaduwela', 'RO-0004'),
('202522238V', 'manager', '12345678', 'Thushan', 'Pereraa', 'manager@gmail.com', 772563489, 'Colombo 04', 'RO-0002'),
('202525238V', 'admin', '12345678', 'Lahiru', 'Chinthana', 'lahiru@gmail.com', 785295963, 'Malabe', 'RO-0001'),
('9311314V', 'wafwaf', '12345678', 'awfwaf', 'awfwa', 'wafwa@gmail.com', 785263256, 'fgawfwaf', 'RO-0004'),
('982545632V', 'cashier', '12345678', 'Super', 'Man', 'cashier@gmail.com', 778526325, 'Galle', 'RO-0003');

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
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `couponId` (`couponId`);

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
-- Indexes for table `id_coupon`
--
ALTER TABLE `id_coupon`
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
  ADD UNIQUE KEY `couponId` (`couponId`),
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
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `ssId` (`ssId`,`userNIC`),
  ADD UNIQUE KEY `userNIC` (`userNIC`);

--
-- Indexes for table `sp_order`
--
ALTER TABLE `sp_order`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `orderId` (`orderId`,`userNIC`),
  ADD KEY `ouser` (`userNIC`);

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
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `id_cart_item`
--
ALTER TABLE `id_cart_item`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `id_category`
--
ALTER TABLE `id_category`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `id_coupon`
--
ALTER TABLE `id_coupon`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `id_order`
--
ALTER TABLE `id_order`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `id_order_items`
--
ALTER TABLE `id_order_items`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `id_product`
--
ALTER TABLE `id_product`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `id_role`
--
ALTER TABLE `id_role`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `id_shopping_session`
--
ALTER TABLE `id_shopping_session`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `id_subscriber`
--
ALTER TABLE `id_subscriber`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shopping_session`
--
ALTER TABLE `shopping_session`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_order`
--
ALTER TABLE `sp_order`
  MODIFY `Id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `category` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `coupon` FOREIGN KEY (`couponId`) REFERENCES `coupon` (`couponId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `shopping_session`
--
ALTER TABLE `shopping_session`
  ADD CONSTRAINT `ssuser` FOREIGN KEY (`userNIC`) REFERENCES `user` (`userNIC`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sp_order`
--
ALTER TABLE `sp_order`
  ADD CONSTRAINT `ouser` FOREIGN KEY (`userNIC`) REFERENCES `user` (`userNIC`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `role` FOREIGN KEY (`roleId`) REFERENCES `role` (`roleId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
