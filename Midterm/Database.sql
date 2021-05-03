-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2021 at 08:18 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `link`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `activity` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `time_log` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`activity`, `user_name`, `time_log`) VALUES
('Signed Up', 'ADMIN', '2021-05-03 06:14:03'),
('Logged In', 'ADMIN', '2021-05-03 06:14:26'),
('Reset Password', 'ADMIN', '2021-05-03 06:14:52'),
('Logged out', 'ADMIN', '2021-05-03 06:15:03'),
('Signed Up', 'kaaarl25', '2021-05-03 06:15:15'),
('Logged In', 'kaaarl25', '2021-05-03 06:15:20'),
('Reset Password', 'kaaarl25', '2021-05-03 06:15:48'),
('Logged out', 'kaaarl25', '2021-05-03 06:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `authentication_code`
--

CREATE TABLE `authentication_code` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `expiration` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `authentication_code`
--

INSERT INTO `authentication_code` (`id`, `user_id`, `code`, `created_at`, `expiration`) VALUES
(107, 15, 447442, '2021-05-03 14:06:57', '2021-05-03 14:11:57'),
(108, 16, 700783, '2021-05-03 14:08:03', '2021-05-03 14:13:03'),
(109, 15, 653472, '2021-05-03 14:10:45', '2021-05-03 14:15:45'),
(110, 17, 849262, '2021-05-03 14:14:26', '2021-05-03 14:19:26'),
(111, 18, 575498, '2021-05-03 14:15:20', '2021-05-03 14:20:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `datecreated`) VALUES
(17, 'ADMIN', '$2y$10$cYO1g0EKTMpGs6pLW2i9u.CeJ78BvyB.BecAEBnXUy3V9.X/N.lqK', '2021-05-03 06:14:03'),
(18, 'kaaarl25', '$2y$10$iMynEDPHHZinxXkcnhHsPedUygnj1RgykxChLGaQvpHSHH1QrUjZ.', '2021-05-03 06:15:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authentication_code`
--
ALTER TABLE `authentication_code`
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
-- AUTO_INCREMENT for table `authentication_code`
--
ALTER TABLE `authentication_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
