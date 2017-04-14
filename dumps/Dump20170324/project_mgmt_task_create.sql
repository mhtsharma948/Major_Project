CREATE DATABASE  IF NOT EXISTS `project_mgmt` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `project_mgmt`;
-- MySQL dump 10.13  Distrib 5.5.54, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: project_mgmt
-- ------------------------------------------------------
-- Server version	5.5.54-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `task_create`
--

DROP TABLE IF EXISTS `task_create`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_create` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_name` varchar(50) DEFAULT NULL,
  `estimate_time` varchar(20) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `workspace_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_create`
--

LOCK TABLES `task_create` WRITE;
/*!40000 ALTER TABLE `task_create` DISABLE KEYS */;
INSERT INTO `task_create` VALUES (1,'Test Series','10hrs','descr',10),(2,'Database Schema','10hrs','descr',10),(3,'Db','3hrs','descr',7),(4,'Mail to student','3hrs','descr',10),(5,'ecrewhk','2hrs','descr',16),(6,'xyz','3hrs','descr',16),(7,'abc','4hrs','descr',16),(8,'Test task 1','2','descr',11),(9,'Symphony','4hrs','Symphony and http fundamentals',10),(10,'CSS','2hrs','wkenwjnqfknk',19),(11,'routing system','10hrs','qsxdcenjknrfkjwnfkqn',20);
/*!40000 ALTER TABLE `task_create` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-24 17:37:00
