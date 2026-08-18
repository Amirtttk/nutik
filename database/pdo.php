<?php
try {
    $cn = new PDO(
        "mysql:dbname=" . DB['name'] . ";host=" . DB['host'], DB['username'],DB['password'],
        array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
        )
    );

} catch (PDOException $e) {
    exit('problem connecting to the database');
}