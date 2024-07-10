# ************************************************************
# Sequel Ace SQL dump
# Version 20067
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Host: 127.0.0.1 (MySQL 5.5.5-10.4.28-MariaDB)
# Database: enc_mygs
# Generation Time: 2024-07-10 08:11:58 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table aggreements
# ------------------------------------------------------------

DROP TABLE IF EXISTS `aggreements`;

CREATE TABLE `aggreements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `id_no` varchar(255) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `sub_dept_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `project` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `hourly_rate` int(11) DEFAULT NULL,
  `payslip` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `determination` date DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `cuti` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `loc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `direct_leader_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table allowances
# ------------------------------------------------------------

DROP TABLE IF EXISTS `allowances`;

CREATE TABLE `allowances` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `option` varchar(255) DEFAULT NULL,
  `amount_option` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table announcements
# ------------------------------------------------------------

DROP TABLE IF EXISTS `announcements`;

CREATE TABLE `announcements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table bank_accounts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bank_accounts`;

CREATE TABLE `bank_accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `account_no` varchar(255) NOT NULL,
  `expired_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table banks
# ------------------------------------------------------------

DROP TABLE IF EXISTS `banks`;

CREATE TABLE `banks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table biodatas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `biodatas`;

CREATE TABLE `biodatas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_ktp` varchar(20) DEFAULT NULL,
  `no_kk` varchar(20) DEFAULT NULL,
  `no_npwp` varchar(30) DEFAULT NULL,
  `status_pajak` varchar(10) DEFAULT NULL,
  `alamat_ktp` varchar(10) DEFAULT NULL,
  `no_jamsostek` varchar(30) DEFAULT NULL,
  `no_bpjs_kesehatan` varchar(30) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `marital` varchar(255) DEFAULT NULL,
  `post_code` varchar(255) DEFAULT NULL,
  `blood` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `citizenship` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `last_education` varchar(255) DEFAULT NULL,
  `vocational` varchar(255) DEFAULT NULL,
  `institution_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table commissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `commissions`;

CREATE TABLE `commissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `option` varchar(255) DEFAULT NULL,
  `amount_option` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table compositions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `compositions`;

CREATE TABLE `compositions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table contracts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contracts`;

CREATE TABLE `contracts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_no` varchar(255) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `shift_id` int(11) DEFAULT NULL,
  `project` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `hourly_rate` int(11) DEFAULT NULL,
  `payslip` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `determination` date DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `cuti` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `loc` varchar(255) DEFAULT NULL,
  `sub_dept_id` int(11) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table deactivates
# ------------------------------------------------------------

DROP TABLE IF EXISTS `deactivates`;

CREATE TABLE `deactivates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table deductions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `deductions`;

CREATE TABLE `deductions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `option` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



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



# Dump of table designations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `designations`;

CREATE TABLE `designations` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `golongan` varchar(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table documents
# ------------------------------------------------------------

DROP TABLE IF EXISTS `documents`;

CREATE TABLE `documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table duties
# ------------------------------------------------------------

DROP TABLE IF EXISTS `duties`;

CREATE TABLE `duties` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table educationals
# ------------------------------------------------------------

DROP TABLE IF EXISTS `educationals`;

CREATE TABLE `educationals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `degree` varchar(255) NOT NULL,
  `major` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `year` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table emergencies
# ------------------------------------------------------------

DROP TABLE IF EXISTS `emergencies`;

CREATE TABLE `emergencies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `hubungan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employee_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table employees
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) DEFAULT NULL,
  `completeness` int(11) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `sub_dept_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `biodata_id` int(11) DEFAULT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `direct_leader_id` int(11) DEFAULT NULL,
  `kpi_id` int(11) DEFAULT NULL,
  `nik` varchar(50) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `determination_date` date DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `emergency_id` int(11) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `join` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table exports
# ------------------------------------------------------------

DROP TABLE IF EXISTS `exports`;

CREATE TABLE `exports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table failed_jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table logs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `logs`;

CREATE TABLE `logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;

