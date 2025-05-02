-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table antrian_app.calls
CREATE TABLE IF NOT EXISTS `calls` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `queue_id` int unsigned NOT NULL,
  `department_id` int unsigned NOT NULL,
  `counter_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `number` int NOT NULL,
  `called_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `calls_queue_id_foreign` (`queue_id`),
  KEY `calls_department_id_foreign` (`department_id`),
  KEY `calls_counter_id_foreign` (`counter_id`),
  KEY `calls_user_id_foreign` (`user_id`),
  CONSTRAINT `calls_counter_id_foreign` FOREIGN KEY (`counter_id`) REFERENCES `counters` (`id`),
  CONSTRAINT `calls_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  CONSTRAINT `calls_queue_id_foreign` FOREIGN KEY (`queue_id`) REFERENCES `queues` (`id`),
  CONSTRAINT `calls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.calls: ~9 rows (approximately)
INSERT INTO `calls` (`id`, `queue_id`, `department_id`, `counter_id`, `user_id`, `number`, `called_date`, `created_at`, `updated_at`) VALUES
	(4, 23, 4, 1, 1, 1, '2025-04-25', '2025-04-25 01:39:00', '2025-04-25 01:39:00'),
	(5, 24, 5, 1, 1, 1, '2025-04-25', '2025-04-25 01:39:29', '2025-04-25 01:39:29'),
	(7, 18, 1, 1, 6, 1, '2025-04-25', '2025-04-25 01:45:24', '2025-04-25 01:45:24'),
	(8, 27, 1, 1, 6, 2, '2025-04-25', '2025-04-25 04:10:18', '2025-04-25 04:10:18'),
	(9, 28, 5, 3, 7, 2, '2025-04-25', '2025-04-25 04:14:21', '2025-04-25 04:14:21'),
	(10, 49, 1, 1, 1, 1, '2025-04-28', '2025-04-27 23:21:42', '2025-04-27 23:21:42'),
	(11, 51, 5, 3, 7, 1, '2025-04-28', '2025-04-27 23:40:35', '2025-04-27 23:40:35'),
	(12, 55, 5, 3, 7, 2, '2025-04-28', '2025-04-27 23:40:43', '2025-04-27 23:40:43'),
	(13, 53, 1, 1, 6, 2, '2025-04-28', '2025-04-27 23:49:43', '2025-04-27 23:49:43');

-- Dumping structure for table antrian_app.channels
CREATE TABLE IF NOT EXISTS `channels` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `to_id` int NOT NULL,
  `re_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.channels: ~2 rows (approximately)
INSERT INTO `channels` (`id`, `to_id`, `re_id`, `created_at`, `updated_at`) VALUES
	(1, 2, 3, '2024-02-22 05:09:26', '2024-02-22 05:09:26'),
	(2, 3, 3, '2024-02-22 05:14:05', '2024-02-22 05:14:05'),
	(3, 3, 5, '2025-04-25 01:14:53', '2025-04-25 01:14:53');

-- Dumping structure for table antrian_app.counters
CREATE TABLE IF NOT EXISTS `counters` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `idcounter` int NOT NULL,
  `durasi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.counters: ~0 rows (approximately)
INSERT INTO `counters` (`id`, `name`, `idcounter`, `durasi`, `created_at`, `updated_at`) VALUES
	(1, 'Loket', 1, '0', '2024-02-22 04:54:13', '2024-02-22 04:54:13'),
	(3, 'Counter', 1, '100', '2025-04-25 04:11:57', '2025-04-25 04:11:57');

-- Dumping structure for table antrian_app.departments
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `letter` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `start` int NOT NULL,
  `limit_antrian` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.departments: ~3 rows (approximately)
INSERT INTO `departments` (`id`, `name`, `letter`, `start`, `limit_antrian`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'A. Poli Anak', 'A', 1, 100, '2024-02-22 04:29:26', '2025-04-25 01:36:10', NULL),
	(4, 'B. BPJS', 'B', 1, 100, '2025-04-25 01:34:49', '2025-04-25 01:34:49', NULL),
	(5, 'C. Poli Gigi', 'C', 1, 100, '2025-04-25 01:35:38', '2025-04-25 01:35:38', NULL);

