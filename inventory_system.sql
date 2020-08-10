-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 01, 2020 at 12:57 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

DROP TABLE IF EXISTS `inventories`;
CREATE TABLE IF NOT EXISTS `inventories` (
  `inventory_id` int(200) NOT NULL AUTO_INCREMENT,
  `material_code` varchar(200) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `quantity` int(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `vendor` varchar(200) NOT NULL,
  `sub_vendor` varchar(200) NOT NULL,
  `location` varchar(200) NOT NULL,
  `rack` varchar(200) NOT NULL,
  `shelf` varchar(200) NOT NULL,
  `remarks` varchar(2000) NOT NULL,
  `entry_type` enum('IN','OUT') NOT NULL,
  `catalogue_no` varchar(200) NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`inventory_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`inventory_id`, `material_code`, `description`, `quantity`, `type`, `vendor`, `sub_vendor`, `location`, `rack`, `shelf`, `remarks`, `entry_type`, `catalogue_no`, `updated_on`, `created_on`) VALUES
(27, 'Testing', 'Testing', 21, 'Testing', '4', 'Testing', '2', 'Testing', 'Testing', 'Testing', 'OUT', 'n4kj21kj213213', '2020-06-24 00:00:00', '2020-06-23 00:00:00'),
(26, 'Testing', 'Testing', 21, 'Testing', '3', 'Testing', '1', 'Testing', 'Testing', 'Testing', 'OUT', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(4, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(5, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(6, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(7, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(8, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(9, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(10, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(11, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(12, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(13, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(14, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(15, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(16, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(17, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(18, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(19, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(20, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(21, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(22, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(23, 'ABCD', 'test description', 2000, 'Test', 'Jindal Steels', 'Hello Steels', 'Rourkela', 'Test Rack', 'Test Shelf', 'Bahut Badhiya', 'IN', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(24, 'Testing', 'Testing', 21, 'Testing', 'Testing', 'Testing', 'Testing', 'Testing', 'Testing', 'Testing', 'OUT', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22'),
(25, 'Testing', 'Testing', 21, 'Testing', 'Testing', 'Testing', 'Testing', 'Testing', 'Testing', 'Testing', 'OUT', 'n4kj21kj213213', '2020-06-25 07:29:18', '2020-06-24 12:18:22');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(200) NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `updated_on`, `created_on`) VALUES
(1, 'Rourkela', '2020-07-31 00:00:00', '2020-07-31 00:00:00'),
(2, 'Bhillai', '2020-07-12 18:25:07', '2020-07-12 18:18:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `last_login` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `first_name`, `last_name`, `last_login`) VALUES
(1, 'rajesh.sahu091@gmail.com', '7f2ababa423061c509f4923dd04b6cf1', 'Rajesh', 'Sahu', '2020-06-30 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `vendor_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(200) NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `vendor_name`, `updated_on`, `created_on`) VALUES
(1, 'Bhillai Steel Plant LTD', '2020-06-29 15:32:44', '2020-06-10 00:00:00'),
(3, 'Bokaro Steel Plant', '2020-06-29 15:34:15', '2020-06-29 15:34:15'),
(4, 'Rourkela Steel Plant', '2020-07-12 18:06:48', '2020-07-12 18:06:48');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