INSERT INTO `migrations` (`id`, `migration`, `batch`)
VALUES
	(33,'2014_10_12_000000_create_users_table',1),
	(34,'2014_10_12_100000_create_password_resets_table',1),
	(35,'2019_08_19_000000_create_failed_jobs_table',1),
	(36,'2019_12_14_000001_create_personal_access_tokens_table',1),
	(37,'2023_06_05_032754_create_permission_tables',1),
	(38,'2023_06_05_072411_create_employees_table',1),
	(39,'2023_06_06_034311_create_departments_table',1),
	(40,'2023_06_06_071427_create_designations_table',1),
	(41,'2023_06_07_014127_create_shifts_table',1),
	(42,'2023_06_07_014330_create_socials_table',1),
	(43,'2023_06_07_014809_create_banks_table',1),
	(44,'2023_06_07_014826_create_social_accounts_table',1),
	(45,'2023_06_07_014843_create_bank_accounts_table',1),
	(46,'2023_06_07_024122_create_biodatas_table',1),
	(47,'2023_06_07_063942_create_contracts_table',1),
	(48,'2023_06_08_104331_create_units_table',1),
	(49,'2023_06_12_143551_create_emergencies_table',1),
	(50,'2023_06_14_084708_create_documents_table',1),
	(51,'2023_06_14_150934_create_allowances_table',1),
	(52,'2023_06_14_151237_create_commissions_table',1),
	(53,'2023_06_14_151253_create_deductions_table',1),
	(54,'2023_06_14_151327_create_reimbursements_table',1),
	(56,'2023_07_25_145713_create_pe_kpis_table',1),
	(57,'2023_07_27_103753_create_pekpi_details_table',1),
	(58,'2023_07_27_104622_create_pekpi_points_table',1),
	(62,'2023_08_29_150657_create_sub_depts_table',1),
	(63,'2023_08_29_151317_create_positions_table',1),
	(64,'2023_09_01_143944_create_sos_table',1),
	(70,'2023_07_25_142349_create_pe_components_table',2),
	(71,'2023_08_02_115009_create_pe_kpas_table',2),
	(72,'2023_08_03_163456_create_pekpa_details_table',2),
	(73,'2023_08_29_134112_create_compositions_table',3),
	(74,'2024_01_09_145549_create_pe_component_groups_table',3),
	(75,'2024_01_09_153125_create_pe_component_fors_table',3),
	(76,'2024_01_22_112622_create_pe_disciplines_table',3),
	(77,'2024_01_23_100409_create_temp_disciplines_table',4),
	(78,'2024_01_26_145012_create_exports_table',5),
	(79,'2024_04_22_141116_create_overtimes_table',5),
	(80,'2024_04_23_141029_create_duties_table',5),
	(81,'2024_04_23_143252_create_presences_table',5),
	(82,'2024_04_23_144931_create_spkls_table',5),
	(83,'2024_04_23_144947_create_spts_table',5),
	(84,'2024_04_26_151151_create_announcements_table',5),
	(85,'2024_05_17_163620_create_pes_table',5),
	(86,'2024_05_17_163636_create_pe_behaviors_table',5),
	(87,'2024_05_17_163730_create_pe_behavior_points_table',5),
	(88,'2024_05_17_163926_create_pe_behavior_apprasials_table',5),
	(89,'2024_05_17_164810_create_pe_behavior_apprasial_details_table',5),
	(90,'2024_05_30_091304_create_sps_table',5),
	(91,'2024_05_31_103040_create_pe_discipline_details_table',5),
	(92,'2024_06_25_090100_create_educationals_table',6),
	(93,'2024_06_25_091210_create_deactivates_table',6),
	(94,'2024_06_26_095440_create_mutations_table',7),
	(95,'2024_06_26_095841_create_aggreements_table',7),
	(96,'2024_07_03_083836_create_logs_table',8),
	(97,'2024_07_04_084642_create_sp_approvals_table',9);

