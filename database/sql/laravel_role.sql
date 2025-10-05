-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 05, 2025 at 05:18 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  UNIQUE KEY `admins_username_unique` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@example.com', 'superadmin', NULL, '$2y$12$fwJ0Mjj9.nI3PS3TBuBL0eZui.GqQCxP6CKOpHW1LhvANhhdZmQMC', 'ZBaKU60nOVmKwCqnqfcT2xvfJ41j9hcKOb3rJ2kPtMn6rBd01ASyljBwHFY0', NULL, '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(2, 'ABC', 'admin@gmail.com', 'admin', NULL, '$2y$10$Q1VxCRKz.3sHE/QbEBsmf.TjUy7Ys256NuB6CYU3rzMUUOr4VXJwG', NULL, NULL, '2024-12-23 03:52:49', '2024-12-23 03:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `exam_forms`
--

DROP TABLE IF EXISTS `exam_forms`;
CREATE TABLE IF NOT EXISTS `exam_forms` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `fees` double DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_forms`
--

INSERT INTO `exam_forms` (`id`, `title`, `slug`, `description`, `fees`, `is_active`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'test', 100, 1, NULL, '2025-10-05 03:28:12', '2025-10-05 11:55:20'),
(2, 'test', 'test-1', 'test', 125, 1, NULL, '2025-10-05 03:29:14', '2025-10-05 11:55:25'),
(3, 'test', 'test-2', 'test', 250, 1, NULL, '2025-10-05 03:29:42', '2025-10-05 11:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `form_fields`
--

DROP TABLE IF EXISTS `form_fields`;
CREATE TABLE IF NOT EXISTS `form_fields` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `exam_form_id` bigint UNSIGNED NOT NULL,
  `field_key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('text','select','file','date','number','email','radio','checkbox') COLLATE utf8mb4_unicode_ci NOT NULL,
  `validation_rules` json DEFAULT NULL,
  `options` json DEFAULT NULL,
  `order` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_formfields_examforms` (`exam_form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `form_fields`
--

INSERT INTO `form_fields` (`id`, `exam_form_id`, `field_key`, `label`, `type`, `validation_rules`, `options`, `order`, `created_at`, `updated_at`) VALUES
(1, 3, 'test', 'test', 'text', NULL, NULL, 2, '2025-10-05 04:59:52', '2025-10-05 05:07:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_07_24_184706_create_permission_tables', 1),
(5, '2020_09_12_043205_create_admins_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\Admin', 1),
(4, 'App\\Models\\Admin', 2),
(5, 'App\\Models\\Admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `submission_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `gateway` enum('stripe','razorpay') COLLATE utf8mb4_unicode_ci NOT NULL,
  `gateway_payment_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'INR',
  `status` enum('initiated','succeeded','failed','refunded') COLLATE utf8mb4_unicode_ci DEFAULT 'initiated',
  `raw_response` json DEFAULT NULL,
  `captured_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_payments_submission` (`submission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.view', 'admin', 'dashboard', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(2, 'dashboard.edit', 'admin', 'dashboard', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(38, 'submissions.list', 'admin', 'submissions', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(37, 'form-fields.delete', 'admin', 'form-fields', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(36, 'form-fields.edit', 'admin', 'form-fields', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(8, 'admin.create', 'admin', 'admin', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(9, 'admin.view', 'admin', 'admin', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(10, 'admin.edit', 'admin', 'admin', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(11, 'admin.delete', 'admin', 'admin', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(12, 'admin.approve', 'admin', 'admin', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(13, 'role.create', 'admin', 'role', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(14, 'role.view', 'admin', 'role', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(15, 'role.edit', 'admin', 'role', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(16, 'role.delete', 'admin', 'role', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(17, 'role.approve', 'admin', 'role', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(18, 'profile.view', 'admin', 'profile', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(19, 'profile.edit', 'admin', 'profile', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(35, 'form-fields.view', 'admin', 'form-fields', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(34, 'form-fields.create', 'admin', 'form-fields', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(33, 'exam-forms.delete', 'admin', 'exam-forms', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(32, 'exam-forms.edit', 'admin', 'exam-forms', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(31, 'exam-forms.view', 'admin', 'exam-forms', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(30, 'exam-forms.create', 'admin', 'exam-forms', '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(39, 'submissions.view', 'admin', 'submissions', '2024-12-23 00:11:48', '2024-12-23 00:11:48');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'admin', NULL, '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(4, 'Users', 'admin', NULL, '2024-12-23 04:10:24', '2025-10-05 02:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 4),
(2, 1),
(3, 4),
(4, 4),
(5, 4),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(18, 4),
(19, 1),
(19, 4),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
CREATE TABLE IF NOT EXISTS `submissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `exam_form_id` bigint UNSIGNED NOT NULL,
  `data` json DEFAULT NULL,
  `status` enum('draft','pending_payment','paid','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT 'draft',
  `amount_due` decimal(10,2) DEFAULT '0.00',
  `currency` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT 'INR',
  `reference_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by_admin` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reference_id` (`reference_id`),
  KEY `fk_submissions_examform` (`exam_form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `user_id`, `exam_form_id`, `data`, `status`, `amount_due`, `currency`, `reference_id`, `payment_method`, `pdf_path`, `created_by_admin`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '{\"test\": null}', 'pending_payment', '250.00', 'INR', 'SUB-C1SGORQK', 'razorpay', NULL, 0, '2025-10-05 06:53:20', '2025-10-05 06:53:20'),
(2, 2, 3, '{\"test\": \"test\"}', 'pending_payment', '250.00', 'INR', 'SUB-ID4PCTPO', 'razorpay', NULL, 0, '2025-10-05 07:00:36', '2025-10-05 07:00:36'),
(3, 2, 1, '[]', 'pending_payment', '100.00', 'INR', 'SUB-WDSGRUCI', 'razorpay', NULL, 0, '2025-10-05 09:33:36', '2025-10-05 09:33:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Maniruzzaman Akash', 'manirujjamanakash@gmail.com', NULL, '$2y$10$V0vG2yDc3KqYCZdpwOnhyeS7efSMWRvbR5wiWyYoA8CRRvBxzaeqO', NULL, '2024-12-23 00:11:48', '2024-12-23 00:11:48'),
(2, 'Hemant', 'hemant@gmail.com', NULL, '$2y$10$RxEjc1L/7A4Yd46Y12QKvOIqYKKmVHA98JpoHuNFOv2YWFvrPN7sq', NULL, '2025-10-05 02:26:27', '2025-10-05 02:26:27');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `form_fields`
--
ALTER TABLE `form_fields`
  ADD CONSTRAINT `fk_formfields_examforms` FOREIGN KEY (`exam_form_id`) REFERENCES `exam_forms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_payments_submission` FOREIGN KEY (`submission_id`) REFERENCES `submissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `fk_submissions_examform` FOREIGN KEY (`exam_form_id`) REFERENCES `exam_forms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
