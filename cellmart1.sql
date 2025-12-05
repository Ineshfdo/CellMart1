-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2025 at 02:12 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cellmart1`
--

-- --------------------------------------------------------

--
-- Table structure for table `accepted_orders`
--

CREATE TABLE `accepted_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `delivery_address` text NOT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`products`)),
  `total_amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'LKR',
  `status` varchar(255) NOT NULL DEFAULT 'accepted',
  `accepted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accepted_orders`
--

INSERT INTO `accepted_orders` (`id`, `user_id`, `customer_name`, `customer_email`, `customer_phone`, `delivery_address`, `products`, `total_amount`, `currency`, `status`, `accepted_at`, `created_at`, `updated_at`) VALUES
(1, 3, 'Inesh Fernando', 'ineshfernando643@gmail.com', '0758690018', '123 Galle Road\r\n54 Colombo Road', '[{\"product_id\":13,\"name\":\"Google Pixel 8\",\"price\":\"170000.00\",\"quantity\":\"1\",\"color\":\"Black\",\"warranty\":\"1 Year Company Warranty\",\"subtotal\":170000,\"image\":\"Images\\/8.jpg\",\"currency\":\"LKR\"}]', 170000.00, 'LKR', 'accepted', '2025-12-04 12:10:59', '2025-12-04 05:35:07', '2025-12-04 12:10:59'),
(2, 4, 'Heelow 123', 'ineshfernando643@gmail.com', '+94758690018', '123 Galle Road\r\n54 Colombo Road', '[{\"product_id\":16,\"name\":\"Google Pixel 9 Pro\",\"price\":\"360000.00\",\"quantity\":\"1\",\"color\":\"Black\",\"warranty\":\"1 Year Company Warranty\",\"subtotal\":360000,\"image\":\"Images\\/9-pro.jpg\",\"currency\":\"LKR\"},{\"product_id\":2,\"name\":\"iPhone Charger 20W\",\"price\":\"10000.00\",\"quantity\":\"2\",\"color\":\"Black\",\"warranty\":\"1 Year Company Warranty\",\"subtotal\":20000,\"image\":\"Images\\/acharger.webp\",\"currency\":\"LKR\"}]', 380000.00, 'LKR', 'accepted', '2025-12-05 07:25:59', '2025-12-05 06:14:49', '2025-12-05 07:25:59');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-4cd555cc3cdff73bf0182122b6ef40ed', 'i:1;', 1764939168),
('laravel-cache-4cd555cc3cdff73bf0182122b6ef40ed:timer', 'i:1764939168;', 1764939168),
('laravel-cache-8105abac9122061c4b4d0c70197eaeb6', 'i:1;', 1764935847),
('laravel-cache-8105abac9122061c4b4d0c70197eaeb6:timer', 'i:1764935847;', 1764935847),
('laravel-cache-c0bf54f057c168992b895785852a0b03', 'i:1;', 1764845597),
('laravel-cache-c0bf54f057c168992b895785852a0b03:timer', 'i:1764845597;', 1764845597);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Inesh Fernando', 'ineshfernando643@gmail.com', '0758690018', 'About Mobile Phones', 'This is a great mobile phone iphone 17 pro max', '2025-12-03 23:11:54', '2025-12-03 23:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_02_075243_add_two_factor_columns_to_users_table', 1),
(5, '2025_12_03_043842_create_products_table', 2),
(6, '2025_12_03_134346_create_orders_table', 3),
(7, '2025_12_04_043715_create_feedback_table', 4),
(8, '2025_12_04_051645_add_phone_to_users_table', 5),
(9, '2025_12_04_051807_add_user_id_to_orders_table', 5),
(11, '2025_12_04_102228_add_type_to_users_table', 6),
(12, '2025_12_04_173554_create_accepted_orders_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `delivery_address` text NOT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`products`)),
  `total_amount` decimal(10,2) NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'LKR',
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_name`, `customer_email`, `customer_phone`, `delivery_address`, `products`, `total_amount`, `currency`, `status`, `created_at`, `updated_at`) VALUES
(6, 3, 'Kavinda Fernando', 'kavindafernando@gmail.com', '0358690018', '123 Galle Road\r\n54 Colombo Road', '[{\"product_id\":16,\"name\":\"Google Pixel 9 Pro\",\"price\":\"360000.00\",\"quantity\":\"4\",\"color\":\"Black\",\"warranty\":\"1 Year Company Warranty\",\"subtotal\":1440000,\"image\":\"Images\\/9-pro.jpg\",\"currency\":\"LKR\"},{\"product_id\":26,\"name\":\"iPhone 16 Pro Max\",\"price\":\"510000.00\",\"quantity\":\"1\",\"color\":\"Green\",\"warranty\":\"1 Year Company Warranty\",\"subtotal\":510000,\"image\":\"Images\\/16-pro-max.jpg\",\"currency\":\"LKR\"},{\"product_id\":4,\"name\":\"Car Baseus Charger\",\"price\":\"2000.00\",\"quantity\":\"1\",\"color\":\"Blue\",\"warranty\":\"1 Year Company Warranty\",\"subtotal\":2000,\"image\":\"Images\\/bcarcharger.jpg\",\"currency\":\"LKR\"}]', 1952000.00, 'LKR', 'pending', '2025-12-04 12:56:40', '2025-12-04 12:56:40');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `currency` varchar(10) NOT NULL DEFAULT 'LKR',
  `ram` varchar(255) DEFAULT NULL,
  `storage` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `subcategory`, `price`, `currency`, `ram`, `storage`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Belkin 3-in-1 Wireless Charger', 'Accessories', 'Wireless Chargers', 5000.00, 'LKR', NULL, NULL, 'Images/3in1.webp', 'A fast wireless charging dock supporting simultaneous charging for iPhone, Apple Watch, and AirPods. Built with optimized magnetic alignment, heat-control protection, and efficient power delivery for stable charging performance. Ideal for maintaining consistent output while minimizing temperature rise during extended charging sessions.', NULL, NULL),
