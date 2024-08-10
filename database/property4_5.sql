-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2024 at 07:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*import this db*/

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `property4.5`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `bank_name` varchar(400) NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `bank_name`, `status_id`, `date_created`, `date_modified`, `modified_by`) VALUES
(1, 'sdfsfsgg', 8, '2024-07-19 18:56:53', '2024-07-19 18:56:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `branch_name` varchar(400) NOT NULL,
  `branch_address` text NOT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `firm_id` int(10) UNSIGNED NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `branch_address`, `status_id`, `firm_id`, `date_created`, `date_modified`, `created_by`, `modified_by`) VALUES
(1, 'sfsfsf', 'cccccc cccc  &#60;script&#62;alert(&#39;hello);&#60;/script&#62;', 4, 1, '0000-00-00 00:00:00', '2024-07-16 09:27:39', 1, 1),
(2, 'wrwr23', '3r2r23', 1, 1, '0000-00-00 00:00:00', '2024-07-19 18:58:40', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(400) NOT NULL,
  `unique_id` varchar(100) NOT NULL,
  `roles` varchar(100) NOT NULL,
  `reply_id` varchar(100) NOT NULL,
  `reply_status` varchar(5) NOT NULL,
  `send_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `mobile_number` varchar(500) DEFAULT NULL,
  `contact_type_id` int(11) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_type`
--

CREATE TABLE `contact_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `contact_type` varchar(12) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_type`
--

INSERT INTO `contact_type` (`id`, `contact_type`, `date_created`) VALUES
(1, 'Home', '2024-07-20 16:21:51'),
(2, 'Mobile', '2024-07-20 16:21:51');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `id` int(10) UNSIGNED NOT NULL,
  `district_name` varchar(200) NOT NULL,
  `country_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`id`, `district_name`, `country_id`, `status_id`, `created_by`, `modified_by`, `date_created`, `date_modified`) VALUES
(1, 'BBBBf', 0, 8, 1, 1, '2024-07-17 09:47:46', '2024-07-19 18:21:28'),
(2, 'masaka', 0, 1, 1, 0, '2024-07-19 18:21:48', '2024-07-19 18:21:48');

-- --------------------------------------------------------

--
-- Table structure for table `firms`
--

CREATE TABLE `firms` (
  `id` int(10) UNSIGNED NOT NULL,
  `firm_name` varchar(400) NOT NULL,
  `firm_flag` varchar(8) NOT NULL DEFAULT 'yes',
  `counter` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `firms`
--

INSERT INTO `firms` (`id`, `firm_name`, `firm_flag`, `counter`) VALUES
(1, 'DAQA', 'yes', 4);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(10) UNSIGNED NOT NULL,
  `action` text NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-06-29-182238', 'App\\Database\\Migrations\\CreateBanksTable', 'default', 'App', 1720003353, 1),
(2, '2024-06-29-191656', 'App\\Database\\Migrations\\CreateStatusTable', 'default', 'App', 1720003353, 1),
(4, '2024-06-29-194042', 'App\\Database\\Migrations\\CreateFirmsTable', 'default', 'App', 1720003427, 2),
(5, '2024-06-30-082722', 'App\\Database\\Migrations\\CreatecommentsTable', 'default', 'App', 1720003428, 2),
(6, '2024-06-30-085154', 'App\\Database\\Migrations\\CreateContactTable', 'default', 'App', 1720003428, 2),
(7, '2024-06-30-090136', 'App\\Database\\Migrations\\CreateContactTypeTable', 'default', 'App', 1720003428, 2),
(8, '2024-06-30-091212', 'App\\Database\\Migrations\\CreateHistoryTable', 'default', 'App', 1720003732, 3),
(9, '2024-06-30-092919', 'App\\Database\\Migrations\\CreatePositionsTable', 'default', 'App', 1720003732, 3),
(11, '2024-07-03-110617', 'App\\Database\\Migrations\\CreatePropertyCommentsTable', 'default', 'App', 1720005151, 4),
(12, '2024-07-05-091037', 'App\\Database\\Migrations\\CreatePropertyRolesTable', 'default', 'App', 1720172851, 5),
(20, '2024-07-05-094833', 'App\\Database\\Migrations\\CreatePropertSessionLogTable', 'default', 'App', 1720178205, 6),
(24, '2024-07-08-104224', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1720435371, 7),
(25, '2024-07-09-210007', 'App\\Database\\Migrations\\CreateDistrictsTable', 'default', 'App', 1720559604, 8),
(27, '2024-07-09-212103', 'App\\Database\\Migrations\\CreatePropertyTable', 'default', 'App', 1720560413, 9),
(28, '2024-07-16-092514', 'App\\Database\\Migrations\\CreateBranchesTable', 'default', 'App', 1721121983, 10);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `position` text NOT NULL,
  `description` text NOT NULL,
  `status_id` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `id` int(11) UNSIGNED NOT NULL,
  `serial_no` varchar(400) NOT NULL,
  `tenure` varchar(200) NOT NULL,
  `property_address` text NOT NULL,
  `bank_id` int(10) UNSIGNED NOT NULL,
  `bank_option` text DEFAULT NULL,
  `north` varchar(100) DEFAULT NULL,
  `east` varchar(100) DEFAULT NULL,
  `zone` varchar(25) DEFAULT NULL,
  `c_north` varchar(100) DEFAULT NULL,
  `c_east` varchar(100) DEFAULT NULL,
  `date_of_val` date NOT NULL,
  `acreage` varchar(100) NOT NULL,
  `rate_per_acre` double(100,2) NOT NULL DEFAULT 0.00,
  `property_value` double(100,2) NOT NULL DEFAULT 0.00,
  `user_status` varchar(50) NOT NULL,
  `user_option` varchar(100) DEFAULT NULL,
  `notes` text NOT NULL,
  `valuer_id` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `town_id` int(11) NOT NULL,
  `village_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`id`, `serial_no`, `tenure`, `property_address`, `bank_id`, `bank_option`, `north`, `east`, `zone`, `c_north`, `c_east`, `date_of_val`, `acreage`, `rate_per_acre`, `property_value`, `user_status`, `user_option`, `notes`, `valuer_id`, `firm_id`, `district_id`, `town_id`, `village_id`, `status_id`, `comment`, `category_id`, `created_by`, `date_created`, `date_modified`, `modified_by`) VALUES
