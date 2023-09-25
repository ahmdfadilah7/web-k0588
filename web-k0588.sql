-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2023 at 01:14 AM
-- Server version: 8.0.33-0ubuntu0.22.04.2
-- PHP Version: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web-k0588`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` bigint UNSIGNED NOT NULL,
  `name_bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name_bank`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'BCA', 'images/Bank-BCA-Mdp8Q.webp', '2023-05-30 07:13:53', '2023-05-30 07:20:38'),
(2, 'Mandiri', 'images/Bank-Mandiri-jLcLK.webp', '2023-05-30 07:15:16', '2023-05-30 07:15:16'),
(3, 'Dana', 'images/Bank-Dana-w1TIQ.webp', '2023-05-30 07:15:27', '2023-05-30 07:15:27'),
(5, 'Gopay', 'images/Bank-Gopay-mx35K.png', '2023-05-30 07:22:43', '2023-05-30 07:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meja_id` bigint UNSIGNED NOT NULL,
  `menu_id` bigint UNSIGNED NOT NULL,
  `name_customer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `order_id`, `meja_id`, `menu_id`, `name_customer`, `price`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(4, 'ORDJELANGSORE-W4VgK', 7, 1, 'Ahmad', '18500', '8', '148000', '2023-05-29 14:05:25', '2023-05-29 14:34:35'),
(5, 'ORDJELANGSORE-W4VgK', 7, 3, 'Ahmad', '15000', '4', '60000', '2023-05-29 14:10:40', '2023-05-29 14:34:39'),
(6, 'ORDJELANGSORE-W4VgK', 7, 2, 'Ahmad', '18000', '1', '18000', '2023-05-29 14:34:53', '2023-05-29 14:34:53'),
(9, 'ORDJELANGSORE-rnozW', 7, 2, 'Mamat', '18000', '2', '36000', '2023-05-30 10:01:58', '2023-05-30 10:01:58'),
(10, 'ORDJELANGSORE-rnozW', 7, 3, 'Mamat', '15000', '1', '15000', '2023-05-30 15:34:52', '2023-05-30 15:34:52'),
(11, 'ORDJELANGSORE-XvzfI', 13, 1, 'Ahmad', '18500', '1', '18500', '2023-05-31 09:01:00', '2023-05-31 09:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_menus`
--

CREATE TABLE `kategori_menus` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori_menus`
--

INSERT INTO `kategori_menus` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Coffee', '2023-05-27 05:58:26', '2023-05-27 06:04:14'),
(2, 'Non Coffee', '2023-05-27 05:58:34', '2023-05-27 05:58:34'),
(3, 'Extra', '2023-05-27 05:58:45', '2023-05-27 05:58:45'),
(5, 'Food', '2023-05-27 06:19:40', '2023-05-27 06:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `mejas`
--

CREATE TABLE `mejas` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qrcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mejas`
--

INSERT INTO `mejas` (`id`, `name`, `username`, `password`, `qrcode`, `created_at`, `updated_at`) VALUES
(7, 'Meja 1', 'meja-1', '$2y$10$ipFRsv.QO/c6pMgQHX1wr.je34TyWtAJnWb3nVvIN4ECc6ZvKw/g6', 'images/qr-code/QrCode-Meja-1-S69C.png', '2023-05-27 03:30:23', '2023-05-27 06:18:01'),
(8, 'Meja 2', 'meja-2', '$2y$10$/n1PWlFI4/q7HExOXlB.auGUDNDmLs4O9IVXONNEozNwYkmTfljsi', 'images/qr-code/QrCode-Meja-2-AtFi.png', '2023-05-27 05:17:39', '2023-05-27 05:17:39'),
(9, 'Meja 3', 'meja-3', '$2y$10$C6TvBCM/IJY6.O59JE3C..rv4MFvdgjfLbpA3VClt5d1xdlFnes1C', 'images/qr-code/QrCode-Meja-3-ZHeG.png', '2023-05-27 05:20:49', '2023-05-27 05:20:49'),
(10, 'Meja 4', 'meja-4', '$2y$10$WIDg2YNVhI5gwk51/8WK3uSHkZ8f1Q5HOV62RY2lcnTeTyKWbHMAq', 'images/qr-code/QrCode-Meja-4-9naO.png', '2023-05-27 05:24:37', '2023-05-27 05:24:37'),
(11, 'Meja 5', 'meja-5', '$2y$10$eMHiXU/NQw3tDqIr75VSN.RalYaDp1ff9K.nCsM6x/nXsIseC3sba', 'images/qr-code/QrCode-Meja-5-70Ao.png', '2023-05-29 01:47:26', '2023-05-29 01:47:26'),
(13, 'Meja 7', 'meja-7', '$2y$10$yna1MBegQPY9BVUut3QK3uL1Aiu912j4R1O15bXKKuO902n3ZO0FC', 'images/qr-code/QrCode-Meja-7-cw5Y.png', '2023-05-29 04:41:49', '2023-05-29 04:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategorimenu_id` bigint UNSIGNED NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `kategorimenu_id`, `price`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Hot Americano', 1, '18500', 'images/Menu-hot-americano-y7P0j.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', '2023-05-29 05:37:15', '2023-05-30 06:40:36'),
(2, 'Iced Americano', 1, '18000', 'images/Menu-iced-americano-skec4.webp', '', '2023-05-29 05:38:21', '2023-05-29 05:38:21'),
(3, 'French Fries', 5, '15000', 'images/Menu-french-fries-xaacP.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>', '2023-05-29 05:39:56', '2023-05-30 06:41:02');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_27_040821_create_mejas_table', 1),
(6, '2023_05_27_071750_add_field_username_to_users', 2),
(7, '2023_05_27_074136_create_settings_table', 3),
(8, '2023_05_27_124547_create_kategori_menus_table', 4),
(11, '2023_05_27_132105_create_menus_table', 5),
(12, '2023_05_29_121319_create_orders_table', 5),
(13, '2023_05_29_123401_create_carts_table', 6),
(14, '2023_05_29_124527_add_field_meja_id_to_orders', 7),
(15, '2023_05_30_132617_add_field_description_to_menus', 8),
(17, '2023_05_30_134843_create_banks_table', 9),
(18, '2023_05_30_142306_create_rekenings_table', 10),
(19, '2023_05_30_151856_add_field_metode_to_orders', 11),
(20, '2023_05_30_235936_add_field_gambar_header_to_settings', 12);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `id_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meja_id` bigint UNSIGNED NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `metode` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 Kasir, 1 Transfer',
  `name_rekening` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_rekening` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bukti_pembayaran` text COLLATE utf8mb4_unicode_ci,
  `konfirmasi_pembayaran` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 belum, 1 konfirmasi',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `id_order`, `meja_id`, `total`, `status`, `metode`, `name_rekening`, `no_rekening`, `bank`, `bukti_pembayaran`, `konfirmasi_pembayaran`, `created_at`, `updated_at`) VALUES
(2, 'ORDJELANGSORE-W4VgK', 7, '226000', '1', '0', NULL, NULL, NULL, NULL, '1', '2023-05-29 13:17:22', '2023-05-30 15:09:04'),
(4, 'ORDJELANGSORE-rnozW', 7, '51000', '1', '1', 'Jelang Sore', '872199918', 'BCA', 'images/Bukti-Pembayaran-ORDJELANGSORE-rnozW.png', '1', '2023-05-30 10:01:58', '2023-05-30 15:57:03'),
(5, 'ORDJELANGSORE-XvzfI', 13, '18500', '1', '0', NULL, NULL, NULL, NULL, '1', '2023-05-31 09:01:00', '2023-05-31 09:01:48');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekenings`
--

CREATE TABLE `rekenings` (
  `id` bigint UNSIGNED NOT NULL,
  `bank_id` bigint UNSIGNED NOT NULL,
  `name_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_rekening` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rekenings`
--

INSERT INTO `rekenings` (`id`, `bank_id`, `name_rekening`, `no_rekening`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jelang Sore', '872199918', '2023-05-30 07:36:55', '2023-05-30 07:39:55'),
(2, 2, 'Jelang Sore', '21717711', '2023-05-30 07:40:07', '2023-05-30 07:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `name_website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_header` text COLLATE utf8mb4_unicode_ci,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_us` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name_website`, `gambar_header`, `logo`, `favicon`, `address`, `email`, `no_telp`, `about_us`, `created_at`, `updated_at`) VALUES
(1, 'Jelang Sore', 'images/Header-Jelang-Sore-FzQi.jpg', 'images/Logo-Jelang Sore-7IxF.png', 'images/Favicon-Jelang Sore-ZeS2.png', 'Kp. Jauh, Desa Terdekat, Kec. Terjauh - Dimana', 'jelangsore@gmail.com', '081272181990', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '2023-05-27 01:31:06', '2023-05-30 17:06:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('Pegawai','Administrator') COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `foto`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin', 'superadmin@gmail.com', 'Administrator', 'images/Profile-Super Admin-EhLO.jpg', NULL, '$2y$10$fhJjyJkAEDtkl05k8bq9c.YMu9iXF1LdgWDuryIo/hhOAbgd4FhCO', NULL, '2023-05-27 00:18:33', '2023-05-27 00:18:33'),
(2, 'Pegawai 1', 'pegawai1', 'pegawai1@gmail.com', 'Pegawai', 'images/Profile-Pegawai-1-pbG5.jpg', NULL, '$2y$10$FflZADxh0jhdRBOH8b0ON..vD.ardH7u50kvAudUG5inUV684VqWS', NULL, '2023-05-30 17:27:15', '2023-05-30 17:36:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_meja_id_foreign` (`meja_id`),
  ADD KEY `carts_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kategori_menus`
--
ALTER TABLE `kategori_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mejas`
--
ALTER TABLE `mejas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menus_kategorimenu_id_foreign` (`kategorimenu_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_meja_id_foreign` (`meja_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rekenings`
--
ALTER TABLE `rekenings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rekenings_bank_id_foreign` (`bank_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori_menus`
--
ALTER TABLE `kategori_menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mejas`
--
ALTER TABLE `mejas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekenings`
--
ALTER TABLE `rekenings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_meja_id_foreign` FOREIGN KEY (`meja_id`) REFERENCES `mejas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_kategorimenu_id_foreign` FOREIGN KEY (`kategorimenu_id`) REFERENCES `kategori_menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_meja_id_foreign` FOREIGN KEY (`meja_id`) REFERENCES `mejas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rekenings`
--
ALTER TABLE `rekenings`
  ADD CONSTRAINT `rekenings_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `banks` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