-- Dumping structure for table antrian_app.languages
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `display` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `languages_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.languages: ~13 rows (approximately)
INSERT INTO `languages` (`id`, `code`, `name`, `display`, `image`, `created_at`, `updated_at`) VALUES
	(1, 'gb', 'English', 'UK English Female', 'United-Kingdom.png', '2024-02-22 04:23:12', '2024-02-22 04:23:12'),
	(2, 'tr', 'Turkish', 'Turkish Female', 'Turkey.png', '2024-02-22 04:23:12', '2024-02-22 04:23:12'),
	(3, 'de', 'German', 'Deutsch Female', 'Germany.png', '2024-02-22 04:23:12', '2024-02-22 04:23:12'),
	(4, 'es', 'Spanish', 'Spanish Female', 'Spain.png', '2024-02-22 04:23:12', '2024-02-22 04:23:12'),
	(5, 'fr', 'French', 'French Female', 'France.png', '2024-02-22 04:23:12', '2024-02-22 04:23:12'),
	(6, 'in', 'Hindi', 'Hindi Female', 'India.png', '2024-02-22 04:23:12', '2024-02-22 04:23:12'),
	(7, 'it', 'Italian', 'Italian Female', 'Italy.png', '2024-02-22 04:23:12', '2024-02-22 04:23:12'),
	(8, 'pt', 'Portuguese', 'Portuguese Female', 'Portugal.png', '2024-02-22 04:23:12', '2024-02-22 04:23:12'),
	(9, 'ru', 'Russian', 'Russian Female', 'Russia.png', '2024-02-22 04:23:12', '2024-02-22 04:23:12'),
	(10, 'sa', 'Arabic', 'Arabic Male', 'Saudi-Arabia.png', '2024-02-22 04:23:12', '2024-02-22 04:23:12'),
	(11, 'sk', 'Slovak', 'Slovak Female', 'Slovakia.png', '2024-02-22 04:23:12', '2024-02-22 04:23:12'),
	(12, 'th', 'Thai', 'Thai Female', 'Thailand.png', '2024-02-22 04:23:12', '2024-02-22 04:23:12'),
	(13, 'id', 'Indonesian', 'Indonesian Female', 'Indonesia.png', '2024-02-22 04:23:12', '2024-02-22 04:23:12');

-- Dumping structure for table antrian_app.members
CREATE TABLE IF NOT EXISTS `members` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `telp` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `members_username_unique` (`username`),
  UNIQUE KEY `members_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.members: ~6 rows (approximately)
INSERT INTO `members` (`id`, `name`, `username`, `email`, `alamat`, `telp`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'User', 'user', 'user@mail.com', '-', '-', 'U', '$2y$10$UQyZkBEZHlbA.ZmUig/sye15rlzB8QzvwNJeOvMdzQK/mzvxAV2KW', NULL, '2024-02-22 04:23:12', '2024-02-22 04:23:12'),
	(2, 'Kahfi Ariep Akbar', 'kahfiariepakbar', 'kahfi.ariepakbar@gmail.com', '', '081296647426', 'U', '$2y$10$Oz25aOTlk/CND6YKNDTO6u6T723voQbnPOLxEHpTlrhW2DR72XKSW', 'sqUKddYwXfGCRhVMAz8gNLVFgC65GwPnM0bieuATL0a0QfEAYUwFNaUC1ZSF', '2024-02-22 05:02:37', '2024-02-22 05:05:06'),
	(3, 'User Antrian', 'username', 'user.antrian@gmail.com', '', '089630236580', 'U', '$2y$10$I3ls3PWA1zyGUMVMiPoUl.CN5irZfoYIG4PbNY44aoe3RjAnbtUDq', 'aKJxbjSrT3kYZPpA68G3Wmh15UnI78MbWAMtJ8gqVIhojwpIdPc14I5BYcUT', '2024-02-22 05:06:08', '2024-05-24 01:58:19'),
	(4, 'Nama', 'test01', 'tmperdana157@gmail.com', '', '081911847152', 'U', '$2y$10$Il6WYZJWQRLVx5GDcHBjwOJ4CywPY8f/kJj9B.wGmfV6GV82kJKhO', NULL, '2024-05-24 02:05:52', '2024-05-24 02:05:52'),
	(5, 'Dev 1', 'dev1234', 'tilistiadipci@gmail.com', '', '13232323232', 'U', '$2y$10$DcLmnSPemyJc/eIJMjIXxu5V0XP9WYPejW3TofW3uDeogd4GmpUgm', 'RqF138oyxMlZDZDeziWhrDhgQGMoMuEGdRo9JzjTwX4OJQHG3X6rJywX9NyT', '2025-04-25 01:12:35', '2025-04-25 01:12:35'),
	(6, 'dev2345', 'dev2345', 'dev2345@gmail.com', '', '222222222', 'U', '$2y$10$VzVqSQ2pbQYGuDAkMkoBKuzNGEddV8Sye5DBZNBDElDpRfq6B4XSC', NULL, '2025-04-25 04:08:56', '2025-04-25 04:08:56');

