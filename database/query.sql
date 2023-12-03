-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2023 at 05:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `btl_ptudw`
/*DROP DATABASE tbl_ptudw;*/
CREATE DATABASE btl_ptudw;
USE btl_ptudw;
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`CategoryID`, `CategoryName`) VALUES
(1, 'Áo'),
(2, 'Quần'),
(3, 'Giày'),
(4, 'Trang sức'),
(5, 'Túi xách'),
(6, 'Mũ');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `OrderDate` date DEFAULT NULL,
  `TotalAmount` decimal(10,2) DEFAULT NULL,
  `OrderStatus` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `UserID`, `OrderDate`, `TotalAmount`, `OrderStatus`) VALUES
(1, 2, '2023-10-05', 614878.00, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `OrderID` int(11) DEFAULT NULL,
  `ProductID` int(11) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`OrderID`, `ProductID`, `Quantity`, `Price`) VALUES
(1, 48, 2, 190000.00),
(1, 47, 3, 297000.00),
(1, 46, 1, 127878.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `ProductID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `ProductName` varchar(255) DEFAULT NULL,
  `ProductDescription` text DEFAULT NULL,
  `ProductPrice` decimal(10,2) DEFAULT NULL,
  `ProductImage` varchar(255) DEFAULT NULL,
  `QuantityInStock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`ProductID`, `CategoryID`, `ProductName`, `ProductDescription`, `ProductPrice`, `ProductImage`, `QuantityInStock`) VALUES