(2, 'iPhone Charger 20W', 'Accessories', 'Chargers', 10000.00, 'LKR', NULL, NULL, 'Images/acharger.webp', 'A reliable 20W USB-C power adapter providing fast charging optimized for iPhone models. Supports efficient thermal management and stable current output. Designed for safe voltage regulation and long-term durability while maintaining minimized energy loss and high-speed charging performance.', NULL, NULL),
(3, 'Anker Wireless Powerbank', 'Accessories', 'Powerbanks', 12000.00, 'LKR', NULL, NULL, 'Images/anker.webp', 'A compact powerbank with wireless charging and magnetic alignment support. Engineered with advanced battery cells, safe temperature control, and efficient energy distribution. Offers stable charging, multiple output ports, and optimized wireless performance suitable for modern smartphones under heavy usage conditions.', NULL, NULL),
(4, 'Car Baseus Charger', 'Accessories', 'Car Chargers', 2000.00, 'LKR', NULL, NULL, 'Images/bcarcharger.jpg', 'A fast dual-port car charger featuring intelligent voltage management, heat-resistant construction, and adaptive power delivery. Designed for stable charging during long drives, maintaining consistent current even under fluctuating vehicle power conditions.', NULL, NULL),
(5, 'Samsung 15W Charger', 'Accessories', 'Chargers', 2500.00, 'LKR', NULL, NULL, 'Images/scharger.jpg', 'A Samsung-optimized 15W adaptive charger built with safe power regulation and efficient thermal control. Delivers reliable current for compatible devices, ensuring stable charging cycles and extended battery lifespan under standard daily use.', NULL, NULL),
(6, 'Ugreen 35W Charger', 'Accessories', 'Chargers', 13000.00, 'LKR', NULL, NULL, 'Images/ugreen.jpg', 'A 35W dual-port fast charger using advanced GaN technology for higher efficiency and lower heat generation. Provides stable voltage output ideal for smartphones and tablets requiring fast charging performance.', NULL, NULL),
(7, 'AirPods 3', 'Accessories', 'Earbuds', 45000.00, 'LKR', NULL, NULL, 'Images/airpods3.png', 'Lightweight wireless earbuds with Adaptive EQ, optimized audio drivers, and low-latency wireless performance. Engineered for efficient battery consumption and stable Bluetooth connectivity, suitable for extended listening with minimal power drain.', NULL, NULL),
(8, 'AirPods Pro 2', 'Accessories', 'Earbuds', 65000.00, 'LKR', NULL, NULL, 'Images/airpodspro.png', 'Advanced earbuds with active noise cancellation, improved audio drivers, and upgraded H2 chip for faster processing and connectivity. Designed for consistent acoustic performance, low distortion, and more efficient battery use during extended sessions.', NULL, NULL),
(9, 'Samsung Buds Pro 2', 'Accessories', 'Earbuds', 25000.00, 'LKR', NULL, NULL, 'Images/buds2pro.png', 'High-performance earbuds with optimized ANC processing, advanced two-way drivers, and efficient wireless transmission. Offers stable battery performance and enhanced environmental noise control suitable for daily usage.', NULL, NULL),
(10, 'Sony XM5', 'Accessories', 'Headphones', 50000.00, 'LKR', NULL, NULL, 'Images/xm5.webp', 'Premium over-ear headphones featuring advanced noise-cancellation processors, large dynamic drivers, and highly efficient battery usage. Built for immersive audio clarity, reduced distortion, and stable wireless operation under varying signal environments.', NULL, NULL),
(11, 'Nothing Ear 2', 'Accessories', 'Earbuds', 30000.00, 'LKR', NULL, NULL, 'Images/nothingear2.jpg', 'Lightweight earbuds featuring LHDC support, dual-chamber sound architecture, and adaptive ANC. Engineered for low-latency wireless audio, stable processing efficiency, and extended playback under consistent load.', NULL, NULL),
(12, 'Nothing Headphones', 'Accessories', 'Headphones', 29000.00, 'LKR', NULL, NULL, 'Images/nothingheadphones.jpg', 'High-fidelity headphones designed with large custom drivers, multi-mode ANC, and optimized battery efficiency. Supports stable wireless audio and low-latency data transmission ideal for multimedia usage.', NULL, NULL),
(13, 'Google Pixel 8', 'Mobile Phones', 'Google Pixel', 170000.00, 'LKR', '8GB', '128GB', 'Images/8.jpg', 'Powered by the Google Tensor G3 chipset offering efficient AI-driven performance, the Pixel 8 features a 6.2-inch OLED display, optimized thermal output, and excellent image processing. Designed for power efficiency and strong battery endurance under daily workloads.', NULL, NULL),
(14, 'Google Pixel 8 Pro', 'Mobile Phones', 'Google Pixel', 250000.00, 'LKR', '12GB', '128GB', 'Images/8-pro.jpg', 'Featuring Google’s Tensor G3 with enhanced machine learning acceleration, the Pixel 8 Pro delivers smooth multitasking, advanced computational photography, and strong battery optimization. The LTPO display ensures higher power efficiency during adaptive refresh rate usage.', NULL, NULL),
(15, 'Google Pixel 9', 'Mobile Phones', 'Google Pixel', 310000.00, 'LKR', '12GB', '128GB', 'Images/9.jpg', 'Built with next-generation Tensor processing for improved thermal control and AI performance, the Pixel 9 offers smoother graphics handling, efficient energy distribution, and durable battery performance for heavy everyday use.', NULL, NULL),
(16, 'Google Pixel 9 Pro', 'Mobile Phones', 'Google Pixel', 360000.00, 'LKR', '16GB', '256GB', 'Images/9-pro.jpg', 'Equipped with upgraded Tensor architecture, the Pixel 9 Pro enhances multi-core performance, display responsiveness, and image processing. Optimized for sustained workloads and strong power efficiency under continuous data operations.', NULL, NULL),
(17, 'Google Pixel 10 Pro', 'Mobile Phones', 'Google Pixel', 310000.00, 'LKR', '16GB', '256GB', 'Images/10-pro.jpg', 'Designed around Google’s advanced AI chipset, the Pixel 10 Pro offers improved heat dissipation, superior display accuracy, and efficient battery control. Suitable for intensive camera processing and extended high-performance tasks.', NULL, NULL),
(18, 'iPhone 12', 'Mobile Phones', 'Apple iPhone', 120000.00, 'LKR', '4GB', '128GB', 'Images/12.jpg', 'Powered by the A14 Bionic chip, the iPhone 12 offers efficient performance, strong battery optimization, and a durable OLED display. Designed for consistent thermal management and reliable daily usage.', NULL, NULL),
(21, 'iPhone 15', 'Mobile Phones', 'Apple iPhone', 200000.00, 'LKR', '12GB', '128GB', 'Images/15.jpg', 'Equipped with the A16 Bionic chip, the iPhone 15 offers efficient battery use, strong graphics output, and improved power management suitable for modern apps and daily multitasking.', NULL, NULL),
(22, 'iPhone 15 Pro', 'Mobile Phones', 'Apple iPhone', 300000.00, 'LKR', '16GB', '256GB', 'Images/15pro.webp', 'The A17 Pro chip delivers extreme performance, efficient heat management, and faster rendering. Ideal for extended gaming, multitasking, and high-resolution photography workflows with optimized battery longevity.', NULL, NULL),
(23, 'iPhone 15 Pro Max', 'Mobile Phones', 'Apple iPhone', 350000.00, 'LKR', '16GB', '256GB', 'Images/15promax.jpg', 'Featuring the A17 Pro architecture with superior GPU enhancements, the iPhone 15 Pro Max ensures powerful performance, excellent energy optimization, and advanced camera processing under heavy usage.', NULL, NULL),
(24, 'iPhone 16', 'Mobile Phones', 'Apple iPhone', 400000.00, 'LKR', '8GB', '128GB', 'Images/16.jpg', 'The latest A18 chip provides improved power efficiency, refined thermal distribution, and enhanced display rendering. Suitable for sustained high-performance environments and balanced battery life.', NULL, NULL),
(25, 'iPhone 16 Pro', 'Mobile Phones', 'Apple iPhone', 440000.00, 'LKR', '16GB', '256GB', 'Images/16pro.webp', 'Powered by the A18 Pro chipset with upgraded ML accelerators, the iPhone 16 Pro offers efficient workload handling, improved graphics rendering, and advanced energy control for demanding applications.', NULL, NULL),
(26, 'iPhone 16 Pro Max', 'Mobile Phones', 'Apple iPhone', 510000.00, 'LKR', '16GB', '256GB', 'Images/16-pro-max.jpg', 'Designed with top-tier A18 Pro silicon, this model provides extreme performance, stable thermal output, and higher battery-efficiency improvements for long-duration tasks and high-detail content processing.', NULL, NULL),
(27, 'iPhone 17 Air', 'Mobile Phones', 'Apple iPhone', 330000.00, 'LKR', '8GB', '128GB', 'Images/17-air.jpg', 'A lightweight design offering optimized performance through advanced A-series processing, power-efficient display technology, and extended battery control. Ideal for balanced daily operation.', NULL, NULL),
(28, 'iPhone 17 Pro', 'Mobile Phones', 'Apple iPhone', 600000.00, 'LKR', '16GB', '256GB', 'Images/17-pro.jpg', 'Featuring latest-generation silicon with enhanced neural engines, the iPhone 17 Pro delivers powerful task performance, refined thermal efficiency, and optimized battery endurance during intensive workflows.', NULL, NULL),
(29, 'iPhone 17 Pro Max', 'Mobile Phones', 'Apple iPhone', 630000.00, 'LKR', '16GB', '256GB', 'Images/17-pro-max.jpg', 'A performance-focused device offering extreme processing speeds, adaptive display technologies, and significant battery efficiency improvements for high-demand applications and multimedia processing.', NULL, NULL),
(30, 'Samsung Galaxy A04s', 'Mobile Phones', 'Samsung A Series', 60000.00, 'LKR', '4GB', '64GB', 'Images/a04s.png', 'Powered by an energy-efficient chipset and a 5000mAh battery, the A04s offers reliable performance for daily tasks. The display provides good clarity while maintaining low power consumption.', NULL, NULL),
(32, 'Samsung Galaxy A25', 'Mobile Phones', 'Samsung A Series', 130000.00, 'LKR', '8GB', '128GB', 'Images/a25.jpg', 'Powered by a capable mid-range chipset, the A25 delivers stable graphics performance, smooth display operation, and long battery endurance for routine workloads.', NULL, NULL),
(33, 'Samsung Galaxy A35', 'Mobile Phones', 'Samsung A Series', 150000.00, 'LKR', '8GB', '128GB', 'Images/a35.jpg', 'A balanced mid-range device featuring a power-efficient processor, strong battery backup, and stable thermal output ideal for extended usage.', NULL, NULL),
(34, 'Samsung Galaxy A55', 'Mobile Phones', 'Samsung A Series', 190000.00, 'LKR', '8GB', '128GB', 'Images/a55.jpg', 'Featuring a high-efficiency chipset, the A55 provides smooth performance, improved display responsiveness, and extended battery life suitable for everyday multitasking.', NULL, NULL),
(35, 'Samsung Galaxy A75', 'Mobile Phones', 'Samsung A Series', 250000.00, 'LKR', '8GB', '256GB', 'Images/a75.webp', 'A premium A-series model delivering strong performance, optimized display efficiency, and enhanced battery management designed for long active use.', NULL, NULL),
(36, 'OnePlus 11', 'Mobile Phones', 'OnePlus', 110000.00, 'LKR', '12GB', '256GB', 'Images/o-11.jpg', 'Powered by the Snapdragon 8 Gen 2, the OnePlus 11 ensures high-level multitasking, efficient thermal output, and fast display performance for demanding applications.', NULL, NULL),
(37, 'OnePlus 12', 'Mobile Phones', 'OnePlus', 135000.00, 'LKR', '12GB', '256GB', 'Images/o-12.jpg', 'Equipped with an advanced flagship chipset, the OnePlus 12 delivers enhanced processing efficiency, better heat management, and excellent battery optimization under heavy workloads.', NULL, NULL),
(38, 'Samsung S23', 'Mobile Phones', 'Samsung S Series', 250000.00, 'LKR', '8GB', '256GB', 'Images/s23.webp', 'Powered by the Snapdragon 8 Gen 2, the S23 delivers powerful performance, optimized battery efficiency, and strong display responsiveness while maintaining stable thermal conditions.', NULL, NULL),
(39, 'Samsung S23 Ultra', 'Mobile Phones', 'Samsung S Series', 300000.00, 'LKR', '12GB', '256GB', 'Images/S23-ultra.jpg', 'Featuring a powerful chipset and advanced display technology, the S23 Ultra ensures exceptional performance, enhanced battery endurance, and refined thermal output during heavy usage.', NULL, NULL),
(40, 'Samsung S24', 'Mobile Phones', 'Samsung S Series', 350000.00, 'LKR', '8GB', '256GB', 'Images/s24.jpg', 'With its efficient Exynos/Snapdragon chipset, the S24 offers excellent battery optimization, strong CPU efficiency, and balanced graphics performance suitable for modern tasks.', NULL, NULL),
(41, 'Samsung S24 Ultra', 'Mobile Phones', 'Samsung S Series', 400000.00, 'LKR', '12GB', '256GB', 'Images/s24-ultra.jpg', 'A flagship-class device offering exceptional processing speeds, high display accuracy, and strong power efficiency for prolonged high-performance workloads.', NULL, NULL),
(42, 'Samsung S25', 'Mobile Phones', 'Samsung S Series', 450000.00, 'LKR', '12GB', '256GB', 'Images/s25.jpg', 'Featuring updated processing architecture, the S25 delivers efficient power usage, smooth graphics handling, and optimized thermal control suited for daily and intensive use.', NULL, NULL),
(43, 'Samsung S25 Edge', 'Mobile Phones', 'Samsung S Series', 500000.00, 'LKR', '12GB', '256GB', 'Images/s25-edge.webp', 'The curved display works with a powerful chipset to deliver efficient performance, strong battery life, and reliable thermal output under continuous workloads.', NULL, NULL),
(44, 'Samsung S25 Ultra', 'Mobile Phones', 'Samsung S Series', 560000.00, 'LKR', '12GB', '256GB', 'Images/s25-ultra.jpg', 'A high-end model designed for maximum performance, extended battery efficiency, and superior thermal behavior suitable for demanding professional tasks.', NULL, NULL),
(45, 'Samsung Galaxy Z Flip 4', 'Mobile Phones', 'Samsung Z Flip', 150000.00, 'LKR', '8GB', '256GB', 'Images/zflip4.jpg', 'A compact foldable smartphone powered by an efficient Snapdragon processor offering stable thermal control, optimized folding display mechanics, and strong battery endurance.', NULL, NULL),
(46, 'Samsung Galaxy Z Flip 5', 'Mobile Phones', 'Samsung Z Flip', 220000.00, 'LKR', '8GB', '256GB', 'Images/zflip5.jpg', 'Featuring a redesigned hinge system, upgraded processor, and energy-efficient display, the Flip 5 offers smooth performance with controlled heat output during extended use.', NULL, NULL),
(47, 'Samsung Galaxy Z Flip 6', 'Mobile Phones', 'Samsung Z Flip', 310000.00, 'LKR', '12GB', '256GB', 'Images/zflip6.avif', 'Powered by the latest Snapdragon platform, the Flip 6 has enhanced battery optimization, improved thermal stability, and smoother display performance under folding stress.', NULL, NULL),
(48, 'Samsung Galaxy Fold 3', 'Mobile Phones', 'Samsung Fold', 190000.00, 'LKR', '12GB', '256GB', 'images/products/1764868882_6931c3126f78e.jpg', 'A powerful foldable device with multi-mode display optimization and efficient chipset performance. Designed for multitasking with stable energy usage and thermal output.', NULL, NULL),
(49, 'Samsung Galaxy Fold 4', 'Mobile Phones', 'Samsung Fold', 240000.00, 'LKR', '12GB', '256GB', 'Images/zfold4.png', 'Featuring a flagship processor, the Fold 4 ensures high productivity through optimized battery management, improved thermal structure, and responsive dual-display usage.', NULL, NULL),
(50, 'Samsung Galaxy Fold 5', 'Mobile Phones', 'Samsung Fold', 335000.00, 'LKR', '12GB', '256GB', 'Images/zfold5.jpg', 'Equipped with an efficient hinge and upgraded chipset, the Fold 5 provides strong performance, stable heat output, and extended battery endurance during heavy workflows.', NULL, NULL),
(51, 'Samsung Galaxy Fold 6', 'Mobile Phones', 'Samsung Fold', 455000.00, 'LKR', '12GB', '256GB', 'Images/zfold6.png', 'A premium foldable offering upgraded thermal architecture, high-efficiency display performance, and optimized battery management ideal for advanced multitasking and productivity.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FQwwPgdgVCILEPnCLiTU7dQarGsEeDfCi8xTjuir', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUm94VEh4NmJ2NFNBSGJKUm5kSVFsY0FJbk5OOWNlbDk4UnFEUEs1QiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1764936159),
('l8inA5hLrVMpXDWiM2ryxdIBVRQWmKqgZYihHh0c', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMjZabkQzVHRvZzRxbTIwZUN4dmZ4U3Vza0p0TjBrS3g1eDJxMXp6aSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9fQ==', 1764939647),
('LAJqjB2SJBBGCQCB147FcNdet5XYh5G00uC73JZO', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQ3FoZUhrYlc0MG5CWEg1NGFBUjBvbm9pQlV1NGJ5M21NUklFTFRsdiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjQ6ImNhcnQiO2E6MTp7czozMjoiMTNfQmxhY2tfMSBZZWFyIENvbXBhbnkgV2FycmFudHkiO2E6Nzp7czoxMDoicHJvZHVjdF9pZCI7czoyOiIxMyI7czo4OiJxdWFudGl0eSI7czoxOiIxIjtzOjU6ImNvbG9yIjtzOjU6IkJsYWNrIjtzOjg6IndhcnJhbnR5IjtzOjIzOiIxIFllYXIgQ29tcGFueSBXYXJyYW50eSI7czo0OiJuYW1lIjtzOjE0OiJHb29nbGUgUGl4ZWwgOCI7czo1OiJwcmljZSI7czo5OiIxNzAwMDAuMDAiO3M6NToiaW1hZ2UiO3M6MTI6IkltYWdlcy84LmpwZyI7fX19', 1764911009),
('LcIz1xXzrusDSL2H7gvRlW9JYbbej5A710bZNoJJ', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicWFSaEdQSmNMMnpjeDVXTHJOMGNLYmp3STZNdmN0VnVRNVJBenZpMCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MztzOjQ6ImNhcnQiO2E6MDp7fX0=', 1764936196),
('vdhM3aJfA909kYq54AXjf9NUhGuTVYqwQMysRtBJ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNmlXcnMyemp4SzA1VjU1VktZM1hrbGw2a0xvTEQ4ckFvSGEwemEyOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1764910270);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` enum('admin','user') NOT NULL DEFAULT 'user',
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `type`, `phone`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Inesh Fernando', 'ineshfernando643@gmail.com', 'admin', NULL, NULL, '$2y$12$CCZcIODsLDtEEtfjlKbjt.xxm7WYohiYnEEv8uDOTEPN4ZAouFL.i', NULL, NULL, NULL, NULL, '2025-12-02 04:58:02', '2025-12-02 04:58:02'),
(3, 'Inesh Fernando ', 'ineshkavinda@gmail.com', 'user', NULL, NULL, '$2y$12$7iR.yJlEOMb2q6pCZf3IA.Ulrq4m8puDLqiRnkESMtPTFDiiVMEs2', NULL, NULL, NULL, NULL, '2025-12-04 05:34:31', '2025-12-04 23:30:24'),
(4, 'Minister Beam', 'inesh@gmail.com', 'user', NULL, NULL, '$2y$12$nKJ.TW1n4DDCHYdyinW20./JhS/4rRvOzoG54OTmOZvittJt9Q/.S', NULL, NULL, NULL, NULL, '2025-12-05 06:14:00', '2025-12-05 06:14:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepted_orders`
--
ALTER TABLE `accepted_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `accepted_orders`
--
ALTER TABLE `accepted_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
