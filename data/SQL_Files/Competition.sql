-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 20, 2021 at 01:20 PM
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
-- Table structure for table `Competition`
--

CREATE TABLE `Competition` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `description` mediumtext,
  `age_min` int(11) DEFAULT NULL,
  `age_max` int(11) DEFAULT NULL,
  `image_name` varchar(150) DEFAULT NULL,
  `year_of_study_min` int(11) DEFAULT NULL,
  `year_of_study_max` int(11) DEFAULT NULL,
  `date_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_end` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Competition`
--

INSERT INTO `Competition` (`id`, `name`, `description`, `age_min`, `age_max`, `image_name`, `year_of_study_min`, `year_of_study_max`, `date_start`, `date_end`) VALUES
(1, 'Larkin - Connelly Maritime Operations Case Competition', 'These are the instructions for joining the competition as well as what the competition is about. Minus ut ut et ut aliquid facilis eveniet et ut.', NULL, NULL, NULL, 1, NULL, '2021-10-18 16:00:01', NULL),
(2, 'Davis, Botsford and Jacobi Public Policy Case Competition', 'These are the instructions for joining the competition as well as what the competition is about. Eos sed error maxime iusto minus velit ipsa consequatur ut.', NULL, NULL, NULL, 1, NULL, '2021-10-20 13:13:01', NULL),
(3, 'Mitchell - Wunsch Marine Sciences Competition', 'These are the instructions for joining the competition as well as what the competition is about. Quibusdam non enim ea labore mollitia adipisci dolores dolores enim.', NULL, NULL, NULL, 1, NULL, '2021-10-18 16:00:01', NULL),
(4, 'Reinger - McGlynn Maritime Operations Hackathon', 'These are the instructions for joining the competition as well as what the competition is about. Quis inventore qui autem minus quia quisquam reiciendis placeat nostrum.', NULL, NULL, NULL, 1, NULL, '2021-10-18 16:00:01', NULL),
(5, 'Cummerata Group User Interface (UI) Competition', 'These are the instructions for joining the competition as well as what the competition is about. Sequi est repudiandae perferendis sit ut et et ipsam rerum.', NULL, NULL, NULL, 1, NULL, '2021-10-18 16:00:01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Competition`
--
ALTER TABLE `Competition`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Competition`
--
ALTER TABLE `Competition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
