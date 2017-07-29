-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 29, 2017 at 09:38 
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perwalian-inten4`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nama`, `alamat`) VALUES
(1, 'Ir. Subagja', 'jl lorem'),
(2, 'Dr. Soekardji Soenatartodjo ', NULL),
(3, 'Radjiman Widiodiningrat Ph.D', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dosen_matkul`
--

CREATE TABLE `dosen_matkul` (
  `id` int(11) NOT NULL,
  `id_matkul` int(11) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_dosen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`, `id_dosen`) VALUES
(1, 'Teknik Informatika', 1),
(2, 'Teknik Sipil', 2),
(3, 'Teknik Arsitektur', 3),
(4, 'Teknk Elektro', 4);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `npm` varchar(50) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `hp` varchar(255) DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `angkatan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`npm`, `nama`, `alamat`, `hp`, `id_jurusan`, `angkatan`) VALUES
('01116005', 'Dadan Satria', 'sadang saip', NULL, 1, '2015'),
('1116006', 'Dadan Lorem', 'Bandung Gundul Pacul', NULL, 2, '2015'),
('11178', 'Dadan', 'jl burung gerjea', NULL, 3, '2016');

-- --------------------------------------------------------

--
-- Table structure for table `matkul`
--

CREATE TABLE `matkul` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `id_semester` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `sks` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matkul`
--

INSERT INTO `matkul` (`id`, `kode`, `id_jurusan`, `id_dosen`, `semester`, `id_semester`, `nama`, `sks`) VALUES
(1, 'IF101', 1, 2, 1, 1, 'Dasar Dasar Kerekayasaan', 1),
(2, 'IF102', 1, 1, 1, 1, 'Algoritma Pemrograman', 2),
(3, 'IF103', 1, 3, 1, 1, 'Sistem Informasi', 1),
(4, 'IF104', 1, 1, 1, 1, 'Pengenalan Hardware', 1),
(5, 'SP001', 2, NULL, 1, 0, 'Matematika Teknik', 2),
(6, 'SP002', 2, NULL, 1, 0, 'Dasar Bangunan', 2),
(7, 'SP003', 2, NULL, 1, 0, 'Konstruksi Batu Beton', 2),
(8, 'SP004', 2, NULL, 1, 0, 'Mekanisme Bangunan Dasar', 2),
(9, 'SP001', 3, NULL, 1, 0, 'Seni Desain', 2),
(10, 'SP002', 3, NULL, 1, 0, 'Gambar Bangunan', 2),
(11, 'SP003', 3, NULL, 1, 0, 'Matematika Teknik', 2),
(12, 'SP004', 3, NULL, 1, 0, 'Bangun Ruang', 2),
(13, 'IF201', 1, NULL, 2, 2, 'Pemrograman Web Lanjut', 2),
(14, 'IF202', 1, NULL, 2, 2, 'Pemrograman Java Lanjut', 2),
(15, 'IF203', 1, NULL, 2, 2, 'Fisika Lanjut', 2),
(16, 'IF204', 1, NULL, 2, 2, 'Pengenalan AI', 2),
(17, 'SP201', 2, NULL, 2, 2, 'Konstruksi Baja Beton', 2),
(18, 'SP202', 2, NULL, 2, 2, 'Arsitektur Pesawat', 2),
(19, 'SP203', 2, NULL, 2, 2, 'Jalur Kereta Api', 2),
(20, 'SP204', 2, NULL, 2, 2, 'Pengenalan AUTOCAD', 2),
(21, 'IF301', 1, NULL, 3, 1, 'Dasar Kelistrikan', 2),
(22, 'IF302', 1, NULL, 3, 1, 'Arsitektur Komputer', 2),
(23, 'IF303', 1, NULL, 3, 1, 'Manajemen Risiko', 2),
(24, 'IF304', 1, NULL, 3, 1, 'Elektronika Dasar', 2),
(25, 'IF401', 1, NULL, 4, 2, 'Elektronika Lanjut', 2),
(26, 'IF402', 1, NULL, 4, 2, 'Teknologi Game', 2),
(27, 'IF403', 1, NULL, 4, 2, 'Filosofi Galge MMRPGO', 2),
(28, 'IF404', 1, NULL, 4, 2, 'Java Android', 2),
(39, 'IF501', 1, NULL, 5, 1, 'Pengenalan Elektronika Mikro', 1),
(40, 'IF502', 1, NULL, 5, 1, 'Microcontroller', 2),
(41, 'IF503', 2, NULL, 5, 1, 'Matematika Terapan II', 2),
(42, 'IF504', 3, NULL, 5, 1, 'Fisika Bumi', 2),
(43, 'IF505', 4, NULL, 5, 1, 'Ilmu Tanah', 2);

-- --------------------------------------------------------

--
-- Table structure for table `matkul_mahasiswa`
--

