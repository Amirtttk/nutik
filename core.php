<?php
// نصب آسان: اگر پروژه نصب نشده یا مقادیر دیتابیس خالی باشند، فرم نصب نمایش داده می‌شود
$installFlagPath = __DIR__ . '/configs/installed.flag';
$configPath = __DIR__ . '/configs/app.php';

function isDbConfigEmpty($configPath) {
    if (!is_readable($configPath)) {
        return true;
    }
    $content = file_get_contents($configPath);
    if (preg_match('/"name"\s*=>\s*"([^"]*)"/', $content, $m) && trim($m[1]) !== '') {
        if (preg_match('/"host"\s*=>\s*"([^"]*)"/', $content, $h) && trim($h[1]) !== '') {
            if (preg_match('/"username"\s*=>\s*"([^"]*)"/', $content, $u) && trim($u[1]) !== '') {
                return false; // همه مقدار دارند
            }
        }
    }
    return true;
}

$needInstall = !file_exists($installFlagPath) || isDbConfigEmpty($configPath);
if ($needInstall) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['install_step']) && $_POST['install_step'] === 'db') {
        require_once __DIR__ . '/requests/install/save.php';
        exit;
    }
    require_once __DIR__ . '/views/install/index.php';
    exit;
}

// app
require_once "configs/app.php";

// helper
require_once "helpers/functions.php";
require_once "helpers/sesstion.php";
require_once "helpers/payment.php";
require_once "helpers/filter_page.php";
if ($adminRout) {
} else {
    require_once "helpers/filter_page_user.php";
}

// database
require_once "database/pdo.php";

// tools
require_once "tools/jdf.php";

// models
require_once "models/allFunction.php";
if ($adminRout) {
    require_once "models/admin.php";
} else {
    require_once "models/user.php";
}