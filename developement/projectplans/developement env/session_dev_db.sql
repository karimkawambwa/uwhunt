
-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2013 at 07:36 PM
-- Server version: 5.5.32-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chataloo_Session`
--
CREATE DATABASE IF NOT EXISTS `chataloo_SESSIONDev` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `chataloo_SESSIONDev`;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` char(128) NOT NULL,
  `set_time` char(10) NOT NULL,
  `data` text NOT NULL,
  `session_key` char(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `set_time`, `data`, `session_key`) VALUES
('cna1o923rpk8tfs2n9btlt0gl6dg0ubkeobpn2vpmptsofenk8i3btml9meel9rh6l5793sc5uap4h4cd4ginlne56cvdqdruqech80', '1382326316', 'ZOFGa/+JvZf0yLsdM+mRjXHLTwBJrfdYEmMneLS6cGA=', '4c2035cd30e651de3943d8ea84bbd25d17ba76a64d8d976b10507919af783110e4f052104ebf246f1b127c0137da5aafa37f7405b3c05ccca9e545e036403368');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

Status API Training Shop Blog About © 2013 GitHub, Inc. Terms Privacy Security Contact 