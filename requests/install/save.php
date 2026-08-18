<?php
/**
 * نصب آسان: اعتبارسنجی اتصال دیتابیس و ذخیره تنظیمات در configs/app.php
 * این فایل مستقل از core و app اجرا می‌شود.
 */

$baseDir = dirname(__DIR__, 2);
$configPath = $baseDir . '/configs/app.php';
$flagPath = $baseDir . '/configs/installed.flag';

function escapeForPhpString($s) {
    return str_replace(['\\', '"', '$'], ['\\\\', '\\"', '\\$'], (string) $s);
}

function redirectWithError($message) {
    $msg = urlencode($message);
    header('Location: /?error=' . $msg);
    exit;
}

// فقط با POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['install_step']) || $_POST['install_step'] !== 'db') {
    header('Location: /');
    exit;
}

$host = isset($_POST['db_host']) ? trim($_POST['db_host']) : '';
$name = isset($_POST['db_name']) ? trim($_POST['db_name']) : '';
$username = isset($_POST['db_username']) ? trim($_POST['db_username']) : '';
$password = isset($_POST['db_password']) ? (string) $_POST['db_password'] : '';

if ($host === '' || $name === '' || $username === '') {
    redirectWithError('هاست، نام دیتابیس و نام کاربری الزامی هستند.');
}

// اعتبارسنجی اتصال دیتابیس
try {
    $dsn = "mysql:host=" . $host . ";dbname=" . $name . ";charset=utf8";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    redirectWithError('اتصال به دیتابیس برقرار نشد: ' . $e->getMessage());
}

// خواندن فایل تنظیمات
if (!is_readable($configPath)) {
    redirectWithError('فایل تنظیمات یافت نشد.');
}
$content = file_get_contents($configPath);

// جایگزینی بلوک DB با مقادیر جدید (با escape برای رشته PHP)
$nameEsc = escapeForPhpString($name);
$userEsc = escapeForPhpString($username);
$passEsc = escapeForPhpString($password);
$hostEsc = escapeForPhpString($host);

$newDbBlock = "const DB = [\n    \"name\" => \"{$nameEsc}\",\n    \"username\" => \"{$userEsc}\",\n    \"password\" => \"{$passEsc}\",\n    \"host\" => \"{$hostEsc}\"\n];";

$pattern = '/const\s+DB\s*=\s*\[.*?\]\s*;/s';
$newContent = preg_replace($pattern, $newDbBlock, $content, 1, $count);

if ($count !== 1) {
    redirectWithError('امکان به‌روزرسانی تنظیمات دیتابیس در فایل config وجود نداشت.');
}

if (!is_writable($configPath)) {
    redirectWithError('فایل configs/app.php قابل نوشتن نیست. دسترسی نوشتن را بررسی کنید.');
}

if (file_put_contents($configPath, $newContent) === false) {
    redirectWithError('ذخیره تنظیمات با خطا مواجه شد.');
}

// ایجاد فایل علامت نصب
if (file_put_contents($flagPath, '') === false) {
    redirectWithError('ایجاد فایل نصب با خطا مواجه شد.');
}

// موفق: ریدایرکت به صفحه اصلی
header('Location: /');
exit;
