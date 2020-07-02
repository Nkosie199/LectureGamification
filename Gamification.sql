-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2017 at 02:39 PM
-- Server version: 5.6.36
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Gamification`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `date` date NOT NULL,
  `studentid` varchar(9) NOT NULL,
  `course` varchar(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='register to keep track of student attendance';

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `coursecode` varchar(8) NOT NULL,
  `lecturerid` varchar(9) NOT NULL,
  `courseinfo` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table used to store course-specific information';

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`coursecode`, `lecturerid`, `courseinfo`) VALUES
('CSC2003S', 'memem009', 'Welcome'),
('CSC3004F', '368201863', 'Welcome to this course. You will have a hectic time passing here fam. Good luck with that!\r\n\r\nKind regards,\r\nLecturer'),
('EEE0764S', '082937483', 'Hello all.\r\nHope you enjoy this course guys!');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `groupname` varchar(50) NOT NULL,
  `groupavatar` varchar(255) DEFAULT NULL,
  `course` varchar(8) NOT NULL,
  `points` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupname`, `groupavatar`, `course`, `points`) VALUES
('Alchemist', NULL, 'CSC3003S', 400),
('Aviators', NULL, 'CSC3003S', 260),
('Chiefs', NULL, 'CSC3003S', 180);

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE IF NOT EXISTS `lecturers` (
  `lecturerid` varchar(9) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `coursecode` varchar(8) NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table used to store the information of lecturers';

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE IF NOT EXISTS `quizzes` (
  `quizname` varchar(100) NOT NULL,
  `dateset` date NOT NULL,
  `course` varchar(8) NOT NULL,
  `lecturerid` varchar(9) NOT NULL,
  `question` varchar(255) NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table used to store the quizzes set by the lecturer';

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `studentid` varchar(9) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `coursecode` varchar(8) NOT NULL,
  `group` varchar(50) NOT NULL,
  `rank` varchar(50) NOT NULL,
  `xp` int(11) NOT NULL,
  `ap` int(11) NOT NULL,
  `sp` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table used to store the information of students';

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentid`, `firstname`, `surname`, `password`, `coursecode`, `group`, `rank`, `xp`, `ap`, `sp`, `picture`) VALUES
('ARRDJA001', 'Djavan', 'Arrigone', 'djavan', 'CSC3003S', 'Alchemist', '3', 210, 200, 10, NULL),
('GMDNKO003', 'Nkosi', 'Gumede', 'nkosi', 'CSC3003S', 'Alchemist', '1', 70, 30, 40, NULL),
('SJSORE001', 'Oreneile', 'Sejesho', 'oreneile', 'CSC3003S', 'Alchemist', '2', 150, 100, 50, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