/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table model_has_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table model_has_roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`)
VALUES
	(1,'App\\Models\\User',1),
	(1,'App\\Models\\User',2),
	(2,'App\\Models\\User',148),
	(2,'App\\Models\\User',159),
	(2,'App\\Models\\User',166),
	(2,'App\\Models\\User',167),
	(2,'App\\Models\\User',190),
	(2,'App\\Models\\User',194),
	(3,'App\\Models\\User',4),
	(3,'App\\Models\\User',5),
	(3,'App\\Models\\User',6),
	(3,'App\\Models\\User',7),
	(3,'App\\Models\\User',8),
	(3,'App\\Models\\User',9),
	(3,'App\\Models\\User',10),
	(3,'App\\Models\\User',13),
	(3,'App\\Models\\User',14),
	(3,'App\\Models\\User',15),
	(3,'App\\Models\\User',16),
	(3,'App\\Models\\User',17),
	(3,'App\\Models\\User',18),
	(3,'App\\Models\\User',19),
	(3,'App\\Models\\User',20),
	(3,'App\\Models\\User',22),
	(3,'App\\Models\\User',23),
	(3,'App\\Models\\User',24),
	(3,'App\\Models\\User',25),
	(3,'App\\Models\\User',26),
	(3,'App\\Models\\User',27),
	(3,'App\\Models\\User',29),
	(3,'App\\Models\\User',30),
	(3,'App\\Models\\User',31),
	(3,'App\\Models\\User',32),
	(3,'App\\Models\\User',33),
	(3,'App\\Models\\User',34),
	(3,'App\\Models\\User',35),
	(3,'App\\Models\\User',36),
	(3,'App\\Models\\User',37),
	(3,'App\\Models\\User',38),
	(3,'App\\Models\\User',39),
	(3,'App\\Models\\User',40),
	(3,'App\\Models\\User',41),
	(3,'App\\Models\\User',42),
	(3,'App\\Models\\User',43),
	(3,'App\\Models\\User',44),
	(3,'App\\Models\\User',45),
	(3,'App\\Models\\User',46),
	(3,'App\\Models\\User',47),
	(3,'App\\Models\\User',48),
	(3,'App\\Models\\User',49),
	(3,'App\\Models\\User',50),
	(3,'App\\Models\\User',51),
	(3,'App\\Models\\User',54),
	(3,'App\\Models\\User',55),
	(3,'App\\Models\\User',56),
	(3,'App\\Models\\User',57),
	(3,'App\\Models\\User',58),
	(3,'App\\Models\\User',59),
	(3,'App\\Models\\User',60),
	(3,'App\\Models\\User',61),
	(3,'App\\Models\\User',62),
	(3,'App\\Models\\User',63),
	(3,'App\\Models\\User',64),
	(3,'App\\Models\\User',65),
	(3,'App\\Models\\User',66),
	(3,'App\\Models\\User',67),
	(3,'App\\Models\\User',69),
	(3,'App\\Models\\User',70),
	(3,'App\\Models\\User',71),
	(3,'App\\Models\\User',72),
	(3,'App\\Models\\User',73),
	(3,'App\\Models\\User',75),
	(3,'App\\Models\\User',76),
	(3,'App\\Models\\User',77),
	(3,'App\\Models\\User',78),
	(3,'App\\Models\\User',79),
	(3,'App\\Models\\User',80),
	(3,'App\\Models\\User',81),
	(3,'App\\Models\\User',82),
	(3,'App\\Models\\User',84),
	(3,'App\\Models\\User',85),
	(3,'App\\Models\\User',86),
	(3,'App\\Models\\User',87),
	(3,'App\\Models\\User',88),
	(3,'App\\Models\\User',89),
	(3,'App\\Models\\User',90),
	(3,'App\\Models\\User',91),
	(3,'App\\Models\\User',93),
	(3,'App\\Models\\User',95),
	(3,'App\\Models\\User',96),
	(3,'App\\Models\\User',97),
	(3,'App\\Models\\User',98),
	(3,'App\\Models\\User',99),
	(3,'App\\Models\\User',100),
	(3,'App\\Models\\User',101),
	(3,'App\\Models\\User',102),
	(3,'App\\Models\\User',103),
	(3,'App\\Models\\User',104),
	(3,'App\\Models\\User',105),
	(3,'App\\Models\\User',106),
	(3,'App\\Models\\User',107),
	(3,'App\\Models\\User',108),
	(3,'App\\Models\\User',109),
	(3,'App\\Models\\User',110),
	(3,'App\\Models\\User',111),
	(3,'App\\Models\\User',112),
	(3,'App\\Models\\User',113),
	(3,'App\\Models\\User',114),
	(3,'App\\Models\\User',115),
	(3,'App\\Models\\User',116),
	(3,'App\\Models\\User',117),
	(3,'App\\Models\\User',118),
	(3,'App\\Models\\User',120),
	(3,'App\\Models\\User',123),
	(3,'App\\Models\\User',124),
	(3,'App\\Models\\User',125),
	(3,'App\\Models\\User',126),
	(3,'App\\Models\\User',127),
	(3,'App\\Models\\User',128),
	(3,'App\\Models\\User',130),
	(3,'App\\Models\\User',131),
	(3,'App\\Models\\User',132),
	(3,'App\\Models\\User',133),
	(3,'App\\Models\\User',134),
	(3,'App\\Models\\User',135),
	(3,'App\\Models\\User',136),
	(3,'App\\Models\\User',137),
	(3,'App\\Models\\User',138),
	(3,'App\\Models\\User',139),
	(3,'App\\Models\\User',140),
	(3,'App\\Models\\User',141),
	(3,'App\\Models\\User',142),
	(3,'App\\Models\\User',143),
	(3,'App\\Models\\User',144),
	(3,'App\\Models\\User',145),
	(3,'App\\Models\\User',150),
	(3,'App\\Models\\User',151),
	(3,'App\\Models\\User',153),
	(3,'App\\Models\\User',154),
	(3,'App\\Models\\User',155),
	(3,'App\\Models\\User',156),
	(3,'App\\Models\\User',160),
	(3,'App\\Models\\User',163),
	(3,'App\\Models\\User',164),
	(3,'App\\Models\\User',168),
	(3,'App\\Models\\User',169),
	(3,'App\\Models\\User',170),
	(3,'App\\Models\\User',171),
	(3,'App\\Models\\User',172),
	(3,'App\\Models\\User',175),
	(3,'App\\Models\\User',176),
	(3,'App\\Models\\User',177),
	(3,'App\\Models\\User',178),
	(3,'App\\Models\\User',179),
	(3,'App\\Models\\User',180),
	(3,'App\\Models\\User',181),
	(3,'App\\Models\\User',182),
	(3,'App\\Models\\User',184),
	(3,'App\\Models\\User',188),
	(3,'App\\Models\\User',189),
	(3,'App\\Models\\User',191),
	(3,'App\\Models\\User',192),
	(3,'App\\Models\\User',193),
	(3,'App\\Models\\User',195),
	(3,'App\\Models\\User',196),
	(3,'App\\Models\\User',197),
	(3,'App\\Models\\User',198),
	(3,'App\\Models\\User',199),
	(3,'App\\Models\\User',200),
	(3,'App\\Models\\User',201),
	(3,'App\\Models\\User',202),
	(3,'App\\Models\\User',203),
	(3,'App\\Models\\User',204),
	(3,'App\\Models\\User',205),
	(3,'App\\Models\\User',206),
	(3,'App\\Models\\User',207),
	(3,'App\\Models\\User',208),
	(3,'App\\Models\\User',209),
	(3,'App\\Models\\User',210),
	(3,'App\\Models\\User',211),
	(3,'App\\Models\\User',212),
	(3,'App\\Models\\User',213),
	(3,'App\\Models\\User',214),
	(3,'App\\Models\\User',215),
	(3,'App\\Models\\User',216),
	(3,'App\\Models\\User',217),
	(3,'App\\Models\\User',218),
	(3,'App\\Models\\User',219),
	(3,'App\\Models\\User',220),
	(3,'App\\Models\\User',221),
	(3,'App\\Models\\User',222),
	(3,'App\\Models\\User',223),
	(3,'App\\Models\\User',224),
	(3,'App\\Models\\User',225),
	(3,'App\\Models\\User',226),
	(3,'App\\Models\\User',227),
	(3,'App\\Models\\User',228),
	(3,'App\\Models\\User',229),
	(3,'App\\Models\\User',230),
	(3,'App\\Models\\User',231),
	(3,'App\\Models\\User',232),
	(3,'App\\Models\\User',233),
	(3,'App\\Models\\User',234),
	(3,'App\\Models\\User',235),
	(3,'App\\Models\\User',236),
	(3,'App\\Models\\User',237),
	(3,'App\\Models\\User',238),
	(3,'App\\Models\\User',239),
	(3,'App\\Models\\User',240),
	(3,'App\\Models\\User',241),
	(3,'App\\Models\\User',242),
	(3,'App\\Models\\User',243),
	(3,'App\\Models\\User',244),
	(3,'App\\Models\\User',245),
	(3,'App\\Models\\User',246),
	(3,'App\\Models\\User',247),
	(3,'App\\Models\\User',248),
	(3,'App\\Models\\User',249),
	(3,'App\\Models\\User',250),
	(3,'App\\Models\\User',251),
	(3,'App\\Models\\User',252),
	(3,'App\\Models\\User',253),
	(3,'App\\Models\\User',254),
	(3,'App\\Models\\User',255),
	(3,'App\\Models\\User',257),
	(3,'App\\Models\\User',258),
	(3,'App\\Models\\User',262),
	(3,'App\\Models\\User',263),
	(3,'App\\Models\\User',265),
	(3,'App\\Models\\User',266),
	(3,'App\\Models\\User',267),
	(3,'App\\Models\\User',268),
	(3,'App\\Models\\User',269),
	(3,'App\\Models\\User',270),
	(3,'App\\Models\\User',271),
	(3,'App\\Models\\User',272),
	(3,'App\\Models\\User',273),
	(3,'App\\Models\\User',274),
	(3,'App\\Models\\User',276),
	(3,'App\\Models\\User',277),
	(3,'App\\Models\\User',278),
	(3,'App\\Models\\User',279),
	(3,'App\\Models\\User',280),
	(3,'App\\Models\\User',281),
	(3,'App\\Models\\User',282),
	(3,'App\\Models\\User',283),
	(3,'App\\Models\\User',284),
	(3,'App\\Models\\User',285),
	(3,'App\\Models\\User',286),
	(3,'App\\Models\\User',287),
	(3,'App\\Models\\User',288),
	(3,'App\\Models\\User',289),
	(3,'App\\Models\\User',290),
	(3,'App\\Models\\User',291),
	(3,'App\\Models\\User',292),
	(3,'App\\Models\\User',293),
	(3,'App\\Models\\User',294),
	(3,'App\\Models\\User',296),
	(3,'App\\Models\\User',297),
	(3,'App\\Models\\User',298),
	(3,'App\\Models\\User',300),
	(3,'App\\Models\\User',301),
	(3,'App\\Models\\User',304),
	(3,'App\\Models\\User',305),
	(3,'App\\Models\\User',307),
	(3,'App\\Models\\User',308),
	(3,'App\\Models\\User',309),
	(3,'App\\Models\\User',313),
	(3,'App\\Models\\User',314),
	(3,'App\\Models\\User',315),
	(3,'App\\Models\\User',316),
	(3,'App\\Models\\User',317),
	(3,'App\\Models\\User',318),
	(3,'App\\Models\\User',319),
	(3,'App\\Models\\User',320),
	(3,'App\\Models\\User',321),
	(3,'App\\Models\\User',322),
	(3,'App\\Models\\User',323),
	(3,'App\\Models\\User',324),
	(3,'App\\Models\\User',325),
	(3,'App\\Models\\User',326),
	(3,'App\\Models\\User',327),
	(3,'App\\Models\\User',328),
	(3,'App\\Models\\User',329),
	(3,'App\\Models\\User',330),
	(3,'App\\Models\\User',331),
	(3,'App\\Models\\User',332),
	(3,'App\\Models\\User',333),
	(3,'App\\Models\\User',334),
	(3,'App\\Models\\User',335),
	(3,'App\\Models\\User',336),
	(3,'App\\Models\\User',337),
	(3,'App\\Models\\User',338),
	(3,'App\\Models\\User',339),
	(3,'App\\Models\\User',340),
	(3,'App\\Models\\User',341),
	(3,'App\\Models\\User',342),
	(3,'App\\Models\\User',343),
	(3,'App\\Models\\User',344),
	(3,'App\\Models\\User',345),
	(3,'App\\Models\\User',346),
	(3,'App\\Models\\User',348),
	(3,'App\\Models\\User',349),
	(3,'App\\Models\\User',350),
	(3,'App\\Models\\User',352),
	(3,'App\\Models\\User',353),
	(3,'App\\Models\\User',354),
	(3,'App\\Models\\User',355),
	(3,'App\\Models\\User',356),
	(3,'App\\Models\\User',357),
	(3,'App\\Models\\User',358),
	(3,'App\\Models\\User',359),
	(3,'App\\Models\\User',361),
	(3,'App\\Models\\User',362),
	(3,'App\\Models\\User',363),
	(3,'App\\Models\\User',364),
	(3,'App\\Models\\User',365),
	(3,'App\\Models\\User',366),
	(3,'App\\Models\\User',367),
	(3,'App\\Models\\User',368),
	(3,'App\\Models\\User',369),
	(3,'App\\Models\\User',375),
	(3,'App\\Models\\User',376),
	(3,'App\\Models\\User',381),
	(3,'App\\Models\\User',382),
	(3,'App\\Models\\User',384),
	(4,'App\\Models\\User',21),
	(4,'App\\Models\\User',28),
	(4,'App\\Models\\User',68),
	(4,'App\\Models\\User',83),
	(4,'App\\Models\\User',92),
	(4,'App\\Models\\User',121),
	(4,'App\\Models\\User',122),
	(4,'App\\Models\\User',157),
	(4,'App\\Models\\User',185),
	(4,'App\\Models\\User',186),
	(4,'App\\Models\\User',260),
	(4,'App\\Models\\User',295),
	(4,'App\\Models\\User',302),
	(4,'App\\Models\\User',303),
	(4,'App\\Models\\User',310),
	(4,'App\\Models\\User',311),
	(4,'App\\Models\\User',312),
	(5,'App\\Models\\User',3),
	(5,'App\\Models\\User',52),
	(5,'App\\Models\\User',147),
	(5,'App\\Models\\User',149),
	(5,'App\\Models\\User',183),
	(5,'App\\Models\\User',259),
	(5,'App\\Models\\User',306),
	(5,'App\\Models\\User',347),
	(6,'App\\Models\\User',146),
	(8,'App\\Models\\User',11),
	(8,'App\\Models\\User',12),
	(8,'App\\Models\\User',74),
	(8,'App\\Models\\User',94),
	(8,'App\\Models\\User',119),
	(8,'App\\Models\\User',129),
	(8,'App\\Models\\User',152),
	(8,'App\\Models\\User',158),
	(8,'App\\Models\\User',165),
	(8,'App\\Models\\User',256),
	(8,'App\\Models\\User',261),
	(8,'App\\Models\\User',264),
	(8,'App\\Models\\User',275),
	(8,'App\\Models\\User',299),
	(8,'App\\Models\\User',351),
	(8,'App\\Models\\User',360),
	(8,'App\\Models\\User',370),
	(8,'App\\Models\\User',371),
	(9,'App\\Models\\User',53),
	(9,'App\\Models\\User',161),
	(9,'App\\Models\\User',173),
	(9,'App\\Models\\User',187),
	(11,'App\\Models\\User',162),
	(12,'App\\Models\\User',174);

/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table mutations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `mutations`;

CREATE TABLE `mutations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `before_id` int(11) NOT NULL,
  `become_id` int(11) NOT NULL,
  `desc` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table overtimes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `overtimes`;

