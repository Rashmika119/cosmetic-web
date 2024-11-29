-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 29, 2024 at 04:13 PM
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
-- Database: `webproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `street_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `street_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `district` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `postal_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `street_1`, `street_2`, `district`, `postal_code`) VALUES
(1, 'yaya 2/20', 'uwa tissapura', 'badulla', '119'),
(2, 'no.4', 'sunlight street', 'matara', '432');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `phone_number`, `password`) VALUES
(1, 'pubudu', 'madushanp835@gmail.com', '0762691330', 'pubudu1234');

-- --------------------------------------------------------

--
-- Table structure for table `brand_category`
--

DROP TABLE IF EXISTS `brand_category`;
CREATE TABLE IF NOT EXISTS `brand_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand_category`
--

INSERT INTO `brand_category` (`id`, `name`) VALUES
(1, 'Garnier'),
(2, 'Loreal Paris'),
(3, 'Neutrogena'),
(4, 'CeraVe');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `customer_id`) VALUES
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

DROP TABLE IF EXISTS `cart_product`;
CREATE TABLE IF NOT EXISTS `cart_product` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`cart_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `f_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `l_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `address_id` (`address_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `f_name`, `l_name`, `password`, `phone_number`, `email`, `address_id`) VALUES
(3, 'pubudu', 'madushan', 'pubudu1234', '0762691330', 'madushanp835@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

DROP TABLE IF EXISTS `discount`;
CREATE TABLE IF NOT EXISTS `discount` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `product_id`, `discount`) VALUES
(1, 15, 300.00),
(2, 23, 200.00),
(3, 27, 350.00),
(4, 12, 300.00),
(5, 20, 250.00),
(6, 17, 350.00),
(7, 7, 300.00),
(8, 8, 400.00),
(9, 9, 350.00),
(10, 10, 300.00),
(11, 1, 100.00),
(12, 2, 670.00),
(13, 3, 680.00),
(15, 4, 0.00),
(16, 31, 0.00),
(17, 32, 0.00),
(18, 33, 0.00),
(19, 34, 0.00),
(20, 35, 0.00),
(21, 36, 0.00),
(22, 37, 0.00),
(23, 38, 0.00),
(24, 39, 0.00),
(25, 40, 0.00),
(26, 41, 0.00),
(27, 42, 0.00),
(28, 43, 0.00),
(29, 44, 0.00),
(30, 45, 0.00),
(31, 71, 300.00),
(32, 72, 0.00),
(33, 73, 0.00),
(34, 74, 0.00),
(35, 66, 0.00),
(36, 67, 0.00),
(37, 68, 0.00),
(38, 69, 0.00),
(39, 70, 0.00),
(40, 61, 0.00),
(41, 62, 0.00),
(42, 63, 0.00),
(43, 64, 0.00),
(44, 65, 0.00),
(45, 56, 0.00),
(46, 57, 0.00),
(47, 58, 0.00),
(48, 59, 0.00),
(49, 60, 0.00),
(50, 51, 0.00),
(51, 52, 0.00),
(52, 53, 0.00),
(53, 54, 0.00),
(54, 55, 0.00),
(55, 46, 0.00),
(56, 48, 0.00),
(57, 49, 0.00),
(58, 50, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `due_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_id` int DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status`, `due_date`, `created_at`, `customer_id`, `address`) VALUES
(34, 'Canceled', '2024-11-19', '2024-11-19 16:36:54', 3, 'yaya 2/20, uwa tissapura, badulla 119'),
(36, 'Delivered', '2024-12-03', '2024-11-19 16:45:11', 3, 'yaya 2/20, uwa tissapura, badulla 119'),
(37, 'Pending', '2024-12-03', '2024-11-19 16:47:05', 3, 'yaya 2/20, uwa tissapura, badulla 119'),
(38, 'Pending', '2024-12-03', '2024-11-19 16:52:20', 3, 'yaya 2/20, uwa tissapura, badulla 119'),
(39, 'Shipped', '2024-12-03', '2024-11-19 16:56:20', 3, 'yaya 2/20, uwa tissapura, badulla 119'),
(40, 'Pending', '2024-12-03', '2024-11-19 17:04:24', 3, 'yaya 2/20, uwa tissapura, badulla 119'),
(41, 'Canceled', '2024-12-04', '2024-11-20 03:03:50', 3, 'no.4, sunlight street, matara 432'),
(42, 'Pending', '2024-12-04', '2024-11-20 03:52:04', 3, 'no.4, sunlight street, matara 432'),
(43, 'Canceled', '2024-12-04', '2024-11-20 04:23:19', 3, 'no.4, sunlight street, matara 432'),
(44, 'Pending', '2024-12-13', '2024-11-29 14:11:47', 3, 'no.4, sunlight street, matara 432');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

DROP TABLE IF EXISTS `order_product`;
CREATE TABLE IF NOT EXISTS `order_product` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `quantity`) VALUES
(34, 1, 1),
(36, 1, 1),
(37, 1, 4),
(38, 2, 4),
(39, 5, 4),
(40, 15, 10),
(41, 2, 5),
(42, 2, 5),
(42, 3, 6),
(43, 1, 1),
(43, 3, 4),
(44, 43, 6);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) NOT NULL,
  `account_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `provider` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `order_id` int DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `amount`, `account_number`, `date`, `provider`, `customer_id`, `order_id`, `status`) VALUES
