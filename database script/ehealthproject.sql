-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2015 at 10:47 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ehealthproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `command`
--

CREATE TABLE IF NOT EXISTS `command` (
  `commandID` int(11) NOT NULL,
  `radiologistID` int(11) DEFAULT NULL,
  `patientID` int(11) NOT NULL,
  `Issued` date DEFAULT NULL,
  `Issued_by` varchar(1024) DEFAULT NULL,
  `Reason` varchar(1024) DEFAULT NULL,
  `Execute_by` date DEFAULT NULL,
  `Current_State` varchar(1024) DEFAULT NULL,
  `Recommended` date DEFAULT NULL,
  `Emergency_State` varchar(1024) DEFAULT NULL,
  `Type` varchar(1024) DEFAULT NULL,
  `Execute_Time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `command`
--

INSERT INTO `command` (`commandID`, `radiologistID`, `patientID`, `Issued`, `Issued_by`, `Reason`, `Execute_by`, `Current_State`, `Recommended`, `Emergency_State`, `Type`, `Execute_Time`) VALUES
(1, NULL, 1, '2015-05-20', 'Maria Siapera', 'Broken leg', NULL, 'pending', '2015-05-25', 'no', 'MRI', NULL),
(2, 4, 2, '2015-05-20', 'Maria Siapera', 'Broken leg', '2015-05-06', 'done', '2015-05-25', 'yes', 'MRI', '18:07:00'),
(3, NULL, 3, '2015-05-20', 'Maria Siapera', 'Broken leg', NULL, 'pending', '2015-05-25', 'no', 'MRI', NULL),
(4, 3, 4, '2015-05-20', 'Maria Siapera', 'Broken leg', '2015-06-12', 'done', '2015-05-25', 'yes', 'MRI', '12:54:00'),
(5, NULL, 5, '2015-05-20', 'Maria Siapera', 'Broken leg', NULL, 'pending', '2015-05-25', 'yes', 'Bone Scan', NULL),
(6, NULL, 6, '2015-05-20', 'Maria Siapera', 'Broken leg', NULL, 'pending', '2015-05-25', 'no', 'XRAY', NULL),
(7, NULL, 7, '2015-05-20', 'Maria Siapera', 'Broken leg', NULL, 'pending', '2015-05-25', 'no', 'XRAY', NULL),
(8, NULL, 8, '2015-05-20', 'Konstantinos Doul', 'Broken leg', NULL, 'pending', '2015-05-25', 'no', 'XRAY', NULL),
(9, NULL, 9, '2015-05-20', 'Konstantinos Doul', 'Broken leg', NULL, 'pending', '2015-05-25', 'yes', 'XRAY', NULL),
(10, NULL, 10, '2015-05-20', 'Konstantinos Doul', 'Broken leg', NULL, 'pending', '2015-05-25', 'no', 'Bone Scan', NULL),
(11, NULL, 11, '2015-05-20', 'Konstantinos Doul', 'Broken leg', NULL, 'pending', '2015-05-25', 'yes', 'Ultrasound', NULL),
(12, NULL, 12, '2015-05-20', 'Konstantinos Doul', 'Broken leg', NULL, 'pending', '2015-05-25', 'yes', 'Ultrasound', NULL),
(13, NULL, 20, '2015-06-14', 'Dr. Maria Siapera', 'Broken Leg', NULL, 'pending', '2015-06-25', 'no', 'MRI', NULL),
(14, 2, 25, '2015-06-15', 'Dr. Maria Siapera', 'Broken Leg', '2015-06-17', 'done', '2015-06-17', 'no', 'Bone Scan', '09:00:00'),
(15, NULL, 15, '2015-06-15', 'Dr. Konstantinos Doul', 'There is a problem. ', NULL, 'pending', '2015-06-24', 'yes', 'X-Ray', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `actualName` varchar(40) NOT NULL,
  `userName` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`actualName`, `userName`, `pass`) VALUES
('Konstantinos Doul', 'kdoul', '1234'),
('Maria Siapera', 'mariaspr', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `patientID` int(11) NOT NULL,
  `commandID` int(11) DEFAULT NULL,
  `pName` varchar(1024) DEFAULT NULL,
  `pSurname` varchar(1024) DEFAULT NULL,
  `Address` varchar(1024) DEFAULT NULL,
  `Work_phone` int(11) DEFAULT NULL,
  `Home_phone` int(11) DEFAULT NULL,
  `Cell_phone` int(11) DEFAULT NULL,
  `Date_of_birth` date DEFAULT NULL,
  `SSN` int(11) DEFAULT NULL,
  `Mother_name` varchar(1024) DEFAULT NULL,
  `Father_name` varchar(1024) DEFAULT NULL,
  `Sex` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientID`, `commandID`, `pName`, `pSurname`, `Address`, `Work_phone`, `Home_phone`, `Cell_phone`, `Date_of_birth`, `SSN`, `Mother_name`, `Father_name`, `Sex`) VALUES
