-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 18, 2019 at 07:37 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `omnicoder`
--

-- --------------------------------------------------------

--
-- Table structure for table `r1detail`
--

CREATE TABLE `r1detail` (
  `ip` varchar(16) NOT NULL,
  `marks` int(11) DEFAULT NULL,
  `username` varchar(10) DEFAULT NULL,
  `pwd` varchar(10) DEFAULT NULL,
  `submitTime` datetime DEFAULT NULL,
  `loginStatus` int(11) DEFAULT NULL,
  `selected` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r1detail`
--

INSERT INTO `r1detail` (`ip`, `marks`, `username`, `pwd`, `submitTime`, `loginStatus`, `selected`) VALUES
('10.42.0.148', 16, '100', 'STHSV', '2019-03-18 11:15:35', 0, 1),
('127.0.0.1', 4, '102', 'MUQAU', '2019-03-18 11:18:24', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `round2`
--

CREATE TABLE `round2` (
  `ip` varchar(18) DEFAULT NULL,
  `newip` varchar(18) NOT NULL,
  `submitStatus` int(11) DEFAULT NULL,
  `username` varchar(5) DEFAULT NULL,
  `submitTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `solution`
--

CREATE TABLE `solution` (
  `ip` varchar(20) NOT NULL,
  `q1` int(11) NOT NULL,
  `q2` int(11) NOT NULL,
  `q3` int(11) NOT NULL,
  `q4` int(11) NOT NULL,
  `q5` int(11) NOT NULL,
  `q6` int(11) NOT NULL,
  `q7` int(11) NOT NULL,
  `q8` int(11) NOT NULL,
  `q9` int(11) NOT NULL,
  `q10` int(11) NOT NULL,
  `q11` int(11) NOT NULL,
  `q12` int(11) NOT NULL,
  `q13` int(11) NOT NULL,
  `q14` int(11) NOT NULL,
  `q15` int(11) NOT NULL,
  `q16` int(11) NOT NULL,
  `q17` int(11) NOT NULL,
  `q18` int(11) NOT NULL,
  `q19` int(11) NOT NULL,
  `q20` int(11) NOT NULL,
  `submit` int(11) DEFAULT '0',
  `submitTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `solution`
--

INSERT INTO `solution` (`ip`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `q11`, `q12`, `q13`, `q14`, `q15`, `q16`, `q17`, `q18`, `q19`, `q20`, `submit`, `submitTime`) VALUES
('10.42.0.148', 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, '2019-03-18 11:15:35'),
('10.42.0.178', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2019-03-18 12:04:11'),
('127.0.0.1', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2019-03-18 11:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `ip` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `semester` varchar(20) NOT NULL,
  `college` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `language` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ip`, `name`, `course`, `semester`, `college`, `email`, `mobile`, `language`) VALUES
('10.42.0.148', 'Redmi', 'Android', '4', 'Xiomi', 'Redmi@xiami.com', '78890', NULL),
('10.42.0.178', 'Lenovo', 'Lenovo', '2', 'Lenovo', 'Lenovo', 'Lenovo', 'Php, python, c++, C, java'),
('127.0.0.1', 'local host', 'local host', '2', 'local host', 'local host', 'local host', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `r1detail`
--
ALTER TABLE `r1detail`
  ADD PRIMARY KEY (`ip`);

--
-- Indexes for table `round2`
--
ALTER TABLE `round2`
  ADD PRIMARY KEY (`newip`);

--
-- Indexes for table `solution`
--
ALTER TABLE `solution`
  ADD PRIMARY KEY (`ip`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ip`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
