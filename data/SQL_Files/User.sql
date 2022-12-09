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
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `username` varchar(150) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `mobile_number` varchar(8) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `gender` enum('M','F','O') DEFAULT NULL,
  `image_name` varchar(150) DEFAULT NULL,
  `interest` mediumtext,
  `school` varchar(150) DEFAULT NULL,
  `year_of_study` int(11) DEFAULT NULL,
  `course` varchar(150) DEFAULT NULL,
  `date_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_end` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `username`, `password_hash`, `name`, `age`, `mobile_number`, `email`, `gender`, `image_name`, `interest`, `school`, `year_of_study`, `course`, `date_start`, `date_end`) VALUES
(1, 'Alexandria78', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Dr. Guadalupe Barrows', 25, '85703014', 'Mertie.Schaden7@hotmail.com', 'M', '', 'Front-end Development Medicine Blockchain Data Science Natural Language Processing (NLP) ', 'SUSS', 2, 'Ethical Hacking', '2021-10-18 16:00:01', NULL),
(2, 'Alexandria78', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Dr. Guadalupe Barrows', 25, '85703014', 'Mertie.Schaden7@hotmail.com', 'M', '', 'Front-end Development Medicine Blockchain Data Science Natural Language Processing (NLP) ', 'SUSS', 2, 'Ethical Hacking', '2021-10-18 16:00:01', NULL),
(3, 'Clara.Terry', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Mindy West DDS', 25, '95089612', 'Sandra.Hintz@yahoo.com', 'F', '', 'Opera Root Cause Analysis Real Estate Quality Assurance Adobe Experience Design ', 'SMU', 2, 'Ad Tracking', '2021-10-18 16:00:01', NULL),
(4, 'Letha.Ruecker', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Sandra Padberg', 24, '94569995', 'Arvilla_Lind63@gmail.com', 'O', NULL, 'NoSQL Academic Writing Computer Science Python Pandas Amazon VPC ', 'NTU', 3, 'Marine Sciences', '2021-10-18 16:00:01', NULL),
(5, 'Hailey.Yost', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Mrs. Sonia Weimann', 24, '87367708', 'Audra_Daugherty@hotmail.com', 'F', NULL, 'ElectronJS Ethical Hacking AV Systems ', 'NTU', 3, 'Law', '2021-10-18 16:00:01', NULL),
(6, 'Lilian1', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Seth Senger', 21, '93192041', 'Taurean.Bruen88@hotmail.com', 'F', NULL, 'VMWare Cloud Development ', 'NUS', 4, 'Cloud Computing', '2021-10-18 16:00:01', NULL),
(7, 'Kaylie14', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Freda Torp', 24, '88463327', 'Travis36@yahoo.com', 'M', NULL, 'Food Science Ada HTTP Server Desktop Application Design Incident Response (IR) History ', 'SUSS', 1, 'Internet of Things (IoT)', '2021-10-18 16:00:01', NULL),
(8, 'Nils14', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Mrs. Becky Altenwerth', 25, '98467427', 'Tate72@gmail.com', 'M', NULL, 'Agile Game Design Social Work ', 'NUS', 1, 'Investing', '2021-10-18 16:00:01', NULL),
(9, 'Jamel69', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Ada Skiles', 19, '94195138', 'Norval_Jaskolski73@yahoo.com', 'F', NULL, 'Hardware Engineering Adobe ', 'SUSS', 2, 'Agriculture', '2021-10-18 16:00:01', NULL),
(10, 'Brooks.Kessler82', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Miss Nicolas Mosciski', 19, '92808867', 'Matt.Ziemann78@gmail.com', 'M', NULL, 'Hardware Testing Safety Administration Python Sci-kit Learn Financial Advisory Real Estate Game Development ', 'SMU', 3, 'Chemistry', '2021-10-18 16:00:01', NULL),
(11, 'Rico.Bayer52', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Melissa Wyman', 26, '87773612', 'Jenifer34@yahoo.com', 'F', NULL, 'C ', 'NTU', 3, 'Quality Assurance', '2021-10-18 16:00:01', NULL),
(12, 'Carolina.Ziemann', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Jaime Waters', 18, '92315884', 'Zane62@gmail.com', 'O', NULL, 'Back-end Programming Java Automation Mass Communication ', 'SIT', 3, 'Biology', '2021-10-18 16:00:01', NULL),
(13, 'Leatha.Corkery', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Jeff Farrell', 20, '92334226', 'Betsy56@yahoo.com', 'M', NULL, 'Reconnaisance Medical Law Advertising Law Data Science DDoS Web Application Development ECMAScript Mobile User Experience Design Cyber-security ', 'SMU', 2, 'Graphic Design', '2021-10-18 16:00:01', NULL),
(14, 'Rachelle_Hand', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Monica Stroman', 19, '99236102', 'Theo_Jacobi@hotmail.com', 'M', NULL, 'Embedded Systems Incident Response (IR) Corporate Management Database Management ', 'SIT', 3, 'Antenna', '2021-10-18 16:00:01', NULL),
(15, 'Lukas.Krajcik', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Frances Volkman', 21, '88628540', 'King_Yundt82@gmail.com', 'O', NULL, 'Process Analysis Ethical Hacking ', 'NTU', 3, 'Engineering Design', '2021-10-18 16:00:01', NULL),
(16, 'Alexandra.Gerlach', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Gregg Schuster', 26, '85873149', 'Bette.Hansen@yahoo.com', 'M', NULL, 'Applied Mathematics Financial Management Object-oriented Programming Writing JQuery Mobile Mass Communication Neo4j Hypervirtualisation ', 'NTU', 4, 'Statistics', '2021-10-18 16:00:01', NULL),
(17, 'Lottie68', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Marty Kiehn', 19, '85897455', 'Saul.Schiller21@yahoo.com', 'F', NULL, 'Agile Environment Financial Accounting ', 'SUSS', 3, 'Software Design', '2021-10-18 16:00:01', NULL),
(18, 'Mary_Tromp39', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Jeannette Metz', 21, '86613085', 'Robb.Smitham@yahoo.com', 'M', NULL, '', 'NUS', 1, 'Project Management', '2021-10-18 16:00:01', NULL),
(19, 'Verona44', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Jenny Hodkiewicz', 25, '84978508', 'Yasmeen93@yahoo.com', 'M', NULL, 'Medicine Hardware Testing Mac OS Docker R ', 'SUSS', 3, 'Political Science', '2021-10-18 16:00:01', NULL),
(20, 'Forrest50', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Fernando Gerhold', 26, '96138634', 'Emmet74@hotmail.com', 'M', NULL, '', 'SUSS', 2, 'Game Development', '2021-10-18 16:00:01', NULL),
(21, 'Garth.Langosh62', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Martin Oberbrunner', 21, '83199239', 'Sheila92@gmail.com', 'M', NULL, 'Redis Biology Fortran Social Media Advertising Applied Mathematics Planning Mac OS ', 'SIM', 4, 'Data Engineering', '2021-10-18 16:00:01', NULL),
(22, 'Patsy_Mohr', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Christine Volkman', 20, '99356719', 'Clovis_Greenholt@hotmail.com', 'O', NULL, 'Financial Advisory JavaScript (JS) Finance Consulting PayPal ', 'NTU', 1, 'Hardware Development', '2021-10-18 16:00:01', NULL),
(23, 'Petra96', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Sergio Spencer', 26, '84728943', 'Ernie_Spencer@yahoo.com', 'F', NULL, 'Natural Language Processing (NLP) Agile Modeling Dart Embedded Systems ', 'NUS', 2, 'Agriculture', '2021-10-18 16:00:01', NULL),
(24, 'Hosea99', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Ms. Kristina Grant', 22, '84773540', 'Dayana27@gmail.com', 'F', NULL, 'Public Speaking HTML Rust ', 'SUSS', 1, 'Finance', '2021-10-18 16:00:01', NULL),
(25, 'Theron_Wilderman53', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Hazel Beatty II', 26, '96873314', 'Dino.Fritsch53@yahoo.com', 'O', NULL, 'Exploratory Data Analysis ', 'NTU', 4, 'Product Management', '2021-10-18 16:00:01', NULL),
(26, 'Keyon_Kling', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Miranda Parisian', 21, '94578565', 'Harley88@hotmail.com', 'O', NULL, 'Amazon EC2 API ', 'SUTD', 4, 'Safety Administration', '2021-10-18 16:00:01', NULL),
(27, 'Letitia_Trantow', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Jamie Cummerata', 19, '83372509', 'Derek_Heaney94@yahoo.com', 'O', NULL, 'Project Management ', 'SIT', 2, 'Mass Communication', '2021-10-18 16:00:01', NULL),
(28, 'Catalina_Daniel0', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Ms. Edgar Hagenes', 19, '84337853', 'Hollis_Johnson@yahoo.com', 'O', NULL, 'Writing Python SciPy Cassandra Bitcoin AngularJS Law Obfuscation Research and Development (R&D) Ada ', 'SIM', 4, 'Insurance', '2021-10-18 16:00:01', NULL),
(29, 'Louie.Stark', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Keith Parker', 26, '92949920', 'Maggie10@hotmail.com', 'O', NULL, '', 'SUTD', 3, 'Political Science', '2021-10-18 16:00:01', NULL),
(30, 'Dashawn_Rath9', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Larry Sawayn', 26, '99608781', 'Hazel.Cruickshank@gmail.com', 'F', NULL, 'Financial Analysis ASP.NET Heroku ', 'SIT', 4, 'Material Design', '2021-10-18 16:00:01', NULL),
(31, 'Kathlyn_Trantow77', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Miss Celia Brakus', 21, '84243320', 'Marilou_Jones@hotmail.com', 'F', NULL, 'Life Sciences ', 'SUSS', 1, 'Sociology', '2021-10-18 16:00:01', NULL),
(32, 'Phoebe74', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Mr. Caleb DuBuque', 25, '95579654', 'Leila_Carroll@yahoo.com', 'F', NULL, 'PayPal Management Scala Continuous Deployment (CD) Python Sci-kit Learn Hardware Design VMWare Amazon SQS Cloud Deployment ', 'SIM', 3, 'Material Design', '2021-10-18 16:00:01', NULL),
(33, 'Wallace.Johns', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Jody Rowe', 22, '95949500', 'Vivian37@yahoo.com', 'O', NULL, 'Agile Application Development Marine Biology User Interface (UI) C Plus Plus Cloud Computing Financial Technology ', 'SMU', 1, 'Mass Communication', '2021-10-18 16:00:01', NULL),
(34, 'Shawn.Ziemann', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Geoffrey Murray', 21, '86962352', 'Evans14@gmail.com', 'O', NULL, 'GUI Testing User Acceptance testing (UAT) Electrical Engineering Industrial Systems Computer Graphics Mergers and Acquisitions (M&A) ', 'SUSS', 3, 'Biology', '2021-10-18 16:00:01', NULL),
(35, 'Lindsey_Herzog6', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Howard Schmeler', 25, '99843609', 'Jewell_Kerluke@hotmail.com', 'M', NULL, 'Management Geography Agile & Waterfall Methodologies Network Scanning Haskell ', 'SUSS', 2, 'Healthcare', '2021-10-18 16:00:01', NULL),
(36, 'Stewart79', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Darrin Robel', 21, '97423842', 'Terrance.Schimmel@gmail.com', 'M', NULL, 'Mental Health D Physics Industrial Engineering ', 'SIT', 2, 'Graphic Design', '2021-10-18 16:00:01', NULL),
(37, 'Mae.Kihn', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Forrest Fisher', 25, '97544163', 'Abigayle_Gorczany84@yahoo.com', 'O', NULL, 'Privilege Escalation Python Food Law Jenkins VirtualBox Python Flask Management Agile Environment ', 'SIM', 1, 'Investment Banking', '2021-10-18 16:00:01', NULL),
(38, 'Delbert.Waters9', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Melody Hackett', 22, '95406161', 'Kaylin90@gmail.com', 'M', NULL, 'Financial Law Medical Law Mathematics Real Estate Computer Science Unix ', 'SUSS', 4, 'User Experience (UX)', '2021-10-18 16:00:01', NULL),
(39, 'Dana55', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Flora Willms', 25, '86744032', 'Ed37@gmail.com', 'O', NULL, 'CoffeeScript Adobe Experience Design Aerospace Engineering Agile Web Development Kotlin Financial Technology AV Systems Pascal ', 'SMU', 3, 'Safety Administration', '2021-10-18 16:00:01', NULL),
(40, 'Brooks_Satterfield', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Benjamin Hirthe', 25, '97819744', 'Monserrate28@hotmail.com', 'M', NULL, 'Java Time Management Opera Opera GIMP Product Management ', 'SIM', 4, 'Psychiatry', '2021-10-18 16:00:01', NULL),
(41, 'Daren_OHara', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Marion Gerhold DDS', 21, '87252344', 'Braxton23@yahoo.com', 'F', NULL, 'Geography Industrial Engineering ', 'SMU', 4, 'Public Policy', '2021-10-18 16:00:01', NULL),
(42, 'Raphael.Greenfelder', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Mrs. Kim Hintz', 24, '95402137', 'Stanley91@yahoo.com', 'O', NULL, 'DNS Administration Cloud Deployment Presentation Linux Media Design Mental Health Amazon EBS Financial Management Food Safety ', 'SUSS', 3, 'Safety Administration', '2021-10-18 16:00:01', NULL),
(43, 'Lurline_Stanton', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Paulette Nikolaus', 23, '89078512', 'Marjolaine.Jones@gmail.com', 'O', NULL, 'Adobe Suite Planning Database Management ', 'SUTD', 4, 'Financial Management', '2021-10-18 16:00:01', NULL),
(44, 'Alysa58', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Stacey Hoppe', 22, '85572365', 'Hilario_Kling59@gmail.com', 'M', NULL, 'VMWare Design AJAX Julia MATE JQuery UI Medicine DevOps Research and Development (R&D) ', 'NUS', 1, 'Aerospace Engineering', '2021-10-18 16:00:01', NULL),
(45, 'Niko_Streich9', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Ebony Hackett', 19, '88424563', 'Ethelyn_Effertz91@yahoo.com', 'F', NULL, 'Communication Adobe Software D Debian Arch Linux Design Binary Exploitation Xamarin Statistics ', 'SMU', 4, 'Social Science', '2021-10-18 16:00:01', NULL),
(46, 'Frank.Adams89', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Miss Saul Conroy', 19, '94865531', 'Lucious.Huels37@yahoo.com', 'F', NULL, 'Soft Skills Tableau CoffeeScript Graphic Design Dart Operating System Material Design JavaFX Real Estate ', 'SIT', 4, 'Agriculture', '2021-10-18 16:00:01', NULL),
(47, 'Lynn35', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Jennifer Brown', 21, '85797472', 'Alfonzo.Boyle57@hotmail.com', 'M', NULL, 'Amazon Web Service (AWS) Red Team Geospatial Analysis Web Application Development Corporate Design Malware AV Systems Computer Networking Mechanical Engineering ', 'SUSS', 4, 'Filming', '2021-10-18 16:00:01', NULL),
(48, 'Paolo.Gusikowski', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Sue Mante', 21, '93616693', 'Jerrell66@hotmail.com', 'M', NULL, 'Mass Communication GUI Testing Amazon Kindle Geography Biology ', 'NUS', 2, 'Cyber-security', '2021-10-18 16:00:01', NULL),
(49, 'Earnest.Purdy', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Leigh Lowe', 25, '98682690', 'Emily29@yahoo.com', 'O', NULL, 'Privilege Escalation Academic Administration Adult Education Machine Learning Adobe Experience Design Sociology Identity and Access Management (IAM) ', 'SUTD', 4, 'Database Management', '2021-10-18 16:00:01', NULL),
(50, 'Lyda.Dibbert', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Luke Herzog', 26, '96675971', 'Valentina_Connelly@gmail.com', 'M', NULL, 'Hardware Development Sculpting Agile Environment Advertising Ad Tracking Github Amazon CloudFront API ', 'SIT', 2, 'Maritime Operations', '2021-10-18 16:00:01', NULL),
(51, 'Percival23', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Melinda Ledner', 21, '99739539', 'Sienna.Shields60@gmail.com', 'F', NULL, 'React Native Amazon SimpleDB (SDB) Acceptance Testing Erlang Illustrator Quality Assurance ', 'SIT', 4, 'Cloud Development', '2021-10-18 16:00:01', NULL),
(52, 'Alvina.Satterfield', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Michelle Hamill', 25, '87082476', 'Vicky.Marvin@yahoo.com', 'F', NULL, 'Obfuscation Management ', 'NTU', 2, 'Cyber-security', '2021-10-18 16:00:01', NULL),
(53, 'Breana4', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Vivian Bernhard', 21, '98445740', 'Collin14@yahoo.com', 'F', NULL, 'Haskell Sociology DNS Administration Continuous Integration (CI) JQuery Mobile Hardware Design Python Kivy Academic Publishing ', 'SIM', 2, 'Quality Assurance', '2021-10-18 16:00:01', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
