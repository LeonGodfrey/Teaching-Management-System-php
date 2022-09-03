-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2021 at 09:40 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teachingms`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseId` int(11) NOT NULL,
  `courseName` varchar(60) NOT NULL,
  `courseCode` varchar(10) NOT NULL,
  `creditUnits` varchar(10) NOT NULL,
  `program` varchar(60) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `yearOfStudy` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseId`, `courseName`, `courseCode`, `creditUnits`, `program`, `semester`, `yearOfStudy`) VALUES
(2, 'Research methodology', 'IST1201', '4', 'BIST', '2', '2'),
(3, 'Web systems and technologies 2', 'IST1202', '4', 'BIST', '2', '2'),
(4, 'System Administration', 'IST2203', '4', 'BIST', '2', '2'),
(5, 'IST Project management ', 'CSC1204', '4', 'BIST', '2', '2'),
(6, 'Electronic services', 'IST1205', '4', 'BIST', '2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `lectureId` int(11) NOT NULL,
  `lectureDay` varchar(50) DEFAULT NULL,
  `plannedStartTime` time DEFAULT NULL,
  `plannedEndTime` time DEFAULT NULL,
  `courseId` int(11) DEFAULT NULL,
  `personId` int(11) DEFAULT NULL,
  `roomId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`lectureId`, `lectureDay`, `plannedStartTime`, `plannedEndTime`, `courseId`, `personId`, `roomId`) VALUES
(10, 'Monday', '08:00:00', '10:00:00', 4, 15, 2),
(11, 'Monday', '14:00:00', '15:00:00', 2, 17, 16),
(12, 'Tuesday', '08:00:00', '10:00:00', 4, 15, 12),
(13, 'Tuesday', '08:00:00', '11:00:00', 2, 17, 3),
(14, 'Tuesday', '11:00:00', '13:00:00', 3, 19, 4),
(15, 'Tuesday', '11:00:00', '13:00:00', 6, 18, 3),
(16, 'Tuesday', '14:00:00', '17:00:00', 2, 17, 12),
(17, 'Tuesday', '15:00:00', '17:00:00', 3, 19, 2),
(18, 'Wednesday', '08:00:00', '09:00:00', 2, 17, 2),
(19, 'Wednesday', '08:00:00', '10:00:00', 5, 20, 6),
(20, 'Wednesday', '11:00:00', '13:00:00', 3, 19, 2),
(21, 'Wednesday', '14:00:00', '16:00:00', 6, 18, 9),
(22, 'Wednesday', '15:00:00', '17:00:00', 5, 20, 2),
(23, 'Thursday', '08:00:00', '10:00:00', 4, 15, 3),
(24, 'Thursday', '11:00:00', '13:00:00', 3, 19, 3),
(25, 'Thursday', '11:00:00', '13:00:00', 6, 18, 9),
(26, 'Thursday', '14:00:00', '16:00:00', 4, 15, 16),
(27, 'Thursday', '14:00:00', '16:00:00', 6, 18, 2),
(28, 'Friday', '09:00:00', '11:00:00', 5, 20, 4),
(29, 'Friday', '11:00:00', '13:00:00', 5, 20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `personId` int(11) NOT NULL,
  `personName` varchar(200) NOT NULL,
  `personEmail` varchar(250) NOT NULL,
  `personGender` enum('M','F') NOT NULL,
  `personNIN` varchar(15) DEFAULT NULL,
  `personPassword` varchar(60) NOT NULL,
  `personPhoto` varchar(250) DEFAULT NULL,
  `personRole` enum('lecturer','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`personId`, `personName`, `personEmail`, `personGender`, `personNIN`, `personPassword`, `personPhoto`, `personRole`) VALUES
(1, 'Ssegawa Godfrey', 'ssegodfrey171@gmail.com', 'M', 'cmk1234q124', '1844156d4166d94387f1a4ad031ca5fa', 'ssegawa.png', 'admin'),
(15, 'Haleem Chongomweru', 'haleem@gmail.com', 'M', 'CMK1226ATPC', '36f194377fdf8110585db9def9bb79f2', '../uploads/person3.jpg', 'lecturer'),
(17, 'Ruth Mbabazi Mutebi', 'ruth@gmail.com', 'F', 'CFK1226ATPC', '36f194377fdf8110585db9def9bb79f2', '../uploads/person6.jpg', 'lecturer'),
(18, 'Evelyne Asio Kalenzi', 'asio@gmail.com', 'F', 'CFK1226APIN', '36f194377fdf8110585db9def9bb79f2', '../uploads/person4.jpg', 'lecturer'),
(19, 'Albert George Bitwire', 'bitwire@gmail.com', 'M', 'CMK1226APIK', '36f194377fdf8110585db9def9bb79f2', '../uploads/person7.jpg', 'lecturer'),
(20, 'Henry Serugunda', 'henry@gmail.com', 'M', 'CMK1226AINK', '36f194377fdf8110585db9def9bb79f2', '../uploads/person5.jpg', 'lecturer');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomId` int(11) NOT NULL,
  `roomName` varchar(20) DEFAULT NULL,
  `block` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomId`, `roomName`, `block`, `level`) VALUES
(2, 'LLT 1A', 'B', 'level 1'),
(3, 'LLT 1B', 'B', 'level 1'),
(4, 'LLT 2A', 'B', 'level 2'),
(6, 'LLT 2B', 'B', 'level 2'),
(7, 'LLT 3A', 'B', 'level 3'),
(8, 'LLT 3B', 'B', 'level 3'),
(9, 'LLT 4A', 'B', 'level 4'),
(10, 'LLT 4B', 'B', 'level 4'),
(12, 'LLT 5A', 'B', 'level 5'),
(13, 'LLT 5B', 'B', 'level 5'),
(16, 'LLT 6A', 'B', 'level 6'),
(17, 'LLT 6B', 'B', 'level 6');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semesterId` int(11) NOT NULL,
  `semesterDetail` enum('FIRST','SECOND') NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semesterId`, `semesterDetail`, `startDate`, `endDate`) VALUES
