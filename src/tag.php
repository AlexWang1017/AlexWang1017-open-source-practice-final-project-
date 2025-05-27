<?php
require 'db.php';

$tagName = $_GET['name'] ?? '';

if (!$tagName) {
    echo "請提供標籤名稱，如：tag.php?name=你的標籤";
    exit;
}

// 文字處理函式：將網址、#標籤轉為超連結，並保留換行
function enrichText($text) {
    // 轉跳脫字元
    $text = htmlspecialchars($text);

    // 網址 → 超連結
    $text = preg_replace(
        '/(https?:\/\/[^\s<]+)/i',
        '<a href="$1" target="_blank" rel="noopener noreferrer">$1</a>',
        $text
    );

    // #hashtag → 超連結
    $text = preg_replace(
        '/#(\w{1,30})/u',
        '<a href="tag.php?name=$1">#$1</a>',
        $text
    );

    // 換行 → <br>
    return nl2br($text);
}
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>#<?= htmlspecialchars($tagName) ?> 的留言</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
            font-size: 17px;
        }
        .container {
            max-width: 720px;
            margin: auto;
            background-color: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h1 {
            font-size: 26px;
            margin-bottom: 20px;
            color: #333;
            word-break: break-word;
        }
        .message {
            padding: 14px 0;
            border-bottom: 1px solid #ddd;
        }
        .nickname {
            font-weight: bold;
            font-size: 18px;
            color: #444;
        }
        .time {
            font-size: 14px;
            color: #999;
        }
        .content {
            margin: 10px 0;
            line-height: 1.8;
            font-size: 17px;
            word-break: break-word;
        }
        .likes {
            font-size: 16px;
            color: #e91e63;
        }
        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
        a {
            color: #007bff;
            text-decoration: underline;
        }
        a:hover {
            color: #0056b3;
        }

        /* ✅ RWD 手機版自動調整樣式 */
        @media (max-width: 480px) {
            body {
                padding: 12px;
                font-size: 16px;
            }
            h1 {
                font-size: 22px;
            }
            .container {
                padding: 16px;
            }
            .nickname {
                font-size: 17px;
            }
            .content {
                font-size: 16px;
            }
            .likes {
                font-size: 15px;
            }
        }

    </style>
</head>
<body>

<div class="container">
    <h1>#<?= htmlspecialchars($tagName) ?> </h1>

    <?php
    $stmt = $pdo->prepare("
        SELECT m.*
        FROM messages m
        JOIN message_tag mt ON m.id = mt.message_id
        JOIN tags t ON mt.tag_id = t.id
        WHERE t.name = ?
        ORDER BY m.created_at DESC
    ");
    $stmt->execute([$tagName]);

    if ($stmt->rowCount() === 0) {
        echo "<p>目前沒有與 #$tagName 相關的留言。</p>";
    } else {
        foreach ($stmt as $row) {
            $nickname = htmlspecialchars($row['nickname']);
            $time = $row['created_at'];
            $likes = $row['like_count'];
            $content = enrichText($row['content']);

            echo "<div class='message'>";
            echo "<div class='time'>[$time]</div>";
            echo "<div class='nickname'>$nickname</div>";
            echo "<div class='content'>$content</div>";
            echo "<div class='likes'>👍 $likes</div>";
            echo "</div>";
        }
    }
    ?>

    <a class="back-button" href="index.php">← 返回留言牆</a>
</div>

</body>
</html>
