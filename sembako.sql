-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Mar 2024 pada 08.46
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` int(11) NOT NULL,
  `id_transaksi` int(5) DEFAULT NULL,
  `id_item` int(5) NOT NULL,
  `jumlah_satuan` int(100) NOT NULL,
  `total_per_satuan` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `id_transaksi`, `id_item`, `jumlah_satuan`, `total_per_satuan`) VALUES
(31, 30, 6, 2, 100000),
(32, 31, 6, 2, 140000),
(33, 31, 7, 3, 30000),
(34, 32, 8, 1, 550000),
(35, 33, 8, 5, 2750000),
(36, 34, 9, 6, 15000),
(37, 35, 8, 2, 1100000),
(38, 35, 9, 4, 14000),
(39, 36, 8, 3, 1740000),
(40, 36, 9, 2, 6000),
(41, 37, 8, 2, 1160000),
(42, 37, 9, 2, 5000),
(43, 38, 8, 2, 1100000),
(44, 38, 9, 1, 3500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `item`
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
-- Dumping data untuk tabel `item`
--

INSERT INTO `item` (`id_item`, `kategori_id`, `nama_item`, `merk`, `jenis_satuan`, `jumlah_satuan`, `isi_satuan`, `harga_beli`, `harga_jual`, `harga_jual2`, `harga_jual3`, `total_dibeli`) VALUES
(6, 6, 'bubur ayam', NULL, 'pack', 72, '50', 50000, 70000, 75000, 78000, 80),
(7, 6, 'ciki', NULL, 'dus', 27, '50', 9000, 10000, 11000, 12000, 30),
(8, 8, 'Teh Pucuk', NULL, 'Dus', 3, '24', 500000, 550000, 560000, 580000, 18),
(9, 8, 'Teh Pucuk botol', NULL, 'botol', 5, '10', 2000, 2500, 3000, 3500, 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `tanggal`) VALUES
(6, 'Makanan', '2024-03-13'),
(8, 'Minuman', '2024-03-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `diskon` int(2) DEFAULT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id`, `nama`, `diskon`, `alamat`, `nomor`) VALUES
(6, 'azky', 15, 'jl sultan agung', '01111111'),
(7, 'adi', 0, 'jl sultan agung', '087345353345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `opname`
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
-- Dumping data untuk tabel `opname`
--

INSERT INTO `opname` (`id_opname`, `id_item`, `stok_opname`, `balance`, `keterangan`, `tanggal`) VALUES
(8, 1, 10, 'Deskripsi opname', 'Keterangan opname', '2024-03-13'),
(24, 8, 12, 'Lebih 3', 'bonus', '2024-03-23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nomor` varchar(13) NOT NULL,
  `alamat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sales`
--

INSERT INTO `sales` (`id`, `nama`, `nomor`, `alamat`) VALUES
(3, 'Sales C', '087234723468', 'Jl Melatii'),
(4, 'Sales A', '085675756555', 'Jl Mawar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
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
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `no_transaksi`, `tanggal`, `nama_pelanggan`, `total_harga`, `diskon`, `uang_terima`, `kembalian`, `keterangan`) VALUES
(30, 'TR23227232', '2024-02-08', 'adi', 90000, 10, 100000, 10000.00, 'dfsfsdfsf'),
(31, 'TR13622229', '2024-03-13', 'adi', 153000, 10, 160000, 7000.00, 'dsdfsd'),
(32, 'TR18736986', '2024-03-23', 'adi', 495000, 10, 550000, 55000.00, 'Terima'),
(33, 'TR14670101', '2024-01-02', 'budi', 2750000, 0, 5500000, 2750000.00, 'dhfdfgrgdgfg'),
(34, 'TR17381027', '2024-03-24', 'budi', 15000, 0, 550000, 535000.00, 'ghgfhfh'),
(35, 'TR73515861', '2024-03-24', 'budi', 1114000, 0, 2000000, 886000.00, 'retdfgdfse'),
(36, 'TR15513388', '2024-03-24', 'adi', 1746000, 0, 5500000, 3754000.00, 'Toni'),
(37, 'TR81978546', '2024-03-24', 'azky', 1165000, 0, 2000000, 835000.00, 'Sales A'),
(38, 'TR74084467', '2024-03-24', 'adi', 1103500, 0, 2000000, 896500.00, 'Sales A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_users` int(5) NOT NULL,
  `username` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_users`, `username`, `role`, `password`) VALUES
(1, 'admin', 'Admin', 'admin'),
(2, 'kasir', 'Kasir', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`);

--
-- Indeks untuk tabel `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `opname`
--
ALTER TABLE `opname`
  ADD PRIMARY KEY (`id_opname`),
  ADD KEY `id_item` (`id_item`);

--
-- Indeks untuk tabel `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `opname`
--
ALTER TABLE `opname`
  MODIFY `id_opname` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
