-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 17, 2025 at 03:43 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ramal`
--

-- --------------------------------------------------------

--
-- Table structure for table `akurasi`
--

CREATE TABLE `akurasi` (
  `id_akurasi` int NOT NULL,
  `metode_peramalan` varchar(50) NOT NULL,
  `mape` float NOT NULL,
  `mad` float NOT NULL,
  `mse` float NOT NULL,
  `kategori_mape` varchar(50) NOT NULL,
  `id_peramalan` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_siswa`
--

CREATE TABLE `data_siswa` (
  `id_siswa` int NOT NULL,
  `tahun` year NOT NULL,
  `jumlah_siswa` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `data_siswa`
--

INSERT INTO `data_siswa` (`id_siswa`, `tahun`, `jumlah_siswa`) VALUES
(13, 2015, 55),
(14, 2016, 60),
(15, 2017, 58),
(16, 2018, 65),
(17, 2019, 70),
(18, 2020, 68),
(19, 2021, 75),
(20, 2022, 72),
(21, 2023, 80),
(22, 2024, 78),
(23, 2025, 85);

-- --------------------------------------------------------

--
-- Table structure for table `peramalan`
--

CREATE TABLE `peramalan` (
  `id_peramalan` int NOT NULL,
  `id_siswa` int DEFAULT NULL,
  `tahun` year NOT NULL,
  `CF` float DEFAULT NULL,
  `SES` float DEFAULT NULL,
  `regresi_linier` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_token_created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `reset_token`, `reset_token_created_at`) VALUES
(1, 'ADMIN NURUL HUDA', 'maduratulent613@gmail.com', '$2y$12$LfXkfZLD4A1bW..7.sMneOBhmc96pfffS/jC2CEDDFT2cX4Z.bPt.', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akurasi`
--
ALTER TABLE `akurasi`
  ADD PRIMARY KEY (`id_akurasi`),
  ADD KEY `fk_akurasi_peramalan` (`id_peramalan`);

--
-- Indexes for table `data_siswa`
--
ALTER TABLE `data_siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `peramalan`
--
ALTER TABLE `peramalan`
  ADD PRIMARY KEY (`id_peramalan`),
  ADD KEY `id_siswa` (`id_siswa`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akurasi`
--
ALTER TABLE `akurasi`
  MODIFY `id_akurasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `data_siswa`
--
ALTER TABLE `data_siswa`
  MODIFY `id_siswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `peramalan`
--
ALTER TABLE `peramalan`
  MODIFY `id_peramalan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akurasi`
--
ALTER TABLE `akurasi`
  ADD CONSTRAINT `fk_akurasi_peramalan` FOREIGN KEY (`id_peramalan`) REFERENCES `peramalan` (`id_peramalan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peramalan`
--
ALTER TABLE `peramalan`
  ADD CONSTRAINT `peramalan_ibfk_2` FOREIGN KEY (`id_siswa`) REFERENCES `data_siswa` (`id_siswa`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
