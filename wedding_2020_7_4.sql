-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2020 at 02:27 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wedding_2020`
--

-- --------------------------------------------------------

--
-- Table structure for table `buffets`
--

CREATE TABLE `buffets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categories_id` bigint(20) UNSIGNED NOT NULL,
  `iteminventory_id` bigint(20) UNSIGNED NOT NULL,
  `no_members` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buffets`
--

INSERT INTO `buffets` (`id`, `categories_id`, `iteminventory_id`, `no_members`, `created_at`, `updated_at`) VALUES
(51, 26, 6, 100, '2020-04-07 11:07:04', '2020-04-07 11:07:04');

-- --------------------------------------------------------

--
-- Table structure for table `buffetsitems`
--

CREATE TABLE `buffetsitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `iteminventory_id` bigint(20) UNSIGNED NOT NULL,
  `buffet_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `no_members` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `buffet_gallery`
--

CREATE TABLE `buffet_gallery` (
  `id` int(11) NOT NULL,
  `buffet_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `catalogitems`
--

CREATE TABLE `catalogitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `iteminventory_id` bigint(20) UNSIGNED NOT NULL,
  `catalog_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `catalogitems_gallery`
--

CREATE TABLE `catalogitems_gallery` (
  `id` int(11) NOT NULL,
  `cat_image` varchar(255) NOT NULL,
  `catalogitem_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `catalogs`
--

CREATE TABLE `catalogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_desc` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catalog_img` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `catalogs`
--

INSERT INTO `catalogs` (`id`, `en_name`, `ar_name`, `en_desc`, `ar_desc`, `catalog_img`, `categories_id`, `created_at`, `updated_at`) VALUES
(123105, 'Sweets', 'Sweets', 'Sweets', 'Sweets', '1586257084.jpg', 26, '2020-04-07 10:58:04', '2020-04-07 10:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `en_name`, `ar_name`, `en_desc`, `ar_desc`, `cat_image`, `created_at`, `updated_at`) VALUES
(26, 'Weddings', 'أفراح', 'Weddings', 'أفراح', '1586228682.png', '2020-04-07 03:04:42', '2020-04-07 03:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Ahmed', 'ahmed@ahmed.com', 'aaa', 'aaaaa', '2020-01-25 17:41:25', '2020-01-25 17:41:25'),
(2, 'Admins', 'admin@admin.com', 'aaa', 'aaaaa', '2020-01-25 17:43:44', '2020-01-25 17:43:44'),
(3, 'asd', 'ahmed@ahmed.com', 'aaa', 'aaaaa', '2020-01-25 17:45:52', '2020-01-25 17:45:52'),
(4, 'shimaa khair', 'shimaashimaa645@gmail.com', 'gfghfgf', 'hghfgh', '2020-02-05 08:33:51', '2020-02-05 08:33:51'),
(5, 'ismail', 'ismail.elshafeiy@gmail.com', 'نشكركم على الخدمة الممتازة', 'شكر', '2020-02-09 09:40:22', '2020-02-09 09:40:22');

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ar_name` varchar(255) NOT NULL,
  `en_name` varchar(255) NOT NULL,
  `ar_content` text NOT NULL,
  `en_content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`id`, `ar_name`, `en_name`, `ar_content`, `en_content`, `created_at`, `updated_at`) VALUES
(2, 'العقد الاول', 'Contract One', '<p>العقد الاول</p>', '<p>Contract One</p>', '2020-03-11 09:49:35', '2020-03-11 09:49:35'),
(4, 'asdsad', 'term name', '<p>dasdsa</p>', '<p>dsadsad</p>', '2020-03-11 10:04:09', '2020-03-11 10:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `contract_terms`
--

CREATE TABLE `contract_terms` (
  `id` int(11) NOT NULL,
  `contract_id` bigint(20) UNSIGNED NOT NULL,
  `terms_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contract_terms`
--

INSERT INTO `contract_terms` (`id`, `contract_id`, `terms_id`, `created_at`, `updated_at`) VALUES
(4, 2, 2, '2020-03-11 13:34:07', '2020-03-11 13:34:07'),
(5, 2, 3, '2020-03-11 13:34:14', '2020-03-11 13:34:14'),
(6, 2, 4, '2020-03-11 13:34:24', '2020-03-11 13:34:24'),
(7, 4, 4, '2020-03-11 13:34:24', '2020-03-11 13:34:24');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `mobile`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(19, 'yasser', 'yasser@gmail.com', NULL, '$2y$10$dXLCBRsHA.lGh3JttNahjOILYoRb.q8lH3qajfCbv2aD7wDHAZLLG', NULL, '01155155151', 1, 30, '2020-02-09 13:20:55', '2020-02-10 09:59:46'),
(27, NULL, NULL, NULL, NULL, NULL, '01003440808', 1, NULL, '2020-02-11 07:54:36', '2020-02-11 07:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `customer_files`
--

CREATE TABLE `customer_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(255) NOT NULL,
  `ar_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `en_name`, `ar_name`, `created_at`, `updated_at`) VALUES
(2, 'DJ', 'دى جى', '2020-01-09 19:22:15', '2020-02-14 07:28:38'),
(3, 'Management', 'الادراة', '2020-01-09 19:28:42', '2020-01-09 19:28:42'),
(4, 'decor', 'ديكور', '2020-01-27 09:38:52', '2020-01-27 09:38:52'),
(6, 'kitchen', 'المطبخ', '2020-02-04 10:42:59', '2020-02-04 10:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `department_tasks`
--

CREATE TABLE `department_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `ar_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department_tasks`
--

INSERT INTO `department_tasks` (`id`, `department_id`, `ar_name`, `en_name`, `ar_desc`, `en_desc`, `created_at`, `updated_at`) VALUES
(3, 3, 'aaaa', 'aaa', 'aaa', 'aaa', '2020-02-01 08:02:26', '2020-02-01 08:02:26'),
(4, 6, 'فراخ', 'citchen', 'قثلقثلقلللل', 'kjrkgjrgerjgerkgre', '2020-02-10 12:30:56', '2020-02-10 12:30:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'Ahmed', 'ahmed@h.com', 'comment', '2020-01-27 10:59:25', '2020-01-27 10:59:25'),
(2, 'Mohamed Eid', 'm.eid@quantumsit.com', 'Like', '2020-01-27 11:27:28', '2020-01-27 11:27:28'),
(3, 'ismail', 'ismail.elshafeiy@gmail.com', 'tamm tamm', '2020-02-04 12:21:12', '2020-02-04 12:21:12'),
(4, 'ismail', 'ismail.elshafeiy@gmail.com', 'the site is very good', '2020-02-05 12:16:35', '2020-02-05 12:16:35'),
(5, 'fv', 'as@sd.com', 'vv', '2020-02-09 09:57:37', '2020-02-09 09:57:37'),
(6, 'shimaa khair', 'shimaashimaa645@gmail.com', '5452', '2020-02-09 13:35:43', '2020-02-09 13:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `fromchoices_gallery`
--

CREATE TABLE `fromchoices_gallery` (
  `id` int(11) NOT NULL,
  `fromchoice_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `from_choices`
--

CREATE TABLE `from_choices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ar_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fromchoice_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `from_choice_items`
--

CREATE TABLE `from_choice_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_choices_id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `en_name`, `ar_name`, `quantity`, `price`, `user_id`, `inventory_image`, `en_desc`, `ar_desc`, `notes`, `created_at`, `updated_at`) VALUES
(77, 'Plates', 'أطباق', '10', '10', 9, '1586228599.jpg', 'أطباق', 'Plates', NULL, '2020-03-17 09:55:13', '2020-04-07 03:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `item_inventory`
--

CREATE TABLE `item_inventory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(255) NOT NULL,
  `ar_name` varchar(255) NOT NULL,
  `price` varchar(225) NOT NULL,
  `inventory_image` varchar(255) NOT NULL,
  `en_desc` text NOT NULL,
  `ar_desc` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_inventory`
--

INSERT INTO `item_inventory` (`id`, `en_name`, `ar_name`, `price`, `inventory_image`, `en_desc`, `ar_desc`, `created_at`, `updated_at`) VALUES
(6, 'Sweets', 'حلوى', '10', '1586225210.jpg', 'dasd', 'adsad', '2020-04-07 02:06:50', '2020-04-07 02:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `main_orders`
--

CREATE TABLE `main_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `order_day` datetime NOT NULL,
  `followers` text,
  `status` varchar(255) NOT NULL DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_01_05_150242_create_permission_tables', 1),
(5, '2020_01_08_104939_create_user_data_table', 2),
(6, '2020_01_08_110137_create_user_follows_table', 2),
(7, '2020_01_08_194605_create_user_files_table', 2),
(8, '2020_01_08_221525_create_customers_table', 3),
(9, '2020_01_09_190140_create_user_deartments_table', 4),
(10, '2020_01_10_093149_create_catalogs_table', 5),
(11, '2020_01_10_093724_create_catalog_items_table', 6),
(12, '2020_01_10_134047_create_inventories_table', 7),
(13, '2020_01_12_102855_create_orders_table', 8),
(14, '2020_01_14_131924_create_tasks_table', 9),
(15, '2020_01_14_095729_create_contact_us_table', 10),
(16, '2020_01_14_122229_create_settings_table', 10),
(17, '2020_01_14_122321_create_soical_media_table', 10),
(18, '2020_01_16_091611_create_order__reviews_table', 10),
(19, '2020_01_20_204630_create_categories_table', 11),
(20, '2020_01_27_114243_create_feedback_table', 12),
(21, '2020_01_31_211945_create_department_tasks_table', 13),
(22, '2020_02_02_120010_create_from_choice_items_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `mobiles_codes`
--

CREATE TABLE `mobiles_codes` (
  `id` int(11) NOT NULL,
  `mobile` varchar(225) NOT NULL,
  `code` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mobiles_codes`
--

INSERT INTO `mobiles_codes` (`id`, `mobile`, `code`, `created_at`, `updated_at`) VALUES
(3, '1117725721', '202013', '2020-02-09 12:51:44', '2020-02-09 12:51:44'),
(8, '1003440808', '2020831', '2020-02-11 08:54:10', '2020-02-11 08:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 9),
(1, 'App\\User', 24),
(1, 'App\\User', 29),
(2, 'App\\User', 9),
(2, 'App\\User', 24),
(2, 'App\\User', 29),
(3, 'App\\User', 9),
(3, 'App\\User', 24),
(3, 'App\\User', 29),
(4, 'App\\User', 9),
(4, 'App\\User', 24),
(4, 'App\\User', 29),
(5, 'App\\User', 9),
(5, 'App\\User', 29),
(6, 'App\\User', 9),
(6, 'App\\User', 29),
(7, 'App\\User', 9),
(7, 'App\\User', 29),
(8, 'App\\User', 9),
(8, 'App\\User', 29),
(9, 'App\\User', 9),
(9, 'App\\User', 29),
(10, 'App\\User', 9),
(10, 'App\\User', 24),
(10, 'App\\User', 29),
(11, 'App\\User', 9),
(11, 'App\\User', 29),
(12, 'App\\User', 9),
(12, 'App\\User', 29),
(13, 'App\\User', 9),
(13, 'App\\User', 29),
(14, 'App\\User', 9),
(14, 'App\\User', 24),
(14, 'App\\User', 29),
(15, 'App\\User', 9),
(15, 'App\\User', 14),
(15, 'App\\User', 29),
(16, 'App\\User', 9),
(16, 'App\\User', 14),
(16, 'App\\User', 29),
(17, 'App\\User', 9),
(17, 'App\\User', 14),
(17, 'App\\User', 29),
(18, 'App\\User', 9),
(18, 'App\\User', 14),
(18, 'App\\User', 29),
(19, 'App\\User', 9),
(19, 'App\\User', 14),
(19, 'App\\User', 24),
(19, 'App\\User', 29),
(20, 'App\\User', 9),
(20, 'App\\User', 14),
(20, 'App\\User', 24),
(20, 'App\\User', 29),
(21, 'App\\User', 9),
(21, 'App\\User', 24),
(21, 'App\\User', 29),
(22, 'App\\User', 9),
(22, 'App\\User', 14),
(22, 'App\\User', 24),
(22, 'App\\User', 29),
(23, 'App\\User', 9),
(23, 'App\\User', 24),
(23, 'App\\User', 29),
(23, 'App\\User', 31),
(24, 'App\\User', 9),
(24, 'App\\User', 14),
(24, 'App\\User', 24),
(24, 'App\\User', 29),
(25, 'App\\User', 9),
(25, 'App\\User', 14),
(25, 'App\\User', 24),
(25, 'App\\User', 29),
(25, 'App\\User', 31),
(26, 'App\\User', 9),
(26, 'App\\User', 14),
(26, 'App\\User', 24),
(26, 'App\\User', 29),
(27, 'App\\User', 9),
(27, 'App\\User', 24),
(27, 'App\\User', 29),
(28, 'App\\User', 9),
(28, 'App\\User', 24),
(28, 'App\\User', 29),
(29, 'App\\User', 9),
(29, 'App\\User', 24),
(29, 'App\\User', 29),
(30, 'App\\User', 9),
(30, 'App\\User', 24),
(30, 'App\\User', 29),
(31, 'App\\User', 9),
(31, 'App\\User', 24),
(31, 'App\\User', 29),
(32, 'App\\User', 9),
(32, 'App\\User', 24),
(32, 'App\\User', 29),
(33, 'App\\User', 9),
(33, 'App\\User', 24),
(33, 'App\\User', 29),
(34, 'App\\User', 9),
(34, 'App\\User', 24),
(34, 'App\\User', 29),
(35, 'App\\User', 9),
(35, 'App\\User', 14),
(35, 'App\\User', 29),
(36, 'App\\User', 9),
(36, 'App\\User', 24),
(36, 'App\\User', 29),
(37, 'App\\User', 9),
(37, 'App\\User', 24),
(37, 'App\\User', 29),
(38, 'App\\User', 9),
(38, 'App\\User', 14),
(38, 'App\\User', 24),
(38, 'App\\User', 29),
(39, 'App\\User', 9),
(39, 'App\\User', 14),
(39, 'App\\User', 24),
(39, 'App\\User', 29),
(40, 'App\\User', 9),
(40, 'App\\User', 14),
(40, 'App\\User', 24),
(40, 'App\\User', 29),
(41, 'App\\User', 9),
(41, 'App\\User', 24),
(41, 'App\\User', 29),
(41, 'App\\User', 31),
(42, 'App\\User', 9),
(42, 'App\\User', 24),
(42, 'App\\User', 29),
(43, 'App\\User', 9),
(43, 'App\\User', 24),
(43, 'App\\User', 29),
(44, 'App\\User', 9),
(44, 'App\\User', 24),
(45, 'App\\User', 9),
(45, 'App\\User', 24),
(45, 'App\\User', 29),
(46, 'App\\User', 9),
(46, 'App\\User', 24),
(46, 'App\\User', 29),
(47, 'App\\User', 9),
(47, 'App\\User', 24),
(48, 'App\\User', 9),
(48, 'App\\User', 24),
(48, 'App\\User', 29),
(49, 'App\\User', 9),
(49, 'App\\User', 24),
(49, 'App\\User', 29),
(50, 'App\\User', 9),
(50, 'App\\User', 24),
(50, 'App\\User', 29),
(51, 'App\\User', 9),
(51, 'App\\User', 24),
(51, 'App\\User', 29),
(52, 'App\\User', 9),
(52, 'App\\User', 24),
(52, 'App\\User', 29),
(53, 'App\\User', 9),
(53, 'App\\User', 24),
(53, 'App\\User', 29),
(54, 'App\\User', 9),
(54, 'App\\User', 24),
(54, 'App\\User', 29),
(55, 'App\\User', 9),
(55, 'App\\User', 24),
(55, 'App\\User', 29),
(56, 'App\\User', 9),
(56, 'App\\User', 24),
(56, 'App\\User', 29),
(57, 'App\\User', 9),
(57, 'App\\User', 24),
(57, 'App\\User', 29),
(58, 'App\\User', 9),
(58, 'App\\User', 24),
(58, 'App\\User', 29),
(59, 'App\\User', 9),
(59, 'App\\User', 24),
(59, 'App\\User', 29),
(60, 'App\\User', 9),
(60, 'App\\User', 24),
(60, 'App\\User', 29),
(61, 'App\\User', 9),
(61, 'App\\User', 24),
(61, 'App\\User', 29),
(62, 'App\\User', 9),
(62, 'App\\User', 24),
(62, 'App\\User', 29),
(63, 'App\\User', 9),
(63, 'App\\User', 24),
(63, 'App\\User', 29),
(64, 'App\\User', 9),
(64, 'App\\User', 24),
(64, 'App\\User', 29),
(65, 'App\\User', 9),
(65, 'App\\User', 24),
(65, 'App\\User', 29),
(66, 'App\\User', 9),
(66, 'App\\User', 24),
(66, 'App\\User', 29),
(67, 'App\\User', 9),
(67, 'App\\User', 24),
(67, 'App\\User', 29),
(68, 'App\\User', 9),
(68, 'App\\User', 24),
(68, 'App\\User', 29),
(69, 'App\\User', 9),
(69, 'App\\User', 24),
(69, 'App\\User', 29),
(70, 'App\\User', 9),
(70, 'App\\User', 24),
(70, 'App\\User', 29),
(71, 'App\\User', 9),
(71, 'App\\User', 24),
(71, 'App\\User', 29),
(72, 'App\\User', 9),
(72, 'App\\User', 29),
(73, 'App\\User', 9),
(73, 'App\\User', 14),
(73, 'App\\User', 24),
(73, 'App\\User', 29),
(74, 'App\\User', 9),
(74, 'App\\User', 29),
(75, 'App\\User', 9),
(75, 'App\\User', 24),
(75, 'App\\User', 29),
(76, 'App\\User', 9),
(76, 'App\\User', 14),
(76, 'App\\User', 24),
(76, 'App\\User', 29),
(77, 'App\\User', 9),
(77, 'App\\User', 24),
(77, 'App\\User', 29),
(78, 'App\\User', 9),
(78, 'App\\User', 14),
(78, 'App\\User', 24),
(78, 'App\\User', 29),
(78, 'App\\User', 31),
(79, 'App\\User', 9),
(79, 'App\\User', 24),
(79, 'App\\User', 29),
(79, 'App\\User', 31),
(80, 'App\\User', 9),
(80, 'App\\User', 14),
(80, 'App\\User', 24),
(80, 'App\\User', 29),
(80, 'App\\User', 31),
(81, 'App\\User', 9),
(81, 'App\\User', 24),
(81, 'App\\User', 29),
(81, 'App\\User', 31),
(82, 'App\\User', 9),
(82, 'App\\User', 24),
(82, 'App\\User', 29),
(83, 'App\\User', 9),
(83, 'App\\User', 24),
(83, 'App\\User', 29),
(84, 'App\\User', 9),
(84, 'App\\User', 24),
(84, 'App\\User', 29),
(85, 'App\\User', 9),
(85, 'App\\User', 24),
(85, 'App\\User', 29),
(86, 'App\\User', 9),
(86, 'App\\User', 24),
(86, 'App\\User', 29),
(87, 'App\\User', 9),
(87, 'App\\User', 24),
(87, 'App\\User', 29),
(88, 'App\\User', 9),
(88, 'App\\User', 24),
(88, 'App\\User', 29),
(89, 'App\\User', 9),
(89, 'App\\User', 24),
(89, 'App\\User', 29),
(90, 'App\\User', 9),
(90, 'App\\User', 24),
(90, 'App\\User', 29),
(91, 'App\\User', 9),
(91, 'App\\User', 24),
(91, 'App\\User', 29),
(92, 'App\\User', 9),
(92, 'App\\User', 24),
(92, 'App\\User', 29),
(93, 'App\\User', 9),
(93, 'App\\User', 29),
(94, 'App\\User', 9),
(94, 'App\\User', 29),
(95, 'App\\User', 9),
(95, 'App\\User', 29),
(96, 'App\\User', 9),
(96, 'App\\User', 29),
(97, 'App\\User', 9),
(98, 'App\\User', 9),
(99, 'App\\User', 9),
(99, 'App\\User', 29),
(100, 'App\\User', 9),
(100, 'App\\User', 29),
(101, 'App\\User', 9),
(101, 'App\\User', 29),
(102, 'App\\User', 9),
(102, 'App\\User', 29),
(103, 'App\\User', 9),
(104, 'App\\User', 9),
(105, 'App\\User', 9),
(106, 'App\\User', 9),
(107, 'App\\User', 9);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mainorder_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order__reviews`
--

CREATE TABLE `order__reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `en_name` varchar(255) NOT NULL,
  `ar_name` varchar(255) NOT NULL,
  `en_desc` text NOT NULL,
  `ar_desc` text NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `price` varchar(255) NOT NULL,
  `no_members` int(11) NOT NULL,
  `package_image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `en_name`, `ar_name`, `en_desc`, `ar_desc`, `category_id`, `price`, `no_members`, `package_image`, `created_at`, `updated_at`) VALUES
(14, 'aa', 'Sweets', 'Sweets', 'Sweets', 26, '1000', 900, '1586258250.jpg', '2020-04-07 11:08:38', '2020-04-07 11:18:04');

-- --------------------------------------------------------

--
-- Table structure for table `packages_items`
--

CREATE TABLE `packages_items` (
  `id` bigint(20) NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `iteminventory_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `packages_items`
--

INSERT INTO `packages_items` (`id`, `package_id`, `iteminventory_id`, `created_at`, `updated_at`) VALUES
(9, 14, 6, '2020-04-07 11:09:48', '2020-04-07 11:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create_users', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(2, 'edit_users', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(3, 'show_users', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(4, 'delete_users', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(5, 'create_departments', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(6, 'edit_departments', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(7, 'show_departments', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(8, 'delete_departments', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(9, 'create_customers', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(10, 'edit_customers', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(11, 'show_customers', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(12, 'delete_customers', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(13, 'permission_users', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(14, 'department_users', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(15, 'create_catalogs', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(16, 'edit_catalogs', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(17, 'show_catalogs', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(18, 'delete_catalogs', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(19, 'create_items', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(20, 'edit_items', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(21, 'show_items', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(22, 'delete_items', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(23, 'create_inventory', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(24, 'edit_inventory', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(25, 'show_inventory', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(26, 'delete_inventory', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(27, 'create_orders', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(28, 'edit_orders', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(29, 'show_orders', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(30, 'delete_orders', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(31, 'create_tasks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(32, 'edit_tasks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(33, 'show_tasks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(34, 'delete_tasks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(35, 'check_inventory', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(36, 'show_profits', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(37, 'edit_profiles', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(38, 'create_category', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(39, 'edit_category', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(40, 'show_category', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(41, 'delete_category', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(42, 'withdraw_inventory', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(43, 'create_buffets', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(44, 'edit_buffets', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(45, 'show_buffets', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(46, 'delete_buffets', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(47, 'create_fromchoices', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(48, 'edit_fromchoices', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(49, 'show_fromchoices', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(50, 'delete_fromchoices', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(51, 'create_department_tasks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(52, 'edit_department_tasks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(53, 'show_department_tasks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(54, 'delete_department_tasks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(55, 'show_mytasks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(56, 'change_tasks_status', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(57, 'show_statistics_users', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(58, 'show_statistics_customers', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(59, 'show_statistics_departments', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(60, 'show_statistics_departments_tasks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(61, 'show_statistics_catalogs', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(62, 'show_statistics_catalogs_items', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(63, 'show_statistics_inventory', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(64, 'show_statistics_orders', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(65, 'show_statistics_tasks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(66, 'show_statistics_my_tasks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(67, 'show_statistics_buffets', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(68, 'show_statistics_customers_choices', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(69, 'show_statistics_contacts', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(70, 'show_statistics_reviews', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(71, 'show_calendar_orders', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(72, 'show_calendar_tasks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(73, 'show_menu_dashboard', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(74, 'show_menu_users', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(75, 'show_menu_customers', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(76, 'show_menu_departments', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(77, 'show_menu_departments_tasks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(78, 'show_menu_inventory', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(79, 'show_menu_categories', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(80, 'show_menu_catalogs', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(81, 'show_menu_buffets', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(82, 'show_menu_customer_choices', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(83, 'show_menu_orders', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(84, 'show_menu_my_tasks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(85, 'show_menu_tasks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(86, 'show_menu_contactus', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(87, 'show_menu_settings', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(88, 'show_menu_social_media', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(89, 'show_statistics_withdraw', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(90, 'show_menu_withdraw', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(91, 'show_menu_feedbacks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(92, 'show_statistics_feedbacks', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(93, 'create_packages', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(94, 'edit_packages', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(95, 'show_packages', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(96, 'delete_packages', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(97, 'show_menu_packages', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(98, 'show_statistics_packages', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(99, 'create_packages_items', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(100, 'edit_packages_items', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(101, 'show_packages_items', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(102, 'delete_packages_items', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(103, 'create_contracts', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(104, 'edit_contracts', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(105, 'show_contracts', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(106, 'delete_contracts', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33'),
(107, 'show_menu_contracts', 'web', '2020-01-07 19:19:33', '2020-01-07 19:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2020-02-09 12:49:24', '2020-02-09 12:49:24');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(220) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `en_terms_conditions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ar_terms_conditions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `logo`, `description`, `subject`, `phone_number`, `email`, `currency`, `en_terms_conditions`, `ar_terms_conditions`, `keywords`, `created_at`, `updated_at`) VALUES
(1, 'Al Faisal', '1579970845.png', 'الفيصل للتجهيزات الغذائيه', 'Subject', '96560909902', 'info@alfaisalkw.com', 'KD', '<div class=\"breadcrumbs-wrap with-bg-img\" data-bg=\"images/about/1920x266_bg1.jpg\">\r\n<div class=\"container\">&nbsp;</div>\r\n</div>\r\n<div id=\"content\" class=\"page-content-wrap\">\r\n<div class=\"container\">\r\n<div class=\"content-element\">\r\n<div class=\"terms_condition\">\r\n<h2 style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: helvetica, arial, sans-serif;\"><strong>Terms &amp; Conditions</strong></span></h2>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\">fasel built the wedding planner app as a Commercial app. This SERVICE is provided by fasel and is intended for use as is.</span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\">This page is used to inform visitors regarding our policies with the collection, use, and disclosure of Personal Information if anyone decided to use our Service.</span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\">If you choose to use our Service, then you agree to the collection and use of information in relation to this policy. The Personal Information that we collect is used for providing and improving the Service. We will not use or share your information with anyone except as described in this Privacy Policy.</span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\">The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which is accessible at wedding planner unless otherwise defined in this Privacy Policy.</span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\"><strong>Information Collection and Use</strong></span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\">For a better experience, while using our Service, we may require you to provide us with certain personally identifiable information, including but not limited to ecommerc,wedding planner , event . The information that we request will be retained by us and used as described in this privacy policy.</span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\">The app does use third party services that may collect information used to identify you.</span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\">Link to privacy policy of third party service providers used by the app</span></p>\r\n<ul style=\"font-family: \'Times New Roman\';\">\r\n<li><span style=\"font-family: verdana, geneva, sans-serif;\"><a href=\"https://www.google.com/policies/privacy/\" target=\"_blank\" rel=\"noopener\">Google Play Services</a></span></li>\r\n</ul>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\"><strong>Log Data</strong></span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\">We want to inform you that whenever you use our Service, in a case of an error in the app we collect data and information (through third party products) on your phone called Log Data. This Log Data may include information such as your device Internet Protocol (&ldquo;IP&rdquo;) address, device name, operating system version, the configuration of the app when utilizing our Service, the time and date of your use of the Service, and other statistics.</span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\"><strong>Cookies</strong></span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\">Cookies are files with a small amount of data that are commonly used as anonymous unique identifiers. These are sent to your browser from the websites that you visit and are stored on your device\'s internal memory.</span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\">This Service does not use these &ldquo;cookies&rdquo; explicitly. However, the app may use third party code and libraries that use &ldquo;cookies&rdquo; to collect information and improve their services. You have the option to either accept or refuse these cookies and know when a cookie is being sent to your device. If you choose to refuse our cookies, you may not be able to use some portions of this Service.</span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\"><strong>Service Providers</strong></span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\">We may employ third-party companies and individuals due to the following reasons:</span></p>\r\n<ul style=\"font-family: \'Times New Roman\';\">\r\n<li><span style=\"font-family: verdana, geneva, sans-serif;\">To facilitate our Service;</span></li>\r\n<li><span style=\"font-family: verdana, geneva, sans-serif;\">To provide the Service on our behalf;</span></li>\r\n<li><span style=\"font-family: verdana, geneva, sans-serif;\">To perform Service-related services; or</span></li>\r\n<li><span style=\"font-family: verdana, geneva, sans-serif;\">To assist us in analyzing how our Service is used.</span></li>\r\n</ul>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\">We want to inform users of this Service that these third parties have access to your Personal Information. The reason is to perform the tasks assigned to them on our behalf. However, they are obligated not to disclose or use the information for any other purpose.</span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\"><strong>Security</strong></span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\">We value your trust in providing us your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable, and we cannot guarantee its absolute security.</span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\"><strong>Links to Other Sites</strong></span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\">This Service may contain links to other sites. If you click on a third-party link, you will be directed to that site. Note that these external sites are not operated by us. Therefore, we strongly advise you to review the Privacy Policy of these websites. We have no control over and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.</span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\"><strong>Children&rsquo;s Privacy</strong></span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\">These Services do not address anyone under the age of 13. We do not knowingly collect personally identifiable information from children under 13. In the case we discover that a child under 13 has provided us with personal information, we immediately delete this from our servers. If you are a parent or guardian and you are aware that your child has provided us with personal information, please contact us so that we will be able to do necessary actions.</span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\"><strong>Changes to This Privacy Policy</strong></span></p>\r\n<p style=\"font-family: \'Times New Roman\';\"><span style=\"font-family: verdana, geneva, sans-serif;\">We may update our Privacy Policy from time to time. Thus, you are advised to review this page periodically for any changes. We will notify you of any changes by posting the new Privacy Policy on this page. These changes are effective immediately after they are posted on this page.</span></p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '<h2 style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: helvetica, arial, sans-serif;\"><strong>Terms &amp; Conditions</strong></span></h2>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\">fasel built the wedding planner app as a Commercial app. This SERVICE is provided by fasel and is intended for use as is.</span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\">This page is used to inform visitors regarding our policies with the collection, use, and disclosure of Personal Information if anyone decided to use our Service.</span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\">If you choose to use our Service, then you agree to the collection and use of information in relation to this policy. The Personal Information that we collect is used for providing and improving the Service. We will not use or share your information with anyone except as described in this Privacy Policy.</span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\">The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which is accessible at wedding planner unless otherwise defined in this Privacy Policy.</span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\"><strong>Information Collection and Use</strong></span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\">For a better experience, while using our Service, we may require you to provide us with certain personally identifiable information, including but not limited to ecommerc,wedding planner , event . The information that we request will be retained by us and used as described in this privacy policy.</span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\">The app does use third party services that may collect information used to identify you.</span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\">Link to privacy policy of third party service providers used by the app</span></p>\r\n<ul style=\"font-family: \'Times New Roman\'; text-align: right;\">\r\n<li><span style=\"font-family: verdana, geneva, sans-serif;\"><a href=\"https://www.google.com/policies/privacy/\" target=\"_blank\" rel=\"noopener\">Google Play Services</a></span></li>\r\n</ul>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\"><strong>Log Data</strong></span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\">We want to inform you that whenever you use our Service, in a case of an error in the app we collect data and information (through third party products) on your phone called Log Data. This Log Data may include information such as your device Internet Protocol (&ldquo;IP&rdquo;) address, device name, operating system version, the configuration of the app when utilizing our Service, the time and date of your use of the Service, and other statistics.</span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\"><strong>Cookies</strong></span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\">Cookies are files with a small amount of data that are commonly used as anonymous unique identifiers. These are sent to your browser from the websites that you visit and are stored on your device\'s internal memory.</span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\">This Service does not use these &ldquo;cookies&rdquo; explicitly. However, the app may use third party code and libraries that use &ldquo;cookies&rdquo; to collect information and improve their services. You have the option to either accept or refuse these cookies and know when a cookie is being sent to your device. If you choose to refuse our cookies, you may not be able to use some portions of this Service.</span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\"><strong>Service Providers</strong></span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\">We may employ third-party companies and individuals due to the following reasons:</span></p>\r\n<ul style=\"font-family: \'Times New Roman\'; text-align: right;\">\r\n<li><span style=\"font-family: verdana, geneva, sans-serif;\">To facilitate our Service;</span></li>\r\n<li><span style=\"font-family: verdana, geneva, sans-serif;\">To provide the Service on our behalf;</span></li>\r\n<li><span style=\"font-family: verdana, geneva, sans-serif;\">To perform Service-related services; or</span></li>\r\n<li><span style=\"font-family: verdana, geneva, sans-serif;\">To assist us in analyzing how our Service is used.</span></li>\r\n</ul>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\">We want to inform users of this Service that these third parties have access to your Personal Information. The reason is to perform the tasks assigned to them on our behalf. However, they are obligated not to disclose or use the information for any other purpose.</span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\"><strong>Security</strong></span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\">We value your trust in providing us your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable, and we cannot guarantee its absolute security.</span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\"><strong>Links to Other Sites</strong></span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\">This Service may contain links to other sites. If you click on a third-party link, you will be directed to that site. Note that these external sites are not operated by us. Therefore, we strongly advise you to review the Privacy Policy of these websites. We have no control over and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.</span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\"><strong>Children&rsquo;s Privacy</strong></span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\">These Services do not address anyone under the age of 13. We do not knowingly collect personally identifiable information from children under 13. In the case we discover that a child under 13 has provided us with personal information, we immediately delete this from our servers. If you are a parent or guardian and you are aware that your child has provided us with personal information, please contact us so that we will be able to do necessary actions.</span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\"><strong>Changes to This Privacy Policy</strong></span></p>\r\n<p style=\"font-family: \'Times New Roman\'; text-align: right;\"><span style=\"font-family: verdana, geneva, sans-serif;\">We may update our Privacy Policy from time to time. Thus, you are advised to review this page periodically for any changes. We will notify you of any changes by posting the new Privacy Policy on this page. These changes are effective immediately after they are posted on this page.</span></p>', 'Keywords', NULL, '2020-02-03 09:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `soical_media`
--

CREATE TABLE `soical_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soical_media`
--

INSERT INTO `soical_media` (`id`, `facebook`, `twitter`, `instagram`, `created_at`, `updated_at`) VALUES
(1, 'https://www.facebook.com/', 'https://www.twitter.com/', 'https://www.instagram.com/', NULL, '2020-01-25 14:41:41');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `order_data_id` bigint(20) UNSIGNED NOT NULL,
  `department_task_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `order_task` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `task_date` datetime NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` bigint(11) UNSIGNED NOT NULL,
  `ar_name` varchar(255) NOT NULL,
  `en_name` varchar(255) NOT NULL,
  `ar_desc` text NOT NULL,
  `en_desc` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `ar_name`, `en_name`, `ar_desc`, `en_desc`, `created_at`, `updated_at`) VALUES
(2, 'aaaa', 'aaaa', '<p>aaaa</p>', '<p>aaaa</p>', '2020-03-11 09:53:06', '2020-03-11 09:53:06'),
(3, 'sdadsa', 'ewqdw', '<p>dasdsad</p>', '<p>dasdsad</p>', '2020-03-11 09:53:23', '2020-03-11 13:34:14'),
(4, 'sdadsa', 'ewqdw', '<p>dasdsad</p>', '<p>dasdsad</p>', '2020-03-11 09:54:19', '2020-03-11 10:05:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(9, 'Admin', 'admin@admin.com', '01117725721', NULL, '$2y$10$dpiFrsXmxekkPQ1Ey8QDzugV7cq8lHgytw1jm2QDADrP1/PUp2RFa', NULL, '2020-01-09 17:31:06', '2020-01-18 11:22:19'),
(24, 'shimaa khair', 'shimaa.khair@quantumsit', '01152144344', NULL, '$2y$10$LizcKFxKZsHEs4scZR6nXOwAPMi0KRrLTbIqM4Zd8wnxOfYLF/9Cm', NULL, '2020-02-09 11:35:07', '2020-02-09 12:56:57'),
(28, 'ahmed', 'ahmed@aa.com', '01117725721', NULL, '$2y$10$JwGo.FH/8vklGZWd5aQRa.7K8CuED.uN0LT0Ovo24HqD1SXYlr9qS', NULL, '2020-02-09 12:42:11', '2020-02-09 12:42:11'),
(29, 'ismail', 'ismail.elshafeiy@gmail.com', '01005111998', NULL, '$2y$10$9wp8jrE2P/C4iXNaTnAWc.N5cXexbd4RJHwi0NxbsTJUaWcbd/h9S', NULL, '2020-02-09 12:47:33', '2020-02-09 13:10:16'),
(30, 'yasser', 'yasser@gmail.com', '01155155151', NULL, '$2y$10$91npA6iJ/COPha0hjEnGje1DVcvmGajKHrz92oyahKWtp1Zuxs3/q', NULL, '2020-02-09 13:20:55', '2020-02-09 13:20:55'),
(31, 'shimaa test', 'shimaa815@gmail.com', '01156987522', NULL, '$2y$10$UIqVy08KWQsfpnjcB5EkBuPe5qemSUDsgZFqi.2nt4U/G7RN3AmSy', NULL, '2020-02-09 13:26:59', '2020-02-09 13:38:08'),
(32, 'nahlaebrahim', 'nahlaehrahim@gmail.com', '01068109434', NULL, '$2y$10$Jzl6iENkb0unM67a7S0piOUhF4sILDYFU1f6CG6SPpEsgbGyK1V92', NULL, '2020-02-10 10:44:08', '2020-02-10 10:44:08'),
(40, 'Ahmed Ramdan', 'ahmed@ahmed.com', '01117725721', NULL, '$2y$10$WsVZQPyKmhJDJj9gPRKGueC/v2PB72Ff1jFp8sVXmFyY8X1ag5NxW', NULL, '2020-02-14 07:41:07', '2020-02-14 07:41:07'),
(41, 'Ahmed Ramdan', 'ram@ahmed.c', '01117725721', NULL, '$2y$10$sZhbRBuZn/3W1M8bwN5E6.35q0sdM2XVdGGCszqrVD9BIqeyehdzW', NULL, '2020-02-14 07:41:51', '2020-02-14 07:41:51');

-- --------------------------------------------------------

--
-- Table structure for table `user_deartments`
--

CREATE TABLE `user_deartments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_deartments`
--

INSERT INTO `user_deartments` (`id`, `user_id`, `department_id`, `created_at`, `updated_at`) VALUES
(2, 9, 3, '2020-02-14 07:41:51', '2020-02-14 07:41:51'),
(6, 41, 3, '2020-02-14 07:41:51', '2020-02-14 07:41:51'),
(7, 41, 4, '2020-02-14 07:41:51', '2020-02-14 07:41:51'),
(8, 41, 6, '2020-02-14 07:41:51', '2020-02-14 07:41:51'),
(11, 32, 2, '2020-04-07 12:10:02', '2020-04-07 12:10:02'),
(12, 40, 2, '2020-04-07 12:10:02', '2020-04-07 12:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

CREATE TABLE `withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buffets`
--
ALTER TABLE `buffets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buffets_categories_id_foreign` (`categories_id`),
  ADD KEY `buffets_iteminventory_id_foreign` (`iteminventory_id`);

--
-- Indexes for table `buffetsitems`
--
ALTER TABLE `buffetsitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_iteminventory_id` (`iteminventory_id`),
  ADD KEY `foreign_buffet_id` (`buffet_id`);

--
-- Indexes for table `buffet_gallery`
--
ALTER TABLE `buffet_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buffet_gallery_id` (`buffet_id`);

--
-- Indexes for table `catalogitems`
--
ALTER TABLE `catalogitems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_item_inventory_id` (`iteminventory_id`),
  ADD KEY `foreign_catalog_id` (`catalog_id`);

--
-- Indexes for table `catalogitems_gallery`
--
ALTER TABLE `catalogitems_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_catalogitem_id` (`catalogitem_id`);

--
-- Indexes for table `catalogs`
--
ALTER TABLE `catalogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catalog_catergory_id_foregin_key` (`categories_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contract_terms`
--
ALTER TABLE `contract_terms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contract_contract_id_foregin` (`contract_id`),
  ADD KEY `contract_terms_id_foregin` (`terms_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD KEY `customers_user_id_foregin_key` (`user_id`);

--
-- Indexes for table `customer_files`
--
ALTER TABLE `customer_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_files_user_data_id_foreign` (`customer_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_tasks`
--
ALTER TABLE `department_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_tasks_department_id_foreign` (`department_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fromchoices_gallery`
--
ALTER TABLE `fromchoices_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fromchoice_gallery_id` (`fromchoice_id`);

--
-- Indexes for table `from_choices`
--
ALTER TABLE `from_choices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_choices_categories_id_foreign` (`categories_id`);

--
-- Indexes for table `from_choice_items`
--
ALTER TABLE `from_choice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_choice_items_from_choices_id_foreign` (`from_choices_id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventory_user` (`user_id`);

--
-- Indexes for table `item_inventory`
--
ALTER TABLE `item_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_orders`
--
ALTER TABLE `main_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobiles_codes`
--
ALTER TABLE `mobiles_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_orders_id` (`mainorder_id`);

--
-- Indexes for table `order__reviews`
--
ALTER TABLE `order__reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order__reviews_order_id_foreign` (`order_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_category_id` (`category_id`);

--
-- Indexes for table `packages_items`
--
ALTER TABLE `packages_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_item_package_id` (`package_id`),
  ADD KEY `package_iteminventory_id_foreign` (`iteminventory_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soical_media`
--
ALTER TABLE `soical_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`),
  ADD KEY `tasks_order_id_foreign` (`order_id`),
  ADD KEY `tasks_catalog_id_foreign` (`department_task_id`),
  ADD KEY `tasks_department_id_foreign` (`department_id`),
  ADD KEY `tasks_order_data_id_foreign` (`order_data_id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_deartments`
--
ALTER TABLE `user_deartments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_deartments_user_id_foreign` (`user_id`),
  ADD KEY `user_deartments_department_id_foreign` (`department_id`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buffets`
--
ALTER TABLE `buffets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `buffetsitems`
--
ALTER TABLE `buffetsitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buffet_gallery`
--
ALTER TABLE `buffet_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `catalogitems`
--
ALTER TABLE `catalogitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `catalogitems_gallery`
--
ALTER TABLE `catalogitems_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catalogs`
--
ALTER TABLE `catalogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123106;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contract_terms`
--
ALTER TABLE `contract_terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `customer_files`
--
ALTER TABLE `customer_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department_tasks`
--
ALTER TABLE `department_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fromchoices_gallery`
--
ALTER TABLE `fromchoices_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `from_choices`
--
ALTER TABLE `from_choices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `from_choice_items`
--
ALTER TABLE `from_choice_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `item_inventory`
--
ALTER TABLE `item_inventory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `main_orders`
--
ALTER TABLE `main_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `mobiles_codes`
--
ALTER TABLE `mobiles_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order__reviews`
--
ALTER TABLE `order__reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `packages_items`
--
ALTER TABLE `packages_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `soical_media`
--
ALTER TABLE `soical_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user_deartments`
--
ALTER TABLE `user_deartments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buffets`
--
ALTER TABLE `buffets`
  ADD CONSTRAINT `buffets_iteminventory_id_foreign` FOREIGN KEY (`iteminventory_id`) REFERENCES `item_inventory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_category_id` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buffetsitems`
--
ALTER TABLE `buffetsitems`
  ADD CONSTRAINT `foreign_buffet_id` FOREIGN KEY (`buffet_id`) REFERENCES `buffets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_iteminventory_id` FOREIGN KEY (`iteminventory_id`) REFERENCES `item_inventory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `buffet_gallery`
--
ALTER TABLE `buffet_gallery`
  ADD CONSTRAINT `buffet_gallery_id` FOREIGN KEY (`buffet_id`) REFERENCES `buffets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `catalogitems`
--
ALTER TABLE `catalogitems`
  ADD CONSTRAINT `foreign_catalog_id` FOREIGN KEY (`catalog_id`) REFERENCES `catalogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_item_inventory_id` FOREIGN KEY (`iteminventory_id`) REFERENCES `item_inventory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `catalogitems_gallery`
--
ALTER TABLE `catalogitems_gallery`
  ADD CONSTRAINT `foreign_catalogitem_id` FOREIGN KEY (`catalogitem_id`) REFERENCES `catalogitems` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `catalogs`
--
ALTER TABLE `catalogs`
  ADD CONSTRAINT `catalog_catergory_id_foregin_key` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contract_terms`
--
ALTER TABLE `contract_terms`
  ADD CONSTRAINT `contract_contract_id_foregin` FOREIGN KEY (`contract_id`) REFERENCES `contract` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contract_terms_id_foregin` FOREIGN KEY (`terms_id`) REFERENCES `terms` (`id`);

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foregin_key` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_files`
--
ALTER TABLE `customer_files`
  ADD CONSTRAINT `user_files_user_data_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `department_tasks`
--
ALTER TABLE `department_tasks`
  ADD CONSTRAINT `department_tasks_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fromchoices_gallery`
--
ALTER TABLE `fromchoices_gallery`
  ADD CONSTRAINT `fromchoice_gallery_id` FOREIGN KEY (`fromchoice_id`) REFERENCES `from_choice_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `from_choices`
--
ALTER TABLE `from_choices`
  ADD CONSTRAINT `from_choices_categories_id_foreign` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `from_choice_items`
--
ALTER TABLE `from_choice_items`
  ADD CONSTRAINT `from_choice_items_from_choices_id_foreign` FOREIGN KEY (`from_choices_id`) REFERENCES `from_choices` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventory_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `foreign_orders_id` FOREIGN KEY (`mainorder_id`) REFERENCES `main_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order__reviews`
--
ALTER TABLE `order__reviews`
  ADD CONSTRAINT `order__reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `packages`
--
ALTER TABLE `packages`
  ADD CONSTRAINT `package_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `packages_items`
--
ALTER TABLE `packages_items`
  ADD CONSTRAINT `package_item_package_id` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `package_iteminventory_id_foreign` FOREIGN KEY (`iteminventory_id`) REFERENCES `item_inventory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_catalog_id_foreign` FOREIGN KEY (`department_task_id`) REFERENCES `department_tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_order_data_id_foreign` FOREIGN KEY (`order_data_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `main_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_deartments`
--
ALTER TABLE `user_deartments`
  ADD CONSTRAINT `user_deartments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_deartments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
