-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 06:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penebusan_resep`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `id` int(11) NOT NULL,
  `nmr_resep` int(11) NOT NULL,
  `kode_obat` char(15) NOT NULL,
  `jumlah_obat` int(11) NOT NULL,
  `dosis` varchar(25) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `kode_dr` int(11) NOT NULL,
  `nama_dr` varchar(50) NOT NULL,
  `spesialis` varchar(50) NOT NULL,
  `alamat_dr` varchar(100) NOT NULL,
  `telepon_dr` int(13) NOT NULL,
  `kode_plk` char(11) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`kode_dr`, `nama_dr`, `spesialis`, `alamat_dr`, `telepon_dr`, `kode_plk`, `tarif`) VALUES
(1, 'Dr. Andi', 'Mata', 'Magelang', 85679356, 'PLK-001', 50000),
(2, 'Dr. Adit', 'Gigi', 'Semarang', 2147483647, 'PLK-004', 30000),
(3, 'Dr. Agus', 'THT', 'Bandongan', 857, 'PLK-002', 45000),
(4, 'Dr. Budi', 'Penyakit Dalam', 'Semarang', 12345678, 'PLK-003', 90000),
(5, 'Dr. Handoko', 'Penyakit Kulit', 'Magelang', 12345678, 'PLK-005', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_account` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_account`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `kode_obat` char(15) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `jenis_obat` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga_obat` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`kode_obat`, `nama_obat`, `jenis_obat`, `kategori`, `harga_obat`, `stok`) VALUES
('OB-001', 'Antangin', 'Obat Bebas', 'Masuk Angin', 1000, 13),
('OB-002', 'OBH', 'Obat Bebas', 'Flu', 15000, 0),
('OB-003', 'Bodrex', 'Obat Bebas', 'Pusing', 1000, 87),
('OB-004', 'Tolak Angin', 'Obat Herbal', 'Masuk Angin', 5000, 22);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `kode_psn` char(15) NOT NULL,
  `nama_psn` varchar(50) NOT NULL,
  `alamat_psn` varchar(100) NOT NULL,
  `gender_psn` enum('P','L') NOT NULL,
  `umur_psn` int(11) NOT NULL,
  `telepon_psn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`kode_psn`, `nama_psn`, `alamat_psn`, `gender_psn`, `umur_psn`, `telepon_psn`) VALUES
('PSN-001', 'Indah', 'Magelang', 'P', 18, 857076345),
('PSN-002', 'Tegar', 'Magelang', 'L', 16, 35637353),
('PSN-003', 'Hazel', 'Magelang', 'L', 17, 123333555);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `nmr_byr` int(11) NOT NULL,
  `nmr_pendaftaran` int(11) NOT NULL,
  `kode_psn` char(15) NOT NULL,
  `tgl_byr` date NOT NULL,
  `jumlah_byr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`nmr_byr`, `nmr_pendaftaran`, `kode_psn`, `tgl_byr`, `jumlah_byr`) VALUES
(1, 14, 'PSN-003', '2024-05-22', 87000),
(2, 10, 'PSN-002', '2024-05-22', 72000),
(6, 11, 'PSN-001', '2024-05-22', 65000);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `nmr_pendaftaran` int(11) NOT NULL,
  `tgl_pendaftaran` date NOT NULL,
  `kode_dr` int(11) NOT NULL,
  `kode_psn` char(15) NOT NULL,
  `kode_plk` char(11) NOT NULL,
  `biaya` int(11) NOT NULL,
  `status` enum('Antri','Berlangsung','Selesai') NOT NULL DEFAULT 'Antri',
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `poliklinik`
--

CREATE TABLE `poliklinik` (
  `kode_plk` char(11) NOT NULL,
  `nama_plk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `poliklinik`
--

INSERT INTO `poliklinik` (`kode_plk`, `nama_plk`) VALUES
('PLK-001', 'Mata'),
('PLK-002', 'THT'),
('PLK-003', 'Kanker'),
('PLK-004', 'Gigi'),
('PLK-005', 'Kulit');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `nmr_resep` int(11) NOT NULL,
  `nmr_pendaftaran` int(11) NOT NULL,
  `tgl_resep` date NOT NULL,
  `kode_dr` int(11) NOT NULL,
  `kode_psn` char(15) NOT NULL,
  `kode_plk` char(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembali` int(11) NOT NULL,
  `status` enum('Proses','Lunas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`kode_dr`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_account`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`kode_obat`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`kode_psn`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`nmr_byr`);

--
-- Indexes for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`nmr_pendaftaran`);

--
-- Indexes for table `poliklinik`
--
ALTER TABLE `poliklinik`
  ADD PRIMARY KEY (`kode_plk`);

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`nmr_resep`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `kode_dr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `nmr_byr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `nmr_pendaftaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resep`
--
ALTER TABLE `resep`
  MODIFY `nmr_resep` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
