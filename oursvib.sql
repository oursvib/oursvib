-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 31, 2020 at 07:43 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oursvib`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing_type`
--

CREATE TABLE `billing_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Venue', NULL, NULL),
(2, 'Space', NULL, NULL),
(3, 'Happenings', NULL, NULL),
(4, 'Services', NULL, NULL);

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
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `root_category` int(11) NOT NULL,
  `parent_category` int(11) NOT NULL,
  `child_category` int(11) NOT NULL,
  `niche_category` int(11) NOT NULL,
  `listing_type` int(11) NOT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nearby` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` int(11) NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `town` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amenities` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `images` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `video` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listing_type`
--

CREATE TABLE `listing_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(4, '2020_10_22_145600_create_categories_table', 1),
(5, '2020_10_22_150302_create_subcategories_table', 1),
(6, '2020_10_22_150348_create_subchildcategories_table', 1),
(7, '2020_10_22_191925_create_sublowerchildcategories_table', 2),
(8, '2020_10_30_051012_create_listings_table', 3),
(9, '2020_10_30_061645_create_listing_type', 3),
(10, '2020_10_30_062751_create_billing_type', 3);

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
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Luxury Commercial', 1, '2020-10-26 05:11:55', '2020-10-26 05:11:55'),
(2, 'Boutique Commercial', 1, '2020-10-26 05:12:25', '2020-10-26 05:12:25'),
(4, 'Commercial', 2, '2020-10-26 13:03:54', '2020-10-26 13:03:54'),
(5, 'Retail', 2, '2020-10-26 13:04:12', '2020-10-26 13:04:12');

-- --------------------------------------------------------

--
-- Table structure for table `subchildcategories`
--

CREATE TABLE `subchildcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subchildcategories`
--

INSERT INTO `subchildcategories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Luxury Estate', 1, '2020-10-26 05:37:52', '2020-10-26 05:37:52'),
(2, 'Unique Suite', 1, '2020-10-26 05:48:46', '2020-10-26 05:48:46'),
(3, 'Centre, Hall & Room', 2, '2020-10-26 06:42:41', '2020-10-26 06:42:41'),
(4, 'Hall & Rooms', 2, '2020-10-26 06:43:08', '2020-10-26 06:43:08'),
(5, 'Interior Ads', 4, '2020-10-26 13:04:36', '2020-10-26 13:04:36'),
(6, 'Exterior Ads', 4, '2020-10-26 13:04:58', '2020-10-26 13:04:58'),
(7, 'Sub Half Day', 5, '2020-10-26 13:05:24', '2020-10-26 13:05:24'),
(8, 'Medium - Large Office & Outlet', 5, '2020-10-26 13:06:11', '2020-10-26 13:06:11');

-- --------------------------------------------------------

--
-- Table structure for table `sublowerchildcategories`
--

CREATE TABLE `sublowerchildcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sublowerchildcategories`
--

INSERT INTO `sublowerchildcategories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Villa 5000sf', 1, '2020-10-26 13:22:56', '2020-10-26 13:22:56'),
(2, 'Luxury Bungalow with Pool 5000sf', 1, '2020-10-27 00:00:24', '2020-10-27 00:00:24'),
(3, 'Luxury Venue', 2, '2020-10-27 00:00:59', '2020-10-27 00:00:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `status_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '6jwoRMlF', 'karthick.oursvib+1@gmail.com', 1, '2020-10-22 10:15:06', '$2y$10$5cAg63azLx2iEOsNPi4YmOtKg9QBTxU46RLBXx35C7r4kWtN13BPS', NULL, NULL, '2020-10-22 10:00:34', '2020-10-22 10:15:06'),
(2, 'oLQKflMZ', 'karthick.oursvib+2@gmail.com', 2, NULL, '$2y$10$6aS.apZ0yyhHzOc6rlX/6uU88pvn00WUzia.D8mG9bV73RbdbRdLm', NULL, NULL, '2020-10-22 10:00:34', '2020-10-22 10:00:34'),
(3, 'mm49Lq3X', 'karthick.oursvib+3@gmail.com', 3, NULL, '$2y$10$5NLXDEw5ygeCQiD4vOWai.DqpcBuRaYmMICLOKludfHrzkW0vJVgO', NULL, NULL, '2020-10-22 10:00:34', '2020-10-22 10:00:34'),
(4, 'gZqsE8ip', 'karthick.oursvib+4@gmail.com', 4, NULL, '$2y$10$oh0W0IKN2O2o5SVA2Cu4uuiv3Fwv.f0G1SQ7H5PsGrsyuLju/WHsq', NULL, NULL, '2020-10-22 10:00:34', '2020-10-22 10:00:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_type`
--
ALTER TABLE `billing_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listing_type`
--
ALTER TABLE `listing_type`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subchildcategories`
--
ALTER TABLE `subchildcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sublowerchildcategories`
--
ALTER TABLE `sublowerchildcategories`
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
-- AUTO_INCREMENT for table `billing_type`
--
ALTER TABLE `billing_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `listings`
--
ALTER TABLE `listings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `listing_type`
--
ALTER TABLE `listing_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subchildcategories`
--
ALTER TABLE `subchildcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sublowerchildcategories`
--
ALTER TABLE `sublowerchildcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
