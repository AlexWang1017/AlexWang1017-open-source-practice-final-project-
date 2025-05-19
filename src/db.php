<?php
session_start();

date_default_timezone_set('Asia/Taipei');


$host = 'localhost';
$db   = 'message_wall';
$user = 'user';
$pass = '0000';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}
?>
