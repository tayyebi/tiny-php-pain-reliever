-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 30, 2020 at 02:08 PM
-- Server version: 5.7.29
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tint`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `Id` bigint(20) NOT NULL,
  `Phone` varchar(300) DEFAULT NULL,
  `Body` varchar(3000) NOT NULL,
  `Submit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Status` varchar(150) NOT NULL DEFAULT 'Not Seen'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `News`
--

CREATE TABLE `News` (
  `Id` bigint(20) NOT NULL,
  `Title` varchar(3000) CHARACTER SET latin1 NOT NULL,
  `Image` varchar(3000) COLLATE utf8_persian_ci DEFAULT NULL,
  `Abstract` longtext CHARACTER SET latin1,
  `Body` longtext CHARACTER SET latin1,
  `Submit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Canonical` varchar(3000) CHARACTER SET latin1 DEFAULT NULL,
  `Meta` text CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Posts`
--

CREATE TABLE `Posts` (
  `Id` bigint(20) NOT NULL,
  `Title` varchar(3000) CHARACTER SET latin1 NOT NULL,
  `Image` varchar(3000) COLLATE utf8_persian_ci DEFAULT NULL,
  `Abstract` longtext CHARACTER SET latin1,
  `Submit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Canonical` varchar(3000) CHARACTER SET latin1 DEFAULT NULL,
  `Meta` text CHARACTER SET latin1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `News`
--
ALTER TABLE `News`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `News`
--
ALTER TABLE `News`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Posts`
--
ALTER TABLE `Posts`
  MODIFY `Id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
