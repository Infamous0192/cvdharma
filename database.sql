/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE IF NOT EXISTS `gaji` (
  `id_gaji` int(5) NOT NULL AUTO_INCREMENT,
  `gaji` int(12) NOT NULL,
  `gaji_bersih` int(12) NOT NULL,
  `potongan` int(12) NOT NULL,
  PRIMARY KEY (`id_gaji`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `gaji` DISABLE KEYS */;
INSERT INTO `gaji` (`id_gaji`, `gaji`, `gaji_bersih`, `potongan`) VALUES
	(2, 20000, 15000, 5000),
	(3, 15000, 10000, 5000),
	(4, 10000, 8000, 2000),
	(5, 5000, 3500, 1500),
	(7, 4000, 4000, 500);
/*!40000 ALTER TABLE `gaji` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `jabatan` (
  `id_jabatan` int(5) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `jabatan` DISABLE KEYS */;
INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
	(1, 'Direktur'),
	(5, 'Insinyur'),
	(7, 'Designer'),
	(9, 'Arsitek'),
	(12, 'Pegawai'),
	(13, 'Office Boy');
/*!40000 ALTER TABLE `jabatan` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `kontraktor` (
  `id_kontraktor` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kontraktor` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT '',
  `id_proyek` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_kontraktor`),
  KEY `id_proyek` (`id_proyek`),
  CONSTRAINT `FK__proyek` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `kontraktor` DISABLE KEYS */;
INSERT INTO `kontraktor` (`id_kontraktor`, `nama_kontraktor`, `tanggal_mulai`, `tanggal_selesai`, `status`, `id_proyek`) VALUES
	(2, 'Laboriosam earum ut', '2004-03-04', '2017-11-09', 'Baru dibangun', 13);
/*!40000 ALTER TABLE `kontraktor` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('Pria','Wanita') NOT NULL,
  `agama` enum('Islam','Protestan','Katolik','Hindu','Buddha','Khonghucu') NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_jabatan` int(5) DEFAULT NULL,
  `id_gaji` int(5) DEFAULT NULL,
  `id_user` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_pegawai`),
  KEY `FK_pegawai_jabatan` (`id_jabatan`),
  KEY `FK_pegawai_gaji` (`id_gaji`),
  KEY `FK_pegawai_pengguna` (`id_user`),
  CONSTRAINT `FK_pegawai_gaji` FOREIGN KEY (`id_gaji`) REFERENCES `gaji` (`id_gaji`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `FK_pegawai_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `FK_pegawai_pengguna` FOREIGN KEY (`id_user`) REFERENCES `pengguna` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `pegawai` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `pegawai` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `pengawasan` (
  `id_pengawasan` int(5) NOT NULL AUTO_INCREMENT,
  `kemajuan` text,
  `periode` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `tahun` varchar(50) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `video` varchar(100) DEFAULT NULL,
  `kwitansi` varchar(50) DEFAULT NULL,
  `biaya` varchar(50) DEFAULT NULL,
  `id_proyek` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pengawasan`),
  KEY `FK_pengawasan_proyek` (`id_proyek`),
  CONSTRAINT `FK_pengawasan_proyek` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `pengawasan` DISABLE KEYS */;
INSERT INTO `pengawasan` (`id_pengawasan`, `kemajuan`, `periode`, `keterangan`, `tahun`, `foto`, `video`, `kwitansi`, `biaya`, `id_proyek`) VALUES
	(2, '95%', NULL, 'Hampir selesai', NULL, NULL, NULL, NULL, NULL, 10),
	(3, '75%', NULL, 'Hampir selesai', NULL, NULL, NULL, NULL, NULL, 11),
	(4, '100%', NULL, 'proyek sudah selesai', NULL, NULL, NULL, NULL, NULL, 12),
	(5, '100%', NULL, 'proyek sudah selesai', NULL, NULL, NULL, NULL, NULL, 13),
	(6, '90%', NULL, 'berlanjut', NULL, NULL, NULL, NULL, NULL, 14),
	(7, '100%', NULL, 'proyek selesai kurang dari 1 tahun', NULL, NULL, NULL, NULL, NULL, 15),
	(8, '100%', NULL, 'selesai dalam waktu 6 tahun', NULL, NULL, NULL, NULL, NULL, 16),
	(9, '100%', NULL, 'proyek sudah selesai', NULL, NULL, NULL, NULL, NULL, 17),
	(10, '100%', NULL, 'Renovasi berupa tambahan bangunan dan juga sedikit perbaikan ', NULL, NULL, NULL, NULL, NULL, 18),
	(12, '100%', NULL, 'Renovasi Jalan karena rusak bekas Banjir ', NULL, NULL, NULL, NULL, NULL, 20),
	(16, 'Inventore odit paria', NULL, 'Nulla quasi et itaqu', NULL, NULL, NULL, NULL, NULL, 20),
	(17, '100%', NULL, 'proyek sudah selesai', NULL, NULL, NULL, NULL, NULL, 21);
/*!40000 ALTER TABLE `pengawasan` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `pengawasan_pegawai` (
  `id_pengawasan` int(5) NOT NULL,
  `id_pegawai` int(5) NOT NULL,
  `role` enum('Owner','Pegawai','Pengawas') NOT NULL,
  KEY `id_pegawai` (`id_pegawai`),
  KEY `id_pengawasan` (`id_pengawasan`),
  CONSTRAINT `pengawasan_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pengawasan_pegawai_ibfk_2` FOREIGN KEY (`id_pengawasan`) REFERENCES `pengawasan` (`id_pengawasan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `pengawasan_pegawai` DISABLE KEYS */;
INSERT INTO `pengawasan_pegawai` (`id_pengawasan`, `id_pegawai`, `role`) VALUES
	(16, 11, 'Owner'),
	(16, 9, 'Owner'),
	(16, 5, 'Owner'),
	(2, 2, 'Owner'),
	(2, 5, 'Owner'),
	(2, 8, 'Owner'),
	(2, 9, 'Pengawas');
/*!40000 ALTER TABLE `pengawasan_pegawai` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `pengguna` (
  `id_user` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin','pegawai') NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` (`id_user`, `username`, `password`, `level`) VALUES
	(1, 'user1', 'test1', 'pegawai'),
	(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
	(4, 'pegawai', '047aeeb234644b9e2d4138ed3bc7976a', 'pegawai'),
	(5, 'vero', 'cc491de401e5dbcde41ef91090975f42', 'admin');
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `proyek` (
  `id_proyek` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `kategori` enum('Bangunan','Jalan','Jembatan') DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `panjang` varchar(50) DEFAULT NULL,
  `lebar` varchar(50) DEFAULT NULL,
  `tinggi` varchar(50) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `dana` bigint(50) DEFAULT NULL,
  PRIMARY KEY (`id_proyek`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

/*!40000 ALTER TABLE `proyek` DISABLE KEYS */;
INSERT INTO `proyek` (`id_proyek`, `nama`, `jenis`, `kategori`, `alamat`, `panjang`, `lebar`, `tinggi`, `tanggal_mulai`, `tanggal_selesai`, `dana`) VALUES
	(10, 'Jembatan Japos', 'jembatan kecil', 'Jembatan', 'japos', '12', '12', '0', NULL, NULL, NULL),
	(11, 'Kantor PT sukses integritas perkasa', 'Bangunan Besar', 'Bangunan', 'Banjarmasin', '20', '15', '10', NULL, NULL, NULL),
	(12, 'Jalan Banjar Indah Baru', 'Jalan Kecil Komplek', 'Jalan', 'Banjar Indah permai', '2', '20', '0', NULL, NULL, NULL),
	(13, 'Ruko ', 'Bangunan Kecil swasta', 'Bangunan', 'Jalan Gatot', '7', '10', '5', NULL, NULL, NULL),
	(14, 'Jembatan Flyover', 'Jembatan Flyover Besar', 'Jembatan', 'jalan A.Yani', '20', '20', '0', NULL, NULL, NULL),
	(15, 'Jalan Citra Land', 'Jalan Kecil Komplek', 'Jalan', 'Citra Land', '2', '30', '0', NULL, NULL, NULL),
	(16, 'Apartemen Gunawangsa', 'Gedung Apartemen', 'Bangunan', 'sukolilo jawa timur', '30', '30', '50', NULL, NULL, NULL),
	(17, 'Kantor Baru PT Bina Cipta Dasalindo', 'Bangunan Kecil swasta', 'Bangunan', 'Jalan Banjar Indah', '7', '5', '5', NULL, NULL, NULL),
	(18, 'Rumah Sakit Ciputra', 'Rumah Sakit', 'Bangunan', 'Citra Land', '50', '50', '20', NULL, NULL, NULL),
	(19, 'Jembatan Banjar Indah', 'jembatan kecil', 'Jembatan', 'Banjar Indah', '15', '8', '0', NULL, NULL, NULL),
	(20, 'Jalan A.Yani', 'Jalan Besar', 'Jalan', 'Jalan A.Yani', '10', '50', '0', NULL, NULL, NULL),
	(21, 'Masjid Raya', 'Tempat Ibadah', 'Bangunan', 'Banjarmasin', '30', '20', '5', NULL, NULL, NULL),
	(23, 'Aut porro libero eiu', 'Impedit adipisicing', 'Bangunan', 'Error dolorem elit ', 'Veniam pariatur Ods', 'Velit fugiat repreh', 'Dolorum dolore conse', '2015-11-18', '2016-09-04', 87);
/*!40000 ALTER TABLE `proyek` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
