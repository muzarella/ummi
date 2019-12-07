-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 31, 2009 at 11:03 PM
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
-- Table structure for table `current_session`
--

DROP TABLE IF EXISTS `current_session`;
CREATE TABLE IF NOT EXISTS `current_session` (
  `session_id` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `current_session`
--

INSERT INTO `current_session` (`session_id`, `session`, `reg_date`, `update_date`) VALUES
(1, '2018/2019', '2019-03-12 11:03:29', '2019-03-12 11:03:29');

-- --------------------------------------------------------

--
-- Table structure for table `current_term`
--

DROP TABLE IF EXISTS `current_term`;
CREATE TABLE IF NOT EXISTS `current_term` (
  `term_id` int(11) NOT NULL AUTO_INCREMENT,
  `term` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`term_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `current_term`
--

INSERT INTO `current_term` (`term_id`, `term`, `reg_date`, `update_date`) VALUES
(1, 'FIRST TERM', '2019-03-12 11:05:14', '2019-03-12 11:05:14');

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_class`
--

INSERT INTO `tbl_class` (`class_id`, `teacher_id`, `class`, `class_code`, `teacher_assigned`, `reg_date`, `update_date`) VALUES
(1, 1, 'PRIMARY 1', 'PRI 1', 'ALAUSA BABATUNDE', '2019-01-28 22:16:30', '2019-02-09 11:39:30'),
(5, 4, 'PRIMARY 3', 'PRY 3', 'Muhammed Aisha', '2019-02-09 10:17:54', '2019-03-15 23:06:46'),
(4, 2, 'PRIMARY 2', 'PRY 2', 'Muhammed Aisha', '2019-02-09 10:17:28', '2019-02-09 10:17:28'),
(6, 3, 'PRIMARY 4', 'PRY 4 ', 'Muhammed Aisha', '2019-03-30 12:04:10', '2019-03-30 12:04:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_details`
--

DROP TABLE IF EXISTS `tbl_details`;
CREATE TABLE IF NOT EXISTS `tbl_details` (
  `detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `vacation_date` varchar(255) NOT NULL,
  `resumption_date` varchar(255) NOT NULL,
  PRIMARY KEY (`detail_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_details`
--

INSERT INTO `tbl_details` (`detail_id`, `vacation_date`, `resumption_date`) VALUES
(1, '10th, April 2019', '3rd, May 2019');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_result`
--

DROP TABLE IF EXISTS `tbl_result`;
CREATE TABLE IF NOT EXISTS `tbl_result` (
  `result_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL,
  `term_id` int(11) NOT NULL,
  `first_test` int(11) NOT NULL,
  `second_test` int(11) NOT NULL,
  `exam_score` int(11) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edit_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`result_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_result`
--

INSERT INTO `tbl_result` (`result_id`, `student_id`, `class_id`, `subject_id`, `session_id`, `term_id`, `first_test`, `second_test`, `exam_score`, `upload_date`, `edit_date`) VALUES
(1, 1, 1, 1, 1, 1, 20, 20, 60, '2019-03-04 22:13:51', '2019-03-13 11:08:57'),
(2, 1, 1, 3, 1, 1, 15, 18, 55, '2019-03-04 22:13:51', '2019-03-13 11:08:57'),
(7, 2, 1, 1, 1, 1, 20, 20, 60, '2019-03-13 11:44:50', '2019-03-14 09:28:12'),
(8, 2, 1, 3, 1, 1, 5, 10, 20, '2019-03-13 11:44:50', '2019-03-27 22:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school_fees`
--

DROP TABLE IF EXISTS `tbl_school_fees`;
CREATE TABLE IF NOT EXISTS `tbl_school_fees` (
  `fees_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `class_fees` varchar(255) NOT NULL,
  PRIMARY KEY (`fees_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_school_fees`
--

INSERT INTO `tbl_school_fees` (`fees_id`, `class_id`, `class_fees`) VALUES
(1, 1, '11,000'),
(2, 2, '11,000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_session`
--

DROP TABLE IF EXISTS `tbl_session`;
CREATE TABLE IF NOT EXISTS `tbl_session` (
  `session_id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_session`
--

INSERT INTO `tbl_session` (`session_id`, `session`, `create_date`, `update_date`) VALUES
(1, '2018/2019', '2019-03-12 11:04:37', '2019-03-12 11:04:37');

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
(2, 1, 1, 'Elisaha', 'Blessing', 'mumu', 'Female', '1981-03-26', 'Elisha munirt', '3444356546456', 'wjgis,kngn,bnsigsgshgu\r\n                        ', '../uploads/BeautyPlus_20180709092112_save.jpg', '0000-00-00 00:00:00', '2019-03-13 11:13:00');

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
(2, 2, 3, 1, 'PRIMARY 3', '2019-02-05 13:29:53', '2019-03-27 14:55:20'),
(3, 3, 4, 1, 'PRIMARY 2', '2019-02-07 00:57:39', '2019-03-27 14:55:26');

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
(1, 'Alausa', 'babatunde', 'mubarak', 'admin', 'admin', 'muzarelladafirst@gmail.com', 1, 'admin', 'mr', '2019-01-25 11:25:16', '2019-03-15 22:44:09'),
(2, 'Muhammed', 'Aisha', 'bisola', 'muhammed', 'admin', 'muhammed@gmail.com', 2, 'teacher', 'mr', '2019-02-02 18:10:32', '2019-02-02 18:10:32'),
(3, 'Muhammed', 'Aisha', 'bisola', 'coper', 'admin', 'muhammed@gmail.com', 3, 'teacher', 'mr', '2019-02-02 18:10:41', '2019-03-15 22:43:24');

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

--
-- Dumping data for table `tbl_term`
--

INSERT INTO `tbl_term` (`term_id`, `term`, `reg_date`, `update_date`) VALUES
(1, 'FIRST TERM', '2019-03-12 11:06:20', '2019-03-12 11:06:20'),
(2, 'SECOND TERM', '2019-03-12 11:07:03', '2019-03-12 11:07:03'),
(3, 'THIRD TERM', '2019-03-12 11:07:03', '2019-03-12 11:07:03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
