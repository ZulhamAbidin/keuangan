-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 18 Jul 2022 pada 05.36
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_admin`
--

CREATE TABLE `data_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_admin`
--

INSERT INTO `data_admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'Admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_keluar`
--

CREATE TABLE `data_keluar` (
  `id_keluar` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_keluar`
--

INSERT INTO `data_keluar` (`id_keluar`, `tanggal_keluar`, `jumlah`, `keterangan`) VALUES
(2, '2022-06-09', '1000000', 'Penggajian Karyawan'),
(3, '2022-06-17', '2000000', 'Pembayaran Hutang'),
(4, '2022-06-09', '900000', 'Penggajian Karyawan'),
(5, '2022-06-17', '700000', 'Penggajian Karyawan'),
(6, '2022-06-11', '1500000', 'Penggajian Karyawan'),
(7, '2022-06-12', '2500000', 'Penggajian Karyawan'),
(8, '2022-06-18', '900000', 'Penggajian Karyawan'),
(9, '2022-06-25', '1200000', 'Penggajian Karyawan'),
(10, '2022-07-02', '2000000', 'Penggajian Karyawan'),
(11, '2022-07-09', '1700000', 'Penggajian Karyawan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_masuk`
--

CREATE TABLE `data_masuk` (
  `id_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_masuk`
--

INSERT INTO `data_masuk` (`id_masuk`, `tanggal_masuk`, `jumlah_masuk`, `keterangan`) VALUES
(2, '2022-05-01', 200000, 'Transaksi Penjualan'),
(3, '2022-06-03', 20000, 'Pelunasan Hutang'),
(4, '2022-05-18', 1000000, 'Transaksi Penjualan'),
(8, '2022-06-05', 15000, 'Transaksi Penjualan teriyaki'),
(9, '2022-06-07', 17000, 'Transaksi Penjualan sayur asem + tempe'),
(10, '2022-06-08', 12000, 'Transaksi Penjualan nasi goreng'),
(11, '2022-06-10', 20000, 'Transaksi Penjualan nasi biasa + Ikan Lele'),
(12, '2022-06-14', 10000, 'Transaksi Penjualan nasi kuning'),
(13, '2022-06-15', 9000, 'Transaksi Penjualan ikan bakar'),
(14, '2022-06-17', 12000, 'Transaksi Penjualan usus goreng'),
(15, '2022-06-20', 15000, 'Transaksi Penjualan cumi-cumi kuah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penggajian`
--

CREATE TABLE `data_penggajian` (
  `id_penggajian` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `tanggal_gaji` date NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `banyak_gaji` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_penggajian`
--

INSERT INTO `data_penggajian` (`id_penggajian`, `nip`, `tanggal_gaji`, `nama_karyawan`, `banyak_gaji`) VALUES
(1, 120, '2022-05-30', 'Nafana ', '2500000'),
(2, 121, '2022-06-09', 'arif ', '1000000'),
(3, 122, '2022-06-17', 'ranto', '2000000'),
(4, 123, '2022-06-11', 'arnol', '1500000'),
(5, 124, '2022-06-12', 'baso irfan', '2500000'),
(6, 125, '2022-06-18', 'amar', '900000'),
(7, 126, '2022-06-25', 'raka', '1200000'),
(8, 127, '2022-07-02', 'megaria', '2000000'),
(9, 128, '2022-07-09', 'rasid', '1700000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penjualan`
--

CREATE TABLE `data_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal_jual` date NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah_jual` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `data_penjualan`
--

INSERT INTO `data_penjualan` (`id_penjualan`, `tanggal_jual`, `nama_barang`, `jumlah_jual`) VALUES
(1, '2022-06-01', 'ayam goreng + es teh', '20000'),
(3, '2022-06-03', 'sop ayam ', '20000'),
(4, '2022-06-05', 'teriyaki', '15000'),
(5, '2022-06-07', 'sayur asem + tempe', '17000'),
(6, '2022-06-08', 'nasi goreng', '12000'),
(7, '2022-06-10', 'nasi biasa + Ikan Lele', '20000'),
(8, '2022-06-14', 'nasi kuning', '10000'),
(9, '2022-06-15', 'ikan bakar', '9000'),
(10, '2022-06-17', 'usus goreng', '12000'),
(11, '2022-06-20', 'cumi-cumi kuah', '15000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_admin`
--
ALTER TABLE `data_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `data_keluar`
--
ALTER TABLE `data_keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indexes for table `data_masuk`
--
ALTER TABLE `data_masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indexes for table `data_penggajian`
--
ALTER TABLE `data_penggajian`
  ADD PRIMARY KEY (`id_penggajian`);

--
-- Indexes for table `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_admin`
--
ALTER TABLE `data_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `data_keluar`
--
ALTER TABLE `data_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `data_masuk`
--
ALTER TABLE `data_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `data_penggajian`
--
ALTER TABLE `data_penggajian`
  MODIFY `id_penggajian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `data_penjualan`
--
ALTER TABLE `data_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
