<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
require 'db.php';
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>留言管理後台</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h1>👑 管理員後台</h1>
        <p>
            <a href="index.php">🔙 返回留言牆</a> ｜ 
            <a href="logout.php">登出</a>
        </p>

        <h2>📝 所有留言清單</h2>

        <?php
        $stmt = $pdo->query("SELECT * FROM messages ORDER BY created_at DESC");
        foreach ($stmt as $row):
        ?>
            <div class="message-block">
                <div class="message-header">
                    [<?= $row['created_at'] ?>] <strong><?= htmlspecialchars($row['nickname']) ?></strong>：
                </div>
                <div class="message-content">
                    <?= nl2br(htmlspecialchars($row['content'])) ?>
                </div>
                <div class="message-actions">
                    👍 <?= $row['like_count'] ?>
                    ｜ <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('確定要刪除這則留言嗎？');">🗑️ 刪除</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
