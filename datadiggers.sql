-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2015 at 03:26 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `datadiggers`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Delete_Internship`(  
IN p_Internship_ID int(10)
  )
BEGIN 
  
    DELETE From internship
    where internship_id= p_Internship_ID;
 
   END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Update_Internship`(  
IN p_Internship_ID int(10),
IN jobTitle Varchar(50),
IN jobDesc text,
IN semester Varchar(10),
IN weeklyHoursRequired Varchar(10),
IN minGpaRequired Varchar(5) ,
IN startDate date,
IN endDate date,

IN pay Varchar(10)

  )
BEGIN 
  
    UPDATE internship
        SET 
job_title = jobTitle,
    job_desc = jobDesc,
    semester = semester,
    weekly_hours_required = weeklyHoursRequired,
    min_gpa_required = minGpaRequired,
    start_date = startDate,
    end_date = endDate,

    pay = pay 
where internship_id= p_Internship_ID;
 
   END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `person_id` int(10) NOT NULL,
  `department_id` int(10) NOT NULL,
  `title` varchar(20) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `department_id` (`department_id`),
  KEY `person_id` (`person_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `business`
--

CREATE TABLE IF NOT EXISTS `business` (
  `business_id` int(10) NOT NULL AUTO_INCREMENT,
  `contact_name` varchar(30) NOT NULL,
  `contact_email` varchar(30) NOT NULL,
  `business_name` varchar(25) NOT NULL,
  `business_type` varchar(10) NOT NULL,
  `internship_opportunities` varchar(30) NOT NULL,
  PRIMARY KEY (`business_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `business`
--

INSERT INTO `business` (`business_id`, `contact_name`, `contact_email`, `business_name`, `business_type`, `internship_opportunities`) VALUES
(1, 'James Franco', 'james@gmail.com', 'Vision360', 'Software d', ''),
(2, 'Frank Langella', 'frank@gmail.com', 'T1 System', 'I.T.', ''),
(3, 'Richard Jenkins', 'jenkins@gmail.com', 'Solution System', 'I.T.', ''),
(4, 'Peter Krause', 'peter@gmail.com', 'Inscripts', 'I.T,', ''),
(5, 'Palak Rathod', 'palak@gmail.com', 'Fortune Technologies', 'Software d', ''),
(6, 'Palak Rathod', 'jenkins@gmail.com', 'BPL', 'Software d', ''),
(7, 'Frank Rathod', 'jenkins@gmail.com', 'Fortune', 'Software d', ''),
(8, 'ndjsndjs', 'bvahbvh@bdh.cncj', 'n fmjf', 'nfjdnfj', '4');

-- --------------------------------------------------------

--
-- Stand-in structure for view `bus_internship`
--
CREATE TABLE IF NOT EXISTS `bus_internship` (
`internship_id` int(10)
,`business_id` int(10)
,`job_title` varchar(50)
,`job_desc` text
,`semester` varchar(10)
,`weekly_hours_required` varchar(10)
,`min_gpa_required` varchar(5)
,`start_date` date
,`end_date` date
,`internship_active` varchar(5)
,`pay` varchar(10)
,`business_name` varchar(25)
);
-- --------------------------------------------------------

--
-- Table structure for table `deparment`
--

CREATE TABLE IF NOT EXISTS `deparment` (
  `department_id` int(10) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(20) NOT NULL,
  `department_details` varchar(50) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `deparment`
--

INSERT INTO `deparment` (`department_id`, `department_name`, `department_details`) VALUES
(1, 'CS', 'Computer Science'),
(2, 'IT', 'Information Technology');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

CREATE TABLE IF NOT EXISTS `evaluation` (
  `evaluation_id` int(10) NOT NULL AUTO_INCREMENT,
  `placement_id` int(10) NOT NULL,
  `comments` text NOT NULL,
  PRIMARY KEY (`evaluation_id`),
  KEY `placement_id` (`placement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`evaluation_id`, `placement_id`, `comments`) VALUES
(1, 1, 'Completed Project '),
(2, 2, 'Project Complete');

-- --------------------------------------------------------

--
-- Table structure for table `internship`
--

CREATE TABLE IF NOT EXISTS `internship` (
  `internship_id` int(10) NOT NULL AUTO_INCREMENT,
  `business_id` int(10) DEFAULT NULL,
  `job_title` varchar(50) DEFAULT NULL,
  `job_desc` text,
  `semester` varchar(10) DEFAULT NULL,
  `weekly_hours_required` varchar(10) DEFAULT NULL,
  `min_gpa_required` varchar(5) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `internship_active` varchar(5) NOT NULL,
  `pay` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`internship_id`),
  KEY `Business_ID` (`business_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `internship`
--

INSERT INTO `internship` (`internship_id`, `business_id`, `job_title`, `job_desc`, `semester`, `weekly_hours_required`, `min_gpa_required`, `start_date`, `end_date`, `internship_active`, `pay`) VALUES
(1, 1, 'PHP Programmer', '																																													Summer Internship Program developer required																																										', '5', '10', '3.0', '2015-03-31', '2015-05-31', '1', '9'),
(2, 2, 'Tester', 'Mysql														', '6', '20', '3.0', '2015-03-24', '2015-04-30', '1', '15'),
(4, NULL, 'cd', 'fd', 'd', 'dfs', 'dss', '0000-00-00', '0000-00-00', 'fsfds', 'ffds'),
(5, 3, 'php developer', '											internship for Java														', '3', '10', '3', '2015-04-23', '2015-04-30', '1', '4'),
(7, 7, '', '', '', '', '', '0000-00-00', '0000-00-00', '', ''),
(9, 1, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL),
(10, 1, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL),
(11, 1, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL),
(12, 1, NULL, NULL, NULL, NULL, '', NULL, NULL, '', NULL),
(13, 1, NULL, NULL, '3', NULL, '', NULL, NULL, '', NULL),
(16, 3, 'Programmer', '<p>Mysql programmer</p>\r\n', '3', '3', '3', '2015-04-15', '2015-04-24', '1', '5'),
(17, 6, 'PHP Programmer', '<p>PHP Programmer</p>\r\n', '3', '20', '3.0', '2015-04-14', '2015-04-30', '1', '15'),
(18, 4, 'PHP Programmer', '<p>PHP Programmer</p>\r\n', '6', '20', '3.0', '2015-04-16', '2015-04-30', '1', '15'),
(20, 3, 'Programmer', '															<p>Programmer for php</p>\r\n														', '3', '5', '3', '2015-04-24', '2015-04-30', '1', '6'),
(21, 5, 'PHP Developer', '<p><strong>PHP&nbsp;</strong></p>\r\n', '8', '10', '3.0', '2015-04-30', '2015-05-25', '1', '19');

-- --------------------------------------------------------

--
-- Table structure for table `internship_skill`
--

CREATE TABLE IF NOT EXISTS `internship_skill` (
  `internship_skill_id` int(10) NOT NULL AUTO_INCREMENT,
  `skill_id` int(10) NOT NULL,
  `internship_id` int(10) NOT NULL,
  `skill_level` varchar(5) NOT NULL,
  PRIMARY KEY (`internship_skill_id`),
  KEY `internship_id` (`internship_id`),
  KEY `skill_id` (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `login_id` int(10) NOT NULL AUTO_INCREMENT,
  `person_id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `lastlogin` datetime NOT NULL,
  PRIMARY KEY (`login_id`),
  UNIQUE KEY `username` (`username`),
  KEY `person_id` (`person_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `person_id`, `username`, `password`, `lastlogin`) VALUES
(1, 1, 'asaiyed', '9fe06b33ea459f011178ef3156ff09c7', '2015-04-27 13:48:50'),
(2, 2, 'pragya', 'd4dc86f22f862cfd6afbe8f412f9c956', '2015-04-28 05:40:33'),
(3, 3, 'advait', 'd4dc86f22f862cfd6afbe8f412f9c956', '2015-04-27 13:48:50'),
(4, 4, 'vamsi', '9fe06b33ea459f011178ef3156ff09c7', '2015-04-27 13:48:50'),
(5, 5, 'dharma', 'd4dc86f22f862cfd6afbe8f412f9c956', '2015-04-28 15:25:21'),
(6, 6, 'pradeep', '9fe06b33ea459f011178ef3156ff09c7', '2015-04-27 13:48:50'),
(7, 7, 'pink', '9fe06b33ea459f011178ef3156ff09c7', '2015-04-27 13:48:50'),
(10, 10, 'admin', '9fe06b33ea459f011178ef3156ff09c7', '2015-04-27 13:48:50'),
(22, 36, 'charlotte', '9fe06b33ea459f011178ef3156ff09c7', '2015-04-27 13:48:50'),
(23, 37, 'pragya_rai', 'd4dc86f22f862cfd6afbe8f412f9c956', '2015-04-28 14:38:04'),
(24, 38, 'prabhjbjh', '29a168891e01d00292451952685b784a', '2015-04-27 13:48:50'),
(25, 39, 'charlotte_rai', 'cdb4222dd1a4cdf00e5e6ed80adf895e', '2015-04-28 14:43:13'),
(26, 40, 'aa', '21ad0bd836b90d08f4cf640b4c298e7c', '2015-04-28 15:11:41'),
(27, 41, 'walter', '841d93525b9f0960ceaf38f4fdf22e2e', '2015-04-28 15:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `person_id` int(10) NOT NULL AUTO_INCREMENT,
  `person_type` enum('student','supervisor','admin') NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(30) NOT NULL,
  `address_line_1` varchar(40) NOT NULL,
  `address_line_2` varchar(40) NOT NULL,
  `city` varchar(32) NOT NULL,
  `state` char(2) NOT NULL,
  `country` char(3) NOT NULL,
  `zip_code` char(9) NOT NULL,
  `address_temp` varchar(60) NOT NULL,
  PRIMARY KEY (`person_id`),
  KEY `PIndex` (`last_name`,`first_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `person_type`, `first_name`, `middle_name`, `last_name`, `phone`, `email`, `address_line_1`, `address_line_2`, `city`, `state`, `country`, `zip_code`, `address_temp`) VALUES
(1, 'student', 'Azim', '', 'Saiyed', '9803499911', 'asaiyed@uncc.edu', '8765 ashford green', 'apt #123', 'charlotte', 'no', 'USA', '54672', ''),
(2, 'supervisor', 'Pragya123', '', 'Rai', '9819080421', 'pragya@gmail.com', 'ashford green', 'apt g', 'charlotte', 'no', 'USA', '28262', ''),
(3, 'student', 'Advait', '', 'Athavale', '9802672661', 'advait3@gmail.com', 'colonial grand ', 'apt M', 'raleigh', 'no', 'USA', '21716', ''),
(4, 'supervisor', 'vamsi', '', 'kakuru', '9802670519', 'vkakuru@uncc.edu', 'ut drive', 'apt 5409', 'phoenix', 'ar', 'USA', '91238', ''),
(5, 'admin', 'dharma', '', 'sajja', '9802670502', 'dsajja@uncc.edu', 'ut north', 'apt 12341', 'Cincinnati', 'Oh', 'USA', '64727', ''),
(6, 'admin', 'Pradeep', '', 'Billa', '9898998989', 'pbilla@uncc.edu', 'walden court', 'apt 283', 'Salisbury', 'No', 'USA', '12387', ''),
(7, 'student', 'ting', 'tong', 'tang', '777', 'tang@gmail.com', 'hh', 'cc', 'cxx', 'cv', ' xv', '332', 'fddsf'),
(10, 'admin', '', '', '', '', '', '', '', '', '', '', '', ''),
(34, 'supervisor', 'shruti', 'at', 'charlotte', '9819080421', 'pragya.rai00@gmail.com', '10005E graduate lane', 'wqwqw', 'sss', 'sa', 'sa', '28262', ''),
(35, 'student', 'shruti', 'at', 'charlotte', '9819080421', 'pragya.rai00@gmail.com', '10005E graduate lane', 'wqwqw', 'sss', 'sa', 'sa', '28262', ''),
(36, 'student', 'pragya', 'at', 'rathi', '2333', 'pragya.rai00@gmail.com', '10005E graduate lane', 'vfgfd', 'df', 'bj', 'bhh', '28262', ''),
(37, 'student', 'shruti', 'cd', 'charlotte', '9819080421', 'pragya.rai00@gmail.com', '10005E graduate lane', 'errer', 'charlotte', 'No', 'Uni', '28262', ''),
(38, 'supervisor', 'bjbj', 'jbjbj', 'bjbj', '9819080421', 'test@gygy.bbu', 'hjvhh', 'vhvhjvjh', 'bhbvhj', 'bh', 'bhb', '5576', ''),
(39, 'student', 'charlotte_rai', 'charlotte_rai', 'charlotte_rai', '0980 298 835', 'charlotte_rai00@gmail.com', '', '', '', '', '', '', ''),
(40, 'student', 'aa', 'bb', 'cc', '9819080421', 'aa@uncc.edu', '', '', '', '', '', '', ''),
(41, 'student', 'Walter', 'M', 'White', '9819080421', 'walter@uncc.edu', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `placements`
--

CREATE TABLE IF NOT EXISTS `placements` (
  `placement_id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` int(10) NOT NULL,
  `internship_id` int(10) NOT NULL,
  `internship_placed` enum('Y','N') NOT NULL DEFAULT 'N',
  `internship_complete` enum('Y','N') NOT NULL DEFAULT 'N',
  `actual_start_date` date NOT NULL,
  `actual_end_date` date NOT NULL,
  PRIMARY KEY (`placement_id`),
  KEY `student_id` (`student_id`),
  KEY `internship_id` (`internship_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `placements`
--

INSERT INTO `placements` (`placement_id`, `student_id`, `internship_id`, `internship_placed`, `internship_complete`, `actual_start_date`, `actual_end_date`) VALUES
(1, 1, 1, 'Y', 'Y', '2015-03-31', '2015-05-30'),
(2, 2, 2, 'Y', 'N', '2015-03-30', '2015-05-03'),
(9, 1, 5, 'Y', 'Y', '0000-00-00', '0000-00-00'),
(10, 7, 5, 'N', 'N', '0000-00-00', '0000-00-00'),
(11, 7, 1, 'N', 'N', '0000-00-00', '0000-00-00'),
(12, 1, 2, 'Y', 'N', '0000-00-00', '0000-00-00'),
(13, 1, 2, 'N', 'N', '0000-00-00', '0000-00-00'),
(14, 1, 2, 'N', 'N', '0000-00-00', '0000-00-00'),
(15, 1, 2, 'N', 'N', '0000-00-00', '0000-00-00'),
(16, 1, 2, 'N', 'N', '0000-00-00', '0000-00-00'),
(17, 7, 4, 'N', 'N', '0000-00-00', '0000-00-00'),
(18, 8, 1, 'N', 'N', '0000-00-00', '0000-00-00'),
(19, 8, 2, 'N', 'N', '0000-00-00', '0000-00-00'),
(20, 10, 1, 'N', 'N', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE IF NOT EXISTS `skill` (
  `skill_id` int(10) NOT NULL AUTO_INCREMENT,
  `skill_name` varchar(30) NOT NULL,
  `skill_description` text NOT NULL,
  `skill_level` int(11) NOT NULL,
  PRIMARY KEY (`skill_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`skill_id`, `skill_name`, `skill_description`, `skill_level`) VALUES
(1, 'PHP', 'PHP knowledge', 0),
(2, 'JAVA', 'Java knowledge\r\n', 0),
(3, 'MySql', 'Mysql knowledge', 0),
(4, 'jQuery', 'Jquery knowledge\r\n', 0),
(5, 'php developement', '<p>php development</p>\r\n', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(10) NOT NULL AUTO_INCREMENT,
  `person_id` int(10) NOT NULL,
  `major` varchar(15) DEFAULT NULL,
  `current_semester` varchar(15) DEFAULT NULL,
  `gpa` varchar(5) NOT NULL,
  PRIMARY KEY (`student_id`),
  KEY `person_id` (`person_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `person_id`, `major`, `current_semester`, `gpa`) VALUES
(1, 2, 'CS', '7', '3.0'),
(2, 3, 'IT', '6', '3.4'),
(4, 34, 'fr', '22', '2'),
(5, 35, 'fr', '22', '2'),
(6, 36, 'ccsdc', '76', '1'),
(7, 37, 'ccsdc', '7', '5'),
(8, 39, 'CS', '3', '2'),
(9, 40, 'CS', '9', '2'),
(10, 41, 'CS', '4', '3.0');

-- --------------------------------------------------------

--
-- Table structure for table `student_evaluation`
--

CREATE TABLE IF NOT EXISTS `student_evaluation` (
  `student_evaluation_id` int(10) NOT NULL AUTO_INCREMENT,
  `evaluation_id` int(10) NOT NULL,
  `performance` varchar(50) NOT NULL,
  `punctuality` varchar(50) NOT NULL,
  PRIMARY KEY (`student_evaluation_id`),
  KEY `evaluation_id` (`evaluation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `student_evaluation`
--

INSERT INTO `student_evaluation` (`student_evaluation_id`, `evaluation_id`, `performance`, `punctuality`) VALUES
(1, 1, 'A+', 'A'),
(2, 2, 'A', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `student_skill`
--

CREATE TABLE IF NOT EXISTS `student_skill` (
  `student_skill_id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` int(10) NOT NULL,
  `skill_id` int(10) NOT NULL,
  `skill_level` varchar(4) NOT NULL,
  PRIMARY KEY (`student_skill_id`),
  KEY `student_skill_ibfk_2` (`skill_id`),
  KEY `student_skill_ibfk_1` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `student_skill`
--

INSERT INTO `student_skill` (`student_skill_id`, `student_id`, `skill_id`, `skill_level`) VALUES
(1, 1, 1, '8'),
(2, 1, 2, '7'),
(3, 2, 3, '8'),
(4, 2, 4, '7'),
(5, 1, 2, '6'),
(6, 7, 3, '7'),
(7, 7, 4, '8>'),
(8, 7, 1, '8>'),
(9, 8, 5, '5');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE IF NOT EXISTS `supervisor` (
  `supervisor_id` int(10) NOT NULL AUTO_INCREMENT,
  `person_id` int(10) NOT NULL,
  `business_id` int(10) NOT NULL,
  PRIMARY KEY (`supervisor_id`),
  KEY `business_id` (`business_id`),
  KEY `person_id` (`supervisor_id`),
  KEY `person_id_2` (`person_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`supervisor_id`, `person_id`, `business_id`) VALUES
(1, 2, 1),
(2, 4, 2),
(3, 38, 1);

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_evaluation`
--

CREATE TABLE IF NOT EXISTS `supervisor_evaluation` (
  `supervisor_evaluation_id` int(10) NOT NULL AUTO_INCREMENT,
  `evaluation_id` int(10) NOT NULL,
  `technical_skills` varchar(50) NOT NULL,
  PRIMARY KEY (`supervisor_evaluation_id`),
  KEY `evaluation_id` (`evaluation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `supervisor_evaluation`
--

INSERT INTO `supervisor_evaluation` (`supervisor_evaluation_id`, `evaluation_id`, `technical_skills`) VALUES
(1, 1, 'A+'),
(2, 2, 'A');

-- --------------------------------------------------------

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`),
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `deparment` (`department_id`);

--
-- Constraints for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `evaluation_ibfk_1` FOREIGN KEY (`placement_id`) REFERENCES `placements` (`placement_id`);

--
-- Constraints for table `internship`
--
ALTER TABLE `internship`
  ADD CONSTRAINT `internship_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `business` (`business_id`);

--
-- Constraints for table `internship_skill`
--
ALTER TABLE `internship_skill`
  ADD CONSTRAINT `internship_skill_ibfk_1` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`skill_id`),
  ADD CONSTRAINT `internship_skill_ibfk_2` FOREIGN KEY (`internship_id`) REFERENCES `internship` (`internship_id`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `placements`
--
ALTER TABLE `placements`
  ADD CONSTRAINT `placements_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `placements_ibfk_2` FOREIGN KEY (`internship_id`) REFERENCES `internship` (`internship_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `student_evaluation`
--
ALTER TABLE `student_evaluation`
  ADD CONSTRAINT `student_evaluation_ibfk_1` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluation` (`evaluation_id`);

--
-- Constraints for table `student_skill`
--
ALTER TABLE `student_skill`
  ADD CONSTRAINT `student_skill_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `student_skill_ibfk_2` FOREIGN KEY (`skill_id`) REFERENCES `skill` (`skill_id`);

--
-- Constraints for table `supervisor`
--
ALTER TABLE `supervisor`
  ADD CONSTRAINT `supervisor_ibfk_1` FOREIGN KEY (`business_id`) REFERENCES `business` (`business_id`),
  ADD CONSTRAINT `supervisor_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `person` (`person_id`);

--
-- Constraints for table `supervisor_evaluation`
--
ALTER TABLE `supervisor_evaluation`
  ADD CONSTRAINT `supervisor_evaluation_ibfk_1` FOREIGN KEY (`evaluation_id`) REFERENCES `evaluation` (`evaluation_id`);


--
-- Structure for view `bus_internship`
--
DROP TABLE IF EXISTS `bus_internship`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bus_internship` AS select `i`.`internship_id` AS `internship_id`,`i`.`business_id` AS `business_id`,`i`.`job_title` AS `job_title`,`i`.`job_desc` AS `job_desc`,`i`.`semester` AS `semester`,`i`.`weekly_hours_required` AS `weekly_hours_required`,`i`.`min_gpa_required` AS `min_gpa_required`,`i`.`start_date` AS `start_date`,`i`.`end_date` AS `end_date`,`i`.`internship_active` AS `internship_active`,`i`.`pay` AS `pay`,`b`.`business_name` AS `business_name` from (`internship` `i` join `business` `b`) where (`i`.`business_id` = `b`.`business_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
