-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2022 at 11:46 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dhmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbhiredriver`
--

CREATE TABLE `tbhiredriver` (
  `id` int(11) NOT NULL,
  `bookingNumber` bigint(12) DEFAULT NULL,
  `userid` varchar(45) DEFAULT NULL,
  `driveruserid` varchar(45) DEFAULT NULL,
  `fromdate` date DEFAULT NULL,
  `todate` date DEFAULT NULL,
  `remark` varchar(200) DEFAULT NULL,
  `status` varchar(45) DEFAULT '0',
  `driverremarks` varchar(200) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp(),
  `lastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbhiredriver`
--

INSERT INTO `tbhiredriver` (`id`, `bookingNumber`, `userid`, `driveruserid`, `fromdate`, `todate`, `remark`, `status`, `driverremarks`, `create_date`, `lastUpdationDate`) VALUES
(1, 368869820, '1', '1', '2022-02-01', '2022-02-04', 'hfffs', '1', 'ssssss', '2022-01-31 14:56:22', '2022-02-05 10:21:18'),
(2, 369969829, '1', '3', '2022-02-09', '2022-02-12', 'sssssss', '0', NULL, '2022-02-01 16:33:59', '2022-02-05 10:21:27'),
(3, 368860829, '2', '3', '2022-02-17', '2022-02-22', 'test', '0', NULL, '2022-02-02 17:02:06', '2022-02-05 10:21:38'),
(4, 368860029, '2', '4', '2022-03-02', '2022-03-05', 'dddddddddd', '0', NULL, '2022-02-02 17:05:13', '2022-02-05 10:21:52'),
(5, 368869829, '2', '2', '2022-02-06', '2022-02-10', 'Travelling From Delhi to Chandigrah.', '0', NULL, '2022-02-05 10:09:55', '2022-02-05 10:22:02'),
(7, 835217503, '2', '1', '2022-02-12', '2022-02-15', 'NA', '1', 'Approved', '2022-02-05 10:24:19', '2022-02-06 09:20:24'),
(8, 110679670, '2', '1', '2022-02-18', '2022-02-24', 'NA', '0', NULL, '2022-02-05 10:32:51', NULL),
(9, 532523733, '1', '1', '2022-02-18', '2022-02-23', 'NA', '0', NULL, '2022-02-05 10:42:00', '2022-02-06 09:18:02'),
(10, 145894433, '1', '1', '2022-02-25', '2022-02-28', 'NA', '0', NULL, '2022-02-06 09:17:29', NULL),
(11, 248943268, '3', '10', '2022-02-10', '2022-02-12', 'NA', '1', 'Booking Confirmed', '2022-02-06 10:31:52', '2022-02-06 10:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`id`, `name`, `email`, `mobile`, `password`, `create_date`) VALUES
(1, 'admin', 'admin@gmail.com', '9078989786', 'f925916e2754e5e03f75dd58a5733251', '2022-01-19 11:25:17');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(11) NOT NULL,
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `fname`, `lname`, `email`, `mobile`, `password`, `address`, `create_date`) VALUES
(1, 'anuj', 'kumar', 'anuj@gmail.com', '0967987566', 'f925916e2754e5e03f75dd58a5733251', 'E-48 New Ashok Nagar11', '2022-01-28 18:21:36'),
(2, 'Shiv', 'kumar singh', 'shiv@gmail.com', '7657674563', 'f925916e2754e5e03f75dd58a5733251', 'A 345 ABC Colony New Delhi', '2022-01-28 18:22:09'),
(3, 'Garima ', 'Singh', 'gm1989@gmai.com', '1234567890', 'f925916e2754e5e03f75dd58a5733251', 'H125 Raj Nagar Ghaziabad', '2022-02-06 10:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbluserdrivers`
--

CREATE TABLE `tbluserdrivers` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `mobile` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `LicenseNo` varchar(200) DEFAULT NULL,
  `uploadLicenseNo` varchar(200) DEFAULT NULL,
  `UploadPhoto` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbluserdrivers`
--

INSERT INTO `tbluserdrivers` (`id`, `name`, `mobile`, `email`, `LicenseNo`, `uploadLicenseNo`, `UploadPhoto`, `Password`, `Address`, `create_date`) VALUES
(1, 'Rajesh Kumar', '9987867878', 'raju@gmail.com', 'Lic0867856746', '2c86e2aa7eb4cb4db70379e28fab9b521644142079.pdf', '694c8caa2c210cd0cc3d722949416730jpeg', 'f925916e2754e5e03f75dd58a5733251', 'New Delhi India', '2022-01-28 18:08:04'),
(2, 'Ram lal Yadav', '7657674563', 'ramlal@gmail.com', 'Lic78978657646', '86385-boxed-bg.jpg', '20095-avatar5.png', 'f925916e2754e5e03f75dd58a5733251', 'E-48 New Ashok Nagar', '2022-01-28 18:10:17'),
(3, 'Monika', '9789865764', 'mohit@gmail.com', 'Lic909785763', '29520-boxed-bg.jpg', '22325-avatar3.png', '5c428d8875d2948607f3e3fe134d71b4', 'E-48 New Ashok Nagar', '2022-01-28 18:11:53'),
(4, 'Ajit', '9786756645', 'ajit@gmail.com', 'Lic76676743534', '20476-default-150x150.png', '87551-avatar4.png', 'fcea920f7412b5da7be0cf42b8c93759', 'E-48 New Ashok Nagar', '2022-01-28 18:13:13'),
(5, 'Atal', '9987067878', 'atal@gmail.com', 'Lic0867856746', 'dummy.pdf', '83655-avatar2.png', 'f925916e2754e5e03f75dd58a5733251', 'E-48 New Ashok Nagar', '2022-01-28 18:08:04'),
(6, 'Rampal Yadav', '7657894563', 'rampal@gmail.com', 'Lic78978657646', '86385-boxed-bg.jpg', '20095-avatar5.png', 'f925916e2754e5e03f75dd58a5733251', 'E-48 New Ashok Nagar', '2022-01-28 18:10:17'),
(7, 'kaji lal Yadav', '7657374563', 'kajilal@gmail.com', 'Lic78978657646', '86385-boxed-bg.jpg', '20095-avatar5.png', 'f925916e2754e5e03f75dd58a5733251', 'E-48 New Ashok Nagar', '2022-01-28 18:10:17'),
(8, 'Moti lal Yadav', '7657274563', 'motilal@gmail.com', 'Lic78978657646', '86385-boxed-bg.jpg', '20095-avatar5.png', 'f925916e2754e5e03f75dd58a5733251', 'E-48 New Ashok Nagar', '2022-01-28 18:10:17'),
(9, 'Rahul Kumar', '1236547890', 'rk07@gmail.com', 'HYJ567727', '84807-dummy.pdf', '96565-user.png', 'f925916e2754e5e03f75dd58a5733251', 'New Delhi India', '2022-02-06 10:27:38'),
(10, 'Amit Singh', '8523697410', 'amits01@gmail.com', 'ATH3424234', '71611-sample.pdf', '20466-5546667.png', 'f925916e2754e5e03f75dd58a5733251', 'A123 Sector 5 Noida UP', '2022-02-06 10:29:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbhiredriver`
--
ALTER TABLE `tbhiredriver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluserdrivers`
--
ALTER TABLE `tbluserdrivers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbhiredriver`
--
ALTER TABLE `tbhiredriver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbluserdrivers`
--
ALTER TABLE `tbluserdrivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
