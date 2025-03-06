-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 06, 2025 at 07:15 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vk-store`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart`
--

DROP TABLE IF EXISTS `tb_cart`;
CREATE TABLE IF NOT EXISTS `tb_cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_category`
--

DROP TABLE IF EXISTS `tb_category`;
CREATE TABLE IF NOT EXISTS `tb_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_category`
--

INSERT INTO `tb_category` (`id`, `name`, `description`) VALUES
(6, 'Computers', 'Great Computers here!'),
(1, 'Tablets & Cellphones', 'Great Tablets & Cellphones here!'),
(7, 'Smartwatches', 'Great Smartwatches here!'),
(8, 'TV', 'Great TVs here!'),
(4, 'Camera', 'Great Camera here!');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

DROP TABLE IF EXISTS `tb_order`;
CREATE TABLE IF NOT EXISTS `tb_order` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `order_status` enum('pending','processing','shipped','completed','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL,
  `shipping_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id`, `user_id`, `order_status`, `total_amount`, `shipping_address`, `order_date`) VALUES
(1, 1, 'completed', 500.00, 'Phnom Penh', '2025-03-05 17:00:00'),
(2, 8, 'shipped', 1000.00, 'Cambodia', '2025-03-03 17:00:00'),
(3, 8, 'completed', 10000.00, 'Cambodia', '2025-02-28 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_payment`
--

DROP TABLE IF EXISTS `tb_payment`;
CREATE TABLE IF NOT EXISTS `tb_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `payment_method` enum('aba_payway','cash_on_delivery') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payment_status` enum('pending','completed','failed','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `payment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_payment`
--

INSERT INTO `tb_payment` (`id`, `order_id`, `payment_method`, `payment_status`, `payment_date`) VALUES
(1, 1, 'aba_payway', 'completed', '2025-03-05 17:00:00'),
(2, 2, 'cash_on_delivery', 'completed', '2025-03-02 17:00:00'),
(3, 3, 'cash_on_delivery', 'completed', '2025-02-28 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

DROP TABLE IF EXISTS `tb_product`;
CREATE TABLE IF NOT EXISTS `tb_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `title` text COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `category_id` int DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `event` enum('new','top') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`id`, `name`, `title`, `description`, `price`, `stock`, `category_id`, `image`, `created_at`, `event`, `updated_at`) VALUES
(1, 'Laptop', 'Great Laptop here!', 'This laptop gives you the ability to fly!', 399.00, 50, 6, 'pngwing.com (27).png', '2025-03-05 04:17:50', 'new', '2025-03-05 04:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `tb_productimages`
--

DROP TABLE IF EXISTS `tb_productimages`;
CREATE TABLE IF NOT EXISTS `tb_productimages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `type` enum('main','side','cross','with_model','back') COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting`
--

DROP TABLE IF EXISTS `tb_setting`;
CREATE TABLE IF NOT EXISTS `tb_setting` (
  `id` int NOT NULL AUTO_INCREMENT,
  `website_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `website_logo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `footer_text` text COLLATE utf8mb4_general_ci,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_shipping`
--

DROP TABLE IF EXISTS `tb_shipping`;
CREATE TABLE IF NOT EXISTS `tb_shipping` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `shipping_method` enum('standard','express','overnight') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'standard',
  `tracking_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `shipping_status` enum('pending','shipped','delivered') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `shipped_date` timestamp NULL DEFAULT NULL,
  `delivered_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_shipping`
--

INSERT INTO `tb_shipping` (`id`, `order_id`, `shipping_method`, `tracking_number`, `shipping_status`, `shipped_date`, `delivered_date`) VALUES
(1, 1, 'standard', 'HO866GCBH8', 'delivered', '2025-03-07 17:00:00', '2025-03-10 17:00:00'),
(2, 2, 'express', 'KII64S3DX9', 'shipped', '2025-03-12 17:00:00', '2025-03-20 17:00:00'),
(3, 3, 'overnight', 'DBLR9KDT7Q', 'shipped', '2025-03-06 17:00:00', '2025-03-07 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_slideshow`
--

DROP TABLE IF EXISTS `tb_slideshow`;
CREATE TABLE IF NOT EXISTS `tb_slideshow` (
  `ssid` int NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `subtitle` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `text` text COLLATE utf8mb4_general_ci NOT NULL,
  `img` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ssorder` int NOT NULL,
  `enable` char(1) COLLATE utf8mb4_general_ci NOT NULL,
  `link` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ssid`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_slideshow`
--

INSERT INTO `tb_slideshow` (`ssid`, `title`, `subtitle`, `text`, `img`, `ssorder`, `enable`, `link`) VALUES
(1, 'Happy Khmer New Year Promotion', 'Ipad Pro 2025', 'For only 1099$', 'slide-1.png', 1, '1', '#'),
(2, 'New Year Sales!', 'Headphones with extreme quality', '329$', 'slide-2.png', 2, '1', '#');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE IF NOT EXISTS `tb_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('customer','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `enable` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `contact` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `name`, `fullname`, `password`, `role`, `created_at`, `updated_at`, `enable`, `contact`) VALUES
(8, 'Nika', 'Luy Kanika', '$2y$10$4EhULdyb0GJawaMIKUpipOGTyg3hMQMnyiBc5XFRGbfx/UyAXPPP.', 'customer', '2025-03-04 17:35:28', '2025-03-04 17:36:05', '1', ''),
(18, 'test1', 'testMe', '$2y$10$dBpZ9g43tAWtPOv0XCMa4OzlFy26Esi1juyFHns2p7Rhfd5nYo9f6', 'customer', '2025-03-05 19:02:44', '2025-03-05 19:02:44', '1', 'test@gmail.com'),
(1, 'admin', NULL, 'admin', 'admin', '2025-03-04 17:32:51', '2025-03-04 17:32:51', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_token`
--

DROP TABLE IF EXISTS `tb_user_token`;
CREATE TABLE IF NOT EXISTS `tb_user_token` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user_token`
--

INSERT INTO `tb_user_token` (`id`, `user_id`, `token`, `expires_at`, `created_at`) VALUES
(37, 1, '305923f8051f33e13334d210db7f68bf9369c481bb9bfd42b6ec71da6c4f5f90', '2025-04-04 19:02:57', '2025-03-05 19:02:57'),
(36, 1, 'a179adb2e4ce38203cc00d1ac7b5911108a4105ca6e2014aeba7695322a909c0', '2025-04-04 16:34:43', '2025-03-05 16:34:43'),
(35, 1, '569198018fe09f828a8077c646f567725e4c05c047fe544e2726293ba31d4f07', '2025-04-04 05:52:38', '2025-03-05 05:52:38'),
(34, 1, 'c3dea59966de596fedab401df1406f6a22c2df92ec01c8a20270d8758a954f79', '2025-04-04 05:49:54', '2025-03-05 05:49:54'),
(24, 8, '72085ea2573d5ea45de2fc703ca992a0d57c585f2fb2d7e2366e4269e8d10c17', '2025-04-03 17:35:38', '2025-03-04 17:35:38'),
(33, 1, '5f251fab12d48386837a8e653a76eb17f7a5ec07a193492fd90db6ca7cd9c365', '2025-04-04 05:46:25', '2025-03-05 05:46:25'),
(32, 1, 'c4eb9d65ff028468524ddb7f48cdd8082657c2d79012159f7ec1e9ad4d9b0f5c', '2025-04-04 05:44:05', '2025-03-05 05:44:05'),
(31, 1, '7e868da11212da9de1ab1dbdc53d535c288cf4cdb96f71ca1b8b56d91c520f52', '2025-04-04 05:39:49', '2025-03-05 05:39:49'),
(30, 1, '1ad2a71589d4c658de05bfbedfec8fd18116b565ec243964e76b5e45a105046a', '2025-04-04 05:36:04', '2025-03-05 05:36:04'),
(29, 1, '9e420858fe1eaf337ff7b8891bfbf1e7a0b7c1797ab6fb0a39b43c558f3aac1c', '2025-04-03 17:57:58', '2025-03-04 17:57:58');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
