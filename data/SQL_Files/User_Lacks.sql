-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 20, 2021 at 01:21 PM
-- Server version: 5.7.32
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WAD_Project`
--

-- --------------------------------------------------------

--
-- Table structure for table `User_Lacks`
--

CREATE TABLE `User_Lacks` (
  `user_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User_Lacks`
--

INSERT INTO `User_Lacks` (`user_id`, `skill_id`) VALUES
(41, 3),
(37, 7),
(43, 7),
(13, 10),
(8, 14),
(50, 17),
(21, 27),
(43, 30),
(10, 34),
(36, 35),
(31, 42),
(3, 47),
(17, 47),
(31, 48),
(12, 50),
(15, 51),
(39, 67),
(50, 71),
(7, 83),
(1, 84),
(6, 97),
(19, 97),
(4, 111),
(48, 117),
(6, 118),
(5, 127),
(10, 133),
(24, 134),
(29, 136),
(16, 144),
(2, 162),
(17, 162),
(25, 162),
(34, 162),
(13, 172),
(32, 172),
(35, 178),
(12, 185),
(7, 188),
(35, 190),
(23, 199),
(39, 203),
(45, 203),
(9, 210),
(32, 213),
(26, 214),
(49, 215),
(42, 216),
(40, 220),
(11, 227),
(33, 231),
(2, 236),
(47, 236),
(18, 243),
(41, 244),
(14, 250),
(44, 251),
(28, 255),
(25, 257),
(27, 262),
(28, 263),
(46, 268),
(3, 269),
(11, 274),
(24, 281),
(21, 283),
(4, 284),
(20, 293),
(34, 307),
(22, 314),
(20, 343),
(49, 343),
(30, 347),
(40, 349),
(1, 350),
(45, 356),
(38, 365),
(18, 367);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `User_Lacks`
--
ALTER TABLE `User_Lacks`
  ADD PRIMARY KEY (`user_id`,`skill_id`),
  ADD KEY `user_lacks_fk2` (`skill_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `User_Lacks`
--
ALTER TABLE `User_Lacks`
  ADD CONSTRAINT `user_lacks_fk1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `user_lacks_fk2` FOREIGN KEY (`skill_id`) REFERENCES `Skill` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