-- Dumping structure for table antrian_app.messages
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int unsigned NOT NULL,
  `member_id` int unsigned NOT NULL,
  `message` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.messages: ~4 rows (approximately)
INSERT INTO `messages` (`id`, `admin_id`, `member_id`, `message`, `type`, `created_at`, `updated_at`) VALUES
	(1, 2, 3, 'halo bang', 'outgoing', '2024-02-22 05:09:30', '2024-02-22 05:09:30'),
	(2, 3, 3, 'halo bang', 'outgoing', '2024-02-22 05:14:12', '2024-02-22 05:14:12'),
	(3, 3, 3, 'bang, kapan saya dipanggil?', 'outgoing', '2024-02-22 05:55:34', '2024-02-22 05:55:34'),
	(4, 3, 3, 'mohon ditunggu', '', '2024-02-22 06:10:09', '2024-02-22 06:10:09');

-- Dumping structure for table antrian_app.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.migrations: ~14 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2016_07_16_161740_create_departments_table', 1),
	(4, '2016_07_16_180929_create_counters_table', 1),
	(5, '2016_07_16_190715_create_queues_table', 1),
	(6, '2016_07_19_170334_create_calls_table', 1),
	(7, '2016_08_24_231859_create_languages_table', 1),
	(8, '2016_09_28_123908_create_settings_table', 1),
	(9, '2017_02_11_202037_create_rattings_table', 1),
	(10, '2017_02_11_202057_create_messages_table', 1),
	(11, '2019_10_12_000000_create_members_table', 1),
	(12, '2021_02_11_202057_create_channels_table', 1),
	(13, '2021_09_28_123404_create_mobiles_table', 1),
	(14, '2024_07_25_081339_add_column_deleted_at_departement_table', 2);

-- Dumping structure for table antrian_app.mobiles
CREATE TABLE IF NOT EXISTS `mobiles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `sliderbg1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sliderbg2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sliderbg3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slider_jdl1` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slider_jdl2` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slider_jdl3` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slider_des1` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slider_des2` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `slider_des3` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sdb2_jdl` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `sdb2_des` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `banner1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `banner2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.mobiles: ~0 rows (approximately)
INSERT INTO `mobiles` (`id`, `sliderbg1`, `sliderbg2`, `sliderbg3`, `slider_jdl1`, `slider_jdl2`, `slider_jdl3`, `slider_des1`, `slider_des2`, `slider_des3`, `sdb2_jdl`, `sdb2_des`, `banner1`, `banner2`, `created_at`, `updated_at`) VALUES
	(1, '-', '-', '-', 'Antrian Online', 'Antri dari Rumah', 'Walk-in customer', 'Ruang tunggu lenggan dan nyaman, Pelanggan senang tidak perlu menunggu lama.', 'Mencegah terjadinya penumpukan antrian yang terjadi di ruang tunggu.', 'Tetap bisa melayani pelanggan yang langsung datang ke lokasi (walk-in customer)', 'Antrian Online', 'Antrian Online kini memberikan anda kemudahan untuk melakukan pengambilan antrian secara online.', 'display2.jpg', '-', '2024-02-22 04:23:12', '2025-04-25 01:53:57');

-- Dumping structure for table antrian_app.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.password_resets: ~0 rows (approximately)

