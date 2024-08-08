-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: sposerp
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `absensi`
--

DROP TABLE IF EXISTS `absensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `absensi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `karyawan_id` int NOT NULL,
  `tanggal` datetime NOT NULL,
  `absen` tinyint DEFAULT NULL COMMENT '0=alpha,1=hadir,2=terlambat\r\n',
  `terlambat` int DEFAULT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `fotobukti` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `note` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `restored_at` datetime DEFAULT NULL,
  `restored_by` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `is_restored` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absensi`
--

LOCK TABLES `absensi` WRITE;
/*!40000 ALTER TABLE `absensi` DISABLE KEYS */;
/*!40000 ALTER TABLE `absensi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finance`
--

DROP TABLE IF EXISTS `finance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `finance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `no_akun` varchar(20) NOT NULL,
  `kode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kategori` enum('masuk','keluar') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jumlah` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal` date NOT NULL,
  `relation` varchar(50) DEFAULT NULL,
  `outlet_uuid` varchar(36) NOT NULL,
  `note` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` char(36) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` char(36) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` char(36) NOT NULL,
  `restored_at` datetime DEFAULT NULL,
  `restored_by` char(36) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_restored` tinyint(1) NOT NULL,
  `status` tinyint(1) GENERATED ALWAYS AS ((case when ((`is_deleted` = 0) and (`is_restored` = 0)) then 1 when ((`is_deleted` = 1) and (`is_restored` = 0)) then 0 when ((`is_deleted` = 0) and (`is_restored` = 1)) then 1 end)) STORED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finance`
--

