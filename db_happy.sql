-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2026 at 09:30 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_happy`
--
CREATE DATABASE IF NOT EXISTS `db_happy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_happy`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(4, 'Accessories'),
(3, 'Bottoms'),
(5, 'Innerwear'),
(2, 'Outerwear'),
(1, 'Tops');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(7, 'Flannel Checked Shirt (Long Sleeve)', 1, 30000, 20, '2026-01-15 10:37:17', '2026-01-15 18:23:02'),
(8, 'Rayon Blouse (Long Sleeve)', 1, 299000, 16, '2026-01-15 10:37:17', NULL),
(9, 'Ribbed Crew Neck T-Shirt', 1, 149000, 32, '2026-01-15 10:37:17', NULL),
(10, 'AIRism Bra Camisole', 4, 6000, 60, '2026-01-15 10:37:17', '2026-01-15 13:28:11'),
(12, 'Ultra Light Down Vest', 2, 499000, 10, '2026-01-15 10:37:17', NULL),
(13, 'Hybrid Down Coat', 2, 1499000, 6, '2026-01-15 10:37:17', NULL),
(14, 'Blocktech Parka', 2, 999000, 9, '2026-01-15 10:37:17', NULL),
(15, 'Single Breasted Coat', 2, 1299000, 5, '2026-01-15 10:37:17', NULL),
(16, 'Fleece Full-Zip Jacket', 2, 399000, 15, '2026-01-15 10:37:17', NULL),
(17, 'Fleece Pullover', 2, 299000, 20, '2026-01-15 10:37:17', NULL),
(18, 'Souffle Yarn Cardigan', 2, 399000, 14, '2026-01-15 10:37:17', NULL),
(19, 'Sweat Full-Zip Hoodie', 2, 399000, 18, '2026-01-15 10:37:17', NULL),
(20, 'MA-1 Blouson Jacket', 2, 799000, 8, '2026-01-15 10:37:17', NULL),
(21, 'Smart Ankle Pants (2-Way Stretch)', 3, 499000, 19, '2026-01-15 10:37:17', NULL),
(22, 'EZY Jeans', 3, 499000, 13, '2026-01-15 10:37:17', NULL),
(23, 'Slim Fit Chino Pants', 3, 399000, 17, '2026-01-15 10:37:17', NULL),
(24, 'Wide Fit Pleated Pants', 3, 499000, 11, '2026-01-15 10:37:17', NULL),
(25, 'Pleated Wide Pants', 3, 499000, 9, '2026-01-15 10:37:17', NULL),
(26, 'Straight Jeans', 3, 499000, 15, '2026-01-15 10:37:17', NULL),
(27, 'Relaxed Ankle Pants', 3, 399000, 12, '2026-01-15 10:37:17', NULL),
(28, 'Jogger Pants', 3, 299000, 20, '2026-01-15 10:37:17', NULL),
(29, 'Cargo Pants', 3, 499000, 10, '2026-01-15 10:37:17', NULL),
(30, 'Denim Shorts', 3, 299000, 14, '2026-01-15 10:37:17', NULL),
(31, 'AIRism Boxer Briefs', 4, 99000, 60, '2026-01-15 10:37:17', NULL),
(32, 'AIRism Mesh Boxer Briefs', 4, 99000, 55, '2026-01-15 10:37:17', NULL),
(33, 'AIRism Seamless Underwear', 4, 99000, 48, '2026-01-15 10:37:17', NULL),
(34, 'Heattech Extra Warm Crew Neck T-Shirt', 4, 199000, 30, '2026-01-15 10:37:17', NULL),
(35, 'Heattech Ultra Warm Crew Neck T-Shirt', 4, 299000, 18, '2026-01-15 10:37:17', NULL),
(36, 'Heattech Leggings', 4, 199000, 22, '2026-01-15 10:37:17', NULL),
(37, 'AIRism Ultra Seamless Briefs', 4, 99000, 40, '2026-01-15 10:37:17', NULL),
(38, 'AIRism Deodorant Body Fit T-Shirt', 4, 199000, 26, '2026-01-15 10:37:17', NULL),
(39, 'Wireless Bra (3D Hold)', 4, 399000, 9, '2026-01-15 10:37:17', '2026-01-15 14:21:19'),
(40, 'Body Shaper Shorts', 4, 199000, 16, '2026-01-15 10:37:17', NULL),
(41, 'Round Mini Shoulder Bag', 5, 199000, 35, '2026-01-15 10:37:17', NULL),
(42, 'Drawstring Bag', 5, 199000, 22, '2026-01-15 10:37:17', NULL),
(43, 'UV Protection Compact Umbrella', 5, 199000, 25, '2026-01-15 10:37:17', NULL),
(44, 'Bucket Hat', 5, 199000, 18, '2026-01-15 10:37:17', NULL),
(45, 'Baseball Cap', 5, 149000, 20, '2026-01-15 10:37:17', NULL),
(46, 'Leather Touch Belt', 5, 199000, 15, '2026-01-15 10:37:17', NULL),
(47, 'Sunglasses (Boston)', 5, 199000, 12, '2026-01-15 10:37:17', NULL),
(48, 'Socks (3 Pairs)', 5, 99000, 80, '2026-01-15 10:37:17', NULL),
(49, 'HEATTECH Gloves', 5, 149000, 24, '2026-01-15 10:37:17', NULL),
(50, 'Cashmere Scarf', 5, 399000, 10, '2026-01-15 10:37:17', NULL),
(51, 'puspita ayu anggraeni', 1, 80000, 80, '2026-01-15 13:28:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `singer`
--

CREATE TABLE `singer` (
  `Id` varchar(4) NOT NULL,
  `Singer` varchar(50) NOT NULL,
  `Gender` char(1) DEFAULT NULL,
  `Award` int(11) DEFAULT NULL,
  `Country` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `singer`
--

INSERT INTO `singer` (`Id`, `Singer`, `Gender`, `Award`, `Country`) VALUES
('P001', 'TAYLOR SWIFT', 'P', 12, 'USA'),
('P002', 'BTS', 'L', 15, 'KOR'),
('P003', 'ED SHEERAN', 'L', 10, 'UK'),
('P004', 'RIHANNA', 'P', 8, 'BAR'),
('P005', 'IU', 'P', 6, 'KOR'),
('P006', 'JUSTIN BIEBER', 'L', 9, 'CAN'),
('P007', 'AGNES MONICA', 'P', 5, 'INA'),
('P008', 'GLENN FREDLY', 'L', 4, 'INA'),
('P009', 'ADELE', 'P', 11, 'UK'),
('P010', 'BILLIE EILISH', 'P', 13, 'USA'),
('P011', 'CHARLIE PUTH', 'L', 6, 'USA'),
('P012', 'RAISA', 'P', 4, 'INA');

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `Id` varchar(4) NOT NULL,
  `Song` varchar(50) NOT NULL,
  `Genre` varchar(20) DEFAULT NULL,
  `Singer` varchar(4) DEFAULT NULL,
  `Spotify` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`Id`, `Song`, `Genre`, `Singer`, `Spotify`) VALUES
('L001', 'Love Story', 'Pop', 'P001', 950000000),
('L002', 'Dynamite', 'K-Pop', 'P002', 1200000000),
('L003', 'Shape of You', 'Pop', 'P003', 1500000000),
('L004', 'Umbrella', 'R&B', 'P004', 800000000),
('L005', 'Celebrity', 'K-Pop', 'P005', 600000000),
('L006', 'Peaches', 'R&B', 'P006', 700000000),
('L007', 'Matahariku', 'Pop', 'P007', 500000000),
('L008', 'Kasih Putih', 'Pop', 'P008', 300000000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jabatan` varchar(20) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `jabatan`, `no_telp`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', '1928798', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `singer`
--
ALTER TABLE `singer`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Singer` (`Singer`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_ibfk_1` FOREIGN KEY (`Singer`) REFERENCES `singer` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
