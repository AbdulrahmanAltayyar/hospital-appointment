-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03 فبراير 2025 الساعة 16:55
-- إصدار الخادم: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_db`
--

-- --------------------------------------------------------

--
-- بنية الجدول `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `time_slot` datetime NOT NULL,
  `status` varchar(20) DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `user_id`, `doctor_id`, `time_slot`, `status`, `created_at`) VALUES
(1, 1, 1, '2025-02-10 09:00:00', 'canceled', '2025-01-27 23:13:08'),
(2, 2, 2, '2025-02-10 08:00:00', 'active', '2025-01-27 23:13:08'),
(3, 3, 3, '2025-02-11 09:30:00', 'canceled', '2025-01-27 23:13:08'),
(4, 4, 4, '2025-02-12 10:00:00', 'active', '2025-01-27 23:13:08'),
(5, 5, 5, '2025-02-13 09:00:00', 'active', '2025-01-27 23:13:08'),
(6, 6, 6, '2025-02-14 12:00:00', 'active', '2025-01-27 23:13:08'),
(11, 1, 1, '2025-01-27 23:18:00', 'active', '2025-01-27 23:18:23'),
(12, 1, 7, '2025-01-27 23:18:00', 'canceled', '2025-01-27 23:18:39'),
(13, 1, 7, '2025-01-09 23:18:00', 'active', '2025-01-27 23:20:28'),
(14, 1, 8, '2025-01-27 23:20:00', 'active', '2025-01-27 23:21:01'),
(15, 1, 7, '2025-01-27 23:21:00', 'active', '2025-01-27 23:21:28'),
(16, 1, 9, '2025-01-27 23:21:00', 'active', '2025-01-27 23:21:47'),
(17, 1, 8, '2025-01-27 23:22:00', 'canceled', '2025-01-27 23:22:05'),
(18, 2, 3, '2025-02-03 18:46:00', 'canceled', '2025-02-03 18:46:51');

-- --------------------------------------------------------

--
-- بنية الجدول `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `specialty` varchar(100) NOT NULL,
  `available_slots` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `name`, `specialty`, `available_slots`) VALUES
(1, 'Dr. Saleh Al-Zahrani', 'Cardiology', '[\"9:00AM\",\"10:00AM\",\"2:00PM\"]'),
(2, 'Dr. Layla Al-Fahad', 'Dermatology', '[\"8:00AM\",\"1:00PM\",\"4:00PM\"]'),
(3, 'Dr. Fahad Al-Nasser', 'Pediatrics', '[\"9:30AM\",\"11:00AM\",\"3:00PM\"]'),
(4, 'Dr. Reem Al-Shehri', 'Orthopedics', '[\"10:00AM\",\"1:30PM\",\"5:00PM\"]'),
(5, 'Dr. Bandar Al-Malki', 'Neurology', '[\"9:00AM\",\"10:30AM\",\"2:30PM\"]'),
(6, 'Dr. Samirah Al-Khaled', 'Gynecology', '[\"8:00AM\",\"12:00PM\",\"3:00PM\"]'),
(7, 'Dr. Turki Al-Sayari', 'Oncology', '[\"9:00AM\",\"2:00PM\",\"4:00PM\"]'),
(8, 'Dr. Mashael Al-Othman', 'Ophthalmology', '[\"10:00AM\",\"2:30PM\",\"5:00PM\"]'),
(9, 'Dr. Nayef Al-Mutlaq', 'General Surgery', '[\"8:30AM\",\"1:00PM\",\"3:30PM\"]'),
(10, 'Dr. Wafa Al-Hazmi', 'Endocrinology', '[\"9:15AM\",\"11:45AM\",\"2:15PM\"]');

-- --------------------------------------------------------

--
-- بنية الجدول `notification_preferences`
--

CREATE TABLE `notification_preferences` (
  `pref_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email_notifications` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `notification_preferences`
--

INSERT INTO `notification_preferences` (`pref_id`, `user_id`, `email_notifications`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 0),
(4, 4, 1),
(5, 5, 0),
(6, 6, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `reset_code` varchar(6) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `password_reset`
--

INSERT INTO `password_reset` (`id`, `email`, `reset_code`, `expires_at`) VALUES
(4, 'ahmed.almutairi@example.com', '8379', '2025-02-03 13:50:38'),
(5, 'ahmed.almutairi@gmail.com', '6305', '2025-02-03 14:42:56');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(1, 'ahmed_almutairi', '3333', 'ahmed.almutairi@gmail.com'),
(2, 'Abdulrahman', '2345', ' abdulrahmanad.el@gmail.com'),
(3, 'noura_alsaud', '3456', 'noura.alsaud@gmail.com'),
(4, 'abdullah_alrashid', '3212', 'abdullah.alrashid@gmail.com'),
(5, 'sara_alshammari', '5678', 'sara.alshammari@gmail.com'),
(6, 'khalid_alotaibi', '6789', 'khalid.alotaibi@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `fk_user` (`user_id`),
  ADD KEY `fk_doctor` (`doctor_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `notification_preferences`
--
ALTER TABLE `notification_preferences`
  ADD PRIMARY KEY (`pref_id`),
  ADD KEY `fk_user_pref` (`user_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notification_preferences`
--
ALTER TABLE `notification_preferences`
  MODIFY `pref_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `notification_preferences`
--
ALTER TABLE `notification_preferences`
  ADD CONSTRAINT `fk_user_pref` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
