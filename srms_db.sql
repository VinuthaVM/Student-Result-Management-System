-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2023 at 11:08 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', 'f925916e2754e5e03f75dd58a5733251', '2022-01-01 10:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `tblclasses`
--

CREATE TABLE `tblclasses` (
  `id` int(11) NOT NULL,
  `ClassName` varchar(80) DEFAULT NULL,
  `ClassNameNumeric` int(4) DEFAULT NULL,
  `Section` varchar(5) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclasses`
--

INSERT INTO `tblclasses` (`id`, `ClassName`, `ClassNameNumeric`, `Section`, `CreationDate`, `UpdationDate`) VALUES
(1, 'CSE', 1, 'A', '2022-01-01 10:30:57', '2022-01-01 10:30:57'),
(2, 'CSE', 2, 'A', '2022-01-01 10:30:57', '2022-01-01 10:30:57'),
(4, 'CSE', 3, 'A', '2022-01-01 10:30:57', '2022-01-01 10:30:57'),
(5, 'CSE', 4, 'A', '2022-01-01 10:30:57', '2022-01-01 10:30:57'),
(6, 'IT', 1, 'A', '2022-01-01 10:30:57', '2022-01-01 10:30:57'),
(7, 'ECE', 1, 'A', '2022-01-01 10:30:57', '2022-01-01 10:30:57'),
(8, 'MECH', 1, 'A', '2022-01-01 10:30:57', '2022-01-01 10:30:57'),
(9, 'EEE', 1, 'A', '2022-01-01 15:17:32', NULL),
(10, 'CSE', 1, 'B', '2023-05-23 13:20:53', NULL),
(11, 'CSE', 2, 'B', '2023-05-23 13:21:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblnotice`
--

CREATE TABLE `tblnotice` (
  `id` int(11) NOT NULL,
  `noticeTitle` varchar(255) DEFAULT NULL,
  `noticeDetails` mediumtext DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblnotice`
--

INSERT INTO `tblnotice` (`id`, `noticeTitle`, `noticeDetails`, `postingDate`) VALUES
(5, 'Anna University CEAP Counselling 2023 Registration Open for the GATE Category: Choice Filling From June 12 to June 14', 'Anna University has released the CEAP 2023 Counselling schedule for candidates who appeared for the GATE 2023 exam. The counselling process will be conducted on the official website @cfa.annauniv.edu/cfa. \r\n\r\nAnna University will conduct admission to PG courses such as MTech, MArch, MPlan, etc, based on either GATE or CEETA PG scores. CEETA PG Merit list has already been released and candidates can submit their preferences as per the courses they wish to pursue for the CEAP Counselling from June 12 to June 14, 2023, on the basis of a valid GATE score.\r\n\r\nOnly candidates who successfully completed the CEAP 2023 registration and verification process will be considered for inclusion in the merit list and can further exercise their choices in the CEAP Counseling process. The allocation of seats to candidates will be conducted solely through online counseling conducted by Anna University.', '2023-06-19 12:41:03'),
(6, 'CEETA PG 2023 Merit List Released', 'Anna University has published the merit list for Common Engineering Entrance Test and Admission (CEETA PG) 2023 today, June 12, 2023. The exam authority has prepared the merit list based on the qualified candidates\' results in the CEETA PG exam.\r\n\r\nCEETA PG is an entrance exam conducted at the state level once a year. Based on marks secured in the text, candidates will be granted admission to various M.E./ M.Tech/ M.Arch./ M. Plan degree programs at CEETA PG scores accepting colleges and universities.\r\n\r\nEarlier, the registration process for CEETA PG 2023 Counselling commenced online between May 10 and 31, 2023. The CEETA PG 2023 cut-off refers to the minimum marks candidates must achieve to pass the exam. \r\n\r\nCandidates who have successfully completed the CEETA PG 2023 registration and verification process will be included in the merit list. The allocation of seats to candidates will be done exclusively through online counselling by Anna University. ', '2023-06-19 12:51:40');

-- --------------------------------------------------------

--
-- Table structure for table `tblresult`
--

CREATE TABLE `tblresult` (
  `id` int(11) NOT NULL,
  `StudentId` int(11) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblresult`
--

INSERT INTO `tblresult` (`id`, `StudentId`, `ClassId`, `SubjectId`, `marks`, `PostingDate`, `UpdationDate`) VALUES
(22, 11, 1, 12, 90, '2023-06-19 13:03:39', NULL),
(23, 11, 1, 7, 74, '2023-06-19 13:03:39', NULL),
(24, 11, 1, 5, 72, '2023-06-19 13:03:39', NULL),
(25, 11, 1, 5, 80, '2023-06-19 13:03:39', NULL),
(26, 11, 1, 6, 83, '2023-06-19 13:03:39', NULL),
(27, 11, 1, 4, 76, '2023-06-19 13:03:39', NULL),
(28, 11, 1, 1, 95, '2023-06-19 13:03:40', NULL),
(29, 11, 1, 8, 85, '2023-06-19 13:03:40', NULL),
(30, 7, 1, 12, 60, '2023-06-19 13:04:46', NULL),
(31, 7, 1, 7, 67, '2023-06-19 13:04:46', NULL),
(32, 7, 1, 5, 56, '2023-06-19 13:04:46', NULL),
(33, 7, 1, 5, 51, '2023-06-19 13:04:46', NULL),
(34, 7, 1, 6, 45, '2023-06-19 13:04:46', NULL),
(35, 7, 1, 4, 42, '2023-06-19 13:04:46', NULL),
(36, 7, 1, 1, 59, '2023-06-19 13:04:47', NULL),
(37, 7, 1, 8, 58, '2023-06-19 13:04:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `StudentId` int(11) NOT NULL,
  `StudentName` varchar(100) DEFAULT NULL,
  `RollId` varchar(100) DEFAULT NULL,
  `StudentEmail` varchar(100) DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL,
  `Status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`StudentId`, `StudentName`, `RollId`, `StudentEmail`, `Gender`, `DOB`, `ClassId`, `RegDate`, `UpdationDate`, `Status`) VALUES
(1, 'Sarita', '23210', 'Sarita10@gmail.com', 'Female', '1995-03-03', 1, '2022-01-01 10:30:57', NULL, 1),
(7, 'Rahul', '23200', 'Rahul01@gmail.com', 'Male', '1999-06-02', 1, '2023-05-23 14:38:42', NULL, 1),
(8, 'Sasikala', '23201', 'Sasikala02@gmail.com', 'Female', '2000-03-18', 1, '2023-05-23 14:40:48', NULL, 1),
(9, 'Dhanush', '23202', 'Dhanush03@gmail.com', 'Male', '1998-05-03', 1, '2023-05-23 14:42:36', NULL, 1),
(10, 'Vikram', '23204', 'Vikram04@gmail.com', 'Male', '2000-07-19', 1, '2023-05-23 14:43:34', NULL, 1),
(11, 'Anitha', '23205', 'Anitha05@gmail.com', 'Female', '2000-10-10', 1, '2023-05-23 14:49:37', NULL, 1),
(12, 'Athiqul Rahman', '23206', 'Athiqul06@gmail.com', 'Male', '1999-07-08', 1, '2023-05-23 14:51:12', NULL, 1),
(13, 'Deva raj', '23207', 'Deva07@gmail.com', 'Male', '1998-05-19', 1, '2023-05-23 14:53:30', NULL, 1),
(14, 'Nirmala', '23208', 'Nirmala08@gmail.com', 'Female', '1998-06-23', 1, '2023-05-23 14:56:15', NULL, 1),
(15, 'Vinoth kumar', '23209', 'Vinothkumar09@gmail.com', 'Male', '2000-11-17', 1, '2023-05-23 14:57:23', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjectcombination`
--

CREATE TABLE `tblsubjectcombination` (
  `id` int(11) NOT NULL,
  `ClassId` int(11) DEFAULT NULL,
  `SubjectId` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `Updationdate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubjectcombination`
--

INSERT INTO `tblsubjectcombination` (`id`, `ClassId`, `SubjectId`, `status`, `CreationDate`, `Updationdate`) VALUES
(32, 1, 1, 1, '2023-05-23 14:29:32', NULL),
(33, 1, 2, 1, '2023-05-23 14:29:36', NULL),
(34, 1, 4, 1, '2023-05-23 14:29:41', NULL),
(35, 1, 5, 1, '2023-05-23 14:29:44', NULL),
(36, 1, 5, 0, '2023-05-23 14:29:49', '2023-06-19 12:55:28'),
(37, 1, 6, 1, '2023-05-23 14:29:54', NULL),
(38, 1, 7, 1, '2023-05-23 14:29:59', NULL),
(39, 1, 8, 1, '2023-05-23 14:30:04', NULL),
(40, 1, 12, 1, '2023-05-23 14:30:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects`
--

CREATE TABLE `tblsubjects` (
  `id` int(11) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `SubjectCode` varchar(100) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubjects`
--

INSERT INTO `tblsubjects` (`id`, `SubjectName`, `SubjectCode`, `Creationdate`, `UpdationDate`) VALUES
(1, 'Mathematics I', 'MA8151', '2022-01-01 10:30:57', '2023-05-23 13:45:47'),
(2, 'Technical English I', 'HS8151', '2022-01-01 10:30:57', NULL),
(4, 'Engineering Physics', 'PH8151', '2022-01-01 10:30:57', NULL),
(5, 'Engineering Chemistry', 'CY8151', '2022-01-01 10:30:57', NULL),
(6, 'Engineering Graphics', 'GE8152', '2022-01-01 10:30:57', NULL),
(7, 'Computing Techniques', 'GE8151', '2022-01-01 10:30:57', NULL),
(8, 'Physics Laboratory', 'PH8161', '2022-01-01 10:30:57', NULL),
(12, 'Chemistry Laboratory', 'CY8161', '2023-05-23 13:29:29', '2023-05-23 13:44:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblclasses`
--
ALTER TABLE `tblclasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblnotice`
--
ALTER TABLE `tblnotice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblresult`
--
ALTER TABLE `tblresult`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`StudentId`);

--
-- Indexes for table `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblclasses`
--
ALTER TABLE `tblclasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblnotice`
--
ALTER TABLE `tblnotice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblresult`
--
ALTER TABLE `tblresult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `StudentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblsubjectcombination`
--
ALTER TABLE `tblsubjectcombination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
