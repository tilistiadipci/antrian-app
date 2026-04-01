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
DROP TABLE IF EXISTS `calls`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.calls: ~0 rows (approximately)

-- Dumping structure for table antrian_app.channels
DROP TABLE IF EXISTS `channels`;
CREATE TABLE IF NOT EXISTS `channels` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `to_id` int NOT NULL,
  `re_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.channels: ~0 rows (approximately)

-- Dumping structure for table antrian_app.counters
DROP TABLE IF EXISTS `counters`;
CREATE TABLE IF NOT EXISTS `counters` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `idcounter` int NOT NULL,
  `durasi` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dinamic_call` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `call_type` enum('number','text') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'number',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.counters: ~4 rows (approximately)
INSERT INTO `counters` (`id`, `name`, `idcounter`, `durasi`, `created_at`, `updated_at`, `dinamic_call`, `call_type`) VALUES
	(1, 'Teller', 1, '100', '2025-05-21 02:02:31', '2025-05-21 02:02:31', NULL, 'number'),
	(2, 'Loket', 1, '0', '2025-12-15 09:51:18', '2025-12-15 09:51:18', NULL, 'number'),
	(3, 'Loket', 0, '0', '2025-12-17 03:07:55', '2025-12-17 03:07:55', 'Loket-Pendaftaran.mp3', 'text'),
	(4, 'Loket', 0, '0', '2025-12-17 03:31:33', '2025-12-17 03:31:33', 'Poli-Kandungan.mp3', 'text');

-- Dumping structure for table antrian_app.departments
DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `letter` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `start` int NOT NULL,
  `limit_antrian` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.departments: ~2 rows (approximately)
INSERT INTO `departments` (`id`, `uid`, `name`, `letter`, `start`, `limit_antrian`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'e820f198-342d-477c-9e38-2204649088ac', 'BPJS', 'A', 1, 100, '2025-05-21 02:06:24', '2025-12-15 09:13:26', NULL),
	(3, NULL, 'UMUM', 'B', 1, 100, '2025-12-15 09:13:38', '2025-12-18 05:12:22', NULL);

-- Dumping structure for table antrian_app.guests
DROP TABLE IF EXISTS `guests`;
CREATE TABLE IF NOT EXISTS `guests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `dinas` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `sales_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.guests: ~4 rows (approximately)
INSERT INTO `guests` (`id`, `name`, `no_hp`, `dinas`, `sales_id`, `created_at`, `updated_at`) VALUES
	(1, 'Adi', '082312332132', 'Bio', 22, '2025-07-02 10:51:22', '2025-07-02 10:51:22'),
	(2, 'adi', '082389097065', 'bio ex', 22, '2025-07-08 04:20:00', '2025-07-08 04:20:00'),
	(3, 'Test', '02323232323', 'tst', 22, '2025-07-21 03:32:10', '2025-07-21 03:32:10'),
	(4, 'szxcvxcv', '12121212', 'zxvc', 22, '2025-07-21 03:32:17', '2025-07-21 03:32:17');

-- Dumping structure for table antrian_app.languages
DROP TABLE IF EXISTS `languages`;
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
DROP TABLE IF EXISTS `members`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.members: ~0 rows (approximately)

-- Dumping structure for table antrian_app.messages
DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int unsigned NOT NULL,
  `member_id` int unsigned NOT NULL,
  `message` text CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.messages: ~0 rows (approximately)

-- Dumping structure for table antrian_app.migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.migrations: ~21 rows (approximately)
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
	(14, '2024_07_25_081339_add_column_deleted_at_departement_table', 2),
	(15, '2025_05_20_064737_create_setting_outlets_table', 3),
	(16, '2025_07_02_095056_create_guests_table', 4),
	(17, '2025_07_02_095254_create_sales_table', 4),
	(18, '2025_12_15_163154_create_templates_table', 5),
	(19, '2025_12_15_165555_add_column_dinamic_call_counters_table', 6),
	(20, '2025_12_15_173635_add_column_call_type_counters_table', 7),
	(21, '2025_12_18_120440_add_column_header_kiosk_setting_table', 8);

-- Dumping structure for table antrian_app.mobiles
DROP TABLE IF EXISTS `mobiles`;
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

-- Dumping data for table antrian_app.mobiles: ~1 rows (approximately)
INSERT INTO `mobiles` (`id`, `sliderbg1`, `sliderbg2`, `sliderbg3`, `slider_jdl1`, `slider_jdl2`, `slider_jdl3`, `slider_des1`, `slider_des2`, `slider_des3`, `sdb2_jdl`, `sdb2_des`, `banner1`, `banner2`, `created_at`, `updated_at`) VALUES
	(1, '-', '-', '-', 'Antrian Online', 'Antri dari Rumah', 'Walk-in customer', 'Ruang tunggu lenggan dan nyaman, Pelanggan senang tidak perlu menunggu lama.', 'Mencegah terjadinya penumpukan antrian yang terjadi di ruang tunggu.', 'Tetap bisa melayani pelanggan yang langsung datang ke lokasi (walk-in customer)', 'Antrian Online', 'Antrian Online kini memberikan anda kemudahan untuk melakukan pengambilan antrian secara online.', 'display2.jpg', '-', '2024-02-22 04:23:12', '2025-04-25 01:53:57');

-- Dumping structure for table antrian_app.password_resets
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.password_resets: ~0 rows (approximately)

-- Dumping structure for table antrian_app.queues
DROP TABLE IF EXISTS `queues`;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.queues: ~0 rows (approximately)

-- Dumping structure for table antrian_app.rattings
DROP TABLE IF EXISTS `rattings`;
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

