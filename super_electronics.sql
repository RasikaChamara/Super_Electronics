-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 28, 2023 at 07:55 AM
-- Server version: 5.7.40
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `super_electronics`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(6) NOT NULL AUTO_INCREMENT,
  `category` varchar(25) NOT NULL,
  `item` varchar(20) NOT NULL,
  `quantity` int(5) NOT NULL,
  `outlet_id` varchar(6) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `outlet_id` (`outlet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `category`, `item`, `quantity`, `outlet_id`) VALUES
(2, 'entertainment', 'Party Lights', 5, '0'),
(4, 'cleaners', 'Auto AI cleaner', 7, '0'),
(5, 'cosmetics', 'Hair dryer', 8, '0'),
(6, 'cleaners', 'Vacuum Cleaner', 2, '0'),
(10, 'lightings', 'CFL Lights', 78, '0'),
(12, 'entertainment', 'TV', 2, '0'),
(13, 'cleaners', 'Auto AI cleaner', 3, '0');

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

DROP TABLE IF EXISTS `outlet`;
CREATE TABLE IF NOT EXISTS `outlet` (
  `outlet_id` varchar(6) NOT NULL,
  `location` varchar(20) NOT NULL,
  `outlet_phone_no` varchar(12) NOT NULL,
  PRIMARY KEY (`outlet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`outlet_id`, `location`, `outlet_phone_no`) VALUES
('ol200', 'Kandy', '0117893654'),
('ol201', 'Kegalle', '0357896314'),
('ol202', 'Negambo', '0114563287'),
('ol203', 'Colombo 03', '0117853694'),
('ol204', 'Colombo 04', '0114236589'),
('ol205', 'Ja-Ela', '0117532479'),
('ol206', 'Nawala', '0113254789'),
('ol207', 'Nugegoda', '0112543698'),
('ol208', 'Mirigama', '0115632478'),
('ol209', 'Kaduwela', '0117893654'),
('ol210', 'Mathale', '0667893214'),
('ol211', 'Ganemulla', '0112589634');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `staff_id` varchar(6) NOT NULL,
  `staff_name` varchar(30) NOT NULL,
  `staff_phone_no` varchar(12) NOT NULL,
  `outlet_id` varchar(6) NOT NULL,
  `job_description` varchar(50) NOT NULL,
  PRIMARY KEY (`staff_id`),
  KEY `outlet_id` (`outlet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_name`, `staff_phone_no`, `outlet_id`, `job_description`) VALUES
('st100', 'K.L. Priyantha', '0758976354', 'ol200', 'collection'),
('st101', 'H.I. Kamani', '0778963542', 'ol208', 'accounts'),
('st105', 'Y.L. Bandara', '0789635412', 'ol210', 'transaction'),
('st108', 'T.T Perera', '0769874523', 'ol201', 'transport'),
('st140', 'U.L. Shiva', '0703579514', 'ol200', 'QA'),
('st155', 'M.N. Milhan', '0743214698', 'ol209', 'Inspection'),
('st180', 'H.K. Nilani', '0786321458', 'ol200', 'management and inspection');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `address`, `username`, `password`, `email`) VALUES
('Test', '4/24/test', 'test', '8776f108e247ab1e2b323042c049c266407c81fbad41bde1e8dfc1bb66fd267e', 'test@gmail.com'),
('test2', '78/test2', 'test2', '0739fbc50cf77880fc76ec7ece8888f0a7a99265a893a60615fd90e8f542935a', 'test2@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`outlet_id`) REFERENCES `outlet` (`outlet_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
