/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE IF NOT EXISTS `gaji` (
  `id_gaji` int(5) NOT NULL AUTO_INCREMENT,
  `gaji` int(12) NOT NULL,
  `gaji_bersih` int(12) DEFAULT NULL,
  `potongan` int(12) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `tanggal_gaji` date DEFAULT NULL,
  PRIMARY KEY (`id_gaji`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `jabatan` (
  `id_jabatan` int(5) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `kontraktor` (
  `id_kontraktor` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kontraktor` varchar(50) NOT NULL,
  `penanggung_jawab` varchar(50) NOT NULL DEFAULT '0',
  `telp` varchar(50) NOT NULL DEFAULT '0',
  `alamat` varchar(50) NOT NULL DEFAULT '0',
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT '',
  `id_proyek` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_kontraktor`),
  KEY `id_proyek` (`id_proyek`),
  CONSTRAINT `FK__proyek` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id_pegawai` int(5) NOT NULL AUTO_INCREMENT,
  `nik` varchar(50) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `pendapatan` (
  `id_pendapatan` int(5) NOT NULL AUTO_INCREMENT,
  `nominal` bigint(20) NOT NULL DEFAULT '0',
  `tahun` int(4) NOT NULL DEFAULT '0',
  `id_proyek` int(5) DEFAULT NULL,
  PRIMARY KEY (`id_pendapatan`),
  KEY `FK_pendapatan_proyek` (`id_proyek`),
  CONSTRAINT `FK_pendapatan_proyek` FOREIGN KEY (`id_proyek`) REFERENCES `proyek` (`id_proyek`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=armscii8;

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `pengawasan_pegawai` (
  `id_pengawasan` int(5) NOT NULL,
  `id_pegawai` int(5) NOT NULL,
  `role` enum('Owner','Pegawai','Pengawas') NOT NULL,
  KEY `id_pegawai` (`id_pegawai`),
  KEY `id_pengawasan` (`id_pengawasan`),
  CONSTRAINT `pengawasan_pegawai_ibfk_1` FOREIGN KEY (`id_pegawai`) REFERENCES `pegawai` (`id_pegawai`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pengawasan_pegawai_ibfk_2` FOREIGN KEY (`id_pengawasan`) REFERENCES `pengawasan` (`id_pengawasan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `pengeluaran` (
  `id_pengeluaran` int(5) NOT NULL AUTO_INCREMENT,
  `nominal` bigint(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pengeluaran`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=armscii8;

CREATE TABLE IF NOT EXISTS `pengguna` (
  `id_user` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin','pegawai') NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
