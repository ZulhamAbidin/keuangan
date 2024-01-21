-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jan 2024 pada 21.02
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_keuangan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_admin`
--

CREATE TABLE `data_admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_admin`
--

INSERT INTO `data_admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES
(1, 'ZulhamAbidin', 'ZulhamAbidin', '9008721bb0b6d27971865d51873efcb2'),
(25, 'annisa septiani kamal', 'annisa septiani kama', '184dcc7b42b11a196ccf11ada15929c3'),
(26, 'annisa septiani kamal', 'annisa septiani kama', '184dcc7b42b11a196ccf11ada15929c3'),
(27, 'astriayuningsih', 'astriayuningsih', '6e22db09db418ea14e99a2d06df62045'),
(28, 'astriayuningsih', 'astriayuningsihh', '6e22db09db418ea14e99a2d06df62045');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_keluar`
--

CREATE TABLE `data_keluar` (
  `id_keluar` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `id_penggajian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_keluar`
--

INSERT INTO `data_keluar` (`id_keluar`, `tanggal_keluar`, `jumlah`, `keterangan`, `gambar`, `id_penggajian`) VALUES
(52, '2024-01-21', '10000000', 'Penggajian Karyawan: Muhammad Syaban Rahmatullah', 'gambar/data_penggajian/akte.jpg', 61),
(54, '2024-01-21', '100000', 'Penggajian Karyawan: Astriayuningsih', 'gambar/data_penggajian/50 Minimalist Desktop Wallpapers and Backgrounds (2022 Edition).jpeg', 62),
(56, '2024-01-21', '100000', 'Penggajian Karyawan: Astriayuningsih', 'gambar/data_penggajian/50 Minimalist Desktop Wallpapers and Backgrounds (2022 Edition).jpeg', 64),
(57, '2024-01-22', '11111', 'Penggajian Karyawan: 111', 'gambar/data_penggajian/kk.jpg', 65),
(58, '2024-02-06', '1000000', 'Penggajian Karyawan: 323', 'gambar/data_penggajian/50 Minimalist Desktop Wallpapers and Backgrounds (2022 Edition).jpeg', 66),
(64, '2024-01-22', '111111', '1111', 'gambar/data_keluar/_avatar’s love playing_.jpeg', NULL),
(65, '2024-01-22', '111111', '1111', 'gambar/data_keluar/_avatar’s love playing_.jpeg', NULL),
(66, '2024-02-08', '11111111', 'Penggajian Karyawan: 1212', 'gambar/data_penggajian/ktp.jpg', 67),
(67, '2024-02-02', '4333331', '32232', 'gambar/data_keluar/akte.jpg', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_masuk`
--

