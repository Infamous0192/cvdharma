-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 14 Jul 2023 pada 09.49
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cvdcp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gaji`
--

CREATE TABLE `gaji` (
  `id_gaji` int(5) NOT NULL,
  `gaji` int(12) NOT NULL,
  `gaji_bersih` int(12) NOT NULL,
  `potongan` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gaji`
--

INSERT INTO `gaji` (`id_gaji`, `gaji`, `gaji_bersih`, `potongan`) VALUES
(2, 20000, 15000, 5000),
(3, 15000, 10000, 5000),
(4, 10000, 8000, 2000),
(5, 5000, 3500, 1500),
(7, 4000, 4000, 500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(5) NOT NULL,
  `nama_jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Direktur'),
(5, 'Insinyur'),
(7, 'Designer'),
(9, 'Arsitek'),
(12, 'Pegawai'),
(13, 'Office Boy');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kontraktor`
--

CREATE TABLE `kontraktor` (
  `id_kontraktor` int(5) NOT NULL,
  `nama_kontraktor` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT '',
  `id_proyek` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `agama` enum('Islam','Protestan','Katolik','Hindu','Buddha','Khonghucu') NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_jabatan` int(5) DEFAULT NULL,
  `id_gaji` int(5) DEFAULT NULL,
  `id_user` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `jenis_kelamin`, `agama`, `alamat`, `no_telp`, `email`, `id_jabatan`, `id_gaji`, `id_user`) VALUES
(2, 'Ahmad Ridhoni', 'Pria', 'Islam', 'jalan pekauman', '0812528271', 'doni23@gmail.com', 9, 3, 4),
(5, 'Taufik Fadil', 'Pria', 'Islam', 'Jalan Ramin', '08125342716', 'fadhil@email.com', 5, 3, 4),
(7, 'M Anshari', 'Pria', 'Islam', 'Darma Praja', '081243217967', 'anshari@gmail.com', 1, 2, 3),
(8, 'Diwantara Irwan Putra', 'Pria', 'Islam', 'citra land', '08123291837', 'taraputra@gmail.com', 7, 3, 4),
(9, 'Muhammad Gema Andika', 'Pria', 'Islam', 'Citra Land', '081274520393', 'gemagte@gmail.com', 7, 3, 4),
(10, 'Alip M Sevri', 'Pria', 'Islam', 'Komplek Mitramas Pramuka', '081273516987', 'alipman@gmail.com', 9, 3, 4),
(11, 'usup', 'Pria', 'Islam', 'jalan ramin', '08128428461', 'usopp31@gmail.com', 13, 5, 4),
(12, 'Afi ', 'Pria', 'Islam', 'Japos', '085235173969', 'afiman@gmail.com', 12, 5, 4),
(13, 'Michael Soemanto', 'Pria', 'Protestan', 'Darma Praja', '081346713198', 'msoemanto@gmail.com', 5, 3, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengawasan`
--

CREATE TABLE `pengawasan` (
  `id_pengawasan` int(5) NOT NULL,
  `kemajuan` text DEFAULT NULL,
  `periode` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tahun` varchar(50) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `kwitansi` varchar(50) DEFAULT NULL,
  `biaya` varchar(50) DEFAULT NULL,
  `id_proyek` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengawasan`
--

INSERT INTO `pengawasan` (`id_pengawasan`, `kemajuan`, `periode`, `keterangan`, `tahun`, `foto`, `video`, `kwitansi`, `biaya`, `id_proyek`) VALUES
(3, '25%', 'periode pembangunan pertama', 'membuat struktur awal bangunan dan kerangka bangunan', '2022', '64b0ca6c17ed6.jpg', 'https://drive.google.com/file/d/1ETOl3HGmqCJGOzaiSxegS0HRMeNjMDxe/view?usp=drive_link', '64b0ca12d7bff.docx', '10 juta', 11),
(19, '50%', 'periode pembangunan kedua', 'membuat dinding tembok semen dan pengerasan tanah', '2022', '64b0cad05372a.jpg', 'https://drive.google.com/file/d/1XKwmw4CFXkmjmgc2vmPECGor23etRz2c/view?usp=drive_link', '64b0cad0539b8.docx', '25 juta', 11),
(20, '70%', 'periode pembangunan ketiga', 'menguatkan struktur bangunan dan instalasi kelistrikan', '2022', '64b0dbea822f8.png', 'https://drive.google.com/file/d/1DuT1jWUkJkvZkJoVN-iTUkEpoqYAnPVG/view?usp=drive_link', '64b0dbea8263a.docx', '15 juta', 11),
(21, '25%', 'periode pembangunan pertama', 'penggalian dan pengecoran awal', '2022', '64b0e073c03ee.jpg', 'https://drive.google.com/file/d/1zD_WkSWZmCXTlVmP3FDvFOiDmrQAworG/view?usp=drive_link', '64b0e073c05f2.docx', '30 juta', 14),
(22, '25%', 'periode pembangunan pertama', 'pengerasan beton pertama', '2022', '64b0e0f8b1b43.jpg', 'https://drive.google.com/file/d/1X_hEsdkEKt6V5OtT1AFU2ETy6dhBQELy/view?usp=drive_link', '64b0e0f8b1cee.docx', '15 juta', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengawasan_pegawai`
--

CREATE TABLE `pengawasan_pegawai` (
  `id_pengawasan` int(5) NOT NULL,
  `id_pegawai` int(5) NOT NULL,
  `role` enum('Owner','Pegawai','Pengawas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_user` int(5) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin','pegawai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_user`, `username`, `password`, `level`) VALUES
(1, 'user1', 'test1', 'pegawai'),
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(4, 'pegawai', '047aeeb234644b9e2d4138ed3bc7976a', 'pegawai'),
(5, 'vero', 'cc491de401e5dbcde41ef91090975f42', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyek`
--

CREATE TABLE `proyek` (
  `id_proyek` int(5) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `kategori` enum('Bangunan','Jalan','Jembatan') DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `panjang` varchar(50) DEFAULT NULL,
  `lebar` varchar(50) DEFAULT NULL,
  `tinggi` varchar(50) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `dana` bigint(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `proyek`
--

INSERT INTO `proyek` (`id_proyek`, `nama`, `jenis`, `kategori`, `alamat`, `panjang`, `lebar`, `tinggi`, `tanggal_mulai`, `tanggal_selesai`, `dana`) VALUES
(11, 'Kantor cv dharma baru', 'Bangunan Rumahan', 'Bangunan', 'Banjarmasin', '20 meter', '15 meter', '10 meter', '2021-07-16', '2022-06-21', 350000000),
(12, 'Jalan Banjar Indah Baru', 'Jalan Kecil Komplek', 'Jalan', 'Banjar Indah permai', '2 km', '20 meter', '0', '2022-07-01', '2023-03-03', 50000000),
(14, 'Jembatan Flyover', 'Jembatan Flyover Besar', 'Jembatan', 'jalan A.Yani', '200 meter', '50 meter', '0', '2022-09-07', '2023-09-15', 700000000),
(17, 'Kantor Baru PT Bina Cipta Dasalindo', 'Bangunan Kecil swasta', 'Bangunan', 'Jalan Banjar Indah', '15 meter', '10 meter', '5 meter', '2022-05-09', '2023-02-09', 200000000),
(18, 'Rumah Sakit Ciputra', 'Rumah Sakit', 'Bangunan', 'Citra Land', '50 meter', '50 meter', '20 meter', '2022-01-09', '2023-06-21', 1000000000),
(19, 'Jembatan Banjar Indah', 'jembatan kecil', 'Jembatan', 'Banjar Indah', '40 meter', '10 meter', '0', '2022-12-01', '2023-07-07', 60000000),
(20, 'Jalan A.Yani', 'Jalan Besar', 'Jalan', 'Jalan A.Yani', '10 km', '50 meter', '0', '2022-06-14', '2023-06-14', 200000000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `kontraktor`
--
ALTER TABLE `kontraktor`
  ADD PRIMARY KEY (`id_kontraktor`),
  ADD KEY `id_proyek` (`id_proyek`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `FK_pegawai_jabatan` (`id_jabatan`),
  ADD KEY `FK_pegawai_gaji` (`id_gaji`),
  ADD KEY `FK_pegawai_pengguna` (`id_user`);

--
-- Indeks untuk tabel `pengawasan`
--
ALTER TABLE `pengawasan`
  ADD PRIMARY KEY (`id_pengawasan`),
  ADD KEY `FK_pengawasan_proyek` (`id_proyek`);

--
-- Indeks untuk tabel `pengawasan_pegawai`
--
ALTER TABLE `pengawasan_pegawai`
  ADD KEY `id_pegawai` (`id_pegawai`),
  ADD KEY `id_pengawasan` (`id_pengawasan`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id_proyek`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `gaji`
--
ALTER TABLE `gaji`
  MODIFY `id_gaji` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `kontraktor`
--
ALTER TABLE `kontraktor`
  MODIFY `id_kontraktor` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pengawasan`
--
ALTER TABLE `pengawasan`
  MODIFY `id_pengawasan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id_proyek` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kontraktor`
--
ALTER TABLE `kontraktor`
  ADD CONSTRAINT `FK__proyek` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `FK_pegawai_gaji` FOREIGN KEY (`id_gaji`) REFERENCES `gaji` (`id_gaji`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_pegawai_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_pegawai_pengguna` FOREIGN KEY (`id_user`) REFERENCES `pengguna` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengawasan`
--
ALTER TABLE `pengawasan`
  ADD CONSTRAINT `FK_pengawasan_proyek` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengawasan_pegawai`
--
ALTER TABLE `pengawasan_pegawai`
  ADD CONSTRAINT `pengawasan_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengawasan_pegawai_ibfk_2` FOREIGN KEY (`id_pengawasan`) REFERENCES `pengawasan` (`id_pengawasan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
