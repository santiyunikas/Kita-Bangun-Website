-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Nov 2018 pada 17.56
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kitabangun`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `donasi`
--

CREATE TABLE `donasi` (
  `ID_MEMBER` int(11) NOT NULL,
  `NAMA` varchar(100) DEFAULT NULL,
  `ID_DONASI` int(11) NOT NULL,
  `NOMINAL` varchar(100) NOT NULL,
  `TERKUMPUL` varchar(100) NOT NULL,
  `WAKTU_BERAKHIR` datetime DEFAULT NULL,
  `JUDUL_DONASI` varchar(1000) DEFAULT NULL,
  `ALAMAT` varchar(1000) DEFAULT NULL,
  `NOMOR_TLP` varchar(100) DEFAULT NULL,
  `DESKRIPSI` text,
  `FOTO_LOKASI` varchar(100) DEFAULT NULL,
  `STATUS_DONASI` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `ID_MEMBER` int(11) NOT NULL,
  `NAMA` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`ID_MEMBER`, `NAMA`, `PASSWORD`, `EMAIL`) VALUES
(11, 'KrisnA', '98765', 'wahyu@gmail.com'),
(104, 'Krisna Wahyu Aji Kusuma', '12345', 'krisna@gmail.com'),
(222, 'Krisna', 'krisnawahyu', 'krisnawahyuaji26071998@gmail.com'),
(363, 'Aji', '1928', 'aji@gmail.com'),
(826, 'Kusuma', 'qwerty', 'kusuma@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `ID_MEMBER` int(11) NOT NULL,
  `NAMA` varchar(100) DEFAULT NULL,
  `ID_DONASI` int(11) NOT NULL,
  `ID_BAYAR` int(11) NOT NULL,
  `NO_REKENING` varchar(100) NOT NULL,
  `NAMA_BANK` varchar(100) NOT NULL,
  `NOMINAL` varchar(100) NOT NULL,
  `WAKTU_TRANSAKSI` datetime NOT NULL,
  `BUKTI_BAYAR` varchar(100) DEFAULT NULL,
  `STATUS_BAYAR` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `donasi`
--
ALTER TABLE `donasi`
  ADD PRIMARY KEY (`ID_DONASI`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`ID_MEMBER`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`ID_BAYAR`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
