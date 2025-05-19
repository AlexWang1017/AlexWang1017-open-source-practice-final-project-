<?php
require 'db.php';

if (!isset($_SESSION['admin'])) {
    die('你不是管理員！');
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $pdo->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;
