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

CREATE TABLE `Competition_Skill` (
  `competition_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Connection` (
  `user_id1` int(11) NOT NULL,
  `user_id2` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Connection_Request` (
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Fee` (
  `id` int(11) NOT NULL,
  `amount` float DEFAULT NULL,
  `date_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Group` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `competition_id` int(11) NOT NULL,
  `is_private` tinyint(1) DEFAULT NULL,
  `date_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_end` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `Match` (
  `user_id1` int(11) NOT NULL,
  `user_id2` int(11) NOT NULL,
  `compatibility` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('Pending','Cleared','Rejected') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Payment_History` (
  `id` int(11) NOT NULL,
  `date_paid` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `fee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Skill` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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

CREATE TABLE `User_Competition` (
  `user_id` int(11) NOT NULL,
  `competition_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `User_Group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `is_admin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `User_Lacks` (
  `user_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `User_Skill` (
  `user_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  `proficiency` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Group_Idea` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `idea` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
