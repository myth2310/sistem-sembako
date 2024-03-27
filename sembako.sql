-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 05:52 AM
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
-- Database: `sembako`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `id_transaksi` int(5) DEFAULT NULL,
  `id_item` int(5) NOT NULL,
  `jumlah_satuan` int(100) NOT NULL,
  `total_per_satuan` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_item`, `jumlah_satuan`, `total_per_satuan`) VALUES
(52, 47, 10, 5, 600000),
(53, 48, 11, 2, 120000),
(54, 49, 11, 10, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `nama_item` varchar(255) NOT NULL,
  `merk` varchar(255) DEFAULT NULL,
  `jenis_satuan` varchar(50) DEFAULT NULL,
  `jumlah_satuan` int(11) DEFAULT NULL,
  `isi_satuan` varchar(50) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `harga_jual2` int(11) DEFAULT NULL,
  `harga_jual3` int(11) DEFAULT NULL,
  `total_dibeli` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `kategori_id`, `nama_item`, `merk`, `jenis_satuan`, `jumlah_satuan`, `isi_satuan`, `harga_beli`, `harga_jual`, `harga_jual2`, `harga_jual3`, `total_dibeli`) VALUES
(10, 9, 'Teh Pucuk', NULL, 'Dus', 95, 'Kosong', 100000, 120000, 10000, 0, 100),
(11, 9, 'Kapal Api', NULL, 'Dus', 38, 'Kosong', 50000, 60000, 5000, 0, 50);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `tanggal`) VALUES
(9, 'Minuman', '2024-03-27');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `diskon` int(2) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `nama`, `diskon`, `alamat`, `nomor`) VALUES
(10, 'adi', 0, 'Jl. Mawar', '085125456956'),
(11, 'azky', 0, 'Jl. Anggrek', '081254565552');

-- --------------------------------------------------------

--
-- Table structure for table `opname`
--

CREATE TABLE `opname` (
  `id_opname` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `stok_opname` int(11) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tanggal` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `opname`
--

INSERT INTO `opname` (`id_opname`, `id_item`, `stok_opname`, `balance`, `keterangan`, `tanggal`) VALUES
(25, 11, 100, 'Lebih 62', 'Bonus ', '2024-03-27'),
(26, 10, 95, 'Benar', 'Pass', '2024-03-27');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nomor` varchar(13) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `nama`, `nomor`, `alamat`) VALUES
(5, 'Sales A', '085455565854', 'Jl. Mawar');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `no_transaksi` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `total_harga` int(100) NOT NULL,
  `diskon` int(5) NOT NULL,
  `uang_terima` int(100) NOT NULL,
  `kembalian` decimal(10,2) DEFAULT NULL,
  `kurangan` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `tipe_pembayaran` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `no_transaksi`, `tanggal`, `nama_pelanggan`, `total_harga`, `diskon`, `uang_terima`, `kembalian`, `kurangan`, `keterangan`, `tipe_pembayaran`) VALUES
(47, 'TR12602447', '2024-03-27', 'adi', 600000, 0, 600000, 0.00, 0, 'Sales A', ''),
(48, 'TR97081546', '2024-03-27', 'adi', 120000, 0, 150000, 30000.00, 0, 'Sales A', ''),
(49, 'TR15810015', '2024-03-27', 'azky', 50000, 0, 50000, 0.00, 0, 'Sales A', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(5) NOT NULL,
  `username` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username`, `role`, `password`) VALUES
(1, 'admin', 'Admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opname`
--
ALTER TABLE `opname`
  ADD PRIMARY KEY (`id_opname`),
  ADD KEY `id_item` (`id_item`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `opname`
--
ALTER TABLE `opname`
  MODIFY `id_opname` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
