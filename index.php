<?php require 'db.php'; ?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>Smart Message Wall</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="admin-login">
    <?php if (isset($_SESSION['admin'])): ?>
        <a href="logout.php">登出管理員</a>
    <?php else: ?>
        <a href="login.php">管理員登入</a>
    <?php endif; ?>
</div>

<h1>Smart Message Wall</h1>

<!-- 留言輸入表單 -->
<form action="submit.php" method="post">
    <label for="nickname">暱稱：</label>
    <input type="text" id="nickname" name="nickname" required>

    <label for="content">留言內容：</label>
    <textarea id="content" name="content" rows="4" required></textarea>

    <button type="submit">送出留言</button>
</form>

<hr>
<h2>留言列表</h2>

<!-- 搜尋與篩選表單 -->
<form method="get" class="search-form">
    <input type="text" name="search" placeholder="輸入關鍵字搜尋暱稱或留言內容"
           value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">

    <div class="date-label">From:</div>
    <input type="date" name="start_date" value="<?= $_GET['start_date'] ?? '' ?>">

    <div class="date-label">To:</div>
    <input type="date" name="end_date" value="<?= $_GET['end_date'] ?? '' ?>">

    <select name="sort_order">
        <option value="desc" <?= ($_GET['sort_order'] ?? 'desc') === 'desc' ? 'selected' : '' ?>>時間：新 → 舊</option>
        <option value="asc" <?= ($_GET['sort_order'] ?? '') === 'asc' ? 'selected' : '' ?>>時間：舊 → 新</option>
        <option value="likes_desc" <?= ($_GET['sort_order'] ?? '') === 'likes_desc' ? 'selected' : '' ?>>👍讚數：高 → 低</option>
    </select>

    <button type="submit">🔍 搜尋</button>
</form>

<!-- 留言總數 -->
<?php
$countStmt = $pdo->query("SELECT COUNT(*) FROM messages");
$totalMessages = $countStmt->fetchColumn();
echo "<p>💬 共 <strong>$totalMessages</strong> 則留言</p>";
?>

<?php
// 函式：關鍵字高亮
function highlight($text, $keyword) {
    if (!$keyword) return $text;
    return preg_replace('/(' . preg_quote($keyword, '/') . ')/i', '<mark>$1</mark>', $text);
}

// 函式：轉網址和 #標籤 成超連結
function enrichText($text) {
    // 轉網址
    $text = preg_replace('/(https?:\/\/[^\s<]+)/i', '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>', $text);
    // 轉 #標籤
    $text = preg_replace('/#(\w{1,30})/u', '<a href="?search=%23$1">#$1</a>', $text);
    return $text;
}

// 接收搜尋參數
$search = $_GET['search'] ?? '';
$start_date = $_GET['start_date'] ?? '';
$end_date = $_GET['end_date'] ?? '';
$sort_param = $_GET['sort_order'] ?? 'desc';

// 組建 WHERE
$where = [];
$params = [];

if ($search) {
    $where[] = "(nickname LIKE ? OR content LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}
if ($start_date) {
    $where[] = "DATE(created_at) >= ?";
    $params[] = $start_date;
}
if ($end_date) {
    $where[] = "DATE(created_at) <= ?";
    $params[] = $end_date;
}
$where_clause = $where ? 'WHERE ' . implode(' AND ', $where) : '';

// 排序條件
$order_clause = "created_at DESC";
if ($sort_param === 'asc') {
    $order_clause = "created_at ASC";
} elseif ($sort_param === 'likes_desc') {
    $order_clause = "like_count DESC";
}

// 查詢資料
$stmt = $pdo->prepare("SELECT * FROM messages $where_clause ORDER BY $order_clause");
$stmt->execute($params);

foreach ($stmt as $row) {
    $id = $row['id'];
    $nickname_raw = htmlspecialchars($row['nickname']);
    $content_raw = htmlspecialchars($row['content']);
    $time = $row['created_at'];
    $likes = $row['like_count'];

    // 處理內容：高亮、轉連結
    $nickname = highlight($nickname_raw, $search);
    $content = highlight(nl2br(enrichText($content_raw)), $search);

    echo "<div class='message-block'>";
    echo "<div class='message-header'>[$time] <strong>$nickname</strong>：</div>";
    echo "<div class='message-content'>$content</div>";
    echo "<div class='message-actions'>";
    echo "<a class='like-button' href='like.php?id=$id'>👍 $likes</a>";
    if (isset($_SESSION['admin'])) {
        echo " 🗑️ <a href='delete.php?id=$id' onclick='return confirm(\"確定刪除這則留言？\");'>刪除</a>";
    }
    echo "</div>";
    echo "</div>";
}
?>
</body>
</html>
