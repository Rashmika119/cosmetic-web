-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 13, 2024 at 09:11 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `street_1`, `street_2`, `district`, `postal_code`) VALUES
(1, 'yaya 2/20', 'uwa tissapura', 'badulla', '119');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `customer_id`) VALUES
(1, 1),
(2, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_product`
--

INSERT INTO `cart_product` (`cart_id`, `product_id`, `quantity`) VALUES
(1, 23, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `f_name`, `l_name`, `password`, `phone_number`, `email`, `address_id`) VALUES
(1, 'Rasadhi', 'Sanchala', 'Rasadhi', '0715840232', 'rasadhi1017@gmail.com', NULL),
(2, 'pubudu', 'madushan', 'pubudu1234', '0762691330', 'madushanp835@gmail.com', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(10, 10, 300.00);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status`, `due_date`, `created_at`, `customer_id`, `address`) VALUES
(14, 'Pending', '2024-11-26', '2024-11-12 13:40:03', 2, 'yaya 2/20, uwa tissapura, badulla 119');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `quantity`) VALUES
(14, 2, 5),
(14, 3, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `amount`, `account_number`, `date`, `provider`, `customer_id`, `order_id`, `status`) VALUES
(4, 11900.00, 'visa', '2024-11-12 13:40:03', '123456789', 2, 14, 'Pending');

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
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `image`, `description`, `price`, `quantity`, `product_category1_id`, `brand_id`) VALUES
(1, 'Garnier Fructis Sleek & Shine Anti-Frizz Serum', 'images/garnier/hair/oil/garnier_fructis_sleek_shine_anti_frizz_serum.png', 'A serum designed to fight frizz and enhance shine, leaving your hair smooth and manageable, even in humid conditions. Perfect for sleek, long-lasting styles.', 1500.00, 0, 1, 1),
(2, 'Garnier Ultimate Blends Argan & Camellia Oil Weightless Hair Oil', 'images/garnier/hair/oil/garnier_ultimate_blends_argan_camelia_oil.png', 'A lightweight, non-greasy hair oil that nourishes and hydrates dry hair, leaving it soft and shiny. Provides a smooth finish without weighing the hair down.', 1800.00, -5, 1, 1),
(3, 'Garnier Hair Care Whole Blends Strengthening Ginger Recovery Shampoo', 'images/garnier/hair/conditioner/garnier_whole_blends_strengthening_ginger_recovery.png', 'A strengthening shampoo infused with ginger and herbal extracts, designed to repair and revitalize weak, damaged hair.', 1400.00, 89, 2, 1),
(4, 'The 14 Best Drugstore Shampoos for All Your Hair Care Needs', 'images/garnier/hair/conditioner/14_best_drugstore_shampoos.png', 'A collection of top-rated drugstore shampoos that cater to various hair types and concerns, from hydration to frizz control.', 0.00, 91, 2, 1),
(5, 'Argan Oil & Camellia Shampoo - Ultimate Blends - Garnier', 'images/garnier/hair/shampoo/argan_oil_camellia_shampoo.png', 'This nourishing shampoo blends argan oil and camellia oil to hydrate and soften hair, leaving it smooth, shiny, and manageable.', 1600.00, 100, 3, 1),
(6, 'Garnier Ultra Doux Nourishing Shampoo Avocado Oil & Shea Butter', 'images/garnier/hair/shampoo/garnier_ultra_doux_nourishing_shampoo.png', 'A rich, nourishing shampoo formulated with avocado oil and shea butter, designed to deeply moisturize and strengthen dry, damaged hair.', 1800.00, 100, 3, 1),
(7, 'Garnier Skinactive Micellar Foaming Gel Cleanser - Makeup Remover', 'images/garnier/face/cleanser/garnier_skinactive_micellar_foaming_gel.png', 'A gentle micellar gel cleanser that effectively removes makeup, dirt, and oil without harsh rubbing. Suitable for all skin types, it leaves the skin clean, refreshed, and hydrated.', 1200.00, 99, 4, 1),
(8, 'Gentle Hydrating Deep Face Cleanser - Garnier', 'images/garnier/face/cleanser/gentle_hydrating_deep_face_cleanser.png', 'A deep-penetrating facial cleanser that hydrates and purifies the skin. Ideal for daily use, it removes impurities and excess oil while maintaining the skin\'s moisture balance.', 1300.00, 100, 4, 1),
(9, 'Garnier Skin Active Rose Day Cream', 'images/garnier/face/day_cream/garnier_skin_active_rose_day_cream.png', 'A soothing day cream enriched with rose water that hydrates and calms sensitive skin. It provides lightweight moisture, leaving the skin soft, smooth, and refreshed.', 1500.00, 100, 5, 1),
(10, 'Garnier Vitamin C Brightening Day Cream', 'images/garnier/face/day_cream/garnier_vitamin_c_brightening_day_cream.png', 'A brightening day cream infused with Vitamin C to reduce dark spots and enhance skin\'s radiance. It leaves the skin glowing and visibly even-toned with regular use.', 1800.00, 100, 5, 1),
(11, 'Garnier Bright Complete Vitamin C Serum', 'images/garnier/face/serum/garnier_bright_complete_vitamin_c_serum.png', 'A fast-absorbing serum formulated with Vitamin C to enhance skin\'s radiance and promote a healthy, glowing complexion. It reduces dark spots and uneven skin tone, giving a brighter and clearer look.', 2000.00, 100, 6, 1),
(12, 'Garnier Light Complete Vitamin C Booster Face Serum', 'images/garnier/face/serum/garnier_light_complete_vitamin_c_booster_serum.png', 'A concentrated Vitamin C serum designed to lighten dark spots and brighten the skin. It delivers a luminous complexion while improving the skin’s texture and tone with regular use.', 1800.00, 101, 6, 1),
(13, 'Garnier BB Cream All-In-One Perfector Even Tone (Medium)', 'images/garnier/face/foundation/garnier_bb_cream_all_in_one.png', 'A multi-tasking BB cream that evens skin tone, moisturizes, and provides sun protection with SPF 50. It offers medium coverage for a natural, flawless finish while keeping the skin hydrated and protected throughout the day.', 2200.00, 100, 7, 1),
(14, 'Garnier Express Aclara With Vitamin C & SPF 30', 'images/garnier/face/foundation/garnier_express_aclaira.png', 'A lightweight foundation cream infused with Vitamin C that brightens the skin while offering sun protection with SPF 30. It helps reduce dark spots and provides a radiant, even complexion.', 1900.00, 100, 7, 1),
(15, 'Clarins Lip Perfector Pomegranate Glow', 'images/garnier/lip/lipstick/clarins_lip_perfector_pomegranate_glow.png', 'A hydrating lip gloss that provides a sheer, luminous finish with a hint of color. Enriched with pomegranate extract, it enhances the lips\' natural glow while keeping them moisturized and soft.', 3200.00, 93, 8, 1),
(16, 'Clarins Natural Lip Perfector 18 Intense Garnet', 'images/garnier/lip/lipstick/clarins_natural_lip_perfector_18_intense_garnet.png', 'A creamy lip gloss that delivers intense color and hydration. This formula enhances the lips with a rich, glossy finish while providing long-lasting moisture and comfort.', 3500.00, 97, 8, 1),
(17, 'Essence Lip Liner', 'images/garnier/lip/lip_liner/essence_lip_liner.png', 'A smooth and long-lasting lip liner that defines the lips and prevents lipstick from feathering. Available in various shades, it provides a precise application for a perfect pout.', 700.00, 100, 9, 1),
(18, 'IRL Filter Finish Lip Liner Definer', 'images/garnier/lip/lip_liner/irl_filter_finish_lip_liner_definer.png', 'A creamy lip liner designed to create a flawless lip shape with a filter-like finish. Its blendable formula allows for easy application and long-lasting wear, enhancing the overall lip look.', 800.00, 100, 9, 1),
(19, 'Esmaltólatras Assumidas - Esmaltes Guisseny II', 'images/garnier/nail/nail_polish/esmalto_latra_assumidas.png', 'A vibrant nail polish that offers a smooth and even application with a long-lasting finish. Available in a variety of shades, it adds a pop of color to your nails while providing a glossy look.', 1000.00, 100, 10, 1),
(20, 'Nail Polish (Brand varies: Primark, Kat Von D, Essence, Kiko)', 'images/garnier/nail/nail_polish/nail_polish_various_brands.png', 'A collection of nail polishes from various brands, known for their high-quality formulas and trendy colors. These polishes are designed for easy application and a durable, glossy finish.', 800.00, 94, 10, 1),
(21, 'Garnier Bright Complete Body Lotion', 'images/garnier/body/body_lotion/garnier_bright_complete_body_lotion.png', 'A brightening body lotion that nourishes and hydrates the skin while helping to even out skin tone. Formulated with Vitamin C, it leaves the skin feeling soft, smooth, and radiant.', 1500.00, 100, 11, 1),
(22, 'Garnier Body Repair Body Lotion for Dry Skin', 'images/garnier/body/body_lotion/garnier_body_repair_body_lotion.png', 'A deeply hydrating body lotion designed for dry skin. It provides intense moisture and helps repair and soothe dry, rough skin, leaving it soft and supple.', 1600.00, 100, 11, 1),
(23, 'Garnier Body Ultimate Beauty Oil', 'images/garnier/body/body_wash/garnier_body_ultimate_beauty_oil.png', 'A luxurious body wash infused with beauty oils that gently cleanses while nourishing the skin. It leaves the skin feeling soft and hydrated, providing a pampering shower experience.', 1400.00, 88, 12, 1),
(24, 'Garnier Summer Body Hydrating Gradual Tan Moisturiser', 'images/garnier/body/body_wash/garnier_summer_body_hydrating_gradual_tan.png', 'A hydrating moisturizer that provides a subtle, gradual tan while nourishing the skin. Ideal for achieving a sun-kissed glow, it keeps the skin hydrated and radiant without streaks.', 1800.00, 101, 12, 1),
(25, '2 in 1 Brown + Black Gel Eyeliner', 'images/garnier/eye/eyeliner/2in1_brown_black_gel_eyeliner.png', 'A versatile gel eyeliner that offers both brown and black shades in one product. It glides on smoothly for a precise application and provides long-lasting wear, perfect for creating various eye looks.', 900.00, 100, 13, 1),
(26, 'Nyx Professional Makeup VIVID BRIGHT LINER - Ghosted Green', 'images/garnier/eye/eyeliner/nyx_vivid_bright_liner_ghosted_green.png', 'A vibrant liquid eyeliner in a striking ghosted green shade. This formula is highly pigmented, easy to apply, and perfect for adding a pop of color to your eye makeup.', 1200.00, 100, 13, 1),
(27, 'Golden Rose Defined Lashes Maxim Eyes Mascara', 'images/garnier/eye/mascara/golden_rose_defined_lashes_maxim_eyes_mascara.png', 'A defining mascara that enhances lash length and volume for a dramatic effect. Its unique brush captures and separates each lash, providing a clump-free application for beautifully defined eyes.', 1000.00, 98, 14, 1),
(28, 'Maybelline Lash Sensational Waterproof Mascara', 'images/garnier/eye/mascara/maybelline_lash_sensational_waterproof.png', 'A waterproof mascara designed to lengthen and volumize lashes for a full fan effect. Its exclusive brush fanned out lashes for a multiplied look, ensuring long-lasting wear and smudge resistance.', 1400.00, 100, 14, 1),
(29, 'Elle 18 Kajal', 'images/garnier/eye/kajal/elle_18_kajal.png', 'A smooth and creamy kajal that provides intense black color for bold eye definition. Its easy-to-apply formula is perfect for creating various eye looks, from subtle to dramatic.', 500.00, 100, 15, 1),
(30, 'LAKMÉ Eyeconic Kajal with Insta Eye Liner', 'images/garnier/eye/kajal/lakme_eyeconic_kajal.png', 'A combo set featuring a highly pigmented kajal for bold eye looks and an eyeliner for precise definition. The kajal is smudge-proof and long-lasting, while the eyeliner provides a sleek finish for versatile makeup styles.', 900.00, 100, 15, 1),
(31, 'Sublime Bronze', 'images/loreal/body/body_lotion/sublime_bronze.png', 'A rich body lotion that deeply hydrates and nourishes dry skin, leaving it smooth and soft.', 14.99, 100, 11, 2),
(32, 'Silky Lotion', 'images/loreal/body/body_lotion/silky_lotion.png', 'Lightweight body lotion that provides long-lasting moisture without feeling greasy.', 13.99, 100, 11, 2),
(33, 'Revitalift', 'images/loreal/face/cleanser/revitalift.png', 'Gentle foaming cleanser that removes dirt and impurities, leaving skin refreshed.', 9.99, 100, 4, 2),
(34, 'Age Perfect', 'images/loreal/face/cleanser/age_perfect.png', 'Deep-cleansing formula that unclogs pores and clears excess oil for a clearer complexion.', 10.99, 100, 4, 2),
(35, 'Elvital', 'images/loreal/hair/conditioner/elvital.png', 'Moisturizing conditioner that detangles and smooths frizzy hair, making it manageable.', 8.99, 100, 2, 2),
(36, 'Elvin Hyaluron', 'images/loreal/hair/conditioner/elvin_hyaluron.png', 'Strengthening conditioner that repairs and revitalizes damaged hair, restoring shine.', 9.99, 99, 2, 2),
(37, 'Elvin Total Repair', 'images/loreal/hair/conditioner/elvin_total_repair.png', 'Nourishing conditioner that provides intense hydration for dry, brittle hair.', 10.99, 100, 2, 2),
(38, 'Skin Perfect', 'images/loreal/face/cream/skin_perfect.png', 'A day cream that hydrates and protects the skin while giving it a radiant glow.', 19.99, 100, 16, 2),
(39, 'Super Blowdry', 'images/loreal/face/cream/super_blowdry.png', 'Anti-aging night cream that firms the skin and reduces fine lines for a youthful appearance.', 24.99, 100, 16, 2),
(40, 'Eye Liner', 'images/loreal/eye/eyeliner/eye_liner.png', ' smudge-proof eyeliner that delivers bold color and precise definition all day long.', 6.99, 100, 13, 2),
(41, 'La Palette', 'images/loreal/eye/eyeshadow/la_palette.png', 'Blendable eye shadow palette with a range of shades for versatile eye looks.', 14.99, 100, 17, 2),
(42, 'Infallible', 'images/loreal/face/foundation_cream/infallible.png', 'Lightweight foundation cream that provides even coverage and a natural finish.', 15.99, 100, 7, 2),
(43, 'Extra Ordinary Oil', 'images/loreal/hair/oil/extra_ordinary_oil.png', 'Multi-purpose hair oil that nourishes and smooths hair, reducing frizz and adding shine.', 12.99, 65, 1, 2),
(44, 'Kajal Magic', 'images/loreal/eye/kajal/kajal_magic.png', 'Intense black kajal that delivers long-lasting, smudge-proof color for bold eyes.', 5.99, 100, 15, 2),
(45, 'Lip Liner Couture', 'images/loreal/lip/lip_liner/lip_liner_couture.png', 'Smooth lip liner that defines and enhances your lips with a long-lasting, natural finish.', 7.99, 100, 9, 2),
(46, 'Ultra Matte', 'images/loreal/lip/lipstick/ultra_matte.png', 'Rich, creamy lipstick with vibrant color that hydrates and softens lips.', 9.99, 96, 8, 2),
(47, 'Infallible', 'images/loreal/lip/lipstick/infallible.png', ' Matte finish lipstick that delivers bold, long-lasting color without drying your lips.', 10.99, 100, 8, 2),
(48, 'Paradise', 'images/loreal/eye/mascara/paradise.png', 'Lengthening and volumizing mascara that enhances your lashes for a dramatic effect.', 11.99, 100, 14, 2),
(49, 'Extra Ordinary Oil Shampoo', 'images/loreal/hair/shampoo/extra_ordinary_oil.png', 'Cleansing shampoo that removes buildup while leaving hair soft and refreshed.', 8.99, 99, 3, 2),
(50, 'Curl Expression', 'images/loreal/hair/shampoo/curl_expression.png', 'Nourishing shampoo that strengthens hair and reduces breakage for healthier locks.', 9.99, 100, 3, 2),
(51, 'Total Repair', 'images/loreal/hair/shampoo/total_repair.png', 'Smoothing shampoo that tames frizz and adds shine to unruly hair.', 10.99, 100, 3, 2),
(52, 'Anti-Residue Shampoo', 'images/neutrogena/hair/shampoo/anti_residue_shampoo.png', 'A clarifying shampoo that removes buildup and restores hair\'s natural shine with every wash.', 9.99, 100, 3, 3),
(53, 'Body Gel', 'images/neutrogena/body/body_lotion/body_gel.png', 'A refreshing gel that soothes and moisturizes your skin, leaving it soft and smooth after every use.', 12.99, 100, 11, 3),
(54, 'Bright Boost Cream', 'images/neutrogena/face/cream/bright_boost_cream.png', 'A brightening cream that revitalizes dull skin, leaving your complexion radiant and even-toned.', 22.99, 100, 16, 3),
(55, 'Cleanser', 'images/neutrogena/face/cleanser/cleanser.png', 'Gentle yet effective cleanser that removes dirt and impurities without stripping your skin\'s natural moisture.', 9.99, 99, 4, 3),
(56, 'Eyeliner', 'images/neutrogena/eye/eyeliner/eyeliner.png', 'Smooth and precise eyeliner that defines your eyes with rich, long-lasting color.', 7.99, 100, 13, 3),
(57, 'Eye Shadow', 'images/neutrogena/eye/eyeshadow/eye_shadow.png', 'Vibrant, blendable eye shadow that adds a pop of color to your look, day or night.', 12.99, 100, 17, 3),
(58, 'Foundation Cream', 'images/neutrogena/face/foundation/foundation_cream.png', 'A smooth, blendable foundation that provides even coverage for a flawless complexion.', 14.99, 100, 7, 3),
(59, 'Healthy Scalp Conditioner', 'images/neutrogena/hair/conditioner/healthy_scalp_conditioner.png', 'Nourishing conditioner that hydrates and strengthens your hair, promoting a healthy scalp and soft, manageable strands.', 11.99, 100, 2, 3),
(60, 'Healthy Scalp Shampoo', 'images/neutrogena/hair/shampoo/healthy_scalp_shampoo.png', 'Gently cleanses and balances your scalp for healthy, stronger hair from root to tip.', 10.99, 100, 3, 3),
(61, 'HydroBoost Gel Cream', 'images/neutrogena/face/cream/hydroboost_gel_cream.png', 'Lightweight, hydrating gel cream infused with hyaluronic acid to keep your skin plump and refreshed all day.', 18.99, 100, 16, 3),
(62, 'Intense Repair Body Lotion', 'images/neutrogena/body/body_lotion/intense_repair_body_lotion.png', 'Deeply hydrating body lotion designed to repair dry, rough skin, leaving it soft and smooth.', 16.99, 100, 11, 3),
(63, 'Lipstick', 'images/neutrogena/lip/lipstick/lipstick.png', 'Creamy, pigmented lipstick that delivers rich color while moisturizing your lips.', 9.99, 100, 8, 3),
(64, 'Mascara', 'images/neutrogena/eye/mascara/mascara.png', 'Volumizing mascara that enhances your lashes, giving them length and definition.', 11.99, 100, 14, 3),
(65, 'Neutrogena Nail Cream', 'images/neutrogena/nail/nail_cream/neutrogena_nail_cream.png', 'A nourishing cream that helps strengthen and moisturize nails and cuticles for healthy-looking hands.', 8.99, 99, 18, 3),
(66, 'Triple Repair Conditioner', 'images/neutrogena/hair/conditioner/triple_repair_conditioner.png', 'A repairing conditioner that strengthens hair, reduces breakage, and restores its natural shine.', 13.99, 100, 2, 3),
(67, 'CeraVe Nourishing Hair Oil', 'images/cerave/hair/oil/nourishing_hair_oil.png', 'A lightweight, fast-absorbing hair oil designed to hydrate and protect dry, damaged hair. Infused with nourishing ingredients, it helps restore shine and smoothness while preventing frizz and breakage.', 14.99, 100, 1, 4),
(68, 'CeraVe Moisturizing Conditioner', 'images/cerave/hair/conditioner/moisturizing_conditioner.png', 'This conditioner delivers deep hydration to dry, brittle hair while strengthening strands. It helps lock in moisture and smoothen hair texture without leaving it greasy or heavy.', 11.99, 100, 2, 4),
(69, 'CeraVe Daily Repair Shampoo', 'images/cerave/hair/shampoo/daily_repair_shampoo.png', 'A gentle, sulfate-free shampoo formulated to cleanse without stripping hair of natural oils. It restores moisture balance while promoting scalp health, making it ideal for sensitive or dry scalps.', 12.99, 97, 3, 4),
(70, 'CeraVe Gentle Hydrating Cleanser', 'images/cerave/face/cleanser/gentle_hydrating_cleanser.png', 'A creamy, non-foaming face cleanser that effectively removes dirt, makeup, and impurities while preserving the skin’s natural moisture barrier. Ideal for dry and sensitive skin.', 13.99, 100, 4, 4),
(71, 'CeraVe Daily Radiance Day Cream (SPF 30)', 'images/cerave/face/cream/daily_radiance_day_cream.png', 'A lightweight day cream with SPF protection that hydrates the skin, evens out tone, and provides sun protection. The formula is enriched with antioxidants to protect the skin from environmental damage.', 19.99, 100, 16, 4),
(72, 'CeraVe Advanced Hydrating Serum', 'images/cerave/face/serum/advanced_hydrating_serum.png', 'A fast-absorbing serum designed to boost hydration and improve skin texture. It helps reduce the appearance of fine lines and wrinkles while promoting smoother, more radiant skin.', 23.99, 100, 6, 4),
(73, 'CeraVe Restoring Body Lotion', 'images/cerave/body/body_lotion/restoring_body_lotion.png', 'A lightweight but deeply moisturizing body lotion that provides 24-hour hydration and helps restore the skin’s natural protective barrier. Perfect for daily use on normal to dry skin.', 15.99, 100, 11, 4),
(74, 'CeraVe Soothing Body Wash', 'images/cerave/body/body_wash/soothing_body_wash.png', 'A gentle, non-irritating body wash that cleanses without disrupting the skin’s moisture barrier. Infused with soothing ingredients to help calm and nourish sensitive skin.', 12.99, 100, 12, 4);

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `rating`, `description`, `customer_id`, `product_id`, `date`) VALUES
(1, 8, 'This is one of best item i had in my life.', 2, 1, '2024-11-12 16:21:29');

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
