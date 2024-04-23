-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 11:47 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_data_masyarakat`
--

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `nama_kecamatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `nama_kecamatan`) VALUES
(1, 'Andir'),
(2, 'Antapani'),
(3, 'Arcamanik'),
(4, 'Astanaanyar'),
(5, 'Babakan Ciparay'),
(6, 'Bandung Kidul'),
(7, 'Bandung Kulon'),
(8, 'Bandung Wetan'),
(9, 'Batununggal'),
(10, 'Bojongloa Kaler'),
(11, 'Bojongloa Kidul'),
(12, 'Buahbatu'),
(13, 'Cibeunying Kaler'),
(14, 'Cibeunying Kidul'),
(15, 'Cibiru'),
(16, 'Cicendo'),
(17, 'Cidadap'),
(18, 'Cinambo'),
(19, 'Coblong'),
(20, 'Gedebage'),
(21, 'Kiaracondong'),
(22, 'Lengkong'),
(23, 'Mandalajati'),
(24, 'Panyileukan'),
(25, 'Rancasari'),
(26, 'Regol'),
(27, 'Sukajadi'),
(28, 'Sukasari'),
(29, 'Sumur Bandung'),
(30, 'Ujungberung');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id_penduduk` int(11) NOT NULL,
  `nama_penduduk` varchar(255) NOT NULL,
  `nik_penduduk` varchar(255) NOT NULL,
  `foto_penduduk` varchar(255) DEFAULT NULL,
  `id_kecamatan` int(11) DEFAULT NULL,
  `id_penghasilan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `nama_penduduk`, `nik_penduduk`, `foto_penduduk`, `id_kecamatan`, `id_penghasilan`) VALUES
(20, 'Aldi Rizky', '3273131232130002', 'srm.jpg', 17, 2);

-- --------------------------------------------------------

--
-- Table structure for table `penghasilan`
--

CREATE TABLE `penghasilan` (
  `id_penghasilan` int(11) NOT NULL,
  `jumlah_penghasilan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penghasilan`
--

INSERT INTO `penghasilan` (`id_penghasilan`, `jumlah_penghasilan`) VALUES
(1, '1jt - 5jt'),
(2, '5jt - 10jt'),
(3, '10jt - 20jt'),
(4, '20jt - 50jt'),
(6, 'lainnya');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_penduduk`),
  ADD KEY `id_kecamatan` (`id_kecamatan`),
  ADD KEY `id_penghasilan` (`id_penghasilan`);

--
-- Indexes for table `penghasilan`
--
ALTER TABLE `penghasilan`
  ADD PRIMARY KEY (`id_penghasilan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_penduduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `penghasilan`
--
ALTER TABLE `penghasilan`
  MODIFY `id_penghasilan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `penduduk_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id_kecamatan`),
  ADD CONSTRAINT `penduduk_ibfk_2` FOREIGN KEY (`id_penghasilan`) REFERENCES `penghasilan` (`id_penghasilan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