(1, 1, 'ao_1', 'Áo', 99000.00, 'images/ao/product_1.jpg', NULL),
(2, 3, 'giay_2', 'Giày', 89000.00, 'images/giay/product_2.jpg', NULL),
(3, 2, 'quan_1', 'Quần', 99000.00, 'images/quan/product_1.jpg', NULL),
(4, 5, 'tui_xach_3', 'Túi xách', 99000.00, 'images/tui_xach/product_3.jpg', NULL),
(5, 1, 'ao_2', 'Áo', 109000.00, 'images/ao/product_2.jpg', NULL),
(6, 4, 'trang_suc_1', 'Trang sức', 79000.00, 'images/trang_suc/product_1.jpg', NULL),
(7, 6, 'mu_1', 'Mũ', 79000.00, 'images/mu/product_1.jpg', NULL),
(8, 3, 'giay_1', 'Giày', 79000.00, 'images/giay/product_1.jpg', NULL),
(9, 5, 'tui_xach_1', 'Túi xách', 79000.00, 'images/tui_xach/product_1.jpg', NULL),
(10, 1, 'ao_3', 'Áo', 199000.00, 'images/ao/product_3.jpg', NULL),
(11, 4, 'trang_suc_2', 'Trang sức', 89000.00, 'images/trang_suc/product_2.jpg', NULL),
(12, 6, 'mu_2', 'Mũ', 89000.00, 'images/mu/product_2.jpg', NULL),
(13, 2, 'quan_2', 'Quần', 109000.00, 'images/quan/product_2.jpg', NULL),
(14, 3, 'giay_3', 'Giày', 99000.00, 'images/giay/product_3.jpg', NULL),
(15, 5, 'tui_xach_2', 'Túi xách', 89000.00, 'images/tui_xach/product_2.jpg', NULL),
(16, 1, 'ao_4', 'Áo', 89000.00, 'images/ao/product_4.jpg', NULL),
(17, 4, 'trang_suc_3', 'Trang sức', 99000.00, 'images/trang_suc/product_3.jpg', NULL),
(18, 6, 'mu_3', 'Mũ', 99000.00, 'images/mu/product_3.jpg', NULL),
(19, 3, 'giay_4', 'Giày', 109000.00, 'images/giay/product_4.jpg', NULL),
(20, 5, 'tui_xach_4', 'Túi xách', 109000.00, 'images/tui_xach/product_4.jpg', NULL),
(21, 1, 'ao_5', 'Áo', 79000.00, 'images/ao/product_5.jpg', NULL),
(22, 4, 'trang_suc_4', 'Trang sức', 109000.00, 'images/trang_suc/product_4.jpg', NULL),
(23, 6, 'mu_4', 'Mũ', 109000.00, 'images/mu/product_4.jpg', NULL),
(24, 3, 'giay_5', 'Giày', 119000.00, 'images/giay/product_5.jpg', NULL),
(25, 5, 'tui_xach_5', 'Túi xách', 119000.00, 'images/tui_xach/product_5.jpg', NULL),
(26, 1, 'ao_6', 'Áo', 129000.00, 'images/ao/product_6.jpg', NULL),
(27, 4, 'trang_suc_5', 'Trang sức', 119000.00, 'images/trang_suc/product_5.jpg', NULL),
(28, 3, 'giay_6', 'Giày', 129000.00, 'images/giay/product_6.jpg', NULL),
(29, 5, 'tui_xach_6', 'Túi xách', 129000.00, 'images/tui_xach/product_6.jpg', NULL),
(30, 1, 'ao_7', 'Áo', 139000.00, 'images/ao/product_7.jpg', NULL),
(31, 4, 'trang_suc_6', 'Trang sức', 129000.00, 'images/trang_suc/product_6.jpg', NULL),
(32, 3, 'giay_7', 'Giày', 139000.00, 'images/giay/product_7.jpg', NULL),
(33, 5, 'tui_xach_7', 'Túi xách', 139000.00, 'images/tui_xach/product_7.jpg', NULL),
(34, 1, 'ao_8', 'Áo', 123456.00, 'images/ao/product_8.jpg', NULL),
(35, 4, 'trang_suc_7', 'Trang sức', 139000.00, 'images/trang_suc/product_7.jpg', NULL),
(36, 3, 'giay_8', 'Giày', 149000.00, 'images/giay/product_8.jpg', NULL),
(37, 1, 'ao_9', 'Áo', 123321.00, 'images/ao/product_9.jpg', NULL),
(38, 4, 'trang_suc_8', 'Trang sức', 149000.00, 'images/trang_suc/product_8.jpg', NULL),
(39, 3, 'giay_9', 'Giày', 159000.00, 'images/giay/product_9.jpg', NULL),
(40, 1, 'ao_10', 'Áo', 101010.00, 'images/ao/product_10.jpg', NULL),
(41, 4, 'trang_suc_9', 'Trang sức', 159000.00, 'images/trang_suc/product_9.jpg', NULL),
(42, 3, 'giay_10', 'Giày', 169000.00, 'images/giay/product_10.jpg', NULL),
(43, 1, 'ao_11', 'Áo', 88888.00, 'images/ao/product_11.jpg', NULL),
(44, 4, 'trang_suc_10', 'Trang sức', 169000.00, 'images/trang_suc/product_10.jpg', NULL),
(45, 1, 'ao_12', 'Áo', 149000.00, 'images/ao/product_12.jpg', NULL),
(46, 1, 'ao_13', 'Áo', 127878.00, 'images/ao/product_13.jpg', NULL),
(47, 1, 'ao_14', 'Áo', 99000.00, 'images/ao/product_14.jpg', NULL),
(48, 1, 'ao_15', 'Áo', 95000.00, 'images/ao/product_15.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `SliderID` int(11) NOT NULL,
  `SliderImage` text DEFAULT NULL,
  `SliderName` text DEFAULT NULL,
  `SliderDescription` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `PhoneNumber` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Email`, `Password`, `PhoneNumber`) VALUES
(2, '', 'huyhoangok2212@gmail.com', '05a70454516ecd9194c293b0e415777f', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `ProductID` (`ProductID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `CategoryID` (`CategoryID`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`SliderID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `SliderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`OrderID`) REFERENCES `orders` (`OrderID`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `products` (`ProductID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CategoryID`) REFERENCES `categories` (`CategoryID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