(1, 1, 'Nona', 'Nanoy', 'Test 21', 34523476, 563456345, 23345347, '1948-03-13', 65364566, 'Nana', 'Dada', 0),
(2, 2, 'Nona', 'Nanoy', 'Test 21', 34523476, 563456345, 23345347, '1998-03-13', 65364566, 'Nana', 'Dada', 0),
(3, 3, 'Nona', 'Nanoy', 'Test 21', 34523476, 563456345, 23345347, '1960-01-03', 65364566, 'Nana', 'Dada', 0),
(4, 4, 'Nona', 'Nanoy', 'Test 21', 34523476, 563456345, 23345347, '1960-01-03', 65364566, 'Nana', 'Dada', 0),
(5, 5, 'Nona', 'Nanoy', 'Test 21', 34523476, 563456345, 23345347, '1960-01-03', 65364566, 'Nana', 'Dada', 1),
(6, 6, 'Nona', 'Nanoy', 'Test 21', 34523476, 563456345, 23345347, '1960-01-03', 65364566, 'Nana', 'Dada', 1),
(7, 7, 'Nona', 'Nanoy', 'Test 21', 34523476, 563456345, 23345347, '1960-01-03', 65364566, 'Nana', 'Dada', 1),
(8, 8, 'Nona', 'Nanoy', 'Test 21', 34523476, 563456345, 23345347, '1960-01-03', 65364566, 'Nana', 'Dada', 1),
(9, 9, 'Nona', 'Nanoy', 'Test 21', 34523476, 563456345, 23345347, '1960-01-03', 65364566, 'Nana', 'Dada', 0),
(10, 10, 'Nona', 'Nanoy', 'Test 21', 34523476, 563456345, 23345347, '1960-01-03', 65364566, 'Nana', 'Dada', 0),
(11, 11, 'Nona', 'Nanoy', 'Test 21', 34523476, 563456345, 23345347, '1960-01-03', 65364566, 'Nana', 'Dada', 0),
(12, 12, 'Nona', 'Nanoy', 'Test 21', 34523476, 563456345, 23345347, '1960-01-03', 65364566, 'Nana', 'Dada', 0),
(15, NULL, 'Dukaki', 'Duk', 'Dillo 9', 33333333, 53453254, 23552344, '1970-04-08', 12345, 'Kyriakh', 'Pasxalis', 1),
(20, NULL, 'George', 'Georginis', 'King of street 20', 2147483647, 2100909090, 2147483647, '2013-04-02', 1235, 'Eva', 'Alex', 1),
(25, NULL, 'Regina', 'Lane', 'Storybrooke 12 Street', 2107689890, 2105673456, 2147483647, '1999-05-13', 2000, 'Jane', 'John', 0);

-- --------------------------------------------------------

--
-- Table structure for table `radiologist`
--

CREATE TABLE IF NOT EXISTS `radiologist` (
  `radiologistID` int(11) NOT NULL,
  `rName` varchar(1024) DEFAULT NULL,
  `rSurname` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `radiologist`
--

INSERT INTO `radiologist` (`radiologistID`, `rName`, `rSurname`) VALUES
(1, 'Niarxos', 'Burxos'),
(2, 'Rumple', 'Gold'),
(3, 'Regina', 'Mills'),
(4, 'Emma', 'Swan'),
(5, 'Henry', 'Mill');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `command`
--
ALTER TABLE `command`
  ADD PRIMARY KEY (`commandID`), ADD KEY `FK_executes` (`radiologistID`), ADD KEY `FK_has` (`patientID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`userName`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patientID`), ADD KEY `FK_has2` (`commandID`);

--
-- Indexes for table `radiologist`
--
ALTER TABLE `radiologist`
  ADD PRIMARY KEY (`radiologistID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `command`
--
ALTER TABLE `command`
ADD CONSTRAINT `FK_executes` FOREIGN KEY (`radiologistID`) REFERENCES `radiologist` (`radiologistID`),
ADD CONSTRAINT `FK_has` FOREIGN KEY (`patientID`) REFERENCES `patient` (`patientID`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
ADD CONSTRAINT `FK_has2` FOREIGN KEY (`commandID`) REFERENCES `command` (`commandID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
