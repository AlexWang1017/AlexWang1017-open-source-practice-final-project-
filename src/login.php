<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === 'admin' && $password === '0000') {
        $_SESSION['admin'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "帳號或密碼錯誤";
    }
}
?>

<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>管理員登入</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-container">
    <h1>管理員登入</h1>

    <form method="post">
        <label for="username">帳號：</label><br>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"><br><br>

        <label for="password">密碼：</label><br>
        <div class="password-wrapper">
            <input type="password" name="password" id="password">
            <span id="togglePassword" class="eye-icon">👁️</span>
        </div><br>

        <?php if (!empty($error)): ?>
            <div class="login-error"><?= $error ?></div>
        <?php endif; ?>

        <button type="submit">登入</button>
    </form>
</div>

<script>
document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordInput = document.getElementById('password');
    const isPassword = passwordInput.type === 'password';
    passwordInput.type = isPassword ? 'text' : 'password';
    this.textContent = isPassword ? '🙈' : '👁️';
});
</script>

</body>
</html>
