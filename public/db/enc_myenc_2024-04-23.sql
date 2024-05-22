# ************************************************************
# Sequel Ace SQL dump
# Version 20064
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.28-MariaDB)
# Database: enc_myenc
# Generation Time: 2024-04-23 08:00:03 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table departments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `unit_id` tinyint(4) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;

INSERT INTO `departments` (`id`, `unit_id`, `name`, `created_at`, `updated_at`)
VALUES
	(2,2,'IT','2023-09-14 10:17:09','2023-09-14 10:17:09'),
	(3,2,'Finance','2023-09-14 10:17:11','2023-09-14 10:17:11'),
	(4,2,'General Service','2023-09-14 10:17:12','2023-09-14 10:17:12'),
	(5,2,'Operation','2023-09-14 10:17:13','2023-09-14 10:17:13'),
	(6,2,'Maintenance','2023-09-14 10:17:19','2023-09-14 10:17:19'),
	(7,3,'Finance','2023-09-14 10:17:33','2023-09-14 10:17:33'),
	(8,3,'HRD','2023-09-14 10:17:34','2023-09-14 10:17:34'),
	(9,3,'Sekretariat','2023-09-14 10:17:37','2023-09-14 10:17:37'),
	(10,3,'QHSSE','2023-09-14 10:17:39','2023-09-14 10:17:39'),
	(11,4,'Operation','2023-09-14 10:17:43','2023-09-14 10:17:43'),
	(12,5,'Operation','2023-09-14 10:17:49','2023-09-14 10:17:49'),
	(13,5,'General Service','2023-09-14 10:17:50','2023-09-14 10:17:50'),
	(14,5,'Oil & Gas','2023-09-14 10:17:51','2023-09-14 10:17:51'),
	(15,5,'Chemical','2023-09-14 10:17:51','2023-09-14 10:17:51'),
	(16,5,'Driving','2023-09-14 10:17:53','2023-09-14 10:17:53'),
	(17,6,'Operation','2023-09-14 10:17:56','2023-09-14 10:17:56'),
	(18,6,'Accounting & Finance','2023-09-14 10:17:57','2023-09-14 10:17:57'),
	(19,7,'Sekretariat','2023-09-14 10:17:58','2023-09-14 10:17:58'),
	(20,7,'Operation','2023-09-14 10:17:59','2023-09-14 10:17:59'),
	(21,8,'Operation','2023-09-14 10:18:00','2023-09-14 10:18:00'),
	(22,8,'Business Development','2023-09-14 10:18:00','2023-09-14 10:18:00'),
	(23,8,'General Affair','2023-09-14 10:18:01','2023-09-14 10:18:01'),
	(24,9,'Operation','2023-09-14 10:18:03','2023-09-14 10:18:03'),
	(25,9,'QHSSE','2023-09-14 10:18:04','2023-09-14 10:18:04'),
	(26,9,'Accounting & Finance','2023-09-14 10:18:04','2023-09-14 10:18:04'),
	(27,9,'Maintenance','2023-09-14 10:18:06','2023-09-14 10:18:06'),
	(28,10,'Operation','2023-09-14 10:18:07','2023-09-14 10:18:07'),
	(29,10,'General Service','2023-09-14 10:18:08','2023-09-14 10:18:08'),
	(30,10,'Accounting & Finance','2023-09-14 10:18:12','2023-09-14 10:18:12');

/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