-- Dumping structure for table antrian_app.queues
CREATE TABLE IF NOT EXISTS `queues` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `department_id` int unsigned NOT NULL,
  `number` int NOT NULL,
  `called` int NOT NULL,
  `id_member` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `queues_department_id_foreign` (`department_id`),
  CONSTRAINT `queues_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.queues: ~17 rows (approximately)
INSERT INTO `queues` (`id`, `department_id`, `number`, `called`, `id_member`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 0, 0, '2024-07-25 01:25:41', '2024-07-25 01:25:41'),
	(2, 1, 1, 0, 0, '2024-07-29 21:02:47', '2024-07-29 21:02:47'),
	(3, 1, 2, 0, 0, '2024-07-29 21:03:11', '2024-07-29 21:03:11'),
	(16, 1, 3, 0, 0, '2024-07-29 21:31:35', '2024-07-29 21:31:35'),
	(17, 1, 4, 0, 0, '2024-07-29 21:31:37', '2024-07-29 21:31:37'),
	(18, 1, 1, 1, 5, '2025-04-25 01:13:02', '2025-04-25 01:25:27'),
	(23, 4, 1, 1, 5, '2025-04-25 01:38:24', '2025-04-25 01:39:00'),
	(24, 5, 1, 1, 5, '2025-04-25 01:38:31', '2025-04-25 01:39:29'),
	(27, 1, 2, 1, 6, '2025-04-25 04:09:06', '2025-04-25 04:10:18'),
	(28, 5, 2, 1, 6, '2025-04-25 04:14:08', '2025-04-25 04:14:21'),
	(49, 1, 1, 1, 0, '2025-04-27 23:08:44', '2025-04-27 23:21:42'),
	(50, 4, 1, 0, 0, '2025-04-27 23:09:09', '2025-04-27 23:09:09'),
	(51, 5, 1, 1, 0, '2025-04-27 23:12:04', '2025-04-27 23:40:35'),
	(52, 4, 2, 0, 0, '2025-04-27 23:17:39', '2025-04-27 23:17:39'),
	(53, 1, 2, 1, 5, '2025-04-27 23:38:54', '2025-04-27 23:49:43'),
	(54, 4, 3, 0, 5, '2025-04-27 23:39:22', '2025-04-27 23:39:22'),
	(55, 5, 2, 1, 5, '2025-04-27 23:39:32', '2025-04-27 23:40:43'),
	(56, 5, 3, 0, 5, '2025-04-28 03:40:19', '2025-04-28 03:40:19');

-- Dumping structure for table antrian_app.rattings
CREATE TABLE IF NOT EXISTS `rattings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `pelanggan_id` int unsigned NOT NULL,
  `nomor` int unsigned NOT NULL,
  `bintang` int unsigned NOT NULL,
  `message` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `loket` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.rattings: ~0 rows (approximately)

