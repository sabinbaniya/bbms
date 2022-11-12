-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 12, 2022 at 01:44 PM
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
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `blood_records`
--

INSERT INTO `blood_records` (`id`, `userid`, `timestamps`, `bloodgroup`, `district`) VALUES
(29, 10, '2022-11-07 03:35:22', 'O+', 'Dhading'),
(30, 9, '2022-11-12 12:47:39', 'O-', 'Achham'),
(35, 12, '2022-11-12 13:41:36', 'B+', 'Kaski'),
(36, 13, '2022-11-12 13:41:36', 'B+', 'Dhankuta'),
(37, 14, '2022-11-12 13:41:36', 'B-', 'Kaski'),
(38, 15, '2022-11-12 13:41:36', '0+', 'Kathmandu'),
(39, 16, '2022-11-12 13:41:36', 'B+', 'Kaski'),
(40, 17, '2022-11-12 13:41:36', 'A-', 'Lalitpur'),
(41, 18, '2022-11-12 13:41:36', 'B+', 'Kaski'),
(42, 19, '2022-11-12 13:41:36', 'AB+', 'Dhankuta'),
(43, 20, '2022-11-12 13:41:36', 'B+', 'Kaski'),
(44, 21, '2022-11-12 13:41:36', 'AB+', 'Accham'),
(45, 22, '2022-11-12 13:41:36', 'B+', 'Kaski'),
(46, 23, '2022-11-12 13:41:36', 'AB+', 'Dhankuta'),
(47, 24, '2022-11-12 13:41:36', 'B+', 'Kaski'),
(48, 25, '2022-11-12 13:41:36', 'AB+', 'Baglung'),
(49, 26, '2022-11-12 13:41:36', 'B+', 'Kaski'),
(50, 27, '2022-11-12 13:41:36', 'AB+', 'Dhankuta');

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
  `admin_verified` tinyint(1) NOT NULL DEFAULT '0',
  `donation_count` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `bloodgroup`, `district`, `email`, `mobile`, `password`, `lastdonated`, `dob`, `timestamps`, `admin_verified`, `donation_count`) VALUES
