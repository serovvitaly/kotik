-- MySQL dump 10.13  Distrib 5.6.24, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: kotik
-- ------------------------------------------------------
-- Server version	5.5.5-10.0.20-MariaDB-1~trusty

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
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (4,'user-create','Создание пользователя','','2015-07-25 20:15:07','2015-07-25 20:15:07'),(5,'user-edit','Редактирование пользователя','','2015-07-25 20:15:28','2015-07-25 20:15:28'),(6,'user-delete','Удаление пользователя','','2015-07-25 20:15:50','2015-07-25 20:15:50'),(7,'user-view','Просмотр сведений о пользователе','','2015-07-25 20:16:21','2015-07-25 20:16:21'),(8,'role-create','Создание роли','','2015-07-25 20:16:47','2015-07-25 20:16:47'),(9,'role-edit','Редактирование роли','','2015-07-25 20:17:19','2015-07-25 20:17:19'),(10,'role-view','Просмотр ролей','','2015-07-28 19:11:35','2015-07-28 19:11:35'),(11,'role-delete','Удаление роли','','2015-07-28 19:12:15','2015-07-28 19:12:15'),(12,'adminka-access','Доступ в админку','','2015-07-26 12:10:41','2015-07-26 12:10:41'),(15,'permission-create','Создание привилегии','','2015-07-28 19:14:55','2015-07-28 19:23:47'),(16,'permission-edit','Редактирование привилегии','','2015-07-28 19:15:02','2015-07-28 19:24:07'),(17,'permission-view','Просмотр привилегии','','2015-07-28 19:15:08','2015-07-28 19:24:21'),(18,'permission-delete','Удаление привилегии','','2015-07-28 19:15:14','2015-07-28 19:24:31');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-01  9:00:05