LOCK TABLES `finance` WRITE;
/*!40000 ALTER TABLE `finance` DISABLE KEYS */;
INSERT INTO `finance` (`id`, `uuid`, `no_akun`, `kode`, `kategori`, `deskripsi`, `jumlah`, `tanggal`, `relation`, `outlet_uuid`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (1,'5abdd711-d5bc-4cdf-a03d-a202d043888e','201','KLR20240620371','keluar','Biaya shipment','810000','2024-06-20','shipment|f23f09d7-233c-4c6b-8a52-d518c7342d3a','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-06-20 10:01:37','Fami',NULL,'',NULL,'',NULL,'',0,0),(2,'e4dd54e8-11f9-46e9-9cbd-d8626c0b1420','201','KLR20240620836','keluar','Biaya shipment','390000','2024-06-20','shipment|77563bc8-fa10-415a-aa15-169b5dc2436f','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-06-20 10:44:42','Fami',NULL,'',NULL,'',NULL,'',0,0),(3,'b568087e-9e65-4eb7-ba77-aa9b7321da4a','201','KLR20240620308','keluar','Biaya shipment','150000','2024-06-20','shipment|54f20604-9e63-406d-8fc3-6563370f1480','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-06-20 13:27:01','Fami',NULL,'',NULL,'',NULL,'',0,0),(8,'5dacbebb-1f98-4e30-ac90-1e5fe912b296','201','KLR20240703963','keluar','Biaya shipment','318000','2024-07-03','shipment|4b34b6a7-600c-4296-89b9-593544c7c45a','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-07-03 09:29:09','Fami',NULL,'',NULL,'',NULL,'',0,0),(9,'72bf8605-1fb0-42e9-9722-3f8ca21f594d','101','MSK20240703312','masuk','Pendapatan Penjualan Harian','54590','2024-07-03','penjualan|2024-07-03','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-07-03 11:13:55','Fami','2024-07-03 15:30:55','Fami',NULL,'',NULL,'',0,0);
/*!40000 ALTER TABLE `finance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `karyawan`
--

DROP TABLE IF EXISTS `karyawan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `karyawan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nik` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `status_karyawan` enum('Aktif','Tidak Aktif') NOT NULL,
  `status_nikah` varchar(20) NOT NULL,
  `posisi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `level` enum('Supervisor','Staff') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `departement` varchar(50) NOT NULL,
  `atasan_langsung` varchar(50) NOT NULL,
  `lokasi` varchar(20) NOT NULL,
  `mulai_kerja` date NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `gol_darah` varchar(10) NOT NULL,
  `kt_pendidikan_terakhir` varchar(10) NOT NULL,
  `pendidikan_terakhir` varchar(10) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `suku` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_kontak_darurat` varchar(100) NOT NULL,
  `telp_kontak_darurat` varchar(20) NOT NULL,
  `no_ktp` varchar(50) NOT NULL,
  `masa_ktp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `no_kk` varchar(50) NOT NULL,
  `nama_ibu_kandung` varchar(100) NOT NULL,
  `npwp` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `gaji_overtime` tinyint(1) NOT NULL,
  `gaji_kehadiran` tinyint(1) NOT NULL,
  `gaji_insentif` tinyint(1) NOT NULL,
  `gaji_tunjangan` tinyint(1) NOT NULL,
  `bpjs_ketenagakerjaan` varchar(100) NOT NULL,
  `bpjs_kesehatan` varchar(100) NOT NULL,
  `bpjs_kesehatan_keluarga` varchar(200) NOT NULL,
  `bebas_pajak` tinyint(1) NOT NULL,
  `ukuran_baju` varchar(10) NOT NULL,
  `ukuran_sepatu` varchar(10) NOT NULL,
  `nama_bank` varchar(20) NOT NULL,
  `keterangan_bank` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `akun_bank` varchar(50) NOT NULL,
  `nama_pemilik_rek` varchar(100) NOT NULL,
  `gaji_pokok` int NOT NULL,
  `outlet_uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `note` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `restored_at` datetime DEFAULT NULL,
  `restored_by` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_restored` tinyint(1) NOT NULL,
  `status` tinyint(1) GENERATED ALWAYS AS ((case when ((`is_deleted` = 0) and (`is_restored` = 0)) then 1 when ((`is_deleted` = 1) and (`is_restored` = 0)) then 0 when ((`is_deleted` = 0) and (`is_restored` = 1)) then 1 end)) STORED,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `nik` (`nik`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `karyawan`
--

LOCK TABLES `karyawan` WRITE;
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
INSERT INTO `karyawan` (`id`, `uuid`, `foto`, `nik`, `nama`, `status_karyawan`, `status_nikah`, `posisi`, `level`, `departement`, `atasan_langsung`, `lokasi`, `mulai_kerja`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `gol_darah`, `kt_pendidikan_terakhir`, `pendidikan_terakhir`, `agama`, `alamat`, `suku`, `no_telp`, `email`, `nama_kontak_darurat`, `telp_kontak_darurat`, `no_ktp`, `masa_ktp`, `no_kk`, `nama_ibu_kandung`, `npwp`, `gaji_overtime`, `gaji_kehadiran`, `gaji_insentif`, `gaji_tunjangan`, `bpjs_ketenagakerjaan`, `bpjs_kesehatan`, `bpjs_kesehatan_keluarga`, `bebas_pajak`, `ukuran_baju`, `ukuran_sepatu`, `nama_bank`, `keterangan_bank`, `akun_bank`, `nama_pemilik_rek`, `gaji_pokok`, `outlet_uuid`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (4,'0381e5fc-0944-4bce-ae39-42f3ea17c0dd','65b069e93108c.png','3825698298','Masando Fami Ramadhan','Aktif','TK0','Kasir','Staff','Kasir','Supervisor','Malang','2023-12-01','Malang','2006-10-01','Laki-laki','O','SMK','SMK','Islam','JL Arjuno Gg 3 No 1143','Jawa','08983419373','masandofami@gmail.com','Bagas','089898989898','1234567890','Seumur Hidup','357301234567890','misriyah','-',0,0,1,1,'-','-','-',0,'XL','32','Mandiri','-','1234567890','Masando Fami',2000000,'3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','','2024-01-24 00:47:32','Super Admin','2024-03-20 14:31:12','HR1',NULL,'',NULL,'',0,0),(5,'c536993c-087c-43b9-8caf-ee13f4a835a8','','12434','Tono','Aktif','TK0','Koki','Supervisor','Kitchen','Supervisor','Malang','2024-03-20','Malang','1998-02-12','Laki-laki','AB','SMA','SMA','Katolik','Jl. Jalan','Jawa','089898989898','tono@gmail.com','Budi','08398248237','357302924892483','Seumur Hidup','4589239589235','Yanti','2357982375',1,1,1,1,'-','-','-',1,'XL','36','Mandiri','-','89284437264','Tono',2000000,'23e39347-4cd9-4bc0-872c-7d330d189016','','2024-03-20 14:39:59','HR1',NULL,'',NULL,'',NULL,'',0,0),(6,'93345d56-2882-4843-b2b2-1470466eafa3','66538342e4c67.jpg','3573020110060003','Fami Wahyu Putra','Aktif','TK2','Koki','Staff','Kitchen','Supervisor','Malang','2024-04-29','Malang','2024-04-30','Laki-laki','O','SMA','SMA','Islam','JL Kesasar','Jawa','08983419373','fami@example.com','Bagas','08984727642e34','2632353525635','Seumur Hidup','54363354333646','misriyah','-',1,1,1,1,'-','-','-',0,'XL','36','Mandiri','-','1234567890','Masando Fami',2000000,'9d49896b-8937-4af7-9c91-91f1cc262159','','2024-05-27 01:45:23','Fami','2024-05-27 10:18:34','Fami',NULL,'',NULL,'',0,0),(7,'d3417751-6f4e-4225-a55e-8be4cba220d5','6653fb20bf7ea.jpg','213431424','Cinderella Lailatul Hikmah','Tidak Aktif','TK0','Kasir','Staff','Kasir','Supervisor','Ngawi, Jawa Timur','2024-05-26','Malang','2024-05-01','Perempuan','B','S1','S1','Kristen','JL Penambahan No 47','Jawa','08923467826','ngamnu@example.com','Yanto','089340984','1234321424214','Seumur Hidup','12342134','Bela Nindya','-',1,1,1,1,'-','-','',0,'L','32','BNI','-','1234567890','Cinderella',1000000,'9d49896b-8937-4af7-9c91-91f1cc262159','','2024-05-27 10:16:49','Fami',NULL,'',NULL,'',NULL,'',0,0);
/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategori` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `note` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` char(36) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` char(36) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` char(36) NOT NULL,
  `restored_at` datetime DEFAULT NULL,
  `restored_by` char(36) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_restored` tinyint(1) NOT NULL,
  `status` tinyint(1) GENERATED ALWAYS AS ((case when ((`is_deleted` = 0) and (`is_restored` = 0)) then 1 when ((`is_deleted` = 1) and (`is_restored` = 0)) then 0 when ((`is_deleted` = 0) and (`is_restored` = 1)) then 1 end)) STORED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` (`id`, `uuid`, `nama`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (1,'128f1e20-9414-4e80-bda3-6052c71781df','Makanan','','2023-10-26 10:32:54','admin',NULL,'',NULL,'',NULL,'',0,0),(2,'81d28514-7d60-4e49-ab3e-9b296abfcdf0','Minuman','','2023-10-26 10:33:00','admin',NULL,'',NULL,'',NULL,'',0,0),(3,'1f8cb581-0f23-49bd-81bb-05f9defa2a05','Snack','','2023-10-26 10:33:06','admin',NULL,'',NULL,'',NULL,'',0,0),(4,'60204498-bb9e-425c-b055-1693c7dea549','Dessert','','2023-10-26 10:47:00','admin',NULL,'',NULL,'',NULL,'',0,0);
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kategori_id` int DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `bahan` json NOT NULL,
  `tersedia` json DEFAULT NULL,
  `menu_prepare` tinyint(1) NOT NULL,
  `outlet_uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `note` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` char(36) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` char(36) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` char(36) NOT NULL,
  `restored_at` datetime DEFAULT NULL,
  `restored_by` char(36) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_restored` tinyint(1) NOT NULL,
  `status` tinyint(1) GENERATED ALWAYS AS ((case when ((`is_deleted` = 0) and (`is_restored` = 0)) then 1 when ((`is_deleted` = 1) and (`is_restored` = 0)) then 0 when ((`is_deleted` = 0) and (`is_restored` = 1)) then 1 end)) STORED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `uuid`, `foto`, `nama`, `kategori_id`, `harga`, `bahan`, `tersedia`, `menu_prepare`, `outlet_uuid`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (1,'ee7d11cb-62ba-442c-9811-0eddf2bc4b16','6684aa775a389.jpeg','Daging Wahyu',1,20000,'{\"Daging Wahyu\": 0.02}','{\"9d49896b-8937-4af7-9c91-91f1cc262159\": 699}',0,NULL,'','2024-07-03 08:33:45','Fami','2024-07-03 15:31:28','Fami',NULL,'',NULL,'',0,0),(2,'7004d1fd-0e44-41e2-bcc3-198364e3dee6','6684b5306e8a4.jpg','Nasi Goreng',1,15000,'{\"Beras\": 0.2, \"Telur\": 0.1}','{\"9d49896b-8937-4af7-9c91-91f1cc262159\": 79}',0,NULL,'','2024-07-03 09:19:29','Fami','2024-07-03 15:31:28','Fami',NULL,'',NULL,'',0,0),(3,'162b2c19-d612-4496-8684-6a34d859a4d5','6684b7a479b59.jpg','Steak Ayam',1,18000,'{\"Daging Ayam\": 0.2}','{\"9d49896b-8937-4af7-9c91-91f1cc262159\": 59}',0,'9d49896b-8937-4af7-9c91-91f1cc262159','','2024-07-03 09:29:56','Fami','2024-07-03 15:31:28','Fami',NULL,'',NULL,'',0,0),(4,'a6da1d0b-1f9b-4226-b7fd-4c42319cf679','6684b8fa3da3a.jpg','Milkshake',2,12000,'{\"Susu UHT\": 0.5}','{\"9d49896b-8937-4af7-9c91-91f1cc262159\": 40}',0,NULL,'','2024-07-03 09:35:38','Fami','2024-07-03 15:31:28','Fami',NULL,'',NULL,'',0,0);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `no_akun`
--

DROP TABLE IF EXISTS `no_akun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `no_akun` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `akun` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `subkategori` varchar(20) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `note` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` char(36) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` char(36) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` char(36) NOT NULL,
  `restored_at` datetime DEFAULT NULL,
  `restored_by` char(36) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_restored` tinyint(1) NOT NULL,
  `status` tinyint(1) GENERATED ALWAYS AS ((case when ((`is_deleted` = 0) and (`is_restored` = 0)) then _utf8mb4'1' when ((`is_deleted` = 1) and (`is_restored` = 0)) then _utf8mb4'0' when ((`is_deleted` = 0) and (`is_restored` = 1)) then _utf8mb4'1' end)) STORED,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor` (`akun`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `no_akun`
--

LOCK TABLES `no_akun` WRITE;
/*!40000 ALTER TABLE `no_akun` DISABLE KEYS */;
INSERT INTO `no_akun` (`id`, `uuid`, `akun`, `subkategori`, `deskripsi`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (1,'a4a76efe-9062-4e3c-9a2d-126a07c8e8a2','101','pemasukan','pendapatan penjualan','penjualan','2024-05-13 11:13:23','Fami',NULL,'',NULL,'',NULL,'',0,0),(2,'ba5d5816-d3a9-4cd2-9226-4f589234b93d','201','pengeluaran','beban shipment','shipment','2024-05-13 11:15:16','Fami',NULL,'',NULL,'',NULL,'',0,0),(3,'68943a8b-9bb8-4135-b736-1f7a9372e340','301','pengeluaran','utang pokok','','2024-05-13 11:28:24','Fami',NULL,'',NULL,'',NULL,'',0,0),(4,'e8653f49-d7c0-4485-a838-82a0a5f1a7b8','401','pemasukan','investasi asing','','2024-05-13 16:45:27','Fami',NULL,'',NULL,'',NULL,'',0,0),(5,'4e3de270-78b9-4df7-a96e-b7f4d3147f22','302','pengeluaran','Sewa Properti','','2024-06-06 09:38:44','Fami',NULL,'',NULL,'',NULL,'',0,0);
/*!40000 ALTER TABLE `no_akun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outlet`
--

DROP TABLE IF EXISTS `outlet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `outlet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama` varchar(200) NOT NULL,
  `manager_id` varchar(36) DEFAULT NULL,
  `alamat` varchar(200) NOT NULL,
  `kota` varchar(20) NOT NULL,
  `lokasi` varchar(50) NOT NULL,
  `nomor_telp` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pajak` int NOT NULL,
  `note` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` char(36) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` char(36) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` char(36) NOT NULL,
  `restored_at` datetime DEFAULT NULL,
  `restored_by` char(36) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_restored` tinyint(1) NOT NULL,
  `status` tinyint(1) GENERATED ALWAYS AS ((case when ((`is_deleted` = 0) and (`is_restored` = 0)) then _utf8mb4'1' when ((`is_deleted` = 1) and (`is_restored` = 0)) then _utf8mb4'0' when ((`is_deleted` = 0) and (`is_restored` = 1)) then _utf8mb4'1' end)) STORED,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uuid` (`uuid`),
  UNIQUE KEY `nama` (`nama`),
  UNIQUE KEY `manager_id` (`manager_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outlet`
--

LOCK TABLES `outlet` WRITE;
/*!40000 ALTER TABLE `outlet` DISABLE KEYS */;
INSERT INTO `outlet` (`id`, `uuid`, `foto`, `nama`, `manager_id`, `alamat`, `kota`, `lokasi`, `nomor_telp`, `pajak`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (6,'9d49896b-8937-4af7-9c91-91f1cc262159','65dee6ae7e405.png','Meatgenk Pusat','ab201144-c2c3-410f-b3f0-1fc6920ab72e','Jl. Ketapang','Banjarbaru','Kalimantan Selatan','365487',3,'','2024-02-28 14:00:23','Owner','2024-05-26 16:38:10','Fami','2024-03-18 08:26:15','Fami',NULL,'',0,0),(7,'23e39347-4cd9-4bc0-872c-7d330d189016','65dedf32c4e99.jpg','Meatgenk Malang','ceee75c1-296a-4742-b10c-98d57e0b75fe','Jl. Ketapang','Malang','Indonesia','08983419373',2,'','2024-02-28 14:22:26','Owner','2024-03-18 12:14:08','Fami',NULL,'',NULL,'',0,0),(8,'3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','65f7b1e402b4c.jpg','Meatgenk Ngawi',NULL,'Jl Prof HM Yamin SH 370','Ngawi','Jawa Timur','0898989898',5,'','2024-03-18 10:15:48','Fami','2024-03-21 09:27:28','Fami',NULL,'',NULL,'',0,0),(9,'74f0b1e7-34ab-426e-8dd1-726933bccef1','','Meatgenk Banjarbaru',NULL,'Jl jl','Banjarbaru','Banjarbaru, Kalimantan Selatan','0898989898',2,'','2024-05-08 09:15:12','Fami',NULL,'',NULL,'',NULL,'',0,0);
/*!40000 ALTER TABLE `outlet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pembayaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `kasir` varchar(20) NOT NULL,
  `pelanggan` varchar(20) NOT NULL,
  `nomor_telp` varchar(30) NOT NULL,
  `detail_pembayaran` json NOT NULL,
  `subtotal` int NOT NULL,
  `pajak` int NOT NULL,
  `total` int NOT NULL,
  `metode_pembayaran` varchar(10) NOT NULL,
  `kode_transaksi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bayar` int NOT NULL,
  `kembali` int NOT NULL,
  `tanggal` date NOT NULL,
  `status_order` tinyint(1) NOT NULL,
  `outlet_uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `note` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` char(36) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` char(36) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` char(36) NOT NULL,
  `restored_at` datetime DEFAULT NULL,
  `restored_by` char(36) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_restored` tinyint(1) NOT NULL,
  `status` tinyint(1) GENERATED ALWAYS AS ((case when ((`is_deleted` = 0) and (`is_restored` = 0)) then _utf8mb4'1' when ((`is_deleted` = 1) and (`is_restored` = 0)) then _utf8mb4'0' when ((`is_deleted` = 0) and (`is_restored` = 1)) then _utf8mb4'1' end)) STORED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran`
--

LOCK TABLES `pembayaran` WRITE;
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
INSERT INTO `pembayaran` (`id`, `uuid`, `kasir`, `pelanggan`, `nomor_telp`, `detail_pembayaran`, `subtotal`, `pajak`, `total`, `metode_pembayaran`, `kode_transaksi`, `bayar`, `kembali`, `tanggal`, `status_order`, `outlet_uuid`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (1,'fca51f9f-6776-4049-9b88-65fce2926253','Fami','Customer','0898989898','[{\"id\": \"1\", \"item\": \"Daging Wahyu\", \"amount\": \"1\", \"subtotal\": \"20000\", \"take_away\": null}]',20000,600,20600,'cash','',51500,30900,'2024-07-03',1,'9d49896b-8937-4af7-9c91-91f1cc262159','','2024-07-03 11:13:55','Fami','2024-07-03 15:30:06','Fami',NULL,'',NULL,'',0,0),(2,'aeb544ad-5a28-4305-bd91-8a31e126a694','Fami','Sando','365487','[{\"id\": \"3\", \"item\": \"Steak Ayam\", \"amount\": \"1\", \"subtotal\": \"18000\", \"take_away\": null}, {\"id\": \"2\", \"item\": \"Nasi Goreng\", \"amount\": \"1\", \"subtotal\": \"15000\", \"take_away\": null}]',33000,990,33990,'cash','',50000,16010,'2024-07-03',1,'9d49896b-8937-4af7-9c91-91f1cc262159','','2024-07-03 15:30:40','Fami','2024-07-03 15:31:28','Fami',NULL,'',NULL,'',0,0);
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preferences`
--

DROP TABLE IF EXISTS `preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `preferences` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(20) NOT NULL,
  `setting` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `value` varchar(100) NOT NULL,
  `datetime` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preferences`
--

LOCK TABLES `preferences` WRITE;
/*!40000 ALTER TABLE `preferences` DISABLE KEYS */;
INSERT INTO `preferences` VALUES (1,'POS','Nama_Perusahaan','Meatgenkz','2023-10-31 08:58:55'),(3,'ERP','Waktu_Datang','06:00 - 07:00','2023-10-31 09:04:13'),(4,'ERP','Waktu_Pulang','15:00 - 17:00','2023-10-31 09:06:38'),(5,'ERP','Token_Absensi','12e461f63a95af15aad0e97648fa0872','2023-10-31 09:07:03'),(6,'POS','Direktori_Logo','http://sposerp.test/img/logos/meatGenkz.jpg','2023-11-03 10:20:41'),(9,'ENV','init','true','2024-02-28 14:40:02');
/*!40000 ALTER TABLE `preferences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reward_punishment`
--

DROP TABLE IF EXISTS `reward_punishment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reward_punishment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `karyawan_id` int NOT NULL,
  `jenis` enum('reward','punishment') NOT NULL,
  `jumlah` int NOT NULL,
  `besaran` int NOT NULL,
  `total` int GENERATED ALWAYS AS ((`besaran` * `jumlah`)) STORED,
  `keterangan` varchar(200) NOT NULL,
  `tanggal` date NOT NULL,
  `note` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` char(36) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` char(36) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` char(36) NOT NULL,
  `restored_at` datetime DEFAULT NULL,
  `restored_by` char(36) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_restored` tinyint(1) NOT NULL,
  `status` tinyint(1) GENERATED ALWAYS AS ((case when ((`is_deleted` = 0) and (`is_restored` = 0)) then _utf8mb4'1' when ((`is_deleted` = 1) and (`is_restored` = 0)) then _utf8mb4'0' when ((`is_deleted` = 0) and (`is_restored` = 1)) then _utf8mb4'1' end)) STORED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reward_punishment`
--

LOCK TABLES `reward_punishment` WRITE;
/*!40000 ALTER TABLE `reward_punishment` DISABLE KEYS */;
INSERT INTO `reward_punishment` (`id`, `uuid`, `karyawan_id`, `jenis`, `jumlah`, `besaran`, `keterangan`, `tanggal`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (4,'0bdc8eed-a2b8-4852-ae53-e7bbbce7ad1f',4,'reward',1,50000,'kerja bagus','2024-01-25','','2024-01-25 15:25:33','Super Admin','2024-03-21 09:19:13','HR1',NULL,'',NULL,'',0,0),(5,'5898ac55-384b-4366-ac43-6a0ef51c6df8',4,'punishment',3,10000,'Terlambat','2024-01-25','','2024-01-25 15:25:52','Super Admin',NULL,'',NULL,'',NULL,'',0,0);
/*!40000 ALTER TABLE `reward_punishment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `riwayat_stok`
--

DROP TABLE IF EXISTS `riwayat_stok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `riwayat_stok` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `stok_id` int NOT NULL,
  `stok` float NOT NULL,
  `riwayat` json NOT NULL,
  `outlet_uuid` varchar(36) NOT NULL,
  `note` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` char(36) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` char(36) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` char(36) NOT NULL,
  `restored_at` datetime DEFAULT NULL,
  `restored_by` char(36) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_restored` tinyint(1) NOT NULL,
  `status` tinyint(1) GENERATED ALWAYS AS ((case when ((`is_deleted` = 0) and (`is_restored` = 0)) then 1 when ((`is_deleted` = 1) and (`is_restored` = 0)) then 0 when ((`is_deleted` = 0) and (`is_restored` = 1)) then 1 end)) STORED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riwayat_stok`
--

LOCK TABLES `riwayat_stok` WRITE;
/*!40000 ALTER TABLE `riwayat_stok` DISABLE KEYS */;
INSERT INTO `riwayat_stok` (`id`, `uuid`, `stok_id`, `stok`, `riwayat`, `outlet_uuid`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (1,'9cc5af96-973f-4045-a34f-14ce42f3514f',1,20,'{\"2024-08-01\": {\"stok\": \"20\", \"masuk\": \"20\", \"keluar\": 0}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-01 09:00:54','Fami',NULL,'',NULL,'',NULL,'',0,0);
/*!40000 ALTER TABLE `riwayat_stok` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipment`
--

DROP TABLE IF EXISTS `shipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shipment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `supplier_id` int NOT NULL,
  `no_faktur` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `total_berat` int NOT NULL,
  `detail_barang` json NOT NULL,
  `total_exw` int NOT NULL,
  `biaya_lainnya` json NOT NULL,
  `total_biaya_lainnya` int NOT NULL,
  `diskon` int NOT NULL,
  `total` int NOT NULL,
  `harga_all_in` int NOT NULL,
  `tanggal` date NOT NULL,
  `outlet_uuid` varchar(36) NOT NULL,
  `note` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` char(36) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` char(36) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` char(36) NOT NULL,
  `restored_at` datetime DEFAULT NULL,
  `restored_by` char(36) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_restored` tinyint(1) NOT NULL,
  `status` tinyint(1) GENERATED ALWAYS AS ((case when ((`is_deleted` = 0) and (`is_restored` = 0)) then _utf8mb4'1' when ((`is_deleted` = 1) and (`is_restored` = 0)) then _utf8mb4'0' when ((`is_deleted` = 0) and (`is_restored` = 1)) then _utf8mb4'1' end)) STORED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipment`
--

LOCK TABLES `shipment` WRITE;
/*!40000 ALTER TABLE `shipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `shipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stok`
--

DROP TABLE IF EXISTS `stok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stok` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis` enum('bahan','kemasan','prepare') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `note` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` char(36) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` char(36) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` char(36) NOT NULL,
  `restored_at` datetime DEFAULT NULL,
  `restored_by` char(36) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_restored` tinyint(1) NOT NULL,
  `status` tinyint(1) GENERATED ALWAYS AS ((case when ((`is_deleted` = 0) and (`is_restored` = 0)) then 1 when ((`is_deleted` = 1) and (`is_restored` = 0)) then 0 when ((`is_deleted` = 0) and (`is_restored` = 1)) then 1 end)) STORED,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stok`
--

LOCK TABLES `stok` WRITE;
/*!40000 ALTER TABLE `stok` DISABLE KEYS */;
INSERT INTO `stok` (`id`, `uuid`, `nama`, `jenis`, `satuan`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (1,'8916c254-fb29-4d55-87c9-3045304d8d9a','Daging Sapi','bahan','Kg','','2024-08-01 09:00:54','Fami',NULL,'',NULL,'',NULL,'',0,0);
/*!40000 ALTER TABLE `stok` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `supplier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` varchar(36) NOT NULL,
  `nama` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kontak` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `outlet_uuid` varchar(36) NOT NULL,
  `note` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` char(36) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` char(36) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` char(36) NOT NULL,
  `restored_at` datetime DEFAULT NULL,
  `restored_by` char(36) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_restored` tinyint(1) NOT NULL,
  `status` tinyint(1) GENERATED ALWAYS AS ((case when ((`is_deleted` = 0) and (`is_restored` = 0)) then 1 when ((`is_deleted` = 1) and (`is_restored` = 0)) then 0 when ((`is_deleted` = 0) and (`is_restored` = 1)) then 1 end)) STORED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` (`id`, `uuid`, `nama`, `alamat`, `kontak`, `email`, `outlet_uuid`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (1,'48bb7345-1699-4abc-b670-0121341c47cb','Budi','JL Penambahan No 47','08123382520','budianjayani@example.com','3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','','2023-10-23 19:04:04','admin','2023-11-20 15:09:03','Super Admin','2023-11-20 15:04:51','Super Admin',NULL,'',0,0),(2,'760633c2-1d7d-46cf-aa96-8b6e29760e3e','Yanto','JL Kesasar','089520409050','yantohaha@gmail.com','3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','','2023-10-23 20:07:07','admin','2023-11-15 08:45:17','Super Admin',NULL,'',NULL,'',0,0),(3,'bc3e5761-67d2-4ce3-9988-aabe4b1cf388','Fauzan','JL Penambahan No 47','088888888888','ngamnu@example.com','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-05-06 09:08:27','Fami',NULL,'',NULL,'',NULL,'',0,0),(4,'8672c0ca-4e4e-466e-b806-fda24798279b','Yudi','Jalan Gang Buntu No 1945','08926757625','yudi@example.com','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-05-28 09:36:05','Fami','2024-05-28 09:36:21','Fami',NULL,'',NULL,'',0,0);
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` varchar(36) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `outlet_uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `notification` json NOT NULL,
  `last_login_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('02f17fba-0aa3-417a-b342-548a3f1e5031','Analyzer1','9b883af7ef97953ad640e83ef801459d106408db931c229fc2610b77340a56dd','analyzer1@gmail.com','Analyzer','3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','[]','2024-06-07 09:25:24',0,1),('15886344-6628-4281-b30a-76bf0c771375','Warehouse1','0e842cbe0341154ee33e0ed3bc18282cd69e016a8d56fda05ec92e7ff20a0f31','warehouse1@gmail.com','Warehouse','3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','[]','2024-05-06 10:43:24',1,1),('46fe24c4-0fb3-4a30-88d4-09cc05647599','Sales1','6bc0a63cb29c92306020c0a6bbc358cc4628db277dc06e253535e126517ad637',' sales1@gmail.com','Sales','3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','[]','2024-05-06 10:11:47',0,1),('ab201144-c2c3-410f-b3f0-1fc6920ab72e','Fami','43a0d17178a9d26c9e0fe9a74b0b45e38d32f27aed887a008a54bf6e033bf7b9',' owner@gmail.com','Owner','9d49896b-8937-4af7-9c91-91f1cc262159','[]','2024-08-01 08:54:17',1,1),('ceee75c1-296a-4742-b10c-98d57e0b75fe','Sando','0594615c23b6ba29c73c9c68fc023c9a353d0b6f139abf03dc063be212becd8c','masandofami@gmail.com','Manager','23e39347-4cd9-4bc0-872c-7d330d189016','[]','2024-06-06 23:16:28',0,1),('fe2b77b3-09f2-4deb-9ee0-01f9194cd43c','HR1','070a3b5e8d4bd5c46acccb91c9c54614c0cd649e78c4c4719e3a64270bae5ddf','hr1@gmail.com','HR','3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','[]','2024-03-28 22:37:44',0,1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-01  9:03:49
