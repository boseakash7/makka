-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: May 26, 2022 at 07:11 AM
-- Server version: 5.7.28
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `makka`
--

-- --------------------------------------------------------

--
-- Table structure for table `airlines`
--

CREATE TABLE `airlines` (
  `id` int(10) UNSIGNED NOT NULL,
  `en_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airlines`
--

INSERT INTO `airlines` (`id`, `en_name`, `ar_name`) VALUES
(1, 'Airline 1 En', 'Airline 1 Ar'),
(2, 'Airline 2 En', 'Airline 2 Ar');

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `id` int(11) UNSIGNED NOT NULL,
  `city` int(10) UNSIGNED NOT NULL,
  `en_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('source','destination') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`id`, `city`, `en_name`, `ar_name`, `type`, `created_at`) VALUES
(1, 2, '123', 'asd', 'source', 1653315272),
(2, 1, 'awesome', 'aweome 2', 'source', 1653315334),
(3, 2, '12312312312 3123', 'asd', 'source', 1653316576),
(4, 1, '12312', '123', 'destination', 1653479652),
(5, 1, 'asd123', '123123', 'destination', 1653480236);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `en_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `en_name`, `ar_name`) VALUES
(1, 'City 1 En', 'City 1 Ar'),
(2, 'City 2 En', 'City 2 Ar');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(10) UNSIGNED NOT NULL,
  `number` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `airline` int(10) UNSIGNED NOT NULL,
  `tdate` date NOT NULL,
  `ttime` time NOT NULL,
  `passengers` int(11) NOT NULL,
  `sairport` int(10) UNSIGNED NOT NULL,
  `dairport` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('not_opened','opened','check_in','check_out','close') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `number`, `airline`, `tdate`, `ttime`, `passengers`, `sairport`, `dairport`, `status`, `created_at`) VALUES
(1, 'asd123123', 1, '2022-05-27', '12:31:00', 1232, 1, 4, 'not_opened', 1653397191),
(2, 'AKASH876', 1, '2020-12-03', '23:38:00', 21, 3, 4, 'not_opened', 1653483890),
(3, 'NICE87', 2, '2022-05-27', '13:39:00', 123, 2, NULL, 'opened', 1653491370);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('supervisor','employee','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `airport` int(10) UNSIGNED NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `reset_token`, `type`, `airport`, `created_at`) VALUES
(1, 'Akash Bose2', 'boseakash71@gmail.com', NULL, NULL, 'employee', 2, 1653371725),
(2, 'Akash Bose', 'boseakash17@gmail.com', NULL, NULL, 'employee', 2, 1653371802),
(3, 'Akash Bose', 'boseakash7@gmail.com', '$2y$10$DhIhW7axFsjBmSSUzk/IUeq1BDSjsoB4JwjRuaaaDEf78soh2I9JK', NULL, 'employee', 2, 1653372443),
(4, 'asd123', 'supervisor@mail.com', '$2y$10$dkQQgJnFtsYqOlHMKeO87e319uvA6r2r5vhN1gjiawGAivnocz7/u', NULL, 'supervisor', 2, 1653373158),
(5, 'Test User', 'boseakash57@gmail.com', '$2y$10$RGTYa/RYQT61n9xiU0Ipy.oV2R53aF/9YLakBaIN2.ZMr8ORW63Du', NULL, 'admin', 5, 1653485846),
(6, 'asdasd asdasd', 'boseakash71212@gmail.com', NULL, NULL, 'supervisor', 2, 1653490994);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airlines`
--
ALTER TABLE `airlines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airlines`
--
ALTER TABLE `airlines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `airports`
--
ALTER TABLE `airports`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
