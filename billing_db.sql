-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 24, 2015 at 11:09 AM
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
('d412ff401bf80164e67b16917f9e340a', '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:36.0) Gecko/20100101 Firefox/36.0', 1429866504, 'a:2:{s:9:"user_data";s:0:"";s:9:"logged_in";a:3:{s:2:"id";s:1:"1";s:8:"username";s:9:"sauhardad";s:4:"role";s:1:"1";}}'),
('ef40988f341fce32e37ad6eb409ca71a', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36', 1429866140, 'a:2:{s:9:"user_data";s:0:"";s:9:"logged_in";a:3:{s:2:"id";s:1:"1";s:8:"username";s:9:"sauhardad";s:4:"role";s:1:"1";}}');

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
  `date` varchar(10) NOT NULL,
  `particulars` varchar(255) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_expense`
--

INSERT INTO `tbl_expense` (`id`, `date`, `particulars`, `amount`, `user_id`, `active`, `entry_timestamp`) VALUES
(13, '04/20/2015', 'mnbv', '5432', 1, 1, '2015-04-24 14:40:12'),
(14, '04/25/2015', 'Photocopy', '1200', 1, 1, '2015-04-24 14:48:31'),
(15, '04/06/2015', 'Books', '3000', 1, 1, '2015-04-24 14:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_group`
--

DROP TABLE IF EXISTS `tbl_group`;
CREATE TABLE IF NOT EXISTS `tbl_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subsection_id` int(11) NOT NULL,
  `code` varchar(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time_slot` varchar(20) NOT NULL,
  `is_running` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `subsection_id` (`subsection_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_group`
--

INSERT INTO `tbl_group` (`id`, `subsection_id`, `code`, `name`, `time_slot`, `is_running`, `user_id`, `active`, `entry_timestamp`) VALUES
(10, 5, '03', 'Com C', '5-6', 1, 1, 1, '2015-04-20 13:00:28'),
(11, 5, '01', 'Com A', '1-2', 1, 1, 1, '2015-04-20 13:04:23');

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
  `date` varchar(10) NOT NULL,
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
  `code` varchar(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_section`
--

INSERT INTO `tbl_section` (`id`, `code`, `name`, `user_id`, `active`, `entry_timestamp`) VALUES
(1, '12', 'Computer 1', 1, 1, '2015-04-20 18:28:21'),
(2, '12', 'Tuition', 1, 1, '2015-04-15 13:41:54'),
(3, '13', 'Consultancy', 1, 1, '2015-04-15 13:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_students`
--

DROP TABLE IF EXISTS `tbl_students`;
CREATE TABLE IF NOT EXISTS `tbl_students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `subsection_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`id`, `section_id`, `subsection_id`, `group_id`, `teacher_id`, `student_name`, `address`, `contact_no`, `dob`, `photo`, `user_id`, `active`, `entry_timestamp`) VALUES
(35, 1, 5, 10, 7, 'Nirdosh', 'kirtipur', '9841168519', '10/01/2072', 'ppl.jpg', 1, 1, '2015-04-24 13:34:02'),
(36, 1, 5, 11, 7, 'Sauharda', '', '', '', '', 1, 1, '2015-04-24 12:47:48'),
(37, 1, 5, 10, 9, 'Sameer Aryal', '', '', '', '', 1, 1, '2015-04-24 12:48:02'),
(38, 1, 5, 10, 7, 'Manish Dawadi', '', '', '', '', 1, 1, '2015-04-24 12:48:15'),
(39, 1, 5, 10, 7, 'Bishal Khanal', '', '', '', '', 1, 1, '2015-04-24 12:48:28'),
(40, 1, 5, 10, 7, 'Pramod Kattel', '', '', '', '', 1, 1, '2015-04-24 12:48:41'),
(41, 1, 5, 10, 7, 'Manaram Poudel', '', '', '', '', 1, 1, '2015-04-24 12:48:58'),
(42, 1, 5, 10, 7, 'Nilam Parajuli', '', '', '', '', 1, 1, '2015-04-24 12:49:15'),
(43, 1, 5, 10, 7, 'Sahaj Neupane', '', '', '', '', 1, 1, '2015-04-24 12:49:25'),
(44, 1, 5, 11, 9, 'Narendra Bista', 'Kalanki', '984109755', '09/01/2072', '', 1, 1, '2015-04-24 14:30:19');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_subsection`
--

INSERT INTO `tbl_subsection` (`id`, `section_id`, `code`, `name`, `user_id`, `active`, `entry_timestamp`) VALUES
(1, 3, '02', 'CCNA', 1, 1, '2015-04-15 16:58:04'),
(3, 2, '12', 'Physics ', 1, 1, '2015-04-17 17:20:48'),
(5, 1, '12', 'Dot Net 1', 1, 1, '2015-04-17 17:32:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

DROP TABLE IF EXISTS `tbl_teacher`;
CREATE TABLE IF NOT EXISTS `tbl_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`id`, `name`, `address`, `contact_no`, `user_id`, `active`, `entry_timestamp`) VALUES
(7, 'Ram Prasad Sharma', 'kalanki', '9841009755', 1, 1, '2015-04-24 14:53:39'),
(9, 'Mahesh Joshi', 'lokanthalli 16', '9841168519', 1, 1, '2015-04-24 14:53:56');

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
(1, 'sauhardad', '$2a$08$B8Ppzm7FU/LgyuTPgh.mEu3unxpEGpuO2KNQBzbmfUVygaogOk23.', 1, '2015-04-24 12:47:25', '2015-04-24 12:47:25'),
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
-- Constraints for table `tbl_group`
--
ALTER TABLE `tbl_group`
  ADD CONSTRAINT `tbl_group_ibfk_1` FOREIGN KEY (`subsection_id`) REFERENCES `tbl_subsection` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `tbl_students`
--
ALTER TABLE `tbl_students`
  ADD CONSTRAINT `tbl_students_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `tbl_teacher` (`id`);

--
-- Constraints for table `tbl_subsection`
--
ALTER TABLE `tbl_subsection`
  ADD CONSTRAINT `tbl_subsection_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `tbl_section` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
