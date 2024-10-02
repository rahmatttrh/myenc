-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 29, 2023 at 03:38 PM
-- Server version: 8.0.34-0ubuntu0.20.04.1
-- PHP Version: 8.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myenc`
--

-- --------------------------------------------------------

--
-- Table structure for table `compositions`
--

CREATE TABLE `compositions` (
  `id` bigint UNSIGNED NOT NULL,
  `bisnis_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departemen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_dept` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golongan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ideal` int DEFAULT '0',
  `fulfillment` int DEFAULT '0',
  `vacant` int DEFAULT '0',
  `report_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `compositions`
--

INSERT INTO `compositions` (`id`, `bisnis_unit`, `departemen`, `sub_dept`, `level`, `golongan`, `jabatan`, `ideal`, `fulfillment`, `vacant`, `report_to`, `created_at`, `updated_at`) VALUES
(1, 'Ekajaya ', 'General Service', 'HK & OB', 'Staff', '1', 'Office Boy ', 12, 7, 5, 'Team Leader HK & OB', NULL, NULL),
(2, 'Ekajaya ', 'General Service', 'HK & OB', 'Staff', '1', 'Housekeeping', 14, 6, 8, 'Team Leader HK & OB', NULL, NULL),
(3, 'Ekanuri', 'Finance', 'GA', 'Staff', '1', 'Security', 1, 1, 0, 'Finance & GA Manager', NULL, NULL),
(4, 'Ekanuri', 'Finance', 'GA', 'Staff', '1', 'Receptionist', 1, 1, 0, 'Finance & GA Manager', NULL, NULL),
(5, 'Ekanuri', 'General Service', 'HK & OB', 'Staff', '1', 'Housekeeping', 1, 1, 0, 'Team Leader HK & OB', NULL, NULL),
(6, 'Ekanuri', 'Operation', 'Operation', 'Staff', '1', 'Support Operation', 1, 1, 0, 'Supervisor Operation', NULL, NULL),
(7, 'Ekanuri', 'Operation', 'Operation', 'Staff', '1', 'Support General Service', 1, 1, 0, 'Team Leader Operation', NULL, NULL),
(8, 'Ekanuri', 'Operation', 'Operation-Petrogas', 'Staff', '1', 'Helper', 1, 1, 0, 'Team Leader Operation', NULL, NULL),
(9, 'Ekanuri', 'Operation', 'Operation-Star Energy', 'Staff', '1', 'Helper', 1, 1, 0, 'Team Leader Operation', NULL, NULL),
(10, 'Ekanuri', 'General Service', 'HK & OB', 'Staff', '2', 'Foreman Housekeeping', 1, 1, 0, 'Team Leader HK & OB', NULL, NULL),
(11, 'Ekanuri', 'Operation', 'Operation-Petrogas', 'Staff', '2', 'Material Man', 1, 1, 0, 'Team Leader Operation', NULL, NULL),
(12, 'Ekanuri', 'General Service', 'Electrical', 'Team Leader', '3', 'Team Leader Electrician', 1, 1, 0, 'Supervisor GS-Electrical', NULL, NULL),
(13, 'Ekanuri', 'General Service', 'HK & OB', 'Team Leader', '3', 'Team Leader HK & OB', 1, 1, 0, 'Supervisor Civil, HK&OB', NULL, NULL),
(14, 'Ekanuri', 'General Service', 'Civil', 'Team Leader', '3', 'Team Leader Civil', 1, 1, 0, 'Supervisor Civil, HK&OB', NULL, NULL),
(15, 'Ekanuri', 'Operation', 'Operation', 'Team Leader', '3', 'Team Leader Port Control', 1, 1, 0, 'Shorebase Manager/Operation Asst. Manager', NULL, NULL),
(16, 'Ekanuri', 'General Service', 'Electrical', 'Supervisor', '4', 'Supervisor GS-Electrical', 1, 1, 0, 'Shorebase Manager', NULL, NULL),
(17, 'Ekanuri', 'General Service', 'Civil, HK & OB', 'Supervisor', '4', 'Civil Engineer', 1, 1, 0, 'Shorebase Manager', NULL, NULL),
(18, 'Ekanuri', 'General Service', 'Civil, HK & OB', 'Supervisor', '4', 'Supervisor Civil, HK&OB', 1, 1, 0, 'Shorebase Manager', NULL, NULL),
(19, 'Ekanuri', 'IT', 'IT', 'Supervisor', '4', 'Supervisor IT', 1, 1, 0, 'Head IT', NULL, NULL),
(20, 'Ekanuri', 'Maintenance', 'Maintenance', 'Supervisor', '4', 'Supervisor Mekanik', 1, 1, 0, 'Shorebase Manager', NULL, NULL),
(21, 'Ekanuri', 'Operation', 'Operation', 'Asst. Manager', '5', 'Operation Asst. Manager', 1, 1, 0, 'Shorebase Manager', NULL, NULL),
(22, 'Ekanuri', 'IT', 'IT', 'Manager', '5', 'Head IT', 1, 1, 0, 'Direktur', NULL, NULL),
(23, 'Ekanuri', 'Operation', 'Operation', 'Manager', '6', 'Shorebase Manager', 1, 1, 0, 'Direktur', NULL, NULL),
(24, 'Ekanuri', 'Operation', 'Operation', 'Staff', '1', 'Saraline', 1, 0, 1, 'Team Leader Operation', NULL, NULL),
(25, 'Ekanuri', 'General Service', 'HK & OB', 'Staff', '2', 'Foreman Office Boy', 1, 0, 1, 'Team Leader HK & OB', NULL, NULL),
(26, 'Ekanuri', 'General Service', 'Electrical', 'Team Leader', '3', 'Team Leader AC', 1, 0, 1, 'Supervisor GS-Electrical', NULL, NULL),
(27, 'Ekanuri', 'General Service', 'Electrical', 'Team Leader', '3', 'Team Leader Welder ', 1, 0, 1, 'Supervisor GS-Electrical', NULL, NULL),
(28, 'Ekanuri', 'Finance', 'GA', 'Staff', '1', 'Office Boy ', 2, 2, 0, 'Finance & GA Manager', NULL, NULL),
(29, 'Ekanuri', 'General Service', 'Electrical', 'Staff', '1', 'Helper AC', 2, 2, 0, 'Team Leader AC', NULL, NULL),
(30, 'Ekanuri', 'General Service', 'Electrical', 'Staff', '1', 'Helper Electrician', 2, 2, 0, 'Team Leader Electrician', NULL, NULL),
(31, 'Ekanuri', 'General Service', 'HK & OB', 'Staff', '1', 'Office Boy ', 2, 2, 0, 'Team Leader HK & OB', NULL, NULL),
(32, 'Ekanuri', 'IT', 'IT', 'Staff', '1', 'Admin IT', 2, 2, 0, 'Supervisor IT', NULL, NULL),
(33, 'Ekanuri', 'Operation', 'Operation-PO', 'Staff', '1', 'Helper', 2, 2, 0, 'Team Leader Operation', NULL, NULL),
(34, 'Ekanuri', 'Finance', 'Cashier', 'Staff', '2', 'Cashier', 2, 2, 0, 'Finance & GA Manager', NULL, NULL),
(35, 'Ekanuri', 'IT', 'IT', 'Staff', '2', 'IT Development', 2, 2, 0, 'Supervisor IT', NULL, NULL),
(36, 'Ekanuri', 'Operation', 'Operation', 'Supervisor', '4', 'Supervisor Operation', 2, 2, 0, 'Shorebase Manager/Operation Asst. Manager', NULL, NULL),
(37, 'Ekanuri', 'Maintenance', 'Maintenance', 'Staff', '2', 'Mekanik', 3, 2, 1, 'Supervisor Mekanik', NULL, NULL),
(38, 'Ekanuri', 'Operation', 'Operation', 'Staff', '2', 'Foreman Operation', 3, 2, 1, 'Team Leader Operation', NULL, NULL),
(39, 'Ekanuri', 'General Service', 'Electrical', 'Staff', '1', 'Teknisi AC', 3, 3, 0, 'Team Leader AC', NULL, NULL),
(40, 'Ekanuri', 'General Service', 'Electrical', 'Staff', '1', 'Welder', 3, 3, 0, 'Team Leader Welder ', NULL, NULL),
(41, 'Ekanuri', 'General Service', 'Electrical', 'Staff', '1', 'Helper Welder', 3, 3, 0, 'Team Leader Welder ', NULL, NULL),
(42, 'Ekanuri', 'Operation', 'Operation', 'Staff', '2', 'Port Control', 3, 3, 0, 'Team Leader Port Control', NULL, NULL),
(43, 'Ekanuri', 'Operation', 'Operation-Medco', 'Staff', '2', 'Material Man', 3, 3, 0, 'Team Leader Operation', NULL, NULL),
(44, 'Ekanuri', 'Maintenance', 'Maintenance', 'Staff', '1', 'Helper Mekanik', 3, 4, 0, 'Supervisor Mekanik', NULL, NULL),
(45, 'Ekanuri', 'Operation', 'Operation', 'Team Leader', '3', 'Team Leader Operation', 4, 2, 2, 'Supervisor Operation', NULL, NULL),
(46, 'Ekanuri', 'General Service', 'Electrical', 'Staff', '1', 'Electrician', 4, 4, 0, 'Team Leader Electrician', NULL, NULL),
(47, 'Ekanuri', 'Operation', 'Operation', 'Staff', '1', 'Admin Operation', 5, 5, 0, 'Supervisor Operation', NULL, NULL),
(48, 'Ekanuri', 'IT', 'IT', 'Staff', '2', 'IT Hardware', 5, 5, 0, 'Supervisor IT', NULL, NULL),
(49, 'Ekanuri', 'Finance', 'GA', 'Staff', '1', 'Messenger', 6, 6, 0, 'Finance & GA Manager', NULL, NULL),
(50, 'Ekanuri', 'Operation', 'Operation', 'Staff', '1', 'Driver', 7, 7, 0, 'Team Leader Operation', NULL, NULL),
(51, 'Ekanuri', 'General Service', 'Civil', 'Staff', '1', 'Civil ', 9, 8, 1, 'Team Leader Civil', NULL, NULL),
(52, 'Ekanuri', 'Operation', 'Operation', 'Staff', '2', 'Operator Crane', 10, 10, 0, 'Team Leader Operation', NULL, NULL),
(53, 'Ekanuri', 'Operation', 'Operation', 'Staff', '2', 'Checker', 11, 11, 0, 'Team Leader Operation', NULL, NULL),
(54, 'Ekanuri', 'Operation', 'Operation', 'Staff', '2', 'Operator Forklift', 18, 18, 0, 'Team Leader Operation', NULL, NULL),
(55, 'Ekanuri Anugrah', 'Operation', 'Operation', 'Staff', '1', 'Rigger', 53, 55, 0, 'Team Leader Operation', NULL, NULL),
(56, 'KCI', 'QHSSE', 'QHSE', 'Team Leader', '3', 'Team Leader QHSE', 1, 1, 0, 'Supervisor QHSE', NULL, NULL),
(57, 'KCI', 'QHSSE', 'QHSE', 'Staff', '2', 'QHSE Inspector', 3, 3, 0, 'Team Leader QHSE', NULL, NULL),
(58, 'Peip Perkasa', 'HRD', 'HRD', 'Staff', '2', 'HR Payroll', 1, 1, 0, 'Supervisor HR', NULL, NULL),
(59, 'Peip Perkasa', 'HRD', 'HRD', 'Staff', '2', 'HR Recruitment ', 1, 1, 0, 'Supervisor HR', NULL, NULL),
(60, 'Peip Perkasa', 'HRD', 'HRD', 'Staff', '2', 'HR Services', 1, 1, 0, 'Supervisor HR', NULL, NULL),
(61, 'Peip Perkasa', 'HRD', 'HRD', 'Staff', '2', 'HR Training', 1, 1, 0, 'Supervisor HR', NULL, NULL),
(62, 'Peip Perkasa', 'QHSSE', 'QHSE', 'Staff', '2', 'QHSE Admin & Secretary MR', 1, 1, 0, 'QHSSE Manager/QHSE Asst. Manager', NULL, NULL),
(63, 'Peip Perkasa', 'Finance', 'Tax', 'Team Leader', '3', 'Team Leader Tax', 1, 1, 0, 'Supervisor Tax', NULL, NULL),
(64, 'Peip Perkasa', 'Finance', 'Accounting', 'Team Leader', '3', 'Team Leader Accounting', 1, 1, 0, 'Supervisor Accounting', NULL, NULL),
(65, 'Peip Perkasa', 'QHSSE', 'QHSE', 'Team Leader', '3', 'Team Leader QHSE', 1, 1, 0, 'Supervisor QHSE', NULL, NULL),
(66, 'Peip Perkasa', 'Finance', 'Procurement', 'Supervisor', '4', 'Supervisor Procurement', 1, 1, 0, 'Finance & GA Manager', NULL, NULL),
(67, 'Peip Perkasa', 'Finance', 'Budgeting', 'Supervisor', '4', 'Supervisor Budgeting', 1, 1, 0, 'Finance & GA Manager', NULL, NULL),
(68, 'Peip Perkasa', 'HRD', 'HRD', 'Supervisor', '4', 'Supervisor HR', 1, 1, 0, 'HRD Manager', NULL, NULL),
(69, 'Peip Perkasa', 'QHSSE', 'Security', 'Supervisor', '4', 'Supervisor Security', 1, 1, 0, 'QHSSE Manager', NULL, NULL),
(70, 'Peip Perkasa', 'Finance', 'Tax', 'Asst. Manager', '5', 'Tax Asst. Manager', 1, 1, 0, 'Accounting Tax Manager', NULL, NULL),
(71, 'Peip Perkasa', 'Finance', 'Accounting', 'Asst. Manager', '5', 'Accounting Tax Asst. Manager', 1, 1, 0, 'Accounting Tax Manager', NULL, NULL),
(72, 'Peip Perkasa', 'QHSSE', 'QHSSE', 'Asst. Manager', '5', 'QHSE Asst. Manager', 1, 1, 0, 'QHSSE Manager', NULL, NULL),
(73, 'Peip Perkasa', 'Finance', 'Finance', 'Manager', '6', 'Finance & GA Manager', 1, 1, 0, 'GM Finance', NULL, NULL),
(74, 'Peip Perkasa', 'Finance', 'Accounting', 'Manager', '6', 'Accounting Tax Manager', 1, 1, 0, 'GM Finance', NULL, NULL),
(75, 'Peip Perkasa', 'HRD', 'HRD', 'Manager', '6', 'HRD Manager', 1, 1, 0, 'Direktur', NULL, NULL),
(76, 'Peip Perkasa', 'QHSSE', 'QHSSE', 'Manager', '6', 'QHSSE Manager', 1, 1, 0, 'Direktur', NULL, NULL),
(77, 'Peip Perkasa', 'Finance', 'Finance', 'GM', '7', 'GM Finance & Accounting', 1, 1, 0, 'Direktur', NULL, NULL),
(78, 'Peip Perkasa', 'Finance', 'Procurement', 'Staff', '1', 'Admin Procurement', 1, 0, 1, 'Supervisor Procurement', NULL, NULL),
(79, 'Peip Perkasa', 'QHSSE', 'Security', 'Staff', '2', 'Deputi PFSO ', 1, 0, 1, 'QHSSE Manager', NULL, NULL),
(80, 'Peip Perkasa', 'Finance', 'Cashier', 'Team Leader', '3', 'Team Leader Cashier', 1, 0, 1, 'Finance & GA Manager', NULL, NULL),
(81, 'Peip Perkasa', 'Finance', 'AR', 'Team Leader', '3', 'Team Leader AR', 1, 0, 1, 'Supervisor AR', NULL, NULL),
(82, 'Peip Perkasa', 'Finance', 'Budgeting', 'Team Leader', '3', 'Team Leader Budgeting', 1, 0, 1, 'Supervisor Budgeting', NULL, NULL),
(83, 'Peip Perkasa', 'Finance', 'Cashier', 'Supervisor', '4', 'Supervisor Cashier', 1, 0, 1, 'Finance & GA Manager', NULL, NULL),
(84, 'Peip Perkasa', 'Finance', 'AR', 'Supervisor', '4', 'Supervisor AR', 1, 0, 1, 'Finance & GA Manager', NULL, NULL),
(85, 'Peip Perkasa', 'Finance', 'Tax', 'Supervisor', '4', 'Supervisor Tax', 1, 0, 1, 'Accounting Tax Manager/Tax Asst. Manager', NULL, NULL),
(86, 'Peip Perkasa', 'Finance', 'Accounting', 'Supervisor', '4', 'Supervisor Accounting', 1, 0, 1, 'Accounting Tax Manager/Accounting Tax Asst. Manager', NULL, NULL),
(87, 'Peip Perkasa', 'QHSSE', 'QHSE', 'Supervisor', '4', 'Supervisor QHSE', 1, 0, 1, 'QHSSE Manager/QHSE Asst. Manager', NULL, NULL),
(88, 'Peip Perkasa', 'HRD', 'HRD', 'Staff', '2', 'HR Operation', 2, 2, 0, 'Supervisor HR', NULL, NULL),
(89, 'Peip Perkasa', 'Finance', 'Procurement', 'Staff', '1', 'Staff Buyer', 4, 3, 1, 'Supervisor Procurement', NULL, NULL),
(90, 'Peip Perkasa', 'Finance', 'Budgeting', 'Staff', '2', 'Budgeting Officer', 4, 3, 1, 'Team Leader Budgeting', NULL, NULL),
(91, 'Peip Perkasa', 'Finance', 'Tax', 'Staff', '2', 'Tax Officer', 5, 3, 2, 'Team Leader Tax', NULL, NULL),
(92, 'Peip Perkasa', 'Finance', 'AR', 'Staff', '2', 'AR Officer', 5, 4, 1, 'Team Leader AR', NULL, NULL),
(93, 'Peip Perkasa', 'Finance', 'Cashier', 'Staff', '2', 'Cashier', 6, 6, 0, 'Team Leader Cashier', NULL, NULL),
(94, 'Peip Perkasa', 'QHSSE', 'QHSE', 'Staff', '2', 'QHSE Inspector', 7, 4, 3, 'Team Leader QHSE', NULL, NULL),
(95, 'Peip Perkasa', 'Finance', 'Accounting', 'Staff', '2', 'Accounting Officer', 7, 8, 0, 'Team Leader Accounting', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compositions`
--
ALTER TABLE `compositions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compositions`
--
ALTER TABLE `compositions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
