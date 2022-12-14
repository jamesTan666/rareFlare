-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 12, 2021 at 08:29 PM
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
  `url` varchar(150) DEFAULT NULL,
  `company` varchar(150) DEFAULT NULL,
  `age_min` int(11) DEFAULT NULL,
  `age_max` int(11) DEFAULT NULL,
  `image_name` varchar(150) DEFAULT NULL,
  `year_of_study_min` int(11) DEFAULT NULL,
  `year_of_study_max` int(11) DEFAULT NULL,
  `difficulty` enum('Beginner','Intermediate','Advanced') DEFAULT NULL,
  `type` varchar(150) DEFAULT NULL,
  `team` varchar(10) DEFAULT NULL,
  `date_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_register` timestamp NULL DEFAULT NULL,
  `date_end` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Competition`
--

INSERT INTO `Competition` (`id`, `name`, `description`, `url`, `company`, `age_min`, `age_max`, `image_name`, `year_of_study_min`, `year_of_study_max`, `difficulty`, `type`, `team`, `date_start`, `date_register`, `date_end`) VALUES
(1, 'Shopee Code League 2021', 'Shopee Code League is a 3-week coding challenge consisting of 3 coding competitions open to all students and professionals across the region. The competitions, specially designed by the Shopee tech teams, cover data analytics, data science and algorithmic problems. Participants must analyse the datasets, draw insightful conclusions and solve the problems in a specified amount of time.', 'https://careers.shopee.sg/codeleague/', 'Shopee', NULL, NULL, 'shopeecodeleague2021.png', 1, NULL, 'Beginner', 'Data Science', '2-4', '2021-03-05 16:00:01', '2021-03-19 16:00:01', '2021-03-19 16:00:01'),
(2, 'Google Hashcode 2021', 'Hash Code is a team programming competition, organized by Google, for students and professionals around the world. You pick your team and programming language and we pick an engineering problem for you to solve. This year???s contest kicks off with an Online Qualifications, where your team can compete virtually from wherever you would like, alongside your virtual Hub. Top teams will then be invited to compete from our virtual World Finals.', 'https://codingcompetitions.withgoogle.com/hashcode', 'Google', NULL, NULL, 'hashcode2021.png', 1, NULL, 'Advanced', 'Algorithm', '2-4', '2021-02-25 17:30:00', '2021-02-18 15:59:59', '2021-04-24 15:59:59'),
(3, 'Microsoft Azure Virtual Hackathon 2021', 'With unprecedented amounts of data being collected every second across the globe, there is an almost infinite amount of data available to tap into to derive useful insights for crucial decision making across industries. MICROSOFT is challenging you to provide innovative solutions in advanced data analytics and AI for a number of booming industries! Join individually or team up in groups of up to 4 members to submit your solutions now!', 'https://discover-ai-with-microsoft.agorize.com/en/challenges/msazurevirtualhack-2021', 'Microsoft', NULL, NULL, 'azurehack2021.png', 1, NULL, 'Advanced', 'Fintech, Telecommunications', '1', '2020-11-23 00:00:00', '2021-03-01 23:59:59', '2020-05-06 15:59:59'),
(4, 'Code for Good 2022', 'At our Code for Good event, we bring coders and non-profit organizations together to solve real-world technical problems. You will experience firsthand how we use technology to inspire change, foster inclusion and make a difference in our communities. Work alongside our tech experts. Meet our recruiting teams and experience what it is like to work as an engineer at J.P. Morgan.', 'https://careers.jpmorgan.com/us/en/students/programs/code-for-good?search=&tags=location__AsiaPacific__Singapore', 'JP Morgan', NULL, NULL, 'jpm2021.png', 1, NULL, 'Intermediate', 'Social Solution', '1', '2021-12-31 16:00:01', NULL, NULL),
(5, 'Singapore Airlines AppChallenge 2022', 'Shortlisted teams will receive dedicated mentoring sessions from aviation experts, business coaches and a chance to pitch their ideas to Singapore Airlines senior management who will be part of the judging panel. Up to 500,000 KrisFlyer Miles and Singapore Airlines Merchandise to be won.', 'https://appchallenge.singaporeair.com/en/challenges/startup-2021', 'Singapore Airlines', NULL, NULL, 'sia2021.png', 1, NULL, 'Intermediate', 'Solution Development', '1-3', '2021-12-31 16:00:01', NULL, NULL),
(6, 'ST Logistics Innovation Challenge 2022', 'We are inviting university students to participate in this challenge not only for the chance to collaborate with a major supply chain and logistics company, test-bed and gain funding to develop solutions, but also to play a critical role in building a more technologically-enabled Singapore.', 'https://innovatewithstl.com/', 'ST Logistics', NULL, NULL, 'stl2021.png', 1, NULL, 'Intermediate', 'Solution Development', '1-5', '2021-12-31 16:00:01', NULL, NULL),
(7, 'MLDA DLW Hackathon', 'DLW Hackathon is a 48-hour virtual Hackathon, dedicated to hacks with Machine Learning and Artificial Intelligence (ML/AI), conducted fully virtual in Gather.town', 'https://www.ntu.edu.sg/eee/student-life/mlda/deep-learning-week/deep-learning-week-2021/mlda-dlw-hackathon', 'NTU MLDA', NULL, NULL, 'mlda2021.png', 1, NULL, 'Beginner', 'Machine Learning', '1-4', '2021-10-14 16:00:01', '2021-10-10 16:00:01', '2021-10-16 16:00:01'),
(8, 'DSC Solution Challenge 2021', 'The Google Developer Student Clubs - 2021 Solution Challenge mission is to solve for one or more of the United Nations 17 Sustainable Development Goals using Google technology.', 'https://developers.google.com/community/gdsc-solution-challenge', 'Google', NULL, NULL, 'dsc2021.png', 1, NULL, 'Advanced', 'Software Development', '1-5', '2021-03-01 07:00:00', '2021-04-11 06:59:59', '2021-08-26 15:00:01'),
(9, 'The Data Open 2021', 'Citadel is proud to present The Data Open, a datathon competition taking place throughout the year at a series of top universities. At each event, participants work in teams to or through a large and complex dataset and then present their findings to a panel of judges.', 'https://www.citadel.com/careers/the-data-open/apply/?apply_to=apac-datathon-spring-2021', 'Citadel', NULL, NULL, 'dataopen2021.png', 1, NULL, 'Advanced', 'Quant', '1', '2021-11-07 16:00:01', '2021-11-14 15:59:59', '2021-11-22 15:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `Competition_Skill`
--

CREATE TABLE `Competition_Skill` (
  `competition_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Connection`
--

CREATE TABLE `Connection` (
  `user_id1` int(11) NOT NULL,
  `user_id2` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Connection_Request`
