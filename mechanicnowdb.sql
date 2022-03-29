-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2022 at 08:12 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mechanicnowdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `Username`, `Password`, `role`) VALUES
(1, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custID` int(50) NOT NULL,
  `profile_url` varchar(100) NOT NULL,
  `custFirstname` varchar(50) NOT NULL,
  `custLastname` varchar(50) NOT NULL,
  `custAddress` varchar(50) NOT NULL,
  `custEmail` varchar(50) NOT NULL,
  `custCnumber` varchar(15) NOT NULL,
  `vehicleType` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `role` varchar(30) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `ban` varchar(100) NOT NULL DEFAULT 'unban'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custID`, `profile_url`, `custFirstname`, `custLastname`, `custAddress`, `custEmail`, `custCnumber`, `vehicleType`, `Username`, `Password`, `role`, `latitude`, `longitude`, `ban`) VALUES
(7, '', 'ww', 'ww', 'maribago', 'jepoytibs1234@gmail.com', '09772779310', 'Four wheels', 'ww', '$2y$10$nhMmqWUSvF/.RnRAd25i1updvuRT20C1YHcfracLAStJwKjI7ek.i', 'vehicleOwner', '10.334854423896688', '123.94493761750877', 'unban');

-- --------------------------------------------------------

--
-- Table structure for table `mechanic`
--

CREATE TABLE `mechanic` (
  `mechID` int(50) NOT NULL,
  `profile_url` varchar(100) NOT NULL,
  `mechFirstname` varchar(50) NOT NULL,
  `mechLastname` varchar(50) NOT NULL,
  `mechAddress` varchar(50) NOT NULL,
  `mechEmail` varchar(50) NOT NULL,
  `mechCnumber` varchar(50) NOT NULL,
  `mechValidID` varchar(100) NOT NULL,
  `Specialization` varchar(100) NOT NULL,
  `vehicleType` varchar(100) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `distanceKM` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mechanic`
--

INSERT INTO `mechanic` (`mechID`, `profile_url`, `mechFirstname`, `mechLastname`, `mechAddress`, `mechEmail`, `mechCnumber`, `mechValidID`, `Specialization`, `vehicleType`, `Username`, `Password`, `role`, `latitude`, `longitude`, `distanceKM`, `status`) VALUES
(36, 'IMG-623d459c753f68.58144376.png', 'qq', 'qq', 'Maribago, Lapu-Lapu City, Cebu', 'jepoytibs1234@gmail.com', '09772779310', 'IMG-623d4555e31098.27444863.png', 'Diesel Mechanic,Auto Body Mechanic,Heavy Equipment Mechanic', 'Car,Motorcycle,Bicycle', 'qq', '$2y$10$Uxxp2vycl0yTr0lfXCus9e1dmJR./GrZvoMu.Ytfg3rKHE9d7RiKy', 'mechanic', '10.334854423896688', '123.94493761750877', '0.0', 'approve');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `resID` int(50) NOT NULL,
  `mechID` int(50) NOT NULL,
  `custID` int(50) NOT NULL,
  `mechName` varchar(100) NOT NULL,
  `vOwnerName` varchar(100) NOT NULL,
  `specMessage` varchar(100) NOT NULL,
  `mechRepair` varchar(200) NOT NULL,
  `serviceType` varchar(50) NOT NULL,
  `serviceNeeded` varchar(100) NOT NULL,
  `mechAddress` varchar(100) NOT NULL,
  `custAddress` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Unaccepted',
  `currentlocation` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `totalamount` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`resID`, `mechID`, `custID`, `mechName`, `vOwnerName`, `specMessage`, `mechRepair`, `serviceType`, `serviceNeeded`, `mechAddress`, `custAddress`, `status`, `currentlocation`, `latitude`, `longitude`, `date`, `time`, `totalamount`) VALUES
(33, 36, 7, 'qq qq', 'ww ww', 'dfg', 'Tire Repair, Engine Overheat Repair, ', 'Diesel Mechanic,Auto Body Mechanic,Heavy Equipment', 'Home Service', 'Maribago, Lapu-Lapu City, Cebu', 'maribago', 'Unaccepted', '', '', '', '2022-04-05', '05:56', ''),
(34, 36, 7, 'qq qq', 'ww ww', 'drtyuio', 'Tire Repair, Engine Overheat Repair, Break Repair, ', 'Diesel Mechanic,Auto Body Mechanic,Heavy Equipment', 'Emergency Service', 'Maribago, Lapu-Lapu City, Cebu', 'maribago', 'Unaccepted', '', '10.334854423896688', '123.94493761750877', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custID`);

--
-- Indexes for table `mechanic`
--
ALTER TABLE `mechanic`
  ADD PRIMARY KEY (`mechID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`resID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `custID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mechanic`
--
ALTER TABLE `mechanic`
  MODIFY `mechID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `resID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
