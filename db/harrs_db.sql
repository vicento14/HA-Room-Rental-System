-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2024 at 04:05 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `harrs_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `SignIn` (IN `sUsername` VARCHAR(255), IN `sPassword` VARCHAR(255))  BEGIN
	SELECT Username, Name, Role FROM Accounts 
    WHERE Username = BINARY convert(sUsername using utf8mb4) collate utf8mb4_bin 
    AND Password = BINARY convert(sPassword using utf8mb4) collate utf8mb4_bin;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(10) UNSIGNED NOT NULL,
  `Username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Role` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`ID`, `Username`, `Password`, `Name`, `Role`, `DateUpdated`) VALUES
(1, 'Admin', 'Admin', 'Admin', 'Admin', '2022-10-01 04:54:00'),
(4, 'vince', 'vince', 'Vince', 'Admin', '2024-02-09 14:18:32');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `ID` int(10) UNSIGNED NOT NULL,
  `RoomID` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RoomType` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RoomDescription` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'N/A',
  `RoomRent` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Occupied` tinyint(1) NOT NULL DEFAULT 0,
  `DateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`ID`, `RoomID`, `RoomType`, `RoomDescription`, `RoomRent`, `Occupied`, `DateUpdated`) VALUES
(1, 'Room-001', 'Small', 'With Kitchen and Cr', '2700.00', 0, '2024-02-09 18:28:31'),
(2, 'Room-002', 'Small', 'With Kitchen and Cr', '2700.00', 0, '2024-02-09 18:07:11'),
(3, 'Room-003', 'Small', 'With Kitchen and Cr', '2700.00', 0, '2024-02-09 18:07:16'),
(4, 'Room-004', 'Small', 'With Kitchen and Cr', '2700.00', 0, '2024-02-09 18:07:20'),
(5, 'Room-005', 'Small', 'With Kitchen and Cr', '2700.00', 0, '2024-02-09 18:07:26'),
(6, 'Room-006', 'Small', 'With Kitchen and Cr', '2700.00', 0, '2024-02-09 18:07:31'),
(7, 'Room-007', 'Medium', 'With Kitchen and Cr', '3000.00', 0, '2022-10-26 22:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `ID` int(10) UNSIGNED NOT NULL,
  `TenantID` char(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LastName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FirstName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `MiddleName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Address` varchar(625) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ContactNumber` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `WorkAddress` varchar(625) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `NumOfTenants` tinyint(4) NOT NULL DEFAULT 1,
  `Active` tinyint(1) NOT NULL DEFAULT 0,
  `DateUpdated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`ID`, `TenantID`, `LastName`, `FirstName`, `MiddleName`, `Address`, `ContactNumber`, `Occupation`, `Company`, `WorkAddress`, `NumOfTenants`, `Active`, `DateUpdated`) VALUES
(1, 'T00000001', 'TestLastName1', 'TestFirstName1', 'TestMiddleName1', 'TestAddress', '09123456789', 'TestOccupation', 'TestCompany', 'TestWorkAddress', 1, 0, '2024-02-09 23:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `ID` int(10) UNSIGNED NOT NULL,
  `TransactionID` char(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FirstTransact` tinyint(1) NOT NULL DEFAULT 0,
  `LastTransact` tinyint(1) NOT NULL DEFAULT 0,
  `TenantID` char(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RoomID` char(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RentExp` decimal(10,2) DEFAULT NULL,
  `ElectricExp` decimal(10,2) DEFAULT NULL,
  `WaterExp` decimal(10,2) DEFAULT NULL,
  `TotalExp` decimal(10,2) NOT NULL,
  `FirstTransactDeposit` decimal(10,2) DEFAULT NULL,
  `RentalFee` decimal(10,2) DEFAULT NULL,
  `ReceivableElectricBill` decimal(10,2) DEFAULT NULL,
  `ReceivableWaterBill` decimal(10,2) DEFAULT NULL,
  `TotalBill` decimal(10,2) NOT NULL,
  `Paid` tinyint(1) NOT NULL,
  `DueDate` datetime NOT NULL,
  `DatePaid` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `RoomID` (`RoomID`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `tenant_id` (`TenantID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `transaction_id` (`TransactionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `ID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
