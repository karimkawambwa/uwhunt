
-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2013 at 07:35 PM
-- Server version: 5.5.32-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chataloo_HUNT`
--
CREATE DATABASE IF NOT EXISTS `chataloo_HUNT` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `chataloo_HUNT`;

-- --------------------------------------------------------

--
-- Table structure for table `Company`
--

CREATE TABLE IF NOT EXISTS `Company` (
  `idCompany` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE latin1_general_ci DEFAULT NULL,
  `city` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `country` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `address` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `postal_code` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`idCompany`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Employment`
--

CREATE TABLE IF NOT EXISTS `Employment` (
  `employment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Student_student_id` int(10) unsigned NOT NULL,
  `House_idHouse` int(10) unsigned NOT NULL,
  `Company_idCompany` int(10) unsigned NOT NULL,
  `position` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`employment_id`),
  KEY `Employment_FKIndex1` (`Student_student_id`),
  KEY `Employment_FKIndex2` (`Company_idCompany`),
  KEY `Employment_FKIndex3` (`House_idHouse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `House`
--

CREATE TABLE IF NOT EXISTS `House` (
  `idHouse` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `House_Owner_owner_id` int(10) unsigned NOT NULL,
  `city` varchar(54) COLLATE latin1_general_ci DEFAULT NULL,
  `provience` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `postalcode` varchar(12) COLLATE latin1_general_ci DEFAULT NULL,
  `occupant_capacity` int(10) unsigned DEFAULT NULL,
  `date_added` timestamp NULL DEFAULT NULL,
  `rent_price` double DEFAULT NULL,
  `last_editted` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idHouse`),
  KEY `House_FKIndex1` (`House_Owner_owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `House_Image`
--

CREATE TABLE IF NOT EXISTS `House_Image` (
  `image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `House_idHouse` int(10) unsigned NOT NULL,
  `image_type` varchar(12) COLLATE latin1_general_ci DEFAULT NULL,
  `image` longblob,
  `image_size` varchar(25) COLLATE latin1_general_ci DEFAULT NULL,
  `image_name` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  KEY `House_Pictures_FKIndex1` (`House_idHouse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `House_Owner`
--

CREATE TABLE IF NOT EXISTS `House_Owner` (
  `owner_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) COLLATE latin1_general_ci DEFAULT NULL,
  `last_name` varchar(64) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(82) COLLATE latin1_general_ci DEFAULT NULL,
  `phone_number` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `House_Review`
--

CREATE TABLE IF NOT EXISTS `House_Review` (
  `idHouse_Review` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `House_idHouse` int(10) unsigned NOT NULL,
  `comments` varchar(250) COLLATE latin1_general_ci DEFAULT NULL,
  `rating` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`idHouse_Review`),
  KEY `House_Review_FKIndex1` (`House_idHouse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `House_Validation`
--

CREATE TABLE IF NOT EXISTS `House_Validation` (
  `idHouse_Validation` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `House_idHouse` int(10) unsigned NOT NULL,
  `date_sent` timestamp NULL DEFAULT NULL,
  `validation_expiration` timestamp NULL DEFAULT NULL,
  `allow_display` tinyint(1) DEFAULT NULL,
  `validation_code` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`idHouse_Validation`,`House_idHouse`),
  KEY `House_Validation_FKIndex1` (`House_idHouse`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `time`) VALUES
(2, '1379888862'),
(5, '1379948085'),
(6, '1380158705'),
(11, '1380194178'),
(11, '1380194179'),
(11, '1380194181'),
(11, '1380194182'),
(11, '1380194188'),
(11, '1380194188'),
(13, '1380242938'),
(13, '1380242946'),
(13, '1380242949'),
(11, '1380245769'),
(11, '1380245770'),
(11, '1380245779'),
(11, '1380245779'),
(11, '1380245780'),
(11, '1380245780'),
(12, '1380245915'),
(12, '1380245915'),
(12, '1380245921'),
(12, '1380245921'),
(11, '1380410593'),
(12, '1380410604'),
(12, '1380410605'),
(12, '1380410607'),
(12, '1380410611'),
(12, '1380652253'),
(11, '1381458352'),
(11, '1381469633'),
(12, '1381470015'),
(12, '1381551036');

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE IF NOT EXISTS `Student` (
  `student_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `last_name` varchar(80) COLLATE latin1_general_ci DEFAULT NULL,
  `username` varchar(30) COLLATE latin1_general_ci DEFAULT NULL,
  `student_password` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `salt` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `student_email` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `student_phone` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`student_id`, `first_name`, `last_name`, `username`, `student_password`, `salt`, `student_email`, `student_phone`) VALUES
(1, 'karim', 'kawambwa', 'kayr1m', 'pword', NULL, 'abdul-k', '226');

-- --------------------------------------------------------

--
-- Table structure for table `Student_Confirmation`
--

CREATE TABLE IF NOT EXISTS `Student_Confirmation` (
  `idStudent_Confirmation` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Student_student_id` int(10) unsigned NOT NULL,
  `banned` tinyint(1) DEFAULT NULL,
  `varified` tinyint(1) DEFAULT NULL,
  `varification_code` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`idStudent_Confirmation`),
  KEY `Student_Confirmation_FKIndex1` (`Student_student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

Status API Training Shop Blog About © 2013 GitHub, Inc. Terms Privacy Security Contact 