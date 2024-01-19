-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2022 pada 15.05
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
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
(2, '2022-05-30', '2500000', 'Penggajian Karyawan'),
(3, '2022-05-01', '1000000', 'Pembayaran Hutang'),
(4, '2022-06-09', '900000', 'Penggajian Karyawan'),
(5, '2022-06-17', '700000', 'Penggajian Karyawan');

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
(3, '2022-05-18', 1000000, 'Pelunasan Hutang'),
(4, '2022-05-18', 1000000, 'Transaksi Penjualan'),
(7, '2022-06-03', 200000, 'Transaksi Penjualan AAAAAAA');

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
(1, 109090290, '2022-05-30', 'Nafana Channel', '2500000'),
(2, 1212121212, '2022-06-09', 'ewew', '900000'),
(3, 9, '2022-06-17', 'mm', '700000');

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
(1, '2022-05-01', 'A', '200000'),
(3, '2022-06-03', 'AAAAAAA', '200000');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_admin`
--
ALTER TABLE `data_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `data_keluar`
--
ALTER TABLE `data_keluar`
  ADD PRIMARY KEY (`id_keluar`);

--
-- Indeks untuk tabel `data_masuk`
--
ALTER TABLE `data_masuk`
  ADD PRIMARY KEY (`id_masuk`);

--
-- Indeks untuk tabel `data_penggajian`
--
ALTER TABLE `data_penggajian`
  ADD PRIMARY KEY (`id_penggajian`);

--
-- Indeks untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_admin`
--
ALTER TABLE `data_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `data_keluar`
--
ALTER TABLE `data_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `data_masuk`
--
ALTER TABLE `data_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `data_penggajian`
--
ALTER TABLE `data_penggajian`
  MODIFY `id_penggajian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
