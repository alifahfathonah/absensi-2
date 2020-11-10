-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2020 at 09:17 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_users`
--

CREATE TABLE `tb_detail_users` (
  `users_id` int(11) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_shift` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_users`
--

INSERT INTO `tb_detail_users` (`users_id`, `jenis_kelamin`, `alamat`, `agama`, `foto`, `tgl_lahir`, `id_jabatan`, `id_shift`) VALUES
(40, 'Laki-laki', 'Jakarta Timur', '', '', '1999-10-20', 7, 1),
(41, 'Laki-laki', 'Buaran', '', '', '0000-00-00', 7, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(20) NOT NULL,
  `gaji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id_jabatan`, `nama_jabatan`, `gaji`) VALUES
(1, 'Direktur', 10000000),
(2, 'Komisaris', 9500000),
(3, 'Supervisor', 8000000),
(4, 'Admin', 6000000),
(6, 'Accounting', 6500000),
(7, 'Gudang', 5000000),
(8, 'General Officer', 5500000),
(9, 'Produksi', 5000000),
(11, 'Purchasing', 4500000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_shift`
--

CREATE TABLE `tb_shift` (
  `id_shift` int(11) NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `check_in` time NOT NULL,
  `check_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_shift`
--

INSERT INTO `tb_shift` (`id_shift`, `keterangan`, `check_in`, `check_out`) VALUES
(1, 'Shift 1', '08:00:00', '15:00:00'),
(3, 'Shift 2', '15:00:00', '23:00:00'),
(4, 'Shift 3', '00:00:00', '06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id_users` int(11) NOT NULL,
  `no_pegawai` varchar(20) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `device_id` varchar(25) NOT NULL,
  `role` int(11) NOT NULL,
  `is_verified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_users`, `no_pegawai`, `nama_lengkap`, `email`, `no_telp`, `password`, `device_id`, `role`, `is_verified`) VALUES
(6, 'admin', 'admin', 'admin@gmail.com', '089669615426', '$2y$10$Jxbjk.foKOGCTpchQ9FXtegRg1nIGm7o4244Ozni/8.U9FWYy24eW', 'asdas', 1, 1),
(40, 'PG-35206', 'Genta Prima Syahnur', 'gentaprima600@gmail.com', '0123123', '$2y$10$MTD18t7dXHp.jgmUO/ZGyuavd6vleGiMA9z/g8p.p9ygaJPnuBv3q', '953210652a54100b', 0, 1),
(41, 'PG-37632', 'Farhan Ali', 'farhanalifauzan00@gmail.com', '08965454334', '$2y$10$R/GqXACQGAJk9pEGr9DeUeyfu6z7xpXnHEWx08Ybg3/HTubzDXdXW', '8d6731fc2300406d', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_detail_users`
--
ALTER TABLE `tb_detail_users`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `id_shift` (`id_shift`),
  ADD KEY `tb_detail_users_ibfk_3` (`id_jabatan`);

--
-- Indexes for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tb_shift`
--
ALTER TABLE `tb_shift`
  ADD PRIMARY KEY (`id_shift`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_shift`
--
ALTER TABLE `tb_shift`
  MODIFY `id_shift` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detail_users`
--
ALTER TABLE `tb_detail_users`
  ADD CONSTRAINT `tb_detail_users_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `tb_users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_users_ibfk_2` FOREIGN KEY (`id_shift`) REFERENCES `tb_shift` (`id_shift`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_users_ibfk_3` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
