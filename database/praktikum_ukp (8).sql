-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2022 at 04:39 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `praktikum_ukp`
--

-- --------------------------------------------------------

--
-- Table structure for table `ambil_praktikum`
--

CREATE TABLE `ambil_praktikum` (
  `id` int(11) NOT NULL,
  `id_pendaftaran_praktikum` int(11) NOT NULL,
  `id_mahasiswa_matakuliah` int(11) NOT NULL,
  `NRP` varchar(11) NOT NULL,
  `kode_mk` varchar(6) NOT NULL,
  `pil1` int(11) NOT NULL,
  `pil2` int(11) DEFAULT NULL COMMENT 'id_kelas_praktikum',
  `pil3` int(11) DEFAULT NULL,
  `pil4` int(11) DEFAULT NULL,
  `PP` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0= nonactive; 1=active;',
  `terpilih` int(11) NOT NULL,
  `semester` tinyint(4) NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `asisten_dosen`
--

CREATE TABLE `asisten_dosen` (
  `id` int(11) NOT NULL,
  `id_pendaftaran_asisten_dosen` int(11) NOT NULL,
  `NRP` varchar(11) NOT NULL,
  `NIP` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0= nonactive; 1=active',
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asisten_dosen`
--

INSERT INTO `asisten_dosen` (`id`, `id_pendaftaran_asisten_dosen`, `NRP`, `NIP`, `password`, `status`, `keterangan`) VALUES
(1, 1, 'C14180210', '1001', 'asdos', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `tanggal_start` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tanggal_end` timestamp NULL DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `tipe` varchar(100) NOT NULL COMMENT 'praktikum, rekrutmen, custom',
  `status` tinyint(1) NOT NULL COMMENT '0= nonactive; 1=active',
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `calon_asisten_dosen`
--

CREATE TABLE `calon_asisten_dosen` (
  `id` int(11) NOT NULL,
  `NRP` varchar(11) NOT NULL,
  `id_pendaftaran_praktikum` int(11) NOT NULL,
  `upload_transkrip` varchar(100) NOT NULL,
  `upload_foto` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `line_id` varchar(50) NOT NULL,
  `ipk` float(3,2) NOT NULL,
  `motivasi` text NOT NULL,
  `komitmen` text NOT NULL,
  `kelebihan` text NOT NULL,
  `kekurangan` text NOT NULL,
  `pengalaman` text NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0= nonactive; 1=active',
  `keterangan` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `NIP` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL COMMENT '0= nonactive; 1=active;'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`NIP`, `nama`, `email`, `password`, `last_login`, `status`) VALUES
(3, 'Adi Wibowo, S.T.', '', 'adipass', '2022-03-16 08:28:37', 1),
(16, 'Andreas Handojo, S.T.', '', 'andreaspass', '2009-06-23 20:21:05', 1),
(1006, 'Cherry Galatia Balangan, S.Si,', '', 'cherrypass', '2022-03-16 08:28:37', 1),
(1036, 'Agustinus Noertjahyana, S.Kom,', '', 'agustinuspass', '2009-01-05 18:25:11', 1),
(1043, 'Silvia Rostianingsih, S.Kom, M', '', 'silviapass', '2009-01-07 17:33:25', 1),
(2030, 'Ir. Gregorius Satia Budhi, M.T', '', 'gregoriuspass', '2009-01-06 22:26:27', 1),
(2031, 'Herry Christian Palit, ST, MT', '', '02031pass', '2022-03-16 08:28:37', 1),
(2038, 'David Sundoro, S.T.', '', 'davidpass', '2022-03-16 08:28:37', 1),
(2055, 'Ibnu Gunawan, S.T, MCT, MCDBA', '', 'ibnupass', '2007-01-08 23:38:32', 1),
(3023, 'Leo Willyanto Santoso, S.Kom', '', 'leopass', '2009-01-05 18:26:46', 1),
(3024, 'Liliana, S.T.', '', 'lilianapas', '2007-01-08 02:12:03', 1),
(3030, 'Iwan Njoto Sandjaja, S.T', '', '03030pass', '2022-03-16 08:28:37', 1),
(4002, 'Arie Wirawan Margono, S.Kom', '', 'ariepass', '2022-03-16 08:28:37', 1),
(4007, 'Ong Mei Ling', '', '04007pass', '2022-03-16 08:28:37', 1),
(4017, 'Zeplin Jiwa Husada Tarigan', '', '04017pass', '2022-03-16 08:28:37', 1),
(4021, 'Alexander Setiawan, S. Kom', '', 'alexanderpass', '2009-01-07 02:52:59', 1),
(4034, 'Felicia Soedjianto, S. Kom', '', 'feliciapass', '2022-03-16 08:28:37', 1),
(4043, 'Shanti', '', 'shantipass', '2022-03-16 08:28:37', 1),
(10025, 'Maureen Tanuadji', '', '10025pass', '2022-03-16 08:28:37', 1),
(41091, 'Hadi', '', 'hadipass', '2022-03-16 08:28:37', 1),
(42391, 'Christian', '', '42391pass', '2022-03-16 08:28:37', 1),
(44389, 'Inu Laksito, Drs., M.Sc.', '', 'inupass', '2022-03-16 08:28:37', 1),
(44639, 'Lianawati Andoko', '', '44639pass', '2022-03-16 08:28:37', 1),
(45000, 'None', '', 'nonepass', '2022-03-16 08:28:37', 1),
(45023, 'Indro Setiawan', '', '45023pass', '2009-01-08 19:04:26', 1),
(45024, 'Andy Lo', '', 'andylopass', '2009-01-07 17:41:42', 1),
(45029, 'Dr. Ir. Joko Lianto Buliali, M', '', 'jokopass', '2022-03-16 08:28:37', 1),
(45030, 'Dr. Drs. Moh. Isa Irawan, M.T.', '', 'isapass', '2022-03-16 08:28:37', 1),
(45082, 'Adi Suryaputra', '', '45082pass', '2022-03-16 08:28:37', 1),
(45103, 'Andreas Soebagio', '', 'andreasspass', '2022-03-16 08:28:37', 1),
(45110, 'Endang', '', 'endangpass', '2022-03-16 08:28:37', 1),
(45128, 'Dwi Budiman', '', '45128pass', '2022-03-16 08:28:37', 1),
(45142, 'Eddy, S. Kom', '', '45142pass', '2009-01-06 22:51:38', 1),
(45143, 'Ronald Paska Ongkodjojo', '', '45143pass', '2022-03-16 08:28:37', 1),
(45145, 'Anita Nathania Purbowo', '', '45145pass', '2009-01-06 22:53:46', 1),
(45160, 'Andreas Kiswono Prayogo', '', '45160pass', '2022-03-16 08:28:37', 1),
(45177, 'Prasetio Tjondrokusumo', '', '45177pass', '2022-03-16 08:28:37', 1),
(45181, 'Edwin Nandra Prasetio', '', '45181pass', '2022-03-16 08:28:37', 1),
(45182, 'Stephanus Surya Jaya', '', '45182pass', '2022-03-16 08:28:37', 1),
(45214, 'Nehemia Sugianto', '', '45214pass', '2022-03-16 08:28:37', 1),
(76010, 'Arlinah Imam Rahardjo, SIP, ML', '', 'arlinahpass', '2022-03-16 08:28:37', 1),
(84007, 'Ir. Sukanto Tedjokusuma, M.Sc', '', 'sukantopass', '2022-03-16 08:28:37', 1),
(85009, 'Ir. Djoni Haryadi Setiabudi, M', '', 'djonipass', '2009-06-23 20:21:44', 1),
(88004, 'Ir. Kartika Gunadi, M.T.', '', 'gunadipass', '2009-01-05 18:29:11', 1),
(89006, 'Fredi Suryadi, S.Si., M.Si.', '', 'fredipass', '2022-03-16 08:28:37', 1),
(91024, 'Ir. Resmana Lim, M.Eng', '', 'resmanapass', '2022-03-16 08:28:37', 1),
(92005, 'Ir. Theresia Lestiowati, M.Sc.', '', 'theresiapass', '2022-03-16 08:28:37', 1),
(92008, 'Dr. Ir. Rolly Intan, M.A.Sc.', '', 'rollypass', '2022-03-16 08:28:37', 1),
(94014, 'Oviliani Yenti Yuliana', '', '94014pass', '2009-01-05 18:35:36', 1),
(96006, 'Petrus Santoso, S.T., M.Sc.', '', 'petruspass', '2022-03-16 08:28:37', 1),
(98011, 'Lily Puspa Dewi', '', '98011pass', '2022-03-16 08:28:37', 1),
(98018, 'Irwan Kristanto J. S.T., S.Kom', '', 'irwanpass', '2022-03-16 08:28:37', 1),
(98031, 'Justinus Andjarwirawan, S.T.', '', 'justinuspass', '2022-03-16 08:28:37', 1),
(98057, 'Tanti Octavia, S.T., M. Eng', '', 'tantipass', '2022-03-16 08:28:37', 1),
(99015, 'Rudy Adipranata, S.T., M.Eng', '', 'rudypass', '2009-01-07 17:42:15', 1),
(99023, 'Sri Maharsi, SE, MSCIS', '', 'srimaharsipass', '2022-03-16 08:28:37', 1),
(99036, 'Yulia, S.T., M.Kom', '', 'yuliapass', '2009-01-05 18:31:25', 1),
(99999, 'SAOCP', '', '99999pass', '2022-03-16 08:28:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `informasi_umum`
--

CREATE TABLE `informasi_umum` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nilai` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informasi_umum`
--

INSERT INTO `informasi_umum` (`id`, `nama`, `nilai`) VALUES
(1, 'logo', 'logo-20220314063513.png'),
(2, 'semester', '2'),
(3, 'tahun_ajaran', '2021-2022'),
(4, 'nama_footer', 'Informatics Engineering Petra Christian University'),
(5, 'link_footer', 'https://informatika.petra.ac.id/');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_berhalangan`
--

CREATE TABLE `jadwal_berhalangan` (
  `id` int(11) NOT NULL,
  `NIP` varchar(11) NOT NULL,
  `hari` varchar(12) NOT NULL,
  `jam` varchar(12) NOT NULL,
  `durasi` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_wawancara`
--

CREATE TABLE `jadwal_wawancara` (
  `id` int(11) NOT NULL,
  `NIP` varchar(11) NOT NULL,
  `id_calon_asisten_dosen` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kelas_praktikum`
--

CREATE TABLE `kelas_praktikum` (
  `id` int(11) NOT NULL,
  `kode_kelas_praktikum` varchar(7) NOT NULL,
  `kode_mk` varchar(6) NOT NULL,
  `kode_lab` varchar(5) NOT NULL,
  `hari` varchar(12) NOT NULL,
  `jam` varchar(12) NOT NULL,
  `durasi` int(11) NOT NULL,
  `terisi` int(11) NOT NULL,
  `NIP1` varchar(11) NOT NULL,
  `NIP2` varchar(11) DEFAULT NULL,
  `NIP3` varchar(11) DEFAULT NULL,
  `semester` tinyint(1) NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0= nonactive; 1=active;'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `laboratorium`
--

CREATE TABLE `laboratorium` (
  `kode_lab` varchar(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `quota_max` tinyint(3) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0= nonactive; 1=active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laboratorium`
--

INSERT INTO `laboratorium` (`kode_lab`, `nama`, `quota_max`, `status`) VALUES
('JK', 'Jaringan Komputer', 17, 1),
('KL', 'Kelas', 30, 1),
('KR', 'Kelas Responsi', 40, 1),
('MD', 'MobDev', 20, 1),
('MM', 'Multimedia', 18, 1),
('NA', 'NA', 30, 1),
('OM', 'Online Meeting', 60, 1),
('PG', 'Pemrograman', 23, 1),
('SC', 'Sistem Cerdas', 17, 1),
('SI', 'Sistem Informasi', 30, 1),
('ST', 'Studio', 34, 1),
('TD', 'Pusat Komputer TD', 38, 1),
('TE', 'Pusat Komputer TE', 38, 1),
('VR', 'Virtual Reality', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NRP` varchar(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `angkatan` varchar(4) NOT NULL,
  `ips` float(3,2) NOT NULL,
  `ipk` float(3,2) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL COMMENT '0=nonactive; 1=active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`NRP`, `nama`, `angkatan`, `ips`, `ipk`, `password`, `email`, `last_login`, `status`) VALUES
('C14180210', 'Cynthia', '2018', 1.00, 1.00, 'cynthia', '', '2022-03-16 08:39:52', 1),
('m26415008', 'TANU WIJAYA SARIDIN', '2015', 0.00, 2.79, '41500', 'm26415008@john.petra.ac.id', '2022-03-01 11:16:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_matakuliah`
--

CREATE TABLE `mahasiswa_matakuliah` (
  `id` int(11) NOT NULL,
  `NRP` int(11) NOT NULL,
  `kode_mk` varchar(6) NOT NULL,
  `kelas_paralel` char(1) NOT NULL,
  `semester` tinyint(1) NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_nilai`
--

CREATE TABLE `mahasiswa_nilai` (
  `id` int(11) NOT NULL,
  `id_kelas_praktikum` int(11) NOT NULL,
  `pertemuan` tinyint(2) NOT NULL,
  `NRP` varchar(11) NOT NULL,
  `nilai_awal` int(11) NOT NULL,
  `nilai_materi` int(11) NOT NULL,
  `nilai_tugas` int(11) NOT NULL,
  `status_absensi` char(1) NOT NULL COMMENT 'm = masuk; a=apla; i=ijin',
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_asisten_dosen`
--

CREATE TABLE `pendaftaran_asisten_dosen` (
  `id` int(11) NOT NULL,
  `waktu_start` timestamp NOT NULL DEFAULT current_timestamp(),
  `waktu_end` timestamp NOT NULL DEFAULT current_timestamp(),
  `semester` tinyint(1) NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `keterangan` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pendaftaran_praktikum`
--

CREATE TABLE `pendaftaran_praktikum` (
  `id` int(11) NOT NULL,
  `waktu_start` timestamp NOT NULL DEFAULT current_timestamp(),
  `waktu_end` timestamp NOT NULL DEFAULT current_timestamp(),
  `PP` tinyint(1) NOT NULL,
  `semester` tinyint(1) NOT NULL,
  `tahun_ajaran` varchar(9) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0= nonactive; 1=active',
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendaftaran_praktikum`
--

INSERT INTO `pendaftaran_praktikum` (`id`, `waktu_start`, `waktu_end`, `PP`, `semester`, `tahun_ajaran`, `status`, `keterangan`) VALUES
(1, '2022-03-12 17:35:00', '2022-03-14 17:00:00', 1, 1, '2021-2022', 1, ''),
(2, '2022-03-24 17:41:00', '2022-03-29 15:18:00', 2, 1, '2021-2022', 0, '<p>dfdfasd</p>');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `kode_mk` varchar(6) NOT NULL DEFAULT '0',
  `nama` varchar(30) DEFAULT '0',
  `kelas_paralel` char(1) NOT NULL DEFAULT '',
  `status_praktikum` tinyint(1) UNSIGNED DEFAULT NULL COMMENT '0=tidak ada; 1=ada',
  `status_transfer_nilai` tinyint(1) DEFAULT NULL COMMENT '	0=tidak boleh; 1=boleh',
  `NIP` varchar(5) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '	0=nonactive; 1=active'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`kode_mk`, `nama`, `kelas_paralel`, `status_praktikum`, `status_transfer_nilai`, `NIP`, `status`) VALUES
('TF4223', 'Aljabar Linier dan Matriks', 'A', 0, 0, '99999', 1),
('TF4229', 'Basis Data', 'B', 1, 0, '99999', 1),
('TF4253', 'Jaringan Komputer', 'A', 0, 0, '99999', 1),
('TF4235', 'Pemrograman Berorientasi Obyek', 'A', 0, 0, '99999', 1),
('TF4273', 'Basis Data Lanjut', 'A', 1, 0, '99999', 1),
('TF4229', 'Basis Data', 'A', 1, 0, '99999', 1),
('TF4219', 'Struktur Data', 'A', 1, 0, '99999', 1),
('TF4235', 'Pemrograman Berorientasi Obyek', 'B', 0, 0, '99999', 1),
('TF4243', 'Sistem Operasi', 'A', 1, 0, '99999', 1),
('TF4229', 'Basis Data', 'C', 1, 0, '99999', 1),
('TF4229', 'Basis Data', 'D', 1, 0, '99999', 1),
('TF4243', 'Sistem Operasi', 'B', 1, 0, '99999', 1),
('TF4235', 'Pemrograman Berorientasi Obyek', 'C', 0, 0, '99999', 1),
('TF4229', 'Basis Data', 'E', 1, 0, '99999', 1),
('TF4204', 'Algoritma dan Pemrograman', 'A', 1, 0, '99999', 1),
('TF4235', 'Pemrograman Berorientasi Obyek', 'D', 0, 0, '99999', 1),
('TF4235', 'Pemrograman Berorientasi Obyek', 'E', 0, 0, '99999', 1),
('TF4219', 'Struktur Data', 'B', 1, 0, '99999', 1),
('TF4219', 'Struktur Data', 'C', 1, 0, '99999', 1),
('TF4223', 'Aljabar Linier dan Matriks', 'B', 0, 0, '99999', 1),
('TF4223', 'Aljabar Linier dan Matriks', 'C', 0, 0, '99999', 1),
('TF4253', 'Jaringan Komputer', 'B', 0, 0, '99999', 1),
('TF4253', 'Jaringan Komputer', 'C', 0, 0, '99999', 1),
('TF4273', 'Basis Data Lanjut', 'B', 0, 0, '99999', 1),
('TF4537', 'Konsep Algoritma', 'A', 1, 0, '99999', 1),
('TF4536', 'Dasar Pemrograman', 'A', 1, 0, '99999', 1),
('TF4227', 'Statistika Dasar', 'A', 0, 0, '99999', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `level` tinyint(2) DEFAULT NULL COMMENT '1=admin; 2=kepala lab; 3=astap',
  `id_user_group` int(11) NOT NULL,
  `kode_lab` varchar(5) DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL COMMENT '0= nonactive; 1=active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `level`, `id_user_group`, `kode_lab`, `last_login`, `status`) VALUES
(1, 'admin', 'admin', 'lala@gmail.com', 1, 1, NULL, '2022-03-06 15:21:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0= nonactive; 1=active',
  `keterangan` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `nama`, `status`, `keterangan`, `created`, `updated`) VALUES
(1, 'admin', 1, '<p>administrator 1</p>', '2022-03-06 13:23:38', '2022-03-06 07:37:04'),
(2, 'asisten tetap', 0, '<p>dosen atau alumni&nbsp;</p>', '2022-03-06 16:15:33', '2022-03-06 09:17:28'),
(3, 'lklk', 1, '', '2022-03-08 06:42:08', '2022-03-07 23:42:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_history`
--

CREATE TABLE `user_history` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `action` varchar(10) NOT NULL,
  `keterangan` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_history`
--

INSERT INTO `user_history` (`id`, `id_user`, `table_name`, `action`, `keterangan`, `created`) VALUES
(1, 1, 'laboratorium', 'CREATE', 'a new record has been created by admin : {\"kode_lab\":\"MM\",\"nama\":\"Multimedia\",\"quota_max\":18,\"status\":1}; ', '2022-03-05 09:12:19'),
(2, 1, 'laboratorium', 'UPDATE', 'admin updated record # : :  to ;  to ;  to ;', '2022-03-06 02:17:37'),
(3, 1, 'laboratorium', 'UPDATE', 'admin updated record # : : Multimedia to Multimedia; 18 to 18; 1 to 1;', '2022-03-06 02:19:55'),
(4, 1, 'user_group', 'CREATE', 'a new record has been created by admin : {\"nama\":\"admin\",\"status\":1,\"keterangan\":\"<p>administrator<\\/p>\"}.', '2022-03-06 06:23:38'),
(5, 1, 'user_group', 'UPDATE', 'admin updated record # : : admin to admin; 1 to 1;<p>administrator</p> to <p>administrator 1</p>; ', '2022-03-06 07:37:04'),
(6, 1, 'user_group', 'CREATE', 'a new record has been created by admin : {\"nama\":\"asisten tetap\",\"status\":1,\"keterangan\":\"<p>dosen atau alumni&nbsp;<\\/p>\"}.', '2022-03-06 09:15:33'),
(7, 1, 'user_group', 'UPDATE', 'admin updated record # : : asisten tetap to asisten tetap; 1 to 0;<p>dosen atau alumni&nbsp;</p> to <p>dosen atau alumni&nbsp;</p>; ', '2022-03-06 09:17:28'),
(8, 1, 'laboratorium', 'CREATE', 'a new record has been created by admin : {\"kode_lab\":\"ASDAD\",\"nama\":\"\",\"quota_max\":0,\"status\":1}.', '2022-03-07 21:40:51'),
(9, 1, 'laboratorium', 'CREATE', 'a new record has been created by admin : {\"kode_lab\":\"AF\",\"nama\":\"\",\"quota_max\":0,\"status\":1}.', '2022-03-07 21:42:12'),
(10, 1, 'laboratorium', 'CREATE', 'a new record has been created by admin : {\"kode_lab\":\"ASDDA\",\"nama\":\"asda\",\"quota_max\":12,\"status\":1}.', '2022-03-07 23:28:51'),
(11, 1, 'user_group', 'CREATE', 'a new record has been created by admin : {\"nama\":\"lklk\",\"status\":0,\"keterangan\":\"\"}.', '2022-03-07 23:42:08'),
(12, 1, 'user_group', 'UPDATE', 'admin updated record # : : lklk to lklk; 0 to 1; to ; ', '2022-03-07 23:42:21'),
(13, 1, 'laboratorium', 'CREATE', 'a new record has been created by admin : {\"kode_lab\":\"JK\",\"nama\":\"jaringan\",\"quota_max\":12,\"status\":0}.', '2022-03-08 00:00:34'),
(14, 1, 'laboratorium', 'CREATE', 'a new record has been created by admin : {\"kode_lab\":\"TRE\",\"nama\":\"erwe\",\"quota_max\":999,\"status\":0}.', '2022-03-08 00:01:35'),
(15, 1, 'laboratorium', 'CREATE', 'a new record has been created by admin : {\"kode_lab\":\"OM\",\"nama\":\"Online\",\"quota_max\":999,\"status\":1}.', '2022-03-08 00:03:28'),
(16, 1, 'laboratorium', 'CREATE', 'a new record has been created by admin : {\"kode_lab\":\"COBA\",\"nama\":\"coba\",\"quota_max\":1,\"status\":0}.', '2022-03-09 06:54:26'),
(17, 1, 'laboratorium', 'UPDATE', 'admin updated record # : : asda to wat; 12 to 120; 1 to 1;', '2022-03-09 07:14:53'),
(18, 1, 'laboratorium', 'UPDATE', 'admin updated record # : : coba to coba; 1 to 1; 0 to 0;', '2022-03-09 07:17:16'),
(19, 1, 'laboratorium', 'UPDATE', 'admin updated record # : JK: jaringan to jaringan komputer; 12 to 12; 0 to 1;', '2022-03-09 07:25:34'),
(20, 1, 'laboratorium', 'UPDATE', 'admin updated record # : COBA: coba to coba; 1 to 1; 0 to 1;', '2022-03-09 07:28:56'),
(21, 1, 'laboratorium', 'CREATE', 'a new record has been created by admin : {\"kode_lab\":\"TES\",\"nama\":\"tes\",\"quota_max\":11,\"status\":0}.', '2022-03-09 07:39:44'),
(22, 1, 'laboratorium', 'UPDATE', 'admin updated record # : ASDDA: wat to wats; 120 to 121; 1 to 1;', '2022-03-09 08:42:19'),
(23, 1, 'laboratorium', 'CREATE', 'a new record has been created by admin : {\"kode_lab\":\"LALA\",\"nama\":\"lalalla\",\"quota_max\":12,\"status\":0}.', '2022-03-09 08:42:39'),
(24, 1, 'laboratorium', 'UPDATE', 'admin updated record # : ASDAD:  to ; 0 to 0; 1 to 1;', '2022-03-09 22:08:10'),
(25, 1, 'laboratorium', 'UPDATE', 'admin updated record # : ASDAD:  to aa; 0 to 0; 1 to 0;', '2022-03-09 22:08:25'),
(26, 1, 'laboratorium', 'UPDATE', 'admin updated record # : ASDAD: aa to tes; 0 to 0; 0 to 1;', '2022-03-10 10:02:57'),
(27, 1, 'pendaftaran_praktikum', 'CREATE', 'a new record has been created by admin : {\"waktu_start\":\"2022-03-13 01:35:00\",\"waktu_end\":\"2022-03-15 01:00:00\",\"PP\":1,\"semester\":\"1\",\"tahun_ajaran\":\"2021-2022\",\"status\":1,\"keterangan\":\"\"}.', '2022-03-12 10:36:04'),
(28, 1, 'pendaftaran_praktikum', 'CREATE', 'a new record has been created by admin : {\"waktu_start\":\"2022-03-25 01:41:00\",\"waktu_end\":\"2022-03-29 23:18:00\",\"PP\":2,\"semester\":\"1\",\"tahun_ajaran\":\"2021-2022\",\"status\":0,\"keterangan\":\"<p>dfdfasd<\\/p>\"}.', '2022-03-12 10:42:06'),
(29, 1, 'informasi_umum', 'UPDATE', 'admin updated record # : : 1 to ; 2021-2022 to ; ', '2022-03-13 04:04:01'),
(30, 1, 'informasi_umum', 'UPDATE', 'admin updated record # :  to ;  to 2; ', '2022-03-13 04:26:09'),
(31, 1, 'informasi_umum', 'UPDATE', 'admin updated record # :  to logo-20220314062821.jpg; 2 to ; 2020-2021 to ; ', '2022-03-13 22:28:22'),
(32, 1, 'informasi_umum', 'UPDATE', 'admin updated record # : logo-20220314062821.jpg to logo-20220314063218.jpg; ', '2022-03-13 22:32:19'),
(33, 1, 'informasi_umum', 'UPDATE', 'admin updated record # : logo-20220314063218.jpg to logo-20220314063513.png; ', '2022-03-13 22:35:14'),
(34, 1, 'informasi_umum', 'UPDATE', 'admin updated record # : ', '2022-03-13 23:12:18'),
(35, 1, 'informasi_umum', 'UPDATE', 'admin updated record # : 1 to 2; 2021-2022 to -; ', '2022-03-16 06:09:12'),
(36, 1, 'informasi_umum', 'UPDATE', 'admin updated record # : 2 to 1;  to -; ', '2022-03-16 06:11:09'),
(37, 1, 'informasi_umum', 'UPDATE', 'admin updated record # :  to -; ', '2022-03-16 06:11:40'),
(38, 1, 'informasi_umum', 'UPDATE', 'admin updated record # : 1 to 2;  to -; ', '2022-03-16 06:11:46'),
(39, 1, 'informasi_umum', 'UPDATE', 'admin updated record # :  to 2022; ', '2022-03-16 06:15:05'),
(40, 1, 'informasi_umum', 'UPDATE', 'admin updated record # : 2022 to 2021-2022; ', '2022-03-16 06:18:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ambil_praktikum`
--
ALTER TABLE `ambil_praktikum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asisten_dosen`
--
ALTER TABLE `asisten_dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calon_asisten_dosen`
--
ALTER TABLE `calon_asisten_dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`NIP`);

--
-- Indexes for table `informasi_umum`
--
ALTER TABLE `informasi_umum`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `jadwal_berhalangan`
--
ALTER TABLE `jadwal_berhalangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_wawancara`
--
ALTER TABLE `jadwal_wawancara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas_praktikum`
--
ALTER TABLE `kelas_praktikum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laboratorium`
--
ALTER TABLE `laboratorium`
  ADD PRIMARY KEY (`kode_lab`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NRP`);

--
-- Indexes for table `mahasiswa_matakuliah`
--
ALTER TABLE `mahasiswa_matakuliah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendaftaran_asisten_dosen`
--
ALTER TABLE `pendaftaran_asisten_dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pendaftaran_praktikum`
--
ALTER TABLE `pendaftaran_praktikum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`kode_mk`,`kelas_paralel`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_history`
--
ALTER TABLE `user_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ambil_praktikum`
--
ALTER TABLE `ambil_praktikum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `asisten_dosen`
--
ALTER TABLE `asisten_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calon_asisten_dosen`
--
ALTER TABLE `calon_asisten_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `informasi_umum`
--
ALTER TABLE `informasi_umum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jadwal_berhalangan`
--
ALTER TABLE `jadwal_berhalangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_wawancara`
--
ALTER TABLE `jadwal_wawancara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas_praktikum`
--
ALTER TABLE `kelas_praktikum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa_matakuliah`
--
ALTER TABLE `mahasiswa_matakuliah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendaftaran_asisten_dosen`
--
ALTER TABLE `pendaftaran_asisten_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pendaftaran_praktikum`
--
ALTER TABLE `pendaftaran_praktikum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_history`
--
ALTER TABLE `user_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
