-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2022 at 11:16 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csa_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(255) NOT NULL,
  `log_id` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `appointment` varchar(255) NOT NULL,
  `institution_code` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_id`, `receiver`, `appointment`, `institution_code`, `date`) VALUES
(12, '3284010490', '1107319787', 'set an appointment on 2022-11-10 8:00:00 - 10:00:00', '', '2022-11-06 18:03:12'),
(13, '599351617', '1107319787', 'set an appointment on 2022-11-09 13:00:00 - 15:00:00', '', '2022-11-06 18:04:21');

-- --------------------------------------------------------

--
-- Table structure for table `counselor`
--

CREATE TABLE `counselor` (
  `id` int(255) NOT NULL,
  `counselor_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffixes` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `sex` varchar(255) NOT NULL,
  `institution_code` varchar(255) NOT NULL,
  `counselor_pass` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counselor`
--

INSERT INTO `counselor` (`id`, `counselor_id`, `first_name`, `middle_name`, `last_name`, `suffixes`, `birth_date`, `sex`, `institution_code`, `counselor_pass`, `account_type`, `date_added`) VALUES
(4, '1107319787', 'Alexander', 'Smith', 'Luthor', '', '1993-07-15', 'male', '63677f13580ff', '$2y$10$Qr7KBD3Ipmq62/ebydI4puBMxyqaKzkCz4eBwakMx1VSuR3ZNPJrq', 'counselor', '2022-11-06 17:41:35'),
(5, '82573824', 'Clark', 'Kal-el', 'Kent', '', '1974-11-07', 'male', '63677fc5a82ad', '$2y$10$UC297pn6AZF.7VVLhYrJg.4AJYsGzhzgGBGBvcAiNCmBhYTyiju0q', 'counselor', '2022-11-06 17:46:40'),
(6, '3569180649', 'Diana', 'Themyscira', 'Prince', '', '1973-08-21', 'female', '63677f13580ff', '$2y$10$TAQAgvZIiATJIyx3b8c4.eWAj8mmXJupg5fviQ8FFTwQ3I/sDpwr6', 'counselor', '2022-11-06 17:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE `institution` (
  `id` int(255) NOT NULL,
  `institution_id` varchar(255) NOT NULL,
  `institution_name` varchar(255) NOT NULL,
  `institution_address` varchar(255) NOT NULL,
  `institution_code` varchar(255) NOT NULL,
  `institution_pass` varchar(255) NOT NULL,
  `account_type` varchar(255) NOT NULL,
  `date_added` datetime(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`id`, `institution_id`, `institution_name`, `institution_address`, `institution_code`, `institution_pass`, `account_type`, `date_added`) VALUES
(5, '2781083719', 'University of the Cordilleras', 'Governor Pack Road, Baguio City 2600, PH', '63677f13580ff', '$2y$10$qrxjy6NP8yHWHwKvF0ou6uoS36rEOR5uoyTifsQBeqRQTbIuQdqHW', 'institution', '2022-11-06 17:32:03.420693'),
(6, '1183238246', 'University of Baguio', 'Gen. Luna Rd, Baguio, 2600 Benguet', '63677fc5a82ad', '$2y$10$.pnStLbkPW.QJL7sN4BaVeagiHK.LosFKgFVyVyNUpdB9prT9NLBW', 'institution', '2022-11-06 17:35:01.749554'),
(7, '3224034315', 'Benguet State University', 'FH3R+P4R, La Trinidad, Benguet', '63678051bf52e', '$2y$10$iz1v0zoNAFqXscyuqiySTO5mWieC6s4JB1AMujdgvm9syOdf/3Iv6', 'institution', '2022-11-06 17:37:21.845766');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(30) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `counselor_id` varchar(255) NOT NULL,
  `meeting_link` varchar(255) NOT NULL,
  `institution_code` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `student_id`, `title`, `description`, `start_datetime`, `end_datetime`, `counselor_id`, `meeting_link`, `institution_code`, `date_added`) VALUES
(52, '3284010490', 'Grade', 'Grades this semester', '2022-11-10 08:00:00', '2022-11-10 10:00:00', '1107319787', 'https://meet.google.com/waw-unzx-qsz', '', '2022-11-06 18:03:12'),
(53, '599351617', 'Bullying', 'Victim of Bullying LOL', '2022-11-09 13:00:00', '2022-11-09 15:00:00', '1107319787', 'https://meet.google.com/fwo-sepq-niw', '', '2022-11-06 18:04:21');

-- --------------------------------------------------------

--
-- Table structure for table `student_account`
--

CREATE TABLE `student_account` (
  `id` int(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffixes` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `sex` varchar(255) NOT NULL,
  `institution_code` varchar(255) NOT NULL,
  `student_pass` varchar(255) NOT NULL,
  `account_type` varchar(30) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_account`
--

INSERT INTO `student_account` (`id`, `student_id`, `first_name`, `middle_name`, `last_name`, `suffixes`, `birth_date`, `sex`, `institution_code`, `student_pass`, `account_type`, `date_added`) VALUES
(8, '3284010490', 'Rachel', 'Rachel', 'Raven', '', '1998-11-01', 'female', '63677f13580ff', '$2y$10$AM3JQvGYgDEOOlQPQemIoenrTO3hR0oV6GACQbAhIdPh70LXSUvWW', 'student', '2022-11-06 17:58:23'),
(9, '599351617', 'Robin', 'Robin', 'Grayson', '', '1996-03-09', 'male', '63677f13580ff', '$2y$10$UtmGqmSZmwj13ua5/i0Y3OZ8uboojABV5qD8GhMZkBOnMhC54iTX6', 'student', '2022-11-06 17:59:56'),
(10, '2040514017', 'Barry', 'Barry', 'Allen', '', '1990-09-18', 'male', '63677fc5a82ad', '$2y$10$4/4y6xH9IfxVI4g8PQyp9.a9TvZzuzrYz2dIXw8HZbRCBnST/Z22i', 'student', '2022-11-06 18:01:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `counselor`
--
ALTER TABLE `counselor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `counselor_id` (`counselor_id`);

--
-- Indexes for table `institution`
--
ALTER TABLE `institution`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `institution_id` (`institution_id`),
  ADD UNIQUE KEY `institution_code` (`institution_code`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_account`
--
ALTER TABLE `student_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `counselor`
--
ALTER TABLE `counselor`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `student_account`
--
ALTER TABLE `student_account`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
