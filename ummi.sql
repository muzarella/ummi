-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 02, 2019 at 10:32 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ummi`
--

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

DROP TABLE IF EXISTS `tbl_class`;
CREATE TABLE IF NOT EXISTS `tbl_class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `class` varchar(255) NOT NULL,
  `class_code` varchar(255) NOT NULL,
  `teacher_assigned` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `class_id` (`class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_class`
--

INSERT INTO `tbl_class` (`class_id`, `teacher_id`, `class`, `class_code`, `teacher_assigned`, `reg_date`, `update_date`) VALUES
(1, 1, 'PRIMARY 1', 'PRI 1', 'ALAUSA BABATUNDE', '2019-01-28 22:16:30', '2019-02-09 11:39:30'),
(5, 3, 'PRIMARY 3', 'PRY 3', 'Muhammed Aisha', '2019-02-09 10:17:54', '2019-02-09 10:17:54'),
(4, 2, 'PRIMARY 2', 'PRY 2', 'Muhammed Aisha', '2019-02-09 10:17:28', '2019-02-09 10:17:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

DROP TABLE IF EXISTS `tbl_student`;
CREATE TABLE IF NOT EXISTS `tbl_student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `other_name` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `guardian_name` varchar(50) NOT NULL,
  `guardian_phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL,
  `update_date` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`student_id`, `teacher_id`, `class_id`, `surname`, `first_name`, `other_name`, `gender`, `dob`, `guardian_name`, `guardian_phone`, `address`, `image`, `reg_date`, `update_date`) VALUES
(1, 1, 1, 'Aliko', 'Isah', 'Muhammad', 'Male', '2005-01-08', 'Aliko Luffy', '12345678987', '27 victoria island lagos state.\r\n                                                ', '../uploads/BeautyPlus_20180610083120_save.jpg', '0000-00-00 00:00:00', '2019-02-14 22:45:54'),
(2, 1, 4, 'Elisaha', 'Blessing', 'mumu', 'Female', '1981-03-26', 'Elisha munirt', '3444356546456', 'wjgis,kngn,bnsigsgshgu\r\n                        ', '../uploads/BeautyPlus_20180709092112_save.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

DROP TABLE IF EXISTS `tbl_subject`;
CREATE TABLE IF NOT EXISTS `tbl_subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subjectlist_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`subject_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`subject_id`, `subjectlist_id`, `class_id`, `teacher_id`, `class_name`, `reg_date`, `update_date`) VALUES
(1, 1, 1, 1, 'PRIMARY 1', '2019-01-29 10:48:51', '2019-02-28 18:40:02'),
(2, 1, 3, 1, 'PRIMARY 2', '2019-02-05 13:29:53', '2019-02-28 18:40:10'),
(3, 2, 1, 1, 'PRIMARY 1', '2019-02-07 00:57:39', '2019-02-28 18:40:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject_list`
--

DROP TABLE IF EXISTS `tbl_subject_list`;
CREATE TABLE IF NOT EXISTS `tbl_subject_list` (
  `subjectlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) NOT NULL,
  `subject_code` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`subjectlist_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subject_list`
--

INSERT INTO `tbl_subject_list` (`subjectlist_id`, `subject_name`, `subject_code`, `reg_date`, `update_date`) VALUES
(1, 'MATHEMATICS', 'MATH', '2019-02-28 18:39:17', '2019-02-28 18:39:17'),
(2, 'ENGLISH LANGUAGE', 'ENG', '2019-02-28 18:39:17', '2019-02-28 18:39:17'),
(3, 'COMPUTER SCIENCE', 'COMP', '2019-02-28 18:39:17', '2019-02-28 18:39:17'),
(4, 'SOCIAL STUDY', 'SOC', '2019-02-28 18:39:17', '2019-02-28 18:39:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teachers`
--

DROP TABLE IF EXISTS `tbl_teachers`;
CREATE TABLE IF NOT EXISTS `tbl_teachers` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `last_name` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `class_id` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`teacher_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_teachers`
--

INSERT INTO `tbl_teachers` (`teacher_id`, `last_name`, `first_name`, `middle_name`, `username`, `password`, `email`, `class_id`, `status`, `gender`, `reg_date`, `update_date`) VALUES
(1, 'Alausa', 'babatunde', 'mubarak', 'admin', 'admin', 'muzarelladafirst@gmail.com', 1, 'admin', '', '2019-01-25 11:25:16', '2019-01-25 11:23:55'),
(2, 'Muhammed', 'Aisha', 'bisola', 'muhammed', 'admin', 'muhammed@gmail.com', 2, 'teacher', 'mr', '2019-02-02 18:10:32', '2019-02-02 18:10:32'),
(3, 'Muhammed', 'Aisha', 'bisola', 'muhammed', 'admin', 'muhammed@gmail.com', 2, 'teacher', 'mr', '2019-02-02 18:10:41', '2019-02-02 18:10:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_term`
--

DROP TABLE IF EXISTS `tbl_term`;
CREATE TABLE IF NOT EXISTS `tbl_term` (
  `term_id` int(11) NOT NULL,
  `term` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`term_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
