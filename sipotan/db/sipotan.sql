-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2022 at 04:50 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

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
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id` char(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `id_level` char(25) NOT NULL,
  `status` char(2) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(25) NOT NULL,
  `id_update` char(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id`, `nama`, `username`, `password`, `id_level`, `status`, `tgl_buat`, `tgl_update`, `id_buat`, `id_update`) VALUES
('1586930688', 'Super Administrator', 'super', '4bb0a84b449ac9d48979a3ea1a34ed0a', '00', 'Y', '2020-04-15 15:39:27', '2021-02-20 07:14:31', '', '1586930688');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` char(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_menu` char(25) NOT NULL,
  `id_sistem` char(25) NOT NULL,
  `icon` varchar(25) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(25) NOT NULL,
  `id_update` char(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `nama`, `id_menu`, `id_sistem`, `icon`, `tgl_buat`, `tgl_update`, `id_buat`, `id_update`) VALUES
('si933', 'Sistem', '00005', '001', 'wb-desktop', '2021-01-01 10:00:00', '2021-01-01 10:00:00', '', ''),
('me776', 'Menu', '00005', '001', 'wb-menu', '2021-01-01 10:00:00', '2021-01-01 10:00:00', '', ''),
('fo110', 'Form', '00005', '001', 'wb-contract', '2021-01-01 10:00:00', '2021-01-01 10:00:00', '', ''),
('le409', 'Level', '00005', '001', 'wb-flag', '2021-01-01 10:00:00', '2021-01-01 10:00:00', '', ''),
('ak755', 'Akun Akses', '00005', '001', 'wb-user', '2021-02-20 06:29:58', '2021-05-11 12:33:07', '1586930688', '1586930688'),
('dr699', 'Form Level', '00005', '001', 'wb-link', '2021-02-20 09:30:40', '2021-05-11 12:32:57', '1586930688', '1586930688');

-- --------------------------------------------------------

--
-- Table structure for table `form_level`
--

