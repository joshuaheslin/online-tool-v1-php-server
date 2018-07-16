-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 16, 2018 at 10:53 AM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `local_door_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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

INSERT INTO `lockstatus` (`lock_name`, `customer_room_number`, `local_door_name`, `appaccount`, `g1_name`, `g1_date_last_synced`, `g1_signal`, `g2_name`, `g2_date_last_synced`, `g2_signal`, `g3_name`, `g3_date_last_synced`, `g3_signal`, `the_current_timestamp`, `timestamp_data_inserted`) VALUES
('UL000001', '', '22222', 'lock-264-7', '', '', 0, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL000788', 'TestRoom', NULL, 'lock-250-1', '', '', 0, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL001901', '5001', NULL, 'lock-264-17', 'GW000178', 'Sun, 15 Jul 2018 02:33:27 +1000', -89, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL001904', '004', NULL, 'lock-264-5', 'GW000028', 'Mon, 16 Jul 2018 17:23:51 +1000', -86, 'GW000024', 'Mon, 16 Jul 2018 17:23:51 +1000', -84, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002006', 'TestRoom', NULL, 'lock-250-1', 'test', 'TestData', 0, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002035', '5002', NULL, 'lock-264-17', 'GW000178', 'Sun, 15 Jul 2018 02:33:27 +1000', -93, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002058', 'TestRoom', NULL, 'lock-250-1', 'test', 'TestData', 0, 'TestData', 'TestData', 0, 'TestData', 'TestData', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002077', '0102', 'PLATINUM BLE', 'lock-264-7', '', '', 0, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002333', '0101', 'ONYX', 'lock-264-7', 'GW000006', 'Mon, 16 Jul 2018 20:48:39 +1000', -59, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002770', '003', NULL, 'lock-264-5', '', '', 0, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002832', '005', NULL, 'lock-264-5', 'GW000024', 'Mon, 16 Jul 2018 17:22:31 +1000', -72, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002857', '002', NULL, 'lock-264-17', 'GW000178', 'Sun, 15 Jul 2018 02:33:27 +1000', -83, 'GW000168', 'Mon, 16 Jul 2018 20:45:08 +1000', -91, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002870', '001', 'BLE ACS', 'lock-264-7', '', '', 0, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002889', '004', 'Door Test 2', 'lock-264-17', '', '', 0, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002912', '007', NULL, 'lock-264-5', 'GW000028', 'Mon, 16 Jul 2018 17:21:54 +1000', -78, 'GW000024', 'Mon, 16 Jul 2018 17:22:31 +1000', -89, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002914', '009', NULL, 'lock-264-5', '', '', 0, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002923', '001', NULL, 'lock-264-5', 'GW000028', 'Mon, 16 Jul 2018 17:21:54 +1000', -81, 'GW000024', 'Mon, 16 Jul 2018 17:22:31 +1000', -93, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002942', '001', NULL, 'lock-264-17', 'GW000178', 'Sun, 15 Jul 2018 02:33:27 +1000', -94, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002960', '012', NULL, 'lock-264-17', 'GW000178', 'Sun, 15 Jul 2018 02:33:27 +1000', -89, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL002978', '011', NULL, 'lock-264-17', 'GW000168', 'Mon, 16 Jul 2018 20:45:08 +1000', -86, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL003008', '005', 'DoorTest', 'lock-264-17', '', '', 0, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL003012', '003', 'doortest11', 'lock-264-17', 'GW000168', 'Mon, 16 Jul 2018 20:45:08 +1000', -81, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL003027', '006', NULL, 'lock-264-5', 'GW000028', 'Mon, 16 Jul 2018 17:21:54 +1000', -93, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL003081', '008', NULL, 'lock-264-5', '', '', 0, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL003099', '008', NULL, 'lock-264-17', '', '', 0, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL003114', '007', NULL, 'lock-264-17', '', '', 0, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL003141', '010', NULL, 'lock-264-5', '', '', 0, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('UL003146', '009', NULL, 'lock-264-17', '', '', 0, '', '', 0, '', '', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lockstatus`
--
ALTER TABLE `lockstatus`
  ADD PRIMARY KEY (`lock_name`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
