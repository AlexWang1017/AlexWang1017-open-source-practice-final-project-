<?php
require 'db.php';

$nickname = trim($_POST['nickname']);
$content = trim($_POST['content']);

if ($nickname === '' || $content === '') {
    echo "暱稱與留言不能為空白！";
    exit;
}

$stmt = $pdo->prepare("INSERT INTO messages (nickname, content) VALUES (?, ?)");
$stmt->execute([$nickname, $content]);

header("Location: index.php");
exit;
?>
