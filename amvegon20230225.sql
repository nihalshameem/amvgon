-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2023 at 04:37 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amvegon`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `door_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `village` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tirunelveli',
  `pincode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tamil nadu',
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'india',
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `customer_id`, `door_no`, `village`, `district`, `pincode`, `state`, `country`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 1, '145,asure street', 'mpm', '1', '627006', 'tamil nadu', 'india', NULL, NULL, '2020-09-25 06:45:48', '2020-09-25 07:05:58'),
(9, 4, 'Thaai Nagar, Melapalaym, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.695046932726703', '77.71801237016916', '2020-10-29 22:53:52', '2020-10-29 22:53:52'),
(10, 4, 'raja nagar 5th street, Ambai Rd, Veeramanikapuram, Melapalayam, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.70051636300935', '77.71601881831884', '2020-10-29 23:15:59', '2020-10-29 23:15:59'),
(11, 4, '11, Xavier Colony, Vasanth Nagar, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.702217858871116', '77.72540554404259', '2020-10-29 23:41:26', '2020-10-29 23:41:26'),
(12, 4, 'Pappanodai, Tamil Nadu, India', 'NONE', '1', 'null', 'tamil nadu', 'india', '9.830891443806978', '78.11849299818277', '2020-10-30 08:52:12', '2020-10-30 08:52:12'),
(13, 8, 'Thaai Nagar, Melapalaym, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.694573329268078', '77.7181126177311', '2020-10-30 20:16:02', '2020-10-30 20:16:02'),
(24, 10, 'Unnamed Road, Shanthi Nagar, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.707159908171786', '77.72218085825443', '2020-11-24 21:48:13', '2020-11-24 21:48:13'),
(23, 10, '2nd St, Raja Nagar, Melapalayam, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.696666923795432', '77.71888744086027', '2020-11-24 21:46:51', '2020-11-24 21:46:51'),
(22, 10, '84, Voc 1st St, Mullai Nagar, Poonthamalli Nagar, Madurai, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.945293932967186', '78.12055360525845', '2020-11-24 21:41:18', '2020-11-24 21:41:18'),
(33, 13, '26, Mahal 3rd St, Mahal Area, Madurai Main, Madurai, Tamil Nadu 625001, India', 'NONE', '1', '625001', 'tamil nadu', 'india', '9.915090955561594', '78.12325425446033', '2021-01-02 11:24:43', '2021-01-02 11:24:43'),
(19, 14, 'Kalpalam, Kochi - Madurai - Dhanushkodi Rd, Simmakkal, Madurai Main, Madurai, Tamil Nadu 625001, India', 'NONE', '1', '625001', 'tamil nadu', 'india', '9.927852940273715', '78.12495343387127', '2020-11-08 17:56:38', '2020-11-08 17:56:38'),
(20, 15, '1st street, Suyarajyapuram 2nd East Main Rd, Sellur, Madurai, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.932648546393004', '78.1247928366065', '2020-11-24 12:24:57', '2020-11-24 12:24:57'),
(26, 10, 'Unnamed Road, Pudur, Tamil Nadu 624401, India', 'NONE', '1', '624401', 'tamil nadu', 'india', '10.131684194294447', '78.17425444722174', '2020-11-24 22:31:38', '2020-11-24 22:31:38'),
(27, 17, '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '2020-12-10 16:41:29', '2020-12-10 16:41:29'),
(28, 18, '15, Raja NagarTallakulam', 'NONE', '1', '625020', 'tamil nadu', 'india', '9.922873', '78.1522842', '2020-12-22 18:33:37', '2020-12-22 18:33:37'),
(29, 1, '145 sappani east street', 'Melapalaym', '1', '627004', 'tamil nadu', 'india', '9.9252007', '78.1197754', '2020-12-23 15:55:15', '2021-01-11 20:59:47'),
(30, 1, 'new one', 'palayamkottai', '1', '627004', 'tamil nadu', 'india', NULL, NULL, '2020-12-23 15:56:50', '2020-12-23 15:56:50'),
(31, 21, '15, 2nd street, bibikulam', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.9363612', '78.13305679999999', '2020-12-31 09:13:23', '2020-12-31 09:13:23'),
(32, 22, '15 reajanagarmelapalayam', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.698763999999999', '77.7148289', '2020-12-31 16:20:51', '2020-12-31 16:20:51'),
(34, 23, '9-7/19 kambar cross st, viswananathapuramMadurai', 'NONE', '1', '625014', 'tamil nadu', 'india', '9.9960246', '78.1393397', '2021-01-09 01:35:33', '2021-01-09 01:35:33'),
(35, 1, 'Avaniyapuram Main Road', 'Villapuram', '1', '625012', 'tamil nadu', 'india', '9.8803549', '78.1135285', '2021-01-11 20:58:53', '2021-01-11 20:58:53'),
(36, 13, '15', 'anna nagar', '1', '627011', 'tamil nadu', 'india', '9.919494', '78.150942', '2021-01-11 21:49:14', '2021-01-11 21:49:14'),
(37, 24, '15, prasath street, nehru vidhya Salai backside,Narimedu', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.934933299999999', '78.12713409999999', '2021-02-05 17:30:32', '2021-02-05 17:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(600) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `image`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'nihal', 'nihalshameem6@gmail.com', '7397134351', '/images/profile/1.jpeg', '$2y$10$9yHCeBxNmPKbhizVo5qb2OnnYr5V9lxfh944F5qiTNTriTwXKKc/W', 'SuperAdmin', '2020-09-21 21:53:00', '2020-11-28 12:04:28'),
(2, 'Delivery Manager', 'deliveryadmin1@gmail.com', '7397134352', NULL, '$2y$10$irCEgT1IaoUlCADoOaIXMuVHyrIAg7fwbfDXQDA0SoAw5D22qVfZK', 'DeliveryAdmin', NULL, '2020-11-28 12:13:50'),
(3, 'Order Manager', 'orderadmin1@gmail.com', '7397134353', NULL, '$2y$10$H0Fbm3IGu4EUyfwHmqiNzubag0nidDzj4o766y/tzZTs.4PAmAWMW', 'OrderAdmin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE `admin_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_id` varchar(1050) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `admin_id`, `device_id`, `created_at`, `updated_at`) VALUES
(7, '1', 'c58AjBExTSStEErM3f6SJa:APA91bEQ_KppbmEK-S1riIXsQU5J4LNsXtwHq1Mj510_n0cXNme1-cSGXqeE6RHVyjn0hNav_OkgajtUlywymWse5wQSBDWIkydV12WkdrlotIvzWhK02qZp6jgVYgjP5-FQuqlMyMXY', '2020-12-17 16:17:55', '2020-12-17 16:17:55'),
(8, '1', 'f2HGYqm5QSKROp4B0Z1g1P:APA91bFJWK12DM8Icw_-YrlHCsQ5rdRauhD87uUwfrTS1fKkR0JF3jS4yJHxvI69hFenggGMqqwBZOR1JmxsT7m7qrs4_sRCZn24IY9yOPWiRC57YCifttboCb0ZudxdHTHFJtH1pAYZ', '2020-12-25 16:40:15', '2020-12-25 16:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `amount_incentives`
--

CREATE TABLE `amount_incentives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `percent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `name`, `image`, `status`, `link`, `created_at`, `updated_at`) VALUES
(2, 'banner 1', '/images/banners/2.jpg', 1, NULL, '2020-09-25 04:51:52', '2020-12-17 16:38:29'),
(3, 'banner 2', '/images/banners/3.jpg', 1, NULL, '2020-09-25 05:45:50', '2021-02-06 15:06:52'),
(4, 'banner 3', '/images/banners/4.jpg', 1, NULL, '2020-09-25 05:50:13', '2021-02-06 15:07:28'),
(5, 'banner 4', '/images/banners/5.png', 1, NULL, '2020-09-25 05:54:48', '2021-02-12 21:58:20'),
(6, 'banner 5', '/images/banners/6.jpg', 1, NULL, '2020-09-25 06:01:41', '2020-12-18 10:07:02'),
(7, 'banner 6', '/images/banners/7.jpg', 1, NULL, '2020-09-25 06:05:03', '2021-02-06 15:08:50'),
(9, 'B7', '/images/banners/9.jpg', 1, NULL, '2021-02-15 11:52:05', '2021-02-15 12:40:55'),
(21, 'B8', '/images/banners/21.jpg', 1, NULL, '2021-02-15 14:55:39', '2021-02-15 15:07:53'),
(20, 'B9', '/images/banners/20.jpg', 1, NULL, '2021-02-15 14:55:22', '2021-02-15 15:08:35'),
(11, 'B10', '/images/banners/11.jpg', 1, NULL, '2021-02-15 12:42:27', '2021-02-15 15:09:22'),
(12, 'B11', '/images/banners/12.jpg', 1, NULL, '2021-02-15 12:56:13', '2021-02-15 15:11:24'),
(13, 'B12', '/images/banners/13.jpg', 1, NULL, '2021-02-15 12:56:33', '2021-02-15 15:12:27'),
(14, 'B13', '/images/banners/14.jpg', 1, NULL, '2021-02-15 12:56:57', '2021-02-15 15:13:02'),
(15, 'B14', '/images/banners/15.jpg', 1, NULL, '2021-02-15 12:57:39', '2021-02-15 15:13:33'),
(16, 'B15', '/images/banners/16.jpg', 1, NULL, '2021-02-15 12:57:57', '2021-02-15 15:13:58'),
(17, 'B16', '/images/banners/17.jpg', 1, NULL, '2021-02-15 12:58:16', '2021-02-15 15:14:26'),
(18, 'B17', '/images/banners/18.jpg', 1, NULL, '2021-02-15 12:58:33', '2021-02-15 15:14:51'),
(19, 'B18', '/images/banners/19.jpeg', 1, NULL, '2021-02-15 12:58:53', '2021-02-15 15:15:20'),
(22, 'B19', '/images/banners/22.jpg', 1, NULL, '2021-02-15 14:56:25', '2021-02-15 15:15:50'),
(23, 'B20', '/images/banners/23.jpg', 1, NULL, '2021-02-15 14:56:48', '2021-02-15 15:16:17'),
(24, 'B21', '/images/banners/24.jpg', 1, NULL, '2021-02-15 14:57:09', '2021-02-15 15:16:39'),
(25, 'B22', '/images/banners/25.jpg', 1, NULL, '2021-02-15 14:57:38', '2021-02-15 14:57:56'),
(26, 'B23', '/images/banners/IMG-20210215-WA0086.jpg', 1, NULL, '2021-02-15 14:58:34', '2021-02-15 14:58:34'),
(27, 'B24', '/images/banners/27.jpg', 1, NULL, '2021-02-15 14:58:58', '2021-02-15 15:17:00'),
(41, 'B25', '/images/banners/41.jpg', 1, NULL, '2021-02-15 15:18:24', '2021-02-15 15:19:49'),
(28, 'B26', '/images/banners/28.jpg', 1, NULL, '2021-02-15 14:59:34', '2021-02-15 15:20:11'),
(29, 'B27', '/images/banners/29.jpg', 1, NULL, '2021-02-15 14:59:56', '2021-02-15 15:20:37'),
(30, 'B28', '/images/banners/30.jpg', 1, NULL, '2021-02-15 15:00:33', '2021-02-15 15:21:02'),
(31, 'B29', '/images/banners/31.jpg', 1, NULL, '2021-02-15 15:01:34', '2021-02-15 15:21:26'),
(32, 'B30', '/images/banners/32.jpg', 1, NULL, '2021-02-15 15:01:56', '2021-02-15 15:21:46'),
(33, 'B31', '/images/banners/33.jpg', 1, NULL, '2021-02-15 15:02:32', '2021-02-15 15:22:20'),
(34, 'B32', '/images/banners/34.jpg', 1, NULL, '2021-02-15 15:03:03', '2021-02-15 15:22:40'),
(35, 'B33', '/images/banners/35.jpg', 1, NULL, '2021-02-15 15:03:27', '2021-02-15 15:23:30'),
(36, 'B34', '/images/banners/36.jpg', 1, NULL, '2021-02-15 15:03:51', '2021-02-15 15:24:50'),
(37, 'B35', '/images/banners/37.jpg', 1, NULL, '2021-02-15 15:04:10', '2021-02-15 15:25:12'),
(38, 'B36', '/images/banners/38.jpg', 1, NULL, '2021-02-15 15:04:27', '2021-02-15 15:25:44'),
(39, 'B37', '/images/banners/39.jpg', 1, NULL, '2021-02-15 15:04:53', '2021-02-15 15:26:05'),
(40, 'B38', '/images/banners/40.jpg', 1, NULL, '2021-02-15 15:05:17', '2021-02-15 15:26:28'),
(42, 'B39', '/images/banners/42.jpg', 1, NULL, '2021-02-15 15:27:08', '2021-02-15 15:27:45'),
(43, 'B40', '/images/banners/IMG-20210215-WA0063.jpg', 1, NULL, '2021-02-15 15:28:22', '2021-02-15 15:28:33'),
(44, 'B41', '/images/banners/IMG-20210215-WA0062.jpg', 1, NULL, '2021-02-15 15:28:59', '2021-02-15 15:28:59'),
(45, 'B42', '/images/banners/IMG-20210215-WA0061.jpg', 1, NULL, '2021-02-15 15:29:34', '2021-02-15 15:29:34'),
(46, 'B43', '/images/banners/46.jpeg', 1, NULL, '2021-02-15 15:30:04', '2021-02-15 16:24:08'),
(47, 'B44', '/images/banners/47.jpg', 1, NULL, '2021-02-15 15:30:33', '2021-02-15 15:42:07'),
(48, 'B45', '/images/banners/IMG-20210215-WA0057.jpg', 1, NULL, '2021-02-15 15:30:56', '2021-02-15 15:30:56'),
(49, 'B46', '/images/banners/IMG-20210215-WA0056.jpg', 1, NULL, '2021-02-15 15:31:29', '2021-02-15 15:31:29'),
(50, 'B47', '/images/banners/IMG-20210215-WA0054.jpg', 1, NULL, '2021-02-15 15:31:53', '2021-02-15 15:31:53'),
(51, 'B48', '/images/banners/51.jpg', 1, NULL, '2021-02-15 15:32:19', '2021-02-15 15:32:48'),
(52, 'B49', '/images/banners/IMG-20210215-WA0031.jpg', 1, NULL, '2021-02-15 15:33:16', '2021-02-15 15:33:16'),
(53, 'B50', '/images/banners/IMG-20210215-WA0032.jpg', 1, NULL, '2021-02-15 15:33:39', '2021-02-15 15:33:39'),
(54, 'B51', '/images/banners/IMG-20210215-WA0033.jpg', 1, NULL, '2021-02-15 15:34:10', '2021-02-15 15:34:10'),
(55, 'B52', '/images/banners/55.jpg', 1, NULL, '2021-02-15 15:34:33', '2021-02-15 16:19:36'),
(56, 'B53', '/images/banners/56.jpeg', 1, NULL, '2021-02-15 15:35:15', '2021-02-15 16:24:44'),
(57, 'B54', '/images/banners/IMG-20210215-WA0036.jpg', 1, NULL, '2021-02-15 15:35:39', '2021-02-15 15:35:39'),
(58, 'B55', '/images/banners/IMG-20210215-WA0037.jpg', 1, NULL, '2021-02-15 15:36:01', '2021-02-15 15:36:01'),
(59, 'B56', '/images/banners/IMG-20210215-WA0048.jpg', 1, NULL, '2021-02-15 15:42:44', '2021-02-15 15:42:44'),
(60, 'B57', '/images/banners/IMG-20210215-WA0052.jpg', 1, NULL, '2021-02-15 15:43:15', '2021-02-15 15:43:15'),
(61, 'B58', '/images/banners/61.jpg', 1, NULL, '2021-02-15 15:43:53', '2021-02-15 16:20:03'),
(62, 'B59', '/images/banners/istockphoto-681117656-612x612.jpg', 1, NULL, '2021-02-15 15:44:51', '2021-02-15 15:45:03'),
(63, 'B60', '/images/banners/IMG-20210215-WA0037.jpg', 1, NULL, '2021-02-15 15:45:33', '2021-02-15 15:45:33'),
(64, 'B61', '/images/banners/gettyimages-1175981932-612x612.jpg', 1, NULL, '2021-02-15 15:46:26', '2021-02-15 15:46:26'),
(65, 'B62', '/images/banners/gettyimages-1002917362-612x612.jpg', 1, NULL, '2021-02-15 15:46:51', '2021-02-15 15:46:51'),
(66, 'B63', '/images/banners/66.jpeg', 1, NULL, '2021-02-15 15:47:18', '2021-02-15 16:25:21'),
(67, 'B64', '/images/banners/img-2.jpeg', 1, NULL, '2021-02-15 15:47:51', '2021-02-15 15:47:51'),
(68, 'B65', '/images/banners/IMG-20210215-WA0089.jpg', 1, NULL, '2021-02-15 15:48:26', '2021-02-15 15:48:26'),
(69, 'B66', '/images/banners/69.jpg', 1, NULL, '2021-02-15 15:50:28', '2021-02-15 15:51:50'),
(70, 'B67', '/images/banners/farmer-in-indonesian-village.jpg', 1, NULL, '2021-02-15 15:56:43', '2021-02-15 15:56:43'),
(71, 'B68', '/images/banners/dc06b5d2cb37b1309ccfe96b99a8ba55.jpg', 1, NULL, '2021-02-15 15:57:03', '2021-02-15 15:57:03'),
(72, 'B69', '/images/banners/72.jpg', 1, NULL, '2021-02-15 15:57:19', '2021-02-15 16:09:18'),
(73, 'B70', '/images/banners/73.jpg', 1, NULL, '2021-02-15 15:57:43', '2021-02-15 15:58:17');

-- --------------------------------------------------------

--
-- Table structure for table `bonuses`
--

CREATE TABLE `bonuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bonus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `qty` decimal(5,2) NOT NULL,
  `price_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `combo_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `customer_id`, `product_id`, `qty`, `price_type`, `combo_id`, `created_at`, `updated_at`) VALUES