CREATE TABLE `overtimes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `spkl_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `rate` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table password_resets
# ------------------------------------------------------------

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pe_behavior_apprasial_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pe_behavior_apprasial_details`;

CREATE TABLE `pe_behavior_apprasial_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pba_id` bigint(20) NOT NULL,
  `behavior_id` bigint(20) DEFAULT NULL,
  `value` decimal(6,2) NOT NULL DEFAULT 0.00,
  `achievement` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pe_behavior_apprasials
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pe_behavior_apprasials`;

CREATE TABLE `pe_behavior_apprasials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pe_id` bigint(20) NOT NULL,
  `achievement` int(11) NOT NULL DEFAULT 0,
  `weight` int(11) NOT NULL DEFAULT 0,
  `contribute_to_pe` int(11) NOT NULL DEFAULT 0,
  `status` varchar(3) NOT NULL DEFAULT '0',
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pe_behavior_points
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pe_behavior_points`;

CREATE TABLE `pe_behavior_points` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `behavior_id` bigint(20) NOT NULL,
  `point` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pe_behaviors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pe_behaviors`;

CREATE TABLE `pe_behaviors` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `objective` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `bobot` tinyint(4) NOT NULL DEFAULT 0,
  `priode` varchar(50) DEFAULT NULL,
  `level` varchar(3) NOT NULL DEFAULT 's',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pe_component_fors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pe_component_fors`;

CREATE TABLE `pe_component_fors` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` tinyint(4) NOT NULL,
  `designation_id` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pe_component_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pe_component_groups`;

CREATE TABLE `pe_component_groups` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pe_components
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pe_components`;

