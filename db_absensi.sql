-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2020 at 02:39 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `check_in` time NOT NULL,
  `check_out` time NOT NULL,
  `late` time NOT NULL,
  `work_time` time NOT NULL,
  `date` date NOT NULL,
  `is_late` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_absensi`
--

INSERT INTO `tb_absensi` (`id_absensi`, `id_users`, `check_in`, `check_out`, `late`, `work_time`, `date`, `is_late`, `status`) VALUES
(19, 49, '08:10:14', '15:05:06', '00:10:14', '07:54:52', '2020-11-09', 1, 'Hadir');

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_users`
--

CREATE TABLE `tb_detail_users` (
  `users_id` int(11) NOT NULL,
  `jenis_kelamin` varchar(25) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `check_in` time NOT NULL,
  `check_out` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_detail_users`
--

INSERT INTO `tb_detail_users` (`users_id`, `jenis_kelamin`, `alamat`, `foto`, `tgl_lahir`, `id_jabatan`, `check_in`, `check_out`) VALUES
(49, 'Laki-laki', 'Jl. Kesadaran raya no 12A', 'PhotoGrid_Plus_1602582458834.jpg', '2020-02-05', 9, '08:00:00', '15:00:00');

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
-- Table structure for table `tb_qrcode`
--

CREATE TABLE `tb_qrcode` (
  `id_qrcode` int(11) NOT NULL,
  `qr_code` varchar(50) NOT NULL,
  `id_pegawai` varchar(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_qrcode`
--

INSERT INTO `tb_qrcode` (`id_qrcode`, `qr_code`, `id_pegawai`, `date`) VALUES
(2, 'PG-7116172_2020-11-03.png', 'PG-7116172', '2020-11-03'),
(3, 'PG-7116172_2020-11-09.png', 'PG-7116172', '2020-11-09'),
(4, 'PG-711617_2020-11-09.png', 'PG-711617', '2020-11-09');

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
-- Table structure for table `tb_surat_tidak_hadir`
--

CREATE TABLE `tb_surat_tidak_hadir` (
  `id_surat` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `alasan` text NOT NULL,
  `bukti` varchar(50) NOT NULL,
  `id_users` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id_users` int(11) NOT NULL,
  `no_pegawai` varchar(20) NOT NULL,
  `nik` varchar(16) NOT NULL,
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

INSERT INTO `tb_users` (`id_users`, `no_pegawai`, `nik`, `nama_lengkap`, `email`, `no_telp`, `password`, `device_id`, `role`, `is_verified`) VALUES
(6, 'admin', '0', 'admin', 'admin@gmail.com', '089669615426', '$2y$10$Jxbjk.foKOGCTpchQ9FXtegRg1nIGm7o4244Ozni/8.U9FWYy24eW', 'asdas', 1, 1),
(49, 'PG-7116172', '3175032802000009', 'Genta Prima Syahnur', 'gentaprima600@gmail.com', '089669615427', '$2y$10$s8glNXZkiTW9e2ZQQASayuuks1Txu2EivgCZSM1THlMQvpf3BS7Lu', 'd0319e458dd7f1c2', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `tb_detail_users`
--
ALTER TABLE `tb_detail_users`
  ADD PRIMARY KEY (`users_id`),
  ADD KEY `id_shift` (`check_in`),
  ADD KEY `tb_detail_users_ibfk_3` (`id_jabatan`);

--
-- Indexes for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tb_qrcode`
--
ALTER TABLE `tb_qrcode`
  ADD PRIMARY KEY (`id_qrcode`);

--
-- Indexes for table `tb_shift`
--
ALTER TABLE `tb_shift`
  ADD PRIMARY KEY (`id_shift`);

--
-- Indexes for table `tb_surat_tidak_hadir`
--
ALTER TABLE `tb_surat_tidak_hadir`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_qrcode`
--
ALTER TABLE `tb_qrcode`
  MODIFY `id_qrcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_shift`
--
ALTER TABLE `tb_shift`
  MODIFY `id_shift` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_surat_tidak_hadir`
--
ALTER TABLE `tb_surat_tidak_hadir`
  MODIFY `id_surat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD CONSTRAINT `tb_absensi_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `tb_users` (`id_users`);

--
-- Constraints for table `tb_detail_users`
--
ALTER TABLE `tb_detail_users`
  ADD CONSTRAINT `tb_detail_users_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `tb_users` (`id_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_users_ibfk_3` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
