-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2023 at 11:38 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengiriman`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_barang` int(11) NOT NULL,
  `jenis_barang` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_barang`, `jenis_barang`) VALUES
(2, 'Perlengkapan Kerja'),
(44, 'Bahan Kimia'),
(45, 'Mainan Anak'),
(47, 'Mainan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_layanan`
--

CREATE TABLE `tb_layanan` (
  `id_layanan` int(11) NOT NULL,
  `jenis_layanan` varchar(125) NOT NULL,
  `harga_layanan` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_layanan`
--

INSERT INTO `tb_layanan` (`id_layanan`, `jenis_layanan`, `harga_layanan`) VALUES
(2, 'Express', 50000),
(3, 'Super Send', 90000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(10) NOT NULL,
  `nama_pengirim` varchar(36) NOT NULL,
  `nama_penerima` varchar(36) NOT NULL,
  `alamat_pengirim` varchar(125) NOT NULL,
  `alamat_penerima` varchar(125) NOT NULL,
  `tlp_pengirim` varchar(13) NOT NULL,
  `tlp_penerima` varchar(125) NOT NULL,
  `nama_barang` varchar(125) NOT NULL,
  `jenis_barang` varchar(125) NOT NULL,
  `layanan` varchar(125) NOT NULL,
  `harga_layanan` float NOT NULL,
  `tgl_pengiriman` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `id_transaksi`, `nama_pengirim`, `nama_penerima`, `alamat_pengirim`, `alamat_penerima`, `tlp_pengirim`, `tlp_penerima`, `nama_barang`, `jenis_barang`, `layanan`, `harga_layanan`, `tgl_pengiriman`) VALUES
(74, 'pgr-260923', 'Selly', 'Jaka', 'Perth', 'bandung', '4534534', '3423432', 'dsdasd', 'Mainan', 'Super Express', 100000, '0000-00-00'),
(76, 'pgr-260923', 'john', 'ronald', 'jakarta', 'bandung', '4534534', '3423432', 'dsdasd', 'Mainan', 'Super Express', 100000, '0000-00-00'),
(77, 'pgr-260923', 'gerry', 'ronald', 'jakarta', 'new york', '4534534', '3423432', 'dsdasd', 'Mainan', 'Super Express', 100000, '0000-00-00'),
(78, 'pgr-260923', 'GERALD', 'ronald', 'jakarta', 'bandung', '4534534', '3423432', 'dsdasd', 'Mainan', 'Super Express', 100000, '0000-00-00'),
(737, 'agr-260923', 'Joko', 'Jaka', 'jakarta', 'bandung', '4534534', '3423432', 'dsdasd', 'Perlengkapan Sekolah', 'Express', 50000, '0000-00-00'),
(738, 'pgr-260923', 'GERALD', 'ronald', 'london', 'bandung', '2303920', '3423432', 'dsdasd', 'Perlengkapan Sekolah', 'Express', 50000, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(28) NOT NULL,
  `username` varchar(28) NOT NULL,
  `password` varchar(12) NOT NULL,
  `level` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Admin Satu', 'admin1', 'admin1', 'admin'),
(2, 'Petugas Satu', 'petugas1', 'petugas1', 'petugas'),
(8, 'alpha', 'alpha', 'alpha123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `tb_layanan`
--
ALTER TABLE `tb_layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tb_layanan`
--
ALTER TABLE `tb_layanan`
  MODIFY `id_layanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=739;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