CREATE TABLE `pe_components` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL,
  `table` varchar(255) DEFAULT NULL,
  `group_id` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pe_discipline_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pe_discipline_details`;

CREATE TABLE `pe_discipline_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pd_id` bigint(20) NOT NULL,
  `employe_id` bigint(20) NOT NULL,
  `bulan` varchar(2) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `alpa` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `ijin` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `terlambat` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `achievement` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `status` varchar(3) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pe_disciplines
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pe_disciplines`;

CREATE TABLE `pe_disciplines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pe_id` bigint(20) DEFAULT NULL,
  `employe_id` bigint(20) NOT NULL,
  `date` date DEFAULT NULL,
  `bulan` varchar(2) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `semester` varchar(1) DEFAULT NULL,
  `alpa` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `ijin` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `terlambat` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `achievement` decimal(3,2) NOT NULL DEFAULT 1.00,
  `weight` int(11) NOT NULL DEFAULT 0,
  `contribute_to_pe` int(11) NOT NULL DEFAULT 0,
  `status` varchar(3) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pe_kpas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pe_kpas`;

CREATE TABLE `pe_kpas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pe_id` bigint(20) NOT NULL,
  `kpi_id` int(11) NOT NULL,
  `employe_id` bigint(20) NOT NULL,
  `achievement` int(11) NOT NULL DEFAULT 0,
  `weight` tinyint(4) NOT NULL DEFAULT 0,
  `contribute_to_pe` tinyint(4) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `is_semester` varchar(1) NOT NULL DEFAULT '0',
  `semester` varchar(1) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `status` varchar(3) NOT NULL DEFAULT '0',
  `alasan_reject` text DEFAULT NULL,
  `release_at` datetime DEFAULT NULL,
  `resend_at` datetime DEFAULT NULL,
  `verifikasi_at` datetime DEFAULT NULL,
  `validasi_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `verifikasi_by` varchar(255) DEFAULT NULL,
  `validasi_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pe_kpis
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pe_kpis`;

