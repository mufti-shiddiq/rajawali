-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2021 at 03:38 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rajawali`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`) VALUES
(1, 'Besi', 'besi', 1, NULL, NULL, '2021-04-12 08:52:48', '2021-04-12 08:52:48'),
(2, 'Baja', 'baja', 1, NULL, NULL, '2021-04-12 08:54:02', '2021-04-12 08:54:02'),
(3, 'Baut-Fisher', 'baut-fisher', 1, NULL, NULL, '2021-04-12 08:54:33', '2021-04-12 08:54:33'),
(4, 'Galvalum', 'galvalum', 1, NULL, NULL, '2021-04-12 08:54:44', '2021-04-12 08:54:44'),
(5, 'Mur Baut', 'mur-baut', 1, 1, NULL, '2021-04-12 08:55:06', '2021-04-12 10:52:43'),
(7, 'Paku Baja', 'paku-baja', 1, NULL, NULL, '2021-04-12 08:55:56', '2021-04-12 08:55:56'),
(9, 'Paku Bumi', 'paku-bumi', 1, NULL, NULL, '2021-04-12 11:39:34', '2021-04-12 11:39:34'),
(10, 'Baja Ringan', 'baja-ringan', 1, NULL, NULL, '2021-04-15 11:00:59', '2021-04-15 11:00:59'),
(12, 'a', 'a', 1, NULL, NULL, '2021-04-16 01:35:48', '2021-04-16 01:35:48'),
(15, 'd', 'd', 1, NULL, NULL, '2021-04-16 01:35:56', '2021-04-16 01:35:56'),
(16, 'b', 'b', 1, NULL, NULL, '2021-04-16 01:45:06', '2021-04-16 01:45:06'),
(17, 'f', 'f', 1, NULL, NULL, '2021-04-16 01:45:09', '2021-04-16 01:45:09');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `company`, `phone`, `address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Paijo', 'Telkom', '089123123123', 'Jl. Kenangan, Solo, Jawa Tengah, ID', 1, NULL, '2021-04-13 10:19:21', '2021-04-13 10:19:21'),
(3, 'Umum', 'Umum', '-', '-', 1, 1, '2021-04-13 10:32:20', '2021-04-13 11:52:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_04_06_091809_penyesuaian_table_users', 2),
(5, '2021_04_12_152132_create_categories_table', 3),
(6, '2021_04_12_190500_create_units_table', 4),
(7, '2021_04_12_192807_create_units_table', 5),
(8, '2021_04_13_060345_create_customers_table', 6),
(9, '2021_04_13_182938_create_suppliers_table', 7),
(10, '2021_04_14_174844_create_products_table', 8);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `sold` int(11) DEFAULT NULL,
  `buy_price` int(11) NOT NULL,
  `sell_price` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `product_name`, `category_id`, `unit_id`, `stock`, `sold`, `buy_price`, `sell_price`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'PK12', 'Paku 12cm', 7, 7, 100, NULL, 1000, 1500, 1, NULL, '2021-04-14 11:56:42', '2021-04-14 11:56:42'),
(2, 'PK10', 'Paku 10cm', 7, 7, 87, NULL, 8000, 11000, 1, NULL, '2021-04-14 11:57:52', '2021-04-14 11:57:52'),
(3, 'GLVM030', 'Galvalum 0.30', 4, 4, 10, NULL, 34000, 40000, 1, NULL, '2021-04-14 11:59:22', '2021-04-14 11:59:22'),
(4, 'GVLM025', 'Galvalum 0.25', 4, 4, 10, NULL, 30000, 36000, 1, NULL, '2021-04-14 12:00:05', '2021-04-14 12:00:05'),
(5, 'BR5M', 'Baja Ringan 5m', 10, 3, 50, NULL, 99000, 120000, 1, NULL, '2021-04-15 11:01:50', '2021-04-15 11:01:50'),
(6, 'BR10M', 'Baja Ringan 10m', 10, 3, 30, NULL, 142000, 160000, 1, NULL, '2021-04-15 11:02:41', '2021-04-15 11:02:41'),
(8, 'KWT', 'Kawat', 1, 1, 10, NULL, 4000, 8000, 1, 1, '2021-04-15 11:03:22', '2021-04-18 10:47:47'),
(9, 'PB10M', 'Paku Bumi 10m', 9, 3, 9, NULL, 3400000, 4000000, 1, NULL, '2021-04-15 19:57:31', '2021-04-15 19:57:31'),
(13, 'BT12MM', 'Baut 12mm', 5, 3, 56, NULL, 2000, 2500, 1, 1, '2021-04-18 10:49:04', '2021-04-18 10:49:20'),
(14, 'a', 'a', 12, 7, 213, NULL, 231, 24, 1, NULL, '2021-04-18 11:34:55', '2021-04-18 11:34:55'),
(15, 'e', 'd', 15, 7, 231, NULL, 132, 45, 1, NULL, '2021-04-18 11:35:05', '2021-04-18 11:35:05'),
(16, 'fsa', 'fasd', 9, 3, 132, NULL, 532, 235, 1, NULL, '2021-04-18 11:35:20', '2021-04-18 11:35:20');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `company`, `phone`, `address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Pak Joko', 'Sritex', '089213443', 'Sukoharjo', 1, NULL, '2021-04-13 11:43:48', '2021-04-13 11:43:48');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `code`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Kilogram', 'kg', 1, NULL, '2021-04-12 12:50:21', '2021-04-12 12:50:21'),
(2, 'Liter', 'Ltr', 1, NULL, '2021-04-12 12:54:56', '2021-04-12 12:54:56'),
(3, 'Piece', 'pcs', 1, NULL, '2021-04-12 12:55:09', '2021-04-12 12:55:09'),
(4, 'Lembar', 'Lbr', 1, NULL, '2021-04-12 12:55:17', '2021-04-12 12:55:17'),
(5, 'Meter', 'm', 1, NULL, '2021-04-12 12:55:45', '2021-04-12 12:55:45'),
(6, 'Centimeter', 'cm', 1, 1, '2021-04-12 12:56:03', '2021-04-12 13:00:42'),
(7, 'Ons', 'ons', 1, NULL, '2021-04-12 12:56:24', '2021-04-12 12:56:24'),
(9, 'Ton', 'ton', 1, NULL, '2021-04-12 12:56:43', '2021-04-12 12:56:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('AKTIF','NONAKTIF') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `remember_token`, `created_at`, `updated_at`, `username`, `role`, `status`) VALUES
(1, 'Admininstrator', '$2y$10$qqacD9QufKJV3zhvm6nsz.BDvN0QQOLYoGmiGVfIhAbO88fT2akLC', NULL, '2021-04-06 02:27:36', '2021-04-06 02:27:36', 'admin', 'ADMIN', 'AKTIF'),
(2, 'User 1', '$2y$10$lxqT8bcvY6s68CFAYkB0Jupu9Jh5ZmqNJAKMg.KURudivaLnPDhJS', NULL, '2021-04-06 04:22:22', '2021-04-06 05:31:20', 'user1', 'ADMIN', 'AKTIF'),
(3, 'Coba coba', '$2y$10$U0S/oEndvV1CdAenwzraC.ZIdxl5t.ISVZjkOSZOl/et/2hYLRFyy', NULL, '2021-04-06 11:28:27', '2021-04-06 05:39:54', 'coba', 'ADMIN', 'AKTIF'),
(4, 'User 2', '$2y$10$wu06TvREjnhyQrmCj4apx.y6KCzHJkzPyiIhl9.LzS3Nkts5pto3G', NULL, '2021-04-06 04:25:53', '2021-04-06 05:38:41', 'user2', 'ADMIN', 'AKTIF'),
(5, 'User 3', '$2y$10$w9WbkxUbq3VngSU77VwBKuY5Mc2TZyY7Rg5itYWOUDCpmfjx2Vqgm', NULL, '2021-04-06 04:30:35', '2021-04-06 04:30:35', 'user3', 'STAFF', 'NONAKTIF'),
(7, 'Paijo', '$2y$10$BsbnC4ICUzhfbkXVp1bfA.2rbu/BzV0BqQhOFSM5pX8nqK1lxps.6', NULL, '2021-04-06 04:32:51', '2021-04-06 04:32:51', 'paijo', 'STAFF', 'AKTIF'),
(9, 'users', '$2y$10$VrsSvH4EsupA/7USlY3zoOuEYJY.5jDWRqLDWDJnko4YnHAUQ8bFG', NULL, '2021-04-06 21:47:59', '2021-04-06 21:47:59', 'users', 'STAFF', 'AKTIF');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
