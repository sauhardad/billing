-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 14, 2015 at 01:09 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `billing_db`
--
CREATE DATABASE IF NOT EXISTS `billing_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `billing_db`;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('5dc173b77ffa552086a3743e201e8ab4', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', 1429009420, 'a:2:{s:9:"user_data";s:0:"";s:9:"logged_in";a:3:{s:2:"id";s:1:"1";s:8:"username";s:9:"sauhardad";s:4:"role";s:1:"1";}}'),
('620e780275fd720bcce39a315a77a93a', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:36.0) Gecko/20100101 Firefox/36.0', 1429009569, 'a:2:{s:9:"user_data";s:0:"";s:9:"logged_in";a:3:{s:2:"id";s:1:"1";s:8:"username";s:9:"sauhardad";s:4:"role";s:1:"1";}}'),
('ea8d5f175865532d0ed187d8830c2362', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', 1429009492, 'a:2:{s:9:"user_data";s:0:"";s:9:"logged_in";a:3:{s:2:"id";s:1:"1";s:8:"username";s:9:"sauhardad";s:4:"role";s:1:"1";}}');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_amount`
--

DROP TABLE IF EXISTS `tbl_amount`;
CREATE TABLE IF NOT EXISTS `tbl_amount` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill`
--

DROP TABLE IF EXISTS `tbl_bill`;
CREATE TABLE IF NOT EXISTS `tbl_bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_no` varchar(10) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `section_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `received_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `paid` decimal(10,0) NOT NULL,
  `dues` decimal(10,0) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `event_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  KEY `level_id` (`level_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense`
--

DROP TABLE IF EXISTS `tbl_expense`;
CREATE TABLE IF NOT EXISTS `tbl_expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group`
--

DROP TABLE IF EXISTS `tbl_group`;
CREATE TABLE IF NOT EXISTS `tbl_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time_slot` varchar(20) NOT NULL,
  `is_running` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_group`
--

INSERT INTO `tbl_group` (`id`, `code`, `name`, `time_slot`, `is_running`, `user_id`, `active`, `entry_timestamp`) VALUES
(1, '02', 'Computer', '5-6', 1, 1, 1, '2015-04-14 16:47:44'),
(2, '02', 'asdasd', '234', 1, 1, 1, '2015-04-14 16:53:04'),
(3, '02', 'asdasd', '2-1', 0, 1, 1, '2015-04-14 16:53:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_income`
--

DROP TABLE IF EXISTS `tbl_income`;
CREATE TABLE IF NOT EXISTS `tbl_income` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `share_percent` int(3) NOT NULL,
  `date` date NOT NULL,
  `payment` decimal(10,0) NOT NULL,
  `dues` decimal(10,0) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `teacher_id` (`teacher_id`),
  KEY `group_id` (`group_id`),
  KEY `user_id_2` (`user_id`),
  KEY `teacher_id_2` (`teacher_id`),
  KEY `group_id_2` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_level`
--

DROP TABLE IF EXISTS `tbl_level`;
CREATE TABLE IF NOT EXISTS `tbl_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subsection_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(2) NOT NULL,
  `type` int(2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `subsection_id` (`subsection_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_section`
--

DROP TABLE IF EXISTS `tbl_section`;
CREATE TABLE IF NOT EXISTS `tbl_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subsection`
--

DROP TABLE IF EXISTS `tbl_subsection`;
CREATE TABLE IF NOT EXISTS `tbl_subsection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `code` varchar(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

DROP TABLE IF EXISTS `tbl_teacher`;
CREATE TABLE IF NOT EXISTS `tbl_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`id`, `teacher_name`, `address`, `contact_no`, `user_id`, `active`, `entry_timestamp`) VALUES
(4, 'asda', 'kjhkjh', 'kjhlkjhkjh', 0, 0, '2015-04-14 13:15:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(1) NOT NULL,
  `last_login` datetime NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `last_login`, `entry_timestamp`) VALUES
(1, 'sauhardad', '$2a$08$B8Ppzm7FU/LgyuTPgh.mEu3unxpEGpuO2KNQBzbmfUVygaogOk23.', 1, '2015-04-14 16:50:07', '2015-04-14 16:50:07'),
(3, 'nirdosh', '$2a$08$V486ZL57xO77ZJxAcA1Ko.eEiDcLUzt6C975DY5JqqVFcHJj73BIu', 2, '2015-04-13 15:52:27', '2015-04-13 15:52:27'),
(4, 'nirdosh123', '$2a$08$gMfD2LN2Dqb7yeaDeJk1Ruv6LzVRGWmK24IBOFiDj8DZWmY4uiLvi', 2, '2015-04-13 16:09:49', '2015-04-13 16:09:49');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_amount`
--
ALTER TABLE `tbl_amount`
  ADD CONSTRAINT `tbl_amount_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `tbl_teacher` (`id`);

--
-- Constraints for table `tbl_bill`
--
ALTER TABLE `tbl_bill`
  ADD CONSTRAINT `tbl_bill_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `tbl_section` (`id`),
  ADD CONSTRAINT `tbl_bill_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `tbl_level` (`id`),
  ADD CONSTRAINT `tbl_bill_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `tbl_group` (`id`);

--
-- Constraints for table `tbl_income`
--
ALTER TABLE `tbl_income`
  ADD CONSTRAINT `fk_group_id` FOREIGN KEY (`group_id`) REFERENCES `tbl_group` (`id`),
  ADD CONSTRAINT `fk_teacher_id` FOREIGN KEY (`teacher_id`) REFERENCES `tbl_teacher` (`id`);

--
-- Constraints for table `tbl_level`
--
ALTER TABLE `tbl_level`
  ADD CONSTRAINT `tbl_level_ibfk_1` FOREIGN KEY (`subsection_id`) REFERENCES `tbl_subsection` (`id`);

--
-- Constraints for table `tbl_subsection`
--
ALTER TABLE `tbl_subsection`
  ADD CONSTRAINT `tbl_subsection_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `tbl_section` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