(5, '124070004', 'IIO', 'trgrgrtgrtgrt', 1, '', '0.43', '57.000', '', NULL, NULL, '2024-07-30', 'r5', 5000.00, 500.00, 'Hostel', '', '', 1, 1, 1, 0, 0, 1, '', 0, 1, '2024-07-26 15:43:13', '2024-07-26 15:43:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `property_comments`
--

CREATE TABLE `property_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(400) NOT NULL,
  `reply` varchar(300) NOT NULL,
  `review` varchar(50) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `property_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status_id` int(11) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `description`, `status_id`, `firm_id`, `date_created`, `date_modified`, `created_by`, `modified_by`) VALUES
(1, 'system admin', 'none', 9, 0, '0000-00-00 00:00:00', '2019-05-12 15:59:25', 0, 0),
(2, 'user', 'none', 1, 0, '0000-00-00 00:00:00', '2019-05-12 16:11:34', 0, 0),
(3, 'staff member', 'none', 1, 0, '0000-00-00 00:00:00', '2019-05-16 12:59:50', 0, 0),
(4, 'administrator', 'none', 1, 0, '0000-00-00 00:00:00', '2019-05-12 15:59:25', 0, 0),
(5, 'sas ddd', 'asdasd sdd', 8, 1, '0000-00-00 00:00:00', '2024-07-16 10:20:37', 1, 1),
(6, 'hhhg ghggh', 'ytfufuf yufy fui', 8, 1, '0000-00-00 00:00:00', '2024-07-17 09:22:15', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `session_log`
--

CREATE TABLE `session_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `time` int(11) NOT NULL COMMENT 'stores login time',
  `user_id` text NOT NULL,
  `last_seen` int(11) NOT NULL COMMENT 'stores the last seen time',
  `status` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL,
  `status_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status_name`) VALUES
(1, 'Active'),
(2, 'Pending'),
(3, 'Suspended'),
(4, 'Inactive'),
(5, 'Closed'),
(6, 'Deleted');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(450) NOT NULL,
  `pass_check` int(2) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `status_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `my_count` int(2) NOT NULL,
  `other_names` varchar(200) NOT NULL,
  `firm_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `f_code` varchar(200) NOT NULL,
  `f_email` varchar(200) NOT NULL,
  `f_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment` text NOT NULL,
  `salutation` varchar(20) NOT NULL,
  `initials` varchar(10) NOT NULL,
  `photo` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `pass_check`, `gender`, `status_id`, `role_id`, `my_count`, `other_names`, `firm_id`, `branch_id`, `f_code`, `f_email`, `f_time`, `comment`, `salutation`, `initials`, `photo`, `created_by`, `date_created`, `modified_by`, `date_modified`) VALUES
(1, 'reagan', 'ajuna', 'ajunareagan@gmail.com', '$2y$12$8wGNsC3Kxk91X1JztM/y1.TaGAMVD.xrNQGp53JPZZarZN7PPZPXG', 1, 'male', 1, 1, 0, 'Mike', 1, 1, '', '', '2024-07-08 08:18:56', '', 'mr', 'aj', 'reagan_ajuna17218532287935.jpg', 1, '2024-07-08 08:18:56', 1, '2024-07-24 20:33:48'),
(2, 'reagan', 'ajuna', 'ajunareagffan@gmail.com', '$2y$12$tfloz3gcpeo6ycoyrmm4jeppkprp4mcbiddirmee2j2wezvmilaww', 1, 'male', 9, 1, 0, 'Bob', 1, 1, '', '', '2024-07-08 08:18:56', '', 'mr', 'aj', '', 1, '2024-07-08 08:18:56', 1, '2024-07-12 11:01:25'),
(3, 'er', 'ere', 'ere@gmail.con', '$2y$12$QIOtNIUHxa83RWAFGnX.ue.iXUhULgtksH5vmQLBxcJyHgq/3fBRy', 1, 'Male', 1, 2, 0, 'ss', 1, 1, '', '', '2024-07-17 21:08:23', '', 'Mr.', 'er', 'er_ere17215087095938.jpg', 1, '2024-07-17 21:08:23', 1, '2024-07-20 20:51:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_type`
--
ALTER TABLE `contact_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD KEY `id` (`id`);

--
-- Indexes for table `firms`
--
ALTER TABLE `firms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `property_comments`
--
ALTER TABLE `property_comments`
  ADD KEY `id` (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD KEY `id` (`id`);

--
-- Indexes for table `session_log`
--
ALTER TABLE `session_log`
  ADD KEY `id` (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_type`
--
ALTER TABLE `contact_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `firms`
--
ALTER TABLE `firms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `property_comments`
--
ALTER TABLE `property_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `session_log`
--
ALTER TABLE `session_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
