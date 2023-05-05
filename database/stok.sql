-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Mar 2023 pada 11.41
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stok`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga_beli_barang` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `tgl_beli` date DEFAULT NULL,
  `expired` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_beli_barang`, `harga_jual`, `jumlah_stok`, `tgl_beli`, `expired`) VALUES
(1, 'Wafello Choco Blast', 10000, 12000, 43, '2021-07-05', '2022-07-06'),
(2, 'Majestic White Choffe', 10000, 12000, 43, '2021-07-08', '2022-07-06'),
(4, 'VIOLA', 500, 1000, 0, '2021-07-06', '2022-07-07'),
(5, 'HIT-MAT', 15000, 17000, 30, '2021-07-08', '2022-07-08'),
(6, 'nabati Ahh', 20000, 22000, 44, '2021-07-08', '2022-09-09'),
(7, 'AIM3', 500, 1000, 0, '2021-07-12', '2022-07-25'),
(8, 'TELOR', 30000, 40000, 9, '2021-08-25', '2021-08-31'),
(9, 'JASKDJK', 69990, 90000, 89, '2021-08-25', '2021-08-25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori_ambil_laba`
--

CREATE TABLE `histori_ambil_laba` (
  `id_hal` int(11) NOT NULL,
  `tgl_ambil` datetime NOT NULL,
  `laba_diambil` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `ket` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `histori_ambil_laba`
--

INSERT INTO `histori_ambil_laba` (`id_hal`, `tgl_ambil`, `laba_diambil`, `sisa`, `ket`) VALUES
(5, '2022-01-13 11:31:33', 10000, 58000, 'JAJAN CILOR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laba`
--

CREATE TABLE `laba` (
  `id_laba` int(1) NOT NULL,
  `total_laba` int(11) NOT NULL,
  `updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laba`
--

INSERT INTO `laba` (`id_laba`, `total_laba`, `updated`) VALUES
(1, 124910, '2022-01-13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `struk`
--

CREATE TABLE `struk` (
  `id_struk` varchar(50) NOT NULL,
  `tgl` datetime NOT NULL,
  `total_harga` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `tunai` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `laba` int(11) NOT NULL,
  `laba_real` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `struk`
--

INSERT INTO `struk` (`id_struk`, `tgl`, `total_harga`, `diskon`, `tunai`, `kembalian`, `laba`, `laba_real`) VALUES
('struk202107251246', '2020-07-25 17:52:24', 46000, 2000, 50000, 6000, 4000, 6000),
('struk202107251359', '2021-06-25 19:00:02', 92000, 2000, 100000, 10000, 10000, 12000),
('struk202107251402', '2021-07-25 19:45:33', 88000, 2000, 100000, 14000, 16000, 18000),
('struk202107251404', '2021-07-25 19:41:37', 84000, 2000, 100000, 18000, 22000, 24000),
('struk202107260938', '2021-07-26 14:38:33', 65000, 2000, 70000, 7000, 8000, 10000),
('struk202107260939', '2021-07-26 14:39:47', 20000, 2000, 20000, 2000, 8000, 10000),
('struk202201130532', '2022-01-13 11:32:37', 10000, 0, 0, 0, 5000, 5000),
('struk202201170750', '2022-01-17 13:50:36', 10000, 1000, 20000, 11000, 4000, 5000),
('struk202212181343', '2022-12-18 19:44:15', 234000, 100, 1000000, 766100, 43910, 44010),
('struk202302181445', '2023-02-18 20:45:21', 136000, 2000, 140000, 6000, 14000, 16000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_penjualan`
--

CREATE TABLE `transaksi_penjualan` (
  `id_transaksi_penjualan` int(11) NOT NULL,
  `id_struk` varchar(30) NOT NULL,
  `tgl_terjual` date NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `laba` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_penjualan`
--

INSERT INTO `transaksi_penjualan` (`id_transaksi_penjualan`, `id_struk`, `tgl_terjual`, `id_barang`, `harga_jual`, `jumlah_barang`, `total_harga`, `laba`) VALUES
(1, 'struk202107251246', '2020-07-25', 2, 12000, 1, 12000, 2000),
(2, 'struk202107251246', '2020-07-25', 6, 22000, 1, 22000, 2000),
(3, 'struk202107251246', '2020-07-25', 1, 12000, 1, 12000, 2000),
(4, 'struk202107251359', '2021-06-25', 2, 12000, 2, 24000, 4000),
(5, 'struk202107251359', '2021-06-25', 6, 22000, 2, 44000, 4000),
(6, 'struk202107251359', '2021-06-25', 1, 12000, 2, 24000, 4000),
(7, 'struk202107251402', '2021-07-24', 5, 17000, 4, 68000, 8000),
(8, 'struk202107251404', '2021-07-25', 7, 1000, 20, 20000, 10000),
(9, 'struk202107251404', '2021-07-25', 4, 1000, 20, 20000, 10000),
(10, 'struk202107251404', '2021-07-25', 6, 22000, 2, 44000, 4000),
(11, 'struk202107251402', '2021-07-25', 4, 1000, 20, 20000, 10000),
(12, 'struk202107260938', '2021-07-26', 5, 17000, 1, 17000, 2000),
(13, 'struk202107260938', '2021-07-26', 2, 12000, 2, 24000, 4000),
(14, 'struk202107260938', '2021-07-26', 1, 12000, 2, 24000, 4000),
(15, 'struk202107260939', '2021-07-26', 7, 1000, 10, 10000, 5000),
(16, 'struk202107260939', '2021-07-26', 4, 1000, 10, 10000, 5000),
(17, 'struk202201130532', '2022-01-13', 7, 1000, 10, 10000, 5000),
(18, 'struk202201170750', '2022-01-17', 7, 1000, 10, 10000, 5000),
(19, 'struk202201170750', '2022-01-17', 5, 17000, 5, 85000, 10000),
(20, 'struk202212181343', '2022-12-18', 5, 17000, 2, 34000, 4000),
(21, 'struk202212181343', '2022-12-18', 9, 90000, 1, 90000, 20010),
(22, 'struk202212181343', '2022-12-18', 2, 12000, 2, 24000, 4000),
(23, 'struk202212181343', '2022-12-18', 6, 22000, 1, 22000, 2000),
(24, 'struk202212181343', '2022-12-18', 8, 40000, 1, 40000, 10000),
(25, 'struk202212181343', '2022-12-18', 1, 12000, 2, 24000, 4000),
(26, 'struk202302181445', '2023-02-18', 5, 17000, 8, 136000, 16000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(4) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `title` varchar(20) NOT NULL,
  `img` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `title`, `img`) VALUES
(6, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'user.png'),
(8, '18.14.1.0060', '29edf5efe303969aa7bd7e3a9bc546bb', 'Raihan WN', 'user.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `histori_ambil_laba`
--
ALTER TABLE `histori_ambil_laba`
  ADD PRIMARY KEY (`id_hal`);

--
-- Indeks untuk tabel `laba`
--
ALTER TABLE `laba`
  ADD PRIMARY KEY (`id_laba`);

--
-- Indeks untuk tabel `struk`
--
ALTER TABLE `struk`
  ADD PRIMARY KEY (`id_struk`);

--
-- Indeks untuk tabel `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  ADD PRIMARY KEY (`id_transaksi_penjualan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `histori_ambil_laba`
--
ALTER TABLE `histori_ambil_laba`
  MODIFY `id_hal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `laba`
--
ALTER TABLE `laba`
  MODIFY `id_laba` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi_penjualan`
--
ALTER TABLE `transaksi_penjualan`
  MODIFY `id_transaksi_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
