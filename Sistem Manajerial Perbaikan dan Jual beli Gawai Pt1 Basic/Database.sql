-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for toko_hp
CREATE DATABASE IF NOT EXISTS `toko_hp` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `toko_hp`;

-- Dumping structure for table toko_hp.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `kd_barang` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(255) NOT NULL,
  `merek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`kd_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table toko_hp.barang: ~7 rows (approximately)
INSERT INTO `barang` (`kd_barang`, `nama_barang`, `merek`) VALUES
	(9, 'Samsung Galaxy A15', 'Samsung'),
	(10, 'Xiaomi Note 14', 'Xiaomi'),
	(11, 'Samsung Galaxy S23 FE', 'Samsung'),
	(12, 'Realme C55', 'Realme'),
	(13, 'Samsung s10 Plus', 'Samsung'),
	(14, 'Infinix hot 60 pro plus', 'Infinix'),
	(15, 'Xiaomi note 9', 'Xiaomi');

-- Dumping structure for table toko_hp.barang_varian
CREATE TABLE IF NOT EXISTS `barang_varian` (
  `id_varian` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kd_barang` bigint unsigned NOT NULL,
  `ram` varchar(20) NOT NULL,
  `harga` int NOT NULL,
  `stok` int NOT NULL,
  PRIMARY KEY (`id_varian`),
  KEY `fk_varian_barang` (`kd_barang`),
  CONSTRAINT `fk_varian_barang` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table toko_hp.barang_varian: ~11 rows (approximately)
INSERT INTO `barang_varian` (`id_varian`, `kd_barang`, `ram`, `harga`, `stok`) VALUES
	(3, 9, '6/128', 2599000, 30),
	(4, 9, '8/256', 2999000, 13),
	(5, 10, '6/128', 2499000, 25),
	(6, 10, '8/256', 3199000, 21),
	(7, 11, '8/256', 8999000, 10),
	(8, 12, '6/128', 2199000, 27),
	(9, 12, '8/256', 2599000, 10),
	(10, 13, '6/128', 2100000, 5),
	(11, 13, '8/128', 2999999, 12),
	(12, 14, '6/128', 2500000, 8),
	(13, 15, '6/128', 2500000, 10);

-- Dumping structure for table toko_hp.customer
CREATE TABLE IF NOT EXISTS `customer` (
  `id_customer` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kode_customer` varchar(5) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `kontak` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  PRIMARY KEY (`id_customer`),
  UNIQUE KEY `kode_customer` (`kode_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=1031 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table toko_hp.customer: ~10 rows (approximately)
INSERT INTO `customer` (`id_customer`, `kode_customer`, `nama`, `kontak`, `alamat`) VALUES
	(1017, 'A000', 'Fajar Nugroho', '088223456575', 'Jl.Golf Barat XII No.0'),
	(1018, 'A001', 'Mahendra', '088223546765', 'Jl.Pagangsaat 12 No.71'),
	(1019, 'A002', 'Shaila Mawar', '088223425569', 'Jl.Coblong 12 No.5'),
	(1020, 'A003', 'Putri Ayuna', '088234590998', 'Jl.Kopo No.11'),
	(1025, 'A004', 'Risky Sentosa', '088221352617', 'Jl.Jakarta 10 No.91'),
	(1026, 'A005', 'Asep Sutisna', '088223465633', 'Jl.Bale endah IX No.12'),
	(1027, 'A006', 'Intan Sulistia', '088223465633', 'Jl.Cipedes Endah No.1'),
	(1028, 'A007', 'alex mason', '088279878736', 'Jl. Juanda No.7'),
	(1029, 'A008', 'Garit Jajak', '088223516519', 'Jl. Antapani endah no.12'),
	(1030, 'A009', 'edi', '63726372536', 'jl.pamungkas');

-- Dumping structure for table toko_hp.master_service
CREATE TABLE IF NOT EXISTS `master_service` (
  `id_master_service` int NOT NULL AUTO_INCREMENT,
  `nama_service` varchar(100) NOT NULL,
  `harga` int NOT NULL,
  PRIMARY KEY (`id_master_service`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table toko_hp.master_service: ~5 rows (approximately)
INSERT INTO `master_service` (`id_master_service`, `nama_service`, `harga`) VALUES
	(1, 'Ganti LCD Samsung S20', 1000000),
	(2, 'Ganti Baterai iPhone 11', 750000),
	(3, 'Ganti Port Charger Infinix hot 60', 70000),
	(4, 'Ganti LCD Samsung A05', 200000),
	(5, 'Housing Iphone 10', 450000);

-- Dumping structure for table toko_hp.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id_penjualan` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_customer` bigint unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` int NOT NULL,
  PRIMARY KEY (`id_penjualan`),
  KEY `fk_penjualan_customer` (`id_customer`),
  CONSTRAINT `fk_penjualan_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`)
) ENGINE=InnoDB AUTO_INCREMENT=2323 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table toko_hp.penjualan: ~7 rows (approximately)
INSERT INTO `penjualan` (`id_penjualan`, `id_customer`, `tanggal`, `total_harga`) VALUES
	(2313, 1019, '2025-11-16', 8999000),
	(2314, 1027, '2025-12-16', 2199000),
	(2316, 1019, '2025-12-16', 2500000),
	(2317, 1018, '2028-12-17', 3199000),
	(2319, 1018, '2027-02-17', 5198000),
	(2320, 1025, '2028-12-17', 2999000),
	(2322, 1020, '2028-12-18', 2199000);

