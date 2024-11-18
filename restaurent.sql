-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2023 at 02:01 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurent`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(20) NOT NULL DEFAULT ' ',
  `datetime` datetime NOT NULL,
  `phonenumber` varchar(20) NOT NULL DEFAULT ' '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `email`, `password`, `image`, `datetime`, `phonenumber`) VALUES
('Abhishek', 'adminabhi@gmail.com', '1212', 'adminabhi.jpeg', '2023-03-28 10:13:16', '7488048437');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `timedate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_menu`
--

CREATE TABLE `food_menu` (
  `name` varchar(20) NOT NULL,
  `summary` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `price` int(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `April2023` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_menu`
--

INSERT INTO `food_menu` (`name`, `summary`, `status`, `price`, `image`, `April2023`) VALUES
('bn', 'cv ', 1, 5, 'bn.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `email` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Table.NO` int(20) NOT NULL,
  `Items` varchar(255) NOT NULL,
  `Price` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `paymentmode` varchar(12) NOT NULL DEFAULT 'COD'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`email`, `Name`, `Table.NO`, `Items`, `Price`, `datetime`, `status`, `paymentmode`) VALUES
('SHIVARUDRA7488@GMAIL.COM', 'Abhi', 6, 'COLD COFFEE-7', 525, '2023-04-17 17:31:55', 'Recived', 'COD');

-- --------------------------------------------------------

--
-- Table structure for table `tableno`
--

CREATE TABLE `tableno` (
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `table_number` int(11) NOT NULL,
  `phonenumber` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tableno`
--

INSERT INTO `tableno` (`date`, `start_time`, `end_time`, `status`, `email`, `table_number`, `phonenumber`, `name`, `datetime`) VALUES
('2023-04-17', '01:37:00', '02:40:00', 'Cancel', 'shivarudra7488@gmail.com', 2, '12', 'as', '2023-04-16 23:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_db`
--

CREATE TABLE `user_db` (
  `name` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'noimage',
  `phone` varchar(255) NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(20) NOT NULL DEFAULT ' ',
  `feedbacksummary` text NOT NULL DEFAULT ' ',
  `star` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_db`
--

INSERT INTO `user_db` (`name`, `email`, `password`, `datetime`, `image`, `phone`, `pincode`, `city`, `state`, `feedbacksummary`, `star`) VALUES
('Abhi', '7488048437@gmail.com', '$2y$10$uo5kKjj.FdtcjTVR9KPj6eao5YmgOoNs/vlc5dd2utYlVwIC2Yabu', '2023-04-17 21:18:44', '7488048437.jpg', '858585858', '858585', 'kochas', 'Bihar', ' iihhiihihih', 5),
('Abhishek Tiwari', 'shivarudra7488@gmail.com', '$2y$10$6zxPsBbxTEE7xDTT37LfYu4QjrsIOUwxBExsN76SKflvAPU.QHH0W', '2023-03-26 09:40:28', 'shivarudra7488.jpeg', '7488048437', '821107', 'Kochas', 'Bihar', 'it is very very good your service is not good improve your sjkffs,\r\n', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`timedate`);

--
-- Indexes for table `food_menu`
--
ALTER TABLE `food_menu`
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user_db`
--
ALTER TABLE `user_db`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
