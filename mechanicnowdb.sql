-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2022 at 09:22 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

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
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custID`, `profile_url`, `custFirstname`, `custLastname`, `custAddress`, `custEmail`, `custCnumber`, `vehicleType`, `Username`, `Password`, `role`) VALUES
(1, '', 'John', 'Jalosjos', 'Maribago, Lapu-Lapu City, Cebu', 'johnjalosjos06@gmail.com', '2147483647', 'Motorcycle', 'jj', '$2y$10$Z1bwLAudyRjnaaIHmg.Ng.zXRWreCOXlgDyo5rISg7gBppbN/RD7u', 'vehicleOwner'),
(2, '', 'John', 'Jalosjos', 'Maribago, Lapu-Lapu City, Cebu', 'johnjalrosjos06@gmail.com', '2147483647', 'Four wheels', 'ff', '$2y$10$pWUNZzYHuAdXoDpD9JVPw.v0INIC0vQRYf.6lA/u7tmYqYi21MB6a', 'vehicleOwner');

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
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mechanic`
--

INSERT INTO `mechanic` (`mechID`, `profile_url`, `mechFirstname`, `mechLastname`, `mechAddress`, `mechEmail`, `mechCnumber`, `mechValidID`, `Specialization`, `Username`, `Password`, `role`) VALUES
(0, 'IMG-62302a788af418.12573513.jpg', 'Jepriels', 'tibay', 'Lapu-Lapu', 'tibay@gmail.com', '09448887777', 'IMG-623006448c9753.07631287.jpg', 'Motorcycle', 'gg', '$2y$10$EYoKFzQVJw4mf.TFbDqILe8C34HbLWXJCOOqlAr6hTBa.W6jrwKD2', 'mechanic');

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
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `custID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mechanic`
--
ALTER TABLE `mechanic`
  MODIFY `mechID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `resID` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
