/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `id_barang` bigint unsigned NOT NULL AUTO_INCREMENT,
  `ukuran` varchar(255) DEFAULT NULL,
  `harga` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_barang`),
  UNIQUE KEY `id_barang` (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `barang_keluar`;
CREATE TABLE `barang_keluar` (
  `id_barang_keluar` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jumlah` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `total_harga` varchar(255) DEFAULT NULL,
  `id_barang` bigint unsigned DEFAULT NULL,
  `id_pengguna` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id_barang_keluar`),
  UNIQUE KEY `id_barang_keluar` (`id_barang_keluar`),
  KEY `id_barang` (`id_barang`),
  KEY `id_pengguna` (`id_pengguna`),
  CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE,
  CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `barang_masuk`;
CREATE TABLE `barang_masuk` (
  `id_barang_masuk` bigint unsigned NOT NULL AUTO_INCREMENT,
  `jumlah` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `total_harga` varchar(255) DEFAULT NULL,
  `id_barang` bigint unsigned DEFAULT NULL,
  `id_pengguna` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id_barang_masuk`),
  UNIQUE KEY `id_barang_masuk` (`id_barang_masuk`),
  KEY `id_barang` (`id_barang`),
  KEY `id_pengguna` (`id_pengguna`),
  CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON UPDATE CASCADE,
  CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `id_pengguna` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pengguna`),
  UNIQUE KEY `id_pengguna` (`id_pengguna`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `barang` (`id_barang`, `ukuran`, `harga`, `nama`, `kode`, `jenis`) VALUES
(37, '55', '5', '55', '5', '5');

INSERT INTO `barang_masuk` (`id_barang_masuk`, `jumlah`, `tanggal`, `total_harga`, `id_barang`, `id_pengguna`) VALUES
(5, '2', '2025-06-03', '1000', 37, 1);
INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `nama`, `role`) VALUES
(1, '1', '1', '1', '1');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;