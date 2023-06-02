<?php

$host = "127.0.0.1";
$db = "myDatabase";
$user = "myUser";
$pass = "myPassword";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE   => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $opt);

    $sql = "CREATE TABLE IF NOT EXISTS `characters` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(50) NOT NULL,
    `type` ENUM('mage', 'guerrier') NOT NULL,
    `life` INT NOT NULL,
    `attack` INT NOT NULL,
    `defense` INT NOT NULL,
    `sleep_until` DATETIME NULL DEFAULT NULL
)";
        $pdo->exec($sql);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

