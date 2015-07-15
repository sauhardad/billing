-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 14, 2015 at 09:51 AM
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
('beaa0f4129ef7ee5a4f219d8c4a7e397', '127.0.0.1', 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/43.0.2357.81 Safari/537.36', 1436860186, 'a:2:{s:9:"user_data";s:0:"";s:9:"logged_in";a:3:{s:2:"id";s:1:"1";s:8:"username";s:9:"sauhardad";s:4:"role";s:1:"1";}}');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill_payment`
--

DROP TABLE IF EXISTS `tbl_bill_payment`;
CREATE TABLE IF NOT EXISTS `tbl_bill_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `bill_no` varchar(10) NOT NULL,
  `paid_amount` decimal(10,0) NOT NULL,
  `date` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `bill_id` (`bill_no`),
  KEY `bill_id_2` (`bill_no`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_bill_payment`
--

INSERT INTO `tbl_bill_payment` (`id`, `student_id`, `bill_no`, `paid_amount`, `date`, `user_id`, `entry_timestamp`) VALUES
(3, 1, '123', '4000', '29/05/2015', 1, '2015-05-29 13:52:17'),
(4, 1, '12345', '1000', '29/05/2015', 1, '2015-05-29 13:52:36'),
(5, 2, '111', '3000', '29/05/2015', 1, '2015-05-29 13:54:16'),
(6, 3, '1234', '4000', '01/06/2015', 3, '2015-06-10 12:35:58'),
(7, 4, '1234', '11000', '09/06/2015', 3, '2015-06-09 18:31:44'),
(8, 5, '345', '5000', '09/06/2015', 3, '2015-06-01 18:31:44'),
(9, 4, '9', '20', '10/06/2015', 1, '2015-06-10 13:40:13'),
(10, 4, '10', '20', '10/06/2015', 1, '2015-06-10 13:40:27'),
(11, 1, '11', '100', '14/07/2015', 1, '2015-07-14 11:49:47');

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
(13, '04/20/2015', 'Stationary', '5432', 1, 1, '2015-04-24 16:31:52'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tbl_group`
--

INSERT INTO `tbl_group` (`id`, `subsection_id`, `code`, `name`, `time_slot`, `is_running`, `user_id`, `active`, `entry_timestamp`) VALUES
(13, 1, '12', 'ABD', '6-7', 1, 1, 1, '2015-06-05 11:34:58'),
(14, 5, '13', 'Java', '6-7', 0, 1, 1, '2015-06-10 14:01:09'),
(15, 1, '14', 'CCNA', '3-5', 1, 1, 1, '2015-06-05 11:35:07'),
(16, 5, '15', 'Java 2', '3-5', 1, 1, 1, '2015-06-03 15:34:56'),
(17, 1, '23', 'JNCIA', '3-4', 1, 1, 1, '2015-06-05 16:02:52'),
(18, 5, '45', 'GIngerbread 12', '3-6', 1, 1, 1, '2015-06-10 13:53:32');

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
  `share` decimal(10,0) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_income`
--

INSERT INTO `tbl_income` (`id`, `teacher_id`, `group_id`, `total`, `share`, `date`, `payment`, `dues`, `remarks`, `user_id`, `active`, `entry_timestamp`) VALUES
(2, 7, 13, '11100', '1110', '06/03/2015', '8000', '3100', 'Paid', 1, 1, '2015-06-01 13:42:21'),
(3, 7, 14, '4000', '400', '06/03/2015', '3000', '1000', 'Remaining', 1, 1, '2015-06-01 13:42:40');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_section`
--

INSERT INTO `tbl_section` (`id`, `code`, `name`, `user_id`, `active`, `entry_timestamp`) VALUES
(1, '12', 'Computer System', 1, 1, '2015-05-27 13:31:23'),
(2, '12', 'Tuition', 1, 1, '2015-04-15 13:41:54'),
(3, '13', 'Consultancy', 1, 1, '2015-04-15 13:42:09'),
(4, '14', 'Language', 1, 1, '2015-05-27 13:52:26');

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
  `student_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_students`
--

INSERT INTO `tbl_students` (`id`, `section_id`, `subsection_id`, `group_id`, `student_name`, `address`, `contact_no`, `dob`, `photo`, `user_id`, `active`, `entry_timestamp`) VALUES
(1, 1, 5, 13, 'Nirdosh Bista', 'Kalanki', '', '05/13/2015', '', 1, 1, '2015-05-29 12:48:21'),
(2, 1, 5, 13, 'Sauharda Dawadi', 'Syuchatar', '9841009755', '05/20/2015', '', 1, 1, '2015-05-29 13:53:16'),
(3, 1, 5, 14, 'Ramhari Sedhain', 'Balaju', '987766587', '', '', 1, 1, '2015-06-01 13:02:01'),
(4, 1, 5, 14, 'Preeti Kafle', 'Kalanki', '21323986', '06/11/2015', '', 1, 1, '2015-06-01 14:24:40'),
(5, 3, 1, 15, 'Narendra Bista', 'Sitapaila', '', '', '', 1, 1, '2015-06-05 15:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_course`
--

DROP TABLE IF EXISTS `tbl_student_course`;
CREATE TABLE IF NOT EXISTS `tbl_student_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `teacher_id` int(255) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tbl_student_course`
--

INSERT INTO `tbl_student_course` (`id`, `student_id`, `subject`, `teacher_id`, `amount`, `user_id`, `active`, `entry_timestamp`) VALUES
(11, 1, 'Physics', 7, '2000', 1, 0, '2015-05-29 13:52:02'),
(12, 2, 'Mathematics', 7, '2000', 1, 0, '2015-05-29 13:53:38'),
(13, 2, 'Physics', 7, '2000', 1, 0, '2015-05-29 13:53:53'),
(14, 1, 'Social', 7, '2100', 1, 0, '2015-06-01 11:08:25'),
(15, 3, 'Mathematics', 7, '4000', 1, 0, '2015-06-01 13:02:13'),
(19, 2, 'Mathematics', 10, '2200', 1, 0, '2015-06-03 12:20:45'),
(20, 5, 'Module 1', 10, '2300', 1, 0, '2015-06-05 15:02:06'),
(21, 5, 'Module 2', 10, '3000', 1, 0, '2015-06-05 15:02:23'),
(22, 4, 'Nepali', 10, '12000', 1, 0, '2015-06-09 18:24:13');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_subsection`
--

INSERT INTO `tbl_subsection` (`id`, `section_id`, `code`, `name`, `user_id`, `active`, `entry_timestamp`) VALUES
(1, 3, '02', 'CCNA', 1, 1, '2015-04-15 16:58:04'),
(3, 2, '12', 'Physics ', 1, 1, '2015-04-17 17:20:48'),
(5, 1, '12', 'Dot Net 1', 1, 1, '2015-04-17 17:32:57'),
(6, 4, '12', 'English', 1, 1, '2015-05-27 13:52:40');

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
  `share_percent` int(3) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `entry_timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`id`, `name`, `address`, `contact_no`, `share_percent`, `user_id`, `active`, `entry_timestamp`) VALUES
(7, 'Ram Prasad Sharma', 'kalanki', '9841009755', 10, 1, 1, '2015-06-01 13:41:35'),
(9, 'Mahesh Joshi', 'lokanthalli 16', '9841168519', 30, 1, 1, '2015-06-01 13:21:53'),
(10, 'Priya Karki', 'Bhaktapur', '98765467', 20, 1, 1, '2015-06-01 13:18:43');

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
(1, 'sauhardad', '$2a$08$B8Ppzm7FU/LgyuTPgh.mEu3unxpEGpuO2KNQBzbmfUVygaogOk23.', 1, '2015-07-14 11:48:56', '2015-07-14 11:48:56'),
(3, 'nirdosh', '$2a$08$V486ZL57xO77ZJxAcA1Ko.eEiDcLUzt6C975DY5JqqVFcHJj73BIu', 2, '2015-04-13 15:52:27', '2015-04-13 15:52:27'),
(4, 'nirdosh123', '$2a$08$gMfD2LN2Dqb7yeaDeJk1Ruv6LzVRGWmK24IBOFiDj8DZWmY4uiLvi', 2, '2015-04-13 16:09:49', '2015-04-13 16:09:49');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bill_payment`
--
ALTER TABLE `tbl_bill_payment`
  ADD CONSTRAINT `tbl_bill_payment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `tbl_students` (`id`);

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
-- Constraints for table `tbl_student_course`
--
ALTER TABLE `tbl_student_course`
  ADD CONSTRAINT `tbl_student_course_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `tbl_students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_student_course_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `tbl_teacher` (`id`);

--
-- Constraints for table `tbl_subsection`
--
ALTER TABLE `tbl_subsection`
  ADD CONSTRAINT `tbl_subsection_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `tbl_section` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
