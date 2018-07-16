-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2018 at 08:52 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `lockstatus`
--

CREATE TABLE `lockstatus` (
  `lock_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_room_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `appaccount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g1_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g1_date_last_synced` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g1_signal` int(255) DEFAULT NULL,
  `g2_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g2_date_last_synced` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g2_signal` int(11) DEFAULT NULL,
  `g3_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g3_date_last_synced` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `g3_signal` int(11) DEFAULT NULL,
  `the_current_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `timestamp_data_inserted` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lockstatus`
--

INSERT INTO `lockstatus` (`lock_name`, `customer_room_number`, `appaccount`, `g1_name`, `g1_date_last_synced`, `g1_signal`, `g2_name`, `g2_date_last_synced`, `g2_signal`, `g3_name`, `g3_date_last_synced`, `g3_signal`, `the_current_timestamp`, `timestamp_data_inserted`) VALUES
('UL000788', 'TestRoom', 'lock-250-1', 'GW_1_no Data', 'Test_date', 0, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL001901', 'TestRoom', 'lock-250-1', 'GW_1_no Data', 'TestData', 0, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL001904', 'TestRoom', 'lock-250-1', 'GW000028', 'Test_date', -83, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002006', 'TestRoom', 'lock-250-1', 'test', 'TestData', 0, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002035', 'TestRoom', 'lock-250-1', 'GW000178', 'TestData', -92, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002058', 'TestRoom', 'lock-250-1', 'test', 'TestData', 0, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002077', 'TestRoom', 'lock-250-1', 'GW_1_no Data', 'Test_date', 0, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002333', 'TestRoom', 'lock-250-1', 'GW_1_no Data', 'Test_date', 0, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002770', 'TestRoom', 'lock-250-1', 'GW000024', 'Test_date', -95, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002832', 'TestRoom', 'lock-250-1', 'GW000028', 'Test_date', -93, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002870', 'TestRoom', 'lock-250-1', 'GW_1_no Data', 'Test_date', 0, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002912', 'TestRoom', 'lock-250-1', 'GW000028', 'Test_date', -83, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002914', 'TestRoom', 'lock-250-1', 'GW_1_no Data', 'Test_date', 0, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002923', 'TestRoom', 'lock-250-1', 'GW_1_no Data', 'Test_date', 0, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002960', 'TestRoom', 'lock-250-1', 'GW000178', 'TestData', -91, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL003027', 'TestRoom', 'lock-250-1', 'GW000028', 'Test_date', -87, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL003081', 'TestRoom', 'lock-250-1', 'GW_1_no Data', 'Test_date', 0, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL003141', 'TestRoom', 'lock-250-1', 'GW_1_no Data', 'Test_date', 0, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `appaccount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`appaccount`, `username`, `email`, `password`, `active`) VALUES
('kas', '', '', '1234', 1),
('lock-250-1', 'hi', 'hi', '1234', 1),
('lock-250-2', 'hi', 'gi', '123456', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lockstatus`
--
ALTER TABLE `lockstatus`
  ADD PRIMARY KEY (`lock_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`appaccount`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
