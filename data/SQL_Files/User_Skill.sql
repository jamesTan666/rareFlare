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
-- Table structure for table `User_Skill`
--

CREATE TABLE `User_Skill` (
  `user_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `proficiency` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User_Skill`
--

INSERT INTO `User_Skill` (`user_id`, `skill_id`, `proficiency`) VALUES
(1, 76, 3),
(1, 134, 3),
(1, 232, 1),
(2, 32, 2),
(2, 177, 2),
(3, 215, 2),
(4, 37, 2),
(4, 241, 2),
(4, 312, 2),
(5, 21, 1),
(6, 3, 3),
(6, 296, 1),
(7, 121, 2),
(7, 232, 3),
(8, 165, 1),
(8, 250, 1),
(8, 318, 1),
(9, 123, 1),
(10, 83, 1),
(10, 131, 3),
(10, 357, 1),
(11, 47, 3),
(11, 239, 3),
(11, 277, 2),
(12, 178, 2),
(12, 344, 2),
(13, 4, 1),
(14, 54, 1),
(14, 191, 3),
(15, 272, 1),
(15, 318, 3),
(16, 92, 2),
(16, 158, 2),
(16, 268, 1),
(17, 3, 2),
(17, 54, 3),
(17, 203, 3),
(18, 41, 3),
(18, 269, 1),
(18, 337, 2),
(19, 30, 1),
(19, 129, 3),
(19, 263, 3),
(20, 53, 1),
(20, 263, 1),
(21, 157, 2),
(21, 211, 1),
(21, 238, 3),
(22, 62, 2),
(22, 155, 2),
(23, 73, 1),
(23, 291, 2),
(23, 301, 1),
(24, 76, 3),
(24, 80, 2),
(25, 254, 2),
(25, 272, 2),
(25, 345, 2),
(26, 18, 1),
(27, 114, 1),
(27, 141, 1),
(28, 125, 2),
(28, 303, 2),
(28, 348, 3),
(29, 249, 1),
(30, 27, 2),
(30, 33, 2),
(31, 54, 3),
(31, 150, 1),
(32, 18, 2),
(32, 66, 1),
(33, 105, 3),
(34, 102, 2),
(35, 4, 2),
(35, 292, 1),
(36, 216, 3),
(36, 284, 3),
(37, 181, 3),
(38, 194, 1),
(38, 273, 2),
(38, 292, 2),
(39, 199, 3),
(40, 4, 2),
(40, 119, 3),
(40, 122, 2),
(41, 186, 1),
(41, 312, 1),
(41, 344, 2),
(42, 117, 1),
(43, 228, 3),
(43, 353, 3),
(44, 228, 3),
(44, 257, 3),
(44, 325, 3),
(45, 92, 2),
(45, 158, 1),
(45, 331, 1),
(46, 311, 2),
(47, 351, 3),
(48, 257, 3),
(49, 58, 2),
(50, 126, 3),
(50, 252, 2),
(50, 320, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `User_Skill`
--
ALTER TABLE `User_Skill`
  ADD PRIMARY KEY (`user_id`,`skill_id`),
  ADD KEY `user_skill_fk2` (`skill_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `User_Skill`
--
ALTER TABLE `User_Skill`
  ADD CONSTRAINT `user_skill_fk1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `user_skill_fk2` FOREIGN KEY (`skill_id`) REFERENCES `Skill` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
