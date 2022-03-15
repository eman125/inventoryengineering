-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2022 at 02:09 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventoryengineering`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `upc` varchar(13) NOT NULL,
  `on_hand` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`upc`, `on_hand`, `product_name`) VALUES
('', 4, 'Pilot G2 Gel Pens, 0.7mm Black - 3ct');

-- --------------------------------------------------------

--
-- Table structure for table `stocked_product`
--

CREATE TABLE `stocked_product` (
  `upc` varchar(13) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_name`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`upc`);

--
-- Indexes for table `stocked_product`
--
ALTER TABLE `stocked_product`
  ADD KEY `FK_stocked_product_product` (`upc`),
  ADD KEY `FK_stocked_product_location` (`location_name`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stocked_product`
--
ALTER TABLE `stocked_product`
  ADD CONSTRAINT `FK_stocked_product_location` FOREIGN KEY (`location_name`) REFERENCES `location` (`location_name`),
  ADD CONSTRAINT `FK_stocked_product_product` FOREIGN KEY (`upc`) REFERENCES `product` (`upc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