CREATE TABLE `pe_kpis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `departement_id` bigint(20) NOT NULL,
  `position_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pekpa_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pekpa_details`;

CREATE TABLE `pekpa_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kpa_id` bigint(20) NOT NULL,
  `kpidetail_id` bigint(20) DEFAULT NULL,
  `value` decimal(6,2) NOT NULL DEFAULT 0.00,
  `achievement` int(11) NOT NULL DEFAULT 0,
  `addtional` varchar(1) NOT NULL DEFAULT '0',
  `addtional_objective` varchar(255) DEFAULT NULL,
  `addtional_weight` int(11) NOT NULL DEFAULT 0,
  `addtional_target` int(11) DEFAULT NULL,
  `evidence` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pekpi_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pekpi_details`;

CREATE TABLE `pekpi_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kpi_id` int(11) NOT NULL,
  `objective` varchar(255) NOT NULL,
  `kpi` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL,
  `target` int(11) NOT NULL,
  `priode_target` varchar(255) NOT NULL,
  `metode` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pekpi_points
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pekpi_points`;

CREATE TABLE `pekpi_points` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pekpi_detail_id` bigint(20) NOT NULL,
  `point` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table personal_access_tokens
# ------------------------------------------------------------

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table pes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pes`;

CREATE TABLE `pes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employe_id` bigint(20) NOT NULL,
  `date` date NOT NULL DEFAULT '2024-01-01',
  `achievement` int(11) NOT NULL DEFAULT 0,
  `status` varchar(3) NOT NULL DEFAULT '0',
  `discipline` int(11) NOT NULL DEFAULT 0,
  `kpi` int(11) NOT NULL DEFAULT 0,
  `behavior` int(11) NOT NULL DEFAULT 0,
  `pengurang` int(11) NOT NULL DEFAULT 0,
  `is_semester` varchar(1) NOT NULL DEFAULT '0',
  `semester` varchar(1) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `alasan_reject` text DEFAULT NULL,
  `release_at` datetime DEFAULT NULL,
  `resend_at` datetime DEFAULT NULL,
  `verifikasi_at` datetime DEFAULT NULL,
  `validasi_at` datetime DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `verifikasi_by` varchar(255) DEFAULT NULL,
  `validasi_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nd_date` date DEFAULT NULL,
  `complained` int(1) DEFAULT 0,
  `complain_date` date DEFAULT NULL,
  `complain_alasan` varchar(255) DEFAULT NULL,
  `nd_for` varchar(11) DEFAULT NULL,
  `nd_dibuat` varchar(11) DEFAULT NULL,
  `nd_alasan` char(255) DEFAULT NULL,
  `nd_from` varchar(255) DEFAULT NULL,
  `komentar` varchar(255) DEFAULT NULL,
  `pengembangan` varchar(255) DEFAULT NULL,
  `evidence` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table positions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `positions`;

CREATE TABLE `positions` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `report_to` varchar(255) DEFAULT NULL,
  `sub_dept_id` smallint(6) NOT NULL,
  `designation_id` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table presences
# ------------------------------------------------------------

DROP TABLE IF EXISTS `presences`;

CREATE TABLE `presences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `in_loc` varchar(255) DEFAULT NULL,
  `in_date` date DEFAULT NULL,
  `in_time` time DEFAULT NULL,
  `out_loc` varchar(255) DEFAULT NULL,
  `out_date` date DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `total` time DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table reimbursements
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reimbursements`;

CREATE TABLE `reimbursements` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `option` varchar(255) DEFAULT NULL,
  `amount_option` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table role_has_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`)