-- Dumping structure for table antrian_app.sales
DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_sales_assigned` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.sales: ~0 rows (approximately)

-- Dumping structure for table antrian_app.settings
DROP TABLE IF EXISTS `settings`;
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
  `header_kiosk` text COLLATE utf8mb3_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `settings_language_id_foreign` (`language_id`),
  CONSTRAINT `settings_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.settings: ~1 rows (approximately)
INSERT INTO `settings` (`id`, `language_id`, `name`, `video`, `video1`, `video2`, `video3`, `video4`, `bus_no`, `address`, `email`, `phone`, `location`, `notification`, `size`, `size_text_tombol`, `size_company`, `size_logo`, `size_logo_print`, `color`, `background_text`, `background_menu`, `background_panel_aa`, `background_panel_ab`, `background_panel_ba`, `background_panel_bb`, `background_panel_ca`, `background_panel_cb`, `background_panel_da`, `background_panel_db`, `color_teks_layanan`, `color_teks_loket`, `color_teks_noangka`, `logo`, `background`, `banner`, `lisensi`, `kode_aktivasi`, `over_time`, `missed_time`, `jam_buka`, `jam_tutup`, `jml_antrian_hari`, `created_at`, `updated_at`, `printer_type`, `port_usb`, `ip_address`, `header_kiosk`) VALUES
	(1, 1, 'ITPlus', '5192322-hd_1280_720_30fps.mp4', '13801121_3840_2160_30fps.mp4', '17310952-uhd_3840_2160_30fps.mp4', '-', '-', '', '', 'admin@bio-experience.com', '', '', 'Selamat Datang di IT Plus pelayanan Kami adalah prioritas Anda ', 25, 26, 24, 200, 150, '#f1f1f1', '#00a7df', '#b70000', '#06befb', '#043546', '#272728', 'rgba(55,55,55,0)', '#272728', '#373636', '#06befb', '#043546', '#ffffff', '#0094c6', '#0094c6', 'Logo-IT-Plus-350x100-1.png', '656011_website-backgrounds-white-blue_1322x936_h.jpg', '-', '20-23-4C-92-78-5D', 'TXpZd1pqaGlNbUprT1RNNVpXWTJOVFppWmpjNFptSmlNbVkyWXpVMk9UVTROVFprWlRKbE5nPT0=', 20, 20, '06:00:00', '23:59:00', 1, '2024-02-22 04:23:12', '2025-12-18 05:11:42', 'USB', 'TM-T82', '192.168.100.165', 'PEMERINTAH KOTA MEDAN DINAS KESEHATAN');

-- Dumping structure for table antrian_app.templates
DROP TABLE IF EXISTS `templates`;
CREATE TABLE IF NOT EXISTS `templates` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb3_unicode_ci NOT NULL,
  `content` json DEFAULT NULL,
  `department_ids` json DEFAULT NULL,
  `counter_ids` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.templates: ~1 rows (approximately)
INSERT INTO `templates` (`id`, `name`, `content`, `department_ids`, `counter_ids`, `created_at`, `updated_at`) VALUES
	(1, 'Template Display 1', '{"title": "PUSKESMAS JAKARTA BARAT", "size_logo": "30", "text_footer": "Selamat Datang di Puskesmas Jakarta Barat - Mohon menunggu antrian anda selanjutnya dengan tertib", "queue_font_size": "60", "title_font_size": "26", "footer_font_size": "32", "queue_text_color": "#ffffff", "footer_text_color": "#ffffff", "header_text_color": "#ffffff", "service_font_size": "50", "service_text_color": "#ffffff", "header_date_text_color": "#ffffff", "queue_active_font_size": "105", "queue_background_color": "#2750b0", "footer_background_color": "#04d29f", "header_background_color": "#04d29f", "queue_active_text_color": "#e68a00", "service_background_color_1": "#2750b0", "service_background_color_2": "#2750b0"}', '["1", "3"]', '["3", "4"]', '2025-12-17 04:41:29', '2025-12-18 05:55:22');

-- Dumping structure for table antrian_app.users
DROP TABLE IF EXISTS `users`;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- Dumping data for table antrian_app.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `password`, `remember_token`, `departments`, `counter`, `testi_sangat_puas`, `testi_puas`, `testi_cukup_puas`, `testi_tidak_puas`, `created_at`, `updated_at`) VALUES
	(1, 'Admin', 'admin', 'admin@mail.com', 'A', '$2y$10$MltzZgfKF0/nFwxIh1OLsuqqPlA9n.qen2bIu9FcOR7Upvlpb5Nou', 'RzMSq5aE0LljCDJoFqMlSmXhoXzK6yYr4lT7g8rLDPAkBoR24JLrRgsWe18U', 0, 0, 0, 0, 0, 0, '2024-02-22 04:23:12', '2024-05-24 01:58:40'),
	(11, 'staff1', 'staff1', 'staff1@gmail.com', 'S', '$2y$10$SDNq5FsaacFpfW1tAyoqWuR7O1zcMQLjYxRpbNjNhRCbU7eZy1Tvm', NULL, 1, 2, 0, 0, 0, 0, '2025-12-17 10:36:47', '2025-12-17 10:36:47'),
	(12, 'Ardi', 'Tilistiadi', 'jordinnolaga@gmail.com', 'S', '$2y$10$JIkkbVRoT.3IGM82ymlY3.2h3ExRSfrMDqtlWk/VcdQPjLaDGHNzy', NULL, 1, 2, 0, 0, 0, 0, '2025-12-23 06:36:10', '2025-12-23 06:36:10');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
