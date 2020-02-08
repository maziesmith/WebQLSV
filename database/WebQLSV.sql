-- MySQL dump 10.13  Distrib 8.0.18, for Linux (x86_64)
--
-- Host: localhost    Database: qlsv
-- ------------------------------------------------------
-- Server version	8.0.19-0ubuntu0.19.10.3

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
-- Table structure for table `GiaoVien`
--

DROP TABLE IF EXISTS `GiaoVien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `GiaoVien` (
  `IdGiaoVien` int NOT NULL,
  `Khoa` varchar(45) NOT NULL,
  `NamKinhNghiem` int NOT NULL,
  PRIMARY KEY (`IdGiaoVien`),
  CONSTRAINT `fk_GiaoVien_User1` FOREIGN KEY (`IdGiaoVien`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GiaoVien`
--

LOCK TABLES `GiaoVien` WRITE;
/*!40000 ALTER TABLE `GiaoVien` DISABLE KEYS */;
INSERT INTO `GiaoVien` VALUES (1,'Cong nghe thong tin',5);
/*!40000 ALTER TABLE `GiaoVien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Messenge`
--

DROP TABLE IF EXISTS `Messenge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Messenge` (
  `IdUserSent` int NOT NULL,
  `IdUserRecv` int NOT NULL,
  `IdMess` varchar(45) NOT NULL,
  `Mess` longtext NOT NULL,
  PRIMARY KEY (`IdUserSent`,`IdUserRecv`,`IdMess`),
  KEY `fk_User_has_User_User2_idx` (`IdUserRecv`),
  KEY `fk_User_has_User_User1_idx` (`IdUserSent`),
  CONSTRAINT `fk_User_has_User_User1` FOREIGN KEY (`IdUserSent`) REFERENCES `User` (`Id`),
  CONSTRAINT `fk_User_has_User_User2` FOREIGN KEY (`IdUserRecv`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Messenge`
--

LOCK TABLES `Messenge` WRITE;
/*!40000 ALTER TABLE `Messenge` DISABLE KEYS */;
/*!40000 ALTER TABLE `Messenge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SinhVien`
--

DROP TABLE IF EXISTS `SinhVien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `SinhVien` (
  `IdSinhVien` int NOT NULL,
  `GPA` float NOT NULL,
  PRIMARY KEY (`IdSinhVien`),
  CONSTRAINT `fk_SinhVien_User1` FOREIGN KEY (`IdSinhVien`) REFERENCES `User` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SinhVien`
--

LOCK TABLES `SinhVien` WRITE;
/*!40000 ALTER TABLE `SinhVien` DISABLE KEYS */;
INSERT INTO `SinhVien` VALUES (2,2.9),(3,3);
/*!40000 ALTER TABLE `SinhVien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `Id` int NOT NULL,
  `HoTen` varchar(45) NOT NULL,
  `Email` varchar(45) NOT NULL,
  `SĐT` varchar(45) NOT NULL,
  `Username` varchar(45) NOT NULL,
  `Password` varchar(45) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Username_UNIQUE` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'abcd','abcd@gmail.com','123456','admin','admin'),(2,'abcd13','abcd@gmail.com','123456','abcd12','abcd'),(3,'abcde','abcde@gmail.com','1234567','abcde1','abcde/');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-03  1:44:45