(53, 8, 8, '0.60', 'standard', NULL, '2020-10-30 19:34:02', '2020-10-30 19:36:17'),
(54, 9, 8, '0.40', 'standard', NULL, '2020-10-30 20:22:41', '2020-10-30 20:23:05'),
(55, 9, 7, '0.10', 'normal', NULL, '2020-10-30 20:22:53', '2020-10-30 20:22:53'),
(173, 10, 8, '0.10', 'standard', NULL, '2020-12-17 14:35:31', '2020-12-17 14:35:31'),
(180, 17, 7, '1.00', 'standard', NULL, '2020-12-21 08:12:07', '2020-12-22 08:23:13'),
(181, 17, 8, '10.00', 'excellent', NULL, '2020-12-22 08:04:28', '2020-12-22 08:23:37'),
(182, 17, NULL, '1.00', 'normal', 8, '2020-12-22 08:27:13', '2020-12-22 08:39:11'),
(186, 19, 7, '0.10', 'normal', NULL, '2020-12-23 08:59:16', '2020-12-23 08:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `image`, `name`, `created_at`, `updated_at`) VALUES
(3, '/images/category/3.jpg', 'Function', '2020-10-01 05:57:30', '2020-12-04 09:29:04'),
(5, '/images/category/5.png', 'Hotel', '2020-10-14 11:09:32', '2020-12-17 17:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `combo_details`
--

CREATE TABLE `combo_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `combo_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `combo_details`
--

INSERT INTO `combo_details` (`id`, `combo_id`, `product_id`, `type`, `created_at`, `updated_at`) VALUES
(10, 8, 42, 'normal', '2020-11-20 12:49:54', '2020-12-17 17:21:48'),
(11, 8, 41, 'standard', '2020-11-20 12:49:54', '2020-12-17 17:21:48'),
(12, 9, 43, 'normal', '2020-11-20 12:50:20', '2020-11-20 12:50:20'),
(13, 9, 40, 'normal', '2020-11-20 12:50:20', '2020-11-20 12:50:20'),
(14, 10, 41, 'normal', '2020-11-20 22:57:10', '2020-11-20 22:57:10'),
(15, 10, 54, 'standard', '2020-11-20 22:57:10', '2020-11-20 22:57:10'),
(16, 10, 43, 'excellent', '2020-11-20 22:57:10', '2020-11-20 22:57:10');

-- --------------------------------------------------------

--
-- Table structure for table `combo_products`
--

CREATE TABLE `combo_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` int(11) NOT NULL,
  `product_count` int(11) NOT NULL,
  `expiry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `combo_products`
--

INSERT INTO `combo_products` (`id`, `name`, `image`, `discount`, `product_count`, `expiry_date`, `created_at`, `updated_at`) VALUES
(8, 'new combo', '/images/combos/8.png', 10, 2, '2020-12-30 00:00:00', '2020-11-20 12:49:54', '2020-12-26 20:31:51'),
(9, 'new combo', '/images/combos/9.jpg', 10, 2, '2020-12-30 00:00:00', '2020-11-20 12:50:20', '2020-12-22 22:26:48'),
(10, 'demo combo', '/images/combos/10.jpg', 30, 3, '2020-12-30 00:00:00', '2020-11-20 22:57:10', '2020-12-17 17:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `name`, `code`, `image`, `min_price`, `max_price`, `discount`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(5, 'Coupon', 'SMS20', '/images/coupons/5.png', '50', '100', '20', '2020-12-03', '2020-12-16', '2020-12-04 14:30:45', '2020-12-05 15:05:36'),
(6, 'Sms', 'SMS2', '/images/coupons/6.jpg', '50', '100', '10', '2020-12-11', '2020-12-26', '2020-12-11 17:35:38', '2020-12-11 17:35:38');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/images/cutomers/no_image.png',
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` char(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notification_id` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `image`, `email`, `phone`, `password`, `api_token`, `notification_id`, `created_at`, `updated_at`) VALUES
(1, 'nihal', 'shameem', '/images/customers/1.jpeg', 'nihalshameem6@gmail.com', '7397134351', '$2y$10$EHQRccEz2IifT9ds5j866uSpvZJB1UjMPbvDgrOc3Acv2mqbpsT4C', '1dt8nZgPzyk6rP2vF4A35LOV2Xo62dZpgdlLuFXtXyNP8NPBAK4zC5CPH3VS', 'e0ajrKycQYeWLZXgKyWYqJ:APA91bHtO0DsQ2Wk_xL23wnP7IAsNlmFShMtDQxNeO9QU-uDRLE6LHXF86jzLR5esruB-kJXGK1TF4lumFiKi5rOiMaFZHwsbyRfSqMBXu4S-IhgoWnQOXHLLhwUlBxcxPH1ZKoOoYyL', '2020-09-20 19:36:06', '2021-01-12 13:12:29'),
(2, 'shameem', 'nihal', '/images/cutomers/no_image.png', 'nihalshameem7@gmail.com', '7397134352', '$2y$10$gzFZHQFD1X0paetTcpn2mehnnjmFCuNS8LVLyCN6Q5RIyQk3ts5PK', 'm2gsKTM5eHMOtKWGRZEpnYWwEND73lXD4ZGumUpvsKyIgWAeAA7KHD1x03HU', NULL, '2020-09-20 19:36:06', '2020-09-26 01:16:36'),
(10, 'Sheik', 'Madhar', '/images/cutomers/no_image.png', 'madharsheik3@gmail.com', '8610866200', '$2y$10$e1q50VxsS34pr9S8U/togezD0wEX8f4/ouMnyvOR4KngVp29XfRCC', '10YdiXkGlhwFAmWyab8a8lUDmiIsWx3JRD4Y91bFGUO9Grv0zJnkn3GbZsDl', 'cFJ__V1OSlK1-Dl042-otT:APA91bGgTfkvazUTB3ydqjwlzudZUd4SBriwnmjLfplAdNqrnLK97xxjbXowhG0Kvm57_ohzdaA53Yfu5mg6bYfPBCiYjXGeVCwneQNb8SdVOryCFtRmnx4XZG5u0LAbF6m1RmdkFGDW', '2020-10-30 20:35:48', '2020-11-29 16:03:26'),
(17, 'Me', 'ra', '/images/cutomers/no_image.png', 'appnce8@gmail.com', '8012989587', '$2y$10$59GvxYCAakryFuZK7SA1I.eZ9x7YkIT8E6DAerAYJ7bzD3ZhbYZWi', '17l2KVRWhdBjzgd6qXnD03AJS4rwWmas4DFfiMO4GYTWxjNHxlJpsepMAKGr', 'fLipx7UkSfak7_z0bi-rjo:APA91bHHMvefDQQxrd5hP7dsA3PUpSMHZR2Ls0Yc3tS5-DLnD2QB3gGZA3f20Zfr4ou3IzfGPVv1XlryXet-6M9-QCTubQXeu9aB826hpOfRTPK-Lhwe8v69igE72eQo7PZT_EJ493IY', '2020-12-10 16:41:25', '2020-12-17 18:12:20'),
(11, 'pandi', 'selvi', '/images/cutomers/no_image.png', 'pandiselvi151998@gamil.com', '9597648414', '$2y$10$FN9tyQK5SSRC28HcR.DaneIf7Ehyxtytmv7iFqfrBObSuZ/MK4BO6', '1179DDI7N6t05IyfP3xrsGICAEwfneZGV3atEIVKAFi8Z1NNRrDaeI1VqSS7', 'd2ZWGZZcSp2IFPE8hCtLIS:APA91bE0G-YydKUGE6R7oo21goIIqPvhqi2dpPys8BZ96JRDQRF8DxPYKB1xbwxsY43Jb3prBUFLuteinkg688wGQNC7CuL9Ae-1J38ZqtjBnN75svavflu9cEY33BJtqdq6GRO8eaJQ', '2020-10-30 20:57:31', '2021-02-15 21:33:00'),
(12, 's', 'm', '/images/cutomers/no_image.png', 'sm@g.com', '1234567890', '$2y$10$Ht9.GTG875wXed2M1IkCHOLH6/Okz7jUmR/M8yAhKOK4.OKfGp4y2', NULL, NULL, '2020-11-08 10:25:28', '2020-11-08 10:25:28'),
(13, 'sms', 'madhar', '/images/cutomers/no_image.png', 'sms@gmail.com', '9750851605', '$2y$10$lcVBraVkiwc4Q6/4vuEzmOr7vg7rwrb8s5cGjpB03KDC9Fl0wJGnC', '13cJvN3JsbRdL3VIQaaPRIuMsVSnePD6bR5C92AATj3v4JupnLW5AoZH98UB', 'd842-J6ERx6PNS3W4bB-iz:APA91bHtXwox2glj5aE8fni9veN6N1ezQjQoPuXYLTyPThs6yzGV0k30wLCS0iwOl_r2fPPHxG0uv6kBJeiC8mTpiD-8lz1nc966HGZSPZowenf7aGKTV-HU-5NaRbrCHOb4JAVNyGKg', '2020-11-08 10:28:31', '2021-01-08 17:13:24'),
(21, 'ice', 'as', '/images/cutomers/no_image.png', 'as@gmail.com', '7019478913', '$2y$10$56fvrFTXWApjfaQS0Bt5/uTNMqMqjkxqiFWa4Q7khS0Y0YVobpxLm', '21MVmYN1fTopRcoMKIsStY4N86tP6pX7dJQJwl9uAX3rt2JMptTleXQ4ZimB', 'dSciUiXbSbS0tBhAGT08Hp:APA91bEDxTo9EDthslqdVfa5a126L2nyzdYAwee-vkaLlurtHDIxd87g0VV1rVmVDM2jx6ulQo-NTvcEUSF6AWe-q_2KF80cJxl8634LqBAdEVv26KAt3YewSUXeVWPcobiAtQIV0VXl', '2020-12-31 09:13:19', '2020-12-31 09:13:21'),
(14, 'mohamed', 'raja s', '/images/cutomers/no_image.png', 'yojyojne@gmail.com', '7867993284', '$2y$10$Kg0lDr0BdDgID9bUQnkcC.uf3kQM.fLxtRfoXBCrGbU2MrmoR9xO2', '14w8QaGPzYW0zfHKQAjraNwQOvv2xDQOFK1WLUSEhvQAnJ4MbU0GDJAu5mA1', 'eLjFuQagTKyZ5qq7qOrSC3:APA91bHhG1lPqxcHuqYDv7uTV64e-lbyMyHaq-WQKiRQ4VIpe2vrUt4dLbraPmkEFSRbssEcQIw1fKvXhYzgMCQmVaMdCQgIOxRNFb7pbiJ1RpcLbHx-ACVfCuHz4I6vZzevhwT1IATK', '2020-11-08 17:44:37', '2021-02-15 19:07:21'),
(18, 'As', 'Sa', '/images/cutomers/no_image.png', 'sheikmadhar@itflexsolution.com', '7339158562', '$2y$10$oudpltqxJmINv/HSxI/TzeH5/Un24ZNovUfl9KrnngrKalgmnSr86', '18JF72TSFoE6sey5XrF7xLFjjG8VjFWRgegEb4jDZpMY0rMvnYk9ylM7gDvi', 'eVVSdsM9CvAeVhaHNKtRiV:APA91bHz5RyFa3q3gliFI7ZwVBMa8OsbXidCnHL6oHcFIus3Xp8jz9WsknylFwQBFHBAsP_EhMbR3cwAeHYyl08de9UG831of8F4G5eqQCicQmjiSKAB7zbZ_suWYmP5Z2w0dtdE6JcM', '2020-12-22 18:33:33', '2020-12-22 18:36:05'),
(19, 'SSSs', 'MMM', '/images/cutomers/no_image.png', 'sheikmadhar@itflexsolutions.com', '7339158561', '$2y$10$1h9lLM7TbGpETPMB06OT3eMQzQPk3euAk2POem59wwV4srw9T/01S', NULL, NULL, '2020-12-23 08:58:47', '2020-12-23 09:04:53'),
(20, 'ajay', 'shank', '/images/cutomers/no_image.png', 'ajayshank2001@gmail.com', '6381604158', '$2y$10$SFW9FkXN67b7QefJWBouAeeU4GM4iBu8nPMYl2heozMPKYk/WJD/u', '200IKzt8mmfbJbiORkHm58NeqVr1dapMSmdTJuajxzdheH4ImDj0PkCx8Kb3', 'eEuBwlEVRK6xOVPFnlTvnn:APA91bE7zk3k19yAFVs-PLQCq0tNcgVPCuee7ebfAXDWVCKM9YgDUnqIRB9tb6WJLjquOlup9oiNABcd6rtst_M1IHxkdMYJCfLMJCWqrBn0anAHCT5xGFq_yx9VzwzTCJ7Ordg8cwex', '2020-12-27 12:48:19', '2020-12-27 12:49:38'),
(22, 'kaja', 'mydeen', '/images/cutomers/no_image.png', 'kajamydeen21@gmail.com', '9789764234', '$2y$10$lCuhh6XPLfKlDgFJKyb45.5NlEPrFnKob21FEUN91nw8w8V.ibVJ.', '22YxTVLGoOy0un8eHexwOoaV4mKliULGqHbmRoR9PNI2bMg76fzFaC4QrWBR', 'eHEkLz7bS6qC8-xEhL3lPC:APA91bEOhcEeStxkJLolpASIvmgz71Xw58orIU8yl2bgZx0I5cyzM7EBIxUfZPeHvrircRPLH15PvLuXCiw49T3tyEpcufetLH1GBvgiJvQl6aB2Y6dFNShJOWdIRmjuknwz0LkzIjq3', '2020-12-31 16:20:44', '2020-12-31 16:20:49'),
(23, 'Mohammed', 'Riyas', '/images/cutomers/no_image.png', 'riyasammaar865@gmail.com', '7904898540', '$2y$10$E6UBhbTxS3jXMwft577nc.ziATBCdWopPeuZjsHxenWVVHaz.unWC', '23EdQhxmdXVf06hT0OtbcfqsecuyyudUg83SWdL5Qhd81qDPYcJp8uu2xfdF', 'dJ_oWvUwQ7WTXSIgRgSCFz:APA91bFpYULtXcXa1LITIiBUF5Z4UzWCiPWZ43ZSUh2VijnFzwhO3e6dSrQsnpRaq1J_FBzX4zgL5pr36e20153pjp7vVFhQxKHsrBB-NMvV_B4vSUEIUZCkldpweI4A2kj3q3McCXn7', '2021-01-09 01:35:29', '2021-01-09 01:35:31'),
(24, 'jaffarulla', 's', '/images/cutomers/no_image.png', 'jaffarullas@gmail.com', '7598746677', '$2y$10$NU.q5EvcCoh.hYRc8Fga5OHWSV.49b1xfJ4OqZbwMv8eaRGFEahgO', '24SKpXIevqfbePySL6vpz15wb8EhjR4CxclBdZDf7gHRuyAFNieHPKAcICmq', 'eLbAa76MSh6iqrZmnrrT9k:APA91bE44qWa1KZHYso8mltYMprxZECodDVi-Zd2V4ZYEFFJ31BkeQvEqyQcdbrWKU7rrVkKHOXRnXvZl9Q6JYB_MCjO_HzdmPWyMRzdm3b_MnLl7zTqjaxgdxAqsO6DY-HfTGra4bSE', '2021-02-05 17:30:29', '2021-02-05 17:30:31'),
(25, 'demo', 'demo', '/images/cutomers/no_image.png', 'nihalshameem423@gmail.com', '7397134353', '$2y$10$irCEgT1IaoUlCADoOaIXMuVHyrIAg7fwbfDXQDA0SoAw5D22qVfZK', NULL, NULL, '2023-02-25 14:52:37', '2023-02-25 14:52:37');

-- --------------------------------------------------------

--
-- Table structure for table `customer_cares`
--

CREATE TABLE `customer_cares` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usecase` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_cares`
--

INSERT INTO `customer_cares` (`id`, `name`, `phone`, `usecase`, `created_at`, `updated_at`) VALUES
(4, 'Customer Care Number 1', '0192837465', 'customer', '2020-12-31 17:13:48', '2021-01-02 11:01:19'),
(5, 'Customer Care Number 2', '9750851605', 'customer', '2020-12-31 21:20:09', '2021-01-02 11:01:34');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notification_id` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `door_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `village` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` bigint(20) NOT NULL,
  `pincode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tamil nadu',
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'india',
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rc_book` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deliveries`
--

INSERT INTO `deliveries` (`id`, `image`, `name`, `phone`, `show_password`, `password`, `api_token`, `notification_id`, `status`, `door_no`, `village`, `district`, `pincode`, `state`, `country`, `latitude`, `longitude`, `vehicle_name`, `vehicle_number`, `license`, `rc_book`, `rating`, `created_at`, `updated_at`) VALUES
(4, '/images/delivery/profile/4.jpeg', 'deliver1', '9876543220', 'delivery12', '$2y$10$dHwAD891ryApPBUDFcMR2.74alqj7plrvfvCvDLSJm/R.qF8Abagy', NULL, NULL, 1, '145', 'mpm', 1, '627005', 'tamil nadu', 'india', NULL, NULL, NULL, NULL, '/images/delivery/license/4.pdf', '/images/delivery/rc_book/4.pdf', '0', '2020-09-30 06:02:15', '2020-11-08 10:30:36'),
(5, '/images/delivery/profile/5.png', 'Sheik', '8610866201', '123456789', '$2y$10$olO3Js0EWY0O6mqEHUucCOteMEF1fqiFVe.RMxLH6EUYbs8Vgx2G6', '5Xrwb5JSvbHPC8hySVK0fjL0sLPohjVJbLkMfnoXbSzu0z9vUBSw52OUhzBr', 'eyuVaLFBT0uoBLc2rcu7t_:APA91bF8-w1mKFxYXupy8oWyNC_Tn5-VUX0c0Oxrr00i7BbmvneRWNeXz5pvA0ROEngwlG2i5smed4MpxPtqkMfKF-94WYbGlotUT_vXFW2QO-3XWPMrVpwuxcuByM5J3U9XqLdBfhe9', 1, '39F/12,7th Street,Gnaniya Appa Nagar', 'Melapalayam', 1, '627005', 'tamil nadu', 'india', '8.696823008358479', '77.71872634068131', 'Honda Dream Neo', 'TN72 BD 8939', '/images/delivery/license/5.pdf', '/images/delivery/rc_book/5.pdf', '4.0', '2020-11-08 10:33:09', '2021-02-23 16:59:04'),
(6, '/images/delivery/profile/6.jpeg', 'Nihal Shameem', '9874531856', '12345678', '$2y$10$7a2KH.M8rtfhbybUy84fSOFG1q5l1T4WcyrfHdRZg/VFYBd7gNBHq', NULL, NULL, 0, '145', 'melapayam', 1, '627005', 'tamil nadu', 'india', NULL, NULL, 'bajaj', 'tn72ak4173', '/images/delivery/license/6.pdf', '/images/delivery/rc_book/6.jpeg', '0', '2020-11-08 11:36:59', '2020-12-25 16:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_charges`
--

CREATE TABLE `delivery_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_charges`
--

INSERT INTO `delivery_charges` (`id`, `price`, `distance`, `created_at`, `updated_at`) VALUES
(1, '10', '1', '2020-12-01 18:30:00', '2020-12-03 18:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_days`
--

CREATE TABLE `delivery_days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `start` timestamp NULL DEFAULT NULL,
  `end` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_days`
--

INSERT INTO `delivery_days` (`id`, `name`, `status`, `start`, `end`, `created_at`, `updated_at`) VALUES
(1, 'Today', 1, '2023-02-24 18:30:00', '2023-02-25 18:29:59', '2023-02-25 14:10:04', '0000-00-00 00:00:00'),
(2, 'Tomorrow', 1, '2023-02-24 18:30:00', '2023-02-25 18:29:59', '2023-02-25 14:10:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_ratings`
--

CREATE TABLE `delivery_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_ratings`
--

INSERT INTO `delivery_ratings` (`id`, `delivery_id`, `customer_id`, `order_id`, `rating`, `created_at`, `updated_at`) VALUES
(20, '5', '10', 40, 4, '2020-12-05 18:04:36', '2020-12-05 18:04:36'),
(21, '5', '13', 21, 4, '2020-12-05 21:40:15', '2020-12-05 21:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_requests`
--

CREATE TABLE `delivery_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_requests`
--

INSERT INTO `delivery_requests` (`id`, `delivery_id`, `order_id`, `created_at`, `updated_at`) VALUES
(4, 4, 15, '2020-11-06 18:29:43', '2020-11-06 18:29:43'),
(5, 4, 16, '2020-11-07 15:20:27', '2020-11-07 15:20:27'),
(6, 4, 13, '2020-11-07 15:20:50', '2020-11-07 15:20:50'),
(7, 4, 13, '2020-11-07 15:21:08', '2020-11-07 15:21:08'),
(8, 5, 19, '2020-11-08 10:38:45', '2020-11-08 10:38:45'),
(9, 5, 19, '2020-11-08 10:38:59', '2020-11-08 10:38:59'),
(10, 5, 19, '2020-11-08 10:39:31', '2020-11-08 10:39:31'),
(11, 5, 19, '2020-11-08 10:40:06', '2020-11-08 10:40:06'),
(12, 5, 19, '2020-11-08 10:54:26', '2020-11-08 10:54:26'),
(13, 4, 19, '2020-11-08 10:54:47', '2020-11-08 10:54:47'),
(14, 4, 19, '2020-11-08 11:37:48', '2020-11-08 11:37:48'),
(15, 4, 20, '2020-11-08 11:38:34', '2020-11-08 11:38:34'),
(16, 5, 20, '2020-11-08 11:40:24', '2020-11-08 11:40:24'),
(17, 5, 20, '2020-11-08 11:44:43', '2020-11-08 11:44:43'),
(18, 5, 20, '2020-11-08 11:44:48', '2020-11-08 11:44:48'),
(19, 5, 19, '2020-11-08 11:45:40', '2020-11-08 11:45:40'),
(20, 5, 19, '2020-11-08 11:46:04', '2020-11-08 11:46:04'),
(21, 5, 19, '2020-11-08 11:46:43', '2020-11-08 11:46:43'),
(22, 5, 19, '2020-11-08 11:48:31', '2020-11-08 11:48:31'),
(23, 5, 20, '2020-11-08 11:50:25', '2020-11-08 11:50:25'),
(24, 5, 21, '2020-11-08 11:52:15', '2020-11-08 11:52:15'),
(25, 5, 21, '2020-11-08 11:56:18', '2020-11-08 11:56:18'),
(26, 5, 21, '2020-11-08 12:19:52', '2020-11-08 12:19:52'),
(27, 5, 21, '2020-11-08 12:21:11', '2020-11-08 12:21:11'),
(28, 5, 21, '2020-11-08 12:21:36', '2020-11-08 12:21:36'),
(29, 5, 21, '2020-11-08 12:26:39', '2020-11-08 12:26:39'),
(30, 5, 21, '2020-11-08 12:27:05', '2020-11-08 12:27:05'),
(31, 5, 21, '2020-11-08 12:27:18', '2020-11-08 12:27:18'),
(32, 5, 21, '2020-11-08 12:27:39', '2020-11-08 12:27:39'),
(33, 5, 21, '2020-11-08 12:31:02', '2020-11-08 12:31:02'),
(34, 5, 21, '2020-11-08 12:32:48', '2020-11-08 12:32:48'),
(35, 5, 21, '2020-11-08 12:34:22', '2020-11-08 12:34:22'),
(36, 5, 20, '2020-11-08 12:35:14', '2020-11-08 12:35:14'),
(37, 5, 21, '2020-11-08 12:35:32', '2020-11-08 12:35:32'),
(38, 5, 21, '2020-11-08 12:35:55', '2020-11-08 12:35:55'),
(39, 5, 21, '2020-11-08 12:36:06', '2020-11-08 12:36:06'),
(40, 5, 21, '2020-11-08 12:37:12', '2020-11-08 12:37:12'),
(41, 5, 22, '2020-11-08 18:03:27', '2020-11-08 18:03:27'),
(42, 5, 22, '2020-11-08 18:04:13', '2020-11-08 18:04:13'),
(43, 5, 22, '2020-11-08 18:23:15', '2020-11-08 18:23:15'),
(44, 5, 22, '2020-11-08 18:23:51', '2020-11-08 18:23:51'),
(45, 5, 22, '2020-11-08 18:24:22', '2020-11-08 18:24:22'),
(46, 5, 24, '2020-11-22 21:56:28', '2020-11-22 21:56:28'),
(47, 5, 24, '2020-11-22 21:56:43', '2020-11-22 21:56:43'),
(48, 5, 24, '2020-11-22 21:56:59', '2020-11-22 21:56:59'),
(49, 5, 23, '2020-11-22 21:57:52', '2020-11-22 21:57:52'),
(50, 5, 25, '2020-11-22 23:44:32', '2020-11-22 23:44:32'),
(51, 5, 25, '2020-11-22 23:45:06', '2020-11-22 23:45:06'),
(52, 5, 24, '2020-11-23 13:02:40', '2020-11-23 13:02:40'),
(53, 4, 24, '2020-11-23 14:21:45', '2020-11-23 14:21:45'),
(54, 4, 24, '2020-11-23 14:24:07', '2020-11-23 14:24:07'),
(55, 4, 24, '2020-11-23 14:24:48', '2020-11-23 14:24:48'),
(56, 4, 24, '2020-11-23 14:25:57', '2020-11-23 14:25:57'),
(57, 4, 24, '2020-11-23 14:28:26', '2020-11-23 14:28:26'),
(58, 4, 24, '2020-11-23 14:34:58', '2020-11-23 14:34:58'),
(59, 5, 23, '2020-11-23 14:57:38', '2020-11-23 14:57:38'),
(60, 5, 24, '2020-11-23 14:58:43', '2020-11-23 14:58:43'),
(61, 5, 24, '2020-11-23 14:59:01', '2020-11-23 14:59:01'),
(62, 4, 24, '2020-11-23 15:02:36', '2020-11-23 15:02:36'),
(63, 5, 24, '2020-11-23 17:14:53', '2020-11-23 17:14:53'),
(64, 5, 12, '2020-11-23 17:15:15', '2020-11-23 17:15:15'),
(65, 5, 27, '2020-11-23 17:19:46', '2020-11-23 17:19:46'),
(66, 5, 27, '2020-11-23 17:20:10', '2020-11-23 17:20:10'),
(67, 5, 26, '2020-11-23 21:24:01', '2020-11-23 21:24:01'),
(68, 5, 30, '2020-11-24 12:27:06', '2020-11-24 12:27:06'),
(69, 5, 30, '2020-11-24 12:27:50', '2020-11-24 12:27:50'),
(70, 5, 26, '2020-11-26 18:23:44', '2020-11-26 18:23:44'),
(71, 5, 36, '2020-11-26 18:24:37', '2020-11-26 18:24:37'),
(72, 5, 36, '2020-11-26 18:25:01', '2020-11-26 18:25:01'),
(73, 5, 36, '2020-11-26 18:33:50', '2020-11-26 18:33:50'),
(74, 5, 35, '2020-11-26 18:49:41', '2020-11-26 18:49:41'),
(75, 5, 35, '2020-11-26 19:30:23', '2020-11-26 19:30:23'),
(76, 5, 35, '2020-11-26 19:31:22', '2020-11-26 19:31:22'),
(77, 5, 35, '2020-11-26 19:32:12', '2020-11-26 19:32:12'),
(78, 5, 38, '2020-11-29 08:19:13', '2020-11-29 08:19:13'),
(79, 5, 38, '2020-11-29 08:21:11', '2020-11-29 08:21:11'),
(80, 5, 38, '2020-11-29 08:21:12', '2020-11-29 08:21:12'),
(81, 5, 38, '2020-11-29 08:21:51', '2020-11-29 08:21:51'),
(82, 5, 38, '2020-11-29 08:25:04', '2020-11-29 08:25:04'),
(83, 5, 35, '2020-11-29 08:25:23', '2020-11-29 08:25:23'),
(84, 5, 35, '2020-11-29 08:26:34', '2020-11-29 08:26:34'),
(85, 5, 35, '2020-11-29 08:32:02', '2020-11-29 08:32:02'),
(86, 5, 37, '2020-11-29 08:52:42', '2020-11-29 08:52:42'),
(87, 5, 37, '2020-11-29 08:53:46', '2020-11-29 08:53:46'),
(88, 5, 34, '2020-11-29 08:54:26', '2020-11-29 08:54:26'),
(89, 5, 37, '2020-11-29 09:32:00', '2020-11-29 09:32:00'),
(90, 5, 4, '2020-11-29 16:32:25', '2020-11-29 16:32:25'),
(91, 5, 4, '2020-11-29 16:32:34', '2020-11-29 16:32:34'),
(92, 5, 4, '2020-11-29 16:32:47', '2020-11-29 16:32:47'),
(93, 5, 4, '2020-11-29 16:33:03', '2020-11-29 16:33:03'),
(94, 5, 4, '2020-11-29 16:33:08', '2020-11-29 16:33:08'),
(95, 5, 4, '2020-11-29 16:33:10', '2020-11-29 16:33:10'),
(96, 5, 4, '2020-11-29 16:35:53', '2020-11-29 16:35:53');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_salaries`
--

CREATE TABLE `delivery_salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `distance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_salaries`
--

INSERT INTO `delivery_salaries` (`id`, `delivery_id`, `order_id`, `distance`, `salary`, `created_at`, `updated_at`) VALUES
(2, 5, 37, '0.02', '0.2', '2020-12-07 22:11:36', '2020-12-07 22:11:36');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_times`
--

CREATE TABLE `delivery_times` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charge` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_times`
--

INSERT INTO `delivery_times` (`id`, `start`, `end`, `charge`, `created_at`, `updated_at`) VALUES
(5, '02:30 am', '02:00 pm', '10.00', '2020-10-29 09:17:31', '2020-11-21 13:39:21'),
(6, '03:19 pm', '05:21 am', '5.00', '2020-10-29 15:19:35', '2020-11-21 13:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'madurai', 1, '2020-09-28 03:25:07', '2020-09-28 03:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `phone`, `message`, `created_at`, `updated_at`) VALUES
(2, 'Me ra', 'appnce8@gmail.com', '8012989587', 'nice app for using', '2020-12-10 19:08:44', '2020-12-10 19:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `function_models`
--

CREATE TABLE `function_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `get_cashes`
--

CREATE TABLE `get_cashes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `distance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_09_15_065131_create_customers_table', 1),
(5, '2020_09_22_065337_create_admins_table', 2),
(6, '2020_09_22_093636_create_products_table', 3),
(7, '2020_09_23_121519_create_stores_table', 4),
(8, '2020_09_24_064303_create_orders_table', 5),
(9, '2020_09_24_071146_create_order_details_table', 6),
(10, '2020_09_24_123012_create_favorites_table', 7),
(11, '2020_09_24_145854_create_carts_table', 8),
(12, '2020_09_25_091023_create_banners_table', 9),
(13, '2020_09_25_114640_create_addresses_table', 10),
(14, '2020_09_26_131117_create_product_types_table', 11),
(15, '2020_09_26_133927_create_payment_methods_table', 12),
(16, '2020_09_26_135021_create_payment_statuses_table', 13),
(17, '2020_09_26_135658_create_order_statuses_table', 14),
(18, '2020_09_27_193358_create_feedback_table', 15),
(19, '2020_09_28_071143_create_districts_table', 16),
(20, '2020_09_29_133220_create_deliveries_table', 17),
(21, '2020_10_01_091208_create_categories_table', 18),
(22, '2021_03_15_132106_create_function_models_table', 19),
(23, '2021_03_15_132506_create_hotels_table', 19),
(24, '2021_03_16_145601_create_salary_paids_table', 19),
(25, '2021_03_16_160836_create_delivery_days_table', 19),
(26, '2021_03_17_140942_create_shipping_charges_table', 19),
(27, '2021_03_24_151858_create_weekly_incentives_table', 19),
(28, '2021_04_04_213046_create_order_incentives_table', 19),
(29, '2021_04_05_181150_create_bonuses_table', 19),
(30, '2021_04_05_182904_create_amount_incentives_table', 19),
(31, '2021_04_07_145959_create_get_cashes_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('1bd281ef-d7d2-46ad-9e14-758d6c93601e', 'App\\Notifications\\OrderNotification', 'App\\Models\\Admin', 1, '{\"head\":\"New Order\",\"date\":\"today\",\"id\":\"28\"}', '2020-10-22 15:50:19', '2020-10-22 08:14:48', '2020-10-22 15:50:19'),
('2ff4b160-f12e-4d51-a3f0-2decfeb4b9e6', 'App\\Notifications\\OrderNotification', 'App\\Models\\Admin', 1, '{\"head\":\"Order Cancelled\",\"date\":\"2020-10-21T12:25:41.000000Z\",\"id\":8}', '2020-10-22 15:50:42', '2020-10-21 07:46:24', '2020-10-22 15:50:42'),
('8d12debd-6389-4eda-8818-ca8f3595443a', 'App\\Notifications\\OrderNotification', 'App\\Models\\Admin', 1, '{\"head\":\"New Order\",\"date\":\"2020-10-21T12:25:41.000000Z\",\"id\":8}', '2020-10-21 07:42:19', '2020-10-21 06:55:41', '2020-10-21 07:42:19'),
('9c65f0e1-a77c-454b-9901-62d03793cdde', 'App\\Notifications\\OrderNotification', 'App\\Models\\Admin', 1, '{\"head\":\"Order Cancelled\",\"date\":\"2020-10-20T09:23:38.000000Z\",\"id\":7}', '2020-10-22 15:50:42', '2020-10-21 07:52:29', '2020-10-22 15:50:42'),
('d0005990-84d2-43ca-aafa-ec0d9cf7477d', 'App\\Notifications\\OrderNotification', 'App\\Models\\Admin', 1, '{\"head\":\"New Order\",\"date\":\"today\",\"id\":\"28\"}', '2020-10-22 15:50:42', '2020-10-22 02:44:20', '2020-10-22 15:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `offer_banners`
--

CREATE TABLE `offer_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `offer_banners`
--

INSERT INTO `offer_banners` (`id`, `name`, `image`, `status`, `link`, `created_at`, `updated_at`) VALUES
(3, 'New', '/images/offer-banners/3.jpg', 1, NULL, '2020-11-20 10:48:34', '2021-02-06 15:09:37'),
(4, 'new1', '/images/offer-banners/4.jpg', 1, NULL, '2020-11-20 10:48:56', '2021-02-15 12:42:52'),
(5, 'demo combo', '/images/offer-banners/5.png', 1, NULL, '2020-12-01 21:42:33', '2021-02-15 13:01:12');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `order_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery` int(11) DEFAULT NULL,
  `shipping_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `time_charge` decimal(5,2) DEFAULT NULL,
  `coupon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `door_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `village` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tamilnadu',
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'india',
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `rating` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `qty`, `price`, `payment_method`, `payment_status`, `order_status`, `delivery`, `shipping_amount`, `tax`, `time_charge`, `coupon`, `total`, `door_no`, `village`, `district`, `pincode`, `state`, `country`, `latitude`, `longitude`, `phone`, `email`, `start_time`, `end_time`, `delivery_date`, `rating`, `created_at`, `updated_at`) VALUES
(1, 1, '2', '400', 2, 2, '1', NULL, '50', '0', NULL, '0', '450', '134,asura street', 'mpm', 'tirunelveli', '627005', 'tamilnadu', 'india', NULL, NULL, '9876543321', 'nihalsham6@gmail.com', NULL, NULL, NULL, NULL, '2020-09-23 22:30:00', NULL),
(2, 1, '3.00', '480', 1, 1, '4', NULL, '50', '0', NULL, '0', '530', '145,asure street', 'mpm', 'tirunelveli', '627006', 'tamil nadu', 'india', NULL, NULL, '7397134351', 'nihalshameem6@gmail.com', NULL, NULL, NULL, NULL, '2020-09-26 11:00:38', '2020-09-27 14:21:01'),
(3, 1, '1.00', '180', 1, 1, '1', NULL, '50', '0', NULL, '0', '230', '145,asure street', 'mpm', 'tirunelveli', '627006', 'tamil nadu', 'india', NULL, NULL, '7397134351', 'nihalshameem6@gmail.com', NULL, NULL, NULL, NULL, '2020-09-26 11:13:08', '2020-09-26 11:13:08'),
(4, 1, '10', '400', 1, 1, '2', 5, '50', '0', NULL, '0', '450', '145,asure street', 'mpm', '1', '627006', 'tamil nadu', 'india', NULL, NULL, '7397134351', 'nihalshameem6@gmail.com', NULL, NULL, NULL, NULL, '2020-09-27 13:33:21', '2020-11-29 16:33:26'),
(5, 1, '1', '10', 1, 1, '2', 5, '50', '0', NULL, '0', '60', '145,asure street', 'mpm', '1', '627006', 'tamil nadu', 'india', NULL, NULL, '7397134351', 'nihalshameem6@gmail.com', NULL, NULL, NULL, NULL, '2020-10-22 07:27:25', '2020-11-29 10:31:21'),
(6, 1, '1', '29.4', 2, 1, '2', 5, '50', '0', NULL, '0', '79.4', '145,asure street', 'mpm', '1', '627006', 'tamil nadu', 'india', NULL, NULL, '7397134351', 'nihalshameem6@gmail.com', NULL, NULL, NULL, NULL, '2020-10-24 18:28:07', '2020-11-29 10:31:25'),
(7, 1, '1', '29.4', 2, 1, '2', 5, '50', '0', NULL, '0', '79.4', '145,asure street', 'mpm', '1', '627006', 'tamil nadu', 'india', NULL, NULL, '7397134351', 'nihalshameem6@gmail.com', NULL, NULL, NULL, NULL, '2020-10-24 18:31:50', '2020-11-29 10:31:29'),
(8, 1, '1', '21', 2, 1, '2', 5, '50', '0', NULL, '0', '71', '145,asure street', 'mpm', '1', '627006', 'tamil nadu', 'india', NULL, NULL, '7397134351', 'nihalshameem6@gmail.com', NULL, NULL, NULL, NULL, '2020-10-29 00:10:35', '2020-11-29 10:31:32'),
(9, 4, '1.0999999999999999', '37.5', 1, 1, '2', 5, '50', '0', NULL, '0', '88', 'Pappanodai, Tamil Nadu, India', 'NONE', '1', 'null', 'tamil nadu', 'india', '9.830891443806978', '78.11849299818277', '9750851606', 'appnce8@gm', '02:30 am', '02:00 pm', NULL, NULL, '2020-10-30 11:41:16', '2020-11-29 10:31:35'),
(10, 4, '0.2', '6.4', 1, 1, '2', 5, '50', '0', NULL, '0', '56', 'Pappanodai, Tamil Nadu, India', 'NONE', '1', 'null', 'tamil nadu', 'india', '9.830891443806978', '78.11849299818277', '9750851606', 'appnce8@gm', '03:19 pm', '05:21 am', NULL, NULL, '2020-10-30 11:46:21', '2020-11-29 10:32:02'),
(11, 4, '0.2', '56.4', 2, 2, '2', 5, '50', '0', NULL, '0', '106', 'Pappanodai, Tamil Nadu, India', 'NONE', '1', 'null', 'tamil nadu', 'india', '9.830891443806978', '78.11849299818277', '9750851606', 'appnce8@gm', '03:19 pm', '05:21 am', NULL, NULL, '2020-10-30 12:32:25', '2020-11-29 10:32:11'),
(12, 4, '0.1', '52.1', 2, 2, '2', NULL, '50', '0', NULL, '0', '102', 'Pappanodai, Tamil Nadu, India', 'NONE', '1', 'null', 'tamil nadu', 'india', '9.830891443806978', '78.11849299818277', '9750851606', 'appnce8@gm', '03:19 pm', '05:21 am', NULL, NULL, '2020-10-30 12:33:22', '2020-11-23 17:15:15'),
(13, 10, '0.5', '64.9', 1, 2, '4', NULL, '50', '0', NULL, '0', '115', 'SH 72, Chinna Chokikulam, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.932781637413738', '78.13272446393967', '8610866200', 'madharsheik3@gmail.com', '03:19 pm', '05:21 am', NULL, NULL, '2020-10-30 20:38:17', '2020-11-23 15:01:54'),
(14, 10, '0.2', '56.4', 2, 2, '2', 4, '50', '0', NULL, '0', '106', '16B, Thirumalairayar Padithurai Rd, Simmakkal, Madurai Main, Madurai, Tamil Nadu 625001, India', 'NONE', '1', '625001', 'tamil nadu', 'india', '9.925681172387199', '78.1213713437319', '8610866200', 'madharsheik3@gmail.com', '03:19 pm', '05:21 am', NULL, NULL, '2020-10-30 20:40:50', '2020-11-01 00:08:51'),
(15, 1, '0.1', '52.1', 2, 2, '3', 4, '50', '0', NULL, '0', '102', '145,asure street', 'mpm', '1', '627006', 'tamil nadu', 'india', NULL, NULL, '7397134351', 'nihalshameem6@gmail.com', '02:30 am', '02:00 pm', NULL, NULL, '2020-11-04 20:43:38', '2020-11-07 15:17:28'),
(16, 10, '26', '2075.0', 2, 2, '3', NULL, '50', '0', NULL, '0', '2125', 'SH 72, Chinna Chokikulam, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.932781637413738', '78.13272446393967', '8610866200', 'madharsheik3@gmail.com', '02:30 am', '02:00 pm', NULL, NULL, '2020-11-06 23:55:53', '2020-11-07 15:14:04'),
(17, 10, '1.1', '73.1', 1, 2, '3', NULL, '50', '0', NULL, '0', '123.1', 'SH 72, Chinna Chokikulam, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.932781637413738', '78.13272446393967', '8610866200', 'madharsheik3@gmail.com', '03:19 pm', '05:21 am', NULL, NULL, '2020-11-07 17:44:20', '2020-11-07 23:55:44'),
(18, 10, '0.9', '78.8', 2, 2, '3', NULL, '50', '0', NULL, '0', '128.8', 'Sahayamatha 2nd St, Raja Nagar, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.695516558518213', '77.72181607782841', '8610866200', 'madharsheik3@gmail.com', '03:19 pm', '05:21 am', NULL, NULL, '2020-11-08 09:53:17', '2020-11-08 12:38:04'),
(19, 13, '0.4', '62.8', 2, 2, '2', NULL, '50', '0', NULL, '0', '112.8', 'Tamukkam Ground Bus Stop, Alagar Kovil Main Rd, Mellur, Tallakulam, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.931777013532137', '78.13229866325855', '9750851605', 'sms@gmail.com', '03:19 pm', '05:21 am', NULL, NULL, '2020-11-08 10:38:20', '2020-11-08 10:38:58'),
(20, 13, '0.3', '59.6', 1, 2, '3', NULL, '50', '0', NULL, '0', '109.6', 'Tamukkam Ground Bus Stop, Alagar Kovil Main Rd, Mellur, Tallakulam, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.931777013532137', '78.13229866325855', '9750851605', 'sms@gmail.com', '03:19 pm', '05:21 am', NULL, '5.0', '2020-11-08 11:19:55', '2020-12-08 18:44:03'),
(21, 13, '0.1', '52.1', 2, 2, '3', 5, '50', '0', NULL, '0', '102.1', 'Tamukkam Ground Bus Stop, Alagar Kovil Main Rd, Mellur, Tallakulam, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.931777013532137', '78.13229866325855', '9750851605', 'sms@gmail.com', '03:19 pm', '05:21 am', NULL, '4.0', '2020-11-08 11:51:54', '2020-12-05 21:40:15'),
(22, 14, '0.3', '63.5', 2, 2, '5', 5, '50', '0', NULL, '0', '113.5', 'Kalpalam, Kochi - Madurai - Dhanushkodi Rd, Simmakkal, Madurai Main, Madurai, Tamil Nadu 625001, India', 'NONE', '1', '625001', 'tamil nadu', 'india', '9.927852940273715', '78.12495343387127', '7867993284', 'yojyojne@gmail.com', '03:19 pm', '05:21 am', NULL, NULL, '2020-11-08 18:01:37', '2020-11-29 09:52:56'),
(23, 10, '5.799999999999999', '249.99', 1, 1, '2', NULL, '50', '0', '10.00', '0', '309.99', '16B, Thirumalairayar Padithurai Rd, Simmakkal, Madurai Main, Madurai, Tamil Nadu 625001, India', 'NONE', '1', '625001', 'tamil nadu', 'india', '9.925681172387199', '78.1213713437319', '8610866200', 'madharsheik3@gmail.com', '02:30 am', '02:00 pm', NULL, NULL, '2020-11-22 21:53:59', '2020-11-23 14:57:38'),
(24, 10, '0.30000000000000004', '55.88', 2, 2, '2', 5, '50', '0', '0.00', '0', '105.88', '16B, Thirumalairayar Padithurai Rd, Simmakkal, Madurai Main, Madurai, Tamil Nadu 625001, India', 'NONE', '1', '625001', 'tamil nadu', 'india', '9.925681172387199', '78.1213713437319', '8610866200', 'madharsheik3@gmail.com', '', '', NULL, NULL, '2020-11-22 21:54:54', '2020-11-23 17:14:53'),
(25, 10, '0.1', '52.1', 1, 1, '2', NULL, '50', '0', '10.00', '0', '112.1', '16B, Thirumalairayar Padithurai Rd, Simmakkal, Madurai Main, Madurai, Tamil Nadu 625001, India', 'NONE', '1', '625001', 'tamil nadu', 'india', '9.925681172387199', '78.1213713437319', '8610866200', 'madharsheik3@gmail.com', '02:30 am', '02:00 pm', NULL, NULL, '2020-11-22 23:44:13', '2020-11-22 23:45:06'),
(26, 10, '0.2', '53.78', 1, 2, '2', NULL, '50', '0', '10.00', '0', '113.78', '16B, Thirumalairayar Padithurai Rd, Simmakkal, Madurai Main, Madurai, Tamil Nadu 625001, India', 'NONE', '1', '625001', 'tamil nadu', 'india', '9.925681172387199', '78.1213713437319', '8610866200', 'madharsheik3@gmail.com', '02:30 am', '02:00 pm', NULL, NULL, '2020-11-23 17:16:46', '2020-11-23 21:24:01'),
(27, 10, '0.30000000000000004', '59.769999999999996', 2, 2, '5', 5, '50', '0', '10.00', '0', '119.77', '16B, Thirumalairayar Padithurai Rd, Simmakkal, Madurai Main, Madurai, Tamil Nadu 625001, India', 'NONE', '1', '625001', 'tamil nadu', 'india', '9.925681172387199', '78.1213713437319', '8610866200', 'madharsheik3@gmail.com', '02:30 am', '02:00 pm', NULL, NULL, '2020-11-23 17:18:12', '2020-11-23 22:36:35'),
(28, 10, '0.8999999999999999', '79.32', 1, 1, '2', 5, '50', '0', '0.00', '0', '129.32', 'SH 72, Chinna Chokikulam, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.932781637413738', '78.13272446393967', '8610866200', 'madharsheik3@gmail.com', '', '', NULL, NULL, '2020-11-24 12:17:15', '2020-11-29 10:32:15'),
(29, 10, '0.8999999999999999', '79.32', 1, 1, '2', 5, '50', '0', '10.00', '0', '139.32', 'SH 72, Chinna Chokikulam, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.932781637413738', '78.13272446393967', '8610866200', 'madharsheik3@gmail.com', '02:30 am', '02:00 pm', NULL, NULL, '2020-11-24 12:17:38', '2020-11-29 10:32:48'),
(30, 15, '0.1', '52.1', 2, 2, '5', 5, '50', '0', '10.00', '0', '112.1', '1st street, Suyarajyapuram 2nd East Main Rd, Sellur, Madurai, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.932648546393004', '78.1247928366065', '8012989587', 'appnce8@gmail.com', '02:30 am', '02:00 pm', NULL, NULL, '2020-11-24 12:25:38', '2020-11-24 12:27:50'),
(31, 10, '0.4', '75.28999999999999', 1, 1, '2', 5, '50', '0', '0.00', '0', '125.29', '2nd St, Raja Nagar, Melapalayam, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.696666923795432', '77.71888744086027', '8610866200', 'madharsheik3@gmail.com', '', '', NULL, NULL, '2020-11-24 22:32:45', '2020-11-29 10:32:26'),
(32, 10, '0.1', '52.1', 1, 1, '2', 5, '50', '0', '0.00', '0', '102.1', '2nd St, Raja Nagar, Melapalayam, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.696666923795432', '77.71888744086027', '8610866200', 'madharsheik3@gmail.com', '', '', NULL, NULL, '2020-11-24 22:36:14', '2020-11-29 10:32:23'),
(33, 10, '0.1', '54.5', 1, 1, '2', 5, '50', '0', '0.00', '0', '104.5', '2nd St, Raja Nagar, Melapalayam, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.696666923795432', '77.71888744086027', '8610866200', 'madharsheik3@gmail.com', '', '', NULL, NULL, '2020-11-24 23:07:41', '2020-11-29 10:32:19'),
(34, 10, '0.1', '4.5', 1, 1, '2', 5, '50', '0', '0.00', '0', '54.5', '2nd St, Raja Nagar, Melapalayam, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.696666923795432', '77.71888744086027', '8610866200', 'madharsheik3@gmail.com', '', '', NULL, NULL, '2020-11-24 23:11:53', '2020-11-29 08:56:00'),
(35, 10, '0.1', '3.2', 1, 1, '2', 5, '50', '0', '0.00', '0', '53.2', '2nd St, Raja Nagar, Melapalayam, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.696666923795432', '77.71888744086027', '8610866200', 'madharsheik3@gmail.com', '', '', NULL, NULL, '2020-11-25 22:18:42', '2020-11-29 08:26:45'),
(36, 10, '0.1', '3.2', 1, 1, '2', 5, '50', '0', '0.00', '0', '53.2', '2nd St, Raja Nagar, Melapalayam, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.696666923795432', '77.71888744086027', '8610866200', 'madharsheik3@gmail.com', '', '', NULL, NULL, '2020-11-25 22:22:17', '2020-11-26 18:25:14'),
(37, 10, '0.1', '2.1', 1, 2, '3', 5, '50', '0', '0.00', '0', '52.1', '2nd St, Raja Nagar, Melapalayam, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.696666923795432', '77.71888744086027', '8610866200', 'madharsheik3@gmail.com', '', '', NULL, NULL, '2020-11-29 07:57:53', '2020-12-07 22:11:36'),
(38, 10, '0.1', '4.5', 1, 2, '3', 5, '50', '0', '0.00', '0', '54.5', '2nd St, Raja Nagar, Melapalayam, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.696666923795432', '77.71888744086027', '8610866200', 'madharsheik3@gmail.com', '', '', NULL, NULL, '2020-11-29 07:58:38', '2020-12-07 21:35:14'),
(39, 10, '0.1', '4.5', 1, 1, '2', 5, '50', '0', '0.00', '0', '54.5', '2nd St, Raja Nagar, Melapalayam, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.696666923795432', '77.71888744086027', '8610866200', 'madharsheik3@gmail.com', '', '', NULL, NULL, '2020-11-29 10:00:07', '2020-11-29 10:32:21'),
(40, 10, '0.1', '2.1', 1, 2, '3', 5, '50', '0', '0.00', '0', '52.1', '2nd St, Raja Nagar, Melapalayam, Tirunelveli, Tamil Nadu 627005, India', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.696666923795432', '77.71888744086027', '8610866200', 'madharsheik3@gmail.com', '', '', NULL, '4', '2020-11-29 10:01:16', '2020-12-05 18:04:36'),
(41, 10, '0.1', '2.1', 1, 1, '2', NULL, '50', '0', '0.00', '0', '52.1', 'Unnamed Road, Pudur, Tamil Nadu 624401, India', 'NONE', '1', '624401', 'tamil nadu', 'india', '10.131684194294447', '78.17425444722174', '8610866200', 'madharsheik3@gmail.com', '', '', NULL, NULL, '2020-11-29 16:19:26', '2020-11-29 16:20:19'),
(42, 14, '0.30000000000000004', '12.2', 2, 2, '5', 5, '50', '0', '5.00', '0', '67.2', 'Kalpalam, Kochi - Madurai - Dhanushkodi Rd, Simmakkal, Madurai Main, Madurai, Tamil Nadu 625001, India', 'NONE', '1', '625001', 'tamil nadu', 'india', '9.927852940273715', '78.12495343387127', '7867993284', 'yojyojne@gmail.com', '03:19 pm', '05:21 am', NULL, NULL, '2020-11-29 18:13:40', '2020-12-07 20:55:16'),
(43, 14, '1.3', '59.45', 1, 1, '5', 5, '50', '0', '0.00', '0', '109.45', 'Kalpalam, Kochi - Madurai - Dhanushkodi Rd, Simmakkal, Madurai Main, Madurai, Tamil Nadu 625001, India', 'NONE', '1', '625001', 'tamil nadu', 'india', '9.927852940273715', '78.12495343387127', '7867993284', 'yojyojne@gmail.com', '', '', NULL, NULL, '2020-11-29 18:35:53', '2020-12-07 20:51:14'),
(44, 13, '0.2', '5', 1, 1, '1', NULL, '50', '0', '10.00', '0', '65', 'Tamukkam Ground Bus Stop, Alagar Kovil Main Rd, Mellur, Tallakulam, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.931777013532137', '78.13229866325855', '9750851605', 'sms@gmail.com', '09:00 am', '11:00 am', '2020-12-04', NULL, '2020-12-03 20:19:48', '2020-12-03 20:19:48'),
(45, 13, '0.1', '4.5', 2, 2, '1', NULL, '50', '0', '10.00', '0', '64.5', 'Tamukkam Ground Bus Stop, Alagar Kovil Main Rd, Mellur, Tallakulam, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.931777013532137', '78.13229866325855', '9750851605', 'sms@gmail.com', '08:00 am', '09:30 am', '2020-12-03', NULL, '2020-12-03 20:21:00', '2020-12-03 20:21:00'),
(46, 13, '1.2000000000000002', '28.7', 1, 1, '1', NULL, '50', '0', '0.00', '0', '78.7', 'Tamukkam Ground Bus Stop, Alagar Kovil Main Rd, Mellur, Tallakulam, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.931777013532137', '78.13229866325855', '9750851605', 'sms@gmail.com', '', '', '2020-12-03', NULL, '2020-12-03 20:28:05', '2020-12-03 20:28:05'),
(47, 13, '0.2', '3.7', 1, 1, '1', NULL, '50', '0', '10.00', '0', '63.7', 'Tamukkam Ground Bus Stop, Alagar Kovil Main Rd, Mellur, Tallakulam, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.931777013532137', '78.13229866325855', '9750851605', 'sms@gmail.com', '08:00 am', '09:00 pm', '2020-12-03', NULL, '2020-12-03 20:28:32', '2020-12-03 20:28:32'),
(48, 17, '1', '45', 1, 1, '5', 5, '50', '0', '0.00', '0', '95', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-10', NULL, '2020-12-10 16:44:00', '2020-12-10 16:44:25'),
(49, 17, '10.1', '655.5', 1, 1, '1', NULL, '50', '0', '0.00', '0', '705.5', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-14', NULL, '2020-12-14 21:06:09', '2020-12-14 21:06:09'),
(50, 17, '0.1', '4.5', 1, 1, '1', NULL, '50', '0', '0.00', '0', '54.5', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-14', NULL, '2020-12-14 21:42:28', '2020-12-14 21:42:28'),
(51, 17, '0.1', '4.5', 1, 1, '1', NULL, '50', '0', '0.00', '0', '54.5', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-14', NULL, '2020-12-14 21:43:14', '2020-12-14 21:43:14'),
(52, 17, '0.1', '4.5', 1, 1, '1', NULL, '50', '0', '0.00', '0', '54.5', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-14', NULL, '2020-12-14 21:44:17', '2020-12-14 21:44:17'),
(53, 17, '0', '0', 1, 1, '1', NULL, '50', '0', '0.00', '0', '50', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-14', NULL, '2020-12-14 21:45:01', '2020-12-14 21:45:01'),
(54, 17, '0.1', '4.5', 1, 1, '1', NULL, '50', '0', '0.00', '0', '54.5', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-14', NULL, '2020-12-14 21:49:56', '2020-12-14 21:49:56'),
(55, 17, '0.1', '4.5', 1, 1, '1', NULL, '50', '0', '0.00', '0', '54.5', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-14', NULL, '2020-12-14 21:57:41', '2020-12-14 21:57:41'),
(56, 17, '0.1', '4.5', 1, 1, '1', NULL, '50', '0', '0.00', '0', '54.5', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-14', NULL, '2020-12-14 21:59:16', '2020-12-14 21:59:16'),
(57, 17, '0.1', '4.5', 1, 1, '1', NULL, '50', '0', '0.00', '0', '54.5', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-14', NULL, '2020-12-14 22:08:04', '2020-12-14 22:08:04'),
(58, 17, '0.1', '4.5', 1, 1, '1', NULL, '50', '0', '0.00', '0', '54.5', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '1970-01-01', NULL, '2020-12-14 22:08:41', '2020-12-14 22:08:41'),
(59, 17, '0.1', '4.5', 1, 1, '1', NULL, '50', '0', '0.00', '0', '54.5', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-14', NULL, '2020-12-14 22:08:53', '2020-12-14 22:08:53'),
(60, 17, '0.1', '2.1', 1, 1, '1', NULL, '50', '0', '0.00', '0', '52.1', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-14', NULL, '2020-12-14 22:10:11', '2020-12-14 22:10:11'),
(61, 17, '0.2', '7.7', 1, 1, '1', NULL, '50', '0', '0.00', '0', '57.7', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-14', NULL, '2020-12-14 22:34:16', '2020-12-14 22:34:16'),
(62, 17, '0.1', '2.1', 1, 1, '1', NULL, '50', '0', '0.00', '0', '52.1', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-14', NULL, '2020-12-14 22:39:30', '2020-12-14 22:39:30'),
(63, 17, '30', '2146', 1, 1, '1', NULL, '50', '0', '0.00', '0', '2196', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-15', NULL, '2020-12-15 12:46:40', '2020-12-15 12:46:40'),
(64, 17, '10', '50', 1, 1, '1', NULL, '50', '0', '0.00', '5.0', '95', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-17', NULL, '2020-12-17 22:09:08', '2020-12-17 22:09:08'),
(65, 17, '10', '50', 1, 1, '1', NULL, '50', '0', '0.00', '0.0', '100', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-17', NULL, '2020-12-17 22:12:36', '2020-12-17 22:12:36'),
(66, 17, '20', '477', 1, 1, '1', NULL, '50', '0', '0.00', '47.7', '479.3', '15,raja nagar', 'Melapalayam', '1', '627005', 'tamil nadu', 'india', '9.9252007', '78.1197754', '8012989587', 'appnce8@gmail.com', '', '', '2020-12-17', NULL, '2020-12-17 22:13:23', '2020-12-17 22:13:23'),
(67, 13, '0.1', '0.5', 1, 1, '1', NULL, '50', '0', '0.00', '0', '50.5', 'Tamukkam Ground Bus Stop, Alagar Kovil Main Rd, Mellur, Tallakulam, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.931777013532137', '78.13229866325855', '9750851605', 'sms@gmail.com', NULL, NULL, '2020-12-23', NULL, '2020-12-23 08:48:45', '2020-12-23 08:48:45'),
(68, 13, '0.1', '0.5', 1, 1, '5', 5, '50', '0', '0.00', '0', '50.5', 'Tamukkam Ground Bus Stop, Alagar Kovil Main Rd, Mellur, Tallakulam, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.931777013532137', '78.13229866325855', '9750851605', 'sms@gmail.com', NULL, NULL, '2020-12-23', NULL, '2020-12-23 08:49:07', '2020-12-25 16:37:06'),
(69, 1, '0.45', '12.63', 1, 1, '5', 5, '50', '0', '0.00', '0', '62.63', '145,asure street', 'mpm', '1', '627006', 'tamil nadu', 'india', NULL, NULL, '7397134351', 'nihalshameem6@gmail.com', NULL, NULL, '2020-12-23', NULL, '2020-12-23 15:09:21', '2020-12-25 16:35:58'),
(70, 1, '0.45', '12.63', 1, 1, '1', NULL, '50', '0', '0.00', '0', '62.63', '145,asure street', 'mpm', '1', '627006', 'tamil nadu', 'india', NULL, NULL, '7397134351', 'nihalshameem6@gmail.com', NULL, NULL, '2020-12-23', NULL, '2020-12-23 15:11:39', '2020-12-23 15:11:39'),
(71, 1, '0.45', '12.63', 1, 1, '5', 5, '50', '0', '0.00', '0', '62.63', '145,asure street', 'mpm', '1', '627006', 'tamil nadu', 'india', NULL, NULL, '7397134351', 'nihalshameem6@gmail.com', NULL, NULL, '2020-12-23', NULL, '2020-12-23 15:12:11', '2020-12-25 16:32:15'),
(72, 13, '0.4', '10.27', 1, 1, '4', 5, '50', '0', '0.00', '0', '60.27', 'Tamukkam Ground Bus Stop, Alagar Kovil Main Rd, Mellur, Tallakulam, Tamil Nadu 625002, India', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.931777013532137', '78.13229866325855', '9750851605', 'sms@gmail.com', NULL, NULL, '2020-12-24', NULL, '2020-12-24 10:28:54', '2020-12-25 14:19:35'),
(73, 21, '0.1', '0.5', 1, 1, '1', NULL, '50', '0', '0.00', '0.0', '50.5', '15, 2nd street, bibikulam', 'NONE', '1', '625002', 'tamil nadu', 'india', '9.9363612', '78.13305679999999', '7019478913', 'as@gmail.com', '', '', '2020-12-31', NULL, '2020-12-31 09:27:19', '2020-12-31 09:27:19'),
(74, 22, '0.1', '0.5', 1, 1, '5', 5, '50', '0', '10.00', '0.0', '60.5', '15 reajanagarmelapalayam', 'NONE', '1', '627005', 'tamil nadu', 'india', '8.698763999999999', '77.7148289', '9789764234', 'kajamydeen21@gmail.com', '08:00 am', '09:00 pm', '2020-12-31', NULL, '2020-12-31 16:23:10', '2021-01-11 13:00:51'),
(75, 13, '2.8', '84.34', 1, 1, '5', 5, '50', '0', '10.00', '0.0', '144.34', '26, Mahal 3rd St, Mahal Area, Madurai Main, Madurai, Tamil Nadu 625001, India', 'NONE', '1', '625001', 'tamil nadu', 'india', '9.915090955561594', '78.12325425446033', '9750851605', 'sms@gmail.com', '08:00 am', '09:00 pm', '2021-01-11', NULL, '2021-01-11 12:59:42', '2021-01-11 13:00:39'),
(76, 13, '0.45', '13.85', 1, 1, '5', 5, '50', '0', '0.00', '0', '63.85', '26, Mahal 3rd St, Mahal Area, Madurai Main, Madurai, Tamil Nadu 625001, India', 'NONE', '1', '625001', 'tamil nadu', 'india', '9.915090955561594', '78.12325425446033', '9750851605', 'sms@gmail.com', NULL, NULL, '2121-01-11', NULL, '2021-01-11 21:47:24', '2021-01-11 21:48:08'),
(77, 13, '0.1', '2.1', 1, 1, '5', 5, '50', '0', '0.00', '0', '52.1', '15', 'anna nagar', '1', '627011', 'tamil nadu', 'india', '9.919494', '78.150942', '9750851605', 'sms@gmail.com', NULL, NULL, '2121-01-11', NULL, '2021-01-11 21:49:28', '2021-01-11 21:49:55'),
(78, 14, '3', '7.970000000000001', 1, 1, '2', 5, '50', '0', '0.00', '0.0', '57.97', 'Kalpalam, Kochi - Madurai - Dhanushkodi Rd, Simmakkal, Madurai Main, Madurai, Tamil Nadu 625001, India', 'NONE', '1', '625001', 'tamil nadu', 'india', '9.927852940273715', '78.12495343387127', '7867993284', 'yojyojne@gmail.com', '', '', '2021-02-23', NULL, '2021-02-23 16:58:47', '2021-02-23 16:59:13'),
(79, 13, '1', '5', 1, 1, '1', NULL, '50', '0', '0.00', '0.0', '55', '26, Mahal 3rd St, Mahal Area, Madurai Main, Madurai, Tamil Nadu 625001, India', 'NONE', '1', '625001', 'tamil nadu', 'india', '9.915090955561594', '78.12325425446033', '9750851605', 'sms@gmail.com', '', '', '2021-02-23', NULL, '2021-02-23 20:27:08', '2021-02-23 20:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `price` decimal(5,2) NOT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `image`, `name`, `price_type`, `price`, `qty`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '/images/products/download.jpg', 'product1', 'normal', '200.00', '2', '400.00', '2020-09-23 22:30:00', NULL),
(2, 2, 1, '/images/products/download.jpg', 'product1', 'normal', '180.00', '1.00', '180.00', '2020-09-26 11:00:38', '2020-09-26 11:00:38'),
(3, 2, 3, '/images/products/web 4.jpg', 'product3', 'normal', '150.00', '2.00', '300.00', '2020-09-26 11:00:38', '2020-09-26 11:00:38'),
(4, 3, 1, '/images/products/download.jpg', 'product1', 'normal', '180.00', '1.00', '180.00', '2020-09-26 11:13:08', '2020-09-26 11:13:08'),
(5, 4, 2, '/images/products/7910.jpg', 'product2', 'normal', '40.00', '10.00', '400.00', '2020-09-27 13:33:21', '2020-09-27 13:33:21'),
(6, 5, 28, '/images/products/28.jpg', 'Coriander Lettuce / மல்லி கீரை', 'normal', '10.00', '1.00', '10', '2020-10-22 07:27:25', '2020-10-22 07:27:25'),
(7, 7, 32, '/images/products/32.jpg', 'Lemon / எலுமிச்சை', 'normal', '29.40', '1.00', '0', '2020-10-24 18:31:50', '2020-10-24 18:31:50'),
(8, 8, 7, '/images/products/7.png', 'Onion / வெங்காயம்', 'normal', '21.00', '1.00', '0', '2020-10-29 00:10:35', '2020-10-29 00:10:35'),
(9, 9, 27, '/images/products/27.jpg', 'Tomato Hybrid / தக்காளி', 'normal', '21.00', '0.30', '6.3', '2020-10-30 11:41:16', '2020-10-30 11:41:16'),
(10, 9, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'excellent', '45.00', '0.60', '27', '2020-10-30 11:41:16', '2020-10-30 11:41:16'),
(11, 9, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'normal', '21.00', '0.20', '4.2', '2020-10-30 11:41:16', '2020-10-30 11:41:16'),
(12, 10, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'standard', '32.00', '0.20', '6.4', '2020-10-30 11:46:21', '2020-10-30 11:46:21'),
(13, 11, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'standard', '32.00', '0.20', '6.4', '2020-10-30 12:32:25', '2020-10-30 12:32:25'),
(14, 12, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'normal', '21.00', '0.10', '2.1', '2020-10-30 12:33:22', '2020-10-30 12:33:22'),
(15, 13, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'standard', '32.00', '0.40', '12.8', '2020-10-30 20:38:17', '2020-10-30 20:38:17'),
(16, 13, 7, '/images/products/7.png', 'Onion / வெங்காயம்', 'normal', '21.00', '0.10', '2.1', '2020-10-30 20:38:17', '2020-10-30 20:38:17'),
(17, 14, 7, '/images/products/7.png', 'Onion / வெங்காயம்', 'standard', '32.00', '0.20', '6.4', '2020-10-30 20:40:50', '2020-10-30 20:40:50'),
(18, 15, 25, '/images/products/25.jpg', 'Tomato / தக்காளி', 'normal', '21.00', '0.10', '2.1', '2020-11-04 20:43:38', '2020-11-04 20:43:38'),
(19, 16, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'standard', '32.00', '1.80', '57.6', '2020-11-06 23:55:53', '2020-11-06 23:55:53'),
(20, 16, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'excellent', '45.00', '3.00', '135', '2020-11-06 23:55:53', '2020-11-06 23:55:53'),
(21, 16, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'normal', '21.00', '0.90', '18.9', '2020-11-06 23:55:53', '2020-11-06 23:55:53'),
(22, 16, 54, '/images/products/54.png', 'Onion / வெங்காயம்', 'normal', '90.00', '20.00', '1800', '2020-11-06 23:55:53', '2020-11-06 23:55:53'),
(23, 16, 29, '/images/products/29.jpg', 'Mint / புதினா', 'excellent', '45.00', '0.30', '13.5', '2020-11-06 23:55:53', '2020-11-06 23:55:53'),
(24, 17, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'normal', '21.00', '1.10', '23.1', '2020-11-07 17:44:20', '2020-11-07 17:44:20'),
(25, 18, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'standard', '32.00', '0.50', '16', '2020-11-08 09:53:17', '2020-11-08 09:53:17'),
(26, 18, 7, '/images/products/7.png', 'Onion / வெங்காயம்', 'standard', '32.00', '0.40', '12.8', '2020-11-08 09:53:17', '2020-11-08 09:53:17'),
(27, 19, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'standard', '32.00', '0.40', '12.8', '2020-11-08 10:38:20', '2020-11-08 10:38:20'),
(28, 20, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'standard', '32.00', '0.30', '9.6', '2020-11-08 11:19:55', '2020-11-08 11:19:55'),
(29, 21, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'normal', '21.00', '0.10', '2.1', '2020-11-08 11:51:54', '2020-11-08 11:51:54'),
(30, 22, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'excellent', '45.00', '0.30', '13.5', '2020-11-08 18:01:37', '2020-11-08 18:01:37'),
(31, 23, 25, '/images/products/25.jpg', 'Tomato / தக்காளி', 'excellent', '45.00', '1.00', '45', '2020-11-22 21:53:59', '2020-11-22 21:53:59'),
(32, 23, 28, '/images/products/28.jpg', 'Coriander Lettuce / மல்லி கீரை', 'excellent', '45.00', '0.10', '4.5', '2020-11-22 21:53:59', '2020-11-22 21:53:59'),
(33, 23, 28, '/images/products/28.jpg', 'Coriander Lettuce / மல்லி கீரை', 'normal', '21.00', '0.10', '2.1', '2020-11-22 21:53:59', '2020-11-22 21:53:59'),
(34, 23, 28, '/images/products/28.jpg', 'Coriander Lettuce / மல்லி கீரை', 'standard', '32.00', '0.10', '3.2', '2020-11-22 21:53:59', '2020-11-22 21:53:59'),
(35, 23, 29, '/images/products/29.jpg', 'Mint / புதினா', 'excellent', '45.00', '0.10', '4.5', '2020-11-22 21:53:59', '2020-11-22 21:53:59'),
(36, 23, 29, '/images/products/29.jpg', 'Mint / புதினா', 'normal', '21.00', '1.00', '21', '2020-11-22 21:53:59', '2020-11-22 21:53:59'),
(37, 23, 57, '/images/products/57.png', 'new demo prod', 'excellent', '150.00', '0.10', '15', '2020-11-22 21:53:59', '2020-11-22 21:53:59'),
(38, 23, 41, '/images/products/41.jpg', 'Beetroot / பீட்ரூட்', 'normal', '21.00', '1.00', '14.7', '2020-11-22 21:53:59', '2020-11-22 21:53:59'),
(39, 23, 54, '/images/products/54.png', 'Onion / வெங்காயம்', 'standard', '73.60', '1.00', '51.52', '2020-11-22 21:53:59', '2020-11-22 21:53:59'),
(40, 23, 43, '/images/products/43.jpg', 'Cauliflower / காலிஃபிளவர்', 'excellent', '45.00', '1.00', '31.5', '2020-11-22 21:53:59', '2020-11-22 21:53:59'),
(41, 23, 7, '/images/products/7.png', 'Onion / வெங்காயம்', 'standard', '32.00', '0.10', '3.2', '2020-11-22 21:53:59', '2020-11-22 21:53:59'),
(42, 23, 43, '/images/products/43.jpg', 'Cauliflower / காலிஃபிளவர்', 'normal', '21.00', '0.10', '1.89', '2020-11-22 21:53:59', '2020-11-22 21:53:59'),
(43, 23, 40, '/images/products/40.jpg', 'Cabbage / முட்டைக்கோஸ்', 'normal', '21.00', '0.10', '1.89', '2020-11-22 21:53:59', '2020-11-22 21:53:59'),
(44, 24, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'normal', '21.00', '0.10', '2.1', '2020-11-22 21:54:54', '2020-11-22 21:54:54'),
(45, 24, 43, '/images/products/43.jpg', 'Cauliflower / காலிஃபிளவர்', 'normal', '21.00', '0.10', '1.89', '2020-11-22 21:54:54', '2020-11-22 21:54:54'),
(46, 24, 40, '/images/products/40.jpg', 'Cabbage / முட்டைக்கோஸ்', 'normal', '21.00', '0.10', '1.89', '2020-11-22 21:54:54', '2020-11-22 21:54:54'),
(47, 25, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'normal', '21.00', '0.10', '2.1', '2020-11-22 23:44:13', '2020-11-22 23:44:13'),
(48, 26, 43, '/images/products/43.jpg', 'Cauliflower / காலிஃபிளவர்', 'normal', '21.00', '0.10', '1.89', '2020-11-23 17:16:46', '2020-11-23 17:16:46'),
(49, 27, 41, '/images/products/41.jpg', 'Beetroot / பீட்ரூட்', 'normal', '21.00', '0.10', '1.47', '2020-11-23 17:18:12', '2020-11-23 17:18:12'),
(50, 28, 41, '/images/products/41.jpg', 'Beetroot / பீட்ரூட்', 'normal', '21.00', '0.30', '4.41', '2020-11-24 12:17:15', '2020-11-24 12:17:15'),
(51, 30, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'normal', '21.00', '0.10', '2.1', '2020-11-24 12:25:38', '2020-11-24 12:25:38'),
(52, 31, 57, '/images/products/57.png', 'new demo prod', 'excellent', '150.00', '0.10', '15', '2020-11-24 22:32:45', '2020-11-24 22:32:45'),
(53, 31, 43, '/images/products/43.jpg', 'Cauliflower / காலிஃபிளவர்', 'normal', '21.00', '0.10', '1.89', '2020-11-24 22:32:45', '2020-11-24 22:32:45'),
(54, 31, 40, '/images/products/40.jpg', 'Cabbage / முட்டைக்கோஸ்', 'normal', '21.00', '0.10', '1.89', '2020-11-24 22:32:45', '2020-11-24 22:32:45'),
(55, 31, 54, '/images/products/54.png', 'Onion / வெங்காயம்', 'excellent', '65.10', '0.10', '6.51', '2020-11-24 22:32:45', '2020-11-24 22:32:45'),
(56, 32, 30, '/images/products/30.jpg', 'Curry leaves / கருவேப்பிலை', 'normal', '21.00', '0.10', '2.1', '2020-11-24 22:36:14', '2020-11-24 22:36:14'),
(57, 33, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'excellent', '45.00', '0.10', '4.5', '2020-11-24 23:07:41', '2020-11-24 23:07:41'),
(58, 34, 7, '/images/products/7.png', 'Onion / வெங்காயம்', 'excellent', '45.00', '0.10', '4.5', '2020-11-24 23:11:53', '2020-11-24 23:11:53'),
(59, 35, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'standard', '32.00', '0.10', '3.2', '2020-11-25 22:18:42', '2020-11-25 22:18:42'),
(60, 36, 7, '/images/products/7.png', 'Onion / வெங்காயம்', 'standard', '32.00', '0.10', '3.2', '2020-11-25 22:22:17', '2020-11-25 22:22:17'),
(61, 37, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'normal', '21.00', '0.10', '2.1', '2020-11-29 07:57:53', '2020-11-29 07:57:53'),
(62, 38, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'excellent', '45.00', '0.10', '4.5', '2020-11-29 07:58:38', '2020-11-29 07:58:38'),
(63, 39, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'excellent', '45.00', '0.10', '4.5', '2020-11-29 10:00:07', '2020-11-29 10:00:07'),
(64, 40, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'normal', '21.00', '0.10', '2.1', '2020-11-29 10:01:16', '2020-11-29 10:01:16'),
(65, 41, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'normal', '21.00', '0.10', '2.1', '2020-11-29 16:19:26', '2020-11-29 16:19:26'),
(66, 42, 33, '/images/products/33.jpg', 'Mango / மாங்காய்', 'excellent', '45.00', '0.10', '4.5', '2020-11-29 18:13:40', '2020-11-29 18:13:40'),
(67, 42, 33, '/images/products/33.jpg', 'Mango / மாங்காய்', 'standard', '32.00', '0.10', '3.2', '2020-11-29 18:13:40', '2020-11-29 18:13:40'),
(68, 42, 35, '/images/products/35.jpg', 'Ginger / இஞ்சி', 'excellent', '45.00', '0.10', '4.5', '2020-11-29 18:13:40', '2020-11-29 18:13:40'),
(69, 43, 38, '/images/products/38.jpg', 'Potato / உருளைக்கிழங்கு (Kodai)', 'normal', '21.00', '0.10', '2.1', '2020-11-29 18:35:53', '2020-11-29 18:35:53'),
(70, 43, 41, '/images/products/41.jpg', 'Beetroot / பீட்ரூட்', 'standard', '32.00', '0.10', '3.2', '2020-11-29 18:35:53', '2020-11-29 18:35:53'),
(71, 43, 40, '/images/products/40.jpg', 'Cabbage / முட்டைக்கோஸ்', 'excellent', '45.00', '0.10', '4.5', '2020-11-29 18:35:53', '2020-11-29 18:35:53'),
(72, 43, 42, '/images/products/42.jpg', 'Chow Chow / சவ் சவ்', 'normal', '21.00', '0.10', '2.1', '2020-11-29 18:35:53', '2020-11-29 18:35:53'),
(73, 43, 8, '/images/products/8.jpg', 'Small Onion / சிறிய வெங்காயம் (Sambar)', 'excellent', '45.00', '0.10', '4.5', '2020-11-29 18:35:53', '2020-11-29 18:35:53'),
(74, 43, 7, '/images/products/7.png', 'Onion / வெங்காயம்', 'normal', '21.00', '0.10', '2.1', '2020-11-29 18:35:53', '2020-11-29 18:35:53'),
(75, 43, 25, '/images/products/25.jpg', 'Tomato / தக்காளி', 'excellent', '45.00', '0.10', '4.5', '2020-11-29 18:35:53', '2020-11-29 18:35:53'),
(76, 43, 28, '/images/products/28.jpg', 'Coriander Lettuce / மல்லி கீரை', 'excellent', '45.00', '0.10', '4.5', '2020-11-29 18:35:53', '2020-11-29 18:35:53'),
(77, 43, 29, '/images/products/29.jpg', 'Mint / புதினா', 'excellent', '45.00', '0.10', '4.5', '2020-11-29 18:35:53', '2020-11-29 18:35:53'),
(78, 43, 32, '/images/products/32.jpg', 'Lemon / எலுமிச்சை', 'excellent', '45.00', '0.10', '4.5', '2020-11-29 18:35:53', '2020-11-29 18:35:53'),
(79, 43, 56, '/images/products/56.png', 'Onion / வெங்காயம் new', 'excellent', '187.50', '0.10', '18.75', '2020-11-29 18:35:53', '2020-11-29 18:35:53'),
(80, 43, 25, '/images/products/25.jpg', 'Tomato / தக்காளி', 'normal', '21.00', '0.10', '2.1', '2020-11-29 18:35:53', '2020-11-29 18:35:53'),
(81, 43, 28, '/images/products/28.jpg', 'Coriander Lettuce / மல்லி கீரை', 'normal', '21.00', '0.10', '2.1', '2020-11-29 18:35:53', '2020-11-29 18:35:53'),
(82, 44, 8, '/images/products/8.jpg', 'Small Onion / சிறிய ம் (Sambar)', 'normal', '5.00', '0.10', '0.5', '2020-12-03 20:19:48', '2020-12-03 20:19:48'),
(83, 44, 7, '/images/products/7.png', 'Onion / வெங்காயம்', 'excellent', '45.00', '0.10', '4.5', '2020-12-03 20:19:48', '2020-12-03 20:19:48'),
(84, 45, 8, '/images/products/8.jpg', 'Small Onion / சிறிய ம் (Sambar)', 'excellent', '45.00', '0.10', '4.5', '2020-12-03 20:21:00', '2020-12-03 20:21:00'),
(85, 46, 29, '/images/products/29.jpg', 'Mint / புதினா', 'normal', '21.00', '1.00', '21', '2020-12-03 20:28:05', '2020-12-03 20:28:05'),
(86, 46, 25, '/images/products/25.jpg', 'Tomato / தக்காளி', 'standard', '32.00', '0.10', '3.2', '2020-12-03 20:28:05', '2020-12-03 20:28:05'),
(87, 46, 30, '/images/products/30.jpg', 'Curry leaves / கருவேப்பிலை', 'excellent', '45.00', '0.10', '4.5', '2020-12-03 20:28:05', '2020-12-03 20:28:05'),
(88, 47, 7, '/images/products/7.png', 'Onion / வெங்காயம்', 'standard', '32.00', '0.10', '3.2', '2020-12-03 20:28:32', '2020-12-03 20:28:32'),
(89, 47, 8, '/images/products/8.jpg', 'Small Onion / சிறிய ம் (Sambar)', 'normal', '5.00', '0.10', '0.5', '2020-12-03 20:28:32', '2020-12-03 20:28:32'),
(90, 48, 8, '/images/products/8.jpg', 'Small Onion / சிறிய ம் (Sambar)', 'excellent', '45.00', '1.00', '45', '2020-12-10 16:44:00', '2020-12-10 16:44:00'),
(91, 49, 54, '/images/products/54.png', 'Onion / வெங்காயம்', 'excellent', '65.10', '10.00', '651', '2020-12-14 21:06:09', '2020-12-14 21:06:09'),
(92, 49, 25, '/images/products/25.jpg', 'Tomato / தக்காளி', 'excellent', '45.00', '0.10', '4.5', '2020-12-14 21:06:09', '2020-12-14 21:06:09'),
(93, 50, 8, '/images/products/8.jpg', 'Small Onion / சிறிய ம் (Sambar)', 'excellent', '45.00', '0.10', '4.5', '2020-12-14 21:42:28', '2020-12-14 21:42:28'),
(94, 51, 8, '/images/products/8.jpg', 'Small Onion / சிறிய ம் (Sambar)', 'excellent', '45.00', '0.10', '4.5', '2020-12-14 21:43:14', '2020-12-14 21:43:14'),
(95, 52, 7, '/images/products/7.png', 'Onion / வெங்காயம்', 'excellent', '45.00', '0.10', '4.5', '2020-12-14 21:44:17', '2020-12-14 21:44:17'),
(96, 54, 25, '/images/products/25.jpg', 'Tomato / தக்காளி', 'excellent', '45.00', '0.10', '4.5', '2020-12-14 21:49:56', '2020-12-14 21:49:56'),
(97, 55, 7, '/images/products/7.png', 'Onion / வெங்காயம்', 'excellent', '45.00', '0.10', '4.5', '2020-12-14 21:57:41', '2020-12-14 21:57:41'),
(98, 56, 25, '/images/products/25.jpg', 'Tomato / தக்காளி', 'excellent', '45.00', '0.10', '4.5', '2020-12-14 21:59:16', '2020-12-14 21:59:16'),
(99, 57, 25, '/images/products/25.jpg', 'Tomato / தக்காளி', 'excellent', '45.00', '0.10', '4.5', '2020-12-14 22:08:04', '2020-12-14 22:08:04'),
(100, 60, 25, '/images/products/25.jpg', 'Tomato / தக்காளி', 'normal', '21.00', '0.10', '2.1', '2020-12-14 22:10:11', '2020-12-14 22:10:11'),
(101, 61, 29, '/images/products/29.jpg', 'Mint / புதினா', 'excellent', '45.00', '0.10', '4.5', '2020-12-14 22:34:16', '2020-12-14 22:34:16'),
(102, 61, 25, '/images/products/25.jpg', 'Tomato / தக்காளி', 'standard', '32.00', '0.10', '3.2', '2020-12-14 22:34:16', '2020-12-14 22:34:16'),
(103, 62, 30, '/images/products/30.jpg', 'Curry leaves / கருவேப்பிலை', 'normal', '21.00', '0.10', '2.1', '2020-12-14 22:39:30', '2020-12-14 22:39:30'),
(104, 63, 54, '/images/products/54.png', 'Onion / வெங்காயம்', 'standard', '73.60', '10.00', '736', '2020-12-15 12:46:40', '2020-12-15 12:46:40'),
(105, 63, 31, '/images/products/31.jpg', 'Chilli / மிளகாய்', 'normal', '21.00', '10.00', '210', '2020-12-15 12:46:40', '2020-12-15 12:46:40'),
(106, 63, 57, '/images/products/57.png', 'new demo prod', 'standard', '120.00', '10.00', '1200', '2020-12-15 12:46:40', '2020-12-15 12:46:40'),
(107, 64, 8, '/images/products/8.jpg', 'Small Onion / சிறிய ம் (Sambar)', 'normal', '5.00', '10.00', '50', '2020-12-17 22:09:08', '2020-12-17 22:09:08'),
(108, 65, 8, '/images/products/8.jpg', 'Small Onion / சிறிய ம் (Sambar)', 'normal', '5.00', '10.00', '50', '2020-12-17 22:12:36', '2020-12-17 22:12:36'),
(109, 66, 42, '/images/products/42.jpg', 'Chow Chow / சவ் சவ்', 'normal', '21.00', '10.00', '189', '2020-12-17 22:13:23', '2020-12-17 22:13:23'),
(110, 66, 41, '/images/products/41.jpg', 'Beetroot / பீட்ரூட்', 'standard', '32.00', '10.00', '288', '2020-12-17 22:13:23', '2020-12-17 22:13:23'),
(111, 71, 28, '/images/products/28.jpg', 'Coriander Lettuce / மல்லி கீரை', 'normal', '21.00', '0.10', '2.1', '2020-12-23 15:12:11', '2020-12-23 15:12:11'),
(112, 71, 7, '/images/products/7.png', 'Onion / வெங்காயம்', 'excellent', '45.00', '0.15', '6.75', '2020-12-23 15:12:11', '2020-12-23 15:12:11'),
(113, 71, 43, '/images/products/43.jpg', 'Cauliflower / காலிஃபிளவர்', 'normal', '21.00', '0.10', '1.89', '2020-12-23 15:12:11', '2020-12-23 15:12:11'),
(114, 71, 40, '/images/products/40.jpg', 'Cabbage / முட்டைக்கோஸ்', 'normal', '21.00', '0.10', '1.89', '2020-12-23 15:12:11', '2020-12-23 15:12:11'),
(115, 72, 8, '/images/products/8.jpg', 'Small Onion / சிறிய ம் (Sambar)', 'normal', '5.00', '0.10', '0.5', '2020-12-24 10:28:54', '2020-12-24 10:28:54'),
(116, 72, 41, '/images/products/41.jpg', 'Beetroot / பீட்ரூட்', 'normal', '21.00', '0.10', '1.47', '2020-12-24 10:28:54', '2020-12-24 10:28:54'),
(117, 72, 54, '/images/products/54.png', 'Onion / வெங்காயம்', 'standard', '73.60', '0.10', '5.152', '2020-12-24 10:28:54', '2020-12-24 10:28:54'),
(118, 72, 43, '/images/products/43.jpg', 'Cauliflower / காலிஃபிளவர்', 'excellent', '45.00', '0.10', '3.15', '2020-12-24 10:28:54', '2020-12-24 10:28:54'),
(119, 73, 8, '/images/products/8.jpg', 'Small Onion / சிறிய ம் (Sambar)', 'normal', '5.00', '0.10', '0.5', '2020-12-31 09:27:19', '2020-12-31 09:27:19'),
(120, 74, 8, '/images/products/8.jpg', 'Small Onion / சிறிய ம் (Sambar)', 'normal', '5.00', '0.10', '0.5', '2020-12-31 16:23:10', '2020-12-31 16:23:10'),
(121, 75, 7, '/images/products/7.png', 'Onion / வெங்காயம்', 'standard', '32.00', '2.00', '64', '2021-01-11 12:59:42', '2021-01-11 12:59:42'),
(122, 75, 43, '/images/products/43.jpg', 'Cauliflower / காலிஃபிளவர்', 'normal', '21.00', '0.30', '5.67', '2021-01-11 12:59:42', '2021-01-11 12:59:42'),
(123, 75, 40, '/images/products/40.jpg', 'Cabbage / முட்டைக்கோஸ்', 'normal', '21.00', '0.30', '5.67', '2021-01-11 12:59:42', '2021-01-11 12:59:42'),
(124, 75, 8, '/images/products/8.jpg', 'Small Onion / சிறிய ம் (Sambar)', 'excellent', '45.00', '0.10', '4.5', '2021-01-11 12:59:42', '2021-01-11 12:59:42'),
(125, 75, 27, '/images/products/27.jpg', 'Tomato Hybrid / தக்காளி', 'excellent', '45.00', '0.10', '4.5', '2021-01-11 12:59:42', '2021-01-11 12:59:42'),
(126, 76, 8, '/images/products/8.jpg', 'Small Onion / சிறிய ம் (Sambar)', 'normal', '5.00', '0.10', '0.5', '2021-01-11 21:47:24', '2021-01-11 21:47:24'),
(127, 76, 7, '/images/products/7.png', 'Onion / வெங்காயம்', 'normal', '21.00', '0.10', '2.1', '2021-01-11 21:47:24', '2021-01-11 21:47:24'),
(128, 76, 25, '/images/products/25.jpg', 'Tomato / தக்காளி', 'excellent', '45.00', '0.15', '6.75', '2021-01-11 21:47:24', '2021-01-11 21:47:24'),
(129, 76, 28, '/images/products/28.jpg', 'Coriander Lettuce / மல்லி கீரை', 'excellent', '45.00', '0.10', '4.5', '2021-01-11 21:47:24', '2021-01-11 21:47:24'),
(130, 77, 31, '/images/products/31.jpg', 'Chilli / மிளகாய்', 'normal', '21.00', '0.10', '2.1', '2021-01-11 21:49:28', '2021-01-11 21:49:28'),
(131, 78, 66, '/images/products/66.jpg', 'Yam/ கருணை கிழங்கு', 'standard', '3.00', '1.00', '3', '2021-02-23 16:58:47', '2021-02-23 16:58:47'),
(132, 78, 64, '/images/products/64.jpeg', 'Ridish/ முள்ளங்கி', 'standard', '2.97', '1.00', '2.97', '2021-02-23 16:58:47', '2021-02-23 16:58:47'),
(133, 78, 63, '/images/products/63.jpg', 'Corn / சோளம்', 'normal', '2.00', '1.00', '2', '2021-02-23 16:58:47', '2021-02-23 16:58:47'),
(134, 79, 8, '/images/products/8.jpg', 'Small Onion / சிறிய ம் (Sambar)', 'excellent', '5.00', '1.00', '5', '2021-02-23 20:27:08', '2021-02-23 20:27:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_incentives`
--

CREATE TABLE `order_incentives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_rejects`
--

CREATE TABLE `order_rejects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_rejects`
--

INSERT INTO `order_rejects` (`id`, `delivery_id`, `order_id`, `created_at`, `updated_at`) VALUES
(2, 5, 47, '2020-12-07 09:42:28', '2020-12-07 09:42:28'),
(3, 5, 67, '2020-12-23 10:42:01', '2020-12-23 10:42:01'),
(4, 5, 70, '2020-12-25 16:30:28', '2020-12-25 16:30:28'),
(5, 5, 69, '2020-12-25 16:31:13', '2020-12-25 16:31:13'),
(6, 5, 74, '2021-01-11 12:59:54', '2021-01-11 12:59:54'),
(9, 5, 73, '2021-01-14 18:32:05', '2021-01-14 18:32:05'),
(10, 5, 61, '2021-01-14 18:32:17', '2021-01-14 18:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'pending', '2020-09-25 23:36:00', '2020-09-25 23:36:00'),
(2, 'packing', '2020-09-25 23:36:00', '2020-09-25 23:36:00'),
(3, 'success', '2020-09-25 23:36:00', '2020-09-25 23:36:00'),
(4, 'cancelled', '2020-09-25 23:36:00', '2020-09-25 23:36:00'),
(5, 'on the way', '2020-09-25 23:36:00', '2020-09-25 23:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Cash On Delivery', '2020-09-25 22:35:00', '2020-09-25 22:35:00'),
(2, 'Card', '2020-09-25 22:35:00', '2020-09-25 22:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_statuses`
--

CREATE TABLE `payment_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_statuses`
--

INSERT INTO `payment_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'unpaid', '2020-09-25 22:30:00', '2020-09-25 22:30:00'),
(2, 'paid', '2020-09-25 22:30:00', '2020-09-25 22:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` decimal(5,2) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  `price` decimal(5,2) NOT NULL,
  `excellent_cost` decimal(5,2) NOT NULL DEFAULT 0.00,
  `excellent_discount` int(191) NOT NULL DEFAULT 0,
  `excellent_price` decimal(5,2) NOT NULL DEFAULT 0.00,
  `standard_cost` decimal(5,2) NOT NULL DEFAULT 0.00,
  `standard_discount` int(191) NOT NULL DEFAULT 0,
  `standard_price` decimal(5,2) NOT NULL DEFAULT 0.00,
  `type` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `excellent_stock` decimal(5,2) NOT NULL DEFAULT 0.00,
  `standard_stock` decimal(5,2) NOT NULL DEFAULT 0.00,
  `min_qty` decimal(5,2) NOT NULL DEFAULT 0.00,
  `standard_min_qty` decimal(5,2) NOT NULL DEFAULT 0.00,
  `excellent_min_qty` decimal(5,2) NOT NULL DEFAULT 0.00,
  `category` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Regular',
  `description` varchar(10000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'kg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `cost`, `discount`, `price`, `excellent_cost`, `excellent_discount`, `excellent_price`, `standard_cost`, `standard_discount`, `standard_price`, `type`, `stock`, `excellent_stock`, `standard_stock`, `min_qty`, `standard_min_qty`, `excellent_min_qty`, `category`, `description`, `unit`, `created_at`, `updated_at`) VALUES
(8, 'Small Onion / சிறிய ம் (Sambar)', '/images/products/8.jpg', '3.00', 10, '2.70', '5.00', 10, '5.00', '4.00', 20, '3.20', 1, 70, '43.30', '46.10', '1.00', '1.00', '1.00', 'Regular', 'Onion helps in improving heart health · 2. It can give you healthy bones in', 'kg', '2020-10-14 10:48:36', '2021-02-23 20:27:08'),
(7, 'Onion / வெங்காயம்', '/images/products/7.jpg', '7.00', 30, '7.00', '9.00', 10, '9.00', '8.00', 20, '8.00', 1, 91, '49.00', '7.00', '1.00', '1.00', '1.00', 'Regular', 'The onion (Allium cepa L., from Latin cepa \"onion\"), also known as the bulb onion or common onion, is a vegetable that is the most widely cultivated species of the genus Allium', 'kg', '2020-10-14 10:41:45', '2021-02-10 12:03:15'),
(25, 'Tomato / தக்காளி', '/images/products/25.jpg', '4.00', 30, '4.00', '8.00', 10, '8.00', '6.00', 20, '6.00', 1, 50, '48.00', '49.80', '1.00', '1.00', '1.00', 'Regular', 'gf', 'kg', '2020-10-14 13:18:46', '2021-02-06 14:53:46'),
(27, 'Tomato Hybrid / தக்காளி', '/images/products/27.jpg', '5.00', 30, '5.00', '7.00', 10, '7.00', '6.00', 20, '6.00', 1, 50, '49.00', '50.00', '1.00', '1.00', '1.00', 'Regular', 'Immunity and Beauty. Packed with vitamin C, a cherry tomato boosts immunity and acts as an antioxidant. It is also used in beauty care for both skin and hair. The Lycopene in cherry tomato naturally protects the skin from the sun and acts as a sunblock.', 'kg', '2020-10-14 16:20:59', '2021-02-06 14:54:07'),
(28, 'Coriander Lettuce / மல்லி கீரை', '/images/products/28.jpg', '1.00', 30, '1.00', '3.00', 10, '3.00', '2.00', 20, '2.00', 1, 50, '49.00', '49.90', '1.00', '1.00', '1.00', 'Regular', 'Freshly chopped coriander leaves are a great addition to green salad. It is also rich in many vital vitamins including folic-acid, vitamin-A, beta carotene and vitamin-C that are essential for optimum health. Vitamin-C is a powerful natural antioxidant', 'kg', '2020-10-14 16:22:50', '2021-02-06 14:54:30'),
(29, 'Mint / புதினா', '/images/products/29.jpg', '1.00', 30, '1.00', '3.00', 10, '3.00', '2.00', 20, '2.00', 1, 48, '49.00', '50.00', '1.00', '1.00', '1.00', 'Regular', 'The potent anti-inflammatory properties of mint leaves are well-known to alleviate congestion of the throat, bronchi and lungs and provides relief', 'kg', '2020-10-14 16:24:18', '2021-02-06 14:54:49'),
(30, 'Curry leaves / கருவேப்பிலை', '/images/products/30.jpg', '1.00', 30, '1.00', '2.00', 10, '2.00', '2.00', 20, '2.00', 1, 50, '49.00', '50.00', '1.00', '1.00', '1.00', 'Regular', '1. Rich in powerful plant compounds · 2. May reduce heart disease risk factors', 'kg', '2020-10-14 16:25:55', '2021-02-06 14:55:10'),
(31, 'Chilli / மிளகாய்', '/images/products/31.jpg', '6.00', 30, '6.00', '8.00', 10, '8.00', '7.00', 20, '7.00', 1, 40, '50.00', '50.00', '1.00', '1.00', '1.00', 'Regular', 'Chili peppers are very high in this powerful antioxidant, which is important for wound healing and immune function.', 'kg', '2020-10-14 16:27:28', '2021-02-06 14:55:30'),
(68, 'Lemon/ எலுமிச்சை', '/images/products/68.jpg', '1.00', 0, '1.00', '3.00', 1, '2.97', '2.00', 1, '1.98', 1, 100, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', '1. Support Heart Health. Lemons are a good source of vitamin C. One lemon provides about 31 mg of vitamin C,', 'kg', '2021-02-15 17:46:15', '2021-02-15 17:46:15'),
(33, 'Mango / மாங்காய்', '/images/products/33.jpg', '8.00', 30, '8.00', '10.00', 10, '10.00', '9.00', 20, '8.00', 1, 50, '49.90', '49.90', '100.00', '1.00', '11.00', 'Regular', '1. Helps in digestion Mangoes could help facilitate healthy digestion.', 'kg', '2020-10-14 16:30:10', '2021-02-06 14:57:29'),
(34, 'Coconut / தேங்காய்', '/images/products/34.jpg', '6.00', 30, '6.00', '8.00', 10, '8.00', '7.00', 20, '7.00', 1, 50, '50.00', '50.00', '1.00', '1.00', '1.00', 'Regular', 'Image result for coconut benefits\r\nCoconut is a high-fat fruit that has a wide range of health benefits. These include providing you with disease-fighting antioxidants, promoting blood sugar regulation, and reducing certain risk factors for heart disease', 'kg', '2020-10-14 16:31:26', '2021-02-06 14:57:49'),
(35, 'Ginger / இஞ்சி', '/images/products/35.jpg', '4.00', 30, '4.00', '6.00', 10, '6.00', '5.00', 20, '5.00', 1, 50, '49.90', '50.00', '1.00', '1.00', '1.00', 'Regular', '1. Contains gingerol, which has powerful medicinal properties · 2. Can treat many forms of nausea, especially morning', 'kg', '2020-10-14 16:32:39', '2021-02-06 14:58:10'),
(36, 'Garlic / பூண்டு', '/images/products/36.', '3.00', 30, '3.00', '6.00', 10, '6.00', '5.00', 20, '5.00', 1, 50, '50.00', '50.00', '1.00', '1.00', '1.00', 'Regular', 'Garlic is a part of the onion family and the \'bulb\' of this herb typically consists of 10-20 smaller sections', 'kg', '2020-10-14 16:34:07', '2021-02-15 17:49:34'),
(37, 'Potato / உருளைக்கிழங்கு (Agra)', '/images/products/37.jpg', '8.00', 10, '8.00', '10.00', 10, '10.00', '9.00', 20, '9.00', 1, 50, '50.00', '50.00', '1.00', '1.00', '1.00', 'Regular', 'Potatoes are an excellent source of vitamin C, Potassium, fibre, B vitamins copper, tryptophan, manganese and even lutein, notes the book', 'kg', '2020-10-14 16:35:37', '2021-02-06 14:58:49'),
(38, 'Potato / உருளைக்கிழங்கு (Kodai)', '/images/products/38.jpg', '9.00', 30, '9.00', '11.00', 10, '11.00', '10.00', 20, '10.00', 1, 50, '50.00', '50.00', '1.00', '1.00', '1.00', 'Regular', 'Potatoes are an excellent source of vitamin C, Potassium, fibre, B vitamins copper, tryptophan, manganese and even lutein, notes the book', 'kg', '2020-10-14 16:36:43', '2021-02-06 14:59:10'),
(39, 'Carrot /கேரட்', '/images/products/39.png', '5.00', 30, '5.00', '7.00', 10, '7.00', '6.00', 20, '6.00', 1, 50, '50.00', '50.00', '1.00', '1.00', '1.00', 'Regular', 'Potatoes are an excellent source of vitamin C, Potassium, fibre, B vitamins copper, tryptophan, manganese and even lutein, notes the book', 'kg', '2020-10-14 16:37:22', '2021-02-15 13:52:48'),
(40, 'Cabbage / முட்டைக்கோஸ்', '/images/products/40.jpg', '3.00', 30, '3.00', '5.00', 10, '5.00', '4.00', 20, '4.00', 1, 50, '49.80', '49.90', '1.00', '1.00', '1.00', 'Regular', 'Cabbage has 1 gram of fiber for every 10 calories. That helps fill you up, so you eat less. It also keeps you regular, and it could help lower your “bad” (LDL) cholesterol and control your blood sugar. Cabbage also has nutrients that keep the lining of your stomach and intestines strong.', 'kg', '2020-10-14 16:58:59', '2021-02-06 14:59:51'),
(41, 'Beetroot / பீட்ரூட்', '/images/products/41.jpg', '2.00', 30, '2.00', '54.00', 10, '4.00', '3.00', 20, '3.00', 1, 50, '49.00', '39.90', '1.00', '1.00', '1.00', 'Regular', 'beetroots are a great source of fiber, folate (vitamin B9), manganese, potassium, iron, and vitamin C. Beetroots and beetroot juice have been associated with numerous health benefits, including improved blood flow, lower blood pressure, and increased exercise performance', 'kg', '2020-10-14 17:00:43', '2021-02-06 15:00:10'),
(42, 'Chow Chow / சவ் சவ்', '/images/products/42.jpg', '4.00', 30, '4.00', '6.00', 10, '6.00', '5.00', 20, '5.00', 1, 40, '50.00', '50.00', '1.00', '1.00', '1.00', 'Regular', 'It also contains folate (which is great for cell division and for pregnant women), vitamin B6 and vitamin K. Minerals like potassium, manganese, zinc and copper are also found in this squash. Chow chow is rich in antioxidants, keeping inflammation at bay and ailments like cancers and joint pains.', 'kg', '2020-10-14 17:03:26', '2021-02-06 15:00:29'),
(43, 'Cauliflower / காலிஃபிளவர்', '/images/products/43.jpg', '2.00', 30, '2.00', '4.00', 10, '4.00', '3.00', 20, '3.00', 1, 50, '49.80', '49.90', '1.00', '1.00', '1.00', 'Regular', 'The nutrition profile of cauliflower is quite impressive. Cauliflower is very low in calories yet high in vitamins', 'kg', '2020-10-14 17:04:36', '2021-02-06 15:00:56'),
(53, 'Broccoli / ப்ரோக்கோலி', '/images/products/53.png', '8.00', 30, '8.00', '10.00', 10, '10.00', '9.00', 20, '9.00', 1, 50, '50.00', '50.00', '1.00', '1.00', '1.00', 'Regular', 'nn', 'kg', '2020-10-18 06:00:40', '2021-02-06 15:01:18'),
(54, 'Onion / வெங்காயம்', '/images/products/54.png', '5.00', 10, '5.00', '7.00', 7, '7.00', '6.00', 8, '6.00', 1, 980, '788.90', '789.90', '1.00', '1.00', '1.00', '5', 'none', 'kg', '2020-11-03 09:05:53', '2021-02-06 15:01:41'),
(55, 'Tomato / தக்காளி', '/images/products/55.jpg', '2.00', 10, '2.00', '4.00', 6, '4.00', '3.00', 8, '3.00', 1, 1000, '500.00', '800.00', '1.00', '1.00', '1.00', '5', 'tomato', 'kg', '2020-11-03 09:07:11', '2021-02-06 15:02:13'),
(56, 'Onion / வெங்காயம் new', '/images/products/56.png', '3.00', 10, '3.00', '5.00', 25, '5.00', '4.00', 15, '4.00', 1, 100, '79.90', '70.00', '1.00', '1.00', '1.00', 'Regular', 'demo descrition', 'kg', '2020-11-08 17:26:55', '2021-02-06 15:02:34'),
(57, 'Brinjal/ கத்திரிக்காய்', '/images/products/57.jpg', '3.00', 1, '2.97', '5.00', 1, '4.95', '3.00', 1, '2.97', 1, 100, '100.00', '90.00', '1.00', '1.00', '1.00', 'Regular', 'Brinjal', 'kg', '2020-11-21 15:46:01', '2021-02-15 13:17:24'),
(58, 'Ridge gourd/ பீர்க்கங்காய்', '/images/products/58.jpg', '3.00', 1, '2.97', '5.00', 1, '4.95', '4.00', 1, '3.96', 1, 80, '80.00', '80.00', '1.00', '1.00', '1.00', 'Regular', 'Ridge gourd', 'kg', '2021-02-15 13:14:34', '2021-02-15 13:14:34'),
(59, 'Capsicum/ குடைமிளகாய்', '/images/products/59.jpg', '2.00', 1, '1.98', '4.00', 1, '3.96', '3.00', 1, '2.97', 1, 80, '80.00', '80.00', '1.00', '1.00', '1.00', 'Regular', 'Capsicum', 'kg', '2021-02-15 13:23:52', '2021-02-15 13:23:52'),
(60, 'Bitter gourd /பாகற்காய்', '/images/products/60.jpg', '2.00', 0, '2.00', '4.00', 0, '4.00', '3.00', 0, '3.00', 1, 100, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'Bitter', 'kg', '2021-02-15 13:27:18', '2021-02-15 13:27:18'),
(61, 'Mushroom / காளான்', '/images/products/61.jpg', '5.00', 1, '4.95', '6.00', 1, '5.94', '6.00', 1, '5.94', 1, 100, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'காளான்', 'kg', '2021-02-15 13:42:43', '2021-02-15 13:42:43'),
(62, 'Sweet Corn / இனிப்பு சோளம்', '/images/products/62.jpeg', '3.00', 0, '3.00', '5.00', 0, '5.00', '4.00', 0, '4.00', 1, 200, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'Sweet Corn', 'kg', '2021-02-15 13:44:33', '2021-02-15 13:44:33'),
(63, 'Corn / சோளம்', '/images/products/63.jpg', '2.00', 0, '2.00', '3.00', 0, '3.00', '2.00', 0, '2.00', 1, 99, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'Corn', 'kg', '2021-02-15 13:45:45', '2021-02-23 16:58:47'),
(64, 'Ridish/ முள்ளங்கி', '/images/products/64.jpeg', '2.00', 1, '1.98', '4.00', 1, '3.96', '3.00', 1, '2.97', 1, 100, '100.00', '99.00', '1.00', '1.00', '1.00', 'Regular', 'Ridish', 'kg', '2021-02-15 13:49:01', '2021-02-23 16:58:47'),
(65, 'Soyabean/ சோயா', '/images/products/65.jpg', '3.00', 1, '2.97', '5.00', 1, '4.95', '4.00', 1, '3.96', 1, 100, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'Soyabean', 'kg', '2021-02-15 14:06:39', '2021-02-15 18:25:40'),
(66, 'Yam/ கருணை கிழங்கு', '/images/products/66.jpg', '2.00', 0, '2.00', '3.00', 1, '2.97', '3.00', 0, '3.00', 1, 100, '100.00', '99.00', '1.00', '1.00', '1.00', 'Regular', 'Yam', 'kg', '2021-02-15 14:12:26', '2021-02-23 16:58:47'),
(67, 'Elephant foot yam /சேனை கிழங்கு', '/images/products/67.jpg', '2.00', 0, '2.00', '4.00', 2, '3.92', '3.00', 0, '3.00', 1, 100, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'Elephant food yam', 'kg', '2021-02-15 14:14:09', '2021-02-15 18:43:14'),
(69, 'Colacasa / சேம்பு', '/images/products/69.', '2.00', 1, '1.98', '4.00', 1, '3.96', '3.00', 1, '2.97', 1, 100, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'Colacasa', 'kg', '2021-02-15 18:10:12', '2021-02-15 18:10:12'),
(70, 'Sweet potato /  சக்கரவள்ளி கிழங்கு', '/images/products/70.jpg', '2.00', 1, '1.98', '4.00', 1, '3.96', '3.00', 1, '2.97', 1, 100, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'Sweet potato', 'kg', '2021-02-15 18:13:46', '2021-02-15 18:13:46'),
(71, 'Peas/ பச்சை பட்டாணி', '/images/products/71.jpg', '2.00', 0, '2.00', '4.00', 1, '3.96', '3.00', 1, '2.97', 1, 100, '100.00', '100.00', '3.00', '1.00', '1.00', 'Regular', 'Peas', 'kg', '2021-02-15 18:21:40', '2021-02-15 18:21:40'),
(72, 'Butter beans/ பட்டர் பீன்ஸ்', '/images/products/72.jpg', '3.00', 1, '2.97', '5.00', 1, '4.95', '4.00', 1, '3.96', 1, 100, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'Bettur beans', 'kg', '2021-02-15 18:24:57', '2021-02-15 18:42:52'),
(73, 'German Beans/ஜெர்மன் பீன்ஸ்', '/images/products/73.jpg', '2.00', 1, '1.98', '4.00', 1, '3.96', '3.00', 1, '2.97', 1, 100, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'German Beans', 'kg', '2021-02-15 18:28:39', '2021-02-15 18:28:39'),
(74, 'Ring beans / ரிங்க் பீன்ஸ்', '/images/products/74.jpg', '2.00', 1, '1.98', '4.00', 1, '3.96', '3.00', 1, '2.97', 1, 100, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'Ring beans', 'kg', '2021-02-15 18:30:56', '2021-02-15 18:30:56'),
(75, 'beans / முருங்கை பீன்ஸ்', '/images/products/75.jpg', '1.00', 0, '1.00', '3.00', 0, '2.97', '2.00', 0, '1.98', 1, 100, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'Beans', 'kg', '2021-02-15 18:32:45', '2021-02-15 18:32:45'),
(76, 'Broad beans/ அவரைக்காய்', '/images/products/76.jpg', '1.00', 0, '1.00', '4.00', 1, '3.96', '3.00', 1, '2.97', 1, 100, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'Broad beans', 'kg', '2021-02-15 18:35:45', '2021-02-15 18:35:45'),
(77, 'Lima beans  /மொச்சக் கொட்டை', '/images/products/77.jpg', '2.00', 0, '2.00', '4.00', 1, '3.96', '3.00', 0, '3.00', 1, 100, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'Lima beans', 'kg', '2021-02-15 18:38:16', '2021-02-15 18:38:16'),
(78, 'Cluster beans / சீனி அவரைக்காய்', '/images/products/78.jpg', '2.00', 0, '2.00', '4.00', 1, '3.96', '3.00', 1, '2.97', 1, 100, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'Cluster', 'kg', '2021-02-15 18:42:13', '2021-02-15 18:42:13'),
(79, 'Drumstick /முருங்கைக்காய்', '/images/products/79.png', '1.00', 0, '1.00', '3.00', 0, '3.00', '2.00', 0, '2.00', 1, 100, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'Drumstick', 'kg', '2021-02-15 18:44:32', '2021-02-15 18:44:32'),
(80, 'Bottle gourd / சுரக்காய்', '/images/products/80.jpg', '1.00', 0, '1.00', '3.00', 0, '3.00', '2.00', 0, '2.00', 1, 100, '100.00', '100.00', '1.00', '1.00', '100.00', 'Regular', 'Bottle gourd', 'kg', '2021-02-15 18:47:10', '2021-02-15 18:47:10'),
(81, 'Snake gourd short /  புடலங்காய் சின்னது', '/images/products/81.jpg', '2.00', 0, '2.00', '4.00', 1, '3.96', '3.00', 0, '3.00', 1, 100, '100.00', '100.00', '1.00', '1.00', '1.00', 'Regular', 'Sanke gourd', 'kg', '2021-02-15 18:51:07', '2021-02-15 19:09:59');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Normal', '2020-09-25 20:30:00', '2020-09-25 20:30:00'),
(3, 'Hot', '2020-09-25 20:30:00', '2020-09-25 20:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `salary_paids`
--

CREATE TABLE `salary_paids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_count` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_charge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weekly_incentive` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_incentive` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shipping_charge` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `shipping_charge`, `created_at`, `updated_at`) VALUES
(1, '50', '2023-02-25 15:06:39', '2023-02-25 15:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'auto',
  `door_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `village` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `name`, `image`, `email`, `phone`, `delivery`, `door_no`, `village`, `district`, `pincode`, `state`, `country`, `created_at`, `updated_at`) VALUES
(1, 'AMVGON', '/images/logo/1.png', 'nihalshameem6@gmail.com', '7397134351', 'auto', '20,East Street', 'Melapalaym', 'Tirunelveli', '627005', 'Tamil Nadu', 'India', '2020-09-22 23:36:00', '2020-11-29 18:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'nihals', 'nihalshameem6@gmail.com', NULL, '$2y$10$gzFZHQFD1X0paetTcpn2mehnnjmFCuNS8LVLyCN6Q5RIyQk3ts5PK', NULL, '2020-09-22 04:20:31', '2020-09-22 04:20:31');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_incentives`
--

CREATE TABLE `weekly_incentives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(5,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amount_incentives`
--
ALTER TABLE `amount_incentives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bonuses`
--
ALTER TABLE `bonuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `combo_details`
--
ALTER TABLE `combo_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `combo_products`
--
ALTER TABLE `combo_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_cares`
--
ALTER TABLE `customer_cares`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_charges`
--
ALTER TABLE `delivery_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_days`
--
ALTER TABLE `delivery_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_ratings`
--
ALTER TABLE `delivery_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_requests`
--
ALTER TABLE `delivery_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_salaries`
--
ALTER TABLE `delivery_salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_times`
--
ALTER TABLE `delivery_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `function_models`
--
ALTER TABLE `function_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `get_cashes`
--
ALTER TABLE `get_cashes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `offer_banners`
--
ALTER TABLE `offer_banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_incentives`
--
ALTER TABLE `order_incentives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_rejects`
--
ALTER TABLE `order_rejects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_paids`
--
ALTER TABLE `salary_paids`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `weekly_incentives`
--
ALTER TABLE `weekly_incentives`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `amount_incentives`
--
ALTER TABLE `amount_incentives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `bonuses`
--
ALTER TABLE `bonuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `combo_details`
--
ALTER TABLE `combo_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `combo_products`
--
ALTER TABLE `combo_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `customer_cares`
--
ALTER TABLE `customer_cares`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `delivery_charges`
--
ALTER TABLE `delivery_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `delivery_days`
--
ALTER TABLE `delivery_days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery_ratings`
--
ALTER TABLE `delivery_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `delivery_requests`
--
ALTER TABLE `delivery_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `delivery_salaries`
--
ALTER TABLE `delivery_salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery_times`
--
ALTER TABLE `delivery_times`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `function_models`
--
ALTER TABLE `function_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `get_cashes`
--
ALTER TABLE `get_cashes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `offer_banners`
--
ALTER TABLE `offer_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `order_incentives`
--
ALTER TABLE `order_incentives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_rejects`
--
ALTER TABLE `order_rejects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salary_paids`
--
ALTER TABLE `salary_paids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `weekly_incentives`
--
ALTER TABLE `weekly_incentives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
