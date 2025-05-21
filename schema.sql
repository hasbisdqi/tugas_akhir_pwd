-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2025 at 07:51 AM
-- Server version: 8.0.42-0ubuntu0.24.04.1
-- PHP Version: 8.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ktp`
--

-- --------------------------------------------------------

--
-- Table structure for table `family_cards`
--

CREATE TABLE `family_cards` (
  `id` bigint NOT NULL,
  `kk_number` char(16) NOT NULL,
  `head_id` bigint DEFAULT NULL,
  `address` text,
  `subdistrict` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `family_cards`
--

INSERT INTO `family_cards` (`id`, `kk_number`, `head_id`, `address`, `subdistrict`, `district`, `city`, `province`) VALUES
(1, '3578132405780001', 1, 'Jl. Mawar No. 10, RT 05/RW 02', 'Sukamaju', 'Cilodong', 'Depok', 'Jawa Barat'),
(2, '3578132405780002', 5, 'Jl. Melati No. 12, RT 01/RW 01', 'Mekarjaya', 'Beji', 'Depok', 'Jawa Barat'),
(3, '3578132405780003', 8, 'Jl. Kenanga No. 5, RT 03/RW 04', 'Pancoran Mas', 'Pancoran Mas', 'Depok', 'Jawa Barat');

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `id` bigint NOT NULL,
  `nik` char(16) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` varchar(100) DEFAULT NULL,
  `family_card_id` bigint DEFAULT NULL,
  `relation` enum('Kepala Keluarga','Istri','Anak','Lainnya') NOT NULL,
  `gender` enum('L','P') NOT NULL,
  `father_id` bigint DEFAULT NULL,
  `mother_id` bigint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`id`, `nik`, `password`, `full_name`, `birth_date`, `birth_place`, `family_card_id`, `relation`, `gender`, `father_id`, `mother_id`) VALUES
(1, '3578132405780001', '', 'Budi Santoso (EDITED 1)', '1978-05-24', 'Jakarta', 1, 'Kepala Keluarga', 'L', NULL, NULL),
(2, '3578132405780002', NULL, 'Siti Rahayu', '1980-03-10', 'Jakarta', 1, 'Istri', 'P', NULL, NULL),
(3, '3578132405780003', NULL, 'Dimas Santoso', '2005-01-15', 'Depok', 1, 'Anak', 'L', 1, 2),
(4, '3578132405780004', NULL, 'Dewi Santoso', '2008-09-10', 'Depok', 1, 'Anak', 'P', 1, 2),
(5, '3578132405780005', NULL, 'Rudi Hartono', '1975-11-20', 'Bandung', 2, 'Kepala Keluarga', 'L', NULL, NULL),
(6, '3578132405780006', NULL, 'Maya Sari', '1977-07-05', 'Bandung', 2, 'Istri', 'P', NULL, NULL),
(7, '3578132405780007', NULL, 'Rina Hartono', '2003-04-12', 'Depok', 2, 'Anak', 'P', 5, 6),
(8, '3578132405780008', NULL, 'Ahmad Fadli', '1985-12-05', 'Surabaya', 3, 'Kepala Keluarga', 'L', NULL, NULL),
(9, '3578132405780009', NULL, 'Aminah Zahra', '1986-02-22', 'Surabaya', 3, 'Istri', 'P', NULL, NULL),
(10, '3578132405780010', 'password', 'Ali Fadli', '2010-08-01', 'Depok', 3, 'Anak', 'L', 8, 9),
(11, '3578132405780011', NULL, 'Aisyah Fadli', '2013-03-18', 'Depok', 3, 'Anak', 'P', 8, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff') DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin Utama', 'test@example.com', 'password', 'admin', '2025-05-18 07:58:11', '2025-05-20 09:48:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `family_cards`
--
ALTER TABLE `family_cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kk_number` (`kk_number`),
  ADD KEY `fk_head_of_family` (`head_id`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `family_card_id` (`family_card_id`),
  ADD KEY `father_id` (`father_id`),
  ADD KEY `mother_id` (`mother_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `family_cards`
--
ALTER TABLE `family_cards`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `family_cards`
--
ALTER TABLE `family_cards`
  ADD CONSTRAINT `fk_head_of_family` FOREIGN KEY (`head_id`) REFERENCES `residents` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `residents`
--
ALTER TABLE `residents`
  ADD CONSTRAINT `residents_ibfk_1` FOREIGN KEY (`family_card_id`) REFERENCES `family_cards` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `residents_ibfk_2` FOREIGN KEY (`father_id`) REFERENCES `residents` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `residents_ibfk_3` FOREIGN KEY (`mother_id`) REFERENCES `residents` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;