VALUES
	(1,'Administrator','web','2023-09-14 10:16:25','2023-09-14 10:16:25'),
	(2,'HRD','web','2023-09-14 10:16:25','2023-09-14 10:16:25'),
	(3,'Karyawan','web','2023-09-14 10:16:25','2023-09-14 10:16:25'),
	(4,'Leader','web','2023-09-14 10:16:26','2023-09-14 10:16:26'),
	(5,'Manager','web','2023-09-14 10:16:26','2023-09-14 10:16:26'),
	(6,'BOD','web','2023-09-14 10:16:26','2023-09-14 10:16:26'),
	(8,'Supervisor','web','2024-06-14 09:36:33','2024-06-14 09:36:33'),
	(9,'Asst. Manager','web','2024-06-14 09:36:33','2024-06-14 09:36:33'),
	(10,'HRD-Payroll','web','2024-07-02 09:39:45','2024-07-02 09:39:45'),
	(11,'HRD-Recruitment','web','2024-07-02 09:40:59','2024-07-02 09:40:59'),
	(12,'HRD-Spv','web','2024-07-03 08:40:36','2024-07-03 08:40:36');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table shifts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `shifts`;

CREATE TABLE `shifts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `in` time DEFAULT NULL,
  `out` time DEFAULT NULL,
  `total` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table social_accounts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `social_accounts`;

CREATE TABLE `social_accounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `social_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table socials
# ------------------------------------------------------------

DROP TABLE IF EXISTS `socials`;

CREATE TABLE `socials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table sos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sos`;

CREATE TABLE `sos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table sp_approvals
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sp_approvals`;

CREATE TABLE `sp_approvals` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) DEFAULT NULL,
  `sp_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `level` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table spkls
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spkls`;

CREATE TABLE `spkls` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `start` time NOT NULL,
  `end` time NOT NULL,
  `desc` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `loc` varchar(255) DEFAULT NULL,
  `total` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table sps
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sps`;

