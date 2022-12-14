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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Skill`
--
ALTER TABLE `Skill`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Skill`
--
ALTER TABLE `Skill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=368;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
