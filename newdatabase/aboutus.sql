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
-- Table structure for table `aboutus`
--

CREATE TABLE `aboutus` (
  `id` int UNSIGNED NOT NULL,
  `description` longtext NOT NULL,
  `text2` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `image` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `image_name` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `aboutus`
--

INSERT INTO `aboutus` (`id`, `description`, `text2`, `image`, `image_name`) VALUES
(1, '                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <h1 class=\"header-dot text-lg font-semiBold leading-7 text-gray-800 2lg:text-2xl 2lg:leading-10\" style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; line-height: 2.5rem; --tw-border-spacing-x: 0; --tw-border-spacing-y: 0; --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; --tw-pan-x: ; --tw-pan-y: ; --tw-pinch-zoom: ; --tw-scroll-snap-strictness: proximity; --tw-gradient-from-position: ; --tw-gradient-via-position: ; --tw-gradient-to-position: ; --tw-ordinal: ; --tw-slashed-zero: ; --tw-numeric-figure: ; --tw-numeric-spacing: ; --tw-numeric-fraction: ; --tw-ring-inset: ; --tw-ring-offset-width: 0px; --tw-ring-offset-color: #fff; --tw-ring-color: rgba(25,140,255,.5); --tw-ring-offset-shadow: 0 0 #0000; --tw-ring-shadow: 0 0 #0000; --tw-shadow: 0 0 #0000; --tw-shadow-colored: 0 0 #0000; --tw-blur: ; --tw-brightness: ; --tw-contrast: ; --tw-grayscale: ; --tw-hue-rotate: ; --tw-invert: ; --tw-saturate: ; --tw-sepia: ; --tw-drop-shadow: ; --tw-backdrop-blur: ; --tw-backdrop-brightness: ; --tw-backdrop-contrast: ; --tw-backdrop-grayscale: ; --tw-backdrop-hue-rotate: ; --tw-backdrop-invert: ; --tw-backdrop-opacity: ; --tw-backdrop-saturate: ; --tw-backdrop-sepia: ; --tw-contain-size: ; --tw-contain-layout: ; --tw-contain-paint: ; --tw-contain-style: ; border: 0px solid rgb(240, 240, 240); -webkit-tap-highlight-color: transparent; --tw-text-opacity: 1;\"><h1 style=\"text-align: right;\">درباره <b><font color=\"#397b21\"><span style=\"font-family: IRANSansWeb;\">نوتیک</span></font></b></h1><p class=\"isSelectedEnd\"><br></p><p class=\"isSelectedEnd\">باشگاه نوتیک با هدف ایجاد محیطی حرفه‌ای و انگیزه‌بخش برای ورزشکاران، فعالیت خود را بر پایه تخصص، تجربه و توجه به نیازهای فردی اعضا دنبال می‌کند. این مجموعه تلاش دارد با فراهم کردن امکانات مناسب و ارائه خدمات تخصصی، مسیر پیشرفت و رسیدن به اهداف ورزشی را برای علاقه‌مندان هموار کند.</p><p class=\"isSelectedEnd\">در نوتیک، علاوه بر ارائه برنامه‌های تمرینی متناسب با اهداف هر فرد، خدمات مشاوره ورزشی و فروش مکمل‌های ورزشی نیز ارائه می‌شود تا ورزشکاران بتوانند با آگاهی و برنامه‌ریزی بهتر تمرینات خود را دنبال کنند. تیم حرفه‌ای مجموعه نیز در طول مسیر، همراه اعضا است تا هر فرد متناسب با شرایط و هدف خود بهترین نتیجه را به دست آورد.</p><p class=\"isSelectedEnd\">تجربه، فعالیت مستمر و کسب افتخارات متعدد باعث شده باشگاه نوتیک به یکی از مجموعه‌های مورد توجه ورزشکاران تبدیل شود و هر روز میزبان تعداد زیادی از علاقه‌مندان به ورزش و تناسب اندام باشد. حضور ورزشکاران پرتعداد و رضایت اعضا، نشان‌دهنده اعتماد و جایگاه این مجموعه در میان ورزشکاران است.</p><p class=\"isSelectedEnd\">ما در باشگاه نوتیک باور داریم که رسیدن به موفقیت ورزشی تنها به تمرین کردن محدود نمی‌شود؛ بلکه داشتن برنامه مناسب، تغذیه صحیح، استفاده آگاهانه از مکمل‌ها و دریافت مشاوره تخصصی نیز نقش مهمی در این مسیر دارد. به همین دلیل تلاش می‌کنیم مجموعه‌ای کامل از خدمات مورد نیاز ورزشکاران را در یک محیط حرفه‌ای فراهم کنیم.</p><p>هدف نوتیک، همراهی با ورزشکاران در مسیر پیشرفت، افزایش آمادگی جسمانی و دستیابی به بهترین نسخه از خودشان است؛ مسیری که با انگیزه، استمرار و راهنمایی درست می‌تواند به نتایجی ماندگار و ارزشمند منجر شود.</p></h1>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ', '<span style=\"margin: 0px; padding: 0px; border: 0px solid; text-align: justify;\">باشگاه فوتبال نوتیک فقط جایی برای تمرین فوتبال نیست؛ جایی است که استعدادها کشف می‌شوند، شخصیت‌ها ساخته می‌شوند و قهرمانان آینده شکل می‌گیرند. با مربیان حرفه‌ای، برنامه‌های تمرینی اصولی و محیطی پویا، قدم‌به‌قدم در مسیر پیشرفت و موفقیت همراهت هستیم. اگر می‌خواهی مهارت‌هایت را ارتقا بدهی، اعتمادبه‌نفس بیشتری پیدا کنی و در زمین فوتبال بدرخشی، نوتیک بهترین نقطه شروع توست. امروز به خانواده نوتیک بپیوند و آینده فوتبالی خودت را بساز.</span>                                                                                                                    ', '../../public/images/aboutUs/833795728987cf5542a6d381244746e5.webp', '1f9d196e90699339ed71bb71466d843f.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aboutus`
--
ALTER TABLE `aboutus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aboutus`
--
ALTER TABLE `aboutus`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
