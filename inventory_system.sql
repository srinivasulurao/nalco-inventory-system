-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 11, 2020 at 06:08 PM
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
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `emp_id` int(200) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(200) NOT NULL,
  `emp_designation` varchar(200) NOT NULL,
  `emp_dop` date NOT NULL,
  `emp_dob` date NOT NULL,
  `emp_blood_grp` varchar(200) NOT NULL,
  `emp_phone` varchar(200) NOT NULL,
  `emp_mail` varchar(200) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`emp_id`, `emp_name`, `emp_designation`, `emp_dop`, `emp_dob`, `emp_blood_grp`, `emp_phone`, `emp_mail`) VALUES
(4, 'Rajesh Sahu', 'General Manager', '2020-10-15', '2020-10-28', '0+', '986155132', 'rajesh.sahu@gmail.com'),
(5, 'Chinmaya Das', 'General Manager', '2020-10-05', '2020-10-20', '0+', '8792394035', 'chinmaya.das@gmail.com');

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
-- Table structure for table `shift_logs`
--

DROP TABLE IF EXISTS `shift_logs`;
CREATE TABLE IF NOT EXISTS `shift_logs` (
  `shift_log_id` int(200) NOT NULL AUTO_INCREMENT,
  `log_date` date NOT NULL,
  `emp_id` int(200) NOT NULL,
  `shift` varchar(200) NOT NULL,
  `editable` int(200) NOT NULL,
  PRIMARY KEY (`shift_log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift_logs`
--

INSERT INTO `shift_logs` (`shift_log_id`, `log_date`, `emp_id`, `shift`, `editable`) VALUES
(1, '2020-10-11', 4, 'A', 1),
(2, '2020-10-14', 5, 'A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shift_log_particulars`
--

DROP TABLE IF EXISTS `shift_log_particulars`;
CREATE TABLE IF NOT EXISTS `shift_log_particulars` (
  `log_particular_id` int(200) NOT NULL AUTO_INCREMENT,
  `equipment_affected` varchar(200) NOT NULL,
  `nature_job_defect` varchar(2000) NOT NULL,
  `reporting_time` time NOT NULL,
  `handover_time` time NOT NULL,
  `emp_id` int(200) NOT NULL,
  `shift_log_id` int(11) NOT NULL,
  PRIMARY KEY (`log_particular_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shift_log_particulars`
--

INSERT INTO `shift_log_particulars` (`log_particular_id`, `equipment_affected`, `nature_job_defect`, `reporting_time`, `handover_time`, `emp_id`, `shift_log_id`) VALUES
(1, 'Severe Damage to the turbine magnets.', 'Repair Done', '18:25:00', '06:19:00', 5, 1),
(2, 'Computer accessories not working.', 'Repair Done', '18:25:00', '18:25:00', 4, 1),
(3, 'Capacitor not working', 'Replacement Required', '18:25:00', '18:25:00', 5, 2);

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
