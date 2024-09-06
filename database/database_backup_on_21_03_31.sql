

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loggedin` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `branches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `discount` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `discount` int(10) unsigned NOT NULL,
  `medicals_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `discounts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `discount` int(10) unsigned DEFAULT '0',
  `trx_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `logged_in_staff` (
  `id` bigint(20) unsigned NOT NULL,
  `staffs_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `medicals` (
  `id` bigint(20) unsigned NOT NULL,
  `trx_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tests_id` int(10) unsigned NOT NULL,
  `branch_id` int(255) NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `patients_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `medicals_patients_id_foreign` (`patients_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `patients` (
  `id` bigint(20) unsigned NOT NULL,
  `pat_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `patient_referral` (
  `id` bigint(20) unsigned NOT NULL,
  `trx_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referred_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `patients_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `patient_referral_patients_id_foreign` (`patients_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `referrals` (
  `id` bigint(20) unsigned NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `selected_test` (
  `id` bigint(20) unsigned NOT NULL,
  `test_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uniqueid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `staff` (
  `id` bigint(20) unsigned NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `staff_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `staff_activities` (
  `id` bigint(20) unsigned NOT NULL,
  `staffs_id` int(10) unsigned NOT NULL,
  `activity` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `tests` (
  `id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loggedin` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO users (`id`, `email`, `email_verified_at`, `password`, `remember_token`, `loggedin`, `created_at`, `updated_at`) VALUES 
('1','chiz','0000-00-00 00:00:00','$2y$10$IMfFt3xn/DD2mFlY8XhMyO/S.7oFJ1vmcPftYduiqhoMmpqx8PBfu','','0','2021-01-27 07:34:28','2021-01-27 07:34:28');

INSERT INTO users (`id`, `email`, `email_verified_at`, `password`, `remember_token`, `loggedin`, `created_at`, `updated_at`) VALUES 
('2','admin','0000-00-00 00:00:00','$2y$10$Qyk0tmTw6JN/DhbdbiC1.e6YwSZP7ZzbPTHYoL3sKCdESHkpruvc.','','1','0000-00-00 00:00:00','2021-03-30 01:59:55');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('1','2014_10_12_000000_create_users_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('2','2019_08_19_000000_create_failed_jobs_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('3','2021_01_22_115523_create_tests_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('4','2021_01_22_210600_create_patients_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('5','2021_01_22_212610_create_staff_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('6','2021_01_23_150152_create_selected_test_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('7','2021_01_24_104524_create_medicals_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('8','2021_01_24_114256_create_selected_patient_referral_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('9','2021_01_24_171116_create_deposits_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('10','2021_02_09_100235_create_referrals_table','2');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('13','2021_02_09_113540_create_logged_in_staff_table','3');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('14','2021_02_09_120008_create_staff_activities_table','3');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('16','2021_02_16_072809_create_discounts_table','5');

INSERT INTO branches (`id`, `name`, `created_at`, `updated_at`) VALUES 
('1','No. 25 Ede oballa 22 3','2021-03-11 18:58:03','2021-03-16 11:16:00');

INSERT INTO branches (`id`, `name`, `created_at`, `updated_at`) VALUES 
('2','No. 10 Isiewu Umagana','2021-03-11 18:58:38','2021-03-11 19:30:49');

INSERT INTO branches (`id`, `name`, `created_at`, `updated_at`) VALUES 
('6','Nsukka phase','2021-03-12 09:37:20','2021-03-12 09:37:20');

INSERT INTO discounts (`id`, `discount`, `trx_id`, `created_at`, `updated_at`) VALUES 
('1','0','602c2742cde2d','2021-02-16 21:12:50','2021-02-16 21:12:50');

INSERT INTO discounts (`id`, `discount`, `trx_id`, `created_at`, `updated_at`) VALUES 
('2','0','6033305b5cf24','2021-02-22 05:17:31','2021-02-22 05:17:31');

INSERT INTO discounts (`id`, `discount`, `trx_id`, `created_at`, `updated_at`) VALUES 
('3','0','603330761802c','2021-02-22 05:17:58','2021-02-22 05:17:58');

INSERT INTO discounts (`id`, `discount`, `trx_id`, `created_at`, `updated_at`) VALUES 
('4','0','603332e0a72a8','2021-02-22 05:28:16','2021-02-22 05:28:16');

INSERT INTO discounts (`id`, `discount`, `trx_id`, `created_at`, `updated_at`) VALUES 
('5','0','6033330f8aeb0','2021-02-22 05:29:03','2021-02-22 05:29:03');

INSERT INTO discounts (`id`, `discount`, `trx_id`, `created_at`, `updated_at`) VALUES 
('6','0','6033334287949','2021-02-22 05:29:54','2021-02-22 05:29:54');

INSERT INTO discounts (`id`, `discount`, `trx_id`, `created_at`, `updated_at`) VALUES 
('7','0','60333376a6866','2021-02-22 05:30:46','2021-02-22 05:30:46');

INSERT INTO discounts (`id`, `discount`, `trx_id`, `created_at`, `updated_at`) VALUES 
('8','0','603a14852fe0d','2021-02-27 10:44:37','2021-02-27 10:44:37');

INSERT INTO discounts (`id`, `discount`, `trx_id`, `created_at`, `updated_at`) VALUES 
('9','1000','603a154231637','2021-02-27 10:47:46','2021-02-27 10:47:46');

INSERT INTO discounts (`id`, `discount`, `trx_id`, `created_at`, `updated_at`) VALUES 
('10','300','603e19f224812','2021-03-02 11:56:50','2021-03-02 11:56:50');

INSERT INTO discounts (`id`, `discount`, `trx_id`, `created_at`, `updated_at`) VALUES 
('11','0','603e1b1e79d1f','2021-03-02 12:01:50','2021-03-02 12:01:50');

INSERT INTO discounts (`id`, `discount`, `trx_id`, `created_at`, `updated_at`) VALUES 
('12','0','603e1e5aeb4ae','2021-03-02 12:15:38','2021-03-02 12:15:38');

INSERT INTO discounts (`id`, `discount`, `trx_id`, `created_at`, `updated_at`) VALUES 
('13','250','603e2c0e6b992','2021-03-02 13:14:06','2021-03-02 13:14:06');

INSERT INTO discounts (`id`, `discount`, `trx_id`, `created_at`, `updated_at`) VALUES 
('14','250','603e2cb1a695e','2021-03-02 13:16:49','2021-03-02 13:16:49');

INSERT INTO discounts (`id`, `discount`, `trx_id`, `created_at`, `updated_at`) VALUES 
('15','0','603e2d9ea9efe','2021-03-02 13:20:46','2021-03-02 13:20:46');

INSERT INTO discounts (`id`, `discount`, `trx_id`, `created_at`, `updated_at`) VALUES 
('16','600','603e31e4c2e16','2021-03-02 13:39:00','2021-03-02 13:39:00');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('1','2014_10_12_000000_create_users_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('2','2019_08_19_000000_create_failed_jobs_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('3','2021_01_22_115523_create_tests_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('4','2021_01_22_210600_create_patients_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('5','2021_01_22_212610_create_staff_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('6','2021_01_23_150152_create_selected_test_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('7','2021_01_24_104524_create_medicals_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('8','2021_01_24_114256_create_selected_patient_referral_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('9','2021_01_24_171116_create_deposits_table','1');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('10','2021_02_09_100235_create_referrals_table','2');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('13','2021_02_09_113540_create_logged_in_staff_table','3');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('14','2021_02_09_120008_create_staff_activities_table','3');

INSERT INTO migrations (`id`, `migration`, `batch`) VALUES 
('16','2021_02_16_072809_create_discounts_table','5');

INSERT INTO users (`id`, `email`, `email_verified_at`, `password`, `remember_token`, `loggedin`, `created_at`, `updated_at`) VALUES 
('1','chiz','0000-00-00 00:00:00','$2y$10$IMfFt3xn/DD2mFlY8XhMyO/S.7oFJ1vmcPftYduiqhoMmpqx8PBfu','','0','2021-01-27 07:34:28','2021-01-27 07:34:28');

INSERT INTO users (`id`, `email`, `email_verified_at`, `password`, `remember_token`, `loggedin`, `created_at`, `updated_at`) VALUES 
('2','admin','0000-00-00 00:00:00','$2y$10$Qyk0tmTw6JN/DhbdbiC1.e6YwSZP7ZzbPTHYoL3sKCdESHkpruvc.','','1','0000-00-00 00:00:00','2021-03-30 01:59:55');
