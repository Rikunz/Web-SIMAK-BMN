-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Nov 2022 pada 01.33
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `faculty`
--

INSERT INTO `faculty` (`id`, `name`) VALUES
(7, 'FAKULTAS SAINS DAN TEKNOLOGI'),
(8, 'FAKULTAS ILMU TARBIYAH DAN KEGURUAN'),
(11, 'FAKULTAS ADAB DAN ILMU BUDAYA'),
(12, 'FAKULTAS EKONOMI DAN BISNIS ISLAM'),
(13, 'FAKULTAS USHULUDDIN DAN PEMIKIRAN ISLAM'),
(14, 'FAKULTAS DAKWAH DAN KOMUNIKASI'),
(15, 'FAKULTAS ILMU SOSIAL DAN HUMANIORA'),
(16, 'FAKULTAS SYARI’AH DAN HUKUM'),
(17, 'PASCASARJANA'),
(18, 'UPT PUSAT PERPUSTAKAAN'),
(19, 'UPT PUSAT PENGEMBANGAN BAHASA'),
(20, 'UPT PUSAT PENGEMBANGAN BISNIS'),
(21, 'UPT PUSAT PTIPD'),
(22, 'LP2M'),
(23, 'ADMISI'),
(24, 'LPM'),
(25, 'SPI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `cratedAt` datetime DEFAULT current_timestamp(),
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `facultyId` int(11) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `room` varchar(255) NOT NULL,
  `roomId` int(11) DEFAULT NULL,
  `user` varchar(255) NOT NULL,
  `condition` enum('Baik','Rusak Ringan','Rusak Berat') NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventory`
--

INSERT INTO `inventory` (`id`, `cratedAt`, `name`, `code`, `facultyId`, `faculty`, `amount`, `price`, `room`, `roomId`, `user`, `condition`, `note`) VALUES
(18, '2022-11-03 13:08:57', 'Kursi', 'INV-UINSuka-2022-001', 7, 'FAKULTAS SAINS DAN TEKNOLOGI', 50, '1000000', 'RUANG 103', 6, 'Mahasiswa', 'Baik', '2 Kursi rusak'),
(19, '2022-11-03 14:04:43', 'LCD', 'INV-UINSuka-2022-002', 7, 'FAKULTAS SAINS DAN TEKNOLOGI', 1, '15000000', 'RUANG 103', 6, 'Mahasiswa', 'Baik', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `facultyId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `room`
--

INSERT INTO `room` (`id`, `name`, `facultyId`) VALUES
(6, 'RUANG 103', 7),
(7, 'RUANG 104', 7),
(9, 'RUANG 304', 7),
(10, 'RUANG 305', 7),
(11, 'RUANG 306', 7),
(12, 'RUANG 401', 7),
(13, 'RUANG 402', 7),
(14, 'RUANG 403', 7),
(15, 'RUANG 405', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','OP') NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `facultyId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `createdAt`, `password`, `role`, `faculty`, `facultyId`) VALUES
(1, 'Admin', '2022-10-24 20:37:26', 'e3afed0047b08059d0fada10f400c1e5', 'Admin', 'FAKULTAS SAINS DAN TEKNOLOGI', 7);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facultyId` (`facultyId`),
  ADD KEY `roomId` (`roomId`);

--
-- Indeks untuk tabel `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facultyId` (`facultyId`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facultyId` (`facultyId`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`facultyId`) REFERENCES `faculty` (`id`),
  ADD CONSTRAINT `inventory_ibfk_2` FOREIGN KEY (`roomId`) REFERENCES `room` (`id`);

--
-- Ketidakleluasaan untuk tabel `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_ibfk_1` FOREIGN KEY (`facultyId`) REFERENCES `faculty` (`id`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`facultyId`) REFERENCES `faculty` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
