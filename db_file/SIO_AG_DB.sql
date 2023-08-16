-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 16, 2023 at 04:31 PM
-- Server version: 8.0.33-0ubuntu0.22.04.4
-- PHP Version: 8.1.2-1ubuntu2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SIO_AG_DB`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2023_08_16_081652_create_timelogs_table', 1),
(2, '2023_08_16_123812_create_projects_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint UNSIGNED NOT NULL,
  `project_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `created_at`, `updated_at`) VALUES
(1, 'project 1', '2023-08-16 11:32:58', '2023-08-16 11:32:58'),
(2, 'project 2', '2023-08-16 11:33:47', '2023-08-16 11:33:47'),
(3, 'project 3', '2023-08-16 11:41:33', '2023-08-16 11:41:33');

-- --------------------------------------------------------

--
-- Table structure for table `timelogs`
--

CREATE TABLE `timelogs` (
  `id` bigint UNSIGNED NOT NULL,
  `project_id` bigint UNSIGNED NOT NULL,
  `task_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time_task` datetime NOT NULL,
  `end_time_task` datetime DEFAULT NULL,
  `working_hours` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timelogs`
--

INSERT INTO `timelogs` (`id`, `project_id`, `task_title`, `start_time_task`, `end_time_task`, `working_hours`, `created_at`, `updated_at`) VALUES
(1, 1, 'Task title 0', '2023-08-14 07:37:44', '2023-08-14 11:40:05', 4, '2023-08-14 09:37:44', '2023-08-16 12:19:01'),
(3, 1, 'Task title 1', '2023-08-15 08:25:20', '2023-08-15 12:27:04', 4, '2023-08-15 06:25:20', '2023-08-16 08:27:34'),
(4, 1, 'Task title 2', '2023-07-16 08:34:02', '2023-07-16 16:34:05', 8, '2023-07-16 06:34:02', '2023-08-16 08:34:34'),
(5, 2, 'Task title 3', '2023-07-10 10:34:50', '2023-07-10 14:34:51', 4, '2023-07-10 08:34:50', '2023-08-16 08:35:16'),
(6, 3, 'Task title 4', '2023-06-19 11:35:51', '2023-06-19 18:35:53', 7, '2023-06-19 09:35:51', '2023-08-16 08:36:35'),
(7, 1, 'Task title 5', '2023-06-08 12:36:59', '2023-06-08 17:37:01', 5, '2023-06-08 10:36:59', '2023-08-16 08:37:39'),
(8, 3, 'Task title 6', '2023-05-09 08:38:00', '2023-05-09 18:38:02', 10, '2023-05-09 06:38:00', '2023-08-16 08:39:23'),
(9, 2, 'Task 12', '2023-08-16 16:05:44', '2023-08-16 16:06:03', 0, '2023-08-16 14:05:44', '2023-08-16 14:06:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timelogs`
--
ALTER TABLE `timelogs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `timelogs`
--
ALTER TABLE `timelogs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
