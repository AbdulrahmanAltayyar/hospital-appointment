-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28 يناير 2025 الساعة 14:37
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
(7, 7, 7, '2025-02-15 10:30:00', 'canceled', '2025-01-27 23:13:08'),
(8, 8, 8, '2025-03-01 14:00:00', 'active', '2025-01-27 23:13:08'),
(9, 9, 9, '2025-03-02 08:30:00', 'active', '2025-01-27 23:13:08'),
(10, 10, 10, '2025-03-05 09:15:00', 'active', '2025-01-27 23:13:08'),
(11, 1, 1, '2025-01-27 23:18:00', 'active', '2025-01-27 23:18:23'),
(12, 1, 7, '2025-01-27 23:18:00', 'canceled', '2025-01-27 23:18:39'),
(13, 1, 7, '2025-01-09 23:18:00', 'active', '2025-01-27 23:20:28'),
(14, 1, 8, '2025-01-27 23:20:00', 'active', '2025-01-27 23:21:01'),
(15, 1, 7, '2025-01-27 23:21:00', 'active', '2025-01-27 23:21:28'),
(16, 1, 9, '2025-01-27 23:21:00', 'active', '2025-01-27 23:21:47'),
(17, 1, 8, '2025-01-27 23:22:00', 'canceled', '2025-01-27 23:22:05');

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
(6, 6, 1),
(7, 7, 0),
(8, 8, 1),
(9, 9, 0),
(10, 10, 1);

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
(1, 'ahmed_almutairi', '1234', 'ahmed.almutairi@example.com'),
(2, 'mohammed_alqahtani', '2345', 'mohammed.alqahtani@example.com'),
(3, 'noura_alsaud', '3456', 'noura.alsaud@example.com'),
(4, 'abdullah_alrashid', '4567', 'abdullah.alrashid@example.com'),
(5, 'sara_alshammari', '5678', 'sara.alshammari@example.com'),
(6, 'khalid_alotaibi', '6789', 'khalid.alotaibi@example.com'),
(7, 'fatimah_alharbi', '1234', 'fatimah.alharbi@example.com'),
(8, 'hind_alfayez', '2345', 'hind.alfayez@example.com'),
(9, 'faisal_aljaber', '3456', 'faisal.aljaber@example.com'),
(10, 'mona_alghamdi', '4567', 'mona.alghamdi@example.com');

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
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