CREATE TABLE `form_level` (
  `id` char(25) NOT NULL,
  `id_level` char(25) NOT NULL,
  `id_form` char(25) NOT NULL,
  `akses_tambah` int(2) NOT NULL,
  `akses_update` int(2) NOT NULL,
  `akses_hapus` int(2) NOT NULL,
  `akses_cetak` int(2) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(25) NOT NULL,
  `id_update` char(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icon`
--

CREATE TABLE `icon` (
  `nama` varchar(100) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `icon`
--

INSERT INTO `icon` (`nama`) VALUES
('wb-add-file'),
('wb-alert'),
('wb-alert-circle'),
('wb-align-center'),
('wb-align-justify'),
('wb-align-left'),
('wb-align-right'),
('wb-arrow-down'),
('wb-arrow-expand'),
('wb-arrow-left'),
('wb-arrow-right'),
('wb-arrow-shrink'),
('wb-arrow-up'),
('wb-attach-file'),
('wb-bell'),
('wb-bold'),
('wb-book'),
('wb-bookmark'),
('wb-briefcase'),
('wb-calendar'),
('wb-camera'),
('wb-chat'),
('wb-chat-text'),
('wb-chat-working'),
('wb-chatgoup'),
('wb-check'),
('wb-check-circle'),
('wb-check-mini'),
('wb-chevron-down'),
('wb-chevron-down-mini'),
('wb-chevron-left'),
('wb-chevron-left-mini'),
('wb-chevron-right'),
('wb-chevron-right-mini'),
('wb-chevron-up'),
('wb-chevron-up-mini'),
('wb-clipboard'),
('wb-close'),
('wb-close-mini'),
('wb-cloud'),
('wb-code'),
('wb-code-unfold'),
('wb-code-working'),
('wb-contract'),
('wb-copy'),
('wb-crop'),
('wb-dashboard'),
('wb-desktop'),
('wb-download'),
('wb-dropdown'),
('wb-dropleft'),
('wb-dropright'),
('wb-dropup'),
('wb-edit'),
('wb-emoticon'),
('wb-envelope'),
('wb-envelope-open'),
('wb-expand'),
('wb-extension'),
('wb-eye'),
('wb-eye-close'),
('wb-file'),
('wb-flag'),
('wb-folder'),
('wb-format-clear'),
('wb-fullscreen'),
('wb-fullscreen-exit'),
('wb-gallery'),
('wb-globe'),
('wb-graph-down'),
('wb-graph-up'),
('wb-grid-4'),
('wb-grid-9'),
('wb-hammer'),
('wb-heart'),
('wb-heart-outline'),
('wb-help'),
('wb-help-circle'),
('wb-home'),
('wb-image'),
('wb-inbox'),
('wb-indent-decrease'),
('wb-indent-increase'),
('wb-info'),
('wb-italic'),
('wb-large-point'),
('wb-layout'),
('wb-library'),
('wb-link'),
('wb-link-broken'),
('wb-link-intact'),
('wb-list'),
('wb-list-bullet'),
('wb-list-numbered'),
('wb-lock'),
('wb-loop'),
('wb-map'),
('wb-medium-point'),
('wb-memory'),
('wb-menu'),
('wb-minus'),
('wb-minus-circle'),
('wb-mobile'),
('wb-more-horizontal'),
('wb-more-vertical'),
('wb-move'),
('wb-musical'),
('wb-order'),
('wb-paperclip'),
('wb-pause'),
('wb-payment'),
('wb-pencil'),
('wb-pie-chart'),
('wb-play'),
('wb-plugin'),
('wb-plus'),
('wb-plus-circle'),
('wb-pluse'),
('wb-power'),
('wb-print'),
('wb-quote-right'),
('wb-random'),
('wb-refresh'),
('wb-reload'),
('wb-replay'),
('wb-reply'),
('wb-rubber'),
('wb-scissor'),
('wb-search'),
('wb-settings'),
('wb-share'),
('wb-shopping-cart'),
('wb-signal'),
('wb-small-point'),
('wb-sort-asc'),
('wb-sort-des'),
('wb-sort-vertica;'),
('wb-star'),
('wb-star-half'),
('wb-star-outline'),
('wb-stop'),
('wb-table'),
('wb-tag'),
('wb-text'),
('wb-text-type'),
('wb-thumb-down'),
('wb-thumb-up'),
('wb-time'),
('wb-trash'),
('wb-triangle-down'),
('wb-triangle-left'),
('wb-triangle-right'),
('wb-triangle-up'),
('wb-underline'),
('wb-unlock'),
('wb-upload'),
('wb-user'),
('wb-user-add'),
('wb-user-circle'),
('wb-users'),
('wb-video'),
('wb-volume-high'),
('wb-volume-low'),
('wb-volume-off'),
('wb-warning'),
('wb-wrench'),
('wb-zoom-in'),
('wb-zoom-out');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` char(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(25) NOT NULL,
  `id_update` char(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `nama`, `tgl_buat`, `tgl_update`, `id_buat`, `id_update`) VALUES
('00', 'Super Admin', '2020-04-15 15:39:27', '0000-00-00 00:00:00', '', ''),
('01', 'Administrator', '2020-04-15 15:39:27', '2021-02-18 11:46:58', '', '1586930688'),
('02', 'Supervisor', '2020-04-15 15:39:27', '2020-05-08 11:02:53', '', ''),
('03', 'Staf', '2021-02-18 12:13:36', '0000-00-00 00:00:00', '1586930688', '');

-- --------------------------------------------------------

--
-- Table structure for table `log_history`
--

CREATE TABLE `log_history` (
  `id` char(25) NOT NULL,
  `data` varchar(50) NOT NULL,
  `operasi` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `id_user` char(25) NOT NULL,
  `tgl` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` char(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `icon` varchar(25) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(25) NOT NULL,
  `id_update` char(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `icon`, `tgl_buat`, `tgl_update`, `id_buat`, `id_update`) VALUES
('00001', 'Master', 'wb-book', '2020-04-15 15:39:27', '2021-02-21 05:59:06', '', '1586930688'),
('00002', 'Data', 'wb-inbox', '2020-04-15 15:39:27', '0000-00-00 00:00:00', '', ''),
('00003', 'Pencarian', 'wb-search', '2020-04-15 15:39:27', '0000-00-00 00:00:00', '', ''),
('00004', 'Laporan', 'wb-print', '2020-04-15 15:39:27', '0000-00-00 00:00:00', '', ''),
('00005', 'Pengaturan', 'wb-settings', '2020-04-15 15:39:27', '0000-00-00 00:00:00', '', ''),
('00007', 'Import', 'wb-arrow-up', '2021-09-07 21:55:41', '0000-00-00 00:00:00', '1586930688', ''),
('00006', 'Akses', 'wb-heart', '2021-02-20 06:09:40', '2021-02-20 08:25:02', '1586930688', '1586930688');

-- --------------------------------------------------------

--
-- Table structure for table `sistem`
--

CREATE TABLE `sistem` (
  `id` char(25) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `icon` varchar(25) NOT NULL,
  `tgl_buat` datetime NOT NULL,
  `tgl_update` datetime NOT NULL,
  `id_buat` char(25) NOT NULL,
  `id_update` char(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sistem`
--

INSERT INTO `sistem` (`id`, `nama`, `deskripsi`, `icon`, `tgl_buat`, `tgl_update`, `id_buat`, `id_update`) VALUES
('001', 'Sistem Master Data', 'Blok Pengaturan Utama Sistem', 'wb-book', '2020-04-15 15:39:27', '2021-10-19 08:46:33', '', '1586930688');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_level`
--
ALTER TABLE `form_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `icon`
--
ALTER TABLE `icon`
  ADD PRIMARY KEY (`nama`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_history`
--
ALTER TABLE `log_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sistem`
--
ALTER TABLE `sistem`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