-- Dumping structure for table antrian_app.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `video` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `video1` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `video2` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `video3` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `video4` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `bus_no` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `notification` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `size` int NOT NULL,
  `size_text_tombol` int NOT NULL,
  `size_company` int NOT NULL,
  `size_logo` int NOT NULL,
  `size_logo_print` int NOT NULL,
  `color` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `background_text` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `background_menu` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `background_panel_aa` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `background_panel_ab` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `background_panel_ba` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `background_panel_bb` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `background_panel_ca` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `background_panel_cb` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `background_panel_da` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `background_panel_db` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `color_teks_layanan` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `color_teks_loket` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `color_teks_noangka` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `background` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `banner` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `lisensi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `kode_aktivasi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `over_time` int NOT NULL,
  `missed_time` int NOT NULL,
  `jam_buka` time NOT NULL,
  `jam_tutup` time NOT NULL,
  `jml_antrian_hari` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `printer_type` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `port_usb` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `ip_address` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `settings_language_id_foreign` (`language_id`),
  CONSTRAINT `settings_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.settings: ~0 rows (approximately)
INSERT INTO `settings` (`id`, `language_id`, `name`, `video`, `video1`, `video2`, `video3`, `video4`, `bus_no`, `address`, `email`, `phone`, `location`, `notification`, `size`, `size_text_tombol`, `size_company`, `size_logo`, `size_logo_print`, `color`, `background_text`, `background_menu`, `background_panel_aa`, `background_panel_ab`, `background_panel_ba`, `background_panel_bb`, `background_panel_ca`, `background_panel_cb`, `background_panel_da`, `background_panel_db`, `color_teks_layanan`, `color_teks_loket`, `color_teks_noangka`, `logo`, `background`, `banner`, `lisensi`, `kode_aktivasi`, `over_time`, `missed_time`, `jam_buka`, `jam_tutup`, `jml_antrian_hari`, `created_at`, `updated_at`, `printer_type`, `port_usb`, `ip_address`) VALUES
	(1, 1, 'ITPlus', 'List Booking Meeting.mp4', 'Pantry Pama - Order List.mp4', 'Hari Raya Idul Fitri.MOV', '-', '-', '', '', 'admin@bio-experience.com', '', '', 'Selamat Datang di Showroom PROAV pelayanan Kami adalah prioritas Anda ', 25, 26, 24, 200, 150, '#f1f1f1', '#00a7df', '#b70000', '#06befb', '#043546', '#272728', 'rgba(55,55,55,0)', '#272728', '#373636', '#06befb', '#043546', '#ffffff', '#0094c6', '#0094c6', 'circle-png-44658.png', '656011_website-backgrounds-white-blue_1322x936_h.jpg', '-', '20-23-4C-92-78-5D', 'TXpZd1pqaGlNbUprT1RNNVpXWTJOVFppWmpjNFptSmlNbVkyWXpVMk9UVTROVFprWlRKbE5nPT0=', 20, 20, '06:00:00', '23:59:00', 1, '2024-02-22 04:23:12', '2025-04-25 03:44:15', 'USB', 'TM-T82', '192.168.100.165');

-- Dumping structure for table antrian_app.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `departments` int NOT NULL,
  `counter` int NOT NULL,
  `testi_sangat_puas` int NOT NULL,
  `testi_puas` int NOT NULL,
  `testi_cukup_puas` int NOT NULL,
  `testi_tidak_puas` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.users: ~4 rows (approximately)
INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `password`, `remember_token`, `departments`, `counter`, `testi_sangat_puas`, `testi_puas`, `testi_cukup_puas`, `testi_tidak_puas`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin', 'admin@mail.com', 'A', '$2y$10$3psz/R7JME9zjT0piQKCIeWCr.FAfyUygm3VpQmgy8z3HVqxmxSQK', 'xHD8EsEjFypX5SvFWQIEiDHpeRkvpeAtvgJVEUV2PLWtiOscp0OphnEHZ9wx', 0, 0, 0, 0, 0, 0, '2024-02-22 04:23:12', '2024-05-24 01:58:40'),
	(3, 'Kahfi', 'teknisi', 'kahfi@thesinergy.com', 'C', '$2y$10$QJfTNHddl3M3Ygmmd23z..uxnybmYtHAMbZRkIm/ZvOLsMWCYz6Ou', 'T4Fwg3IvoEKDFT3hiXg0LNaEypWqOSpag1l6xbspPAQKJjYmqP9CEvk51mIL', 1, 1, 0, 0, 0, 0, '2024-02-22 05:13:21', '2024-05-24 00:52:37'),
	(5, 'adit', 'penjaga loket', 'adityaworkplay7@gmail.com', 'S', '$2y$10$uJ87AXE6A2uSraEQShGj0OOrMo2xNC8sjcYUNntRyKPPMDM0W6fFu', NULL, 2, 1, 0, 0, 0, 0, '2024-05-26 07:43:32', '2024-05-26 07:43:32'),
	(6, 'Caller', 'caller', 'caller@gmail.com', 'S', '$2y$10$doogdl0wr9B3aW.fatLpk.ZYbX1Ya.W7em5zVw7JmgckAA9gQ5JeG', 'u3H6RA1LxjglCQelBH59ZCsOoWqM1G0UeXS7ZxIAg7ubMRAT3IAdGyml3WGi', 1, 1, 0, 0, 0, 0, '2025-04-25 01:24:52', '2025-04-25 01:24:52'),
	(7, 'staff counter', 'staffcounter', 'staffcounter@gmail.com', 'S', '$2y$10$ou8Mtsco4llXfcRZDRuQn.FmZfdk8Mt3izSGxts9wyceEdQRirsXW', 'foABUkJMDzZeZH44wvMj0BefIniW63bZxwzun5oikNccariUhV1UjIUUwqLp', 5, 3, 0, 0, 0, 0, '2025-04-25 04:13:32', '2025-04-25 04:13:32');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