(9, 'john cena', 'O-', 'Achham', 'jhon@gmail.com', '32894893274', '$2y$10$s9dXS/kKaBgoh8YEQhMDBeorjf6RRiZg1HN9lENgkQmca5hZ.vIqi', '2022-11-12', '2000-02-02', '2022-11-05 12:49:34', 1, 2),
(10, 'test', 'O+', 'Dhading', 'test@test.com', '12345678', '$2y$10$MBCZ5KuDaIlQFD.mffzKwOgwWxogrpUeWr4XRuoVr1QlYkH.RFYS6', '2022-11-07', '2022-11-03', '2022-11-07 03:35:14', 0, 0),
(11, 'jg', 'O+', 'Dhanusa', 'jg@outlook.com', '873439382', '$2y$10$p6kbGkzrtYkD6McAiL.3seHxmHab2YMVmkwrNZ1LfHkjWEcCTU4Dm', '', '2001-06-21', '2022-11-12 13:33:21', 0, 0),
(12, 'Hari Gurung', 'B+', 'Kaski', 'hari@gmail.com', '982367421', '$2y$10$lmdIkIg01tu9QZlHEZ.Pj.a70YDmZKiwcO5tyrghoYOzJTEdxs0PS', '2022-10-24', '1990-02-28', '2022-11-12 13:42:47', 1, 2),
(13, 'Ram K.C', 'AB+', 'Dhankuta', 'ram@yahoo.com', '980839322', '$2y$10$Ewsh6JMte5RiJewPBCXFBODuDeGZAwD5u0ZFP4EqOHOetyMH.MTs2', '2022-11-07', '1989-07-11', '2022-11-12 13:42:47', 0, 3),
(14, 'Rita Gurung', 'B-', 'Kaski', 'rita@gmail.com', '982367421', '$2y$10$lmdIkIg01tu9QZlHEZ.Pj.a70YDmZKiwcO5tyrghoYOzJTEdxs0PS', '2021-10-24', '1990-02-28', '2022-11-12 13:42:47', 1, 4),
(15, 'Shyam K.C', '0+', 'Kathmandu', 'Shyam@yahoo.com', '9802339322', '$2y$10$Ewsh6JMte5RiJewPBCXFBODuDeGZAwD5u0ZFP4EqOHOetyMH.MTs2', '2021-11-07', '1989-07-11', '2022-11-12 13:42:47', 0, 5),
(16, 'Ghanshyam Poudel', 'B+', 'Kaski', 'ghanshyam@gmail.com', '982367421', '$2y$10$lmdIkIg01tu9QZlHEZ.Pj.a70YDmZKiwcO5tyrghoYOzJTEdxs0PS', '2021-10-24', '1990-02-28', '2022-11-12 13:42:47', 0, 1),
(17, 'Bikram Karki', 'A-', 'Lalitpur', 'bikram@yahoo.com', '9802193213', '$2y$10$Ewsh6JMte5RiJewPBCXFBODuDeGZAwD5u0ZFP4EqOHOetyMH.MTs2', '2020-11-07', '1989-07-11', '2022-11-12 13:42:47', 1, 1),
(18, 'Sita Gurung', 'B+', 'Kaski', 'Sita@gmail.com', '982367421', '$2y$10$lmdIkIg01tu9QZlHEZ.Pj.a70YDmZKiwcO5tyrghoYOzJTEdxs0PS', '2020-10-24', '1990-02-28', '2022-11-12 13:42:47', 0, 5),
(19, 'Ramchandra K.C', 'AB+', 'Dhankuta', 'Ramchandra@yahoo.com', '980839322', '$2y$10$Ewsh6JMte5RiJewPBCXFBODuDeGZAwD5u0ZFP4EqOHOetyMH.MTs2', '2020-11-07', '1989-07-11', '2022-11-12 13:42:47', 1, 3),
(20, 'Bikal Gurung', 'B+', 'Kaski', 'Bikal@gmail.com', '982367421', '$2y$10$lmdIkIg01tu9QZlHEZ.Pj.a70YDmZKiwcO5tyrghoYOzJTEdxs0PS', '2019-10-24', '1990-02-28', '2022-11-12 13:42:47', 0, 2),
(21, 'Ramesh K.C', 'AB+', 'Accham', 'ramesh@yahoo.com', '980839322', '$2y$10$Ewsh6JMte5RiJewPBCXFBODuDeGZAwD5u0ZFP4EqOHOetyMH.MTs2', '2019-11-07', '1989-07-11', '2022-11-12 13:42:47', 1, 2),
(22, 'Biplove Gurung', 'B+', 'Kaski', 'Biplove@gmail.com', '982367421', '$2y$10$lmdIkIg01tu9QZlHEZ.Pj.a70YDmZKiwcO5tyrghoYOzJTEdxs0PS', '2019-10-24', '1990-02-28', '2022-11-12 13:42:47', 1, 2),
(23, 'Deep K.C', 'AB+', 'Dhankuta', 'deep@yahoo.com', '9808396722', '$2y$10$Ewsh6JMte5RiJewPBCXFBODuDeGZAwD5u0ZFP4EqOHOetyMH.MTs2', '2022-11-07', '1989-07-11', '2022-11-12 13:42:47', 1, 6),
(24, 'Ganesh Gurung', 'B+', 'Kaski', 'ganesh@gmail.com', '982367421', '$2y$10$lmdIkIg01tu9QZlHEZ.Pj.a70YDmZKiwcO5tyrghoYOzJTEdxs0PS', '2022-10-24', '1990-02-28', '2022-11-12 13:42:47', 0, 2),
(25, 'Sita K.C', 'AB+', 'Baglung', 'sita@yahoo.com', '982439322', '$2y$10$Ewsh6JMte5RiJewPBCXFBODuDeGZAwD5u0ZFP4EqOHOetyMH.MTs2', '2022-11-07', '1989-07-11', '2022-11-12 13:42:47', 1, 3),
(26, 'Prasanna Bhattarai', 'B+', 'Kaski', 'Prasanna@gmail.com', '982333421', '$2y$10$lmdIkIg01tu9QZlHEZ.Pj.a70YDmZKiwcO5tyrghoYOzJTEdxs0PS', '2022-10-24', '1990-02-28', '2022-11-12 13:42:47', 1, 2),
(27, 'Haris Kandel', 'AB+', 'Dhankuta', 'haris@outlook.com', '9889839322', '$2y$10$Ewsh6JMte5RiJewPBCXFBODuDeGZAwD5u0ZFP4EqOHOetyMH.MTs2', '2022-11-07', '1989-07-11', '2022-11-12 13:42:47', 0, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