(3, 'FIRST', '2021-09-27', '2021-12-24');

-- --------------------------------------------------------

--
-- Table structure for table `taught`
--

CREATE TABLE `taught` (
  `taughtId` int(11) NOT NULL,
  `dateTaught` date DEFAULT NULL,
  `dayTaught` varchar(20) DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `week` int(11) DEFAULT NULL,
  `lectureId` int(11) DEFAULT NULL,
  `personId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `taught`
--

INSERT INTO `taught` (`taughtId`, `dateTaught`, `dayTaught`, `startTime`, `endTime`, `week`, `lectureId`, `personId`) VALUES
(14, '2021-11-25', 'Thursday', '14:36:00', '14:36:00', 9, NULL, 15),
(15, '2021-11-26', 'Friday', '08:33:00', '08:33:00', 9, NULL, 15),
(16, '2021-12-07', 'Tuesday', '09:06:00', '09:07:00', 12, 13, 17),
(17, '2021-12-07', 'Tuesday', '09:07:00', '09:07:00', 12, 16, 17),
(18, '2021-12-07', 'Tuesday', '09:07:00', NULL, 12, 13, 17),
(19, '2021-12-07', 'Tuesday', '09:07:00', NULL, 12, 13, 17),
(20, '2021-12-07', 'Tuesday', '09:33:00', NULL, 12, 13, 17),
(21, '2021-12-07', 'Tuesday', '12:13:00', NULL, 12, 13, 17),
(22, '2021-12-08', 'Wednesday', '07:56:00', '11:28:00', 12, 18, 17),
(23, '2021-12-08', 'Wednesday', '08:41:00', NULL, 12, 18, 17),
(24, '2021-12-08', 'Wednesday', '08:44:00', NULL, 12, 18, 17),
(25, '2021-12-08', 'Wednesday', '08:44:00', NULL, 12, 18, 17),
(26, '2021-12-08', 'Wednesday', '09:05:00', NULL, 12, 18, 17),
(27, '2021-12-08', 'Wednesday', '09:05:00', NULL, 12, 18, 17),
(28, '2021-12-08', 'Wednesday', '09:05:00', NULL, 12, 18, 17),
(29, '2021-12-08', 'Wednesday', '09:16:00', NULL, 12, 18, 17),
(30, '2021-12-08', 'Wednesday', '09:16:00', NULL, 12, 18, 17),
(31, '2021-12-08', 'Wednesday', '09:20:00', NULL, 12, 18, 17),
(32, '2021-12-08', 'Wednesday', '09:20:00', NULL, 12, 18, 17),
(33, '2021-12-08', 'Wednesday', '09:20:00', NULL, 12, 18, 17),
(34, '2021-12-08', 'Wednesday', '09:28:00', NULL, 12, 18, 17),
(35, '2021-12-08', 'Wednesday', '09:28:00', NULL, 12, 18, 17),
(36, '2021-12-08', 'Wednesday', '09:28:00', NULL, 12, 18, 17),
(37, '2021-12-08', 'Wednesday', '09:28:00', NULL, 12, 18, 17),
(38, '2021-12-08', 'Wednesday', '09:30:00', NULL, 12, 18, 17),
(39, '2021-12-08', 'Wednesday', '09:30:00', NULL, 12, 18, 17),
(40, '2021-12-08', 'Wednesday', '09:30:00', NULL, 12, 18, 17),
(41, '2021-12-08', 'Wednesday', '09:34:00', NULL, 12, 18, 17),
(42, '2021-12-08', 'Wednesday', '09:34:00', NULL, 12, 18, 17),
(43, '2021-12-08', 'Wednesday', '09:34:00', NULL, 12, 18, 17),
(44, '2021-12-08', 'Wednesday', '09:34:00', NULL, 12, 18, 17),
(45, '2021-12-08', 'Wednesday', '09:35:00', NULL, 12, 18, 17),
(46, '2021-12-08', 'Wednesday', '09:35:00', NULL, 12, 18, 17),
(47, '2021-12-08', 'Wednesday', '09:42:00', NULL, 12, 18, 17),
(48, '2021-12-08', 'Wednesday', '09:42:00', NULL, 12, 18, 17),
(49, '2021-12-08', 'Wednesday', '09:42:00', NULL, 12, 18, 17),
(50, '2021-12-08', 'Wednesday', '09:45:00', NULL, 12, 18, 17),
(51, '2021-12-08', 'Wednesday', '09:45:00', NULL, 12, 18, 17),
(52, '2021-12-08', 'Wednesday', '09:45:00', NULL, 12, 18, 17),
(53, '2021-12-08', 'Wednesday', '09:46:00', NULL, 12, 18, 17),
(54, '2021-12-08', 'Wednesday', '09:46:00', NULL, 12, 18, 17),
(55, '2021-12-08', 'Wednesday', '09:46:00', NULL, 12, 18, 17),
(56, '2021-12-08', 'Wednesday', '09:46:00', NULL, 12, 18, 17),
(57, '2021-12-08', 'Wednesday', '09:46:00', NULL, 12, 18, 17),
(58, '2021-12-08', 'Wednesday', '09:46:00', NULL, 12, 18, 17),
(59, '2021-12-08', 'Wednesday', '09:46:00', NULL, 12, 18, 17),
(60, '2021-12-08', 'Wednesday', '09:46:00', NULL, 12, 18, 17),
(61, '2021-12-08', 'Wednesday', '09:47:00', NULL, 12, 18, 17),
(62, '2021-12-08', 'Wednesday', '09:47:00', NULL, 12, 18, 17),
(63, '2021-12-08', 'Wednesday', '09:47:00', NULL, 12, 18, 17),
(64, '2021-12-08', 'Wednesday', '09:48:00', NULL, 12, 18, 17),
(65, '2021-12-08', 'Wednesday', '09:48:00', NULL, 12, 18, 17),
(66, '2021-12-08', 'Wednesday', '09:58:00', NULL, 12, 18, 17),
(67, '2021-12-08', 'Wednesday', '10:01:00', NULL, 12, 18, 17),
(68, '2021-12-08', 'Wednesday', '10:37:00', NULL, 12, 18, 17),
(69, '2021-12-08', 'Wednesday', '10:39:00', NULL, 12, 18, 17),
(70, '2021-12-08', 'Wednesday', '10:39:00', NULL, 12, 18, 17),
(71, '2021-12-08', 'Wednesday', '10:39:00', NULL, 12, 18, 17),
(72, '2021-12-08', 'Wednesday', '10:39:00', NULL, 12, 18, 17),
(73, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(74, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(75, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(76, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(77, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(78, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(79, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(80, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(81, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(82, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(83, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(84, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(85, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(86, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(87, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(88, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(89, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(90, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(91, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(92, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(93, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(94, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(95, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(96, '2021-12-08', 'Wednesday', '10:40:00', NULL, 12, 18, 17),
(97, '2021-12-08', 'Wednesday', '10:42:00', NULL, 12, 18, 17),
(98, '2021-12-08', 'Wednesday', '10:46:00', NULL, 12, 18, 17),
(99, '2021-12-08', 'Wednesday', '10:46:00', NULL, 12, 18, 17),
(100, '2021-12-08', 'Wednesday', '10:46:00', NULL, 12, 18, 17),
(101, '2021-12-08', 'Wednesday', '10:46:00', NULL, 12, 18, 17),
(102, '2021-12-08', 'Wednesday', '10:46:00', NULL, 12, 18, 17),
(103, '2021-12-08', 'Wednesday', '10:46:00', NULL, 12, 18, 17),
(104, '2021-12-08', 'Wednesday', '10:46:00', NULL, 12, 18, 17),
(105, '2021-12-08', 'Wednesday', '10:46:00', NULL, 12, 18, 17),
(106, '2021-12-08', 'Wednesday', '11:23:00', NULL, 12, 18, 17),
(107, '2021-12-08', 'Wednesday', '11:28:00', NULL, 12, 18, 17),
(108, '2021-12-08', 'Wednesday', '11:28:00', NULL, 12, 18, 17);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseId`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`lectureId`),
  ADD KEY `roomId` (`roomId`),
  ADD KEY `personId` (`personId`),
  ADD KEY `courseId` (`courseId`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`personId`),
  ADD UNIQUE KEY `personEmail` (`personEmail`),
  ADD UNIQUE KEY `personNIN` (`personNIN`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomId`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semesterId`);

--
-- Indexes for table `taught`
--
ALTER TABLE `taught`
  ADD PRIMARY KEY (`taughtId`),
  ADD KEY `taught_ibfk_1` (`lectureId`),
  ADD KEY `personId` (`personId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `lecture`
--
ALTER TABLE `lecture`
  MODIFY `lectureId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `personId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `roomId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semesterId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `taught`
--
ALTER TABLE `taught`
  MODIFY `taughtId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lecture`
--
ALTER TABLE `lecture`
  ADD CONSTRAINT `lecture_ibfk_1` FOREIGN KEY (`roomId`) REFERENCES `room` (`roomId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `lecture_ibfk_2` FOREIGN KEY (`personId`) REFERENCES `person` (`personId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `lecture_ibfk_3` FOREIGN KEY (`courseId`) REFERENCES `course` (`courseId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `taught`
--
ALTER TABLE `taught`
  ADD CONSTRAINT `taught_ibfk_1` FOREIGN KEY (`lectureId`) REFERENCES `lecture` (`lectureId`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `taught_ibfk_2` FOREIGN KEY (`personId`) REFERENCES `person` (`personId`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
