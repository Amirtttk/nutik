-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 19, 2026 at 09:15 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nutik`
--

-- --------------------------------------------------------

--
-- Table structure for table `information`
--

CREATE TABLE `information` (
  `id` int UNSIGNED NOT NULL,
  `mobileHeather` varchar(12) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `mobileHeather2` varchar(12) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `title_store` varchar(30) NOT NULL,
  `title1` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `text3` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `image` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `image_name` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `image2` varchar(100) NOT NULL,
  `image_name2` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `font` int NOT NULL,
  `address` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `mobile_sms` varchar(11) NOT NULL,
  `theme` int NOT NULL,
  `email` varchar(30) NOT NULL,
  `post_code` varchar(30) NOT NULL,
  `working_hours` varchar(50) NOT NULL,
  `color2` varchar(10) NOT NULL,
  `color3` varchar(10) NOT NULL,
  `zarinpal` varchar(256) NOT NULL,
  `imges_blogs` text NOT NULL,
  `link_blog` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `information`
--

INSERT INTO `information` (`id`, `mobileHeather`, `mobileHeather2`, `title_store`, `title1`, `text`, `text3`, `image`, `image_name`, `image2`, `image_name2`, `color`, `font`, `address`, `mobile_sms`, `theme`, `email`, `post_code`, `working_hours`, `color2`, `color3`, `zarinpal`, `imges_blogs`, `link_blog`) VALUES
(1, '09916359004', '09372795024', 'نوتیک', 'اعتبار ما از [اعتماد] شماست/ باشگاه فوتبال [نونیک]', '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                باشگاه نوتیک با ارائه مکمل‌های ورزشی، مشاوره تخصصی و برنامه‌های تمرینی حرفه‌ای، مسیر رسیدن به اهداف ورزشی شما را هموار می‌کند.<br data-start=\"130\" data-end=\"133\">\nاین مجموعه با سال‌ها تجربه و کسب افتخارات متعدد، یکی از باشگاه‌های محبوب و پرمراجعه بین ورزشکاران است.<br data-start=\"235\" data-end=\"238\">\nدر نوتیک، با همراهی مربیان حرفه‌ای و برنامه‌های اختصاصی، قدمی مطمئن برای تناسب اندام و موفقیت بردارید.                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ', 'ما با ارائه خدمات تخصصی و باکیفیت، تلاش می‌کنیم تجربه‌ای متفاوت برای شما ایجاد کنیم.', '../../public/images/logo/f26787a02dfae39b4ddecdf4ceb5c94f.png', '1e3ff12d07cbfaeebef4ec3063809c67.png', '', '', '#ff3e43', 3, 'تهران - خیابان دماوند - دماوند 12 - پلاک 765 ', '09330756569', 1, 'amir@gmail.com', '9898989898', '9صبح تا 10 شب', '#ef1015', '#c11e22', 'cbebdb53-a314-422c-94e8-96ae8f622c2d', 'a34b06c1473998b0b4e52b063daefabf.png', 'test.ir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `information`
--
ALTER TABLE `information`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `information`
--
ALTER TABLE `information`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