-- Dumping structure for table toko_hp.penjualan_detail
CREATE TABLE IF NOT EXISTS `penjualan_detail` (
  `id_detail` bigint unsigned NOT NULL AUTO_INCREMENT,
  `id_penjualan` bigint unsigned NOT NULL,
  `kd_barang` bigint unsigned NOT NULL,
  `id_varian` bigint unsigned NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1',
  `harga` int NOT NULL,
  `imei` varchar(20) DEFAULT NULL,
  `garansi_sampai` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_detail`),
  UNIQUE KEY `uq_pd_imei` (`imei`),
  KEY `fk_pd_penjualan` (`id_penjualan`),
  KEY `fk_pd_barang` (`kd_barang`),
  KEY `fk_pd_varian` (`id_varian`),
  CONSTRAINT `fk_pd_barang` FOREIGN KEY (`kd_barang`) REFERENCES `barang` (`kd_barang`),
  CONSTRAINT `fk_pd_penjualan` FOREIGN KEY (`id_penjualan`) REFERENCES `penjualan` (`id_penjualan`) ON DELETE CASCADE,
  CONSTRAINT `fk_pd_varian` FOREIGN KEY (`id_varian`) REFERENCES `barang_varian` (`id_varian`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table toko_hp.penjualan_detail: ~7 rows (approximately)
INSERT INTO `penjualan_detail` (`id_detail`, `id_penjualan`, `kd_barang`, `id_varian`, `jumlah`, `harga`, `imei`, `garansi_sampai`, `created_at`, `updated_at`) VALUES
	(2, 2313, 11, 7, 1, 8999000, '726387463726172', '2027-12-16', '2025-12-16 06:28:50', '2025-12-17 10:22:13'),
	(3, 2314, 10, 10, 1, 2499000, '728372654314256', '2027-12-16', '2025-12-16 06:36:27', '2025-12-16 06:37:07'),
	(5, 2316, 12, 5, 1, 2199000, '627162736282716', '2025-12-16', '2025-12-16 06:50:37', '2025-12-16 06:52:40'),
	(6, 2317, 15, 13, 1, 2500000, '637283746574839', '2025-12-17', '2025-12-17 09:57:42', '2025-12-17 10:22:28'),
	(7, 2319, 12, 9, 2, 2599000, '726372819283746', '2025-12-17', '2025-12-17 10:24:08', '2025-12-17 10:24:08'),
	(8, 2320, 9, 4, 1, 2999000, '64736273847321', '2025-12-17', '2025-12-17 10:24:49', '2025-12-17 10:24:49'),
	(10, 2322, 12, 8, 1, 2199000, '637263726154253', '2025-12-18', '2025-12-18 01:31:03', '2025-12-18 01:31:03');

-- Dumping structure for table toko_hp.service
CREATE TABLE IF NOT EXISTS `service` (
  `id_service` int NOT NULL AUTO_INCREMENT,
  `id_customer` bigint unsigned NOT NULL,
  `id_master_service` int NOT NULL,
  `imei` varchar(20) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `garansi_sampai` date DEFAULT NULL,
  `status` enum('Masuk','Proses','Selesai','Diambil') DEFAULT 'Masuk',
  `total_biaya` int NOT NULL,
  PRIMARY KEY (`id_service`),
  KEY `fk_service_master` (`id_master_service`),
  KEY `fk_service_customer` (`id_customer`),
  CONSTRAINT `fk_service_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`),
  CONSTRAINT `fk_service_master` FOREIGN KEY (`id_master_service`) REFERENCES `master_service` (`id_master_service`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table toko_hp.service: ~6 rows (approximately)
INSERT INTO `service` (`id_service`, `id_customer`, `id_master_service`, `imei`, `tanggal_masuk`, `garansi_sampai`, `status`, `total_biaya`) VALUES
	(5, 1028, 5, '93829182732', '2025-12-01', '2025-12-03', 'Masuk', 450000),
	(6, 1020, 1, '367261728372615', '2025-02-04', '2025-04-04', 'Masuk', 1000000),
	(7, 1029, 5, '635271625362716', '2025-09-16', '2025-12-01', 'Masuk', 450000),
	(8, 1028, 4, '637261526378964', '2025-06-10', '2025-09-01', 'Masuk', 200000),
	(9, 1018, 2, '332563728198726', '2025-11-13', '2026-11-16', 'Proses', 750000),
	(11, 1030, 2, '536253625123', '2025-12-18', '2027-12-18', 'Selesai', 750000);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
