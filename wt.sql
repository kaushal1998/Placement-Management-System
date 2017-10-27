-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2017 at 10:19 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wt`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` bigint(20) NOT NULL,
  `registrationId` text NOT NULL,
  `name` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(50) NOT NULL,
  `vacancy` int(11) NOT NULL,
  `isverified` int(11) NOT NULL DEFAULT '0',
  `limitcgpa` decimal(10,2) NOT NULL DEFAULT '6.50'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `registrationId`, `name`, `email`, `password`, `vacancy`, `isverified`, `limitcgpa`) VALUES
(1, '123abc', 'GetinTouch Pvt Ltd.', 'kaushalmhalgi@gmail.com', '123456789', 100, 1, '8.00'),
(2, '1234kk', 'km', 'kmhalgi@dvibes.co', '123456789', 20, 1, '6.50');

-- --------------------------------------------------------

--
-- Table structure for table `placement`
--

CREATE TABLE `placement` (
  `id` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `companyId` int(11) NOT NULL,
  `isPlaced` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `placement`
--

INSERT INTO `placement` (`id`, `studentId`, `companyId`, `isPlaced`) VALUES
(6, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` bigint(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `user_id` varchar(150) NOT NULL,
  `password` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `class` varchar(10) NOT NULL,
  `roll_no` int(10) NOT NULL,
  `avgcgpa` decimal(10,2) NOT NULL DEFAULT '0.00',
  `totalkts` int(11) NOT NULL DEFAULT '0',
  `resume` varchar(1000) NOT NULL,
  `placedat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `user_id`, `password`, `branch`, `class`, `roll_no`, `avgcgpa`, `totalkts`, `resume`, `placedat`) VALUES
(1, 'kaushal', 'kaushalmhalgi@gmail.com', '12345678', 'CMPN', 'D12A', 39, '8.45', 1, 'resumes/kaushalmhalgi@gmail.com/Resume.pdf', 1),
(2, 'kazz', '2015kaushik@gmail.com', '123456789', 'c', 'k', 0, '0.00', 0, '', 0),
(3, 'Kaushal Mhalgi', 'kmhalgi@dvibes.co', '123456789', 'CMPN', 'D12A', 39, '0.00', 0, '', 0),
(4, 'km', 'kaz@ves.ac.in', '123456789', 'CMPN', 'D12A', 38, '0.00', 0, 'resumes/kaz@ves.ac.in/Resume.pdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `id` bigint(20) NOT NULL,
  `studentId` bigint(20) NOT NULL,
  `semno` int(10) NOT NULL,
  `cgpa` decimal(10,2) NOT NULL DEFAULT '0.00',
  `kts` int(10) NOT NULL DEFAULT '0',
  `isverified` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`id`, `studentId`, `semno`, `cgpa`, `kts`, `isverified`) VALUES
(1, 1, 1, '8.15', 0, 1),
(2, 1, 2, '9.00', 0, 1),
(3, 1, 3, '9.56', 1, 1),
(4, 1, 4, '8.00', 0, 1),
(6, 1, 6, '7.00', 0, 1),
(7, 1, 5, '9.00', 0, 1),
(8, 3, 1, '8.20', 1, 1),
(9, 4, 1, '7.59', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `placement`
--
ALTER TABLE `placement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `placement`
--
ALTER TABLE `placement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