CREATE TABLE `sps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `by_id` int(11) DEFAULT NULL,
  `pe_id` int(11) DEFAULT NULL,
  `semester` varchar(1) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `level` varchar(255) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `desc` varchar(255) NOT NULL,
  `by` int(11) DEFAULT NULL,
  `nd_for` int(11) DEFAULT NULL,
  `nd_date` datetime DEFAULT NULL,
  `nd_reason` varchar(255) DEFAULT NULL,
  `complain_date` datetime DEFAULT NULL,
  `complain_reason` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `alasan_reject` text DEFAULT NULL,
  `release_at` datetime DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `reject_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rule` varchar(255) DEFAULT NULL,
  `app_hrd_at` datetime DEFAULT NULL,
  `app_emp_at` datetime DEFAULT NULL,
  `app_man_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table spts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `spts`;

CREATE TABLE `spts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table sub_depts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sub_depts`;

CREATE TABLE `sub_depts` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `department_id` smallint(6) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table temp_disciplines
# ------------------------------------------------------------

DROP TABLE IF EXISTS `temp_disciplines`;

CREATE TABLE `temp_disciplines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `employe_id` bigint(20) NOT NULL,
  `date` date DEFAULT NULL,
  `bulan` varchar(2) DEFAULT NULL,
  `tahun` varchar(4) DEFAULT NULL,
  `alpa` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `ijin` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `terlambat` tinyint(3) unsigned NOT NULL DEFAULT 0,
  `achievement` tinyint(3) unsigned NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table units
# ------------------------------------------------------------

DROP TABLE IF EXISTS `units`;

CREATE TABLE `units` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
	(1,'Admin','admin@gmail.com',NULL,'2023-09-14 10:16:26','$2y$10$4RBOYXWe9S22N.fHqXR56ugiaVFgQ0zENY2byLdQRy8chm4Kvnrm6',NULL,'2023-09-14 10:16:26','2024-07-03 13:57:45');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
