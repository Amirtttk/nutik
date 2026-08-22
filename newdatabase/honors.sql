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
-- Table structure for table `honors`
--

CREATE TABLE `honors` (
  `id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `type` int DEFAULT NULL,
  `svg` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `text` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `description` text NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `honors`
--

INSERT INTO `honors` (`id`, `title`, `type`, `svg`, `text`, `description`, `status`) VALUES
(1, 'تست', 1, NULL, '                                                                                                                                <div style=\"margin: 0px; padding: 0px; border: 0px solid; color: oklch(0.37 0.013 285.805); font-family: yekanBakhRegular; font-size: 14px; text-align: justify;\">قهرمان دوره 15 خلیج فارس و ایران</div><div style=\"margin: 0px; padding: 0px; border: 0px solid; color: oklch(0.37 0.013 285.805); font-family: yekanBakhRegular; font-size: 14px; text-align: justify;\">قهرمان دوره 15 خلیج فارس و ایران</div><div style=\"margin: 0px; padding: 0px; border: 0px solid; color: oklch(0.37 0.013 285.805); font-family: yekanBakhRegular; font-size: 14px; text-align: justify;\">قهرمان دوره 15 خلیج فارس و ایران</div><div style=\"margin: 0px; padding: 0px; border: 0px solid; color: oklch(0.37 0.013 285.805); font-family: yekanBakhRegular; font-size: 14px; text-align: justify;\">قهرمان دوره 15 خلیج فارس و ایران</div><div style=\"margin: 0px; padding: 0px; border: 0px solid; color: oklch(0.37 0.013 285.805); font-family: yekanBakhRegular; font-size: 14px; text-align: justify;\">تست</div>                                                                                                        ', '                                            تست                                        ', 1),
(4, 'مجموعه ورزشی معتبر', 2, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\"              stroke=\"currentColor\" stroke-width=\"1.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\">             <path d=\"M8 21h8\"/>             <path d=\"M12 17v4\"/>             <path d=\"M7 4h10v5a5 5 0 0 1-10 0V4Z\"/>             <path d=\"M7 6H4v2a4 4 0 0 0 4 4\"/>             <path d=\"M17 6h3v2a4 4 0 0 1-4 4\"/> <path d=\"M9 2h6v2H9z\"/> </svg>', NULL, 'فعالیت حرفه‌ای و مستمر باشگاه نوتیک با هدف ارتقای سطح آمادگی و سلامت ورزشکاران.\n                                                        ', 1),
(5, 'جامعه بزرگ ورزشکاران', 2, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\"              stroke=\"currentColor\" stroke-width=\"1.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\">             <circle cx=\"9\" cy=\"8\" r=\"3\"/>             <circle cx=\"17\" cy=\"9\" r=\"2.5\"/>             <path d=\"M3 20a6 6 0 0 1 12 0\"/>             <path d=\"M14 15a5 5 0 0 1 7 5\"/>         </svg>', NULL, 'حضور تعداد زیادی از ورزشکاران و اعضای فعال در مجموعه باشگاه نوتیک\n                                                        ', 1),
(6, 'مشاوره تخصصی ورزشی و تغذیه', 2, '  <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\"              stroke=\"currentColor\" stroke-width=\"1.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\">             <path d=\"M12 3v18\"/>             <path d=\"M8 7h8\"/>             <path d=\"M6 10h12\"/>             <path d=\"M7 10c0 3 2 5 5 5s5-2 5-5\"/>             <path d=\"M5 7h14\"/>             <path d=\"M9 21h6\"/>         </svg>', NULL, 'ارائه مشاوره تخصصی برای انتخاب مکمل، تغذیه و رسیدن به اهداف ورزشی.\n                                                        ', 1),
(7, 'ارائه برنامه‌های اختصاصی', 2, ' <svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\"              stroke=\"currentColor\" stroke-width=\"1.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\">             <path d=\"M6 3h12\"/>             <path d=\"M6 21h12\"/>             <path d=\"M8 3v5l4 4 4-4V3\"/>             <path d=\"M8 21v-5l4-4 4 4v5\"/>             <path d=\"M9 6h6\"/>             <path d=\"M9 18h6\"/>         </svg>', NULL, 'طراحی و ارائه برنامه‌های تمرینی و تغذیه‌ای متناسب با هدف و شرایط هر ورزشکار.\n                                                        ', 1),
(8, 'فروش مکمل‌های ورزشی', 2, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\"              stroke=\"currentColor\" stroke-width=\"1.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\">             <path d=\"M9 3h6\"/>             <path d=\"M10 3v4l-3 4v7a3 3 0 0 0 3 3h4a3 3 0 0 0 3-3v-7l-3-4V3\"/>             <path d=\"M7 14h10\"/>             <path d=\"M9 17h6\"/>         </svg>', NULL, 'عرضه انواع مکمل‌های ورزشی با هدف کمک به عملکرد، ریکاوری و رشد بهتر ورزشکاران.\n                                                        ', 1),
(9, 'اعتماد ورزشکاران', 2, '<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" fill=\"none\"              stroke=\"currentColor\" stroke-width=\"1.8\" stroke-linecap=\"round\" stroke-linejoin=\"round\">             <path d=\"M12 3l2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2L3 9.6l6.2-.9L12 3Z\"/>         </svg>', NULL, 'اعتماد و رضایت ورزشکاران نوتیک حاصل فعالیت حرفه‌ای و خدمات متنوع مجموعه است.\n                                                        ', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `honors`
--
ALTER TABLE `honors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `honors`
--
ALTER TABLE `honors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
