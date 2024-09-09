-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: menyou
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `absensi`
--

LOCK TABLES `absensi` WRITE;
/*!40000 ALTER TABLE `absensi` DISABLE KEYS */;
INSERT INTO `absensi` VALUES (1,'a946adff-180a-4b83-9629-01d81cd3a379',4,'2024-08-20 07:15:00',2,100,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finance`
--

LOCK TABLES `finance` WRITE;
/*!40000 ALTER TABLE `finance` DISABLE KEYS */;
INSERT INTO `finance` (`id`, `uuid`, `no_akun`, `kode`, `kategori`, `deskripsi`, `jumlah`, `tanggal`, `relation`, `outlet_uuid`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (15,'9a585018-4f5a-4caf-a2a1-1b0637236d8c','101','MSK20240828566','masuk','Pendapatan Penjualan Harian','98880','2024-08-28','penjualan|2024-08-28','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-29 09:15:07','Fami','2024-08-29 09:40:11','Fami',NULL,'',NULL,'',0,0),(16,'062e8e0b-8d03-459b-af14-1b1963deafad','101','MSK20240829487','masuk','Pendapatan Penjualan Harian','20600','2024-08-29','penjualan|2024-08-29','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-29 09:42:47','Fami',NULL,'',NULL,'',NULL,'',0,0),(17,'9d7121dc-fedb-4131-b8e7-25ec55407f5b','201','KLR20240904115','keluar','Biaya shipment','90000','2024-09-04','shipment|047bff6a-7e34-4d07-a435-0d7a79079528','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-09-04 11:50:31','Fami',NULL,'',NULL,'',NULL,'',0,0),(18,'b0047db4-4a57-4ad7-bca7-b4f3eb9a0d7c','0','KLR20240904820','keluar','Pendapatan pesanan Harian','82400','2024-09-04','pesanan|2024-09-04','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-09-04 12:13:29','Fami','2024-09-04 12:13:54','Fami',NULL,'',NULL,'',0,0),(19,'9bbec105-e3cc-4ff2-b747-442e86dc033b','201','KLR20240909383','keluar','Biaya shipment','260000','2024-09-09','shipment|7c09c7a9-5bd1-4cb1-89a7-038316e6feed','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-09-09 11:11:51','Fami',NULL,'',NULL,'',NULL,'',0,0),(20,'dcea96a8-ddbd-4dab-9d35-29bf4aba8a1a','101','MSK20240909261','masuk','ad','23000','2024-09-09',NULL,'9d49896b-8937-4af7-9c91-91f1cc262159','','2024-09-09 11:27:12','Fami',NULL,'','2024-09-09 11:29:24','Fami',NULL,'',1,0);
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
  `uuid` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `note` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` char(36) NOT NULL,
  `modified_at` datetime DEFAULT NULL,
  `modified_by` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` char(36) NOT NULL,
  `restored_at` datetime DEFAULT NULL,
  `restored_by` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `is_restored` tinyint(1) NOT NULL,
  `status` tinyint(1) GENERATED ALWAYS AS ((case when ((`is_deleted` = 0) and (`is_restored` = 0)) then 1 when ((`is_deleted` = 1) and (`is_restored` = 0)) then 0 when ((`is_deleted` = 0) and (`is_restored` = 1)) then 1 end)) STORED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` (`id`, `uuid`, `foto`, `nama`, `deskripsi`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (1,'128f1e20-9414-4e80-bda3-6052c71781df','','Makanan','','','2023-10-26 10:32:54','admin',NULL,'',NULL,'',NULL,'',0,0),(2,'81d28514-7d60-4e49-ab3e-9b296abfcdf0','','Minuman','','','2023-10-26 10:33:00','admin',NULL,'',NULL,'',NULL,'',0,0),(3,'1f8cb581-0f23-49bd-81bb-05f9defa2a05','','Snack','','','2023-10-26 10:33:06','admin',NULL,'',NULL,'',NULL,'',0,0),(4,'60204498-bb9e-425c-b055-1693c7dea549','','Dessert','','','2023-10-26 10:47:00','admin',NULL,'',NULL,'',NULL,'',0,0),(5,'c0cc6b4f-2e7d-414d-9afd-ea8ab6354c8b','66de6fc0a57b0.jpg','Sushi','rawr','','2024-09-09 10:47:12','Fami',NULL,'','2024-09-09 10:49:53','Fami',NULL,'',1,0);
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
  `stok_id` int DEFAULT NULL,
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `uuid`, `foto`, `nama`, `kategori_id`, `harga`, `bahan`, `tersedia`, `stok_id`, `outlet_uuid`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (5,'1549070e-9ecd-4a52-a642-5ae0bd4af4b8','66ac8569de177.','Chiken Fillet',NULL,NULL,'{\"Daging Ayam\": 0.2}','{\"9d49896b-8937-4af7-9c91-91f1cc262159\": 96}',6,NULL,'','2024-08-02 14:06:17','Fami','2024-09-02 11:42:31','Fami','2024-09-02 11:42:38','Fami',NULL,'',1,0),(6,'2db03dfe-b6f5-42ae-b2cc-a1ba3037802a','66aca26fbc6c4.jpeg','Steak Wahyu',1,40000,'{\"Daging Sapi\": 0.2}','{\"9d49896b-8937-4af7-9c91-91f1cc262159\": 195}',NULL,NULL,'','2024-08-02 16:10:07','Fami','2024-09-09 10:46:08','Fami',NULL,'',NULL,'',0,0),(7,'345c2d5b-02ea-485d-b810-ab2918842caf','','Ayam Goreng',1,16000,'{\"Daging Ayam\": 0.2}','{\"9d49896b-8937-4af7-9c91-91f1cc262159\": 106}',NULL,NULL,'','2024-08-02 16:22:53','Fami','2024-09-09 10:42:36','Fami','2024-09-09 10:43:08','Fami',NULL,'',1,0),(8,'5e5ea3af-7cd2-4753-856a-1f6b9d2acd71','66de6eac546a3.jpg','Kentang Goreng',3,20000,'{\"Kentang\": 0.2}','{\"9d49896b-8937-4af7-9c91-91f1cc262159\": -1}',NULL,NULL,'','2024-08-07 10:23:25','Fami','2024-09-09 10:46:08','Fami',NULL,'',NULL,'',0,0),(9,'192a5cb8-d582-47dd-a8f3-5c3c1046e779','','Oseng-oseng Buncis',NULL,NULL,'{\"Telur\": 0.83, \"Buncis\": 100}','{\"9d49896b-8937-4af7-9c91-91f1cc262159\": -9}',10,NULL,'','2024-08-07 10:54:32','Fami','2024-09-09 10:53:39','Fami',NULL,'',NULL,'',0,0),(10,'5e72f2d8-26d4-4ed7-8732-ad2b4c261957','66ce7c5c0b31d.jpg','Nasi Omlete',1,20000,'{\"Beras\": 0.2, \"Telur\": 0.12}','{\"9d49896b-8937-4af7-9c91-91f1cc262159\": 4}',NULL,NULL,'','2024-08-28 08:22:53','Fami','2024-09-09 10:46:08','Fami',NULL,'',NULL,'',0,0),(11,'f4c2b4c2-9f3b-412b-bf0c-a4d5d5a710d4','66de52a23ef8d.jpg','Chicken Bibimbap',1,20000,'{\"Telur\": 0.1, \"Daging Sapi\": 0.1}','{}',0,NULL,'','2024-09-09 08:42:58','Fami',NULL,'',NULL,'',NULL,'',0,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `no_akun`
--

LOCK TABLES `no_akun` WRITE;
/*!40000 ALTER TABLE `no_akun` DISABLE KEYS */;
INSERT INTO `no_akun` (`id`, `uuid`, `akun`, `subkategori`, `deskripsi`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (1,'a4a76efe-9062-4e3c-9a2d-126a07c8e8a2','101','pemasukan','pendapatan penjualan','penjualan','2024-05-13 11:13:23','Fami',NULL,'',NULL,'',NULL,'',0,0),(2,'ba5d5816-d3a9-4cd2-9226-4f589234b93d','201','pengeluaran','beban shipment','shipment','2024-05-13 11:15:16','Fami',NULL,'',NULL,'',NULL,'',0,0),(3,'68943a8b-9bb8-4135-b736-1f7a9372e340','301','pengeluaran','utang pokok','','2024-05-13 11:28:24','Fami',NULL,'',NULL,'',NULL,'',0,0),(4,'e8653f49-d7c0-4485-a838-82a0a5f1a7b8','401','pemasukan','investasi asing','','2024-05-13 16:45:27','Fami',NULL,'',NULL,'',NULL,'',0,0),(5,'4e3de270-78b9-4df7-a96e-b7f4d3147f22','302','pengeluaran','Sewa Properti','','2024-06-06 09:38:44','Fami',NULL,'',NULL,'',NULL,'',0,0),(8,'63cddbaf-5308-4d64-ae00-fb1acbc1ead1','3000','Pemasukan','sgfve','','2024-09-09 11:30:14','Fami',NULL,'',NULL,'',NULL,'',0,0);
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
  `metode_pembayaran` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `kode_transaksi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `bayar` int DEFAULT NULL,
  `kembali` int DEFAULT NULL,
  `tanggal` date NOT NULL,
  `status_order` tinyint NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran`
--

LOCK TABLES `pembayaran` WRITE;
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
INSERT INTO `pembayaran` (`id`, `uuid`, `kasir`, `pelanggan`, `nomor_telp`, `detail_pembayaran`, `subtotal`, `pajak`, `total`, `metode_pembayaran`, `kode_transaksi`, `bayar`, `kembali`, `tanggal`, `status_order`, `outlet_uuid`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (7,'b1339397-0428-47e9-ad52-3a8cf9d23524','Fami','Customer','0898989898','[{\"id\": \"6\", \"item\": \"Steak Wahyu\", \"amount\": \"1\", \"subtotal\": \"40000\", \"take_away\": false}, {\"id\": \"7\", \"item\": \"Ayam Goreng\", \"amount\": \"1\", \"subtotal\": \"16000\", \"take_away\": false}]',56000,1680,57680,'cash','',60000,2320,'2024-08-28',2,'9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-28 12:16:17','Fami','2024-08-29 09:15:07','Fami',NULL,'',NULL,'',0,0),(8,'6e7ccedc-f683-4eb9-baca-5ba300b2eb8e','Fami','Hayoo','08638653637','[{\"id\": \"6\", \"item\": \"Steak Wahyu\", \"amount\": \"1\", \"subtotal\": \"40000\", \"take_away\": null}]',40000,1200,41200,'cash','',100000,58800,'2024-08-28',2,'9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-28 15:54:59','Fami','2024-08-29 09:40:11','Fami',NULL,'',NULL,'',0,0),(9,'ebd0dff6-d6cf-4b76-86db-64143498ce36','Fami','Test tanpa $_POST','365487','[{\"id\": \"8\", \"item\": \"Kentang Goreng\", \"amount\": \"1\", \"subtotal\": \"20000\", \"take_away\": false}]',20000,600,20600,'cash','',100000,79400,'2024-08-29',2,'9d49896b-8937-4af7-9c91-91f1cc262159','Awkoakwkoakowkok','2024-08-29 09:06:50','Fami','2024-08-29 09:42:47','Fami',NULL,'',NULL,'',0,0),(10,'f4f13b6f-37e2-481f-87a7-8649b2336987','Fami','Ale','089520409050','[{\"id\": \"6\", \"item\": \"Steak Wahyu\", \"amount\": \"50\", \"subtotal\": \"2000000\", \"take_away\": false}, {\"id\": \"7\", \"item\": \"Ayam Goreng\", \"amount\": \"100\", \"subtotal\": \"1600000\", \"take_away\": false}, {\"id\": \"10\", \"item\": \"Nasi Omlete\", \"amount\": \"80\", \"subtotal\": \"1600000\", \"take_away\": false}, {\"id\": \"8\", \"item\": \"Kentang Goreng\", \"amount\": \"230\", \"subtotal\": \"4600000\", \"take_away\": true}]',9800000,294000,10094000,NULL,NULL,NULL,NULL,'2024-09-03',0,'9d49896b-8937-4af7-9c91-91f1cc262159','','2024-09-03 10:14:39','Fami',NULL,'','2024-09-09 10:40:36','Fami',NULL,'',1,0),(11,'ba9a1276-d962-4c3f-aa75-e32ab57f8153','Fami','Customer','34567','[{\"id\": \"6\", \"item\": \"Steak Wahyu\", \"amount\": \"1\", \"subtotal\": \"40000\", \"take_away\": false}]',40000,1200,41200,'cash','',41200,0,'2024-09-04',2,'9d49896b-8937-4af7-9c91-91f1cc262159','','2024-09-04 11:51:27','Fami','2024-09-04 12:13:54','Fami',NULL,'',NULL,'',0,0),(12,'ed007269-163d-4a8b-a54c-b965c9807959','Fami','Customer','34567','[{\"id\": \"6\", \"item\": \"Steak Wahyu\", \"amount\": \"1\", \"subtotal\": \"40000\", \"take_away\": false}]',40000,1200,41200,NULL,NULL,NULL,NULL,'2024-09-09',0,'9d49896b-8937-4af7-9c91-91f1cc262159','','2024-09-09 10:33:48','Fami',NULL,'',NULL,'',NULL,'',0,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preferences`
--

LOCK TABLES `preferences` WRITE;
/*!40000 ALTER TABLE `preferences` DISABLE KEYS */;
INSERT INTO `preferences` VALUES (1,'POS','Nama_Perusahaan','Meatgenkz','2023-10-31 08:58:55'),(3,'ERP','Waktu_Datang','06:00 - 07:00','2023-10-31 09:04:13'),(4,'ERP','Waktu_Pulang','15:00 - 17:00','2023-10-31 09:06:38'),(5,'ERP','Token_Absensi','12e461f63a95af15aad0e97648fa0872','2023-10-31 09:07:03'),(6,'POS','Direktori_Logo','http://sposerp.test/img/logos/meatGenkz.jpg','2023-11-03 10:20:41'),(9,'ENV','init','true','2024-02-28 14:40:02'),(10,'POS','Timezone','Asia/Jakarta','2024-08-08 10:34:16');
/*!40000 ALTER TABLE `preferences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prepare`
--

DROP TABLE IF EXISTS `prepare`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prepare` (
  `id` int NOT NULL AUTO_INCREMENT,
  `uuid` char(36) NOT NULL,
  `deskripsi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `detail_items` json NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prepare`
--

LOCK TABLES `prepare` WRITE;
/*!40000 ALTER TABLE `prepare` DISABLE KEYS */;
INSERT INTO `prepare` (`id`, `uuid`, `deskripsi`, `detail_items`, `tanggal`, `status_order`, `outlet_uuid`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (1,'a68f572d-ff08-48ae-8090-8a542889bc3a','Oseng Buncis, Chiken Fillet','[{\"id\": \"9\", \"item\": \"Oseng-oseng Buncis\", \"amount\": \"9\", \"stok_id\": \"10\"}, {\"id\": \"5\", \"item\": \"Chiken Fillet\", \"amount\": \"2\", \"stok_id\": \"6\"}]','2024-08-08',1,'9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-08 09:52:18','Fami','2024-08-09 15:58:15','Fami',NULL,'',NULL,'',0,0);
/*!40000 ALTER TABLE `prepare` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riwayat_stok`
--

LOCK TABLES `riwayat_stok` WRITE;
/*!40000 ALTER TABLE `riwayat_stok` DISABLE KEYS */;
INSERT INTO `riwayat_stok` (`id`, `uuid`, `stok_id`, `stok`, `riwayat`, `outlet_uuid`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (1,'9cc5af96-973f-4045-a34f-14ce42f3514f',1,39,'{\"2024-08-01\": {\"stok\": 20, \"masuk\": \"20\", \"keluar\": 0}, \"2024-08-02\": {\"stok\": 40, \"masuk\": 20, \"keluar\": 0}, \"2024-08-09\": {\"stok\": 39.8, \"masuk\": 0, \"keluar\": 0.2}, \"2024-08-12\": {\"stok\": 39.599999999999994, \"masuk\": 0, \"keluar\": 0.2}, \"2024-08-29\": {\"stok\": 39.2, \"masuk\": 0, \"keluar\": 0.4}, \"2024-09-04\": {\"stok\": 38.99999999999999, \"masuk\": 0, \"keluar\": 0.2}, \"2024-09-09\": {\"stok\": 38.99999999999999, \"masuk\": 0, \"keluar\": \"0\"}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-01 09:00:54','Fami','2024-09-09 11:18:18','Fami',NULL,'',NULL,'',0,0),(2,'52834dc7-7b89-4109-8ae0-c6bf7d936016',2,10,'{\"2024-08-02\": {\"stok\": 10, \"masuk\": \"10\", \"keluar\": 0}, \"2024-08-09\": {\"stok\": 10, \"masuk\": 0, \"keluar\": \"0\"}, \"2024-09-09\": {\"stok\": 10, \"masuk\": 0, \"keluar\": \"0\"}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-02 11:03:04','Fami','2024-09-09 11:18:18','Fami',NULL,'',NULL,'',0,0),(3,'de1cda6b-ea59-423c-8d67-906c9ed8b72f',3,21.4,'{\"2024-08-02\": {\"stok\": 20, \"masuk\": \"20\", \"keluar\": 0}, \"2024-08-09\": {\"stok\": 19.6, \"masuk\": 0, \"keluar\": 0.4}, \"2024-08-29\": {\"stok\": 19.4, \"masuk\": 0, \"keluar\": 0.2}, \"2024-09-04\": {\"stok\": 21.4, \"masuk\": 2, \"keluar\": 0}, \"2024-09-09\": {\"stok\": 21.4, \"masuk\": 0, \"keluar\": \"0\"}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-02 11:03:04','Fami','2024-09-09 11:18:18','Fami',NULL,'',NULL,'',0,0),(6,'10566ae4-73e7-4845-8af7-d2e7c0d8cb7c',6,12,'{\"2024-08-02\": {\"stok\": 10, \"masuk\": \"10\", \"keluar\": 0}, \"2024-08-09\": {\"stok\": 12, \"masuk\": 2, \"keluar\": 0}, \"2024-09-09\": {\"stok\": 12, \"masuk\": 0, \"keluar\": \"0\"}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-02 13:56:40','Fami','2024-09-09 11:18:18','Fami',NULL,'',NULL,'',0,0),(7,'a63bad3d-821a-4b6d-b405-3cc8db3202e8',7,-0.2,'{\"2024-08-07\": {\"stok\": 0, \"masuk\": 0, \"keluar\": 0}, \"2024-08-09\": {\"stok\": 0, \"masuk\": 0, \"keluar\": \"0\"}, \"2024-08-29\": {\"stok\": -0.2, \"masuk\": 0, \"keluar\": 0.2}, \"2024-09-09\": {\"stok\": -0.2, \"masuk\": 0, \"keluar\": \"0\"}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-07 09:46:31','Fami','2024-09-09 11:18:18','Fami',NULL,'',NULL,'',0,0),(8,'5c8a86c9-8ab1-43fd-badf-a6193f03fbb5',8,-900,'{\"2024-08-07\": {\"stok\": 0, \"masuk\": 0, \"keluar\": 0}, \"2024-08-09\": {\"stok\": -900, \"masuk\": 0, \"keluar\": 900}, \"2024-09-09\": {\"stok\": -900, \"masuk\": 0, \"keluar\": \"0\"}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-07 09:46:31','Fami','2024-09-09 11:18:18','Fami',NULL,'',NULL,'',0,0),(9,'6a1c6146-4c88-47ae-9e09-b5edc6f77ab2',9,0.53,'{\"2024-08-07\": {\"stok\": 8, \"masuk\": \"8\", \"keluar\": 0}, \"2024-08-09\": {\"stok\": 0.5300000000000002, \"masuk\": 0, \"keluar\": 7.47}, \"2024-09-09\": {\"stok\": 0.5300000000000002, \"masuk\": 0, \"keluar\": \"0\"}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-07 09:55:49','Fami','2024-09-09 11:18:18','Fami',NULL,'',NULL,'',0,0),(10,'491a059e-57ed-41ce-a392-93bee4555187',10,9,'{\"2024-08-07\": {\"stok\": 0, \"masuk\": \"0\", \"keluar\": 0}, \"2024-08-09\": {\"stok\": 9, \"masuk\": 9, \"keluar\": 0}, \"2024-09-09\": {\"stok\": 9, \"masuk\": 0, \"keluar\": \"0\"}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-07 10:54:32','Fami','2024-09-09 11:18:18','Fami',NULL,'',NULL,'',0,0),(11,'c990a796-5500-4a98-ad6a-e6bc98a8fb24',11,-1,'{\"2024-09-09\": {\"stok\": -1, \"masuk\": -1, \"keluar\": \"0\"}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-09-09 10:08:11','Fami','2024-09-09 11:18:18','Fami',NULL,'',NULL,'',0,0),(12,'dde06d49-c691-4e04-88ea-17d6743bafba',12,10,'{\"2024-09-09\": {\"stok\": 10, \"masuk\": \"10\", \"keluar\": \"0\"}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-09-09 10:53:35','Fami','2024-09-09 11:18:18','Fami',NULL,'',NULL,'',0,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipment`
--

LOCK TABLES `shipment` WRITE;
/*!40000 ALTER TABLE `shipment` DISABLE KEYS */;
INSERT INTO `shipment` (`id`, `uuid`, `supplier_id`, `no_faktur`, `deskripsi`, `total_berat`, `detail_barang`, `total_exw`, `biaya_lainnya`, `total_biaya_lainnya`, `diskon`, `total`, `harga_all_in`, `tanggal`, `outlet_uuid`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (9,'4fa6d426-718d-40c7-ac49-193b3d793ac2',4,'F0001','Restok',20000,'[{\"nama\": \"Daging Sapi\", \"jumlah\": \"20\", \"subtotal\": \"800000\", \"harga_satuan\": \"40000\"}]',800000,'{\"ongkir\": \"10000\", \"icepack\": 0}',10000,0,810000,40500,'2024-08-02','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-02 09:13:09','Fami',NULL,'',NULL,'',NULL,'',0,0),(10,'d43507e4-f145-4fc0-a473-51b612da9970',3,'F0002','Stok baru',30000,'[{\"nama\": \"Beras\", \"jumlah\": \"10\", \"subtotal\": \"160000\", \"harga_satuan\": \"16000\"}, {\"nama\": \"Daging Ayam\", \"jumlah\": \"20\", \"subtotal\": \"400000\", \"harga_satuan\": \"20000\"}]',560000,'{\"ongkir\": \"10000\"}',10000,0,570000,19000,'2024-08-02','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-02 11:03:04','Fami',NULL,'',NULL,'',NULL,'',0,0),(11,'de3c9759-6dd7-449a-abc3-d9b15ff6220e',4,'F0003','Stok baru',11000,'[{\"nama\": \"Kentang\", \"jumlah\": \"10\", \"subtotal\": \"240000\", \"harga_satuan\": \"24000\"}, {\"nama\": \"Buncis\", \"jumlah\": \"1000\", \"subtotal\": \"200000\", \"harga_satuan\": \"200\"}]',440000,'{\"ongkir\": \"10000\"}',10000,0,450000,40909,'2024-08-07','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-08-07 09:46:31','Fami',NULL,'',NULL,'',NULL,'',0,0),(12,'047bff6a-7e34-4d07-a435-0d7a79079528',4,'F0015','HAHAHA ',2500,'[{\"nama\": \"Daging Ayam\", \"jumlah\": \"2\", \"subtotal\": \"60000\", \"harga_satuan\": \"30000\"}]',60000,'{\"ongkir\": \"30000\"}',30000,0,90000,36000,'2024-09-04','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-09-04 11:50:31','Fami',NULL,'',NULL,'',NULL,'',0,0),(13,'7c09c7a9-5bd1-4cb1-89a7-038316e6feed',3,'F0015','wasd',5000,'[{\"nama\": \"Minyak Wijen\", \"jumlah\": \"12\", \"subtotal\": \"240000\", \"harga_satuan\": \"20000\"}]',240000,'{\"ongkir\": \"20000\"}',20000,0,260000,52000,'2024-09-09','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-09-09 11:11:51','Fami',NULL,'',NULL,'',NULL,'',0,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stok`
--

LOCK TABLES `stok` WRITE;
/*!40000 ALTER TABLE `stok` DISABLE KEYS */;
INSERT INTO `stok` (`id`, `uuid`, `nama`, `jenis`, `satuan`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (1,'8916c254-fb29-4d55-87c9-3045304d8d9a','Daging Sapi','bahan','gram','','2024-08-01 09:00:54','Fami','2024-09-09 10:56:38','Fami',NULL,'',NULL,'',0,0),(2,'15b636df-cc8b-4ba1-86f2-d17bddbd7bfa','Beras','bahan','Kg','','2024-08-02 11:03:04','Fami',NULL,'',NULL,'',NULL,'',0,0),(3,'b90779f4-0a19-4efb-871e-e61c95cdf19e','Daging Ayam','bahan','Kg','','2024-08-02 11:03:04','Fami',NULL,'',NULL,'',NULL,'',0,0),(6,'72371740-bad8-4453-8312-284b9a174a8e','Chiken Fillet','prepare','pcs','','2024-08-02 13:56:40','Fami',NULL,'',NULL,'',NULL,'',0,0),(7,'e4e7484a-2f5b-4e24-9a72-cee3fdb120ab','Kentang','bahan','Kg','','2024-08-07 09:46:31','Fami',NULL,'',NULL,'',NULL,'',0,0),(8,'2ca45226-e8f8-4947-9320-de3c42ccdcb2','Buncis','bahan','gram','','2024-08-07 09:46:31','Fami',NULL,'',NULL,'',NULL,'',0,0),(9,'9edb62aa-a4fd-4f12-a83c-381309b33333','Telur','bahan','Lusin','','2024-08-07 09:55:49','Fami',NULL,'',NULL,'',NULL,'',0,0),(10,'d52ac003-e4af-41f6-9da6-945d641dee0b','Oseng-oseng Bunciss','prepare','pcs','','2024-08-07 10:54:32','Fami','2024-09-09 10:53:15','Fami',NULL,'',NULL,'',0,0),(11,'31ce04aa-253c-4fdb-a0ba-4720881ea84c','Minyak Wijen','bahan','Liter','','2024-09-09 10:08:11','Fami','2024-09-09 10:08:55','Fami',NULL,'',NULL,'',0,0),(12,'b5e652bc-01a8-4a0f-ac28-574a316f6c8d','Daging Slice','prepare','pcs','','2024-09-09 10:53:35','Fami','2024-09-09 10:58:23','Fami',NULL,'',NULL,'',0,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` (`id`, `uuid`, `nama`, `alamat`, `kontak`, `email`, `outlet_uuid`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (1,'48bb7345-1699-4abc-b670-0121341c47cb','Budi','JL Penambahan No 47','08123382520','budianjayani@example.com','3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','','2023-10-23 19:04:04','admin','2023-11-20 15:09:03','Super Admin','2023-11-20 15:04:51','Super Admin',NULL,'',0,0),(2,'760633c2-1d7d-46cf-aa96-8b6e29760e3e','Yanto','JL Kesasar','089520409050','yantohaha@gmail.com','3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','','2023-10-23 20:07:07','admin','2023-11-15 08:45:17','Super Admin',NULL,'',NULL,'',0,0),(3,'bc3e5761-67d2-4ce3-9988-aabe4b1cf388','Fauzan','JL Penambahan No 47','088888888888','ngamnu@example.com','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-05-06 09:08:27','Fami',NULL,'',NULL,'',NULL,'',0,0),(4,'8672c0ca-4e4e-466e-b806-fda24798279b','Yudi','Jalan Gang Buntu No 1945','08926757625','yudi@example.com','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-05-28 09:36:05','Fami','2024-05-28 09:36:21','Fami',NULL,'',NULL,'',0,0),(5,'8a72004e-b468-47d6-9125-3eb8de06dcee','Freeze Station','Jl. Danau Toba No. 12','0812345678','admin@freezestation.com','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-09-09 11:20:16','Fami','2024-09-09 11:20:46','Fami',NULL,'',NULL,'',0,0),(6,'a6e1673e-3ab1-4297-af3b-cf04f4c038f7','saf','sdef','23','sdf@esfk.om','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-09-09 11:21:08','Fami',NULL,'','2024-09-09 11:21:12','Fami',NULL,'',1,0);
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
INSERT INTO `users` VALUES ('02f17fba-0aa3-417a-b342-548a3f1e5031','Analyzer1','9b883af7ef97953ad640e83ef801459d106408db931c229fc2610b77340a56dd','analyzer1@gmail.com','Analyzer','3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','[]','2024-06-07 09:25:24',0,1),('15886344-6628-4281-b30a-76bf0c771375','Warehouse1','0e842cbe0341154ee33e0ed3bc18282cd69e016a8d56fda05ec92e7ff20a0f31','warehouse1@gmail.com','Warehouse','3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','[]','2024-05-06 10:43:24',1,1),('46fe24c4-0fb3-4a30-88d4-09cc05647599','Sales1','6bc0a63cb29c92306020c0a6bbc358cc4628db277dc06e253535e126517ad637',' sales1@gmail.com','Sales','3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','[]','2024-05-06 10:11:47',0,1),('67f872c4-91d7-4564-8758-308bcf0f1308','Rama','03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4','rama@example.com',NULL,NULL,'[]','2024-08-02 14:26:57',0,0),('ab201144-c2c3-410f-b3f0-1fc6920ab72e','Fami','43a0d17178a9d26c9e0fe9a74b0b45e38d32f27aed887a008a54bf6e033bf7b9',' owner@gmail.com','Owner','9d49896b-8937-4af7-9c91-91f1cc262159','[]','2024-09-09 08:37:05',1,1),('ceee75c1-296a-4742-b10c-98d57e0b75fe','Sando','0594615c23b6ba29c73c9c68fc023c9a353d0b6f139abf03dc063be212becd8c','masandofami@gmail.com','Manager','23e39347-4cd9-4bc0-872c-7d330d189016','[]','2024-06-06 23:16:28',0,1),('fe2b77b3-09f2-4deb-9ee0-01f9194cd43c','HR1','070a3b5e8d4bd5c46acccb91c9c54614c0cd649e78c4c4719e3a64270bae5ddf','hr1@gmail.com','HR','3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','[]','2024-03-28 22:37:44',0,1);
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

-- Dump completed on 2024-09-09 11:33:03