(23, 1600.00, 'mastercard', '2024-11-19 16:36:54', '1111111111111111', 3, 34, 'Refunded'),
(28, 6500.00, 'none', '2024-11-19 16:56:20', 'none', 3, 39, 'Refunded'),
(29, 32100.00, 'none', '2024-11-19 17:04:24', 'none', 3, 40, 'Refunded'),
(30, 9600.00, 'mastercard', '2024-11-20 03:03:50', '1234123412341234', 3, 41, 'Paid'),
(31, 18000.00, 'mastercard', '2024-11-20 03:52:04', '1234567890987654', 3, 42, 'Refunded'),
(32, 7200.00, 'mastercard', '2024-11-20 04:23:19', '4567123489075643', 3, 43, 'Paid'),
(33, 7300.00, 'none', '2024-11-29 14:11:47', 'none', 3, 44, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `product_category1_id` int DEFAULT NULL,
  `brand_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_category1_id` (`product_category1_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `description`, `price`, `quantity`, `product_category1_id`, `brand_id`) VALUES
(1, 'Garnier Fructis Sleek & Shine Anti-Frizz Serum', 'images/garnier/hair/oil/garnier_fructis_sleek_shine_anti_frizz_serum.png', 'A serum designed to fight frizz and enhance shine, leaving your hair smooth and manageable, even in humid conditions. Perfect for sleek, long-lasting styles.', 1500.00, 9, 1, 1),
(2, 'Garnier Ultimate Blends Argan & Camellia Oil Weightless Hair Oil', 'images/garnier/hair/oil/garnier_ultimate_blends_argan_camelia_oil.png', 'A lightweight, non-greasy hair oil that nourishes and hydrates dry hair, leaving it soft and shiny. Provides a smooth finish without weighing the hair down.', 1900.00, 7, 1, 1),
(3, 'Garnier Hair Care Whole Blends Strengthening Ginger Recovery Shampoo', 'images/garnier/hair/conditioner/garnier_whole_blends_strengthening_ginger_recovery.png', 'A strengthening shampoo infused with ginger and herbal extracts, designed to repair and revitalize weak, damaged hair.', 1400.00, 68, 2, 1),
(4, 'The 14 Best Drugstore Shampoos for All Your Hair Care Needs', 'images/garnier/hair/conditioner/14_best_drugstore_shampoos.png', 'A collection of top-rated drugstore shampoos that cater to various hair types and concerns, from hydration to frizz control.', 1200.00, 90, 2, 1),
(5, 'Argan Oil & Camellia Shampoo - Ultimate Blends - Garnier', 'images/garnier/hair/shampoo/argan_oil_camellia_shampoo.png', 'This nourishing shampoo blends argan oil and camellia oil to hydrate and soften hair, leaving it smooth, shiny, and manageable.', 1600.00, 95, 3, 1),
(6, 'Garnier Ultra Doux Nourishing Shampoo Avocado Oil & Shea Butter', 'images/garnier/hair/shampoo/garnier_ultra_doux_nourishing_shampoo.png', 'A rich, nourishing shampoo formulated with avocado oil and shea butter, designed to deeply moisturize and strengthen dry, damaged hair.', 1800.00, 100, 3, 1),
(7, 'Garnier Skinactive Micellar Foaming Gel Cleanser - Makeup Remover', 'images/garnier/face/cleanser/garnier_skinactive_micellar_foaming_gel.png', 'A gentle micellar gel cleanser that effectively removes makeup, dirt, and oil without harsh rubbing. Suitable for all skin types, it leaves the skin clean, refreshed, and hydrated.', 1200.00, 99, 4, 1),
(8, 'Gentle Hydrating Deep Face Cleanser - Garnier', 'images/garnier/face/cleanser/gentle_hydrating_deep_face_cleanser.png', 'A deep-penetrating facial cleanser that hydrates and purifies the skin. Ideal for daily use, it removes impurities and excess oil while maintaining the skin\'s moisture balance.', 1300.00, 96, 4, 1),
(9, 'Garnier Skin Active Rose Day Cream', 'images/garnier/face/day_cream/garnier_skin_active_rose_day_cream.png', 'A soothing day cream enriched with rose water that hydrates and calms sensitive skin. It provides lightweight moisture, leaving the skin soft, smooth, and refreshed.', 1500.00, 92, 5, 1),
(10, 'Garnier Vitamin C Brightening Day Cream', 'images/garnier/face/day_cream/garnier_vitamin_c_brightening_day_cream.png', 'A brightening day cream infused with Vitamin C to reduce dark spots and enhance skin\'s radiance. It leaves the skin glowing and visibly even-toned with regular use.', 1800.00, 100, 5, 1),
(11, 'Garnier Bright Complete Vitamin C Serum', 'images/garnier/face/serum/garnier_bright_complete_vitamin_c_serum.png', 'A fast-absorbing serum formulated with Vitamin C to enhance skin\'s radiance and promote a healthy, glowing complexion. It reduces dark spots and uneven skin tone, giving a brighter and clearer look.', 2000.00, 100, 6, 1),
(12, 'Garnier Light Complete Vitamin C Booster Face Serum', 'images/garnier/face/serum/garnier_light_complete_vitamin_c_booster_serum.png', 'A concentrated Vitamin C serum designed to lighten dark spots and brighten the skin. It delivers a luminous complexion while improving the skin’s texture and tone with regular use.', 1800.00, 95, 6, 1),
(13, 'Garnier BB Cream All-In-One Perfector Even Tone (Medium)', 'images/garnier/face/foundation/garnier_bb_cream_all_in_one.png', 'A multi-tasking BB cream that evens skin tone, moisturizes, and provides sun protection with SPF 50. It offers medium coverage for a natural, flawless finish while keeping the skin hydrated and protected throughout the day.', 2200.00, 100, 7, 1),
(14, 'Garnier Express Aclara With Vitamin C & SPF 30', 'images/garnier/face/foundation/garnier_express_aclaira.png', 'A lightweight foundation cream infused with Vitamin C that brightens the skin while offering sun protection with SPF 30. It helps reduce dark spots and provides a radiant, even complexion.', 1900.00, 100, 7, 1),
(15, 'Clarins Lip Perfector Pomegranate Glow', 'images/garnier/lip/lipstick/clarins_lip_perfector_pomegranate_glow.png', 'A hydrating lip gloss that provides a sheer, luminous finish with a hint of color. Enriched with pomegranate extract, it enhances the lips\' natural glow while keeping them moisturized and soft.', 3200.00, 83, 8, 1),
(16, 'Clarins Natural Lip Perfector 18 Intense Garnet', 'images/garnier/lip/lipstick/clarins_natural_lip_perfector_18_intense_garnet.png', 'A creamy lip gloss that delivers intense color and hydration. This formula enhances the lips with a rich, glossy finish while providing long-lasting moisture and comfort.', 3500.00, 97, 8, 1),
(17, 'Essence Lip Liner', 'images/garnier/lip/lip_liner/essence_lip_liner.png', 'A smooth and long-lasting lip liner that defines the lips and prevents lipstick from feathering. Available in various shades, it provides a precise application for a perfect pout.', 700.00, 99, 9, 1),
(18, 'IRL Filter Finish Lip Liner Definer', 'images/garnier/lip/lip_liner/irl_filter_finish_lip_liner_definer.png', 'A creamy lip liner designed to create a flawless lip shape with a filter-like finish. Its blendable formula allows for easy application and long-lasting wear, enhancing the overall lip look.', 800.00, 100, 9, 1),
(19, 'Esmaltólatras Assumidas - Esmaltes Guisseny II', 'images/garnier/nail/nail_polish/esmalto_latra_assumidas.png', 'A vibrant nail polish that offers a smooth and even application with a long-lasting finish. Available in a variety of shades, it adds a pop of color to your nails while providing a glossy look.', 1000.00, 100, 10, 1),
(20, 'Nail Polish (Brand varies: Primark, Kat Von D, Essence, Kiko)', 'images/garnier/nail/nail_polish/nail_polish_various_brands.png', 'A collection of nail polishes from various brands, known for their high-quality formulas and trendy colors. These polishes are designed for easy application and a durable, glossy finish.', 800.00, 93, 10, 1),
(21, 'Garnier Bright Complete Body Lotion', 'images/garnier/body/body_lotion/garnier_bright_complete_body_lotion.png', 'A brightening body lotion that nourishes and hydrates the skin while helping to even out skin tone. Formulated with Vitamin C, it leaves the skin feeling soft, smooth, and radiant.', 1500.00, 100, 11, 1),
(22, 'Garnier Body Repair Body Lotion for Dry Skin', 'images/garnier/body/body_lotion/garnier_body_repair_body_lotion.png', 'A deeply hydrating body lotion designed for dry skin. It provides intense moisture and helps repair and soothe dry, rough skin, leaving it soft and supple.', 1600.00, 100, 11, 1),
(23, 'Garnier Body Ultimate Beauty Oil', 'images/garnier/body/body_wash/garnier_body_ultimate_beauty_oil.png', 'A luxurious body wash infused with beauty oils that gently cleanses while nourishing the skin. It leaves the skin feeling soft and hydrated, providing a pampering shower experience.', 1400.00, 82, 12, 1),
(24, 'Garnier Summer Body Hydrating Gradual Tan Moisturiser', 'images/garnier/body/body_wash/garnier_summer_body_hydrating_gradual_tan.png', 'A hydrating moisturizer that provides a subtle, gradual tan while nourishing the skin. Ideal for achieving a sun-kissed glow, it keeps the skin hydrated and radiant without streaks.', 1800.00, 101, 12, 1),
(25, '2 in 1 Brown + Black Gel Eyeliner', 'images/garnier/eye/eyeliner/2in1_brown_black_gel_eyeliner.png', 'A versatile gel eyeliner that offers both brown and black shades in one product. It glides on smoothly for a precise application and provides long-lasting wear, perfect for creating various eye looks.', 900.00, 100, 13, 1),
(26, 'Nyx Professional Makeup VIVID BRIGHT LINER - Ghosted Green', 'images/garnier/eye/eyeliner/nyx_vivid_bright_liner_ghosted_green.png', 'A vibrant liquid eyeliner in a striking ghosted green shade. This formula is highly pigmented, easy to apply, and perfect for adding a pop of color to your eye makeup.', 1200.00, 100, 13, 1),
(27, 'Golden Rose Defined Lashes Maxim Eyes Mascara', 'images/garnier/eye/mascara/golden_rose_defined_lashes_maxim_eyes_mascara.png', 'A defining mascara that enhances lash length and volume for a dramatic effect. Its unique brush captures and separates each lash, providing a clump-free application for beautifully defined eyes.', 1000.00, 98, 14, 1),
(28, 'Maybelline Lash Sensational Waterproof Mascara', 'images/garnier/eye/mascara/maybelline_lash_sensational_waterproof.png', 'A waterproof mascara designed to lengthen and volumize lashes for a full fan effect. Its exclusive brush fanned out lashes for a multiplied look, ensuring long-lasting wear and smudge resistance.', 1400.00, 100, 14, 1),
(29, 'Elle 18 Kajal', 'images/garnier/eye/kajal/elle_18_kajal.png', 'A smooth and creamy kajal that provides intense black color for bold eye definition. Its easy-to-apply formula is perfect for creating various eye looks, from subtle to dramatic.', 500.00, 100, 15, 1),
(30, 'LAKMÉ Eyeconic Kajal with Insta Eye Liner', 'images/garnier/eye/kajal/lakme_eyeconic_kajal.png', 'A combo set featuring a highly pigmented kajal for bold eye looks and an eyeliner for precise definition. The kajal is smudge-proof and long-lasting, while the eyeliner provides a sleek finish for versatile makeup styles.', 900.00, 100, 15, 1),
(31, 'Sublime Bronze', 'images/loreal/body/body_lotion/sublime_bronze.png', 'A rich body lotion that deeply hydrates and nourishes dry skin, leaving it smooth and soft.', 1499.00, 100, 11, 2),
(32, 'Silky Lotion', 'images/loreal/body/body_lotion/silky_lotion.png', 'Lightweight body lotion that provides long-lasting moisture without feeling greasy.', 1300.00, 100, 11, 2),
(33, 'Revitalift', 'images/loreal/face/cleanser/revitalift.png', 'Gentle foaming cleanser that removes dirt and impurities, leaving skin refreshed.', 999.00, 100, 4, 2),
(34, 'Age Perfect', 'images/loreal/face/cleanser/age_perfect.png', 'Deep-cleansing formula that unclogs pores and clears excess oil for a clearer complexion.', 1025.00, 100, 4, 2),
(35, 'Elvital', 'images/loreal/hair/conditioner/elvital.png', 'Moisturizing conditioner that detangles and smooths frizzy hair, making it manageable.', 899.00, 95, 2, 2),
(36, 'Elvin Hyaluron', 'images/loreal/hair/conditioner/elvin_hyaluron.png', 'Strengthening conditioner that repairs and revitalizes damaged hair, restoring shine.', 999.00, 99, 2, 2),
(37, 'Elvin Total Repair', 'images/loreal/hair/conditioner/elvin_total_repair.png', 'Nourishing conditioner that provides intense hydration for dry, brittle hair.', 1000.00, 100, 2, 2),
(38, 'Skin Perfect', 'images/loreal/face/cream/skin_perfect.png', 'A day cream that hydrates and protects the skin while giving it a radiant glow.', 1900.00, 100, 16, 2),
(39, 'Super Blowdry', 'images/loreal/face/cream/super_blowdry.png', 'Anti-aging night cream that firms the skin and reduces fine lines for a youthful appearance.', 2400.00, 100, 16, 2),
(40, 'Eye Liner', 'images/loreal/eye/eyeliner/eye_liner.png', ' smudge-proof eyeliner that delivers bold color and precise definition all day long.', 600.00, 100, 13, 2),
(41, 'La Palette', 'images/loreal/eye/eyeshadow/la_palette.png', 'Blendable eye shadow palette with a range of shades for versatile eye looks.', 1400.00, 100, 17, 2),
(42, 'Infallible', 'images/loreal/face/foundation_cream/infallible.png', 'Lightweight foundation cream that provides even coverage and a natural finish.', 1500.00, 100, 7, 2),
(43, 'Extra Ordinary Oil', 'images/loreal/hair/oil/extra_ordinary_oil.png', 'Multi-purpose hair oil that nourishes and smooths hair, reducing frizz and adding shine.', 1200.00, 58, 1, 2),
(44, 'Kajal Magic', 'images/loreal/eye/kajal/kajal_magic.png', 'Intense black kajal that delivers long-lasting, smudge-proof color for bold eyes.', 500.00, 100, 15, 2),
(45, 'Lip Liner Couture', 'images/loreal/lip/lip_liner/lip_liner_couture.png', 'Smooth lip liner that defines and enhances your lips with a long-lasting, natural finish.', 700.00, 100, 9, 2),
(46, 'Ultra Matte', 'images/loreal/lip/lipstick/ultra_matte.png', 'Rich, creamy lipstick with vibrant color that hydrates and softens lips.', 999.00, 96, 8, 2),
(47, 'Infallible', 'images/loreal/lip/lipstick/infallible.png', ' Matte finish lipstick that delivers bold, long-lasting color without drying your lips.', 1500.00, 100, 8, 2),
(48, 'Paradise', 'images/loreal/eye/mascara/paradise.png', 'Lengthening and volumizing mascara that enhances your lashes for a dramatic effect.', 1199.00, 100, 14, 2),
(49, 'Extra Ordinary Oil Shampoo', 'images/loreal/hair/shampoo/extra_ordinary_oil.png', 'Cleansing shampoo that removes buildup while leaving hair soft and refreshed.', 899.00, 99, 3, 2),
(50, 'Curl Expression', 'images/loreal/hair/shampoo/curl_expression.png', 'Nourishing shampoo that strengthens hair and reduces breakage for healthier locks.', 999.00, 100, 3, 2),
(51, 'Total Repair', 'images/loreal/hair/shampoo/total_repair.png', 'Smoothing shampoo that tames frizz and adds shine to unruly hair.', 2000.00, 100, 3, 2),
(52, 'Anti-Residue Shampoo', 'images/neutrogena/hair/shampoo/anti_residue_shampoo.png', 'A clarifying shampoo that removes buildup and restores hair\'s natural shine with every wash.', 1000.00, 100, 3, 3),
(53, 'Body Gel', 'images/neutrogena/body/body_lotion/body_gel.png', 'A refreshing gel that soothes and moisturizes your skin, leaving it soft and smooth after every use.', 1200.00, 100, 11, 3),
(54, 'Bright Boost Cream', 'images/neutrogena/face/cream/bright_boost_cream.png', 'A brightening cream that revitalizes dull skin, leaving your complexion radiant and even-toned.', 2299.00, 100, 16, 3),
(55, 'Cleanser', 'images/neutrogena/face/cleanser/cleanser.png', 'Gentle yet effective cleanser that removes dirt and impurities without stripping your skin\'s natural moisture.', 999.00, 99, 4, 3),
(56, 'Eyeliner', 'images/neutrogena/eye/eyeliner/eyeliner.png', 'Smooth and precise eyeliner that defines your eyes with rich, long-lasting color.', 1000.00, 100, 13, 3),
(57, 'Eye Shadow', 'images/neutrogena/eye/eyeshadow/eye_shadow.png', 'Vibrant, blendable eye shadow that adds a pop of color to your look, day or night.', 1200.00, 100, 17, 3),
(58, 'Foundation Cream', 'images/neutrogena/face/foundation/foundation_cream.png', 'A smooth, blendable foundation that provides even coverage for a flawless complexion.', 1400.00, 100, 7, 3),
(59, 'Healthy Scalp Conditioner', 'images/neutrogena/hair/conditioner/healthy_scalp_conditioner.png', 'Nourishing conditioner that hydrates and strengthens your hair, promoting a healthy scalp and soft, manageable strands.', 1100.00, 94, 2, 3),
(60, 'Healthy Scalp Shampoo', 'images/neutrogena/hair/shampoo/healthy_scalp_shampoo.png', 'Gently cleanses and balances your scalp for healthy, stronger hair from root to tip.', 1099.00, 100, 3, 3),
(61, 'HydroBoost Gel Cream', 'images/neutrogena/face/cream/hydroboost_gel_cream.png', 'Lightweight, hydrating gel cream infused with hyaluronic acid to keep your skin plump and refreshed all day.', 2500.00, 100, 16, 3),
(62, 'Intense Repair Body Lotion', 'images/neutrogena/body/body_lotion/intense_repair_body_lotion.png', 'Deeply hydrating body lotion designed to repair dry, rough skin, leaving it soft and smooth.', 1600.00, 100, 11, 3),
(63, 'Lipstick', 'images/neutrogena/lip/lipstick/lipstick.png', 'Creamy, pigmented lipstick that delivers rich color while moisturizing your lips.', 900.00, 100, 8, 3),
(64, 'Mascara', 'images/neutrogena/eye/mascara/mascara.png', 'Volumizing mascara that enhances your lashes, giving them length and definition.', 1100.00, 100, 14, 3),
(65, 'Neutrogena Nail Cream', 'images/neutrogena/nail/nail_cream/neutrogena_nail_cream.png', 'A nourishing cream that helps strengthen and moisturize nails and cuticles for healthy-looking hands.', 800.00, 99, 18, 3),
(66, 'Triple Repair Conditioner', 'images/neutrogena/hair/conditioner/triple_repair_conditioner.png', 'A repairing conditioner that strengthens hair, reduces breakage, and restores its natural shine.', 1370.00, 100, 2, 3),
(67, 'CeraVe Nourishing Hair Oil', 'images/cerave/hair/oil/nourishing_hair_oil.png', 'A lightweight, fast-absorbing hair oil designed to hydrate and protect dry, damaged hair. Infused with nourishing ingredients, it helps restore shine and smoothness while preventing frizz and breakage.', 1400.00, 100, 1, 4),
(68, 'CeraVe Moisturizing Conditioner', 'images/cerave/hair/conditioner/moisturizing_conditioner.png', 'This conditioner delivers deep hydration to dry, brittle hair while strengthening strands. It helps lock in moisture and smoothen hair texture without leaving it greasy or heavy.', 1100.00, 100, 2, 4),
(69, 'CeraVe Daily Repair Shampoo', 'images/cerave/hair/shampoo/daily_repair_shampoo.png', 'A gentle, sulfate-free shampoo formulated to cleanse without stripping hair of natural oils. It restores moisture balance while promoting scalp health, making it ideal for sensitive or dry scalps.', 1200.00, 97, 3, 4),
(70, 'CeraVe Gentle Hydrating Cleanser', 'images/cerave/face/cleanser/gentle_hydrating_cleanser.png', 'A creamy, non-foaming face cleanser that effectively removes dirt, makeup, and impurities while preserving the skin’s natural moisture barrier. Ideal for dry and sensitive skin.', 1300.00, 100, 4, 4),
(71, 'CeraVe Daily Radiance Day Cream (SPF 30)', 'images/cerave/face/cream/daily_radiance_day_cream.png', 'A lightweight day cream with SPF protection that hydrates the skin, evens out tone, and provides sun protection. The formula is enriched with antioxidants to protect the skin from environmental damage.', 1800.00, 150, 16, 4),
(72, 'CeraVe Advanced Hydrating Serum', 'images/cerave/face/serum/advanced_hydrating_serum.png', 'A fast-absorbing serum designed to boost hydration and improve skin texture. It helps reduce the appearance of fine lines and wrinkles while promoting smoother, more radiant skin.', 2300.00, 100, 6, 4),
(73, 'CeraVe Restoring Body Lotion', 'images/cerave/body/body_lotion/restoring_body_lotion.png', 'A lightweight but deeply moisturizing body lotion that provides 24-hour hydration and helps restore the skin’s natural protective barrier. Perfect for daily use on normal to dry skin.', 1500.00, 100, 11, 4),
(74, 'CeraVe Soothing Body Wash', 'images/cerave/body/body_wash/soothing_body_wash.png', 'A gentle, non-irritating body wash that cleanses without disrupting the skin’s moisture barrier. Infused with soothing ingredients to help calm and nourish sensitive skin.', 1200.00, 100, 12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `product_category1`
--

DROP TABLE IF EXISTS `product_category1`;
CREATE TABLE IF NOT EXISTS `product_category1` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_category2_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_category2_id` (`product_category2_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category1`
--

INSERT INTO `product_category1` (`id`, `name`, `product_category2_id`) VALUES
(1, 'Oil', 1),
(2, 'Conditioner', 1),
(3, 'Shampoo', 1),
(4, 'Cleanser', 4),
(5, 'Day Cream', 4),
(6, 'Serum', 4),
(7, 'Foundation Cream', 4),
(8, 'Lipstick', 2),
(9, 'Lip Liner', 2),
(10, 'Nail Polish', 3),
(11, 'Body Lotion', 5),
(12, 'Body Wash', 5),
(13, 'Eyeliner', 6),
(14, 'Mascara', 6),
(15, 'Kajal', 6),
(16, 'Cream', 4),
(17, 'Eye shadow', 6),
(18, 'Nail Cream', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_category2`
--

DROP TABLE IF EXISTS `product_category2`;
CREATE TABLE IF NOT EXISTS `product_category2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category2`
--

INSERT INTO `product_category2` (`id`, `name`) VALUES
(1, 'Hair'),
(2, 'Lip'),
(3, 'Nail'),
(4, 'Face'),
(5, 'Body'),
(6, 'Eye');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `user_id`, `question`) VALUES
(1, 2, 'this is the bad web site i have ever met\r\n'),
(2, 3, 'good'),
(3, 3, 'good'),
(4, 3, 'good');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rating` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `customer_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `rating`, `description`, `customer_id`, `product_id`, `date`) VALUES
(1, 8, 'This is one of best item i had in my life.', 2, 1, '2024-11-12 16:21:29'),
(2, 3, 'this is a good product', 3, 15, '2024-11-19 17:03:39'),
(3, 6, 'good one\r\n', 3, 1, '2024-11-20 03:50:14'),
(4, 5, 'good', 3, 23, '2024-11-20 04:21:03'),
(5, 5, 'good one', 3, 54, '2024-11-29 14:11:16');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `brand_id` int DEFAULT NULL,
  `PASSWORD` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `email`, `name`, `phone_number`, `brand_id`, `PASSWORD`) VALUES
(1, 'madushanp835@gmail.com', 'pubudu', '0762691330', 1, 'pubudu1234');

-- --------------------------------------------------------

--
-- Table structure for table `userstates`
--

DROP TABLE IF EXISTS `userstates`;
CREATE TABLE IF NOT EXISTS `userstates` (
  `userid` int NOT NULL,
  `role` enum('Admin','Customer','Supplier') NOT NULL,
  `status` enum('active','disabled') NOT NULL,
  PRIMARY KEY (`userid`,`role`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userstates`
--

INSERT INTO `userstates` (`userid`, `role`, `status`) VALUES
(1, 'Admin', 'active'),
(1, 'Customer', 'active');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD CONSTRAINT `cart_product_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`),
  ADD CONSTRAINT `cart_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_address` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `fk_discount_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`product_category1_id`) REFERENCES `product_category1` (`id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brand_category` (`id`);

--
-- Constraints for table `product_category1`
--
ALTER TABLE `product_category1`
  ADD CONSTRAINT `product_category1_ibfk_1` FOREIGN KEY (`product_category2_id`) REFERENCES `product_category2` (`id`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_question_user_id` FOREIGN KEY (`user_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brand_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
