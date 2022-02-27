-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2022 at 05:44 PM
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
  `id_subject` int(11) NOT NULL,
  `pil1` int(11) NOT NULL,
  `pil2` int(11) DEFAULT NULL COMMENT 'id_kelas_praktikum',
  `pil3` int(11) DEFAULT NULL,
  `pil4` int(11) DEFAULT NULL,
  `PP` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0= nonactive; 1=active;',
  `terpilih` int(11) NOT NULL
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
-- Table structure for table `backup_log`
--

CREATE TABLE `backup_log` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `is_success` tinyint(1) NOT NULL COMMENT '0=gagal; 1=berhasil',
  `keterangan` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
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
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `NIP` int(11) NOT NULL,
  `nama` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id_subject` int(11) NOT NULL,
  `id_laboratorium` int(11) NOT NULL,
  `hari` varchar(12) NOT NULL,
  `jam` varchar(12) NOT NULL,
  `durasi` int(11) NOT NULL,
  `terisi` int(11) NOT NULL,
  `NIP1` varchar(11) NOT NULL,
  `NIP2` varchar(11) DEFAULT NULL,
  `NIP3` varchar(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '0= nonactive; 1=active;'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `laboratorium`
--

CREATE TABLE `laboratorium` (
  `id` int(11) NOT NULL,
  `kode_lab` varchar(2) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `quota_max` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_matakuliah`
--

CREATE TABLE `mahasiswa_matakuliah` (
  `id` int(11) NOT NULL,
  `NRP` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `kode_mk` varchar(6) NOT NULL,
  `id_dosen` int(11) NOT NULL,
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
  `id_lab` int(11) DEFAULT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for table `backup_log`
--
ALTER TABLE `backup_log`
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
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
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
-- AUTO_INCREMENT for table `backup_log`
--
ALTER TABLE `backup_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calon_asisten_dosen`
--
ALTER TABLE `calon_asisten_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `laboratorium`
--
ALTER TABLE `laboratorium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
