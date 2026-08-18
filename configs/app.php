<?php

 const DB = [
    "name" => "nutik",
    "username" => "root",
    "password" => "",
    "host" => "localhost"
];


const SECRET_TOKEN = [
    "senior_manager"  => 'ANVJOW%#EJE345PWPJGPJWEGJWECAPSKowheoghwhegoihweghoi9812097463651!@&)&#@%$',
    "administrators"  => 'giufqewbvjdsAHWIEGHBNK"£$)&(&(234798aauicwebyviuyq68253VWTE-8124GERGER',
];

const TYPES_USERS = [
    1 => ['details_senior_managers', 'مدیران اصلی', 'مدیر اصلی'],
    2 => ['details_administrators', 'مدیران سایت', 'مدیر سایت']
];

define('PATH_UPLOADS_DIR', realpath(__DIR__ . '/../public') . DIRECTORY_SEPARATOR);
define('BASE_PATH', realpath(__DIR__ . '/../public') . DIRECTORY_SEPARATOR);
define('BASE_URL', rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/');
define('DEBUG_PDO', false); // true برای نمایش خطای دیتابیس هنگام توسعه
$adminRout = strpos(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/admin') === 0;
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? 'localhost';
define('CALL_BACK_URL', $scheme . '://' . $host . '/callback');
