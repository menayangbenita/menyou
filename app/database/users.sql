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
INSERT INTO `users` VALUES ('02f17fba-0aa3-417a-b342-548a3f1e5031','Analyzer1','9b883af7ef97953ad640e83ef801459d106408db931c229fc2610b77340a56dd','analyzer1@gmail.com','Analyzer','3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','[]','2024-06-07 09:25:24',0,1),('15886344-6628-4281-b30a-76bf0c771375','Warehouse1','0e842cbe0341154ee33e0ed3bc18282cd69e016a8d56fda05ec92e7ff20a0f31','warehouse1@gmail.com','Warehouse','3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','[]','2024-05-06 10:43:24',1,1),('46fe24c4-0fb3-4a30-88d4-09cc05647599','Sales1','6bc0a63cb29c92306020c0a6bbc358cc4628db277dc06e253535e126517ad637',' sales1@gmail.com','Sales','3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','[]','2024-08-02 15:17:40',0,1),('ab201144-c2c3-410f-b3f0-1fc6920ab72e','Fami','43a0d17178a9d26c9e0fe9a74b0b45e38d32f27aed887a008a54bf6e033bf7b9',' owner@gmail.com','Owner','9d49896b-8937-4af7-9c91-91f1cc262159','[]','2024-08-02 15:18:42',0,1),('ceee75c1-296a-4742-b10c-98d57e0b75fe','Sando','0594615c23b6ba29c73c9c68fc023c9a353d0b6f139abf03dc063be212becd8c','masandofami@gmail.com','Manager','23e39347-4cd9-4bc0-872c-7d330d189016','[]','2024-06-06 23:16:28',0,1),('fe2b77b3-09f2-4deb-9ee0-01f9194cd43c','HR1','070a3b5e8d4bd5c46acccb91c9c54614c0cd649e78c4c4719e3a64270bae5ddf','hr1@gmail.com','HR','3bbd2dc8-c32f-4bcc-8f9a-bff2c47c3ebb','[]','2024-03-28 22:37:44',0,1);
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

-- Dump completed on 2024-08-03 19:31:39
