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
-- Table structure for table `dev_time_logs`
--

DROP TABLE IF EXISTS `dev_time_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dev_time_logs` (
  `time_log` int(11) DEFAULT NULL,
  `comments` varchar(100) DEFAULT NULL,
  `time_in_sec` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dev_time_logs`
--

LOCK TABLES `dev_time_logs` WRITE;
/*!40000 ALTER TABLE `dev_time_logs` DISABLE KEYS */;
INSERT INTO `dev_time_logs` VALUES (1,'this is a ',1487514012,3),(2,'all is going well',1487570208,1),(3,'I am doing this and that.',1487584078,1),(2,'kfvsdkbkfvbsdabk',1487591166,7),(1,'nwdekfvwkqevn',1487757226,10),(1,'qmwsdlfvnrnle',1487757504,10),(1,'swennkenknk',1487757624,10),(1,'qwsd',1487757681,10),(1,'nknkc',1487757791,10),(2,'wqkfbkq',1488451086,3),(1,'swdenwfeknkfvnqkw',1488451238,3),(4,'wertyuio',1488459063,3);
/*!40000 ALTER TABLE `dev_time_logs` ENABLE KEYS */;
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
