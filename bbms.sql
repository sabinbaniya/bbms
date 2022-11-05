-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 05, 2022 at 12:12 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `timestamps` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `timestamps`) VALUES
(1, 'root', '$2y$10$sB3RRycOvAjeguBzuAGJW.wRylH9cns3cXq70gpbnsky6zjd/AHK.', '2022-11-05 11:02:56');

-- --------------------------------------------------------

--
-- Table structure for table `blood_records`
--

DROP TABLE IF EXISTS `blood_records`;
CREATE TABLE IF NOT EXISTS `blood_records` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `timestamps` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `bloodgroup` varchar(20) NOT NULL,
  `district` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `blood_records`
--

INSERT INTO `blood_records` (`id`, `userid`, `timestamps`, `bloodgroup`, `district`) VALUES
(16, 2, '2022-09-24 03:05:37', 'B+', 'Kaski'),
(17, 3, '2022-09-24 06:14:44', 'AB+', 'Dhankuta'),
(20, 5, '2022-11-05 10:46:20', 'O+', 'Achham');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

DROP TABLE IF EXISTS `districts`;
CREATE TABLE IF NOT EXISTS `districts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `district_name`) VALUES
(1, 'Achham\r\n'),
(2, 'Arghakhanchi\r\n'),
(3, 'Baglung\r\n'),
(4, 'Baitadi\r\n'),
(5, 'Bajhang\r\n'),
(6, 'Bajura\r\n'),
(7, 'Banke\r\n'),
(8, 'Bara\r\n'),
(9, 'Bardiya\r\n'),
(10, 'Bhaktapur\r\n'),
(11, 'Bhojpur\r\n'),
(12, 'Chitwan\r\n'),
(13, 'Dadeldhura\r\n'),
(14, 'Dailekh\r\n'),
(15, 'Dang\r\n'),
(16, 'Darchula\r\n'),
(17, 'Dhading\r\n'),
(18, 'Dhankuta\r\n'),
(19, 'Dhanusa\r\n'),
(20, 'Dolakha\r\n'),
(21, 'Dolpa\r\n'),
(22, 'Doti\r\n'),
(23, 'Gorkha\r\n'),
(24, 'Gulmi\r\n'),
(25, 'Humla\r\n'),
(26, 'Ilam\r\n'),
(27, 'Jajarkot\r\n'),
(28, 'Jhapa\r\n'),
(29, 'Jumla\r\n'),
(30, 'Kailali\r\n'),
(31, 'Kalikot\r\n'),
(32, 'Kanchanpur\r\n'),
(33, 'Kapilvastu\r\n'),
(34, 'Kaski\r\n'),
(35, 'Kathmandu\r\n'),
(36, 'Kavrepalanchok\r\n'),
(37, 'Khotang\r\n'),
(38, 'Lalitpur\r\n'),
(39, 'Lamjung\r\n'),
(40, 'Mahottari\r\n'),
(41, 'Makwanpur\r\n'),
(42, 'Manang\r\n'),
(43, 'Morang\r\n'),
(44, 'Mugu\r\n'),
(45, 'Mustang\r\n'),
(46, 'Myagdi\r\n'),
(47, 'Nawalparasi\r\n'),
(48, 'Nuwakot\r\n'),
(49, 'Okhaldhunga\r\n'),
(50, 'Palpa\r\n'),
(51, 'Panchthar\r\n'),
(52, 'Parbat\r\n'),
(53, 'Parsa\r\n'),
(54, 'Pyuthan\r\n'),
(55, 'Ramechhap\r\n'),
(56, 'Rasuwa\r\n'),
(57, 'Rautahat\r\n'),
(58, 'Rolpa\r\n'),
(59, 'Rukum\r\n'),
(60, 'Rupandehi\r\n'),
(61, 'Salyan\r\n'),
(62, 'Sankhuwasabha\r\n'),
(63, 'Saptari\r\n'),
(64, 'Sarlahi\r\n'),
(65, 'Sindhuli\r\n'),
(66, 'Sindhupalchok\r\n'),
(67, 'Siraha\r\n'),
(68, 'Solukhumbu\r\n'),
(69, 'Sunsari\r\n'),
(70, 'Surkhet\r\n'),
(71, 'Syangja\r\n'),
(72, 'Tanahu\r\n'),
(73, 'Taplejung\r\n'),
(74, 'Terhathum\r\n'),
(75, 'Udayapur');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `bloodgroup` varchar(20) NOT NULL,
  `district` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  `lastdonated` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dob` varchar(50) NOT NULL,
  `timestamps` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `bloodgroup`, `district`, `email`, `mobile`, `password`, `lastdonated`, `dob`, `timestamps`) VALUES
(2, 'Sabin', 'B+', 'Kaski', 'sabin@gmail.com', '9806542271', '$2y$10$lmdIkIg01tu9QZlHEZ.Pj.a70YDmZKiwcO5tyrghoYOzJTEdxs0PS', '2022-09-24', '', '2022-09-24 02:47:02'),
(3, 'jhon', 'AB+', 'Dhankuta', 'jhon@gmail.com', '1234567890', '$2y$10$Ewsh6JMte5RiJewPBCXFBODuDeGZAwD5u0ZFP4EqOHOetyMH.MTs2', '2022-09-24', '', '2022-09-24 06:10:21');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
