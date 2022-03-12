-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2022 at 07:45 PM
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
  `nama` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL COMMENT '0= nonactive; 1=active;'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'logo', ''),
(2, 'semester', '1'),
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
  `id_pendaftaran_praktikum` int(11) NOT NULL,
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
('AF', '', 0, 1),
('ASDAD', 'tes', 0, 1),
('ASDDA', 'wats', 121, 1),
('COBA', 'coba', 1, 1),
('JK', 'jaringan komputer', 12, 1),
('LALA', 'lalalla', 12, 0),
('MM', 'Multimedia', 18, 1),
('OM', 'Online', 127, 1),
('TES', 'tes', 11, 0),
('TRE', 'erwe', 127, 0);

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
  `kode_mk` varchar(6) NOT NULL,
  `NIPDosen` varchar(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kelas_paralel` char(1) NOT NULL,
  `status_praktikum` tinyint(1) NOT NULL COMMENT '0=tidak ada; 1=ada',
  `status_transfer_nilai` tinyint(1) NOT NULL COMMENT '0=tidak boleh; 1=boleh',
  `status` tinyint(1) NOT NULL COMMENT '0=nonactive; 1=active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(28, 1, 'pendaftaran_praktikum', 'CREATE', 'a new record has been created by admin : {\"waktu_start\":\"2022-03-25 01:41:00\",\"waktu_end\":\"2022-03-29 23:18:00\",\"PP\":2,\"semester\":\"1\",\"tahun_ajaran\":\"2021-2022\",\"status\":0,\"keterangan\":\"<p>dfdfasd<\\/p>\"}.', '2022-03-12 10:42:06');

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
  ADD PRIMARY KEY (`kode_mk`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
