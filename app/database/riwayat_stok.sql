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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riwayat_stok`
--

LOCK TABLES `riwayat_stok` WRITE;
/*!40000 ALTER TABLE `riwayat_stok` DISABLE KEYS */;
INSERT INTO `riwayat_stok` (`id`, `uuid`, `stok_id`, `stok`, `riwayat`, `outlet_uuid`, `note`, `created_at`, `created_by`, `modified_at`, `modified_by`, `deleted_at`, `deleted_by`, `restored_at`, `restored_by`, `is_deleted`, `is_restored`) VALUES (11,'65a980b9-3af3-45fb-9ccd-5f8befaeeef1',9,29.8,'{\"2024-06-20\": {\"stok\": 30, \"masuk\": 30, \"keluar\": 0}, \"2024-07-03\": {\"stok\": 29.8, \"masuk\": 0, \"keluar\": 0.2}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-06-20 13:51:11','Fami','2024-07-03 15:31:28','Fami',NULL,'',NULL,'',0,0),(12,'dc12a8df-61dd-4b42-9787-0d4f4d09a204',7,13.98,'{\"2024-06-20\": {\"stok\": 14, \"masuk\": 14, \"keluar\": 0}, \"2024-07-03\": {\"stok\": 13.98, \"masuk\": 0, \"keluar\": 0.02}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-06-20 13:51:11','Fami','2024-07-03 15:30:06','Fami',NULL,'',NULL,'',0,0),(13,'a9bc1960-3fff-4437-94d2-a01d242360bb',10,100,'{\"2024-06-20\": {\"stok\": \"100\", \"masuk\": \"100\", \"keluar\": 0}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-06-20 14:00:35','Fami',NULL,'',NULL,'',NULL,'',0,0),(15,'de08adb7-2c13-4f43-b329-634447619175',11,7.9,'{\"2024-06-20\": {\"stok\": 5, \"masuk\": \"5\", \"keluar\": 0}, \"2024-07-03\": {\"stok\": 7.9, \"masuk\": 3, \"keluar\": 0.1}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-06-20 14:02:45','Fami','2024-07-03 15:31:28','Fami',NULL,'',NULL,'',0,0),(17,'fe10debd-7b51-4a1d-ba08-093f1f1a96de',13,11.8,'{\"2024-07-03\": {\"stok\": 11.8, \"masuk\": \"12\", \"keluar\": 0.2}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-07-03 09:29:08','Fami','2024-07-03 15:31:28','Fami',NULL,'',NULL,'',0,0),(18,'ec5f6516-6fb0-4c29-823d-979652517a07',14,20,'{\"2024-07-03\": {\"stok\": \"20\", \"masuk\": \"20\", \"keluar\": 0}}','9d49896b-8937-4af7-9c91-91f1cc262159','','2024-07-03 09:32:57','Fami',NULL,'',NULL,'',NULL,'',0,0);
/*!40000 ALTER TABLE `riwayat_stok` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-03 15:36:31
