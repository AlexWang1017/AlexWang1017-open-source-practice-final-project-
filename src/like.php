<?php
require 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $pdo->prepare("UPDATE messages SET like_count = like_count + 1 WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: index.php");
exit;