CREATE TABLE `data_masuk` (
  `id_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `keterangan` varchar(50) NOT NULL,
  `id_penjualan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_masuk`
--

INSERT INTO `data_masuk` (`id_masuk`, `tanggal_masuk`, `jumlah_masuk`, `gambar`, `keterangan`, `id_penjualan`) VALUES
(51, '2024-01-21', 23232, 'gambar/data_penjualan/50 Minimalist Desktop Wallpapers and Backgrounds (2022 Edition).jpeg', 'Transaksi Penjualan rtetr', 21),
(57, '2024-01-21', 11111, 'gambar/data_masuk/_avatar’s love playing_.jpeg', '1111', NULL),
(61, '2024-01-21', 12121, 'gambar/data_masuk/50 Minimalist Desktop Wallpapers and Backgrounds (2022 Edition).jpeg', '12121', NULL),
(63, '2024-01-21', 3800000, 'gambar/data_masuk/50 Minimalist Desktop Wallpapers and Backgrounds (2022 Edition).jpeg', 'lorem', NULL),
(64, '2024-01-21', 111111, 'gambar/data_penjualan/50 Minimalist Desktop Wallpapers and Backgrounds (2022 Edition).jpeg', 'Transaksi Penjualan 111111', 23),
(66, '2024-01-21', 111, 'gambar/data_masuk/screencapture-psm-unm-2023-12-14-00_42_33.png', '1111', NULL),
(68, '2024-01-21', 1111111, 'gambar/data_penjualan/kk.jpg', 'Transaksi Penjualan 11111111', 26),
(70, '1970-01-01', 2, 'gambar/data_penjualan/avatar-the-last-airbender-tv-shows-netflix-hd-wallpaper-preview.jpg', 'B', 28),
(71, '2024-01-22', 11111, 'gambar/data_penjualan/_avatar’s love playing_.jpeg', 'Transaksi Penjualan 12121', 29),
(72, '2024-02-01', 232323, 'gambar/data_masuk/_avatar’s love playing_.jpeg', '232323', NULL),
(73, '2024-02-10', 2222222, 'gambar/data_penjualan/50 Minimalist Desktop Wallpapers and Backgrounds (2022 Edition).jpeg', 'Transaksi Penjualan 3232', 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penggajian`
--

CREATE TABLE `data_penggajian` (
  `id_penggajian` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `tanggal_gaji` date NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `banyak_gaji` varchar(20) NOT NULL,
  `gambar` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_penggajian`
--

INSERT INTO `data_penggajian` (`id_penggajian`, `nip`, `tanggal_gaji`, `nama_karyawan`, `banyak_gaji`, `gambar`) VALUES
(61, 1929042001, '2024-01-21', 'Muhammad Syaban Rahmatullah', '10000000', 'gambar/data_penggajian/akte.jpg'),
(62, 1929042028, '2024-01-21', 'Astriayuningsih', '100000', 'gambar/data_penggajian/50 Minimalist Desktop Wallpapers and Backgrounds (2022 Edition).jpeg'),
(64, 12121, '2024-01-21', 'Astriayuningsih', '100000', 'gambar/data_penggajian/50 Minimalist Desktop Wallpapers and Backgrounds (2022 Edition).jpeg'),
(65, 12121, '2024-01-22', '111', '11111', 'gambar/data_penggajian/kk.jpg'),
(66, 232, '2024-02-06', '323', '1000000', 'gambar/data_penggajian/50 Minimalist Desktop Wallpapers and Backgrounds (2022 Edition).jpeg'),
(67, 2121, '2024-02-08', '1212', '11111111', 'gambar/data_penggajian/ktp.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_penjualan`
--

CREATE TABLE `data_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal_jual` date NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `jumlah_jual` varchar(50) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_penjualan`
--

INSERT INTO `data_penjualan` (`id_penjualan`, `tanggal_jual`, `nama_barang`, `jumlah_jual`, `gambar`) VALUES
(21, '2024-01-21', 'rtetr', '23232', 'gambar/data_penjualan/50 Minimalist Desktop Wallpapers and Backgrounds (2022 Edition).jpeg'),
(22, '2024-01-21', '354', '33333', 'gambar/data_penjualan/kk.jpg'),
(23, '2024-01-21', '111111', '111111', 'gambar/data_penjualan/50 Minimalist Desktop Wallpapers and Backgrounds (2022 Edition).jpeg'),
(25, '1970-01-01', 'AYU', '111111', 'gambar/data_penjualan/avatar-the-last-airbender-tv-shows-netflix-hd-wallpaper-preview.jpg'),
(26, '2024-01-21', '11111111', '1111111', 'gambar/data_penjualan/kk.jpg'),
(27, '1970-01-01', 'OKESIHA', '2800000', 'gambar/data_penjualan/profile.jpg'),
(28, '1970-01-01', 'B', '2', 'gambar/data_penjualan/avatar-the-last-airbender-tv-shows-netflix-hd-wallpaper-preview.jpg'),
(29, '2024-01-22', '12121', '11111', 'gambar/data_penjualan/_avatar’s love playing_.jpeg'),
(30, '2024-02-10', '3232', '2222222', 'gambar/data_penjualan/50 Minimalist Desktop Wallpapers and Backgrounds (2022 Edition).jpeg');

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
  ADD PRIMARY KEY (`id_keluar`),
  ADD KEY `id_penggajian` (`id_penggajian`);

--
-- Indeks untuk tabel `data_masuk`
--
ALTER TABLE `data_masuk`
  ADD PRIMARY KEY (`id_masuk`),
  ADD KEY `id_penjualan` (`id_penjualan`),
  ADD KEY `id_penjualan_2` (`id_penjualan`);

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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `data_keluar`
--
ALTER TABLE `data_keluar`
  MODIFY `id_keluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `data_masuk`
--
ALTER TABLE `data_masuk`
  MODIFY `id_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT untuk tabel `data_penggajian`
--
ALTER TABLE `data_penggajian`
  MODIFY `id_penggajian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `data_penjualan`
--
ALTER TABLE `data_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_keluar`
--
ALTER TABLE `data_keluar`
  ADD CONSTRAINT `data_keluar_ibfk_1` FOREIGN KEY (`id_penggajian`) REFERENCES `data_penggajian` (`id_penggajian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `data_masuk`
--
ALTER TABLE `data_masuk`
  ADD CONSTRAINT `data_masuk_ibfk_1` FOREIGN KEY (`id_penjualan`) REFERENCES `data_penjualan` (`id_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
