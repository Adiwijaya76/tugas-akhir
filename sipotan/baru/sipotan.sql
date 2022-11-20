-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jan 2022 pada 02.28
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipotan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `asosiasi_kab`
--

CREATE TABLE `asosiasi_kab` (
  `id` char(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tanggal_berdiri` date NOT NULL,
  `nomor_legalitas` char(20) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `alamat` text NOT NULL,
  `id_kabupaten` char(20) NOT NULL,
  `telp` char(20) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `asosiasi_kec`
--

CREATE TABLE `asosiasi_kec` (
  `id` char(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_berdiri` date NOT NULL,
  `nomor_legalitas` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `alamat` text NOT NULL,
  `id_kecamatan` char(20) NOT NULL,
  `telp` char(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gapoktan`
--

CREATE TABLE `gapoktan` (
  `id` char(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_berdiri` date NOT NULL,
  `nomor_legalitas` char(20) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `id_desa` char(20) NOT NULL,
  `telp` char(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `komoditas`
--

CREATE TABLE `komoditas` (
  `id` char(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `lahan`
--

CREATE TABLE `lahan` (
  `nop` char(20) NOT NULL,
  `nik` char(20) NOT NULL,
  `luas_ha` double NOT NULL,
  `id_desa` char(20) NOT NULL,
  `lintang` double NOT NULL,
  `bujur` double NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `monitoring_unsur_hara`
--

CREATE TABLE `monitoring_unsur_hara` (
  `id` char(20) NOT NULL,
  `nop` char(20) NOT NULL,
  `id_unsur_hara` char(20) NOT NULL,
  `nilai` double NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` char(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelahiran` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `status_pegawai` enum('0','1') NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `penggunaan_pupuk`
--

CREATE TABLE `penggunaan_pupuk` (
  `id` char(20) NOT NULL,
  `id_pupuk` char(20) NOT NULL,
  `jumlah` double NOT NULL,
  `tgl_penggunaan` date NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL,
  `masa_tanam` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus_asosiasi_kab`
--

CREATE TABLE `pengurus_asosiasi_kab` (
  `id_periode` char(20) NOT NULL,
  `ketua` varchar(100) NOT NULL,
  `sekretaris` varchar(100) NOT NULL,
  `bendahara` varchar(100) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL,
  `id_asosiasi_kab` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus_asosiasi_kec`
--

CREATE TABLE `pengurus_asosiasi_kec` (
  `id_periode` char(20) NOT NULL,
  `id_asosiasi_kec` char(20) NOT NULL,
  `ketua` varchar(100) NOT NULL,
  `sekretaris` varchar(100) NOT NULL,
  `bendahara` varchar(100) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus_gapoktan`
--

CREATE TABLE `pengurus_gapoktan` (
  `id_periode` char(20) NOT NULL,
  `id_gapoktan` char(20) NOT NULL,
  `ketua` varchar(100) NOT NULL,
  `sekretaris` varchar(100) NOT NULL,
  `bendahara` varchar(100) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengurus_poktan`
--

CREATE TABLE `pengurus_poktan` (
  `id_periode` char(20) NOT NULL,
  `id_poktan` char(20) NOT NULL,
  `ketua` varchar(100) NOT NULL,
  `sekretaris` varchar(100) NOT NULL,
  `bendahara` varchar(100) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petani`
--

CREATE TABLE `petani` (
  `nik` char(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('0','1') NOT NULL,
  `kelahiran` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `telp` char(20) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL,
  `id_dusun` char(20) NOT NULL,
  `id_desa` char(20) NOT NULL,
  `rt` char(5) NOT NULL,
  `rw` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `poktan`
--

CREATE TABLE `poktan` (
  `id` char(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_berdiri` date NOT NULL,
  `no_legalitas` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `alamat` text NOT NULL,
  `id_gapoktan` char(20) NOT NULL,
  `telp` char(20) NOT NULL,
  `email` char(100) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pupuk`
--

CREATE TABLE `pupuk` (
  `id` char(20) NOT NULL,
  `nama_pupuk` varchar(100) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `relasi_asosiasi`
--

CREATE TABLE `relasi_asosiasi` (
  `id` char(20) NOT NULL,
  `id_asosiasi_kab` char(20) NOT NULL,
  `id_asosiasi_kec` char(20) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `relasi_gapoktan`
--

CREATE TABLE `relasi_gapoktan` (
  `id_relasi_gapoktan` char(20) NOT NULL,
  `id_asosiasi_kec` char(20) NOT NULL,
  `id_gapoktan` char(20) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `unsur_hara`
--

CREATE TABLE `unsur_hara` (
  `id` char(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `varietas_tanaman`
--

CREATE TABLE `varietas_tanaman` (
  `id` char(20) NOT NULL,
  `id_komoditas` char(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(20) NOT NULL,
  `id_update` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `asosiasi_kec`
--
ALTER TABLE `asosiasi_kec`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `monitoring_unsur_hara`
--
ALTER TABLE `monitoring_unsur_hara`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indeks untuk tabel `penggunaan_pupuk`
--
ALTER TABLE `penggunaan_pupuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `petani`
--
ALTER TABLE `petani`
  ADD PRIMARY KEY (`nik`);

--
-- Indeks untuk tabel `pupuk`
--
ALTER TABLE `pupuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `relasi_asosiasi`
--
ALTER TABLE `relasi_asosiasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `unsur_hara`
--
ALTER TABLE `unsur_hara`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