--

CREATE TABLE `Connection_Request` (
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Fee`
--

CREATE TABLE `Fee` (
  `id` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `date_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Fee`
--

INSERT INTO `Fee` (`id`, `amount`, `date_start`) VALUES
(1, 1, '2021-10-17 16:00:01');

-- --------------------------------------------------------

--
-- Table structure for table `Group`
--

CREATE TABLE `Group` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `competition_id` int(11) NOT NULL,
  `is_private` tinyint(1) DEFAULT NULL,
  `date_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_end` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Match`
--

CREATE TABLE `Match` (
  `user_id1` int(11) NOT NULL,
  `user_id2` int(11) NOT NULL,
  `compatibility` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Pending','Cleared','Rejected') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Match`
--

INSERT INTO `Match` (`user_id1`, `user_id2`, `compatibility`, `date`, `status`) VALUES
(1, 13, 1, '2021-11-12 19:17:14', 'Pending'),
(1, 14, 1, '2021-11-12 19:17:14', 'Pending'),
(1, 17, 3, '2021-11-12 19:17:14', 'Pending'),
(1, 31, 3, '2021-11-12 19:17:14', 'Pending'),
(1, 35, 2, '2021-11-12 19:17:14', 'Pending'),
(1, 40, 2, '2021-11-12 19:17:14', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `Payment_History`
--

CREATE TABLE `Payment_History` (
  `id` int(11) NOT NULL,
  `date_paid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `fee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Skill`
--

CREATE TABLE `Skill` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Skill`
--

INSERT INTO `Skill` (`id`, `name`) VALUES
(1, 'Active Server Pages (ASP)'),
(2, 'AJAX'),
(3, 'API'),
(4, 'ASP.NET'),
(5, 'AV Systems'),
(6, 'Amazon Web Service (AWS)'),
(7, 'Accounting'),
(8, 'Academic Administration'),
(9, 'Academic Consulting'),
(10, 'Academic Development'),
(11, 'Academic Publishing'),
(12, 'Academic Research'),
(13, 'Academic Writing'),
(14, 'Acceptance Testing'),
(15, 'Accident Insurance'),
(16, 'Acquisition Assessment'),
(17, 'Acquisition Sales'),
(18, 'Acquisitions'),
(19, 'Acturial Sciences'),
(20, 'Ad Development'),
(21, 'Ad Tracking'),
(22, 'Ada'),
(23, 'Adobe Experience Design'),
(24, 'Adobe Illustrator'),
(25, 'Adobe Photoshop'),
(26, 'Adobe Software'),
(27, 'Adobe Suite'),
(28, 'Adobe'),
(29, 'Adult Education'),
(30, 'Advertising Law'),
(31, 'Advertising'),
(32, 'Aerospace Engineering'),
(33, 'Agile'),
(34, 'Agile & Waterfall Methodologies'),
(35, 'Agile Application Development'),
(36, 'Agile Environment'),
(37, 'Agile Leadership'),
(38, 'Agile Methodologies'),
(39, 'Agile Modeling'),
(40, 'Agile Project Management'),
(41, 'Agile Testing'),
(42, 'Agile Web Development'),
(43, 'Agriculture'),
(44, 'Algorithm Analysis'),
(45, 'Amazon CloudFront'),
(46, 'Amazon Dynamodb'),
(47, 'Amazon EBS'),
(48, 'Amazon EC2'),
(49, 'Amazon Kindle'),
(50, 'Amazon Marketplace'),
(51, 'Amazon Mechanical Turk'),
(52, 'Amazon RDS'),
(53, 'Amazon Redshift'),
(54, 'Amazon S3'),
(55, 'Amazon SQS'),
(56, 'Amazon SimpleDB (SDB)'),
(57, 'Amazon VPC'),
(58, 'AngularJS'),
(59, 'Antenna'),
(60, 'Applied Mathematics'),
(61, 'Architecture'),
(62, 'Arch Linux'),
(63, 'Artificial Intelligence'),
(64, 'Art'),
(65, 'Automation'),
(66, 'Back-end Programming'),
(67, 'Banking'),
(68, 'Business Administration'),
(69, 'Business Development'),
(70, 'Business Management'),
(71, 'Blockchain'),
(72, 'Blue Team'),
(73, 'Binary Exploitation'),
(74, 'Biology'),
(75, 'Bitcoin'),
(76, 'Bootstrap'),
(77, 'CSS'),
(78, 'C'),
(79, 'C Plus Plus'),
(80, 'C Sharp'),
(81, 'CI/CD'),
(82, 'Cassandra'),
(83, 'Chemical Engineering'),
(84, 'Chemistry'),
(85, 'Chocolatey'),
(86, 'Cloud Computing'),
(87, 'Cloud Deployment'),
(88, 'Cloud Development'),
(89, 'COBOL'),
(90, 'Cocoa Touch'),
(91, 'Cocoa'),
(92, 'CoffeeScript'),
(93, 'Command and Control'),
(94, 'Computer Graphics'),
(95, 'Computer Networking'),
(96, 'Computer Science'),
(97, 'Computer Vision'),
(98, 'Communication'),
(99, 'Continuous Deployment (CD)'),
(100, 'Continuous Integration (CI)'),
(101, 'Contract Law'),
(102, 'Corporate Design'),
(103, 'Corporate Development'),
(104, 'Corporate Management'),
(105, 'Cost Analysis'),
(106, 'Customer Outreach'),
(107, 'Customer Relationship Management (CRM)'),
(108, 'Cyber-physical Systems'),
(109, 'Cyber-security'),
(110, 'DNS Administration'),
(111, 'DNS Management'),
(112, 'DNS Server'),
(113, 'DDoS'),
(114, 'D'),
(115, 'Dart'),
(116, 'Data Science'),
(117, 'Data Analytics'),
(118, 'Database Management'),
(119, 'Data Engineering'),
(120, 'Debian'),
(121, 'Design'),
(122, 'DevOps'),
(123, 'Desktop Application Design'),
(124, 'Desktop Application Development'),
(125, 'Docker'),
(126, 'ECMAScript'),
(127, 'ERP Software'),
(128, 'ER Modelling'),
(129, 'Economics'),
(130, 'Education'),
(131, 'Electrical Engineering'),
(132, 'ElectronJS'),
(133, 'Embedded Systems'),
(134, 'Embedded Software Programming'),
(135, 'Embedded Operating Systems'),
(136, 'Ember.js'),
(137, 'Encryption'),
(138, 'Engineering Design'),
(139, 'Erlang'),
(140, 'Ethical Hacking'),
(141, 'Exploratory Data Analysis'),
(142, 'Filming'),
(143, 'Film Studies'),
(144, 'Financial Accounting'),
(145, 'Financial Advisory'),
(146, 'Financial Analysis'),
(147, 'Financial Law'),
(148, 'Financial Literacy'),
(149, 'Financial Technology'),
(150, 'Financial Management'),
(151, 'Finance Consulting'),
(152, 'Finance'),
(153, 'Food Law'),
(154, 'Food Safety'),
(155, 'Food Science'),
(156, 'Foreign Exchange'),
(157, 'Fortran'),
(158, 'Fraud Analysis'),
(159, 'FreeBSD'),
(160, 'Front-end Development'),
(161, 'Fulfillment Management'),
(162, 'Functional Programming'),
(163, 'Functional Testing'),
(164, 'GIMP'),
(165, 'GNOME'),
(166, 'GUI Development'),
(167, 'GUI Testing'),
(168, 'Game Design'),
(169, 'Game Development'),
(170, 'Geography'),
(171, 'Geospatial Analysis'),
(172, 'Git'),
(173, 'Github'),
(174, 'Golang'),
(175, 'Google Cloud Platform (GCP)'),
(176, 'Gradle'),
(177, 'Graphic Design'),
(178, 'GraphQL'),
(179, 'HTML'),
(180, 'HTTP/HTTPS'),
(181, 'HTTP Server'),
(182, 'Haskell'),
(183, 'Hardware Design'),
(184, 'Hardware Development'),
(185, 'Hardware Engineering'),
(186, 'Hardware Testing'),
(187, 'Healthcare'),
(188, 'Heroku'),
(189, 'Heuristics'),
(190, 'History'),
(191, 'Human Resource (HR)'),
(192, 'Hypervirtualisation'),
(193, 'Identity and Access Management (IAM)'),
(194, 'Illustrator'),
(195, 'Image Editing'),
(196, 'Incident Response (IR)'),
(197, 'Industrial Engineering'),
(198, 'Industrial Systems'),
(199, 'Insurance'),
(200, 'Internet of Things (IoT)'),
(201, 'Investing'),
(202, 'Investment Banking'),
(203, 'JavaScript (JS)'),
(204, 'Java'),
(205, 'JavaFX'),
(206, 'Java Springboot'),
(207, 'Jenkins'),
(208, 'JQuery'),
(209, 'JQuery UI'),
(210, 'JQuery Mobile'),
(211, 'Julia'),
(212, 'KDE'),
(213, 'Kotlin'),
(214, 'Law'),
(215, 'Leadership'),
(216, 'Linux'),
(217, 'Life Sciences'),
(218, 'Linguistics'),
(219, 'Lisp'),
(220, 'Log Analysis'),
(221, 'Lua'),
(222, 'MATE'),
(223, 'Mac OS'),
(224, 'Machine Learning'),
(225, 'Machine Translation'),
(226, 'Malware'),
(227, 'Management'),
(228, 'Marine Biology'),
(229, 'Marine Sciences'),
(230, 'Marine Research'),
(231, 'Maritime Law'),
(232, 'Maritime Operations'),
(233, 'Markdown'),
(234, 'Marketing'),
(235, 'Mass Communication'),
(236, 'Material Design'),
(237, 'Material Research'),
(238, 'Mathematics'),
(239, 'Mechanical Engineering'),
(240, 'Mechanical Design'),
(241, 'Media Design'),
(242, 'Media Development'),
(243, 'Medical Law'),
(244, 'Medicine'),
(245, 'Mental Health'),
(246, 'Mergers and Acquisitions (M&A)'),
(247, 'Microsoft Suite'),
(248, 'Mobile Application Development'),
(249, 'Mobile Game Development'),
(250, 'Mobile User Experience Design'),
(251, 'Mobile User Interface Design'),
(252, 'MongoDB'),
(253, 'Music'),
(254, 'MySQL'),
(255, 'Natural Language Processing (NLP)'),
(256, 'Natural Language Generation (NLG)'),
(257, 'Neo4j'),
(258, 'Network Scanning'),
(259, 'Neural Network'),
(260, 'NodeJS'),
(261, 'NoSQL'),
(262, 'Nvidia'),
(263, 'Obfuscation'),
(264, 'Objective C'),
(265, 'Object-oriented Programming'),
(266, 'Object-relational Mapping'),
(267, 'Operating System'),
(268, 'Operational Law'),
(269, 'Operational Management'),
(270, 'Opera'),
(271, 'Opera Suite'),
(272, 'PHP Laravel'),
(273, 'PHP'),
(274, 'Pascal'),
(275, 'PayPal'),
(276, 'Penetration Testing'),
(277, 'Perl'),
(278, 'Persuasion'),
(279, 'Pharmaceuticals'),
(280, 'Photography'),
(281, 'Physics'),
(282, 'Planning'),
(283, 'Political Science'),
(284, 'Power BI'),
(285, 'Presentation'),
(286, 'Privilege Escalation'),
(287, 'Process Analysis'),
(288, 'Product Design'),
(289, 'Product Management'),
(290, 'Project Design'),
(291, 'Project Management'),
(292, 'Programming'),
(293, 'Psychology'),
(294, 'Psychiatry'),
(295, 'Public Policy'),
(296, 'Public Speaking'),
(297, 'Publicity'),
(298, 'Python Django'),
(299, 'Python Flask'),
(300, 'Python Kivy'),
(301, 'Python Matplotlib'),
(302, 'Python Numpy'),
(303, 'Python Pandas'),
(304, 'Python Sci-kit Learn'),
(305, 'Python SciPy'),
(306, 'Python'),
(307, 'Pytorch'),
(308, 'Quality Assurance'),
(309, 'R'),
(310, 'ReactJS'),
(311, 'React Native'),
(312, 'Real Estate'),
(313, 'Reconnaisance'),
(314, 'Redis'),
(315, 'Red Team'),
(316, 'Research and Development (R&D)'),
(317, 'Research'),
(318, 'Retail Design'),
(319, 'Retail'),
(320, 'Risk Analysis'),
(321, 'Robotics'),
(322, 'Root Cause Analysis'),
(323, 'Rural Development'),
(324, 'Rust'),
(325, 'SAP'),
(326, 'SASS'),
(327, 'SOAP'),
(328, 'Safety Administration'),
(329, 'Safety Design'),
(330, 'Safety Engineering'),
(331, 'Sales'),
(332, 'Salesforce'),
(333, 'Scala'),
(334, 'Sculpting'),
(335, 'Security Research'),
(336, 'Social Commerce'),
(337, 'Social Media'),
(338, 'Social Media Advertising'),
(339, 'Social Science'),
(340, 'Social Work'),
(341, 'Sociology'),
(342, 'Socket.io'),
(343, 'Software Design'),
(344, 'Software Development'),
(345, 'Soft Skills'),
(346, 'Statistics'),
(347, 'Stripe'),
(348, 'Swift'),
(349, 'System Administration'),
(350, 'System Testing'),
(351, 'Tableau'),
(352, 'Tensorflow'),
(353, 'Time Management'),
(354, 'Ubuntu'),
(355, 'Unix'),
(356, 'User Experience (UX)'),
(357, 'User Interface (UI)'),
(358, 'User Acceptance testing (UAT)'),
(359, 'VueJS'),
(360, 'VMWare'),
(361, 'VirtualBox'),
(362, 'Web Application Development'),
(363, 'Web Server'),
(364, 'Windows'),
(365, 'Writing'),
(366, 'Xamarin'),
(367, '.NET');

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
  `bg_image_name` varchar(150) DEFAULT NULL,
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

INSERT INTO `User` (`id`, `username`, `password_hash`, `name`, `age`, `mobile_number`, `email`, `gender`, `image_name`, `bg_image_name`, `interest`, `school`, `year_of_study`, `course`, `date_start`, `date_end`) VALUES
(1, 'Alexandria78', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Dr. Guadalupe Barrows', 25, '85703014', 'Mertie.Schaden7@hotmail.com', 'M', 'Ming_Rong.jpg', NULL, 'Front-end Development Medicine Blockchain Data Science Natural Language Processing (NLP) ', 'SUSS', 2, 'Ethical Hacking', '2021-11-12 16:25:48', NULL),
(2, 'Alexandria78', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Dr. Guadalupe Barrows', 25, '85703014', 'Mertie.Schaden7@hotmail.com', 'M', '', NULL, 'Front-end Development Medicine Blockchain Data Science Natural Language Processing (NLP) ', 'SUSS', 2, 'Ethical Hacking', '2021-10-18 16:00:01', NULL),
(3, 'Clara.Terry', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Mindy West DDS', 25, '95089612', 'Sandra.Hintz@yahoo.com', 'F', '', NULL, 'Opera Root Cause Analysis Real Estate Quality Assurance Adobe Experience Design ', 'SMU', 2, 'Ad Tracking', '2021-10-18 16:00:01', NULL),
(4, 'Letha.Ruecker', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Sandra Padberg', 24, '94569995', 'Arvilla_Lind63@gmail.com', 'O', NULL, NULL, 'NoSQL Academic Writing Computer Science Python Pandas Amazon VPC ', 'NTU', 3, 'Marine Sciences', '2021-10-18 16:00:01', NULL),
(5, 'Hailey.Yost', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Mrs. Sonia Weimann', 24, '87367708', 'Audra_Daugherty@hotmail.com', 'F', NULL, NULL, 'ElectronJS Ethical Hacking AV Systems ', 'NTU', 3, 'Law', '2021-10-18 16:00:01', NULL),
(6, 'Lilian1', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Seth Senger', 21, '93192041', 'Taurean.Bruen88@hotmail.com', 'F', NULL, NULL, 'VMWare Cloud Development ', 'NUS', 4, 'Cloud Computing', '2021-10-18 16:00:01', NULL),
(7, 'Kaylie14', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Freda Torp', 24, '88463327', 'Travis36@yahoo.com', 'M', NULL, NULL, 'Food Science Ada HTTP Server Desktop Application Design Incident Response (IR) History ', 'SUSS', 1, 'Internet of Things (IoT)', '2021-10-18 16:00:01', NULL),
(8, 'Nils14', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Mrs. Becky Altenwerth', 25, '98467427', 'Tate72@gmail.com', 'M', NULL, NULL, 'Agile Game Design Social Work ', 'NUS', 1, 'Investing', '2021-10-18 16:00:01', NULL),
(9, 'Jamel69', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Ada Skiles', 19, '94195138', 'Norval_Jaskolski73@yahoo.com', 'F', NULL, NULL, 'Hardware Engineering Adobe ', 'SUSS', 2, 'Agriculture', '2021-10-18 16:00:01', NULL),
(10, 'Brooks.Kessler82', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Miss Nicolas Mosciski', 19, '92808867', 'Matt.Ziemann78@gmail.com', 'M', NULL, NULL, 'Hardware Testing Safety Administration Python Sci-kit Learn Financial Advisory Real Estate Game Development ', 'SMU', 3, 'Chemistry', '2021-10-18 16:00:01', NULL),
(11, 'Rico.Bayer52', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Melissa Wyman', 26, '87773612', 'Jenifer34@yahoo.com', 'F', NULL, NULL, 'C ', 'NTU', 3, 'Quality Assurance', '2021-10-18 16:00:01', NULL),
(12, 'Carolina.Ziemann', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Jaime Waters', 18, '92315884', 'Zane62@gmail.com', 'O', NULL, NULL, 'Back-end Programming Java Automation Mass Communication ', 'SIT', 3, 'Biology', '2021-10-18 16:00:01', NULL),
(13, 'Leatha.Corkery', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Jeff Farrell', 20, '92334226', 'Betsy56@yahoo.com', 'M', NULL, NULL, 'Reconnaisance Medical Law Advertising Law Data Science DDoS Web Application Development ECMAScript Mobile User Experience Design Cyber-security ', 'SMU', 2, 'Graphic Design', '2021-10-18 16:00:01', NULL),
(14, 'Rachelle_Hand', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Monica Stroman', 19, '99236102', 'Theo_Jacobi@hotmail.com', 'M', NULL, NULL, 'Embedded Systems Incident Response (IR) Corporate Management Database Management ', 'SIT', 3, 'Antenna', '2021-10-18 16:00:01', NULL),
(15, 'Lukas.Krajcik', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Frances Volkman', 21, '88628540', 'King_Yundt82@gmail.com', 'O', NULL, NULL, 'Process Analysis Ethical Hacking ', 'NTU', 3, 'Engineering Design', '2021-10-18 16:00:01', NULL),
(16, 'Alexandra.Gerlach', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Gregg Schuster', 26, '85873149', 'Bette.Hansen@yahoo.com', 'M', NULL, NULL, 'Applied Mathematics Financial Management Object-oriented Programming Writing JQuery Mobile Mass Communication Neo4j Hypervirtualisation ', 'NTU', 4, 'Statistics', '2021-10-18 16:00:01', NULL),
(17, 'Lottie68', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Marty Kiehn', 19, '85897455', 'Saul.Schiller21@yahoo.com', 'F', NULL, NULL, 'Agile Environment Financial Accounting ', 'SUSS', 3, 'Software Design', '2021-10-18 16:00:01', NULL),
(18, 'Mary_Tromp39', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Jeannette Metz', 21, '86613085', 'Robb.Smitham@yahoo.com', 'M', NULL, NULL, '', 'NUS', 1, 'Project Management', '2021-10-18 16:00:01', NULL),
(19, 'Verona44', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Jenny Hodkiewicz', 25, '84978508', 'Yasmeen93@yahoo.com', 'M', NULL, NULL, 'Medicine Hardware Testing Mac OS Docker R ', 'SUSS', 3, 'Political Science', '2021-10-18 16:00:01', NULL),
(20, 'Forrest50', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Fernando Gerhold', 26, '96138634', 'Emmet74@hotmail.com', 'M', NULL, NULL, '', 'SUSS', 2, 'Game Development', '2021-10-18 16:00:01', NULL),
(21, 'Garth.Langosh62', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Martin Oberbrunner', 21, '83199239', 'Sheila92@gmail.com', 'M', NULL, NULL, 'Redis Biology Fortran Social Media Advertising Applied Mathematics Planning Mac OS ', 'SIM', 4, 'Data Engineering', '2021-10-18 16:00:01', NULL),
(22, 'Patsy_Mohr', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Christine Volkman', 20, '99356719', 'Clovis_Greenholt@hotmail.com', 'O', NULL, NULL, 'Financial Advisory JavaScript (JS) Finance Consulting PayPal ', 'NTU', 1, 'Hardware Development', '2021-10-18 16:00:01', NULL),
(23, 'Petra96', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Sergio Spencer', 26, '84728943', 'Ernie_Spencer@yahoo.com', 'F', NULL, NULL, 'Natural Language Processing (NLP) Agile Modeling Dart Embedded Systems ', 'NUS', 2, 'Agriculture', '2021-10-18 16:00:01', NULL),
(24, 'Hosea99', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Ms. Kristina Grant', 22, '84773540', 'Dayana27@gmail.com', 'F', NULL, NULL, 'Public Speaking HTML Rust ', 'SUSS', 1, 'Finance', '2021-10-18 16:00:01', NULL),
(25, 'Theron_Wilderman53', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Hazel Beatty II', 26, '96873314', 'Dino.Fritsch53@yahoo.com', 'O', NULL, NULL, 'Exploratory Data Analysis ', 'NTU', 4, 'Product Management', '2021-10-18 16:00:01', NULL),
(26, 'Keyon_Kling', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Miranda Parisian', 21, '94578565', 'Harley88@hotmail.com', 'O', NULL, NULL, 'Amazon EC2 API ', 'SUTD', 4, 'Safety Administration', '2021-10-18 16:00:01', NULL),
(27, 'Letitia_Trantow', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Jamie Cummerata', 19, '83372509', 'Derek_Heaney94@yahoo.com', 'O', NULL, NULL, 'Project Management ', 'SIT', 2, 'Mass Communication', '2021-10-18 16:00:01', NULL),
(28, 'Catalina_Daniel0', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Ms. Edgar Hagenes', 19, '84337853', 'Hollis_Johnson@yahoo.com', 'O', NULL, NULL, 'Writing Python SciPy Cassandra Bitcoin AngularJS Law Obfuscation Research and Development (R&D) Ada ', 'SIM', 4, 'Insurance', '2021-10-18 16:00:01', NULL),
(29, 'Louie.Stark', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Keith Parker', 26, '92949920', 'Maggie10@hotmail.com', 'O', NULL, NULL, '', 'SUTD', 3, 'Political Science', '2021-10-18 16:00:01', NULL),
(30, 'Dashawn_Rath9', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Larry Sawayn', 26, '99608781', 'Hazel.Cruickshank@gmail.com', 'F', NULL, NULL, 'Financial Analysis ASP.NET Heroku ', 'SIT', 4, 'Material Design', '2021-10-18 16:00:01', NULL),
(31, 'Kathlyn_Trantow77', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Miss Celia Brakus', 21, '84243320', 'Marilou_Jones@hotmail.com', 'F', NULL, NULL, 'Life Sciences ', 'SUSS', 1, 'Sociology', '2021-10-18 16:00:01', NULL),
(32, 'Phoebe74', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Mr. Caleb DuBuque', 25, '95579654', 'Leila_Carroll@yahoo.com', 'F', NULL, NULL, 'PayPal Management Scala Continuous Deployment (CD) Python Sci-kit Learn Hardware Design VMWare Amazon SQS Cloud Deployment ', 'SIM', 3, 'Material Design', '2021-10-18 16:00:01', NULL),
(33, 'Wallace.Johns', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Jody Rowe', 22, '95949500', 'Vivian37@yahoo.com', 'O', NULL, NULL, 'Agile Application Development Marine Biology User Interface (UI) C Plus Plus Cloud Computing Financial Technology ', 'SMU', 1, 'Mass Communication', '2021-10-18 16:00:01', NULL),
(34, 'Shawn.Ziemann', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Geoffrey Murray', 21, '86962352', 'Evans14@gmail.com', 'O', NULL, NULL, 'GUI Testing User Acceptance testing (UAT) Electrical Engineering Industrial Systems Computer Graphics Mergers and Acquisitions (M&A) ', 'SUSS', 3, 'Biology', '2021-10-18 16:00:01', NULL),
(35, 'Lindsey_Herzog6', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Howard Schmeler', 25, '99843609', 'Jewell_Kerluke@hotmail.com', 'M', NULL, NULL, 'Management Geography Agile & Waterfall Methodologies Network Scanning Haskell ', 'SUSS', 2, 'Healthcare', '2021-10-18 16:00:01', NULL),
(36, 'Stewart79', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Darrin Robel', 21, '97423842', 'Terrance.Schimmel@gmail.com', 'M', NULL, NULL, 'Mental Health D Physics Industrial Engineering ', 'SIT', 2, 'Graphic Design', '2021-10-18 16:00:01', NULL),
(37, 'Mae.Kihn', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Forrest Fisher', 25, '97544163', 'Abigayle_Gorczany84@yahoo.com', 'O', NULL, NULL, 'Privilege Escalation Python Food Law Jenkins VirtualBox Python Flask Management Agile Environment ', 'SIM', 1, 'Investment Banking', '2021-10-18 16:00:01', NULL),
(38, 'Delbert.Waters9', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Melody Hackett', 22, '95406161', 'Kaylin90@gmail.com', 'M', NULL, NULL, 'Financial Law Medical Law Mathematics Real Estate Computer Science Unix ', 'SUSS', 4, 'User Experience (UX)', '2021-10-18 16:00:01', NULL),
(39, 'Dana55', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Flora Willms', 25, '86744032', 'Ed37@gmail.com', 'O', NULL, NULL, 'CoffeeScript Adobe Experience Design Aerospace Engineering Agile Web Development Kotlin Financial Technology AV Systems Pascal ', 'SMU', 3, 'Safety Administration', '2021-10-18 16:00:01', NULL),
(40, 'Brooks_Satterfield', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Benjamin Hirthe', 25, '97819744', 'Monserrate28@hotmail.com', 'M', NULL, NULL, 'Java Time Management Opera Opera GIMP Product Management ', 'SIM', 4, 'Psychiatry', '2021-10-18 16:00:01', NULL),
(41, 'Daren_OHara', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Marion Gerhold DDS', 21, '87252344', 'Braxton23@yahoo.com', 'F', NULL, NULL, 'Geography Industrial Engineering ', 'SMU', 4, 'Public Policy', '2021-10-18 16:00:01', NULL),
(42, 'Raphael.Greenfelder', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Mrs. Kim Hintz', 24, '95402137', 'Stanley91@yahoo.com', 'O', NULL, NULL, 'DNS Administration Cloud Deployment Presentation Linux Media Design Mental Health Amazon EBS Financial Management Food Safety ', 'SUSS', 3, 'Safety Administration', '2021-10-18 16:00:01', NULL),
(43, 'Lurline_Stanton', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Paulette Nikolaus', 23, '89078512', 'Marjolaine.Jones@gmail.com', 'O', NULL, NULL, 'Adobe Suite Planning Database Management ', 'SUTD', 4, 'Financial Management', '2021-10-18 16:00:01', NULL),
(44, 'Alysa58', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Stacey Hoppe', 22, '85572365', 'Hilario_Kling59@gmail.com', 'M', NULL, NULL, 'VMWare Design AJAX Julia MATE JQuery UI Medicine DevOps Research and Development (R&D) ', 'NUS', 1, 'Aerospace Engineering', '2021-10-18 16:00:01', NULL),
(45, 'Niko_Streich9', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Ebony Hackett', 19, '88424563', 'Ethelyn_Effertz91@yahoo.com', 'F', NULL, NULL, 'Communication Adobe Software D Debian Arch Linux Design Binary Exploitation Xamarin Statistics ', 'SMU', 4, 'Social Science', '2021-10-18 16:00:01', NULL),
(46, 'Frank.Adams89', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Miss Saul Conroy', 19, '94865531', 'Lucious.Huels37@yahoo.com', 'F', NULL, NULL, 'Soft Skills Tableau CoffeeScript Graphic Design Dart Operating System Material Design JavaFX Real Estate ', 'SIT', 4, 'Agriculture', '2021-10-18 16:00:01', NULL),
(47, 'Lynn35', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Jennifer Brown', 21, '85797472', 'Alfonzo.Boyle57@hotmail.com', 'M', NULL, NULL, 'Amazon Web Service (AWS) Red Team Geospatial Analysis Web Application Development Corporate Design Malware AV Systems Computer Networking Mechanical Engineering ', 'SUSS', 4, 'Filming', '2021-10-18 16:00:01', NULL),
(48, 'Paolo.Gusikowski', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Sue Mante', 21, '93616693', 'Jerrell66@hotmail.com', 'M', NULL, NULL, 'Mass Communication GUI Testing Amazon Kindle Geography Biology ', 'NUS', 2, 'Cyber-security', '2021-10-18 16:00:01', NULL),
(49, 'Earnest.Purdy', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Leigh Lowe', 25, '98682690', 'Emily29@yahoo.com', 'O', NULL, NULL, 'Privilege Escalation Academic Administration Adult Education Machine Learning Adobe Experience Design Sociology Identity and Access Management (IAM) ', 'SUTD', 4, 'Database Management', '2021-10-18 16:00:01', NULL),
(50, 'Lyda.Dibbert', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Luke Herzog', 26, '96675971', 'Valentina_Connelly@gmail.com', 'M', NULL, NULL, 'Hardware Development Sculpting Agile Environment Advertising Ad Tracking Github Amazon CloudFront API ', 'SIT', 2, 'Maritime Operations', '2021-10-18 16:00:01', NULL),
(51, 'Percival23', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Melinda Ledner', 21, '99739539', 'Sienna.Shields60@gmail.com', 'F', NULL, NULL, 'React Native Amazon SimpleDB (SDB) Acceptance Testing Erlang Illustrator Quality Assurance ', 'SIT', 4, 'Cloud Development', '2021-10-18 16:00:01', NULL),
(52, 'Alvina.Satterfield', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Michelle Hamill', 25, '87082476', 'Vicky.Marvin@yahoo.com', 'F', NULL, NULL, 'Obfuscation Management ', 'NTU', 2, 'Cyber-security', '2021-10-18 16:00:01', NULL),
(53, 'Breana4', '$2y$10$rF6mIBumpp2DCJN/fpJKCuoNmgkbaT65eqk3W9DgUb42ZiJI2vntS', 'Vivian Bernhard', 21, '98445740', 'Collin14@yahoo.com', 'F', NULL, NULL, 'Haskell Sociology DNS Administration Continuous Integration (CI) JQuery Mobile Hardware Design Python Kivy Academic Publishing ', 'SIM', 2, 'Quality Assurance', '2021-10-18 16:00:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `User_Competition`
--

CREATE TABLE `User_Competition` (
  `user_id` int(11) NOT NULL,
  `competition_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User_Competition`
--

INSERT INTO `User_Competition` (`user_id`, `competition_id`) VALUES
(1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `User_Group`
--

CREATE TABLE `User_Group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 4),
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
(1, 54),
(39, 67),
(50, 71),
(7, 83),
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
(45, 356),
(38, 365),
(18, 367);

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
-- Indexes for table `Competition`
--
ALTER TABLE `Competition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Competition_Skill`
--
ALTER TABLE `Competition_Skill`
  ADD PRIMARY KEY (`competition_id`,`skill_id`),
  ADD KEY `competition_skill_fk2` (`skill_id`);

--
-- Indexes for table `Connection`
--
ALTER TABLE `Connection`
  ADD PRIMARY KEY (`user_id1`,`user_id2`),
  ADD KEY `connection_fk2` (`user_id2`);

--
-- Indexes for table `Connection_Request`
--
ALTER TABLE `Connection_Request`
  ADD PRIMARY KEY (`from_id`,`to_id`),
  ADD KEY `connection_request_fk2` (`to_id`);

--
-- Indexes for table `Fee`
--
ALTER TABLE `Fee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Group`
--
ALTER TABLE `Group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_fk` (`competition_id`);

--
-- Indexes for table `Match`
--
ALTER TABLE `Match`
  ADD PRIMARY KEY (`user_id1`,`user_id2`),
  ADD KEY `match_fk2` (`user_id2`);

--
-- Indexes for table `Payment_History`
--
ALTER TABLE `Payment_History`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_history_fk1` (`user_id`),
  ADD KEY `payment_history_fk2` (`fee_id`);

--
-- Indexes for table `Skill`
--
ALTER TABLE `Skill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `User_Competition`
--
ALTER TABLE `User_Competition`
  ADD PRIMARY KEY (`user_id`,`competition_id`),
  ADD KEY `user_competition_fk2` (`competition_id`);

--
-- Indexes for table `User_Group`
--
ALTER TABLE `User_Group`
  ADD PRIMARY KEY (`user_id`,`group_id`),
  ADD KEY `user_group_fk2` (`group_id`);

--
-- Indexes for table `User_Lacks`
--
ALTER TABLE `User_Lacks`
  ADD PRIMARY KEY (`user_id`,`skill_id`),
  ADD KEY `user_lacks_fk2` (`skill_id`);

--
-- Indexes for table `User_Skill`
--
ALTER TABLE `User_Skill`
  ADD PRIMARY KEY (`user_id`,`skill_id`),
  ADD KEY `user_skill_fk2` (`skill_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Competition`
--
ALTER TABLE `Competition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `Fee`
--
ALTER TABLE `Fee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Group`
--
ALTER TABLE `Group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Payment_History`
--
ALTER TABLE `Payment_History`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Skill`
--
ALTER TABLE `Skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=368;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Competition_Skill`
--
ALTER TABLE `Competition_Skill`
  ADD CONSTRAINT `competition_skill_fk1` FOREIGN KEY (`competition_id`) REFERENCES `Competition` (`id`),
  ADD CONSTRAINT `competition_skill_fk2` FOREIGN KEY (`skill_id`) REFERENCES `Skill` (`id`);

--
-- Constraints for table `Connection`
--
ALTER TABLE `Connection`
  ADD CONSTRAINT `connection_fk1` FOREIGN KEY (`user_id1`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `connection_fk2` FOREIGN KEY (`user_id2`) REFERENCES `User` (`id`);

--
-- Constraints for table `Connection_Request`
--
ALTER TABLE `Connection_Request`
  ADD CONSTRAINT `connection_request_fk1` FOREIGN KEY (`from_id`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `connection_request_fk2` FOREIGN KEY (`to_id`) REFERENCES `User` (`id`);

--
-- Constraints for table `Group`
--
ALTER TABLE `Group`
  ADD CONSTRAINT `group_fk` FOREIGN KEY (`competition_id`) REFERENCES `Competition` (`id`);

--
-- Constraints for table `Match`
--
ALTER TABLE `Match`
  ADD CONSTRAINT `match_fk1` FOREIGN KEY (`user_id1`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `match_fk2` FOREIGN KEY (`user_id2`) REFERENCES `User` (`id`);

--
-- Constraints for table `Payment_History`
--
ALTER TABLE `Payment_History`
  ADD CONSTRAINT `payment_history_fk1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `payment_history_fk2` FOREIGN KEY (`fee_id`) REFERENCES `Fee` (`id`);

--
-- Constraints for table `User_Competition`
--
ALTER TABLE `User_Competition`
  ADD CONSTRAINT `user_competition_fk1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `user_competition_fk2` FOREIGN KEY (`competition_id`) REFERENCES `Competition` (`id`);

--
-- Constraints for table `User_Group`
--
ALTER TABLE `User_Group`
  ADD CONSTRAINT `user_group_fk1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `user_group_fk2` FOREIGN KEY (`group_id`) REFERENCES `Group` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `User_Lacks`
--
ALTER TABLE `User_Lacks`
  ADD CONSTRAINT `user_lacks_fk1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`),
  ADD CONSTRAINT `user_lacks_fk2` FOREIGN KEY (`skill_id`) REFERENCES `Skill` (`id`);

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
