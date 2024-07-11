-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2024 at 07:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectskih3113`
--

-- --------------------------------------------------------

--
-- Table structure for table `sensordata`
--

CREATE TABLE `sensordata` (
  `id` int(11) NOT NULL,
  `ir_value` int(11) NOT NULL,
  `mq135_analog_value` int(11) NOT NULL,
  `dht22_temp` float NOT NULL,
  `dht22_humd` float NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sensordata`
--

INSERT INTO `sensordata` (`id`, `ir_value`, `mq135_analog_value`, `dht22_temp`, `dht22_humd`, `timestamp`) VALUES
(1, 1, 280, 36.4, 60.7, '2024-07-07 07:37:00'),
(2, 1, 320, 36.4, 60.7, '2024-07-07 07:37:30'),
(3, 1, 400, 36.9, 58.7, '2024-07-07 07:38:00'),
(4, 0, 572, 39.4, 59.7, '2024-07-07 07:38:30'),
(5, 0, 620, 34.5, 58.9, '2024-07-07 07:39:00'),
(6, 0, 600, 34.6, 61, '2024-07-07 07:39:30'),
(7, 0, 600, 34.6, 60.9, '2024-07-07 07:40:00'),
(8, 1, 580, 34.6, 61, '2024-07-07 07:40:30'),
(9, 0, 598, 34.6, 61.2, '2024-07-07 07:41:00'),
(10, 0, 609, 34.4, 61.1, '2024-07-07 07:41:30'),
(11, 0, 480, 34.5, 60.9, '2024-07-07 15:09:48'),
(12, 1, 505, 34.6, 61, '2024-07-07 15:09:48'),
(13, 0, 510, 34.8, 60.8, '2024-07-07 16:18:53'),
(14, 0, 523, 35.1, 60.8, '2024-07-07 16:18:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sensordata`
--
ALTER TABLE `sensordata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sensordata`
--
ALTER TABLE `sensordata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
