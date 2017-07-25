-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 07, 2016 at 07:08 PM
-- Server version: 5.5.52-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dynamic_forms`
--

-- --------------------------------------------------------

--
-- Table structure for table `elements`
--

CREATE TABLE IF NOT EXISTS `elements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `elements`
--

INSERT INTO `elements` (`id`, `name`, `status`) VALUES
(1, 'text', 'Active'),
(2, 'select', 'Active'),
(3, 'textarea', 'Active'),
(4, 'DatePicker', 'Active'),
(5, 'checkbox', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `slug` varchar(128) NOT NULL,
  `version` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `name`, `slug`, `version`, `status`, `created`) VALUES
(1, 'Allergy', 'allergy', 1, 'Active', '0000-00-00 00:00:00'),
(2, 'Dental', 'dental', 1, 'Active', '2016-10-07 12:52:22'),
(3, 'Medication', 'medication', 1, 'Active', '2016-10-07 12:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `forms_elements`
--

CREATE TABLE IF NOT EXISTS `forms_elements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `element_id` int(11) NOT NULL,
  `caption` varchar(128) NOT NULL,
  `field_name` varchar(128) NOT NULL,
  `is_required` enum('Y','N') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `forms_elements`
--

INSERT INTO `forms_elements` (`id`, `form_id`, `element_id`, `caption`, `field_name`, `is_required`) VALUES
(1, 1, 1, 'Name', 'name', 'Y'),
(2, 1, 1, 'Title', 'title', 'Y'),
(3, 1, 1, 'Description', 'description', 'Y'),
(4, 1, 1, 'Age', 'age', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `form_values`
--

CREATE TABLE IF NOT EXISTS `form_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `form_element_id` int(11) NOT NULL,
  `field_name` varchar(255) NOT NULL,
  `field_value` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `form_values`
--

INSERT INTO `form_values` (`id`, `patient_id`, `form_id`, `form_element_id`, `field_name`, `field_value`, `created`) VALUES
(2, 1, 1, 1, 'name', 'Name 1', '2016-10-07 10:35:24'),
(3, 1, 1, 2, 'title', 'Title 2', '2016-10-07 10:35:24'),
(4, 1, 1, 3, 'description', 'escriptio', '2016-10-07 10:35:24'),
(5, 1, 1, 4, 'age', 'Age 4', '2016-10-07 10:35:24'),
(6, 1, 2, 5, 'name', 'name 2', '2016-10-07 11:02:48'),
(7, 1, 2, 6, 'title', 'title 2', '2016-10-07 11:02:49'),
(8, 1, 2, 7, 'description', 'description 2', '2016-10-07 11:02:49'),
(9, 1, 2, 8, 'age', 'age 2', '2016-10-07 11:02:49'),
(10, 1, 3, 9, 'name', 'Name 3', '2016-10-07 11:04:01'),
(11, 1, 3, 10, 'title', 'title 3', '2016-10-07 11:04:01'),
(12, 1, 3, 11, 'description', 'description 3', '2016-10-07 11:04:02'),
(13, 1, 3, 12, 'age', 'age 3', '2016-10-07 11:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dob` datetime NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `user_id`, `name`, `dob`, `created`) VALUES
(1, 1, 'Patient-1', '2011-10-07 12:35:00', '2016-10-07 12:36:18'),
(2, 1, 'Patient-2', '2011-10-07 12:36:00', '2016-10-07 12:36:45'),
(3, 1, 'Patient-3', '2016-10-07 12:39:00', '2016-10-07 12:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`) VALUES
(1, 'Ravi');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
