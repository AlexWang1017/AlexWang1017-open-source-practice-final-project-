<?php
require 'db.php';
date_default_timezone_set('Asia/Taipei');

// 取得表單資料
$nickname = trim($_POST['nickname']);
$content = trim($_POST['content']);

if ($nickname === '' || $content === '') {
    echo "暱稱與留言不能為空白！";
    exit;
}

// 儲存留言
$stmt = $pdo->prepare("INSERT INTO messages (nickname, content, created_at) VALUES (?, ?, NOW())");
$stmt->execute([$nickname, $content]);
$message_id = $pdo->lastInsertId();

// 解析留言中的 hashtags
preg_match_all('/#(\w{1,30})/u', $content, $matches);
$tags = array_unique($matches[1]);

foreach ($tags as $tag) {
    // 插入 tag（若不存在則忽略）
    $stmt = $pdo->prepare("INSERT IGNORE INTO tags (name) VALUES (?)");
    $stmt->execute([$tag]);

    // 取得 tag id
    $stmt = $pdo->prepare("SELECT id FROM tags WHERE name = ?");
    $stmt->execute([$tag]);
    $tag_id = $stmt->fetchColumn();

    // 插入 message_tag 關聯
    $stmt = $pdo->prepare("INSERT IGNORE INTO message_tag (message_id, tag_id) VALUES (?, ?)");
    $stmt->execute([$message_id, $tag_id]);
}

// 導回首頁
header("Location: index.php");
exit;
?>
