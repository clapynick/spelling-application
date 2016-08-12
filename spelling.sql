-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2016 at 02:07 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spelling`
--

-- --------------------------------------------------------

--
-- Table structure for table `codegen`
--

CREATE TABLE `codegen` (
  `intGenCode` int(6) NOT NULL COMMENT 'Field that holds the most current code for signing up'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Table specifically for sign up code generation';

-- --------------------------------------------------------

--
-- Table structure for table `quizdetails`
--

CREATE TABLE `quizdetails` (
  `intQuizID` int(5) NOT NULL,
  `strQuizName` varchar(85) NOT NULL,
  `strTeachersName` varchar(100) NOT NULL,
  `strQuestion1_r` varchar(28) NOT NULL,
  `strQuestion1_w1` varchar(50) NOT NULL,
  `strQuestion1_w2` varchar(50) NOT NULL,
  `strQuestion2_r` varchar(28) NOT NULL,
  `strQuestion2_w1` varchar(50) NOT NULL,
  `strQuestion2_w2` varchar(50) NOT NULL,
  `strQuestion3_r` varchar(28) NOT NULL,
  `strQuestion3_w1` varchar(50) NOT NULL,
  `strQuestion3_w2` varchar(50) NOT NULL,
  `strQuestion4_r` varchar(28) NOT NULL,
  `strQuestion4_w1` varchar(50) NOT NULL,
  `strQuestion4_w2` varchar(50) NOT NULL,
  `strQuestion5_r` varchar(28) NOT NULL,
  `strQuestion5_w1` varchar(50) NOT NULL,
  `strQuestion5_w2` varchar(50) NOT NULL,
  `strQuestion6_r` varchar(28) NOT NULL,
  `strQuestion6_w1` varchar(50) NOT NULL,
  `strQuestion6_w2` varchar(50) NOT NULL,
  `strQuestion7_r` varchar(28) NOT NULL,
  `strQuestion7_w1` varchar(50) NOT NULL,
  `strQuestion7_w2` varchar(50) NOT NULL,
  `strQuestion8_r` varchar(28) NOT NULL,
  `strQuestion8_w1` varchar(50) NOT NULL,
  `strQuestion8_w2` varchar(50) NOT NULL,
  `strQuestion9_r` varchar(28) NOT NULL,
  `strQuestion9_w1` varchar(50) NOT NULL,
  `strQuestion9_w2` varchar(50) NOT NULL,
  `strQuestion10_r` varchar(28) NOT NULL,
  `strQuestion10_w1` varchar(50) NOT NULL,
  `strQuestion10_w2` varchar(50) NOT NULL,
  `strQuestion11_r` varchar(28) NOT NULL,
  `strQuestion11_w1` varchar(50) NOT NULL,
  `strQuestion11_w2` varchar(50) NOT NULL,
  `strQuestion12_r` varchar(28) NOT NULL,
  `strQuestion12_w1` varchar(50) NOT NULL,
  `strQuestion12_w2` varchar(50) NOT NULL,
  `strQuestion13_r` varchar(28) NOT NULL,
  `strQuestion13_w1` varchar(50) NOT NULL,
  `strQuestion13_w2` varchar(50) NOT NULL,
  `strQuestion14_r` varchar(28) NOT NULL,
  `strQuestion14_w1` varchar(50) NOT NULL,
  `strQuestion14_w2` varchar(50) NOT NULL,
  `strQuestion15_r` varchar(28) NOT NULL,
  `strQuestion15_w1` varchar(50) NOT NULL,
  `strQuestion15_w2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `intUserID` int(4) NOT NULL COMMENT 'Unique Identifier for a User',
  `strUserName` varchar(8) NOT NULL,
  `strPass` varchar(16) NOT NULL,
  `strAccountType` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Basic User Details Required for other tables';

-- --------------------------------------------------------

--
-- Table structure for table `userquizzes`
--

CREATE TABLE `userquizzes` (
  `intUserID` int(4) NOT NULL,
  `intQuizID` int(5) NOT NULL,
  `strQuizName` varchar(85) NOT NULL,
  `intQuestion1` int(1) NOT NULL,
  `intQuestion2` int(11) NOT NULL,
  `intQuestion3` int(1) NOT NULL,
  `intQuestion4` int(1) NOT NULL,
  `intQuestion5` int(1) NOT NULL,
  `intQuestion6` int(1) NOT NULL,
  `intQuestion7` int(1) NOT NULL,
  `intQuestion8` int(1) NOT NULL,
  `intQuestion9` int(1) NOT NULL,
  `intQuestion10` int(1) NOT NULL,
  `intQuestion11` int(1) NOT NULL,
  `intQuestion12` int(1) NOT NULL,
  `intQuestion13` int(1) NOT NULL,
  `intQuestion14` int(1) NOT NULL,
  `intQuestion15` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Results related to the user for each quiz will be stored he.';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `codegen`
--
ALTER TABLE `codegen`
  ADD PRIMARY KEY (`intGenCode`);

--
-- Indexes for table `quizdetails`
--
ALTER TABLE `quizdetails`
  ADD PRIMARY KEY (`intQuizID`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`intUserID`);

--
-- Indexes for table `userquizzes`
--
ALTER TABLE `userquizzes`
  ADD PRIMARY KEY (`intUserID`,`intQuizID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
