-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2019 at 12:40 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `profildesa`
--

-- --------------------------------------------------------

--
-- Table structure for table `agama`
--

CREATE TABLE IF NOT EXISTS `agama` (
  `id_agama` int(5) NOT NULL,
  `nama_agama` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agama`
--

INSERT INTO `agama` (`id_agama`, `nama_agama`) VALUES
(1, 'Islam'),
(2, 'Kristen Protestan'),
(3, 'Kristen Katolik'),
(4, 'Hindu'),
(5, 'Buddha'),
(6, 'Konghucu');

-- --------------------------------------------------------

--
-- Table structure for table `agama_penduduk`
--

CREATE TABLE IF NOT EXISTS `agama_penduduk` (
  `id_agama` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `editor` int(5) NOT NULL DEFAULT '1',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agama_penduduk`
--

INSERT INTO `agama_penduduk` (`id_agama`, `jumlah`, `editor`, `active`) VALUES
(3, 800, 1, 'Y'),
(4, 20, 1, 'Y'),
(5, 0, 1, 'Y'),
(6, 0, 1, 'Y'),
(7, 0, 1, 'Y'),
(8, 0, 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `agama_penduduk_description`
--

CREATE TABLE IF NOT EXISTS `agama_penduduk_description` (
  `id_agama_description` int(11) NOT NULL,
  `id_agama` int(11) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agama_penduduk_description`
--

INSERT INTO `agama_penduduk_description` (`id_agama_description`, `id_agama`, `id_language`, `title`) VALUES
(5, 3, 1, 'Islam'),
(6, 3, 2, 'Islam'),
(7, 4, 1, 'Protestan'),
(8, 4, 2, 'Protestan'),
(9, 5, 1, 'Katolik'),
(10, 5, 2, 'Katolik'),
(11, 6, 1, 'Hindu'),
(12, 6, 2, 'Hindu'),
(13, 7, 1, 'Buddha'),
(14, 7, 2, 'Buddha'),
(15, 8, 1, 'Konghucu'),
(16, 8, 2, 'Konghucu');

-- --------------------------------------------------------

--
-- Table structure for table `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `id_agenda` int(11) NOT NULL,
  `seotitle` varchar(255) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `time` time NOT NULL,
  `publishdate` datetime DEFAULT NULL,
  `editor` int(5) NOT NULL DEFAULT '1',
  `picture` varchar(255) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '1',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `agenda_description`
--

CREATE TABLE IF NOT EXISTS `agenda_description` (
  `id_agenda_description` int(11) NOT NULL,
  `id_agenda` int(11) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `locations` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id_album` int(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `seotitle` varchar(255) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id_album`, `title`, `seotitle`, `active`) VALUES
(5, 'Contoh Album 1', 'contoh-album-1', 'Y'),
(6, 'Contoh Album 2', 'contoh-album-2', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int(5) NOT NULL,
  `id_parent` int(5) NOT NULL DEFAULT '0',
  `seotitle` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `id_parent`, `seotitle`, `picture`, `active`) VALUES
(1, 0, 'kabar-desa', '', 'Y'),
(3, 0, 'pariwisata', '', 'Y'),
(4, 0, 'tanaman-perkebunan', '', 'Y'),
(5, 0, 'tanaman-pangan', '', 'Y'),
(6, 0, 'perikanan-dan-kelautan', '', 'Y'),
(7, 0, 'penggunaan-lahan-dan-potensi-hutan', '', 'Y'),
(8, 0, 'produk-lokal', '', 'Y'),
(9, 0, 'badan-usaha-milik-desa', '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `category_description`
--

CREATE TABLE IF NOT EXISTS `category_description` (
  `id_category_description` int(5) NOT NULL,
  `id_category` int(5) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_description`
--

INSERT INTO `category_description` (`id_category_description`, `id_category`, `id_language`, `title`) VALUES
(9, 1, 1, 'Kabar Desa'),
(10, 1, 2, 'Village News'),
(11, 3, 1, 'Pariwisata'),
(12, 3, 2, 'Tourism'),
(13, 4, 1, 'Tanaman Perkebunan'),
(14, 4, 2, 'Plantation Crops'),
(15, 5, 1, 'Tanaman Pangan'),
(16, 5, 2, 'Crops'),
(17, 6, 1, 'Perikanan dan Kelautan'),
(18, 6, 2, 'Fisheries and Marine Affairs'),
(19, 7, 1, 'Penggunaan Lahan dan Potensi Hutan'),
(20, 7, 2, 'Land Use and Forest Potential'),
(21, 8, 1, 'Produk Lokal'),
(22, 8, 2, 'Local Products'),
(23, 9, 1, 'Badan Usaha Milik Desa'),
(24, 9, 2, 'Village-Owned Business Entity');

-- --------------------------------------------------------

--
-- Table structure for table `category_document`
--

CREATE TABLE IF NOT EXISTS `category_document` (
  `id_category_document` int(5) NOT NULL,
  `seotitle` varchar(255) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_document`
--

INSERT INTO `category_document` (`id_category_document`, `seotitle`, `active`) VALUES
(12, 'undangundang-desa', 'Y'),
(13, 'peraturan-kementerian', 'Y'),
(14, 'peraturan-bupati', 'Y'),
(15, 'perda-perdes', 'Y'),
(16, 'peraturan-bersama-kades', 'Y'),
(17, 'unduh', 'Y'),
(18, 'transparansi-anggaran', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `category_document_description`
--

CREATE TABLE IF NOT EXISTS `category_document_description` (
  `id_category_document_description` int(5) NOT NULL,
  `id_category_document` int(5) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_document_description`
--

INSERT INTO `category_document_description` (`id_category_document_description`, `id_category_document`, `id_language`, `title`) VALUES
(25, 12, 1, 'Undang-undang Desa'),
(26, 12, 2, 'Village Law'),
(27, 13, 1, 'Peraturan Kementerian'),
(28, 13, 2, 'Ministry regulations'),
(29, 0, 1, 'Undang-undang Desa baru'),
(30, 0, 2, 'Village Law'),
(31, 14, 1, 'Peraturan Bupati'),
(32, 14, 2, 'Bupati Regulation'),
(33, 15, 1, 'Perda/ Perdes'),
(34, 15, 2, 'Perda/ Perdes'),
(35, 16, 1, 'Peraturan Bersama Kades'),
(36, 16, 2, 'Joint Regulation on Village Head'),
(37, 17, 1, 'Unduh'),
(38, 17, 2, 'Download'),
(39, 18, 1, 'Transparansi Anggaran'),
(40, 18, 2, 'Budget Transparency');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id_comment` int(5) NOT NULL,
  `id_parent` int(5) NOT NULL DEFAULT '0',
  `id_post` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'N',
  `status` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

CREATE TABLE IF NOT EXISTS `component` (
  `id_component` int(5) NOT NULL,
  `component` varchar(100) NOT NULL,
  `type` enum('component','widget') NOT NULL DEFAULT 'component',
  `datetime` datetime NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id_contact` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id_document` int(5) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `publishdate` date NOT NULL,
  `hits` int(5) NOT NULL DEFAULT '1',
  `editor` int(11) NOT NULL DEFAULT '1',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id_document`, `picture`, `publishdate`, `hits`, `editor`, `active`) VALUES
(5, 'uu_no_6_2014-desa.pdf', '2017-07-19', 1, 1, 'Y'),
(6, '1491894954-permendesapdttrans_nomor_4_tahun_2017_ttg_prbhn_ats_prmn_22-2016_(salinan).pdf', '2017-07-20', 1, 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `document_category`
--

CREATE TABLE IF NOT EXISTS `document_category` (
  `id_document_category` int(5) NOT NULL,
  `id_document` int(5) NOT NULL,
  `id_category_document` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document_category`
--

INSERT INTO `document_category` (`id_document_category`, `id_document`, `id_category_document`) VALUES
(13, 5, 12),
(14, 6, 13);

-- --------------------------------------------------------

--
-- Table structure for table `document_description`
--

CREATE TABLE IF NOT EXISTS `document_description` (
  `id_document_description` int(5) NOT NULL,
  `id_document` int(5) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document_description`
--

INSERT INTO `document_description` (`id_document_description`, `id_document`, `id_language`, `title`) VALUES
(11, 5, 1, 'UU DESA NOMOR 6 TAHUN 2014'),
(12, 5, 2, 'VILLAGE LAW NUMBER 6 YEAR 2014'),
(13, 6, 1, 'Peraturan Menteri Desa Nomor 4 Tahun 2017'),
(14, 6, 2, 'Village Ministerial Regulation No. 4 of 2017');

-- --------------------------------------------------------

--
-- Table structure for table `dusun`
--

CREATE TABLE IF NOT EXISTS `dusun` (
  `id_dusun` int(11) NOT NULL,
  `male` int(11) NOT NULL,
  `female` int(11) NOT NULL,
  `color` varchar(7) NOT NULL DEFAULT '#000000',
  `editor` int(5) NOT NULL DEFAULT '1',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dusun`
--

INSERT INTO `dusun` (`id_dusun`, `male`, `female`, `color`, `editor`, `active`) VALUES
(5, 40, 60, '#3c8d30', 1, 'Y'),
(6, 50, 50, '#4A8BF5', 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `dusun_description`
--

CREATE TABLE IF NOT EXISTS `dusun_description` (
  `id_dusun_description` int(11) NOT NULL,
  `id_dusun` int(11) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dusun_description`
--

INSERT INTO `dusun_description` (`id_dusun_description`, `id_dusun`, `id_language`, `title`) VALUES
(9, 5, 1, 'Dusun Elle'),
(10, 5, 2, 'Dusun Elle'),
(11, 6, 1, 'Dusun Tokella'),
(12, 6, 2, 'Dusun Tokella');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id_gallery` int(5) NOT NULL,
  `id_album` int(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id_gallery`, `id_album`, `title`, `content`, `picture`) VALUES
(13, 5, 'Contoh Galeri 1', 'Contoh galeri 1 contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1  contoh galeri 1 ', 'contoh-gambar.jpg'),
(14, 6, 'Contoh Galeri 2', 'Contoh Galeri 2', 'contoh-gambar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kawin`
--

CREATE TABLE IF NOT EXISTS `kawin` (
  `id_kawin` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `editor` int(5) NOT NULL DEFAULT '1',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kawin`
--

INSERT INTO `kawin` (`id_kawin`, `jumlah`, `editor`, `active`) VALUES
(4, 45, 1, 'Y'),
(5, 150, 1, 'Y'),
(6, 23, 1, 'Y'),
(7, 12, 1, 'Y'),
(8, 7, 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `kawin_description`
--

CREATE TABLE IF NOT EXISTS `kawin_description` (
  `id_kawin_description` int(11) NOT NULL,
  `id_kawin` int(11) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kawin_description`
--

INSERT INTO `kawin_description` (`id_kawin_description`, `id_kawin`, `id_language`, `title`) VALUES
(7, 4, 1, 'Kawin'),
(8, 4, 2, 'Married'),
(9, 5, 1, 'Belum Kawin'),
(10, 5, 2, 'Single'),
(11, 6, 1, 'Janda'),
(12, 6, 2, 'Widow'),
(13, 7, 1, 'Duda'),
(14, 7, 2, 'Widower'),
(15, 8, 1, 'Cerai Mati'),
(16, 8, 2, 'Death Divorce');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id_language` int(5) NOT NULL,
  `title` varchar(50) NOT NULL,
  `code` varchar(3) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id_language`, `title`, `code`, `active`) VALUES
(1, 'Indonesia', 'id', 'Y'),
(2, 'English', 'gb', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` tinyint(3) unsigned NOT NULL,
  `parent_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `class` varchar(255) NOT NULL DEFAULT '',
  `position` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `group_id` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `target` varchar(10) NOT NULL DEFAULT 'none'
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `title`, `url`, `class`, `position`, `group_id`, `active`, `target`) VALUES
(1, 0, 'dashboard', 'admin.php?mod=home', 'fa-home', 1, 1, 'Y', 'none'),
(2, 0, 'post', 'admin.php?mod=post', 'fa-newspaper-o', 2, 1, 'Y', 'none'),
(5, 2, 'category', 'admin.php?mod=category', '', 2, 1, 'Y', 'none'),
(20, 0, 'pages', 'admin.php?mod=pages', 'fa-file', 8, 1, 'Y', 'none'),
(23, 187, 'library', 'admin.php?mod=library', 'fa-picture-o', 3, 1, 'Y', 'none'),
(31, 0, 'menumanager', 'admin.php?mod=menumanager', 'fa-sitemap', 10, 1, 'Y', 'none'),
(42, 2, 'comment', 'admin.php?mod=comment', '', 3, 1, 'Y', 'none'),
(48, 0, 'Beranda', './', '', 1, 2, 'Y', 'none'),
(106, 0, 'Profil Desa', '', '', 2, 2, 'Y', 'none'),
(107, 106, 'Pemerintah Desa', 'pemdes', '', 2, 2, 'Y', 'none'),
(108, 106, 'Sejarah', 'pages/sejarah-desa', '', 3, 2, 'Y', 'none'),
(117, 187, 'Galeri', 'admin.php?mod=gallery', 'fa-file-photo-o', 1, 1, 'Y', 'none'),
(118, 187, 'Video', 'admin.php?mod=video', 'fa-file-movie-o', 2, 1, 'Y', 'none'),
(121, 0, 'Data Pemdes', 'admin.php?mod=pemdes', 'fa-group', 3, 1, 'Y', 'none'),
(122, 106, 'Visi dan Misi', 'pages/visi-dan-misi', '', 1, 2, 'Y', 'none'),
(123, 124, 'Badan Pemusyawaratan Desa (BPD)', 'pages/badan-permusyawaratan-desa-bpd', '', 2, 2, 'Y', 'none'),
(124, 0, 'Lembaga', '', '', 4, 2, 'Y', 'none'),
(126, 0, 'Potensi', '', '', 5, 2, 'Y', 'none'),
(127, 0, 'Regulasi', '', '', 7, 2, 'Y', 'none'),
(130, 106, 'Peta Desa', 'pages/peta-desa', '', 5, 2, 'Y', 'none'),
(131, 106, 'Aset Desa', 'pages/aset-desa', '', 6, 2, 'Y', 'none'),
(133, 124, 'PKK', 'pages/pkk', '', 3, 2, 'Y', 'none'),
(134, 124, 'Karang Taruna', 'pages/karang-taruna', '', 4, 2, 'Y', 'none'),
(138, 106, 'Tujuan dan Sasaran', 'pages/tujuan-dan-sasaran', '', 4, 2, 'Y', 'none'),
(140, 106, 'Sarana dan Prasarana', '', '', 7, 2, 'Y', 'none'),
(160, 124, 'LPMD', 'pages/lpmd', '', 1, 2, 'Y', 'none'),
(161, 124, 'RT/RW', 'pages/rt-rw', '', 5, 2, 'Y', 'none'),
(162, 126, 'Tanaman Perkebunan', 'category/tanaman-perkebunan', '', 1, 2, 'Y', 'none'),
(163, 126, 'Tanaman Pangan', '', '', 2, 2, 'Y', 'none'),
(164, 126, 'Peternakan', '', '', 3, 2, 'Y', 'none'),
(165, 126, 'Perikanan dan Kelautan', '', '', 4, 2, 'Y', 'none'),
(166, 126, 'Penggunaan Lahan dan Potensi Hujan', '', '', 5, 2, 'Y', 'none'),
(167, 126, 'Produk Lokal', '', '', 6, 2, 'Y', 'none'),
(168, 126, 'BUMDES', '', '', 7, 2, 'Y', 'none'),
(169, 0, 'Pariwisata', 'category/pariwisata', '', 6, 2, 'Y', 'none'),
(170, 0, 'Unduh', '', '', 8, 2, 'Y', 'none'),
(171, 127, 'Undang-undang Desa', 'category-document/undangundang-desa', '', 1, 2, 'Y', 'none'),
(172, 127, 'Peraturan Kementerian', 'category-document/peraturan-kementerian', '', 2, 2, 'Y', 'none'),
(173, 127, 'Peraturan Bupati', 'category-document/peraturan-bupati', '', 3, 2, 'Y', 'none'),
(174, 127, 'Perda/Perdes', 'category-document/perda-perdes', '', 4, 2, 'Y', 'none'),
(175, 127, 'Peraturan Bersama Kades', 'category-document/peraturan-bersama-kades', '', 5, 2, 'Y', 'none'),
(176, 170, 'Transparansi Anggaran', '', '', 1, 2, 'Y', 'none'),
(177, 170, 'Formulir Isian Layanan Desa', '', '', 2, 2, 'Y', 'none'),
(178, 0, 'Data Penduduk', 'statistik', '', 3, 2, 'Y', 'none'),
(179, 0, 'Hubungi Kami', 'contact', '', 9, 2, 'Y', 'none'),
(180, 2, 'allpost', 'admin.php?mod=post', '', 1, 1, 'Y', 'none'),
(181, 0, 'Documents', 'admin.php?mod=document', 'fa-book', 5, 1, 'Y', 'none'),
(182, 0, 'Home', './', '', 1, 3, 'Y', 'none'),
(183, 0, 'Profile', '', '', 183, 3, 'Y', 'none'),
(184, 0, 'Agenda', 'admin.php?mod=agenda', 'fa-calendar', 6, 1, 'N', 'none'),
(185, 0, 'Pengumuman', 'admin.php?mod=pengumuman', 'fa-bullhorn', 7, 1, 'N', 'none'),
(186, 0, 'Statistik Penduduk', 'admin.php?mod=statistik', 'fa-bar-chart', 4, 1, 'Y', 'none'),
(187, 0, 'Media', '', 'fa-folder-open-o', 9, 1, 'Y', 'none'),
(188, 186, 'Pekerjaan', 'admin.php?mod=statistik&act=pekerjaan', '', 4, 1, 'Y', 'none'),
(189, 186, 'Pendidikan', 'admin.php?mod=statistik&act=pendidikan', '', 5, 1, 'Y', 'none'),
(190, 186, 'RW', 'admin.php?mod=statistik&act=rw', '', 3, 1, 'Y', 'none'),
(191, 186, 'Dusun', 'admin.php?mod=statistik&act=dusun', '', 2, 1, 'Y', 'none'),
(192, 186, 'Agama', 'admin.php?mod=statistik&act=agama', '', 6, 1, 'Y', 'none'),
(193, 186, 'Kelompok Umur', 'admin.php?mod=statistik&act=umur', '', 8, 1, 'Y', 'none'),
(194, 186, 'Status Kawin', 'admin.php?mod=statistik&act=kawin', '', 7, 1, 'Y', 'none'),
(195, 186, 'Tingkat Sosial', 'admin.php?mod=statistik&act=sosial', '', 9, 1, 'Y', 'none'),
(196, 186, 'Data Umum', 'admin.php?mod=statistik', '', 1, 1, 'Y', 'none');

-- --------------------------------------------------------

--
-- Table structure for table `menu_group`
--

CREATE TABLE IF NOT EXISTS `menu_group` (
  `id` smallint(5) unsigned NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_group`
--

INSERT INTO `menu_group` (`id`, `title`) VALUES
(1, 'Menu Admin'),
(2, 'id'),
(3, 'gb');

-- --------------------------------------------------------

--
-- Table structure for table `oauth`
--

CREATE TABLE IF NOT EXISTS `oauth` (
  `id_oauth` int(5) NOT NULL,
  `oauth_type` varchar(10) NOT NULL,
  `oauth_key` text NOT NULL,
  `oauth_secret` text NOT NULL,
  `oauth_id` varchar(100) NOT NULL,
  `oauth_user` varchar(100) NOT NULL,
  `oauth_token1` text NOT NULL,
  `oauth_token2` text NOT NULL,
  `oauth_fbtype` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oauth`
--

INSERT INTO `oauth` (`id_oauth`, `oauth_type`, `oauth_key`, `oauth_secret`, `oauth_id`, `oauth_user`, `oauth_token1`, `oauth_token2`, `oauth_fbtype`) VALUES
(1, 'facebook', '', '', '', '', '', '', ''),
(2, 'twitter', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id_pages` int(5) NOT NULL,
  `seotitle` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id_pages`, `seotitle`, `picture`, `active`) VALUES
(1, 'tentang-kami', '', 'Y'),
(5, 'visi-dan-misi', '', 'Y'),
(6, 'tujuan-dan-sasaran', '', 'Y'),
(19, 'peta-desa', '', 'Y'),
(20, 'sejarah-desa', '', 'Y'),
(21, 'lpmd', '', 'Y'),
(22, 'badan-permusyawaratan-desa-bpd', '', 'Y'),
(23, 'pkk', '', 'Y'),
(24, 'karang-taruna', '', 'Y'),
(25, 'rt-rw', '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `pages_description`
--

CREATE TABLE IF NOT EXISTS `pages_description` (
  `id_pages_description` int(5) NOT NULL,
  `id_pages` int(5) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages_description`
--

INSERT INTO `pages_description` (`id_pages_description`, `id_pages`, `id_language`, `title`, `content`) VALUES
(1, 1, 1, 'Tentang Kami', '&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami .&lt;/p&gt;\r\n&lt;p&gt;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami .&lt;/p&gt;\r\n&lt;p&gt;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami&amp;nbsp;Contoh tentang kami .&lt;/p&gt;'),
(2, 1, 2, 'About Us', ''),
(9, 5, 1, 'Visi dan Misi', '&lt;p&gt;Visi&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; Visi adalah rumusan umum mengenai keadaan yang diinginkan pada akhir periode perencanaan, artinya bahwa adapun Visi Desa Tapong untuk periode 2016-2021 adalah &amp;ldquo;Terwujudnya Desa&amp;nbsp; Yang Bermartabat, Damai dan Sejahtera&amp;rdquo;&lt;br /&gt;&lt;br /&gt;&lt;br /&gt;Misi&lt;br /&gt;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp;&amp;nbsp; Misi adalah rumusan umum mengenai upaya-upaya yang akan dilaksanakan untuk mewujudkan visi. Untuk dapat merealisasikan Visi Desa dirumuskan 4 Misi sebagai berikut ;&lt;br /&gt;a.&amp;nbsp; Meningkatkan Kualitas Penyelenggaraan Pemerintahan Desa.&lt;br /&gt;b.&amp;nbsp; Meningkatkan pemerataan dan kualitas Pelaksanaan Pembangunan Desa.&lt;br /&gt;c.&amp;nbsp; Meningkatkan Pelaksanaan Pembinaan Kemasyarakatan.&lt;br /&gt;d.&amp;nbsp; Meningkatkan Kualitas Pemberdayaan Masyarakat Desa.&lt;/p&gt;'),
(10, 5, 2, 'Vision and Mision', ''),
(11, 6, 1, 'Tujuan dan Sasaran', '&lt;p&gt;&lt;strong&gt;TUJUAN&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Tujuan adalah pernyataan tentang hal-hal yang perlu dilakukan untuk mencapai visi, melaksanakan misi, memecahkan permasalahan, dan menangani isu strategis yang dihadapi. Kalimat tujuan tersebut dirumuskan dengan menjabarkan lebih operasional dari misi. Satu kalimat misi dapat dirumuskan dalam beberapa tujuan, penyusunannya memperhatikan isu-isu strategis daerah.&lt;/p&gt;\r\n&lt;p&gt;Tujuan dapat pula diartikan sebagai penjabaran/implementasi dari pernyataan misi yang menunjukkan apa yang akan dihasilkan dalam kurun waktu periode perencanaan, dalam hal ini untuk jangka waktu lima tahun (2013-2018).&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;SASARAN&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;Sementara itu sasaran adalah hasil yang diharapkan dari suatu tujuan yang diformulasikan secara terukur, spesifik, bisa dicapai, rasional untuk jangka waktu 5 tahun. Perumusan sasaran perlu memperhatikan indikator kinerja pembangunan daerah.&lt;/p&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;'),
(12, 6, 2, 'Goals, Roles and Directions', ''),
(37, 19, 1, 'Peta Desa', '&lt;p&gt;&lt;iframe style=&quot;border: 0;&quot; src=&quot;https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2031133.375494511!2d117.30302986013687!3d-6.122980916219006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dc771a457beb741%3A0x10decafd8d0aeb25!2sKabupaten+Pangkajene+Dan+Kepulauan%2C+Sulawesi+Selatan!5e0!3m2!1sid!2sid!4v1564220376648!5m2!1sid!2sid&quot; width=&quot;600&quot; height=&quot;450&quot; frameborder=&quot;0&quot; allowfullscreen=&quot;allowfullscreen&quot;&gt;&lt;/iframe&gt;&lt;/p&gt;'),
(38, 19, 2, 'Village Map', ''),
(39, 20, 1, 'Sejarah Desa', '&lt;p&gt;Desa Tapong &amp;nbsp;merupakan salah satu desa dari sebelas (11) desa yang ada di Kecamatan Tellu Limpoe Kabupaten Bone. Desa Tapong terdiri atas Tiga (3) dusun yakni Dusun Lerang , Dusun Dusun&amp;nbsp; Rea, dan Dusun Laniti. Desa Tapong adalah desa pertanian dan perkebunan. Berikut gambaran tentang sejarah perkembangan desa ini.&lt;/p&gt;\r\n&lt;table style=&quot;margin-left: auto; margin-right: auto;&quot; width=&quot;624&quot;&gt;\r\n&lt;tbody&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;217&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;Tahun&lt;/strong&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td width=&quot;406&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;Peristiwa&lt;/strong&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;217&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;&amp;nbsp;SM&lt;/strong&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td width=&quot;406&quot;&gt;\r\n&lt;p&gt;Mula-mulanya desa ini ada tiga perkampungan sama enre, itrean dan bontang&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;217&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;SM&lt;/strong&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td width=&quot;406&quot;&gt;\r\n&lt;p&gt;Dibentuk lagi yang namanya kepala lompo&lt;/p&gt;\r\n&lt;p&gt;Yang dikepalai oleh P. Toro&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;217&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;SM&lt;/strong&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td width=&quot;406&quot;&gt;\r\n&lt;p&gt;Ketiga kampung tersebut diatas diganti lagi namanya yaitu Lerang, Rea dan Laniti maka dibentuk sebuah Desa tapi belum ada namanya dipimpin oleh Puang Salle&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;217&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;1965&lt;/strong&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td width=&quot;406&quot;&gt;\r\n&lt;p&gt;Disinilah terbentuk Desa Tapong dibawa Pimpinan ABDULLAH Daeng Matereng&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;217&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;1966&lt;/strong&gt; &lt;strong&gt;&amp;ndash;&lt;/strong&gt; &lt;strong&gt;1969&lt;/strong&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td width=&quot;406&quot;&gt;\r\n&lt;p&gt;Pemerintah Desa Tapong&amp;nbsp; Dipimpin oleh Pacongkongi&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;217&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1969 &amp;ndash;&lt;/strong&gt; &lt;strong&gt;1992&lt;/strong&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td width=&quot;406&quot;&gt;\r\n&lt;p&gt;Didatangkan Pembina tahun 1969 yang bernama Tajuddin dg.Mallongi selama Dua tahun, selama dua tahun tersebut maka dibentuklah Kepala Desa Tapong tahun 1971-1992&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;217&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;&amp;nbsp;&lt;/strong&gt;&lt;/p&gt;\r\n&lt;p&gt;&lt;strong&gt;1993&lt;/strong&gt; &lt;strong&gt;&amp;ndash;&lt;/strong&gt; &lt;strong&gt;1994&lt;/strong&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td width=&quot;406&quot;&gt;\r\n&lt;p&gt;Ditahun ini dijabat oleh sekretaris Desa yang bernama SURDI diadakan lagi pemilihan Desa Tapong 1994 maka yang terpilih pada tahun tersebut yaitu Andi Sultani&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;217&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;199&lt;/strong&gt;&lt;strong&gt;4&lt;/strong&gt;&lt;strong&gt; &amp;ndash;&lt;/strong&gt; &lt;strong&gt;200&lt;/strong&gt;&lt;strong&gt;2&lt;/strong&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td width=&quot;406&quot;&gt;\r\n&lt;p&gt;Desa Tapong sudah menjadi desa definitif&amp;nbsp; yang dipimpin oleh&amp;nbsp;&amp;nbsp; Bapak A. Sultani&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;217&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;2002&lt;/strong&gt;&lt;strong&gt; &amp;ndash;&lt;/strong&gt; &lt;strong&gt;200&lt;/strong&gt;&lt;strong&gt;3&lt;/strong&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td width=&quot;406&quot;&gt;\r\n&lt;p&gt;Ditahun ini dijabat oleh Utusan dari Kecamatan yang bernama Nuryamin diadakan lagi pemilihan Desa Tapong 2003 maka yang terpilih pada tahun tersebut yaitu Abd. Rahim&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;217&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;1/9/&lt;/strong&gt;&lt;strong&gt;2003 &lt;/strong&gt;&lt;strong&gt;s/d 1/9/&lt;/strong&gt;&lt;strong&gt;2008&lt;/strong&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td width=&quot;406&quot;&gt;\r\n&lt;p&gt;Pemerintahan Desa Tapong&amp;nbsp; yang dipimpin oleh&amp;nbsp;&amp;nbsp; Bapak Abd. Rahim&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;217&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;1/9/&lt;/strong&gt;&lt;strong&gt;2008&lt;/strong&gt;&lt;strong&gt; s/d 1/9/&lt;/strong&gt;&lt;strong&gt;2014&lt;/strong&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td width=&quot;406&quot;&gt;\r\n&lt;p&gt;Pemerintahan Desa Tapong&amp;nbsp; yang dipimpin oleh&amp;nbsp;&amp;nbsp; Bapak Abd. Rahim&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;217&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;1&lt;/strong&gt;&lt;strong&gt;4/&lt;/strong&gt;&lt;strong&gt;9&lt;/strong&gt;&lt;strong&gt;/&lt;/strong&gt;&lt;strong&gt;2014&lt;/strong&gt; &lt;strong&gt;s/d&lt;/strong&gt;&lt;strong&gt; 6/12/&lt;/strong&gt;&lt;strong&gt;201&lt;/strong&gt;&lt;strong&gt;5&lt;/strong&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td width=&quot;406&quot;&gt;\r\n&lt;p&gt;Ditahun ini dijabat oleh sekretaris Desa&amp;nbsp; Tapong yang dipimpin oleh Saudari&amp;nbsp; MURHAYA&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;tr&gt;\r\n&lt;td width=&quot;217&quot;&gt;\r\n&lt;p&gt;&lt;strong&gt;7/12/&lt;/strong&gt;&lt;strong&gt;201&lt;/strong&gt;&lt;strong&gt;5 &lt;/strong&gt;&lt;strong&gt;s/d&lt;/strong&gt;&lt;strong&gt; Sekarang&lt;/strong&gt;&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;td width=&quot;406&quot;&gt;\r\n&lt;p&gt;Pemerintahan Desa Tapong&amp;nbsp; yang dipimpin oleh&amp;nbsp;&amp;nbsp; Bapak Ridwan, S.Pd&lt;/p&gt;\r\n&lt;/td&gt;\r\n&lt;/tr&gt;\r\n&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;'),
(40, 20, 2, 'Village History', ''),
(41, 21, 1, 'LPMD', ''),
(42, 21, 2, 'LPMD', ''),
(43, 22, 1, 'Badan Permusyawaratan Desa BPD', ''),
(44, 22, 2, 'Village Consultative Body', ''),
(45, 23, 1, 'PKK', ''),
(46, 23, 2, 'PKK', ''),
(47, 24, 1, 'Karang Taruna', ''),
(48, 24, 2, 'Karang Taruna', ''),
(49, 25, 1, 'RT/RW', ''),
(50, 25, 2, 'RT/RW', '');

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan`
--

CREATE TABLE IF NOT EXISTS `pekerjaan` (
  `id_pekerjaan` int(11) NOT NULL,
  `male` int(11) NOT NULL,
  `female` int(11) NOT NULL,
  `editor` int(5) NOT NULL DEFAULT '1',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan`
--

INSERT INTO `pekerjaan` (`id_pekerjaan`, `male`, `female`, `editor`, `active`) VALUES
(4, 0, 400, 1, 'Y'),
(5, 34, 25, 1, 'Y'),
(6, 150, 20, 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `pekerjaan_description`
--

CREATE TABLE IF NOT EXISTS `pekerjaan_description` (
  `id_pekerjaan_description` int(11) NOT NULL,
  `id_pekerjaan` int(11) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pekerjaan_description`
--

INSERT INTO `pekerjaan_description` (`id_pekerjaan_description`, `id_pekerjaan`, `id_language`, `title`) VALUES
(7, 4, 1, 'IRT'),
(8, 4, 2, 'IRT'),
(9, 5, 1, 'Pelajar/Mahasiswa'),
(10, 5, 2, 'Student'),
(11, 6, 1, 'Petani'),
(12, 6, 2, 'Farmer');

-- --------------------------------------------------------

--
-- Table structure for table `pemdes`
--

CREATE TABLE IF NOT EXISTS `pemdes` (
  `id_pemdes` int(11) NOT NULL,
  `seotitle` varchar(255) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `id_agama` varchar(20) NOT NULL,
  `jenkel` enum('Laki-laki','Perempuan') NOT NULL,
  `editor` int(5) NOT NULL DEFAULT '1',
  `alamat` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemdes_description`
--

CREATE TABLE IF NOT EXISTS `pemdes_description` (
  `id_pemdes_description` int(11) NOT NULL,
  `id_pemdes` int(11) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE IF NOT EXISTS `pendidikan` (
  `id_pendidikan` int(11) NOT NULL,
  `male` int(11) NOT NULL,
  `female` int(11) NOT NULL,
  `editor` int(5) NOT NULL DEFAULT '1',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`id_pendidikan`, `male`, `female`, `editor`, `active`) VALUES
(1, 20, 40, 1, 'Y'),
(2, 45, 70, 1, 'Y'),
(3, 30, 10, 1, 'Y'),
(4, 30, 10, 1, 'Y'),
(5, 10, 2, 1, 'Y'),
(6, 2, 0, 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan_description`
--

CREATE TABLE IF NOT EXISTS `pendidikan_description` (
  `id_pendidikan_description` int(11) NOT NULL,
  `id_pendidikan` int(11) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendidikan_description`
--

INSERT INTO `pendidikan_description` (`id_pendidikan_description`, `id_pendidikan`, `id_language`, `title`) VALUES
(1, 1, 1, 'Belum/Tidak Sekolah'),
(2, 1, 2, 'Not yet / Not School'),
(3, 2, 1, 'SD Sederajat'),
(4, 2, 2, 'SD equivalent'),
(5, 3, 1, 'SLTP Sederjat'),
(6, 3, 2, 'Middle School Junior High School'),
(7, 4, 1, 'SLTA Sederajat'),
(8, 4, 2, 'High school equivalent'),
(9, 5, 1, 'Diploma'),
(10, 5, 2, 'Diploma'),
(11, 6, 1, 'Sarjana S1/S2/S3'),
(12, 6, 2, 'Bachelor, Magister, Doktor');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE IF NOT EXISTS `pengumuman` (
  `id_pengumuman` int(11) NOT NULL,
  `seotitle` varchar(255) NOT NULL,
  `publishdate` datetime DEFAULT NULL,
  `editor` int(5) NOT NULL DEFAULT '1',
  `picture` varchar(255) NOT NULL,
  `hits` int(11) NOT NULL DEFAULT '1',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `seotitle`, `publishdate`, `editor`, `picture`, `hits`, `active`) VALUES
(5, 'contoh-pengumuman-1', '2019-07-27 17:47:02', 1, 'contoh-gambar.jpg', 1, 'Y'),
(6, 'contoh-pengumuman-2', '2019-07-27 17:48:21', 1, 'contoh-gambar.jpg', 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman_description`
--

CREATE TABLE IF NOT EXISTS `pengumuman_description` (
  `id_pengumuman_description` int(11) NOT NULL,
  `id_pengumuman` int(11) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengumuman_description`
--

INSERT INTO `pengumuman_description` (`id_pengumuman_description`, `id_pengumuman`, `id_language`, `title`, `content`) VALUES
(9, 5, 1, 'Contoh Pengumuman 1', 'contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman '),
(10, 5, 2, 'Example Announcement 1', 'Example announcement example announcement example announcement  example announcement  example announcement  example announcement  example announcement  example announcement  example announcement  example announcement  example announcement  example announcement  example announcement  example announcement  example announcement  '),
(11, 6, 1, 'Contoh Pengumuman 2 ', 'contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman contoh pengumuman '),
(12, 6, 2, 'Example Announcement 2', 'Example announcement example announcement Example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement example announcement');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(5) NOT NULL,
  `seotitle` varchar(255) NOT NULL,
  `tag` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `publishdate` datetime NOT NULL,
  `editor` int(5) NOT NULL DEFAULT '1',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `headline` enum('Y','N') NOT NULL DEFAULT 'N',
  `comment` enum('Y','N') NOT NULL DEFAULT 'Y',
  `picture` varchar(255) NOT NULL,
  `picture_description` varchar(255) NOT NULL,
  `hits` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id_post`, `seotitle`, `tag`, `date`, `time`, `publishdate`, `editor`, `active`, `headline`, `comment`, `picture`, `picture_description`, `hits`) VALUES
(44, 'contoh-konten-1', '', '2019-07-27', '05:19:10', '2019-07-27 05:19:10', 1, 'Y', 'Y', 'N', 'contoh-gambar.jpg', 'contoh gambar', 2),
(45, 'contoh-konten-2', '', '2019-07-27', '05:25:55', '2019-07-27 05:25:55', 1, 'Y', 'Y', 'N', 'contoh-gambar.jpg', 'contoh gambar', 2),
(46, 'contoh-konten-3', '', '2019-07-27', '05:27:23', '2019-07-27 05:27:23', 1, 'Y', 'N', 'Y', 'contoh-gambar.jpg', 'contoh gambar', 1),
(47, 'contoh-konten-4', '', '2019-07-27', '05:28:39', '2019-07-27 05:28:39', 1, 'Y', 'N', 'N', 'contoh-gambar.jpg', 'contoh gambar', 1),
(48, 'contoh-konten-5', '', '2019-07-27', '05:30:11', '2019-07-27 05:30:11', 1, 'Y', 'N', 'N', 'contoh-gambar.jpg', 'contoh gambar', 1),
(49, 'contoh-konten-6', '', '2019-07-27', '05:32:38', '2019-07-27 05:32:38', 1, 'Y', 'N', 'N', 'contoh-gambar.jpg', 'contoh gambar', 1),
(50, 'contoh-konten-7', '', '2019-07-27', '05:34:16', '2019-07-27 05:34:16', 1, 'Y', 'N', 'N', 'contoh-gambar.jpg', 'contoh gambar', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE IF NOT EXISTS `post_category` (
  `id_post_category` int(5) NOT NULL,
  `id_post` int(5) NOT NULL,
  `id_category` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_category`
--

INSERT INTO `post_category` (`id_post_category`, `id_post`, `id_category`) VALUES
(60, 46, 1),
(65, 49, 1),
(66, 48, 1),
(67, 47, 1),
(68, 45, 1),
(69, 44, 1),
(70, 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_description`
--

CREATE TABLE IF NOT EXISTS `post_description` (
  `id_post_description` int(5) NOT NULL,
  `id_post` int(5) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_description`
--

INSERT INTO `post_description` (`id_post_description`, `id_post`, `id_language`, `title`, `content`) VALUES
(91, 44, 1, 'Contoh Konten 1 ', '&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;'),
(92, 44, 2, 'Example Content 1', '&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;'),
(93, 45, 1, 'Contoh Konten 2', '&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;'),
(94, 45, 2, 'Example Content 2', '&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;'),
(95, 46, 1, 'Contoh Konten 3', '&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;'),
(96, 46, 2, 'Example Content 3', '&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;'),
(97, 47, 1, 'Contoh Konten  4', '&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;'),
(98, 47, 2, 'Example Content 4', '&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;'),
(99, 48, 1, 'Contoh Konten 5', '&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;'),
(100, 48, 2, 'Example Content 5', '&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;');
INSERT INTO `post_description` (`id_post_description`, `id_post`, `id_language`, `title`, `content`) VALUES
(101, 49, 1, 'Contoh Konten 6 ', '&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;'),
(102, 49, 2, 'Example Content 6', '&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;'),
(103, 50, 1, 'Contoh Konten 7 ', '&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Contoh konten contoh konten contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten&amp;nbsp;contoh konten contoh konten.&lt;/p&gt;'),
(104, 50, 2, 'Example Content 7', '&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content.&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;\r\n&lt;p style=&quot;text-align: justify;&quot;&gt;Examplecontent&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;Example&amp;nbsp;content&amp;nbsp;example&amp;nbsp;content&amp;nbsp;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `post_gallery`
--

CREATE TABLE IF NOT EXISTS `post_gallery` (
  `id_post_gallery` int(5) NOT NULL,
  `id_post` int(5) NOT NULL DEFAULT '0',
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rw`
--

CREATE TABLE IF NOT EXISTS `rw` (
  `id_rw` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `editor` int(5) NOT NULL DEFAULT '1',
  `color` varchar(7) NOT NULL DEFAULT '#000000',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rw`
--

INSERT INTO `rw` (`id_rw`, `jumlah`, `editor`, `color`, `active`) VALUES
(4, 134, 1, '#cc2f98', 'Y'),
(5, 242, 1, '#1938d3', 'Y'),
(6, 123, 1, '#e51554', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `rw_description`
--

CREATE TABLE IF NOT EXISTS `rw_description` (
  `id_rw_description` int(11) NOT NULL,
  `id_rw` int(11) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rw_description`
--

INSERT INTO `rw_description` (`id_rw_description`, `id_rw`, `id_language`, `title`) VALUES
(7, 4, 1, 'RW 1'),
(8, 4, 2, 'RW 1'),
(9, 5, 1, 'RW 2'),
(10, 5, 2, 'RW 2'),
(11, 6, 1, 'RW 3'),
(12, 6, 2, 'RW 3');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `id_setting` int(5) NOT NULL,
  `groups` varchar(50) NOT NULL,
  `options` varchar(100) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id_setting`, `groups`, `options`, `value`) VALUES
(1, 'general', 'web_name', 'DESA TAPONG'),
(2, 'general', 'web_url', 'http://localhost/profildesa/'),
(3, 'general', 'web_meta', 'Situs Resmi Contoh Desa UNIFA'),
(4, 'general', 'web_keyword', 'profil desa, web desa'),
(5, 'general', 'web_owner', 'Desa Contoh'),
(6, 'general', 'email', 'admin@desa.id'),
(7, 'general', 'telephone', '0481- '),
(8, 'general', 'fax', '0481- xxxxxx'),
(9, 'general', 'address', '&lt;strong&gt;Headquarters:&lt;/strong&gt;&lt;br&gt;\nJalan Poros desa &lt;br&gt;\nKec. Nama Kecamatan Kab. Nama Kabupaten&lt;br&gt; Sulawesi Selatan, Indonesia'),
(10, 'general', 'geocode', ''),
(11, 'image', 'favicon', 'favicon.png'),
(12, 'image', 'logo', 'logo.png'),
(13, 'image', 'img_medium', '640x480'),
(14, 'local', 'country', 'Indonesia'),
(15, 'local', 'region_state', 'Sulawesi Selatan'),
(16, 'local', 'timezone', 'Asia/Makassar'),
(17, 'config', 'maintenance', 'N'),
(18, 'config', 'member_registration', 'N'),
(19, 'config', 'comment', 'N'),
(20, 'config', 'item_per_page', '5'),
(21, 'config', 'google_analytics', ''),
(22, 'config', 'recaptcha_sitekey', '6LdWRwsUAAAAAN6ozQdh0485rszNWNBbipJPAS_N'),
(23, 'config', 'recaptcha_secretkey', '6LdWRwsUAAAAAKQVC1VtowttXDHygM93iS7qTghP'),
(24, 'mail', 'mail_protocol', 'Mail'),
(25, 'mail', 'mail_hostname', ''),
(26, 'mail', 'mail_username', ''),
(27, 'mail', 'mail_password', ''),
(28, 'mail', 'mail_port', ''),
(29, 'config', 'permalink', 'slug/post-title'),
(30, 'config', 'slug_permalink', 'detailpost');

-- --------------------------------------------------------

--
-- Table structure for table `sosial`
--

CREATE TABLE IF NOT EXISTS `sosial` (
  `id_sosial` int(11) NOT NULL,
  `atas` int(11) NOT NULL,
  `bawah` int(11) NOT NULL,
  `color` varchar(7) NOT NULL DEFAULT '#000000',
  `editor` int(5) NOT NULL DEFAULT '1',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sosial`
--

INSERT INTO `sosial` (`id_sosial`, `atas`, `bawah`, `color`, `editor`, `active`) VALUES
(3, 123, 400, '#000000', 1, 'Y'),
(4, 120, 450, '#000000', 1, 'Y'),
(5, 200, 500, '#000000', 1, 'Y'),
(6, 580, 120, '#000000', 1, 'Y'),
(7, 123, 323, '#000000', 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `sosial_description`
--

CREATE TABLE IF NOT EXISTS `sosial_description` (
  `id_sosial_description` int(11) NOT NULL,
  `id_sosial` int(11) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sosial_description`
--

INSERT INTO `sosial_description` (`id_sosial_description`, `id_sosial`, `id_language`, `title`) VALUES
(5, 3, 1, 'Total Keluarga'),
(6, 3, 2, 'Total Family'),
(7, 4, 1, 'Keluarga Raskin'),
(8, 4, 2, 'Raskin Family '),
(9, 5, 1, 'Program Keluarga Harapan'),
(10, 5, 2, 'Family Hope Program'),
(11, 6, 1, 'Keluarga BPJS'),
(12, 6, 2, 'BPJS Family'),
(13, 7, 1, 'Keluarga KIP'),
(14, 7, 2, 'KIP Family');

-- --------------------------------------------------------

--
-- Table structure for table `statistik`
--

CREATE TABLE IF NOT EXISTS `statistik` (
  `id_statistik` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `editor` int(5) NOT NULL DEFAULT '1',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statistik`
--

INSERT INTO `statistik` (`id_statistik`, `jumlah`, `editor`, `active`) VALUES
(5, 1500, 1, 'Y'),
(6, 120, 1, 'Y'),
(7, 600, 1, 'Y'),
(8, 900, 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `statistik_description`
--

CREATE TABLE IF NOT EXISTS `statistik_description` (
  `id_statistik_description` int(11) NOT NULL,
  `id_statistik` int(11) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statistik_description`
--

INSERT INTO `statistik_description` (`id_statistik_description`, `id_statistik`, `id_language`, `title`) VALUES
(13, 5, 1, 'Jumlah Penduduk'),
(14, 5, 2, 'Total Population'),
(15, 6, 1, 'Jumlah Keluarga'),
(16, 6, 2, 'Total Family'),
(17, 7, 1, 'Penduduk Laki-laki'),
(18, 7, 2, 'Male Population'),
(19, 8, 1, 'Penduduk Perempuan'),
(20, 8, 2, 'Female Population');

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE IF NOT EXISTS `subscribe` (
  `id_subscribe` int(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id_tag` int(5) NOT NULL,
  `title` varchar(100) NOT NULL,
  `tag_seo` varchar(100) NOT NULL,
  `count` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `id_theme` int(5) NOT NULL,
  `title` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `folder` varchar(20) NOT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id_theme`, `title`, `author`, `folder`, `active`) VALUES
(2, 'Blue', 'Zagitanank', 'zagitanank', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `traffic`
--

CREATE TABLE IF NOT EXISTS `traffic` (
  `ip` varchar(20) NOT NULL DEFAULT '',
  `browser` varchar(255) NOT NULL,
  `os` varchar(255) NOT NULL,
  `platform` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `hits` int(10) NOT NULL DEFAULT '1',
  `online` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `traffic`
--

INSERT INTO `traffic` (`ip`, `browser`, `os`, `platform`, `country`, `city`, `date`, `hits`, `online`) VALUES
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 6.1; rv:50.0) Gecko/20100101 Firefox/50.0', 'Windows', '', '', '2017-01-07', 379, '1483802414'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 6.1; rv:50.0) Gecko/20100101 Firefox/50.0', 'Windows', '', '', '2017-01-08', 503, '1483872801'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 6.1; rv:50.0) Gecko/20100101 Firefox/50.0', 'Windows', '', '', '2017-01-09', 234, '1483907791'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 6.1; rv:50.0) Gecko/20100101 Firefox/50.0', 'Windows', '', '', '2017-01-11', 1, '1484124720'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 6.1; rv:50.0) Gecko/20100101 Firefox/50.0', 'Windows', '', '', '2017-01-14', 8, '1484392942'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-06-22', 36, '1498138626'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-06-23', 263, '1498226496'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-06-24', 452, '1498301009'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-06-25', 124, '1498402189'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-07-01', 2, '1498900738'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-07-05', 5, '1499263007'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-07-10', 258, '1499702142'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-07-11', 3152, '1499788742'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-07-12', 4990, '1499875145'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-07-13', 242, '1499961525'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-07-14', 45, '1499965917'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-07-15', 8, '1500081116'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-07-18', 71, '1500384115'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-07-19', 61, '1500477883'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-07-20', 242, '1500565777'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-07-21', 655, '1500652732'),
('::1', 'Firefox', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0', 'Windows', '', '', '2017-07-22', 85, '1500657076'),
('::1', 'Chrome', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 'Windows', '', '', '2019-07-27', 172, '1564223929');

-- --------------------------------------------------------

--
-- Table structure for table `umur`
--

CREATE TABLE IF NOT EXISTS `umur` (
  `id_umur` int(11) NOT NULL,
  `male` int(11) NOT NULL,
  `female` int(11) NOT NULL,
  `editor` int(5) NOT NULL DEFAULT '1',
  `active` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `umur`
--

INSERT INTO `umur` (`id_umur`, `male`, `female`, `editor`, `active`) VALUES
(1, 12, 22, 1, 'Y'),
(2, 23, 36, 1, 'Y'),
(3, 12, 23, 1, 'Y'),
(4, 142, 232, 1, 'Y'),
(5, 132, 153, 1, 'Y'),
(6, 123, 143, 1, 'Y'),
(7, 231, 232, 1, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `umur_description`
--

CREATE TABLE IF NOT EXISTS `umur_description` (
  `id_umur_description` int(11) NOT NULL,
  `id_umur` int(11) NOT NULL,
  `id_language` int(5) NOT NULL DEFAULT '1',
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `umur_description`
--

INSERT INTO `umur_description` (`id_umur_description`, `id_umur`, `id_language`, `title`) VALUES
(1, 1, 1, '0-4'),
(2, 1, 2, '0-4'),
(3, 2, 1, '5-9'),
(4, 2, 2, '5-9'),
(5, 3, 1, '10-14'),
(6, 3, 2, '10-14'),
(7, 4, 1, '15-19'),
(8, 4, 2, '15-19'),
(9, 5, 1, '20-24'),
(10, 5, 2, '20-24'),
(11, 6, 1, '25-29'),
(12, 6, 2, '25-29'),
(13, 7, 1, '30-34'),
(14, 7, 2, '30-34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `bio` text NOT NULL,
  `picture` varchar(255) NOT NULL,
  `level` varchar(20) NOT NULL DEFAULT '2',
  `block` enum('Y','N') NOT NULL DEFAULT 'N',
  `id_session` varchar(100) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `forget_key` varchar(100) DEFAULT NULL,
  `locktype` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `bio`, `picture`, `level`, `block`, `id_session`, `tgl_daftar`, `forget_key`, `locktype`) VALUES
(1, 'admin', '7ef6156c32f427d713144f67e2ef14d2', 'Super Administrator', 'pusenlis@unhas.ac.id', '000-0000-0000', 'Seorang administrator LP2M Puslitbang Energy dan Listrik', '', '1', 'N', '1nshplvjl1j601gjtoog55hst0', '2017-04-25', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `user_level`
--

CREATE TABLE IF NOT EXISTS `user_level` (
  `id_level` int(5) NOT NULL,
  `level` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `role` text NOT NULL,
  `menu` int(5) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_level`
--

INSERT INTO `user_level` (`id_level`, `level`, `title`, `role`, `menu`) VALUES
(1, 'superadmin', 'Super Administrator', '[{"component":"category","create":"1","read":"1","update":"1","delete":"1"},{"component":"comment","create":"1","read":"1","update":"1","delete":"1"},{"component":"component","create":"1","read":"1","update":"1","delete":"1"},{"component":"contact","create":"1","read":"1","update":"1","delete":"1"},{"component":"gallery","create":"1","read":"1","update":"1","delete":"1"},{"component":"home","create":"1","read":"1","update":"1","delete":"1"},{"component":"library","create":"1","read":"1","update":"1","delete":"1"},{"component":"menumanager","create":"1","read":"1","update":"1","delete":"1"},{"component":"oauth","create":"1","read":"1","update":"1","delete":"1"},{"component":"pages","create":"1","read":"1","update":"1","delete":"1"},{"component":"post","create":"1","read":"1","update":"1","delete":"1"},{"component":"setting","create":"1","read":"1","update":"1","delete":"1"},{"component":"user","create":"1","read":"1","update":"1","delete":"1"},{"component":"video","create":"1","read":"1","update":"1","delete":"1"},{"component":"agenda","create":"1","read":"1","update":"1","delete":"1"},{"component":"pengumuman","create":"1","read":"1","update":"1","delete":"1"},{"component":"document","create":"1","read":"1","update":"1","delete":"1"},{"component":"pemdes","create":"1","read":"1","update":"1","delete":"1"},{"component":"statistik","create":"1","read":"1","update":"1","delete":"1"}]', 1),
(2, 'admin', 'Administrator', '[{"component":"category","create":"0","read":"0","update":"0","delete":"0"},{"component":"comment","create":"1","read":"1","update":"1","delete":"1"},{"component":"component","create":"1","read":"1","update":"1","delete":"1"},{"component":"contact","create":"1","read":"1","update":"1","delete":"1"},{"component":"gallery","create":"1","read":"1","update":"1","delete":"1"},{"component":"home","create":"1","read":"1","update":"1","delete":"1"},{"component":"library","create":"1","read":"1","update":"1","delete":"1"},{"component":"menumanager","create":"1","read":"1","update":"1","delete":"1"},{"component":"oauth","create":"1","read":"1","update":"1","delete":"1"},{"component":"pages","create":"1","read":"1","update":"1","delete":"1"},{"component":"post","create":"0","read":"0","update":"0","delete":"0"},{"component":"setting","create":"0","read":"0","update":"0","delete":"0"},{"component":"tag","create":"0","read":"0","update":"0","delete":"0"},{"component":"theme","create":"0","read":"0","update":"0","delete":"0"},{"component":"user","create":"0","read":"0","update":"0","delete":"0"},{"component":"clark","create":"0","read":"0","update":"0","delete":"0"},{"component":"pegawai","create":"0","read":"0","update":"0","delete":"0"}]', 1),
(3, 'manager', 'Manager', '[{"component":"category","create":"1","read":"1","update":"1","delete":"1"},{"component":"comment","create":"1","read":"1","update":"1","delete":"1"},{"component":"component","create":"1","read":"1","update":"1","delete":"1"},{"component":"contact","create":"1","read":"1","update":"1","delete":"1"},{"component":"gallery","create":"1","read":"1","update":"1","delete":"1"},{"component":"home","create":"1","read":"1","update":"1","delete":"1"},{"component":"library","create":"1","read":"1","update":"1","delete":"1"},{"component":"menumanager","create":"1","read":"1","update":"1","delete":"1"},{"component":"oauth","create":"1","read":"1","update":"1","delete":"1"},{"component":"pages","create":"1","read":"1","update":"1","delete":"1"},{"component":"post","create":"1","read":"1","update":"1","delete":"1"},{"component":"setting","create":"0","read":"0","update":"0","delete":"0"},{"component":"tag","create":"1","read":"1","update":"1","delete":"1"},{"component":"theme","create":"1","read":"1","update":"1","delete":"1"},{"component":"user","create":"1","read":"1","update":"1","delete":"0"}]', 1),
(4, 'member', 'Member', '[{"component":"category","create":"1","read":"1","update":"1","delete":"1"},{"component":"comment","create":"0","read":"0","update":"0","delete":"0"},{"component":"component","create":"0","read":"0","update":"0","delete":"0"},{"component":"contact","create":"0","read":"0","update":"0","delete":"0"},{"component":"gallery","create":"1","read":"1","update":"1","delete":"1"},{"component":"home","create":"1","read":"1","update":"1","delete":"1"},{"component":"library","create":"0","read":"0","update":"0","delete":"0"},{"component":"menumanager","create":"0","read":"0","update":"0","delete":"0"},{"component":"oauth","create":"0","read":"0","update":"0","delete":"0"},{"component":"pages","create":"1","read":"1","update":"1","delete":"1"},{"component":"post","create":"1","read":"1","update":"1","delete":"1"},{"component":"setting","create":"0","read":"0","update":"0","delete":"0"},{"component":"tag","create":"1","read":"1","update":"1","delete":"1"},{"component":"theme","create":"0","read":"0","update":"0","delete":"0"},{"component":"user","create":"0","read":"1","update":"1","delete":"1"}]', 1);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id_video` int(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `url` varchar(255) NOT NULL,
  `headline` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id_video`, `title`, `date`, `url`, `headline`) VALUES
(1, 'Video Desa', '2017-01-07', 'https://www.youtube.com/embed/OvkIJMyarWM', 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agama`
--
ALTER TABLE `agama`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `agama_penduduk`
--
ALTER TABLE `agama_penduduk`
  ADD PRIMARY KEY (`id_agama`);

--
-- Indexes for table `agama_penduduk_description`
--
ALTER TABLE `agama_penduduk_description`
  ADD PRIMARY KEY (`id_agama_description`);

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`);

--
-- Indexes for table `agenda_description`
--
ALTER TABLE `agenda_description`
  ADD PRIMARY KEY (`id_agenda_description`);

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id_album`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `category_description`
--
ALTER TABLE `category_description`
  ADD PRIMARY KEY (`id_category_description`);

--
-- Indexes for table `category_document`
--
ALTER TABLE `category_document`
  ADD PRIMARY KEY (`id_category_document`);

--
-- Indexes for table `category_document_description`
--
ALTER TABLE `category_document_description`
  ADD PRIMARY KEY (`id_category_document_description`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indexes for table `component`
--
ALTER TABLE `component`
  ADD PRIMARY KEY (`id_component`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id_document`);

--
-- Indexes for table `document_category`
--
ALTER TABLE `document_category`
  ADD PRIMARY KEY (`id_document_category`);

--
-- Indexes for table `document_description`
--
ALTER TABLE `document_description`
  ADD PRIMARY KEY (`id_document_description`);

--
-- Indexes for table `dusun`
--
ALTER TABLE `dusun`
  ADD PRIMARY KEY (`id_dusun`);

--
-- Indexes for table `dusun_description`
--
ALTER TABLE `dusun_description`
  ADD PRIMARY KEY (`id_dusun_description`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indexes for table `kawin`
--
ALTER TABLE `kawin`
  ADD PRIMARY KEY (`id_kawin`);

--
-- Indexes for table `kawin_description`
--
ALTER TABLE `kawin_description`
  ADD PRIMARY KEY (`id_kawin_description`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id_language`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_group`
--
ALTER TABLE `menu_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth`
--
ALTER TABLE `oauth`
  ADD PRIMARY KEY (`id_oauth`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id_pages`);

--
-- Indexes for table `pages_description`
--
ALTER TABLE `pages_description`
  ADD PRIMARY KEY (`id_pages_description`);

--
-- Indexes for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  ADD PRIMARY KEY (`id_pekerjaan`);

--
-- Indexes for table `pekerjaan_description`
--
ALTER TABLE `pekerjaan_description`
  ADD PRIMARY KEY (`id_pekerjaan_description`);

--
-- Indexes for table `pemdes`
--
ALTER TABLE `pemdes`
  ADD PRIMARY KEY (`id_pemdes`);

--
-- Indexes for table `pemdes_description`
--
ALTER TABLE `pemdes_description`
  ADD PRIMARY KEY (`id_pemdes_description`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id_pendidikan`);

--
-- Indexes for table `pendidikan_description`
--
ALTER TABLE `pendidikan_description`
  ADD PRIMARY KEY (`id_pendidikan_description`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `pengumuman_description`
--
ALTER TABLE `pengumuman_description`
  ADD PRIMARY KEY (`id_pengumuman_description`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`);

--
-- Indexes for table `post_category`
--
ALTER TABLE `post_category`
  ADD PRIMARY KEY (`id_post_category`);

--
-- Indexes for table `post_description`
--
ALTER TABLE `post_description`
  ADD PRIMARY KEY (`id_post_description`);

--
-- Indexes for table `post_gallery`
--
ALTER TABLE `post_gallery`
  ADD PRIMARY KEY (`id_post_gallery`);

--
-- Indexes for table `rw`
--
ALTER TABLE `rw`
  ADD PRIMARY KEY (`id_rw`);

--
-- Indexes for table `rw_description`
--
ALTER TABLE `rw_description`
  ADD PRIMARY KEY (`id_rw_description`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `sosial`
--
ALTER TABLE `sosial`
  ADD PRIMARY KEY (`id_sosial`);

--
-- Indexes for table `sosial_description`
--
ALTER TABLE `sosial_description`
  ADD PRIMARY KEY (`id_sosial_description`);

--
-- Indexes for table `statistik`
--
ALTER TABLE `statistik`
  ADD PRIMARY KEY (`id_statistik`);

--
-- Indexes for table `statistik_description`
--
ALTER TABLE `statistik_description`
  ADD PRIMARY KEY (`id_statistik_description`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id_subscribe`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id_tag`);

--
-- Indexes for table `theme`
--
ALTER TABLE `theme`
  ADD PRIMARY KEY (`id_theme`);

--
-- Indexes for table `umur`
--
ALTER TABLE `umur`
  ADD PRIMARY KEY (`id_umur`);

--
-- Indexes for table `umur_description`
--
ALTER TABLE `umur_description`
  ADD PRIMARY KEY (`id_umur_description`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `user_level`
--
ALTER TABLE `user_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id_video`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agama`
--
ALTER TABLE `agama`
  MODIFY `id_agama` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `agama_penduduk`
--
ALTER TABLE `agama_penduduk`
  MODIFY `id_agama` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `agama_penduduk_description`
--
ALTER TABLE `agama_penduduk_description`
  MODIFY `id_agama_description` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `agenda_description`
--
ALTER TABLE `agenda_description`
  MODIFY `id_agenda_description` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id_album` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `category_description`
--
ALTER TABLE `category_description`
  MODIFY `id_category_description` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `category_document`
--
ALTER TABLE `category_document`
  MODIFY `id_category_document` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `category_document_description`
--
ALTER TABLE `category_document_description`
  MODIFY `id_category_document_description` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `component`
--
ALTER TABLE `component`
  MODIFY `id_component` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id_document` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `document_category`
--
ALTER TABLE `document_category`
  MODIFY `id_document_category` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `document_description`
--
ALTER TABLE `document_description`
  MODIFY `id_document_description` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `dusun`
--
ALTER TABLE `dusun`
  MODIFY `id_dusun` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `dusun_description`
--
ALTER TABLE `dusun_description`
  MODIFY `id_dusun_description` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id_gallery` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `kawin`
--
ALTER TABLE `kawin`
  MODIFY `id_kawin` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `kawin_description`
--
ALTER TABLE `kawin_description`
  MODIFY `id_kawin_description` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id_language` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=197;
--
-- AUTO_INCREMENT for table `menu_group`
--
ALTER TABLE `menu_group`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `oauth`
--
ALTER TABLE `oauth`
  MODIFY `id_oauth` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id_pages` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `pages_description`
--
ALTER TABLE `pages_description`
  MODIFY `id_pages_description` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `pekerjaan`
--
ALTER TABLE `pekerjaan`
  MODIFY `id_pekerjaan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pekerjaan_description`
--
ALTER TABLE `pekerjaan_description`
  MODIFY `id_pekerjaan_description` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pemdes`
--
ALTER TABLE `pemdes`
  MODIFY `id_pemdes` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `pemdes_description`
--
ALTER TABLE `pemdes_description`
  MODIFY `id_pemdes_description` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pendidikan_description`
--
ALTER TABLE `pendidikan_description`
  MODIFY `id_pendidikan_description` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pengumuman_description`
--
ALTER TABLE `pengumuman_description`
  MODIFY `id_pengumuman_description` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `post_category`
--
ALTER TABLE `post_category`
  MODIFY `id_post_category` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `post_description`
--
ALTER TABLE `post_description`
  MODIFY `id_post_description` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `post_gallery`
--
ALTER TABLE `post_gallery`
  MODIFY `id_post_gallery` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rw`
--
ALTER TABLE `rw`
  MODIFY `id_rw` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `rw_description`
--
ALTER TABLE `rw_description`
  MODIFY `id_rw_description` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `sosial`
--
ALTER TABLE `sosial`
  MODIFY `id_sosial` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sosial_description`
--
ALTER TABLE `sosial_description`
  MODIFY `id_sosial_description` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `statistik`
--
ALTER TABLE `statistik`
  MODIFY `id_statistik` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `statistik_description`
--
ALTER TABLE `statistik_description`
  MODIFY `id_statistik_description` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id_subscribe` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id_tag` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `umur`
--
ALTER TABLE `umur`
  MODIFY `id_umur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `umur_description`
--
ALTER TABLE `umur_description`
  MODIFY `id_umur_description` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `user_level`
--
ALTER TABLE `user_level`
  MODIFY `id_level` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