CREATE TABLE `matkul_mahasiswa` (
  `id` int(11) NOT NULL,
  `id_mahasiswa` varchar(50) NOT NULL,
  `id_makul` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `matkul_mahasiswa`
--

INSERT INTO `matkul_mahasiswa` (`id`, `id_mahasiswa`, `id_makul`, `semester`, `id_semester`, `id_status`) VALUES
(1, '01116005', 1, 1, 1, 2),
(2, '01116005', 2, 1, 1, 2),
(3, '01116005', 3, 1, 1, 2),
(4, '01116005', 4, 3, 1, 2),
(5, '01116005', 5, 1, 0, 2),
(6, '01116005', 6, 1, 0, 2),
(7, '01116005', 7, 1, 0, 2),
(8, '01116005', 8, 1, 0, 2),
(9, '01116005', 9, 1, 0, 2),
(10, '01116005', 10, 1, 0, 2),
(11, '01116005', 11, 1, 0, 2),
(12, '01116005', 12, 1, 0, 2),
(13, '01116005', 13, 2, 2, 2),
(14, '01116005', 14, 2, 2, 2),
(15, '01116005', 15, 2, 2, 2),
(16, '01116005', 16, 2, 2, 2),
(17, '01116005', 17, 2, 2, 2),
(18, '01116005', 18, 2, 2, 2),
(19, '01116005', 19, 2, 2, 2),
(20, '01116005', 20, 2, 2, 2),
(21, '01116005', 21, 3, 1, 2),
(22, '01116005', 22, 3, 1, 2),
(23, '01116005', 23, 3, 1, 2),
(24, '01116005', 24, 3, 1, 2),
(25, '01116005', 25, 4, 2, 2),
(26, '01116005', 26, 4, 2, 2),
(27, '01116005', 27, 4, 2, 2),
(28, '01116005', 28, 4, 2, 2),
(29, '01116005', 39, 5, 1, 2),
(30, '01116005', 40, 5, 1, 2),
(31, '01116005', 41, 5, 1, 2),
(32, '01116005', 42, 5, 1, 2),
(33, '01116005', 43, 5, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `perwalian`
--

CREATE TABLE `perwalian` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `npm` varchar(255) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perwalian`
--

INSERT INTO `perwalian` (`id`, `nama`, `id_dosen`, `npm`, `semester`, `keterangan`, `status`) VALUES
(22, 'Perwalian Semester 1', 1, '01116005', 1, 'keterangan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `perwalian_matkul`
--

CREATE TABLE `perwalian_matkul` (
  `id` int(11) NOT NULL,
  `id_matkul` int(11) DEFAULT NULL,
  `id_perwalian` int(11) DEFAULT NULL,
  `nilai` varchar(255) DEFAULT '',
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perwalian_matkul`
--

INSERT INTO `perwalian_matkul` (`id`, `id_matkul`, `id_perwalian`, `nilai`, `status`) VALUES
(54, 1, 22, '', 2),
(55, 2, 22, '90', 1),
(56, 3, 22, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role` int(2) NOT NULL,
  `npm` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `access_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_hapus` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role`, `npm`, `id_dosen`, `username`, `password`, `nama`, `email`, `auth_key`, `access_token`, `status_hapus`) VALUES
(3, 3, '01116005', NULL, '01116005', '$2y$13$kNMHRGSIgIzA667kuc6Oie4XY5IYIhRUangd/0.u0K1WCknAPU3Ti', 'Dadan Satria', '', '', '', NULL),
(4, 2, NULL, 1, 'subagja', '$2y$13$kNMHRGSIgIzA667kuc6Oie4XY5IYIhRUangd/0.u0K1WCknAPU3Ti', '', NULL, NULL, NULL, NULL),
(5, 1, NULL, NULL, 'admin', '$2y$13$kNMHRGSIgIzA667kuc6Oie4XY5IYIhRUangd/0.u0K1WCknAPU3Ti', '', NULL, NULL, NULL, NULL),
(6, 2, NULL, 2, 'gunawansyah', '$2y$13$kNMHRGSIgIzA667kuc6Oie4XY5IYIhRUangd/0.u0K1WCknAPU3Ti', '', NULL, NULL, NULL, NULL),
(7, 2, NULL, 3, 'aziz123', '$2y$13$kNMHRGSIgIzA667kuc6Oie4XY5IYIhRUangd/0.u0K1WCknAPU3Ti', '', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen_matkul`
--
ALTER TABLE `dosen_matkul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`npm`);

--
-- Indexes for table `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matkul_mahasiswa`
--
ALTER TABLE `matkul_mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perwalian`
--
ALTER TABLE `perwalian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perwalian_matkul`
--
ALTER TABLE `perwalian_matkul`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_perwalian` (`id_perwalian`),
  ADD KEY `id_matkul` (`id_matkul`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_kode_pegawai_0882_21` (`npm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `dosen_matkul`
--
ALTER TABLE `dosen_matkul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `matkul`
--
ALTER TABLE `matkul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `matkul_mahasiswa`
--
ALTER TABLE `matkul_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `perwalian`
--
ALTER TABLE `perwalian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `perwalian_matkul`
--
ALTER TABLE `perwalian_matkul`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `perwalian_matkul`
--
ALTER TABLE `perwalian_matkul`
  ADD CONSTRAINT `perwalian_matkul_ibfk_1` FOREIGN KEY (`id_perwalian`) REFERENCES `perwalian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `perwalian_matkul_ibfk_2` FOREIGN KEY (`id_matkul`) REFERENCES `matkul` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
